<?php

/***************************************************************************************************************
 *
 *  This file contains all inital classes
 *
 ***************************************************************************************************************/

/**
 *
 * @author dsu
 * 
 * Maps query outputs to PHP model objects.
 *        
 */
class Mapper
{
    protected static $instance = null;

    public static function getInstance (): Mapper
    {
        if ( null === self::$instance )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __clone ()
    {}

    protected function __construct ()
    {}

    public function mapRooms ()
    {
        $data = [];
        
        foreach ( QueryUtil::query( "SELECT * FROM room" ) as $record )
        {
            $data[] = new MRoom( $record->roomid, $record->number, $record->description );
        }
        
        return $data;
    }

    public function mapRoom ( $roomid )
    {
        $record = QueryUtil::query( "SELECT * FROM room WHERE roomid = $roomid" )[ 0 ];
        $data = new MRoom( $record->roomid, $record->number, $record->description );
        return $data;
    }

    public function mapObjects ()
    {
        $data = [];
        
        foreach ( QueryUtil::query( "SELECT * FROM object" ) as $record )
        {
            $objectdescription = QueryUtil::query( "SELECT * FROM objectdescription WHERE objectdescriptionid = $record->objectdescriptionid" )[ 0 ];
            $room = QueryUtil::query( "SELECT * FROM room WHERE roomid = $record->roomid" )[ 0 ];
            
            $data[] = new MObject( $record->objectid, 
                    new MObjectdescription( $objectdescription->objectdescriptionid, $objectdescription->description ), 
                    new MRoom( $room->roomid, $room->number, $room->description ) );
        }
        
        return $data;
    }

    public function mapObject ( $objectid )
    {
        $record = QueryUtil::query( "SELECT * FROM object WHERE objectid = $objectid" )[ 0 ];
        $objectdescription = QueryUtil::query( "SELECT * FROM objectdescription WHERE objectdescriptionid = $record->objectdescriptionid" )[ 0 ];
        $room = QueryUtil::query( "SELECT * FROM room WHERE roomid = $record->roomid" )[ 0 ];
        $data = new MObject( $record->objectid, 
                new MObjectdescription( $objectdescription->objectdescriptionid, $objectdescription->description ), 
                new MRoom( $room->roomid, $room->number, $room->description ) );
        return $data;
    }

    public function mapObjectDescriptions ()
    {
        $data = [];
        
        foreach ( QueryUtil::query( "SELECT * FROM objectdescription" ) as $record )
        {
            $data[] = new MObjectdescription( $record->objectdescriptionid, $record->description );
        }
        
        return $data;
    }

    public function mapComponents ()
    {
        $data = [];
        
        foreach ( QueryUtil::query( "SELECT * FROM component" ) as $record )
        {
            $componentdescription = QueryUtil::query( "SELECT * FROM componentdescription WHERE componentdescriptionid = $record->componentdescriptionid" )[ 0 ];
            $componentvalue = QueryUtil::query( "SELECT * FROM componentvalue WHERE componentvalueid = $record->componentvalueid" )[ 0 ];
            
            $data[] = new MComponent( $record->componentid, 
                    new MComponentdescription( $componentdescription->componentdescriptionid, $componentdescription->description ), 
                    new MComponentvalue( $componentvalue->componentvalueid, $componentvalue->value ) );
        }
        
        return $data;
    }

    public function mapComponent ( $componentid )
    {
        $record = QueryUtil::query( "SELECT * FROM component WHERE componentid = $componentid" )[ 0 ];
        $componentdescription = QueryUtil::query( "SELECT * FROM componentdescription WHERE componentdescriptionid = $record->componentdescriptionid" )[ 0 ];
        $componentvalue = QueryUtil::query( "SELECT * FROM componentvalue WHERE componentvalueid = $record->componentvalueid" )[ 0 ];
        $data = new MComponent( $record->componentid, 
                new MComponentdescription( $componentdescription->componentdescriptionid, $componentdescription->description ), 
                new MComponentvalue( $componentvalue->componentvalueid, $componentvalue->value ) );
        return $data;
    }

    public function mapUsers ()
    {
        $data = [];
        
        foreach ( QueryUtil::query( "SELECT * FROM user" ) as $record )
        {
            $data[] = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password );
        }
        
        return $data;
    }

    public function mapUser ( $userid )
    {
        $record = QueryUtil::query( "SELECT * FROM user WHERE userid = $userid" )[ 0 ];
        $data = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password );
        return $data;
    }
}

/**
 *
 * @author dsu
 * 
 * Handles to whole authorization process.
 *        
 */
class Authorizer
{
    protected static $instance = null;
    private static $session_auth_user = "AUTH_USER";

    public static function getInstance (): Authorizer
    {
        if ( null === self::$instance )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __clone ()
    {}

    protected function __construct ()
    {}

    public function authorize ()
    {
        if ( !isset( $_SESSION[ self::$session_auth_user ] ) )
        {
            header( 'HTTP/1.0 401 Unauthorized' );
            $_SESSION[ "PREVIOUS_REQUEST_PATH" ] = parse_url( $_SERVER[ "REQUEST_URI" ] )[ "path" ];
            RouteService::redirect( "/login.html" );
        }
    }

    public function logout ()
    {
        unset( $_SESSION[ self::$session_auth_user ] );
        session_destroy();
    }

    public function login ()
    {
        $success = false;
        $sql = "SELECT * FROM user WHERE email = '" . $_POST[ 'email' ] . "'";
        $record = QueryUtil::query( $sql );
        
        if ( !empty( $record ) )
        {
            if ( $record[ 0 ]->password == md5( $_POST[ "password" ] ) )
            {
                $_SESSION[ self::$session_auth_user ] = $_POST[ "email" ];
                $success = true;
            }
        }
        
        $this->handleRedirect( $success );
    }

    private function handleRedirect ( bool $success )
    {
        if ( $success )
        {
            if ( isset( $_SESSION[ "PREVIOUS_REQUEST_PATH" ] ) )
            {
                RouteService::redirect( str_replace( Config::BASEPATH, '', $_SESSION[ "PREVIOUS_REQUEST_PATH" ] ) );
                unset( $_SESSION[ "PREVIOUS_REQUEST_PATH" ] );
            }
            else
            {
                RouteService::redirect( "/home" );
            }
        }
        else
        {
            TemplateUtil::default( "Login", "login.htm.php", null, "login.css", "login.js", false, false );
        }
    }
}

/**
 *
 * @author dsu
 * 
 * This class is responsible for the entire routing mechanism.
 *        
 */
class RouteService
{
    private static $routes = Array();
    private static $pathNotFound = null;
    private static $methodNotAllowed = null;

    /**
     * Function used to add a new route
     *
     * @param string $expression
     * Route string or expression
     * 
     * @param callable $function
     * Function to call when route with allowed method is found
     * 
     * @param string|array $method
     * Either a string of allowed method or an array with string values
     *            
     */
    public static function add ( $expression, $function, $method = 'get' )
    {
        array_push( self::$routes, Array(
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ) );
    }

    public static function pathNotFound ( $function )
    {
        self::$pathNotFound = $function;
    }

    public static function methodNotAllowed ( $function )
    {
        self::$methodNotAllowed = $function;
    }

    public static function redirect ( $uri, $basepath = Config::BASEPATH )
    {
        header( 'Location: ' . $basepath . $uri );
    }

    public static function rewrite ( $path, $dest, $basepath = Config::BASEPATH )
    {
        self::add( $path, function () use ( $basepath, $dest )
        {
            header( 'Location: ' . $basepath . $dest );
        } );
    }

    public static function run ( $case_matters = false, $trailing_slash_matters = false, $basepath = Config::BASEPATH )
    {
        // Parse current url
        $parsed_url = parse_url( $_SERVER[ 'REQUEST_URI' ] ); // Parse Uri
        if ( isset( $parsed_url[ 'path' ] ) && $parsed_url[ 'path' ] != '/' )
        {
            if ( $trailing_slash_matters )
            {
                $path = $parsed_url[ 'path' ];
            }
            else
            {
                $path = rtrim( $parsed_url[ 'path' ], '/' );
            }
        }
        else
        {
            $path = '/';
        }
        // Get current request method
        $method = $_SERVER[ 'REQUEST_METHOD' ];
        $path_match_found = false;
        $route_match_found = false;
        foreach ( self::$routes as $route )
        {
            // If the method matches check the path
            // Add basepath to matching string
            if ( $basepath != '' && $basepath != '/' && $basepath != $path )
            {
                $route[ 'expression' ] = '(' . $basepath . ')' . $route[ 'expression' ];
            }
            // Add 'find string start' automatically
            $route[ 'expression' ] = '^' . $route[ 'expression' ];
            // Add 'find string end' automatically
            $route[ 'expression' ] = $route[ 'expression' ] . '$';
            // echo $route['expression'].'<br/>';
            // Check path match
            if ( preg_match( '#' . $route[ 'expression' ] . '#' . ( $case_matters ? '' : 'i' ), $path, $matches ) )
            {
                $path_match_found = true;
                // Cast allowed method to array if it's not one already, then run through all
                // methods
                foreach ( (array) $route[ 'method' ] as $allowedMethod )
                {
                    // Check method match
                    if ( strtolower( $method ) == strtolower( $allowedMethod ) )
                    {
                        array_shift( $matches ); // Always remove first element. This contains the
                                                 // whole string
                        if ( $basepath != '' && $basepath != '/' )
                        {
                            array_shift( $matches ); // Remove basepath
                        }
                        call_user_func_array( $route[ 'function' ], $matches );
                        $route_match_found = true;
                        // Do not check other routes
                        break;
                    }
                }
            }
        }
        // No matching route was found
        if ( !$route_match_found )
        {
            // But a matching path exists
            if ( $path_match_found )
            {
                header( "HTTP/1.0 405 Method Not Allowed" );
                if ( self::$methodNotAllowed )
                {
                    call_user_func_array( self::$methodNotAllowed, Array(
                        $path,
                        $method
                    ) );
                }
            }
            else
            {
                header( "HTTP/1.0 404 Not Found" );
                if ( self::$pathNotFound )
                {
                    call_user_func_array( self::$pathNotFound, Array(
                        $path
                    ) );
                }
            }
        }
    }
}
<?php

/***************************************************************************************************************
 *
 *  This file contains all inital classes
 *  
 *  These classes are the core classes used in this project, they implement the main logic.
 *
 ***************************************************************************************************************/

/**
 *
 * @author dsu, nol
 *
 * The Validator validates input values form given by the user.
 *
 */
class Validator
{
    private static $alphabetic = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u";
    private static $numeric = "/^[0-9]*$/";
    private static $alphanumeric = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð0-9 ]*$/";
    private static $email = "/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i";

    public static function alphabetic ( $str )
    {
        return preg_match( self::$alphabetic, $str );
    }

    public static function numeric ( $str )
    {
        return preg_match( self::$numeric, $str );
    }

    public static function email ( $str )
    {
        return preg_match( self::$email, $str );
    }

    public static function alphanumeric ( $str )
    {
        return preg_match( self::$alphanumeric, $str );
    }

    /**
     * Logic to validate all inputs for a user.
     *
     * @param string $args1
     * firstname
     * 
     * @param string $args2
     * name
     * @param string $args3
     * email
     * 
     * @param string $args4
     * admin
     * 
     * @return boolean true if valid else false
     */
    public static function validateUser ( string $args1, string $args2, string $args3, string $args4 )
    {
        $valid = true;
        
        if ( !self::alphabetic( $args1 ) )
        {
            $valid = false;
        }
        elseif ( !self::alphabetic( $args2 ) )
        {
            $valid = false;
        }
        elseif ( !self::email( $args3 ) )
        {
            $valid = false;
        }
        elseif ( !self::numeric( $args4 ) )
        {
            $valid = false;
        }
        
        return $valid;
    }

    /**
     * Used to display a message to let the user know
     * that the validation failed.
     *
     * @param string $str
     * message
     * 
     * @param string $url
     */
    public static function message ( $str, $url )
    {
        echo "<script>
                alert('" . addslashes( $str ) . "');
                window.location.href='" . Config::BASEPATH . addslashes( $url ) . "';
            </script>";
    }
}

/**
 *
 * @author dsu, nol
 *
 * Responsible for the template rendering.
 * The Renderer is also responsible for including stylesheets and scripts.
 *
 */
class Renderer
{
    private static $default_template = "default.htm.php";
    private static $root = Config::BASEPATH . "/";

    /**
     * Renders the default template with corresponding template from given params.
     *
     * @param string $title
     * the title thats displayed in the tab
     * 
     * @param string $template
     * the template that need to be rendered
     * 
     * @param array $params
     * extra parameters that are used in the template
     * e.g. [ "userid" => $userid ]
     * 
     * @param string|array $stylesheets
     * extra stylesheets that need to be included
     * 
     * @param string|array $scripts
     * extra scripts that need to be included
     * 
     * @param bool $nav
     * true if the navigation should be displayed in the template
     * 
     * @param bool $user
     * true if a user is required to access the template
     */
    public static function default ( $title, $template, $params = [], $stylesheets = [], $scripts = [], $nav = true, $user = true )
    {
        if ( $user && Config::LOCKDOWN )
        {
            Authorizer::authorize();
        }
        
        extract( (array) $params ); // Create variables from params
        $webroot = self::$root;
        $template = Config::PATH_TEMPLATE . $template;
        include ( Config::PATH_TEMPLATE . self::$default_template );
    }

    public static function stylesheets ( $stylesheets )
    {
        foreach ( (array) $stylesheets as $stylesheet )
        {
            echo "<link rel='stylesheet' href='" . self::$root . Config::PATH_CSS . "$stylesheet'>";
        }
    }

    public static function scripts ( $scripts )
    {
        foreach ( (array) $scripts as $script )
        {
            echo "<script src='" . Config::PATH_JS . "$script'></script>";
        }
    }
}

/**
 *
 * @author dsu, nol
 *
 * Handles to whole authorization process.
 *
 */
class Authorizer
{
    private static $session_auth_user = "AUTH_USER";
    private static $session_auth_role = "AUTH_ROLE";
    private static $session_auth_name = "AUTH_NAME";

    /**
     * Check if a user is logged in or not.
     */
    public static function authorize ()
    {
        if ( !isset( $_SESSION[ self::$session_auth_user ] ) )
        {
            header( 'HTTP/1.0 401 Unauthorized' );
            $_SESSION[ "PREVIOUS_REQUEST_PATH" ] = parse_url( $_SERVER[ "REQUEST_URI" ] )[ "path" ];
            RouteService::redirect( "/login.html" );
        }
    }

    /**
     * Handles the logout process.
     */
    public static function logout ()
    {
        unset( $_SESSION[ self::$session_auth_user ] );
        session_destroy();
    }

    /**
     * Handles the login process.
     */
    public static function login ()
    {
        $success = false;
        $sql = "SELECT * FROM user WHERE email = ?";
        $record = QueryUtil::select( $sql, [
            $_POST[ 'email' ]
        ] );
        
        if ( !empty( $record ) )
        {
            if ( $record[ 0 ]->password == md5( $_POST[ "password" ] ) )
            {
                $_SESSION[ self::$session_auth_user ] = $_POST[ "email" ];
                $success = true;
                
                $_SESSION[ self::$session_auth_name ] = $record[ 0 ]->firstname;
                
                if ( $record[ 0 ]->admin == 1 )
                {
                    $_SESSION[ self::$session_auth_role ] = "Admin";
                }
            }
        }
        
        self::handleRedirect( $success );
    }

    /**
     * If the login was successful the user gets redirected
     * to the page he was previously trying to reach.
     * If the login failed the user can try to login again.
     *
     * @param bool $success
     * true if login is successful else false
     */
    private static function handleRedirect ( bool $success )
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
            Renderer::default( "Login", "login.htm.php", null, "login.css", "login.js", false, false );
        }
    }
}

/**
 *
 * @author dsu, nol
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

    /**
     * Rewrite an URL, so everytime that URL gets called, it get auto redirected.
     *
     * @param string $path
     * @param string $dest
     * @param string $basepath
     */
    public static function rewrite ( $path, $dest, $basepath = Config::BASEPATH )
    {
        self::add( $path, function () use ( $basepath, $dest )
        {
            header( 'Location: ' . $basepath . $dest );
        } );
    }

    /**
     * The holy logic for the whole routing mechanism.
     *
     * @param boolean $case_matters
     * @param boolean $trailing_slash_matters
     * @param string $basepath
     */
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
                if ( $path == Config::BASEPATH . "/error/404.html" )
                {
                    $path = null;
                }
                
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
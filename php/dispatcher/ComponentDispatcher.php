<?php
namespace php\dispatcher;

use php\RouteService;
use php\util\QueryUtil;
use php\Logger;

class ComponentDispatcher
{

    public static function update($componentid)
    {
        // TODO implement
        // $firstname = $_POST[ "firstname" ];
        // $name = $_POST[ "name" ];
        // $email = $_POST[ "email" ];
        // $password = $_POST[ "password" ];
        
        // $pw = "SELECT * FROM user WHERE userid = $userid";
        // $record = QueryUtil::query( $pw )[ 0 ];
        
        // if ( $record->password != $password )
        // {
        // $password = md5( $password );
        // }
        
        // $sql = "UPDATE user SET firstname = '$firstname', name = '$name', email = '$email', password
        // = '$password' WHERE userid = $userid";
        // QueryUtil::execute( $sql );
        RouteService::redirect("/components");
    }

    public static function create()
    {
        $description = $_POST[ "description" ];
        $value = $_POST[ "value" ];
        $descriptionId = 0;
        $valueId = 0;
        
        if ( empty( QueryUtil::query( "SELECT * FROM componentdescription WHERE lower(description) = lower('$description')" ) ) )
        {
            QueryUtil::execute( "INSERT INTO componentdescription ( description ) VALUES ( '$description' )");
            $descriptionId = QueryUtil::query( "SELECT componentdescriptionid FROM componentdescription WHERE description = '$description'")[0]->componentdescriptionid;
            var_dump($descriptionId);
        }
        
        if ( empty( QueryUtil::query( "SELECT * FROM componentvalue WHERE lower(value) = lower('$value')" ) ) )
        {
            QueryUtil::execute( "INSERT INTO componentvalue ( value ) VALUES ( '$value' )");
            $valueId = QueryUtil::query( "SELECT componentvalueid FROM componentvalue WHERE value = '$value'")[0]->componentvalueid;
            var_dump($valueId);
        }
        
        QueryUtil::execute( "INSERT INTO component ( componentdescriptionid, componentvalueid ) VALUES ( '$descriptionId', '$valueId' )");
        
        RouteService::redirect("/components");
    }

    public static function delete($componentid)
    {
        $sql = "DELETE FROM component WHERE componentid = $componentid;";
        QueryUtil::execute( $sql );
        RouteService::redirect("/components");
    }
}


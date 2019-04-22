<?php

namespace php\model;

/**
 *
 * @author dsu
 *        
 */
class MUser
{
    private $userid;
    private $name;
    private $firstname;
    private $email;
    private $password;

    public function __construct ( int $userid, string $name, string $firstname, string $email, string $password )
    {
        $this->userid = $userid;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
    }

    public function getUserid ()
    {
        return $this->userid;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function getFirstname ()
    {
        return $this->firstname;
    }

    public function getEmail ()
    {
        return $this->email;
    }

    public function getPassword ()
    {
        return $this->password;
    }
}


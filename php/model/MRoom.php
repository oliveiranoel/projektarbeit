<?php

namespace php\model;

/**
 *
 * @author dsu
 *        
 */
class MRoom
{
    private $roomid;
    private $number;
    private $description;

    public function __construct ( int $roomid, string $number, string $description )
    {
        $this->roomid = $roomid;
        $this->number = $number;
        $this->description = $description;
    }

    public function getRoomId ()
    {
        return $this->roomid;
    }

    public function getNumber ()
    {
        return $this->number;
    }

    public function getDescription ()
    {
        return $this->description;
    }
}


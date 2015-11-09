<?php

require_once '../Business/iBusinessObject.php';
require_once '../Data/aDataAccess.php';

class Actor implements iBusinessObject
{
    private $m_ActorId;
    private $m_firstName;
    private $m_lastName;


    public function __construct($in_fname,$in_lname)
    {
        $this->m_firstName = $in_fname;
        $this->m_lastName = $in_lname;
    }

    public function getID()
    {
        return ($this->m_ActorId);
    }

    public function getFirstName()
    {
        return ($this->m_firstName);
    }

    public function getLastName()
    {
        return ($this->m_lastName);
    }



    public static function SearchActor($Name)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->SearchActor($Name);

        while($row = $myDataAccess->fetchActors())
        {
            $currentActor = new self($myDataAccess->fetchActorFirstName($row),
                $myDataAccess->fetchActorLastName($row));
            $currentActor->m_ActorId = $myDataAccess->fetchActorID($row);
            $arrayOfActorObjects[] = $currentActor;
        }

        $myDataAccess->closeDB();

        return $arrayOfActorObjects;
    }


    public static function SearchUActor($actorId)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->SearchUActor($actorId);

        while($row = $myDataAccess->fetchActors())
        {
            $currentActor = new self($myDataAccess->fetchActorFirstName($row),
                $myDataAccess->fetchActorLastName($row));
            $currentActor->m_ActorId = $myDataAccess->fetchActorID($row);

        }

        $myDataAccess->closeDB();

        return $currentActor;
    }






    public static function DeleteActor($ActorId)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->DeleteActor($ActorId);

        while($row = $myDataAccess->fetchActors())
        {
            $currentActor = new self($myDataAccess->fetchActorFirstName($row),
                $myDataAccess->fetchActorLastName($row));
            $currentActor->m_ActorId = $myDataAccess->fetchActorID($row);
            $arrayOfActorObjects[] = $currentActor;
        }

        $myDataAccess->closeDB();

        return $arrayOfActorObjects;
    }




    /// fix update
    public static function UpdateActor($UpActor, $first, $last)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->UpdateActor($UpActor, $first, $last);

        while($row = $myDataAccess->fetchActors())
        {
            $currentActor = new self($myDataAccess->fetchActorFirstName($row),
                $myDataAccess->fetchActorLastName($row));
            $currentActor->m_ActorId = $myDataAccess->fetchActorID($row);
            $arrayOfActorObjects[] = $currentActor;
        }

        $myDataAccess->closeDB();

        return $arrayOfActorObjects;
    }


    public static function retrieveSome($start,$count)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectActors($start,$count);

        while($row = $myDataAccess->fetchActors())
        {
            $currentActor = new self($myDataAccess->fetchActorFirstName($row),
                $myDataAccess->fetchActorLastName($row));
            $currentActor->m_ActorId = $myDataAccess->fetchActorID($row);
            $arrayOfActorObjects[] = $currentActor;
        }

        $myDataAccess->closeDB();

        return $arrayOfActorObjects;
    }

    public function save()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertActor($this->m_firstName,$this->m_lastName);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";

    }
}

?>
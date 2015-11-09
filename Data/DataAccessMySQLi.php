<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'aDataAccess.php';
class DataAccessMySQLi extends aDataAccess
{

    private $dbConnection;
    private $result;

    // aDataAccess methods
    public function connectToDB()
    {
        $this->dbConnection = @new mysqli("localhost","root", "inet2005","L5Data");
        if (!$this->dbConnection)
        {
            die('Could not connect to the Lab5Data Database: ' .
                $this->dbConnection->connect_errno);
        }
    }

    public function closeDB()
    {
        $this->dbConnection->close();
    }

    public function selectActors($start,$count)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM Actor LIMIT $start,$count");
        if(!$this->result)
        {
            die('Could not retrieve records from the Lab5Data Database: ' .
                $this->dbConnection->error);
        }

    }

    public function SearchActor($Name)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM Actor WHERE FirstName LIKE '%$Name%' OR LastName LIKE '%$Name%'");
        if(!$this->result)
        {
            die('Could not retrieve records from the Lab5Data Database: ' .
                $this->dbConnection->error);
        }

    }


    public function SearchUActor($actorId)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM Actor WHERE ActorId =  $actorId");
        if(!$this->result)
        {
            die('Could not retrieve records from the Lab5Data Database: ' .
                $this->dbConnection->error);
        }

    }




    public function DeleteActor($ActorId)
    {
        $this->result = @$this->dbConnection->query("DELETE FROM Actor WHERE ActorId = $ActorId");
        if(!$this->result)
        {
            die('Could not Delete records from the Lab5Data Database: ' .
                $this->dbConnection->error);
        }


        else
        {
            echo ('Record Deleted');
        }
    }






    public function UpdateActor($UpActor, $first, $last)
    {
        $this->result = @$this->dbConnection->query("UPDATE Actor SET FirstName = '$first', LastName= '$last' WHERE ActorId =$UpActor");








        if(!$this->result)
        {
            die('Could not Update records from the Lab5Data Database: ' .
                $this->dbConnection->error);
        }


        else
        {
            echo ('Record Updated');
        }
    }






    public function fetchActors()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }

    public function fetchActorID($row)
    {
        return $row['ActorId'];
    }

    public function fetchActorFirstName($row)
    {
        return $row['FirstName'];
    }

    public function fetchActorLastName($row)
    {
        return $row['LastName'];
    }

    public function insertActor($firstName,$lastName)
    {
        $this->result = @$this->dbConnection->query("INSERT INTO Actor(ActorId,FirstName,LastName) VALUES(NOT Null,'$firstName','$lastName');");

        return $this->dbConnection->affected_rows;

    }




}

?>





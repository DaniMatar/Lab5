<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'aDataAccess.php';
class DataAccessPDOSQLite extends aDataAccess
{
    private $dbConnection;
    private $result;
    private $stmt;

    // aDataAccess methods
    public function connectToDB()
    {
        try
        {
            $this->dbConnection = new PDO("sqlite:/home/inet2005/code/inet2005ins/PHP3Tier/Data/db/mydb.sqlite");
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex)
        {
            die('Could not connect to the SQLite Database via PDO: ' . $ex->getMessage());
        }
    }

    public function closeDB()
    {
        // set a PDO connection object to null to close it
        $this->dbConnection = null;
    }

    public function selectActors($start,$count)
    {
        try
        {
            $this->stmt = $this->dbConnection->prepare('SELECT * FROM Actor LIMIT :start, :count');
            $this->stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $this->stmt->bindParam(':count', $count, PDO::PARAM_INT);

            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from SQLite Database via PDO: ' . $ex->getMessage());
        }

    }


    public function fetchActors()
    {
        try
        {
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex)
        {
            die('Could not retrieve from SQLite Database via PDO: ' . $ex->getMessage());
        }

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
        try
        {
            $this->stmt = $this->dbConnection->prepare('INSERT INTO Actor(ActorId,FirstName,LastName) VALUES(NOT NULL,:firstName, :lastName)');
            $this->stmt->bindParam(':FirstName', $firstName, PDO::PARAM_STR);
            $this->stmt->bindParam(':LastName', $lastName, PDO::PARAM_STR);

            $this->stmt->execute();

            return $this->stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            die('Could not insert record into SQLite Database via PDO: ' . $ex->getMessage());
        }
    }


    public function UpdateActor($UpActor, $first, $last)
    {
        $this->result = @$this->dbConnection->query("UPDATE Actor SET (FirstName,LastName) VALUES ($first,$last) WHERE ActorId = $UpActor");


        if(!$this->result)
        {
            die('Could not Update records from the Lab5Data Database: ' .
                $this->dbConnection->error);
        }


        else
        {
            echo ('Record Deleted');
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




    public function SearchUActor($actorId)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM Actor WHERE ActorId =  $actorId");
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








}

?>

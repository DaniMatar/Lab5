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
            $this->dbConnection = new PDO("sqlite:/home/inet2005/PhpstormProjects/w0256244/Lab5/Data/db/sqLiteLab5");
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
            $this->result = $this->stmt-> fetch(PDO::FETCH_ASSOC);
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

                $this->stmt = $this->dbConnection-> prepare('INSERT INTO Actor (FirstName, LastName) VALUES(:firstName, :lastName)');
                $this->stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
                $this->stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);


                $this->stmt->execute ();

                return $this->stmt->rowCount();
            }
            catch(PDOException $ex)
            {
                die('Could not insert record into SQLite Database via PDO: ' . $ex->getMessage());
            }



    }


    public function UpdateActor($UpActor, $first, $last)
    {

        try
        {

            $this->stmt = $this->dbConnection-> prepare('UPDATE Actor SET FirstName =:first ,LastName=:last WHERE ActorId = :UpActor');
            $this->stmt->bindParam(':UpActor', $UpActor, PDO::PARAM_INT);
            $this->stmt->bindParam(':first', $first, PDO::PARAM_STR);
            $this->stmt->bindParam(':last', $last, PDO::PARAM_STR);


            $this->stmt->execute ();

            return $this->stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            die('Could not insert record into SQLite Database via PDO: ' . $ex->getMessage());
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
        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT * FROM Actor WHERE ActorId =  $actorId");


            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from SQLite Database via PDO: ' . $ex->getMessage());
        }



    }



    public function SearchActor($Name)

    {
        try
        {
            $this->stmt = $this->dbConnection->prepare("SELECT * FROM Actor WHERE FirstName LIKE '%$Name%' OR LastName LIKE '%$Name%'");


            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from SQLite Database via PDO: ' . $ex->getMessage());
        }

    }






}

?>

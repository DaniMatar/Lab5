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
         $this->dbConnection = @new mysqli("localhost","root", "inet2005","sakila");
         if (!$this->dbConnection)
         {
               die('Could not connect to the Sakila Database: ' .
                        $this->dbConnection->connect_errno);
         }
    }

    public function closeDB()
    {  
        $this->dbConnection->close();
    }

    public function selectCustomers($start,$count)
    {
       $this->result = @$this->dbConnection->query("SELECT * FROM customer LIMIT $start,$count");
       if(!$this->result)
       {
               die('Could not retrieve records from the Sakila Database: ' .
                       $this->dbConnection->error);
       }

    }
    

    public function fetchCustomers()
    {
       if(!$this->result)
       {
               die('No records in the result set: ' .
                       $this->dbConnection->error);
       }
       return $this->result->fetch_array();
    }
    
    public function fetchCustomerID($row)
    {
       return $row['customer_id'];
    }

    public function fetchCustomerFirstName($row)
    {
       return $row['first_name'];
    }

    public function fetchCustomerLastName($row)
    {
       return $row['last_name'];
    }
    
    public function insertCustomer($firstName,$lastName)
    {
       $this->result = @$this->dbConnection->query("INSERT INTO customer(store_id,first_name,last_name,address_id) VALUES(1,'$firstName','$lastName',1);");
       
       return $this->dbConnection->affected_rows;

    }
}

?>

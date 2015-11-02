<?php

require_once '../Business/iBusinessObject.php';
require_once '../Data/aDataAccess.php';

class Customer implements iBusinessObject
{
    private $m_customerId;
    private $m_firstName;
    private $m_lastName;
    
    
    public function __construct($in_fname,$in_lname)
    {
        $this->m_firstName = $in_fname;
        $this->m_lastName = $in_lname;
    }
    
    public function getID()
    {
        return ($this->m_customerId);
    }
    
    public function getFirstName()
    {
        return ($this->m_firstName);
    }

    public function getLastName()
    {
        return ($this->m_lastName);
    }

    public static function retrieveSome($start,$count)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectCustomers($start,$count);
        
        while($row = $myDataAccess->fetchCustomers())
        {
            $currentCustomer = new self($myDataAccess->fetchCustomerFirstName($row),
                $myDataAccess->fetchCustomerLastName($row));
            $currentCustomer->m_customerId = $myDataAccess->fetchCustomerID($row);
            $arrayOfCustomerObjects[] = $currentCustomer;
        }

        $myDataAccess->closeDB();
        
        return $arrayOfCustomerObjects;
    }
    
    public function save()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertCustomer($this->m_firstName,$this->m_lastName);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
        
    }
}

?>

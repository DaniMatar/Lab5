<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Customers</title>
        <style type="text/css">
            table
            {
               border: 1px solid purple;
            }
            th, td
            {
               border: 1px solid red;
            }
        </style>
    </head>
    <body>
        <h1>Current Customers:</h1>
        <table>
            <thead>
                <tr>
                    <td>Customer ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    require("../Business/Customer.php");

                    $arrayOfCustomers = Customer::retrieveSome(0,10);

                    foreach($arrayOfCustomers as $customer):
                        
                    ?>
                        <tr>
                            <td><?php echo $customer->getID(); ?></td>
                            <td><?php echo $customer->getFirstName(); ?></td>
                            <td><?php echo $customer->getLastName(); ?></td>
                        </tr>
                    <?php
                    endforeach;
                ?>
            </tbody>
        </table>
        <a href="newCustomerForm.html">Add Customer</a>    
    </body>
</html>

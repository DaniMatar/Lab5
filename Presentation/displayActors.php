<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Actors</title>
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
        <h1>Current Actors:</h1>
        <table>
            <thead>
                <tr>
                    <td>Actor ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    require("../Business/Actor.php");

                    $arrayOfActors = Actor::retrieveSome(0,10);

                    foreach($arrayOfActors as $Actor):
                        
                    ?>
                        <tr>
                            <td><?php echo $Actor->getID(); ?></td>
                            <td><?php echo $Actor->getFirstName(); ?></td>
                            <td><?php echo $Actor->getLastName(); ?></td>
                        </tr>
                    <?php
                    endforeach;
                ?>
            </tbody>
        </table>
        <a href="AddActorForm.html">Add Actor</a>
    </body>
</html>

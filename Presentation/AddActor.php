<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         
            $result = "";
            
            if(!empty($_POST['firstName']) && !empty($_POST['lastName']))
            {
                require("../Business/Actor.php");
                
                $newActor = new Actor($_POST['firstName'],$_POST['lastName']);
                
                $result = $newActor->Save();
            }
            else 
            {
                $result = "Nothing to do!";
            }
        ?>
        <h1><?php echo $result; ?></h1>
        <a href="displayActors.php">Back to Display</a>
    </body>
</html>

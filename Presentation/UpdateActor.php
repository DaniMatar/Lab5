<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Actors</title>

</head>
<body>


    <?php

    $actorId= $_POST['actorId'];

    require("../Business/Actor.php");

    $Actor = Actor::SearchUActor($actorId);



?>


        <form id="form1" name="form1" method="post" action="UpdateActor2.php">
            <p>
                <label>First Name: <input value = " <?php echo $Actor->getFirstName(); ?> " type="text" name="firstName" id="firstName" /> </label>
            </p>
            <p>
                <label>Last Name:<input value = "<?php echo $Actor->getLastName(); ?>" type="text" name="lastName" id="lastName" /></label>
            </p>
            <input type="hidden" name="actorId" id="actorId" value="<?php echo $_POST['actorId']; ?>" />
            <p>
                <input type="submit" name="submit" id="submit" value="Submit" />
            </p>
        </form>




<a href="AddActorForm.html">Add Actor</a>
</body>
</html>

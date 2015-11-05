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

    $UpActor = $_POST['actorId'];
    $first = $_POST['firstName'];
    $last = $_POST['lastName'];

    $Actor = Actor::UpdateActor($UpActor, $first, $last);


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

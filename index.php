<?php
//Sources used: https://cs4640.cs.virginia.edu, ...
session_start();
function basic_info(){
    $_SESSION["name"] = $_GET["name"];
    $_SESSION["email"] = $_GET["email"];
    header("Location: /game.php");
    die();
    return;
}

//run function when form is submitted at welcome.php
if(isset($_GET['name']))
{
    basic_info();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Wordle Extreme</title>
<meta name="wordle extreme" content="index.php for wordle extreme">
</html>
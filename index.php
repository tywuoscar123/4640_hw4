<?php
//Sources used: https://cs4640.cs.virginia.edu, ...
session_start();

class wordGameController{
    public $wordList;
    
    //constructor takes url as input for word list
    function __construct($src) {
        $wordList = preg_split('/\s+/',file_get_contents($src), -1, PREG_SPLIT_NO_EMPTY);
        //$wordList = explode(" ",file_get_contents($src));
        print_r($wordList);
      }
}

function basic_info(){
    $_SESSION["name"] = $_GET["name"];
    $_SESSION["email"] = $_GET["email"];
    $_SESSION["numGuess"] = 0;
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
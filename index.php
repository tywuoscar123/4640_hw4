<?php
//Sources used: https://cs4640.cs.virginia.edu, https://www.geeksforgeeks.org/count-common-characters-in-two-strings/

//link to the welcome page: https://cs4640.cs.virginia.edu/zhw9mc/hw4/welcome.php

session_start();
$listUrl = "https://www.cs.virginia.edu/~jh2jf/courses/cs4640/spring2022/wordlist.txt";
$_SESSION["guessSuccessful"] = false;

class wordGameController{
    private $wordList;
    public $answer;
    public $userGuessNum = 0;
    public $userGuesses = array();
    public $wordSrc;
    //constructor takes url as input for word list
    function __construct($src) {
        $wordList = preg_split('/\s+/',file_get_contents($src), -1, PREG_SPLIT_NO_EMPTY);
        
        //get random word from wordlist
        $this->answer = $wordList[rand(0, count($wordList)-1)];
        return;
      }

    function getRandWord($src){        
        //get random word from wordlist
        $wordList = preg_split('/\s+/',file_get_contents($src), -1, PREG_SPLIT_NO_EMPTY);
        
        //get random word from wordlist
        $this->answer = $wordList[rand(0, count($wordList)-1)];
        return;
    }

    function checkAns($guess){
        $guess = strtolower($guess);
        $ansLen = strlen($this->answer);
        $guessLen = strlen($guess);
        $lowerAns = strtolower($this->answer);
        //if guess is correct, redirect to gameover page
        if(strcasecmp($guess,$this->answer)  === 0){
            $_SESSION["guessSuccessful"] = true;
            header("Location: /gameOver.php");
            die();
        }
        $guessFreq = array_fill(0, 26, 0);
        $ansFreq = array_fill(0, 26, 0);
        $commonCharCount = 0;
        $sameLocCount = 0;
        //check if character exists in string, if yes, increment number stored in position of char (a = 0, z = 25), pos of char is index for array
        for ($i = 0; $i < $guessLen; $i++) {
                $guessFreq[ord($guess[$i]) - 97]++;
        }
        for ($i = 0; $i < $ansLen; $i++) {
            $ansFreq[ord($lowerAns[$i]) - 97]++;
        }
        //compare same pairs that exist
        for($i = 0; $i < 26; $i++){
            $commonCharCount += min($guessFreq[$i], $ansFreq[$i]);
        }
        //check num of same char with same location
        for($i = 0; $i < $ansLen; $i++){
            //break loop if reached the end of a word (when i === len of word)
            if($i >= $ansLen || $i >= $guessLen){
                break;
            }
            if($this->answer[$i] === $guess[$i]){
                $sameLocCount++;
            }
        }
        //assign all variables to session, display in game.php
        $_SESSION["guessInfo"] = [];
        $_SESSION["guessInfo"]["commonCharCount"] = $commonCharCount;
        $_SESSION["guessInfo"]["sameLocCount"] = $sameLocCount;
        //check if longer or shorter
        if($ansLen < $guessLen){
            $_SESSION["guessInfo"]["guessLen"] = "Too long";
        }else if($ansLen > $guessLen){
            $_SESSION["guessInfo"]["guessLen"] = "Too short";
        }else{
            $_SESSION["guessInfo"]["guessLen"] = "The same length ";
        }
        return;
    }

    function submitAns(){
        $_SESSION["guess-hist"][] = $_GET["user-guess"];
        $this->checkAns($_GET["user-guess"]);
        header("Location: ./game.php");
        die();
      }
}

function basic_info(){
    $_SESSION["name"] = $_GET["name"];
    $_SESSION["email"] = $_GET["email"];
    $_SESSION["numGuess"] = 0;
    header("Location: ./game.php");
    die();
}

//run function when form is submitted at welcome.php
if(isset($_GET['name']))
{
    basic_info();
}

//run function when user submits guess
if(isset($_GET['user-guess'])){
    //call checkAns
    $_SESSION['game-control-var']->submitAns();
}

if(isset($_POST['quit'])){
    session_unset();
    session_destroy();
    header("Location: ./welcome.php");
    die();
}

if(isset($_POST['restart'])){
    unset($_SESSION['guess-hist']); 
    unset($_SESSION['guessInfo']);
    $_SESSION['game-control-var'] -> getRandWord($listUrl);
    header("Location: ./game.php");
    die();
}

if(isset($_POST['quit-to-gameover'])){
    header("Location: ./gameover.php");
    die();
}
if(isset($_POST['start'])){
    header("Location: ./welcome.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Wordle Extreme</title>
<meta name="wordle extreme" content="index.php for wordle extreme">
Click 
<a href="./welcome.php"> here</a>
if the screen is blank to be redirected to the welcome page.
<br>
<br>
<br>
</html>
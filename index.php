<?php
//Sources used: https://cs4640.cs.virginia.edu, https://www.geeksforgeeks.org/count-common-characters-in-two-strings/
session_start();

$_SESSION["guessSuccessful"] = false;

class wordGameController{
    private $wordList;
    public $answer;
    public $userGuessNum = 0;
    public $userGuesses = array();
    //constructor takes url as input for word list
    function __construct($src) {
        $wordList = preg_split('/\s+/',file_get_contents($src), -1, PREG_SPLIT_NO_EMPTY);
        
        //get random word from wordlist
        $this->answer = $wordList[rand(0, count($wordList)-1)];
        return;
      }

    function checkAns($guess){
        $ansLen = strlen($this->answer);
        $guessLen = strlen($guess);

        //if guess is correct, return
        if(strcasecmp($guess,$this->answer)  === 0){
            echo "<br><br><br>" . $guess . "<br><br><br>";
            echo "<br><br><br>" . $this->answer . "<br><br><br>"; 
            $_SESSION["guessSuccessful"] = true;
            return;
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
            $ansFreq[ord($this->answer[$i]) - 97]++;
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
        $_SESSION["commonCharCount"] = $commonCharCount;
        $_SESSION["sameLocCount"] = $sameLocCount;
        //check if longer or shorter
        if($ansLen < $guessLen){
            $_SESSION["guessLen"] = "Too long";
        }else if($ansLen > $guessLen){
            $_SESSION["guessLen"] = "Too short";
        }else{
            $_SESSION["guessLen"] = "The same length ";
        }
        echo "<br> PRINT VARS<BR>";
        echo "<br><br>" . $_SESSION["commonCharCount"] . "<br><br>";
        echo "<br><br>" . $_SESSION["sameLocCount"] . "<br><br>";
        echo "<br><br>" . $_SESSION["guessLen"] . "<br><br>";
        return;
    }

    function submitAns(){
        $_SESSION["guess-hist"][] = $_GET["user-guess"];
        $this->checkAns($_GET["user-guess"]);
        header("Location: /game.php");
        die();
        return;
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

if(isset($_GET['user-guess'])){
    //call checkAns
    $_SESSION['game-control-var']->submitAns();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Wordle Extreme</title>
<meta name="wordle extreme" content="index.php for wordle extreme">
</html>
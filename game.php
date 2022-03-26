<?php
require_once("index.php");
if(!isset($_SESSION['game-control-var'])){
    $gameControl = new wordGameController("https://www.cs.virginia.edu/~jh2jf/courses/cs4640/spring2022/wordlist.txt");
    $_SESSION['game-control-var'] = $gameControl;
}
echo "<br><br><br>" . $_SESSION['game-control-var']->answer . "<br><br><br>";
?>
<html>
<body>
Welcome <?= $_SESSION["name"]; ?>
<br>
Your email address is: <?= $_SESSION["email"] ?>
<br>
Number of guesses: <?php 
    if(isset($_SESSION["guess-hist"])){
        echo count($_SESSION["guess-hist"]);
    }
    else{
        echo 0;
    }
?>
<br>
<br>
Previous guesses:
<br>
<?php
    echo "<br>";
    if(!empty($_SESSION["guess-hist"])){
        foreach($_SESSION["guess-hist"] as $guess) {
            echo $guess;
            echo "<br>";
        }
        echo "<p>There were " . $_SESSION["commonCharCount"] . " characters in the word<p>";
        echo "<p>" . $_SESSION["sameLocCount"] . " in the correct position." ;
        echo "<p>Your guess was " . $_SESSION["guessLen"];
    }else{
        echo "No guess history availble.";
    }

?>
<br>
<p>
    Please enter a word below to start guessing
</p>
<form action="index.php" method="get">
Guess <input type="text" name="user-guess">
<input type="submit" value="Submit">
<br>

</body>
</html> 
<?php
require_once("index.php");

?>

<!DOCTYPE html>
<html>
<body>
<p> The word is: <?= $_SESSION['game-control-var']->answer ?></p>
<br>
<?php
    if($_SESSION["guessSuccessful"]){
        echo "You successfully guessed the word in : ";
        if(isset($_SESSION["guess-hist"])){
            echo count($_SESSION["guess-hist"]). "guesses";
        }
        else{
            echo "Unable to retrieve number of guesses";
        }
    }
?>
<br>
<br>
<form action="index.php" method="post">
    <input type="submit" name="quit" value="Quit">
    <input type="submit" name="restart" value="Restart">
</form>

</body>
</html> 
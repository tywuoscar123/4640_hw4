<?php
require_once("index.php");

?>

<!DOCTYPE html>
<html>
<body>
<p> The word is: <?= $_SESSION['game-control-var']->answer ?></p>
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
<form action="index.php" method="post">
    <input type="submit" name="quit" value="Quit">
    <input type="submit" name="restart" value="Restart">
</form>

</body>
</html> 
<?php
require_once("index.php");

$gameControl = new wordGameController("https://www.cs.virginia.edu/~jh2jf/courses/cs4640/spring2022/wordlist.txt");
?>
<html>
<body>
    
Welcome <?= $_SESSION["name"]; ?>
<br>
Your email address is: <?= $_SESSION["email"]; ?>
<br>
Number of guesses: <?= $_SESSION["numGuess"] ?>
<br>
<p>
    Please enter a word below to start guessing
</p>
<form action="index.php" method="get">
Guess <input type="text" name="user-guess"><br>


</body>
</html> 
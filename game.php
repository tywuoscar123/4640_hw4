<?php
require_once("index.php");
?>
<html>
<body>
    
Welcome <?= $_SESSION["name"]; ?><br>
Your email address is: <?= $_SESSION["email"]; ?>

</body>
</html> 
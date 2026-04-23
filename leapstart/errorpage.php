<?php
session_start();

if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>

<br><br>
Click Here to <a href="index.html">Login</a>
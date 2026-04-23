<?php
session_start();

$uname = $_POST['t1'] ?? "";
$pass  = $_POST['t2'] ?? "";

if ($uname != "" && $pass != "") {
    if ($uname == "admin" && $pass == "admin") {
        $_SESSION["name"] = "Admin";
        $_SESSION["role"] = "Administrator";
        $_SESSION["deptno"] = "100";
        $_SESSION["salary"] = "50000";

        header("location:mainpage.php");
        exit;
    } else {
        $_SESSION["msg"] = "Invalid Username/Password are entered. Please try again.";
        header("location:errorpage.php");
        exit;
    }
} else {
    $_SESSION["msg"] = "Username/Password cannot be empty";
    header("location:errorpage.php");
    exit;
}
?>
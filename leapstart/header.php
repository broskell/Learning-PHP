<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("location:index.html");
    exit;
}

$name   = $_SESSION["name"];
$role   = $_SESSION["role"];
$deptno = $_SESSION["deptno"];
$salary = $_SESSION["salary"];
?>

<center><h1>LEAPSTART</h1></center>

<div style="float:right; margin-right:5%">
    Welcome <?php echo $name; ?> |
    <a href="logout.php" target="_top">Logout</a><br>
    Role: <?php echo $role; ?><br>
    Department Number: <?php echo $deptno; ?><br>
    Salary: <?php echo $salary; ?>
</div>
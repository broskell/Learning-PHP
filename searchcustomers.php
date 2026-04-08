<!DOCTYPE html>
<html>
<head>
    <title>Search Customer</title>
</head>
<body style="text-align: center">

<form method="get" action="">
    Customer ID:
    <input type="number" name="cid" required>
    <input type="submit" value="Search">
</form>

<?php
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$username = "postgres";
$password = "Kellampalli@18";

if (isset($_GET["cid"])) {
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $cn = new PDO($dsn, $username, $password);
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $cid = $_GET["cid"];

        $sql = "SELECT * FROM Customers WHERE cid = :cid";
        $stmt = $cn->prepare($sql);
        $stmt->execute([":cid" => $cid]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo "<table border='1' style='margin: 0 auto; text-align: center; border-collapse: collapse;'>";
            echo "<tr style='background: #ddd;'>";
            echo "<th>Cid</th>";
            echo "<th>CName</th>";
            echo "<th>Email</th>";
            echo "<th>Age</th>";
            echo "<th>City</th>";
            echo "<th>State</th>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["cid"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["cname"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["age"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["city"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["state"]) . "</td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo "Customer not found";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

</body>
</html>
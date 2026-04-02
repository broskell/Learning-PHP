<?php
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$username = 'postgres';
$password = 'Kellampalli@18';

$msg = "";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $cn = new PDO($dsn, $username, $password);
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (
        $_SERVER["REQUEST_METHOD"] == "GET" &&
        isset($_GET["cid"], $_GET["cname"], $_GET["email"], $_GET["age"], $_GET["city"], $_GET["state"])
    ) {
        $cid = $_GET["cid"];
        $cname = $_GET["cname"];
        $email = $_GET["email"];
        $age = $_GET["age"];
        $city = $_GET["city"];
        $state = $_GET["state"];

        $sql = "INSERT INTO Customers (Cid, CName, Email, Age, City, State)
                VALUES (:cid, :cname, :email, :age, :city, :state)";

        $stmt = $cn->prepare($sql);
        $stmt->execute([
            ':cid' => $cid,
            ':cname' => $cname,
            ':email' => $email,
            ':age' => $age,
            ':city' => $city,
            ':state' => $state
        ]);

        $msg = "Customer inserted successfully";
    }
    echo "<div style='text-align:center; font-weight:bold; color:green;'>$msg</div>";

    $query = "SELECT * FROM Customers";
    $data = $cn->query($query);

    $x = "<table border='1' align='center'>
            <tr>
                <th>Customers Name</th>
            </tr>";

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $x .= "<tr><td>" . $row["cname"] . "</td></tr>";
    }

    $x .= "</table>";
    echo $x;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
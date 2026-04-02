<?php
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$username = 'postgres';
$password = 'Kellampalli@18';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $cn = new PDO($dsn, $username, $password);
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM Customers";
    $data = $cn->query($query);

    echo "<table border='1' align='center'>";
    echo "<tr>
            <th>Cid</th>
            <th>CName</th>
            <th>Email</th>
            <th>Age</th>
            <th>City</th>
            <th>State</th>
          </tr>";

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["cid"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["cname"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["age"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["city"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["state"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
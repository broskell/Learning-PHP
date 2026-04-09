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

        $msg = "✅ Customer added successfully!";
    }
    
    if ($msg) {
        echo "<div style='text-align:center; font-weight:bold; color:green; background:#d4edda; padding:15px; margin:20px; border-radius:5px; border:1px solid #c3e6cb;'>$msg</div>";
    }

    $query = "SELECT * FROM Customers ORDER BY Cid DESC";
    $data = $cn->query($query);

    echo "<h3 style='text-align:center; margin-top:40px;'>All Customers</h3>";
    echo "<div style='overflow-x:auto;'><table border='1' align='center' style='width:100%; border-collapse:collapse; margin-top:20px;'>
            <tr style='background:#007cba; color:white;'>
                <th style='padding:12px;'>ID</th>
                <th style='padding:12px;'>Name</th>
                <th style='padding:12px;'>Email</th>
                <th style='padding:12px;'>Age</th>
                <th style='padding:12px;'>City</th>
                <th style='padding:12px;'>State</th>
            </tr>";

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr style='border-bottom:1px solid #eee;'>
                <td style='padding:12px; text-align:center;'>{$row["Cid"]}</td>
                <td style='padding:12px;'>{$row["CName"]}</td>
                <td style='padding:12px;'>{$row["Email"]}</td>
                <td style='padding:12px; text-align:center;'>{$row["Age"]}</td>
                <td style='padding:12px;'>{$row["City"]}</td>
                <td style='padding:12px;'>{$row["State"]}</td>
              </tr>";
    }

    echo "</table></div>";

} catch (PDOException $e) {
    echo "<div style='text-align:center; color:red; padding:20px; background:#f8d7da; border:1px solid #f5c6cb; border-radius:5px; margin:20px;'>";
    echo "Error: " . $e->getMessage();
    echo "</div>";
}
?>
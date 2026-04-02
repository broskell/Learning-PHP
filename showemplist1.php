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

    $query = "SELECT * FROM EMP";
    $data = $cn->query($query);

    $x = "<table>
            <tr>
                <th>empno</th>
            </tr>";

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $x .= "<tr><td>" . $row["empno"] . "</td></tr>";
    }

    $x .= "</table>";
    echo $x;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
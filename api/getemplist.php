<?php
header('Content-Type: application/json');

$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$username = 'postgres';
$password = 'Kellampalli@18';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $cn = new PDO($dsn, $username, $password);
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM emp";
    $stmt = $cn->prepare($query);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
?>
<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $idno = $_POST["idno"] ?? "";
        $password = $_POST["password"] ?? "";

        if ($idno === "" || $password === "") {
            echo json_encode([
                "status" => "error",
                "message" => "Missing idno or password"
            ], JSON_PRETTY_PRINT);
            exit;
        }

        $host = 'localhost';
        $port = '5432';
        $dbname = 'LeapStart';
        $username = 'postgres';
        $dbpassword = 'Kellampalli@18';

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $cn = new PDO($dsn, $username, $dbpassword);
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT IdNo, Name, Mobile, Email, Dob, Password, isActive
                FROM Candidates
                WHERE IdNo = :idno";
        $stmt = $cn->prepare($sql);
        $stmt->execute([':idno' => $idno]);

        $candidate = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$candidate) {
            echo json_encode([
                "status" => "error",
                "message" => "Candidate not found"
            ], JSON_PRETTY_PRINT);
            exit;
        }

        if ($candidate["isactive"] != true && $candidate["isactive"] != 1 && $candidate["isactive"] != 't') {
            echo json_encode([
                "status" => "error",
                "message" => "Account is inactive"
            ], JSON_PRETTY_PRINT);
            exit;
        }

        $storedPassword = $candidate["password"];

        if ($password !== $storedPassword) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid password"
            ], JSON_PRETTY_PRINT);
            exit;
        }

        unset($candidate["password"]);

        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "data" => $candidate
        ], JSON_PRETTY_PRINT);

    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ], JSON_PRETTY_PRINT);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method. Only POST is allowed."
    ], JSON_PRETTY_PRINT);
}
?>
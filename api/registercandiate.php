<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $idno = $_POST["idno"] ?? "";
        $name = $_POST["name"] ?? "";
        $mobile = $_POST["mobile"] ?? "";
        $email = $_POST["email"] ?? "";
        $dob = $_POST["dob"] ?? "";
        $password = $_POST["password"] ?? "";
        $isActive = $_POST["isActive"] ?? "";

        if (
            $idno === "" || $name === "" || $mobile === "" ||
            $email === "" || $dob === "" || $password === "" || $isActive === ""
        ) {
            echo json_encode([
                "status" => "error",
                "message" => "Missing one or more required POST parameters"
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

        $checkSql = "SELECT 1 FROM Candidates WHERE IdNo = :idno";
        $checkStmt = $cn->prepare($checkSql);
        $checkStmt->execute([':idno' => $idno]);
        $exists = $checkStmt->fetchColumn();

        if ($exists) {
            echo json_encode([
                "status" => "error",
                "message" => "IdNo already exists"
            ], JSON_PRETTY_PRINT);
            exit;
        }

        $insertSql = "INSERT INTO Candidates (IdNo, Name, Mobile, Email, Dob, Password, isActive)
                      VALUES (:idno, :name, :mobile, :email, :dob, :password, :isactive)";
        $insertStmt = $cn->prepare($insertSql);
        $insertStmt->execute([
            ':idno' => $idno,
            ':name' => $name,
            ':mobile' => $mobile,
            ':email' => $email,
            ':dob' => $dob,
            ':password' => $password,
            ':isactive' => $isActive
        ]);

        echo json_encode([
            "status" => "success",
            "message" => "Candidate inserted successfully"
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
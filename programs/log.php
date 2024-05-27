<?php
$serverName = "localhost:3307";
$userName = "";
$password = "";
$dbName = "";

try {
    $con = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error in connection: " . $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $stmt = $con->prepare("SELECT * FROM registration WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        header("Location: ./iwp.html");
        exit();
    } else {
        echo "Invalid username or password!";
    }
}
?>

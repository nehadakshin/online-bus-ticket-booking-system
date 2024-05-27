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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    try {
        $stmt = $con->prepare("INSERT INTO registration (name, email, number, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $phone);
        $stmt->bindParam(4, $user);
        $stmt->bindParam(5, $pass);
        $stmt->execute();
        
        header("Location: ./login.html");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$con = null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Form</title>
<style> 
    body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    background-image: url('final.jpg'); 
    background-size: cover;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    background-color: rgba(218, 189, 149, 0.7);
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

form {
    margin-top: 20px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"],
input[type="date"],

input[type="password"],
button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

button {
    background-color: #000305;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #010b15;
}

button:focus {
    outline: none;
    border-color: #021121;
    box-shadow: 0 0 5px rgba(1, 18, 35, 0.5);
}

</style>
</head>
<body>
    <div class="center">
        <div class="container">
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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['count']) && isset($_GET['destination']) && isset($_GET['departure'])) {
    $id = $_GET['id'];
    $count = $_GET['count'];
    $dest = $_GET['destination'];
    $dep = $_GET['departure'];
    updateBooking($id, $count,$dest,$dep);
} else {
    echo "Invalid request!";
}

function updateBooking($id, $count,$dest,$dep) {
    global $con;
    try {
        $stmt = $con->prepare("UPDATE booking SET count = count - :count WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':count', $count, PDO::PARAM_INT);
        $stmt->execute();
        echo "<b>Booking successful!</b><br><br>";
        echo"destination: $dest<br><br>";
        echo"departure: $dep<br><br>";
        echo"number of tickets: $count<br><br>";
        echo "<b>Happy Journey!!!!</b><br>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<button onclick="location.href='iwp.html'">Back</button>
 </div>
    </div>
    
</body>
</html>
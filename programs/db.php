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
    background-image: url('bus1.jpg'); /* Default background image */
    background-size: cover;
    animation: changeBackground 10s infinite; /* Animation for background image change */
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

@keyframes changeBackground {
    0% {
        background-image: url('bus1.jpg');
    }
    50% {
        background-image: url('bus2.jpg');
    }
    100% {
        background-image: url('bus3.jpg');
    }
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $dep_date = $_POST['departure_date'];
    $count = $_POST['num_tickets'];

    try {
        $stmt = $con->prepare("SELECT * FROM booking WHERE departure = :departure AND destination = :destination");
        $stmt->bindParam(':departure', $departure);
        $stmt->bindParam(':destination', $destination);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            echo "<h2>Booking Details</h2>";
            echo "<table>";
            echo "<tr><th>Departure &nbsp</th><th>Destination &nbsp</th><th>Departure Date &nbsp</th><th>Available Tickets &nbsp</th><th>Booking &nbsp</th></tr>";

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['departure'] . "</td>";
                echo "<td>" . $row['destination'] . "</td>";
                echo "<td>" . $row['dep_date'] . "</td>";
                echo "<td>" . $row['count'] . "</td>";
                echo "<td><button onclick=\"bookTicket('" . $row['id'] . "', '" . $count . "','" . $row['destination'] . "','" . $row['departure'] . "')\">Book</button></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No bookings found for the specified departure and destination.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<script>
    function bookTicket(id, count, dest, dep) {
        var confirmation = confirm("Are you sure you want to book " + count + " tickets?");
        if (confirmation) {
            window.location.href = 'book.php?id=' + id + '&count=' + count + '&destination=' + dest + '&departure=' + dep;
        }
    }
</script>




        </div>
    </div>
</body>
</html>

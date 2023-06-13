<!DOCTYPE html>

<html>

<head>

    <title>Fetching Data from Database</title>

</head>

<body>

<?php

// Database connection parameters

$servername = "localhost";

$username = "your_username";

$password = "your_password";

$dbname = "your_database_name";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

// SQL query to fetch data from the database

$sql = "SELECT * FROM your_table_name";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // Output data of each row

    while ($row = $result->fetch_assoc()) {

        echo "ID: " . $row["id"] . "<br>";

        echo "Name: " . $row["name"] . "<br>";

        echo "Email: " . $row["email"] . "<br>";

        echo "<br>";

    }

} else {

    echo "No data found.";

}

// Close the database connection

$conn->close();

?>

</body>

</html>


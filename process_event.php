<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Event</title>
</head>
<body>
    <?php
       // $events = $_GET['allEvents'];
       // echo $events;
       echo "need to figure out how to get form data";

       $myList = $_POST['addToList'];
       echo $myList;

        // Variables to set up connection
        $server = "localhost";
        $userid = "ugf8r1wb53c4a";
        $pw = "pdk3ekowisn1";
        $db = "db07ibmkhthwwd";

        // Create connection
        $conn = new mysqli($server, $userid, $pw);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Select database
        $conn->select_db($db);

        // https://phpdelusions.net/mysqli_examples/insert
        // Create and prepare query
        // $sql = "INSERT INTO `my_list`(`Name`, `Artist`, `Venue`, `Date`, `Time`, `City`, `State`, `Country`, `URL`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // $statement = $conn->prepare($sql);
        // Bind parameters and execute query
        // $statement->bind_param("sssssssss", $eventName, $artistName, $venue, $date, $localTime, $city, $state, $country, $url);
        // $statement->execute();
    ?>
</body>
</html>
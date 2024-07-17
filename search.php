<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <nav class="navbar">
        <div class="navlogo">
            <h1>Search Doctor</h1>

        </div>
        <div class="navbutton">
            <a class="navb" href="">HOME</a>
            <a class="navb" href="">ABOUT</a>
            <a class="navb" href="">CONTACT</a>
        </div>
    </nav>
    <div class="header">
        <div class="backto"><a href=""><h2>Go Back</h2></a></div>
        <div class="results"><h2>Search Results</h2></div>
    </div>
     <?php 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get form data
$city = $_POST['city'];
$department = $_POST['department'];

// Build SQL query
$sql = "SELECT * FROM doctors WHERE ";
$columns = ['city', 'specialization'];
$sql_parts = [];
foreach ($columns as $column) {
    $sql_parts[] = "$column LIKE '%$city%' OR '%$department%'";
}
$sql.= implode(' OR ', $sql_parts);

// Execute SQL query
$result = $conn->query($sql);

// Check for results
if ($result->num_rows > 0) {
    // Fetch and display results
    while ($row = $result->fetch_assoc()) {
        echo '<div class="search-results">
        <div class="card" style="height: 90%; width: 31%; display: flex;  margin: 5vh 10px; border: 1.3px solid gray; border-radius: 10px; overflow: hidden;">
            <div class="left" style="height: 100%; width: 38%; display: flex; flex-direction: column; justify-content: space-around; align-items: center">
                <div class="top" style="height: 45%; width: 90%; background-image: url(./img/hero.avif); background-repeat: no-repeat; background-size: contain; background-position: center;"></div>
                <div class="bottom" style="height: 50%; width: 100%; display: flex; flex-direction: column; justify-content: space-around; align-items: center;">
                    <div>'. $row["rating"] .' ⭐</div>
                    <div>'. $row["age"] .' Years old</div>
                    <div>Fee '. $row["fee"] .'/- Rs.</div>
                </div>
            </div>
            <div class="right" style="color: rgb(0, 0, 0); height: 100%; width: 60%; display: flex; flex-direction: column; justify-content: space-around; align-items: center;">
                <div class="details">Name :'. $row["name"] .'</div>
                <div class="details">Specialization : '. $row["specialization"] .'</div>
                <div class="details">City : '. $row["city"] .'</div>
                <div class="details">Experience : '. $row["experience"] .'</div>
                <div class="details">Nationality : '. $row["country"] .'</div>
                <div class="details">Qualification : '. $row["qualification"] .'</div>
                <div class="view" style="height: 10%; width: 80%; border-radius: 10px; background-color: rgb(0, 255, 238); display: flex; justify-content: center; align-items: center; box-shadow: 2px 2px 5px gray; border: 1.2px solid black; cursor: pointer;"><a style="text-decoration: none; color: aliceblue; text-shadow: 1px 1px 2px black;" href=""><h2>View</h2></a></div>
            </div>
        </div>';    
    }
} else {
    // No results found
    echo "<p>No results found.</p>";
}


     
    
     
     
     
     // Close connection
$conn->close();
     ?>
        
        
        
    </div>
</body>
</html>
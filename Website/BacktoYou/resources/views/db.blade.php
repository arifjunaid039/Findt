<?php
// db.php
$servername = "localhost";
$username   = "root";
$password   = ""; // agar password hai to use kar
$dbname     = "findit"; // jo database ka naam hai

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}


else{
   echo "Succesfull";
}

?>
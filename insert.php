<?php
//Establish a connection to the MYSQL database
$servername = "localhost";
$uname = "root";
$upass = "";
$dbname ="mandir";

$conn = new mysqli($servername, $uname, $upass, $dbname);

//check the connection
if ($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

//Process applicaton form

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $name = $_POST['name'];
    $address = $_POST['address']; 
    $email = $_POST['email'];
    $city = $_POST['city']; 
    $message = $_POST['message'];
    

//Protect against SQL injection

$name = mysqli_real_escape_string($conn, $name);
$address = mysqli_real_escape_string($conn, $address);
$email = mysqli_real_escape_string($conn, $email);
$city = mysqli_real_escape_string($conn, $city);
$message = mysqli_real_escape_string($conn, $message);

// Insert application data into the database

$sql = "INSERT INTO `ma`(`name`, `address`, `email`, `city`, `message`) VALUES ('$name','$address','$email','$city','$message')";

//$sql = "INSERT INTO mandir_tbl(name, address, email, city, message) VALUES ('$name','$address','$email','$city','$message')";
if ($conn->query($sql) == TRUE) {
    echo "Application submitted successfully!";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

//close the connection
$conn->close();

?>
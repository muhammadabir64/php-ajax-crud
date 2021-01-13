<?php 

require "db.php";

$name = $_POST["name"];
$email = $_POST["email"];

$insert = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
$query = mysqli_query($db, $insert);

if($query){
	echo "<p class='green-text'>New user added successfully</p>";
}else{
	echo "<p class='red-text'>There is an error!</p>";
}

?>
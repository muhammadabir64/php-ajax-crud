<?php 

require "db.php";

$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];

$update = "UPDATE users SET name='$name', email='$email' WHERE id='$id';";
$query = mysqli_query($db, $update);

if($query){
	echo "<p class='green-text'>data updated successfully</p>";
}else{
	echo "<p class='red-text'>There is an error!</p>";
}

?>
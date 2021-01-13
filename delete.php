<?php 

require "db.php";

$id = $_POST["id"];

$delete = "DELETE FROM users WHERE id={$id}";
$query = mysqli_query($db, $delete);

if($query){
	echo "<p class='green-text'>user deleted successfully</p>";
}else{
	echo "<p class='red-text'>There is an error!</p>";
}

?>
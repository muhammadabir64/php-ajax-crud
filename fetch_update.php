<?php 

require "db.php";

$id = $_POST["id"];

$query = mysqli_query($db, "SELECT * FROM users WHERE id='$id';");

$output = "";
if(mysqli_num_rows($query) > 0){
	while($row = mysqli_fetch_assoc($query)){
		$output .= "<div class='input-field'>
          <input id='edit_name' type='text' name='edit_name' class='validate' value='{$row["name"]}'>
        </div>
        <div class='input-field'>
          <input id='edit_email' type='email' name='edit_email' class='validate' value='{$row["email"]}'>
        </div>
        <input type='hidden' id='edit_id' value='{$row["id"]}'>
        <button type='submit' id='submitEdit' class='btn blue-grey darken-1'>Save</button>
        <a href='' class='btn red right'>Cancel</a>";
	}
echo $output;
}else{
	echo "<h2>There is an error!</h2>";
}

?>
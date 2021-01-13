<?php 

require "db.php";

$sql = mysqli_query($db, "SELECT * FROM users");
$output = "<table class='highlight'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>";

if(mysqli_num_rows($sql) > 0){
while($row = mysqli_fetch_assoc($sql)){
$output .= "<tr>
	<td>{$row["id"]}</td>
	<td>{$row["name"]}</td>
	<td>{$row["email"]}</td>
	<td>
	<a href='#editModal' class='btn modal-trigger blue lighten-1' id='editBtn' data-eid='{$row["id"]}'>Edit</a>

	<button class='btn red lighten-1' id='deleteBtn' data-did='{$row["id"]}'>Delete</button>
	</td>
</tr>";
		}
}else{
$output .= "<tr>
				<td>no data available!</td>
			</tr>";
}

$output .= "</tbody>
		</table>";

echo $output;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP & AJAX CRUD</title>
	<link rel="stylesheet" href="resources/materialize.min.css">
</head>
<body>
<div class="container">
<div class="row" style="margin-top: 2rem;">

<!-------MODAL: add form btn----->
<div class="right">
<a class="btn modal-trigger orange darken-1" href="#addModal">Add New</a>
</div>
<!-------table :START----->
	<div id="table_data" class="col s12">
		<!--data fetch from php-->
	</div>
<!-------table :END--------->
<!-------MODAL: add form :START--------->
<div id="addModal" class="modal">
    <div class="modal-content">
    	<form id="addForm">
    	<div class="input-field">
          <input id="name" type="text" name="name" class="validate" required>
          <label for="name">Name</label>
        </div>
        <div class="input-field">
          <input id="email" type="email" name="email" class="validate" required>
          <label for="email">Email</label>
        </div>

        <button type="submit" id="addBtn" class="btn  green darken-2">Add</button>
        <a href="" class="btn red right">Cancel</a>
    	</form>
  </div>
  </div>
<!-------MODAL: add form :END--------->
<!-------MODAL: edit form :START--------->
	<div id='editModal' class='modal'>
    <div class='modal-content'>
    	<form id='editForm'>
<!--data fetch from php-->
    	</form>
  </div>
  </div>
<!-------MODAL: edit form :END--------->
<div id="response"></div> 
</div><!--row-->
</div><!--container-->

<script src="resources/jquery.min.js"></script>
<script src="resources/materialize.min.js"></script>
<script>
$(document).ready(function(){
//add: modal form validate
$("#addModal").modal();
$("#editModal").modal();

$("#addBtn").attr("disabled", true);
$("#name, #email").keyup(function(){
	if($(this).val().length != 0){
		$("#addBtn").attr("disabled", false);
	}else{
		$("#addBtn").attr("disabled", true);
	}
});

//fetch
function load_data(){
	$.ajax({
		url: "fetch.php",
		type: "POST",
		success: function(data){
			$("#table_data").html(data);
		}
	});
}
load_data();

//insert
$("#addForm").submit(function(a){
	a.preventDefault();
	$.ajax({
		url: "add.php",
		type: "POST",
		data: $(this).serialize(),
		success: function(data){
			$("#addForm").trigger("reset");
			setTimeout(function(){
				$("#addModal").modal();
			}, 250);
			load_data();
			$("#response").html(data);
			setTimeout(function(){
				$("#response").hide();
			}, 1500);
		}
	});
});

//delete
$(document).on("click", "#deleteBtn", function(){
	if(confirm("Do you really want to delete this record ?")){
		let deleteID = $(this).data("did");

		$.ajax({
			url: "delete.php",
			type: "POST",
			data: {id: deleteID},
			success: function(data){
				load_data();
				$("#response").html(data);
				setTimeout(function(){
					$("#response").fadeOut();
				}, 1500);
			}
		});
	}
});

//update
$(document).on("click", "#editBtn", function(){
	let editID = $(this).data("eid");

	$.ajax({
		url: "fetch_update.php",
		type: "POST",
		data: {id: editID},
		success: function(data){
			$("#editForm").html(data);
		}
	});
});

$(document).on("click", "#submitEdit", function(e){
	e.preventDefault();
let edit_id = $("#edit_id").val();
let edit_name = $("#edit_name").val();
let edit_email = $("#edit_email").val();
$.ajax({
	url: "update.php",
	type: "POST",
	data: {id:edit_id, name:edit_name, email:edit_email},
	success:function(data){
		$("#editForm").trigger("reset");
		setTimeout(function(){
			$("#editModal").modal();
		}, 250);
		load_data();
		$("#response").html(data);
		setTimeout(function(){
			$("#response").hide();
		}, 1500);
	}
});
});


});
</script>
</body>
</html>
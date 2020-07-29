<!DOCTYPE html>
<html>
	<head>
		<title>SWAPI</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">SWAPI</h3>
			<br />

			<div class="table-responsive">
				<table id="table" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Gender</th>
							<th>Birth Year</th>
							<th></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="infoModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title" id="idInfo"></h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Eye Color</label>
			        	<input type="text" name="EyeColor" id="EyeColor" class="form-control" readonly />
			        </div>
			        <div class="form-group">
			        	<label>Hair Color</label>
			        	<input type="text" name="HairColor" id="HairColor" class="form-control" readonly />
					</div>
					<div class="form-group">
			        	<label>Height</label>
			        	<input type="text" name="Height" id="Height" class="form-control" readonly />
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>

<div id="editModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="formEdit">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title" id="idEdit"></h4>
		      	</div>
		      	<div class="modal-body">
				  <div class="form-group">
			        	<label>Name</label>
			        	<input type="text" name="NameEdit" id="NameEdit" class="form-control" />
			        	<input type="hidden" name="Nome" id="Nome" class="form-control" />
					</div>
					<div class="form-group">
			        	<label>Gender</label>
			        	<input type="text" name="GenderEdit" id="GenderEdit" class="form-control" />
					</div>
					<div class="form-group">
			        	<label>Birth Year</label>
			        	<input type="text" name="BYEdit" id="BYEdit" class="form-control" />
			        </div>
		      		<div class="form-group">
			        	<label>Eye Color</label>
			        	<input type="text" name="EyeColorEdit" id="EyeColorEdit" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Hair Color</label>
			        	<input type="text" name="HairColorEdit" id="HairColorEdit" class="form-control" />
					</div>
					<div class="form-group">
			        	<label>Height</label>
			        	<input type="text" name="HeightEdit" id="HeightEdit" class="form-control" />
			        </div>
			    </div>
			    <div class="modal-footer">
					<button type="submit" class="btn btn-info">Save</button>
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" name="formDelete" id="formDelete">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title" id="idDelete"></h4>
		      	</div>
		      	<div class="modal-body">
				  <div class="form-group">
			        	<label>Removing</label>
			        	<input type="text" name="name" id="name" class="form-control" readonly />
			        	<input type="hidden" name="remove" id="removing" value="removing" class="form-control" readonly />
					</div>
			    </div>
			    <div class="modal-footer">
					<button type="submit" class="btn btn-danger">Delete</button>
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$('#formEdit').submit(function(e){
	e.preventDefault();
	$.ajax({
		url: 'fetch.php',
		type: 'post',
		dataType: 'json',
		data: $('#formEdit').serialize(),
		success: function(response) 
		{
			alert(response[1]);
			if (response[0] == 'success') {
				setTimeout(function () {
					location.reload();
				}, 1000);
			}
		}
	});
});

$('#formDelete').submit(function(e){
	e.preventDefault();
	$.ajax({
		url: 'fetch.php',
		type: 'post',
		dataType: 'json',
		data: $('#formDelete').serialize(),
		success: function(response) 
		{
			alert(response[1]);
			if (response[0] == 'success') {
				setTimeout(function () {
					location.reload();
				}, 1000);
			}
		}
	});
});

$(document).ready(function(){

	fetch_data();

	function fetch_data()
	{
		$.ajax({
			url:"fetch.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$(document).on('click', '.info', function(){
		
		var id = $(this).data("id");
		var name = $(this).data("name");
		var eye = $(this).data("eye");
		var hair = $(this).data("hair");
		var height = $(this).data("height");

		var idInfo = 'Info about ' + name;

		$('#idInfo').html(idInfo);
		$('#EyeColor').val(eye);
		$('#HairColor').val(hair);
		$('#Height').val(height);
		$('#infoModal').modal('show');
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).data("id");
		var nome = $(this).data("nome");
		var name = $(this).data("name");
		var gender = $(this).data("gender");
		var by = $(this).data("by");
		var eye = $(this).data("eye");
		var hair = $(this).data("hair");
		var height = $(this).data("height");

		var idInfo = 'Editing information from ' + name;

		$('#idEdit').html(idInfo);
		$('#Nome').val(nome);
		$('#NameEdit').val(name);
		$('#GenderEdit').val(gender);
		$('#BYEdit').val(by);
		$('#EyeColorEdit').val(eye);
		$('#HairColorEdit').val(hair);
		$('#HeightEdit').val(height);
		$('#editModal').modal('show');
	});

	$(document).on('click', '.remove', function(){
		var id = $(this).data("id");

		var idDelete = 'Are you sure?';

		$('#idDelete').html(idDelete);
		$('#Nome').val(id);
		$('#name').val(id);
		$('#deleteModal').modal('show');
	});

});
</script>
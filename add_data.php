<?php
	require_once 'inc/conn.php';
	include_once 'links.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>PDO || CRUD || Add Data</title>
</head>
<body>
<br><br>
<div class="container">
  <a href="index.php" class="btn btn-info">HOME</a>
  <div class="jumbotron">
<center>
  	<h3>PDO || CRUD</h3>
  	<hr>
  	<br>
  	<h4><u>Add Data</u></h4>
  	<br>

  	<div class="col-8">
  	    <form class="form" method="post">
	  	   <input type="text" name="id" class="form-control" placeholder="ID" required><br>
	  	   <input type="text" name="name" class="form-control" placeholder="Name" required><br>
	  	   <input type="text" name="marks" class="form-control" placeholder="Marks" required><br>
	  	   <input type="text" name="city" class="form-control" placeholder="City"><br>

	  	   <input type="submit" name="insert" value="Submit" class="btn btn-success">
	  	   <a href="index.php" class="btn btn-danger">Cancel</a>
	  	</form>
  	</div>

</center>	
  </div>
</div>

</body>
</html>


<?php 

	if (isset($_POST['insert'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$marks = $_POST['marks'];
		$city = $_POST['city'];

		$query = " INSERT INTO pdo_grid (id,name,marks,city) VALUES ('$id','$name','$marks','$city') ";
		$stmt = $conn->prepare($query);
		$result = $stmt->execute();
		
		if ($result) {
			echo '
					<script>
						alert("Data Inserted");
						window.location="index.php";
					</script>
				  ';
		}else{
			echo '
					<script>
						alert("Data Not Inserted");
					</script>
				  ';
		}
	}

?>
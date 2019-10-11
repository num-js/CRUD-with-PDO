<?php 
	require_once 'inc/conn.php';
	include_once 'links.php';
?>


<br><br>
<div align="center" class="container">
  <div class="col-lg-8">
  	<div class="jumbotron">
  	  <h3><u>CRUD || PDO</u></h3>
  	  <h5>ADD Record</h5>
	  <form method="post" class="form">
	   <input type="text" name="id" class="form-control" placeholder="Roll No"><br>
	   <input type="text" name="name" class="form-control" placeholder="Name"><br>
	   <input type="text" name="marks" class="form-control" placeholder="Marks"><br>
	   <input type="text" name="city" class="form-control" placeholder="City"><br>
	   <input type="submit" name="insert" value="Submit" class="btn btn-primary">
	   <a href="index.php" class="btn btn-danger">Cancel</a>
	  </form>
	</div>
  </div>
</div>

<?php 
	if (isset($_POST['insert'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$marks = $_POST['marks'];
		$city = $_POST['city'];

		$query = "INSERT INTO pdo_grid (id,name,marks,city) VALUES ('$id','$name','$marks','$city') ";
		$stmt = $conn->prepare($query);
		$result = $stmt->execute();

		if ($result) {
			echo '
				<script>
				  alert("Data Inserted...");
				  window.location = "index.php";
				</script>
				';
		}else{
			echo '
				<script>
				  alert("Data Not Inserted...");
				</script>
				';
		}
	}
?>


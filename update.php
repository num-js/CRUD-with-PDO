<?php 
	require_once 'inc/conn.php';
	include_once 'links.php';

	$m_id = $_GET['id'];

	$query = "SELECT * FROM pdo_grid WHERE id='$m_id' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>


<br><br>
<div align="center" class="container">
  <div class="col-lg-8">
  	<div class="jumbotron">
  	  <h3><u>CRUD || PDO</u></h3>
  	  <h5>Update Record</h5>
	  <form method="post" class="form">
	   <input type="text" name="id" value="<?php echo $row[0]['id']; ?>" class="form-control" placeholder="Roll No"><br>
	   <input type="text" name="name" value="<?php echo $row[0]['name']; ?>" class="form-control" placeholder="Name"><br>
	   <input type="text" name="marks" value="<?php echo $row[0]['marks']; ?>" class="form-control" placeholder="Marks"><br>
	   <input type="text" name="city" value="<?php echo $row[0]['city']; ?>" class="form-control" placeholder="City"><br>
	   <input type="submit" name="update" value="Submit" class="btn btn-primary">
	   <a href="index.php" class="btn btn-danger">Cancel</a>
	  </form>
	</div>
  </div>
</div>

<?php 
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$marks = $_POST['marks'];
		$city = $_POST['city'];

		$query = "UPDATE pdo_grid SET id='$id',name='$name',marks='$marks',city='$city' WHERE id='$id' ";
		$stmt = $conn->prepare($query);
		$result = $stmt->execute();

		if ($result) {
			echo '
				<script>
				  alert("Data Updated...");
				  window.location = "index.php";
				</script>
				';
		}else{
			echo '
				<script>
				  alert("Data Not Updated...");
				</script>
				';
		}
	}
?>


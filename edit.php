<?php
	require_once 'inc/conn.php';
	include_once 'links.php';

	$id = $_GET['id'];

	$query = "SELECT * FROM pdo_grid WHERE id='$id' ";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  	<h4><u>Update Data</u></h4>
  	<br>

  	<div class="col-8">
  	    <form class="form" method="post">
  	     <?php foreach($result as $row){ ?>
	  	   <input type="text" name="id" value="<?php echo $row['id']; ?>" class="form-control" placeholder="ID" required><br>
	  	   <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Name" required><br>
	  	   <input type="text" name="marks" value="<?php echo $row['marks']; ?>" class="form-control" placeholder="Marks" required><br>
	  	   <input type="text" name="city" value="<?php echo $row['city']; ?>" class="form-control" placeholder="City"><br>

	  	   <input type="submit" name="update" value="Submit" class="btn btn-success">
	  	   <a href="index.php" class="btn btn-danger">Cancel</a>
	  	 <?php } ?>
	  	</form>
  	</div>

</center>	
  </div>
</div>

</body>
</html>


<?php 

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$marks = $_POST['marks'];
		$city = $_POST['city'];

		$query = " UPDATE pdo_grid SET id='$id',name='$name',marks='$marks',city='$city' WHERE id='$id' ";
		$stmt = $conn->prepare($query);
		$result = $stmt->execute();
		
		if ($result) {
			echo '
					<script>
						alert("Data Updated");
						window.location="index.php";
					</script>
				  ';
		}else{
			echo '
					<script>
						alert("Data Not Updated");
					</script>
				  ';
		}
	}

?>
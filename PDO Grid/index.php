<?php
	require_once 'inc/conn.php';
	include_once 'links.php';

	  
	$query = " SELECT * FROM pdo_grid ";
			//For Pagination
	$stmt1 = $conn->prepare($query);
	$stmt1->execute();
	$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	$total_record = count($result1);	//Total Records
	$per_page = 2;	//Per Page Show Records

	$num = floor($total_record/$per_page);
	$rem = floor($total_record%$per_page);
	if($rem>0){
		$num++;
	}



	$start=0;
	if (isset($_GET['start'])) {
		$start = $_GET['start'];
		$start=($start-1)*$per_page;
	}
			#For Search
	$search_txt = '';
	if (isset($_POST['search_txt']) && $_POST['search_txt']!='' ) {
		$search_txt = $_POST['search_txt'];
			#query for Searching String 1st Part
		$query.= " WHERE name like '%$search_txt%' or city like '%$search_txt%' ";
	}

	   #query for Searching String 2nd Part
	$query.= " ORDER BY id ASC limit $start,$per_page";

	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<br>
<br>

<div class="container">
  <div class="jumbotron">
  	<h3 align="center">PDO || CRUD</h3>
  	<hr>
  	<br>
  		<center>
  				<!-- Form for Searching Data -->
  			<form method="post" class="form">
			  <div class="col">
			  	<input type="textbox" name="search_txt" value="<?php echo $search_txt; ?>" placeholder="Search">
			  	<input type="submit" name="search" value="Search">
			  </div>
			</form>
  		</center>

  <a href="add_data.php" class="btn btn-info">Add Data</a>

  	<table class="table table-hover">
	  <tr style="background: black; color: white;">
	  	<th>Roll No.</th>
	  	<th>Name</th>
	  	<th>Marks</th>
	  	<th>City</th>
	  	<th>Action</th>
	  </tr>
	  <?php
	  	foreach ($result as $row) {
	  ?>
	  <tr>
	  	<td><?php echo $row['id']; ?></td>
	  	<td><?php echo $row['name']; ?></td>
	  	<td><?php echo $row['marks']; ?></td>
	  	<td><?php echo $row['city']; ?></td>
	  	<td>
	  		<a class="btn btn-warning" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
	  		<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
	  	</td>
	  </tr>
	 <?php
	 	}
	 ?>
	</table>
		<!-- Pagination Setup -->
	<center>
	<?php 
		for ($i=1; $i < $num; $i++) { 
			echo '<a href="index.php?start='.$i.'">'.$i.'</a> &nbsp';	//Page Nubers
		}
	?>
	</center>


  </div>
</div>
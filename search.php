
<?php
	
	require_once 'inc/conn.php';

		#Pagination
	$sql



	   #query for Searching String 1st Part
	$query = " SELECT * FROM pdo_grid ";

	$search_txt = '';
	if (isset($_POST['search_txt']) && $_POST['search_txt']!='' ) {
		$search_txt = $_POST['search_txt'];
		$query.= " WHERE name like '%$search_txt%' or city like '%$search_txt%' ";
	}

	   #query for Searching String 2nd Part
	$query.= " ORDER BY id DESC ";

	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



	<!-- Form for Searching Data -->
  			<form method="post" class="form">
			  <div class="col">
			  	<input type="textbox" name="search_txt" value="<?php echo $search_txt; ?>" placeholder="Search">
			  	<input type="submit" name="search" value="Search">
			  </div>
			</form>
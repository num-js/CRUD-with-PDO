<?php 
	require_once 'inc/conn.php';

	$id = $_GET['id'];

	$query = " DELETE FROM pdo_grid WHERE id='$id' ";
	$stmt = $conn->prepare($query);
	$result = $stmt->execute();

	if ($result) {
			echo '
					<script>
						alert("Data Deleted");
						window.location="index.php";
					</script>
				  ';
		}else{
			echo '
					<script>
						alert("Data Not Deleted");
						window.location="index.php";
					</script>
				  ';
		}

?>
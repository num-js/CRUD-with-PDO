<?php 
	require_once 'inc/conn.php';
	include_once 'links.php';


	$query = "SELECT * FROM pdo_grid  ";
        
              //*** Pagination ***
          //For Total Records
  $stmt1 = $conn->prepare($query);
  $stmt1->execute();
  $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  $total_records = count($result1);
        //Per page Show Records
  $per_page = 3;
        //For Pages---
  $pages = floor($total_records/$per_page); //Pages
                    //Left Recors for Last PAge
  $left_records = floor($total_records%$per_page);  
                    //If Record Left then Add a Page
  if ($left_records > 0) {
      $pages++;
  }

  $start = 0;
  if (isset($_GET['start'])) {
      $start = $_GET['start'];
      $start = ($start-1)*$per_page;
  }
  $query.=" LIMIT  $start,$per_page";    


  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

              #Searching
  if (isset($_POST['search_txt']) && ($_POST['search_txt']!='')) {
      $search_txt = $_POST['search_txt'];
      $query = "SELECT * FROM pdo_grid WHERE name like '%$search_txt%' OR city like '%$search_txt%' ";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);      
  }

?>


<br><br>
<div align="center" class="container">
  <div class="col-lg-8">
  	<div class="jumbotron">
  		<a href="add_record.php" class="btn btn-info" style="float:right;">ADD Record</a>
  		<h3>CRUD || PDO</h3>
      <hr>
  		<br>
              <!-- Searching Form -->
      <form method="post">
        <input type="text" name="search_txt" placeholder="Search" value="<?php if(isset($_POST['search_txt'])){echo $_POST['search_txt'];} ?>">
        <input type="submit" name="search_btn" value="Search">
      </form>


  		<table class="table table-hover">
  		   <tr align="center" style="color: white; background: black;">
  		   	 <th>Roll No</th>
  		   	 <th>Name</th>
  		   	 <th>Marks</th>
  		   	 <th>City</th>
  		   	 <th>Action</th>
  		   </tr>
  			
  			<?php foreach ($result as $row) { ?>
  		   <tr align="center">
  		   	 <td><?php echo $row['id']; ?></td>
  		   	 <td><?php echo $row['name']; ?></td>
  		   	 <td><?php echo $row['marks']; ?></td>
  		   	 <td><?php echo $row['city']; ?></td>
  		   	 <td>
  		   	 	<a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-warning">E</a>
  		   	 	<a href="" class="btn btn-danger">D</a>
  		   	 </td>
  		   </tr>
	  		<?php } ?>

  		</table>
      <br>

            <!-- Pagination Setup -->
     <?php 
          for ($i=1; $i <= $pages; $i++) { 
            echo '
                  <a class="btn btn-dark" href="index.php?start='.$i.'">'.$i.' </a>&nbsp;&nbsp;
                ';
          }
     ?>
  	</div>
  </div>
</div>
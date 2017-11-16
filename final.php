<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();
 ?>
<div class="main">
<h1>You have done !</h1>

<div class="starttest">
  	 <p>Congratulatons ! Your exam have finished</p>
  	 <p>Final Score:
	  	 <?php 
	  	 	if (isset($_SESSION['score'])) {
	  	 		echo "<span class='success'>Right Ans:</span>";
	  	 		echo $_SESSION['score'];
	  	 		unset($_SESSION['score']);
	  	 	}
	  	  ?>
	  	  <?php 
	  	 	if (isset($_SESSION['wscore'])) {
	  	 		echo "<span class='error'>Wrong Ans:</span>";
	  	 		echo $_SESSION['wscore'];
	  	 		unset($_SESSION['wscore']);
	  	 	}
	  	  ?>
  	 </p>
  	 <a href="viewans.php">View Ans</a>
  	 <a href="starttest.php">Start Again</a>
  </div>

	
  </div>
<?php include 'inc/footer.php'; ?>
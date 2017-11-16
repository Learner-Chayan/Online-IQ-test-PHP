<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();

	$userId     = Session::get("userId");
 ?>
   <div class="head">
    <span>Your Profile - Update here</span>
   </div>
<div class="main">
	  <?php 
	  		if ($_SERVER['REQUEST_METHOD']=='POST') {
	  			$updateUserData = $usr->updateUserData($userId,$_POST);
	  			if (isset($updateUserData)) {
	  				echo $updateUserData;
	  			}
	  		}
	   ?>
       <?php 
       		$userData = $usr->getUserDataById($userId);
       		if ($userData) {
                 $result = $userData->fetch_assoc() 
       				
        ?>
		<form action="" method="POST">
				<table>
				<tr>
		           <td>Name</td>
		           <td><input type="text" name="name" value="<?php echo $result['name'] ?>" ></td>
		         </tr>
			       <tr>
		           <td>Username</td>
		           <td><input name="username" value="<?php echo $result['username'] ?>" type="text" ></td>
		         </tr>     
		         <tr> 
		           <td>E-mail</td>
		           <td><input  type="text" value="<?php echo $result['email'] ?>" name="email" ></td>
		         </tr>
		         <tr>
		           <td></td>
		           <td><input type="submit"  value="Update">
		           </td>
		         </tr>
		       </table>
			</form>
			  <?php } ?>
	
</div>
<?php include 'inc/footer.php'; ?>

<style>
.head {
	font-size: 25px;
	border-bottom: 1px solid #ffffff;
	width: 350px;
}
form{
border: 1px solid #ddd;
color: #8fa9a2;
margin-left: 168px;
margin-top: 50px;
width: 500px;
padding: 10px;
}
</style>
<?php 
   // $filepath = realpath(dirname(__FILE__));
	include_once ('inc/loginheader.php');
	include_once ('../classes/admin.php');
	$ad = new Admin();
?>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$adminData = $ad->getAdminData($_POST);
	}
 ?>
<div class="main">
<h1>Admin Login</h1>
<div class="adminlogin">
	<form action="" method="POST">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" required="" name="adminUser"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" required="" name="adminPass"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login"/></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php 
						if (isset($adminData)) {
							echo $adminData;
						}
					 ?>
				</td>
				
			</tr>
		</table>
	</from>
</div>
</div>
<?php include 'inc/footer.php'; ?>
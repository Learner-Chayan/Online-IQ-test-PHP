<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/user.php');

	$usr = new User(); 

?>
<div class="main">
  <h1>Admin -- manage user</h1>
   <?php 
   		if (isset($_GET['disId'])) {
   			$disId = (int)$_GET['disId'];
   			$Disable = $usr->DisableUser($disId);
   			if ($Disable) {
   				echo "<span class='success'>User Disabled</span>";
   			}else{
   				echo "<span class='error'>error .. user not  Disabled</span>";
   			}
   		}
    ?>
    <?php 
   		if (isset($_GET['enaId'])) {
   			$enaId = (int)$_GET['enaId'];
   			$enable = $usr->EnableUser($enaId);
   			if ($enable) {
   				echo "<span class='success'>User Enabled</span>";
   			}else{
   				echo "<span class='error'>error .. user not  Enabled</span>";
   			}
   		}
    ?>
     <?php 
   		if (isset($_GET['delId'])) {
   			$delId = (int)$_GET['delId'];
   			$delete = $usr->DeleteUser($delId);
   			if ($delete) {
   				echo "<span class='success'>User Deleted success</span>";
   			}else{
   				echo "<span class='error'>error .. user not  Delete</span>";
   			}
   		}
    ?>

	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th>SL</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			<?php 
				$userData = $usr->getUserData();
				if ($userData) {
					$i=0;
					while ($result = $userData->fetch_assoc()) {
					$i++;	
			 ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td>
					<?php if ($result['status'] =='0') {?>
						<span><?php echo $result['name'] ?></span>
					<?php } else{ ?>
						<span class='error'><?php echo $result['name'] ?></span>
					<?php } ?>
					
				</td>
				<td><?php echo $result['username'] ?></td>
				<td><?php echo $result['email'] ?></td>
				<td>
					<a onclick="return confirm('Are you sure to Remove')" href="?delId=<?php echo $result['userId'] ?>">Remove</a>

				   <?php 
				   		if ($result['status'] =='0') {
				    ?> 

					||<a onclick="return confirm('Are you sure to Disable')" href="?disId=<?php echo $result['userId'] ?>">Disable</a>
					<?php }else{ ?>
					||<a onclick="return confirm('Are you sure to Enable')" href="?enaId=<?php echo $result['userId'] ?>">Enable</a>
					<?php } ?>
				</td>
			</tr>
			<?php }} ?>
		</table>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
?>

<div class="main">
<h1>Admin Panel</h1>
 <div class="adminpanel">
	 <h2>Welcome to Admin Panel</h2>
	 <p>You can manage your user and online exam system from here</p>
 </div>


	
</div>
<?php include 'inc/footer.php'; ?>

<style>
	.adminpanel{
		margin: 50px auto 0;
		width: 600px;
		height: 199px;
		border: 1px solid #ddd;
	}
	.adminpanel h2{
		color: goldenrod;
		font-family: times new roman;
		font-size: 35px;
		margin-top: 44px;
		text-align: center;
	}
	.adminpanel p{
		color: #555555;
		font-family: icon;
		font-size: 22px;
		margin-top: 10px;
		text-align: center;
	}
</style>
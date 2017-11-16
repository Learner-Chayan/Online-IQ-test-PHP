<?php 
	    $filepath = realpath(dirname(__FILE__));
	    include_once ($filepath.'/classes/user.php');
	    $usr = new User();


		
	    $email    = $_POST['email'];
	    $password = $_POST['password'];
	    
	    $userregi = $usr->userLogin($email,$password);

 ?>
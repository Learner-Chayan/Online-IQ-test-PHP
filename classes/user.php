<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 

	class User {

		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function userRegistration($name,$username,$password,$email){
			$name     = $this->fm->validation($name);
			$username = $this->fm->validation($username);
			$password = $this->fm->validation($password);
			$email    = $this->fm->validation($email);


			$name     = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$email    = mysqli_real_escape_string($this->db->link, $email);

			if ($name =="" || $username=="" || $password =="" || $email=="") {
				echo  "<span class='error'>Field must not be empty</span>";
				exit();
			}elseif (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
				echo  "<span class='error'>Ivalid email address</span>";
				exit();
			}else{
				$chkquery = "SELECT * FROM tbl_user WHERE email ='$email'";
				$chkresult = $this->db->select($chkquery);
				if ($chkresult !=false) {
					echo  "<span class='error'> email address already exit!</span>";
				    exit();
				}else{
					$password = mysqli_real_escape_string($this->db->link, md5($password));
					$query ="INSERT INTO tbl_user(`name`,`username`,`password`,`email`) 
					VALUES('$name','$username','$password','$email')";
			          $insertUser =$this->db->insert($query);
			          if ($insertUser) {
			          	echo  "<span class='success'> User Registered Succesfully!</span>";
				          exit();
			          }else{
			          	echo  "<span class='error'>error.. User Register failed!</span>";
				          exit();
			          }
				}
			}

		} 

		public function getUserData(){
			$query = "SELECT * FROM tbl_user";
			$userData = $this->db->select($query);
			return $userData;
		}

		public function DisableUser($uid){
			$query = "UPDATE  tbl_user
						SET 
					status = '1'
					WHERE userId = $uid	";

			$updated_row = $this->db->update($query);
			return $updated_row;
		}

		public function EnableUser($uid){
			$query = "UPDATE  tbl_user
						SET 
					status = '0'
					WHERE userId = $uid	";

			$updated_row = $this->db->update($query);
			return $updated_row;
		}

		public function DeleteUser($uid){
			$query = "DELETE FROM tbl_user WHERE userId= $uid";
			$delete = $this->db->delete($query);
			return $delete;
		}

		public function userLogin($email,$password){
			$email    = $this->fm->validation($email);
			$password = $this->fm->validation($password);

			$email     = mysqli_real_escape_string($this->db->link, $email);
			if ($email =="" || $password=="") {
				echo  "empty";
				exit();
		   }else{
		   	    $password  = mysqli_real_escape_string($this->db->link, md5($password));
		   		$query="SELECT * FROM tbl_user WHERE email ='$email' AND password ='$password'";
				$result = $this->db->select($query);
				if ($result !=false) {
					$value = $result->fetch_assoc();
					if ($value['status']=='1') {
						echo  "disable";
				        exit(); 
					}else{
						Session::init();
						Session::set("userlogin", true);
						Session::set("userId" ,$value['userId']);
						Session::set("username" ,$value['username']);
						Session::set("name" ,$value['name']);

					}
				}else{
					echo  "error";
				    exit();
				}
		   }
	    }

		public function getUserDataById($userId){
					$query = "SELECT * FROM tbl_user WHERE userId = $userId";
					$userData = $this->db->select($query);
					return $userData;
		}

         
        public function updateUserData($userId,$data){
        	$name     = $this->fm->validation($data['name']);
			$username = $this->fm->validation($data['username']);
			$email    = $this->fm->validation($data['email']);


			$name     = mysqli_real_escape_string($this->db->link, $name);
			$username = mysqli_real_escape_string($this->db->link, $username);
			$email    = mysqli_real_escape_string($this->db->link, $email);

			if ($name =="" || $username=="" ||$email=="") {
				$msg = "<span class='error'>Field must not be empty</span>";
				return $msg;
			}elseif (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
				$msg =  "<span class='error'>Ivalid email address</span>";
				return $msg;
			}else{
				$query = "UPDATE tbl_user
							SET 
						 name     = '$name',
						 username = '$username',
						 email    = '$email'
						 WHERE userId = $userId 
				";
				$updated = $this->db->update($query);
				if ($updated) {
					$msg =  "<span class='success'>User Data Updated Succesfully</span>";
				    return $msg;
				}else{
					$msg =  "<span class='error'>error..User Data Update failed</span>";
				    return $msg;
				}
			}
        }


  }
 ?>
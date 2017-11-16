<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
	//Session::init();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 

	class Process {

		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function processData($data){
			$selectedans = $this->fm->validation($data['ans']);
			$questionNo  = $this->fm->validation($data['questionNo']);
			$selectedans = mysqli_real_escape_string($this->db->link, $selectedans);
			$questionNo  = mysqli_real_escape_string($this->db->link, $questionNo);

			$next = $questionNo+1;

 
			$total = $this->getTotal();
			$right = $this->rightAns($questionNo);

			if ($right ==  $selectedans) {
				$_SESSION['score']++;

			}else{
				$_SESSION['wscore']++;
			}
			if ( $questionNo == $total) {
				header("Location:final.php");
				exit();
			}else{
				header("Location:test.php?quesNo=".$next);
			}

		}

		private function getTotal(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this->db->select($query);

			$total = $result->num_rows;
			return $total;
		}

		private function rightAns($questionNo){
			$query = "SELECT * FROM tbl_ans WHERE questionNo='$questionNo' AND rightAns='1'";
			$rightAns = $this->db->select($query);

			if ($rightAns) {
				while ($result= $rightAns->fetch_assoc()) {
					$rightId = $result['id'];
					return $rightId;
				}
			}

			//$rightId = $rightAns['id'];
			//return $rightId;
		}

		

	}
 ?>
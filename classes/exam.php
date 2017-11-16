<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 

	class Exam {

		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
 
		public function addQuestion($data){
			$questionNo = $this->fm->validation($data['questionNo']);
			$question   = $this->fm->validation($data['question']);
			$questionNo = mysqli_real_escape_string($this->db->link, $questionNo);
			$question   = mysqli_real_escape_string($this->db->link, $question);

			$ans    = array();
			$ans[1] = $data['ans1'];
			$ans[2] = $data['ans2'];
			$ans[3] = $data['ans3'];
			$ans[4] = $data['ans4'];
			$rightAns =$data['rightAns'];

			$query ="INSERT INTO tbl_ques(`questionNo`,`question`) VALUES('$questionNo','$question')";
			$insertQues =$this->db->insert($query);
			if ($insertQues) {
				foreach ($ans as $key => $ansName) {
					if ($ansName !='') {
						if ($rightAns==$key) {
							$rquery = "INSERT INTO tbl_ans(`questionNo`,`rightAns`,`ans`)VALUES('$questionNo','1','$ansName')";
						}else{
							$rquery = "INSERT INTO tbl_ans(`questionNo`,`rightAns`,`ans`)VALUES('$questionNo','0','$ansName')";
						}
						$insertChoice =$this->db->insert($rquery);
						if ($insertChoice) {
							continue;
						}else{
							die('Error..');   
						}
					}
				}

				$msg = "<span class='success'>Question Added Successfully</span>";
				return $msg;
			}


		}
		public function getQuesByOrder(){

			$query = "SELECT * FROM tbl_ques order by questionNo asc";
			$QuesData = $this->db->select($query);
			return $QuesData;
		}

		public function DeleteQuesByNO($quesNO){
			$tables = array("tbl_ques","tbl_ans");
			foreach ($tables as $table) {
				$delquery = "DELETE FROM $table WHERE questionNo = '$quesNO'";
				$delQues = $this->db->delete($delquery);
			}
			if ($delQues) {
				$msg = "<span class='success'>Question Deleted Success</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Question Not Deleted</span>";
				return $msg;
			}
		}

		public function getTotalQues(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this->db->select($query);
			if ($result) {
				$total = $result->num_rows;
			     return $total;
			}else{
				$total = '0';
				return $total;
			}
		}

		public function getQuestion(){
			$query = "SELECT * FROM tbl_ques";
			$question = $this->db->select($query);

			if ($question) {
				$result = $question->fetch_assoc();
				return $result;
			}
		}

		public function getQuesByNumber($questionNo){
			$query = "SELECT * FROM tbl_ques WHERE questionNo=$questionNo";
			$question = $this->db->select($query);

			if ($question) {
				$result = $question->fetch_assoc();
			    return $result;
			}
			
		}

		public function getAnswere($questionNo){
			$query = "SELECT * FROM tbl_ans WHERE questionNo=$questionNo";
			$answer = $this->db->select($query);
			return $answer;

		}
	}
 ?>
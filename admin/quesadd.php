<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/exam.php');

	$exm = new Exam(); 
?>
<?php 

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$addQues = $exm->addQuestion($_POST);
	}
	//get total
	$total = $exm->getTotalQues();
	if (isset($total)) {
		$next = $total+1;
	}

 ?>
<div class="main"> 
<h1>Admin Panel - Add Question</h1>
	<?php 
		if (isset($addQues)) {
				echo $addQues;
			}
	 ?>
 <div class="adminpanel">
	 <form action="" method="POST">
	 	<table>
	 		<tr>
	 			<td>Question No</td>
	 			<td>:</td>
	 			<td>
	 				<input type="number" required="" value=
	 				<?php 
	 					if (isset($next)) {
	 					  echo $next; 
	 					}
	 				 ?>
	 				 name="questionNo">
	 			</td>
	 		</tr>
	 		<tr>
	 			<td>Question</td>
	 			<td>:</td>
	 			<td>
	 				<input type="text" required="" name="question" placeholder="Enter Question">
	 			</td>
	 		</tr>
	 		<tr>
	 			<td>Choice One</td>
	 			<td>:</td>
	 			<td>
	 				<input type="text" required="" name="ans1" placeholder="Enter choice one">
	 			</td>
	 		</tr>
	 		<tr>
	 			<td>Choice Two</td>
	 			<td>:</td>
	 			<td>
	 				<input type="text" required="" name="ans2" placeholder="Enter choice Two">
	 			</td>
	 		</tr>
	 		<tr>
	 			<td>Choice Three</td>
	 			<td>:</td>
	 			<td>
	 				<input type="text" required="" name="ans3" placeholder="Enter choice Three">
	 			</td>
	 		</tr>
	 		<tr>
	 			<td>Choice Four</td>
	 			<td>:</td>
	 			<td>
	 				<input type="text" required="" name="ans4" placeholder="Enter choice four">
	 			</td>
	 		</tr>
	 		<tr>
	 			<td>Correct No</td>
	 			<td>:</td>
	 			<td>
	 				<input type="number" required="" name="rightAns" placeholder="Enter Right Ans">
	 			</td>
	 		</tr>
	 		<tr>
	 			<td colspan="3" align="center">
	 				<input type="submit" name="submit" value="Add Question">
	 			</td>
	 		</tr>
	 	</table>
	 </form>
 </div>
</div>
<?php include 'inc/footer.php'; ?>

<style>
	.adminpanel{
		margin: 50px auto 0;
		width: 500px;
		border: 1px solid #ddd;
		padding: 60px;
		color: #444;

</style>
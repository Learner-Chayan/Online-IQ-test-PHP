<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();


	if (isset($_GET['quesNo'])) {
		$questionNo = (int)$_GET['quesNo'];
	}else{
		header("Location:index.php");
	}

	$total    = $exm->getTotalQues();
	$question = $exm->getQuesByNumber($questionNo);
 ?>

 <?php 
 	if ($_SERVER['REQUEST_METHOD']=='POST') {
 		 $process = $pro->processData($_POST);
 		 if (isset($process)) {
 		 	echo $process;
 		 }
 	}
  ?>

<div class="main">
<h1>Question no <?php echo $question['questionNo']; ?> of <?php echo $total ?></h1>
	<div class="test"> 
		<form action="" method="POST">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question['questionNo']; ?> : <?php echo $question['question'] ?></h3>
				</td>
			</tr>
			<?php 
				$answere = $exm->getAnswere($questionNo);
				if ($answere) {
					while ($result= $answere->fetch_assoc()) {
					
			 ?>
			<tr>
				<td>
				 <input type="radio" name="ans" value="<?php echo $result['id'] ?>" /><?php echo $result['ans'] ?>
				</td>
			</tr>
             <?php }} ?>
			<tr>
			  <td>
				<input type="submit" name="submit" value="Next Question"/>
				<input type="hidden" name="questionNo" value="<?php echo $question['questionNo']?>" />
			</td>
			</tr>
		</table>
		</form>
</div>
 </div>
<?php include 'inc/footer.php'; ?>
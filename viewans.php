<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();


	$total    = $exm->getTotalQues();
 ?>

<div class="main">
<h1> All Question & Ans: <?php echo $total ?></h1>
	<div class="test"> 
		<table> 
  <?php
		$getQues=$exm->getQuesByOrder();
		if ($getQues) {
			while ( $question = $getQues->fetch_assoc()) {
			

   ?>
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question['questionNo']; ?> : <?php echo $question['question'] ?></h3>
				</td>
			</tr>
			<?php 
			    $questionNo = $question['questionNo'];
				$answere = $exm->getAnswere($questionNo);
				if ($answere) {
					while ($result= $answere->fetch_assoc()) {
					
			 ?>
			<tr>
				<td>
				 <input type="radio"/>
				   <?php
				     if ($result['rightAns']=='1') {
				     	 echo "<span style='color:green'>".$result['ans']."</span>";
				     }else{
				      echo $result['ans'];
				     }
				    ?>
				</td>
			</tr>
             <?php }} ?>
            <?php }} ?>
		</table>
		<div class="starttest"><a href="starttest.php">Start Again</a></div>
</div>
 </div>
<?php include 'inc/footer.php'; ?>
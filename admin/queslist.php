<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/exam.php');

	$exm = new Exam(); 

?>
<div class="main">
  <h1>Question List</h1>
   <?php 
   		if (isset($_GET['quesId'])) {
   			$quesNo = (int)$_GET['quesId'];
   			$delete = $exm->DeleteQuesByNO($quesNo);

   			if (isset($delete)) {
   				echo $delete;
   			}

   		}
    ?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th width="10%">SL</th>
				<th width="70%">Question</th>
				<th width="20%">Action</th>
			</tr>
			<?php 
			
				$QuesData = $exm->getQuesByOrder();
				if ($QuesData) {
					$i=0;
					while ($result = $QuesData->fetch_assoc()) {
					$i++; 	
			 ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $result['question'] ?></td>
				<td>
					<a onclick="return confirm('Are you sure to Remove')" 
					href="?quesId=<?php echo $result['questionNo'] ?>">Remove</a>
				</td>
			</tr>
			<?php }} ?>
		</table>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
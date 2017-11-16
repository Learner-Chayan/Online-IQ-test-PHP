<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();

	$question = $exm ->getQuestion();
	$total    = $exm->getTotalQues();
 ?>
<div class="main">
<h1>Welcome to Online Exam - Start Now</h1>
 
  <div class="starttest">
  	<h2>Test Your Knowledge</h2>
  	 <p>Multiple Choice... To Test Your Knowledge</p>
  	 <ul>
  	 	<li><strong>Number of Question</strong> <?php echo $total ?></li>
  	 	<li><strong>Question type</strong> Multiple Choice</li>
  	 </ul>
     <?php if ($total>0) {?>
  	 <a href="test.php?quesNo=<?php echo $question['questionNo'] ?>">Start Test</a>
      <?php  }else{ ?>
        <a href="#">Exam Impossible</a>
        <?php } ?>
  </div>
	
  </div>
<?php include 'inc/footer.php'; ?>
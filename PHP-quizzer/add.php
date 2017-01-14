<?php include 'database.php'; ?>
<?php
	if(isset($_POST['submit'])){
		//Get the post variables
		$question_number=$_POST['question_number'];
		$question_text=$_POST['question_text'];
		//choices array
		$choices=array();
		$choices[1]=$_POST['choice1'];
		$choices[2]=$_POST['choice2'];
		$choices[3]=$_POST['choice3'];
		$choices[4]=$_POST['choice4'];

		$correct_choice=$_POST['correct_choice'];

		//Question query
		$query="INSERT INTO questions (question_number,text) VALUES('$question_number','$question_text')";

		//Run question query
		$insert_row=$mysqli->query($query) or die($mysqli->error);

		//Validate insert
		if($insert_row){
			foreach($choices as $choice=>$value){
				if($value!=''){
					if($correct_choice==$choice){
						$is_correct=1;
					}else{
						$is_correct=0;
					}
					//choice query
					$query="INSERT INTO choices (question_number,is_correct,text) VALUES ('$question_number','$is_correct','$value')";

					//run query
					$insert_row=$mysqli->query($query) or die($mysqli->error()._LINE_);

					//Validate insert
					if($insert_row){
						continue;
					}else{
						die('Error :('.$mysqli->errno.')'.$mysqli->error);
					}
				}
			}
			$msg='Question is added';
		}
	} 
	//Get the query
	$query1="SELECT * FROM questions";

	//Get result
	$results=$mysqli->query($query1) or die($mysqli->error._LINE_);

	//Get total number of questions
	$total=$results->num_rows;
	$next=$total+1;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>PHP Quizzer</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
	</head>

	<body>
		<header>
			<div class="container">
				<h1>PHP Quizzer</h1>
			</div>
		</header>

		<main>
			<div class="container">
				<h2>Add a Question</h2>
				<?php if(isset($msg)){
					echo '<p>'.$msg.'</p>';
					} 
				?>
				<form method="post" action="add.php">
					<p>
						<label>Question Number:</label>
						<input type="Number" value="<?php echo $next; ?>" name="question_number"/>
					</p>
					<p>
						<label>Question Text:</label>
						<input type="Text" name="question_text"/>
					</p>
					<p>
						<label>Choice #1:</label>
						<input type="text" name="choice1"/>
					</p>
					<p>
						<label>Choice #2:</label>
						<input type="text" name="choice2"/>
					</p>
					<p>
						<label>Choice #3:</label>
						<input type="text" name="choice3"/>
					</p>
					<p>
						<label>Choice #4:</label>
						<input type="text" name="choice4"/>
					</p>
					<p>
						<label>Correct choice number:</label>
						<input type="number" name="correct_choice"/>
					</p>
					<p>
						<input type="submit" name="submit" value="submit" />
					</p>
				</form>
			</div>
		</main>

		<footer>
			<div class="container">
				Copyright&copy;2016 PHP Quizzer
			</div>
		</footer>
	</body>
</html>
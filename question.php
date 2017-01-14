<?php include 'database.php'; ?>
<?php session_start(); ?>
<?php
	//set question number
	$number=(int) $_GET['n'];

	//Get Question
	$query="SELECT * FROM questions WHERE question_number=$number";

	//Get result
	$result=$mysqli->query($query) or die($mysqli->error._LINE_);

	$question=$result->fetch_assoc();

	//Get Choices
	$query="SELECT * FROM choices WHERE question_number=$number";

	//Get results
	$choices=$mysqli->query($query) or die($mysqli->error._LINE_);

	//Get the query
	$query1="SELECT * FROM questions";

	//Get result
	$results=$mysqli->query($query1) or die($mysqli->error._LINE_);

	//Get total number of questions
	$total=$results->num_rows;
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
				<div class="current">Question <?php echo $number; ?> of <?php echo $total; ?></div>
				<p class="question">
					<?php echo $question['text']; ?>
				</p>
				<form method="post" action="process.php">
					<ul class="choices">
						<?php while($row=$choices->fetch_assoc()): ?>
							<li><input type="radio" name="choice" value="<?php echo $row['id']; ?>"><?php echo $row['text']; ?></li>
						<?php endwhile; ?>					
					</ul>
					<input type="submit" name="submit"/>
					<input type="hidden" name="number" value="<?php echo $number; ?>" />
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
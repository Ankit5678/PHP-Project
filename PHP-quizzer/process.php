<?php include 'database.php'; ?>
<?php session_start(); ?>
<?php

//Get the query
$query1="SELECT * FROM questions";

//Get result
$results=$mysqli->query($query1) or die($mysqli->error._LINE_);

//Get total number of questions
$total=$results->num_rows;




//check if the score is set
if(!isset($_SESSION['score'])){
	$_SESSION['score']=0;
}

if($_POST){
	$number=$_POST['number'];
	$selected_choice=$_POST['choice'];
	$next=$number+1;

	//Get correct choice
	$query="SELECT * FROM choices WHERE question_number=$number AND is_correct=1";

	//Get results
	$result=$mysqli->query($query) or die($mysqli->error()._LINE_);

	//Get row
	$row=$result->fetch_assoc();

	//Get correct answer
	$correct_answer=$row['id'];

	//compare
	if($correct_answer==$selected_choice){
		$_SESSION['score']++;
	}

	if($number==$total){
		header("Location:final.php");
		exit();
	}
	else{
		header("Location:question.php?n=".$next);
	}
}
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Cafe Quiz - Result</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />

	<!-- <meta http-equiv="refresh" content="300" > -->

</head>

<body>

	<div id="page-wrap">

		<h1>Final Quiz Results</h1>

		<hr />
		
        <?php

			require "inc/usertest.php";

			date_default_timezone_set('America/Chicago');

			// error_reporting(E_ALL);

			// Database Information

			$db = "qcafe";
			$dbUser = "root";
			$dbPass = "root";
			$dbHost = "127.0.0.1";

			// Grading time!

			$answer1 = $_POST['q1-answers'];
			$answer2 = $_POST['q2-answers'];
			$answer3 = $_POST['q3-answers'];
			$answer4 = $_POST['q4-answers'];
			$answer5 = $_POST['q5-answers'];
			$answer6 = $_POST['q6-answers'];
			$answer7 = $_POST['q7-answers'];
			$answer8 = $_POST['q8-answers'];
			$answer9 = $_POST['q9-answers'];
			$answer10 = $_POST['q10-answers'];

			$totalCorrect = 0;

			if ($answer1  == "C") { $totalCorrect++; }
			if ($answer2  == "A") { $totalCorrect++; }
			if ($answer3  == "D") { $totalCorrect++; }
			if ($answer4  == "B") { $totalCorrect++; }
			if ($answer5  == "C") { $totalCorrect++; }
			if ($answer6  == "C") { $totalCorrect++; }
			if ($answer7  == "B") { $totalCorrect++; }
			if ($answer8  == "D") { $totalCorrect++; }
			if ($answer9  == "A") { $totalCorrect++; }
			if ($answer10 == "D") { $totalCorrect++; }

			$con = mysqli_connect($dbHost, $dbUser, $dbPass, $db);

			if (!$con) {
				$noDatabase = true;
				die('Could not connect: ' . mysqli_error($con));
			}

			if (isset($_POST['q1-answers'])  && isset($_POST['q2-answers'])  && isset($_POST['q3-answers']) && isset($_POST['q4-answers']) && isset($_POST['q5-answers'])){

			$sql = 'CREATE TABLE IF NOT EXISTS `Results` (`id` int(11) NOT NULL AUTO_INCREMENT, `Agent` text NOT NULL, `Host` text NOT NULL, `Answers` text NOT NULL, `TotalCorrect` text NOT NULL, `Grade` text NOT NULL, `Time` text NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
			mysqli_query($con, $sql);
			}

			$user = strtolower($user);
			$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$hostname = strtolower($hostname);
			$answers = array_values($_POST);
			$answers = implode(",", $_POST);
			$time = date("g:ia m/d/y");
			
			$grade = $totalCorrect * 10;

			$sql = "INSERT INTO Results (Agent, Host, Answers, TotalCorrect, Grade, Time) VALUES (
			'" . mysqli_real_escape_string($con, $user) . "',
			'" . mysqli_real_escape_string($con, $hostname) . "',
			'" . mysqli_real_escape_string($con, $answers) . "',
			'" . mysqli_real_escape_string($con, $totalCorrect) . " of 10',
			'" . mysqli_real_escape_string($con, $grade) . "',
			'" . mysqli_real_escape_string($con, $time) . "'
			)";

			mysqli_query($con, $sql);

			echo "<div id='grade'>$totalCorrect / 10 correct</div>";
			echo "<div id='gMessage'>$user, your final grade is $grade%</div>";
            
        ?>
	
	</div>

</body>

</html>
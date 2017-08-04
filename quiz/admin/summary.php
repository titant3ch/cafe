<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<!-- Favicon -->
	<link rel="icon" type="image/gif" href="../img/fx-favicon.ico">

	<!-- Meta Data -->
	<meta http-equiv="refresh" content="5" >
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Cafe Quiz - Result</title>
	
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body>

<div tabindex="0" class="onclick-menu">
    <ul class="onclick-menu-content">
        <li>
          <a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/cafe/quiz/inc/cleanload.php" title="Delete Database">
            <button>Clear Database</button>
          </a>
        </li>
    </ul>
</div>

<?php

	require "../inc/usertest.php";

	// error_reporting(E_ALL ^ E_DEPRECATED);

	$con = mysql_connect("127.0.0.1", "root", "root");

	if (!$con) {
	$noDatabase = true;
	die('Could not connect: ' . mysql_error());
	}

	$noDatabase = !mysql_select_db("qcafe", $con);

	$query = "SELECT * FROM Results";
	$result = mysql_query($query);

	if($result === FALSE) {
	  die('<h3>No Data</h3>');
	}

	echo '<h3>Quiz Report</h3>';

	echo '<hr />';

	echo '<table>
	        <tr>
	          <th>Agent</th>
	          <th>Host</th>
	          <th>Answers</th>
	          <th>TotalCorrect</th>
	          <th>Grade</th>
	          <th>Time</th>
	        </tr>';

	while($row = mysql_fetch_array($result)){ 
	echo '
	      
	        <tr>
	          <td>' . $row['Agent'] . '</td>
	          <td>' . $row['Host'] . '</td>
	          <td>' . $row['Answers'] . '</td>
	          <td>' . $row['TotalCorrect'] . '</td>
	          <td>' . $row['Grade'] . '</td>
	          <td>' . $row['Time'] . '</td>
	        </tr>
	  ';
	}

	echo '</table>';

	mysql_close();
?>

</body>
</html>
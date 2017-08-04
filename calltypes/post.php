<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="refresh" content="0;url=http://<?php echo $_SERVER['SERVER_NAME'] ?>/cafe/calltypes/">
  <title>Call Types</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css" media="all" />
</head>
<body>

<?php

  require "inc/usertest.php";

  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  $con = mysql_connect("127.0.0.1", "root", "root");

  if (!$con) {
    $noDatabase = true;
    die('Could not connect: ' . mysql_error());
  }

  $noDatabase = !mysql_select_db("manolo", $con);

  if (isset($_POST['lob'])  && isset($_POST['calltime']) && isset($_POST['message'])){
    
    $sql = 'CREATE TABLE IF NOT EXISTS `CallTypes` (`LOB` text NOT NULL,`CallTime` text NOT NULL, `Message` text NOT NULL, `Agent` text NOT NULL, `Host` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8';
    mysql_query($sql, $con);
  }

  $lob = $_POST['lob'];
  $time = $_POST['calltime'];
  $message = trim($_POST['message']);
  $user = strtolower($user);
  $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
  $hostname = strtolower($hostname);

  $sql = "INSERT INTO CallTypes (LOB, CallTime, Message, Agent, Host) VALUES (
    '" . mysql_real_escape_string($lob, $con) . "',
    '" . mysql_real_escape_string($time, $con) . " min',
    '" . mysql_real_escape_string($message, $con) . "',
    '" . mysql_real_escape_string($user, $con) . "',
    '" . mysql_real_escape_string($hostname, $con) . "'
    )";
  mysql_query($sql, $con);

?>

</body>
</html>
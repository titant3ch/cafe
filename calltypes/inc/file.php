<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="refresh" content="0;url=http://<?php echo $_SERVER['SERVER_NAME'] ?>/cafe/calltypes/view">
  <title>Call Types</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css" media="all" />
</head>

<body>

<?php

// Turning off Error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Setting TimeZone
date_default_timezone_set('America/Chicago');

// Setting up file
$fh = fopen('../log/calltypes.txt', 'w');

// Establishing database connection
$con = mysql_connect("127.0.0.1","root","root");
mysql_select_db("manolo", $con);

// Heading
$txt = "Below are the calls that have been coming in for Cafe and Dotcom";
fwrite($fh, $txt);

$txt = "\r\n\r\n";
fwrite($fh, $txt);

// List all cafe calls

$result = mysql_query("SELECT Message FROM CallTypes WHERE LOB = 'cafe'"); 

$txt = "Cafe- ";
fwrite($fh, $txt);

while ($row = mysql_fetch_array($result)) {          
    $last = end($row);          
    $num = mysql_num_fields($result);
    for($i = 0; $i < $num; $i++) {            
        fwrite($fh, $row[$i]);                      
        if ($row[$i] != $last)
           fwrite($fh, "/");
    }                                                                 
    fwrite($fh, "/");
}

$txt = "\r\n";
fwrite($fh, $txt);

// List all .com calls

$result = mysql_query("SELECT Message FROM CallTypes WHERE LOB = 'dotcom'"); 

$txt = "Dotcom- ";
fwrite($fh, $txt);

while ($row = mysql_fetch_array($result)) {          
    $last = end($row);          
    $num = mysql_num_fields($result);
    for($i = 0; $i < $num; $i++) {            
        fwrite($fh, $row[$i]);                      
        if ($row[$i] != $last)
           fwrite($fh, "/");
    }                                                                 
    fwrite($fh, "/");
}

$txt = "\r\n\r\n";
fwrite($fh, $txt);

// AHT Drivers Heading

$txt = "AHT Drivers:  the call types that are driving the AHT up";
fwrite($fh, $txt);

$txt = "\r\n";
fwrite($fh, $txt);

// AHT list top 6 Cafe calls

$result = mysql_query("SELECT Message, CallTime FROM `CallTypes` where lob='cafe' ORDER BY `CallTypes`.`CallTime` * 1 DESC Limit 6"); 

$txt = "Cafe: ";
fwrite($fh, $txt);

while ($row = mysql_fetch_array($result)) {          
    $last = end($row);          
    $num = mysql_num_fields($result);
    for($i = 0; $i < $num; $i++) {            
        fwrite($fh, $row[$i]);                      
        if ($row[$i] != $last)
           fwrite($fh, "/");
    }                                                                 
    fwrite($fh, "/");
}

$txt = "\r\n";
fwrite($fh, $txt);

// AHT list top 6 .com calls

$result = mysql_query("SELECT Message, CallTime FROM `CallTypes` where lob='dotcom' ORDER BY `CallTypes`.`CallTime` * 1 DESC Limit 6"); 

$txt = "Dotcom: ";
fwrite($fh, $txt);

while ($row = mysql_fetch_array($result)) {          
    $last = end($row);          
    $num = mysql_num_fields($result);
    for($i = 0; $i < $num; $i++) {            
        fwrite($fh, $row[$i]);                      
        if ($row[$i] != $last)
           fwrite($fh, "/");
    }                                                                 
    fwrite($fh, "/");
}

$txt = "\r\n\r\n";
fwrite($fh, $txt);

// Drivers

$txt = "High Volume Types:  the call types that are coming in most";
fwrite($fh, $txt);

$txt = "\r\n";
fwrite($fh, $txt);

$txt = "Cafe- ";
fwrite($fh, $txt);

$txt = "\r\n";
fwrite($fh, $txt);

$txt = "Dotcom- ";
fwrite($fh, $txt);


fclose($fh);
mysql_close();
?>

</body>
</html>
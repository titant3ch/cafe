<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="refresh" content="0;url=http://ausrcwa230/dotcom/calltypes/view.php">
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
$con = mysql_connect("127.0.0.1","root","Fedex123");
mysql_select_db("creeper", $con);

$result = mysql_query("SELECT Message FROM CallTypes WHERE LOB = 'dotcom'"); 

$txt = "Dotcom-Call Types: ";
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

$result = mysql_query("SELECT Message FROM `CallTypes` where lob='dotcom' ORDER BY `CallTypes`.`CallTime` * 1 DESC Limit 6"); 

$txt = "Dotcom-AHT Drivers: ";
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

$txt = "Dotcom-High Volume Types: ";
fwrite($fh, $txt);

$txt = "\r\n\r\n";
fwrite($fh, $txt);

$result = mysql_query("SELECT Message FROM CallTypes WHERE LOB = 'domestic'"); 

$txt = "Domestic-Call Types: ";
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

$result = mysql_query("SELECT Message FROM `CallTypes` where lob='domestic' ORDER BY `CallTypes`.`CallTime` * 1 DESC Limit 6"); 

$txt = "Domestic-AHT Drivers: ";
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

$txt = "Domestic-High Volume Types: ";
fwrite($fh, $txt);

$txt = "\r\n\r\n";
fwrite($fh, $txt);

$result = mysql_query("SELECT Message FROM CallTypes WHERE LOB = 'load'"); 

$txt = "Load Issues: ";
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

fclose($fh);
mysql_close();
?>

</body>
</html>
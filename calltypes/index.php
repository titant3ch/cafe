<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> 
  <!--[if IE]>
    <link rel="stylesheet" href="http://ausrcwa230/dotcom/calltypes/css/ie-only.css" type="text/css" />
  <![endif]--> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>Cafe | Call Types</title>
  <link rel="stylesheet" type="text/css" href="css/fonts.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/layout.css" media="all" />
  <link rel="icon" type="image/gif" href="img/fx-favicon.ico">

  <meta http-equiv="refresh" content="300" >

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>

  <?php
    // Setting TimeZone
    date_default_timezone_set('America/Chicago');

    // Agent Data
    require "inc/agent.php";

    error_reporting(0);

    echo $user;
  ?>

<fieldset>

      <legend>Call Types</legend>

      <form name="myForm" action="post.php" method="post" onsubmit="return validateForm()">

        <section>
          <h2>Call Time</h2>
          <textarea name="calltime" class="textarea time" maxlength="3" required></textarea>
          <p>Min</p>
        </section>

        <section>
          <h2>LOB</h2>

          <select name="lob">
            <option value="cafe">Cafe</option>
            <option value="dotcom">.com</option>
          </select>
        </section>

        <section>
          <h2>What's your call?</h2>

          <textarea name="message" class="textarea" maxlength="50" placeholder="Character Count is set to 50" required></textarea>
        </section>

        <input type="submit" value="Send">

      </form>
</fieldset>

      <div class="testMessage">

        <?php

          require "inc/usertest.php";
          
          error_reporting(E_ALL ^ E_DEPRECATED);

          $con = mysql_connect("127.0.0.1", "root", "root");

          if (!$con) {
            $noDatabase = true;
            die('Could not connect: ' . mysql_error());
          }

          $noDatabase = !mysql_select_db("manolo", $con);

          $query = "SELECT * FROM CallTypes ORDER BY calltime * 1 DESC";
          $result = mysql_query($query);

          if($result === FALSE) {
              die('<h3>No Current Call Types</h3>');
          }

          echo '<h3>Reported Call Types</h3>';

          echo '<table>
                    <tr>
                      <th>LOB</th>
                      <th>Time</th>
                      <th>Call Type</th>
                    </tr>';

          while($row = mysql_fetch_array($result)){ 
            echo '
                  
                    <tr>
                      <td>' . $row['LOB'] . '</td>
                      <td>' . $row['CallTime'] . '</td>
                      <td>' . $row['Message'] . '</td>
                    </tr>
              ';
          }

          echo '</table>';

          $result = mysql_query("SELECT * FROM calltypes", $con);
          $num_rows = mysql_num_rows($result);

          echo "<h4>Total Calls: " . $num_rows . "</h4>";

          mysql_close();
        ?>

      </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script>
  $('textarea').keypress(function(event) {

if ((event.keyCode || event.which) == 13) {

    event.preventDefault();
    return false;

  }

});

$('textarea').keyup(function() {

    var keyed = $(this).val().replace(/\n/g, '<br/>');
    $(this).html(keyed);


});
</script>
<script>
    function validateForm() {
        var x = document.forms["myForm"]["calltime"].value;
        var y = document.forms["myForm"]["message"].value;
        if (x.trim()==null || x.trim()==""|| x===" ") {
            alert("Enter a valid calltime!");
            return false;
        }
        if (y.trim()==null || y.trim()==""|| y===" ") {
            alert("Enter a valid Message!");
            return false;
        }
    }
</script>
</body>
</html>
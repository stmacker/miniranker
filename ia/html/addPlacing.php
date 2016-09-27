<?php
session_start(); 
require "db.php";

$t = $_GET['t'];
  if (is_null($t)){
    header("location: tournaments.php");
  }

?>
<html>
<head>
<title>Mini Ranker: Imperial Assault</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="placing.js""></script>
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="ia.css">
  <link rel="shortcut icon" href="favicon.ico">
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
  <div class="details">
<?php

  $tourny = array();
  $sql = "Select venue, city, country, attendance, date from tournaments where id =". $t .";";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  $tourny = $row;
  }
  echo "<a href='tournament.php?t=". $t ."&d=". $d ."&f=". $f ."'><span style='color: #FF9966; font-size: 24px'><b>". $tourny[0] ."</b></span></a><br>". $tourny[1] .", ". $tourny[2] ."<br>". $tourny[4] ."<br>Attendance: ". $tourny[3];

?>
</div>
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Add Squad to Results</b> </span>
 <div class="details">

   <?php
  
  $units = array();
  $sql = "Select name from units order by name";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($units, $row[0]);
  }

  echo "<datalist id='units'>";
  foreach($units as $unit){
     echo "<option value='". $unit ."'>";
  }
  echo "</datalist>";

                 
?>
<br>
<form method='post' id='squad'>
Placing:<select id='placing'>
<option value='0'>Select:</option>
<option value='5'>First</option>
<option value='4'>Second</option>
<option value='3'>Top 4</option>
<option value='2'>Top 8</option>
<option value='1'>Top 16</option>
<option value='.1'>Other</option>
</select>
<br>
Squad ID:<input type='number' id='s' style='width: 4em' min='1' max='9999'>
<br>
<input type='submit' value='Submit New Result' class='submit'/>
<span class="error" style="display:none; color: red"><br> Error adding Squad </span>
<span class="success" style="display:none; color: green"><br> Added Successfully</span>
<br>Only use the Squad Id field when using the 's' value from the URL of the matching squad page, otherwise submit new squad info below.
<hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 1:&nbsp;<input id='p1' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p1copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 2:&nbsp;<input id='p2' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p2copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 3:&nbsp;<input id='p3' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p3copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 4:&nbsp;<input id='p4' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p4copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 5:&nbsp;<input id='p5' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p5copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 6:&nbsp;<input id='p6' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p6copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 7:&nbsp;<input id='p7' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p7copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 8:&nbsp;<input id='p8' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p8copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 9:&nbsp;<input id='p9' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p9copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit 10:&nbsp;<input id='p0' type='text' list='units' />
Copies:&nbsp;<input type='number' id='p0copies' style='width: 3em' value='1' min='1' max='8'>
<hr>
Please make sure all squad data is complete and accurate before submitting. (Also don't forget to set the placing!)
<?php echo "<input type='hidden' id='t' value='". $t ."'>"; ?>
<br><br><input type='submit' value='Submit New Result' class='submit'/>
<span class="error" style="display:none; color: red"><br> Error adding Squad </span>
<span class="success" style="display:none; color: green"><br> Added Successfully</span>
</form>
</div>



<?php include 'foot.php'; ?>
</body>
</html>

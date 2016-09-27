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
<title>Mini Ranker: X-wing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="placing.js""></script>
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="xwing.css">
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
  
  $pilots = array();
  $sql = "Select name from pilots order by name";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($pilots, $row[0]);
  }

  echo "<datalist id='pilots'>";
  foreach($pilots as $pilot){
     echo "<option value='". $pilot ."'>";
  }
  echo "</datalist>";

  $upgrades = array();
  $sql = "Select name from upgrades order by name";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($upgrades, $row[0]);
  }
  
  echo "<datalist id='upgrades'>";
  foreach($upgrades as $upgrade){
     echo "<option value='". $upgrade ."'>";
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
</select>
<br>
Squad ID:<input type='number' id='s' style='width: 4em' min='1' max='9999'>
<br>
<input type='submit' value='Submit New Result' class='submit'/>
<span class="error" style="display:none; color: red"><br> Error adding Squad </span>
<span class="success" style="display:none; color: green"><br> Added Successfully</span>
<br>Only use the Squad Id field when using the s id from the URL of the matching squad page, otherwise submit new squad info below.
<hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 1:&nbsp;<input id='p1' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p1u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p1u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p1u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p1u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p1u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p1u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p1u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p1u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p1copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 2:&nbsp;<input id='p2' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p2u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p2u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p2u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p2u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p2u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p2u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p2u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p2u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p2copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 3:&nbsp;<input id='p3' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p3u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p3u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p3u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p3u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p3u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p3u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p3u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p3u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p3copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 4:&nbsp;<input id='p4' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p4u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p4u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p4u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p4u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p4u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p4u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p4u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p4u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p4copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 5:&nbsp;<input id='p5' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p5u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p5u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p5u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p5u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p5u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p5u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p5u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p5u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p5copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 6:&nbsp;<input id='p6' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p6u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p6u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p6u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p6u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p6u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p6u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p6u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p6u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p6copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 7:&nbsp;<input id='p7' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p7u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p7u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p7u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p7u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p7u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p7u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p7u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p7u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p7copies' style='width: 3em' value='1' min='1' max='8'><hr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pilot 8:&nbsp;<input id='p8' type='text' list='pilots' />
Upgrade 1:&nbsp;<input id='p8u1' type='text' list='upgrades' />
Upgrade 2:&nbsp;<input id='p8u2' type='text' list='upgrades' />
<br>Upgrade 3:&nbsp;<input id='p8u3' type='text' list='upgrades' />
Upgrade 4:&nbsp;<input id='p8u4' type='text' list='upgrades' />
Upgrade 5:&nbsp;<input id='p8u5' type='text' list='upgrades' />
<br>Upgrade 6:&nbsp;<input id='p8u6' type='text' list='upgrades' />
Upgrade 7:&nbsp;<input id='p8u7' type='text' list='upgrades' />
Upgrade 8:&nbsp;<input id='p8u8' type='text' list='upgrades' />
<br>Copies:&nbsp;<input type='number' id='p8copies' style='width: 3em' value='1' min='1' max='8'>
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

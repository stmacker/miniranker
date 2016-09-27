<?php
session_start(); 
require "db.php";

$t = $_GET['t'];
  if (is_null($t)){
    header("location: tournaments.php");
  }

$d = $_GET['d'];
  if (is_null($d)){
    $d = 120;
  }

$f = $_GET['f'];
  if (is_null($f)){
    $f = 0;
  }
?>
<html>
<head>
<title>MiniRanker: Imperial Assault</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
  echo "<span style='color: #FF9966; font-size: 24px'><b>". $tourny[0] ."</b></span><br>". $tourny[1] .", ". $tourny[2] ."<br>". $tourny[4] ."<br>Attendance: ". $tourny[3];

?>
</div>
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Placed Squads</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
  $sql = "Select list_id, points as total from placing join tournaments on placing.tournament_id = tournaments.id where tournaments.id =". $t ." order by total desc limit 50;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, array($row[0], $row[1]));
  }
  
  foreach($squads as $squad) {
    $list = "";
    $sql = "select group_concat(u.id order by u.cost desc separator ',') from list_units lu join units u on u.id = lu.unit_id where lu.list_id = ". $squad[0];
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $units = explode(',', $list);
    $unit_count = array_count_values($units);
    echo "<tr><td>";
    switch($squad[1]){
	case "5":      
		echo "<span style='color: #FFCC00'>1st</span> ";
        break;
	case "4":      
		echo "<span style='font-size: 14px'>2nd</span> ";
        break;
	case "3":      
		echo "<span style='color: #CC6600;font-size: 12px'>T4</span> ";
        break;
    case "2":
        echo "<span style='color: #CC6600;font-size: 12px'>T8</span> ";
    break;
    case "1":
        echo "<span style='color: #CC6600;font-size: 12px'>T16</span> ";
    break;
    }
    foreach($unit_count as $key => $unit) {
        $current = array();
        $sql = "Select name, case when units.unit_type = 10 then 0 else units.faction end FROM units WHERE units.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($current, $row[0], $row[1]);
        }

        echo "<a href='/squad.php?s=". $squad[0] ."&d=". $d ."&f=". $f ."'>";
        switch ($current[1]){
		case "1":
			echo "<span style='color: #FF6666; font-size: 18px'>";
		break;
		case "2":
			echo "<span style='color: #33CC33; font-size: 18px'>";
		break;
		case "3":
			echo "<span style='color: #CCAA00; font-size: 18px'>";
		break;
		default:
		echo "<span style='color: #FF9966; font-size: 16px'>";
		break;
	}
        echo $current[0] ."</span>";
	if ($unit > 1) {
          echo "<span style='color: #CCCCCC; font-size: 18px'> x". $unit ."</span>";
        } 
        echo "; ";
     }
     echo "</a></td></tr>";
}

echo "</tbody></table><br><form action='http://ia.miniranker.com/addPlacing.php'><input type='hidden' name='t' value='".$t."'><input type='submit' value='Add Lists'></form></div>";             
          
                   
?>  
<?php include 'foot.php'; ?>
</body>
</html>

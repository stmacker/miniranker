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
<title>MiniRanker: Armada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="armada.css">
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
    <br> <span style="font-size: 24px"> <b>Top Placed Fleets</b> </span>
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
    $sql = "select group_concat(b.id order by b.cost desc separator ',') from list_builds lb join builds b on b.id = lb.build_id where lb.list_id = ". $squad[0];
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $ships = explode(',', $list);
    $ship_count = array_count_values($ships);
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
    }
    foreach($ship_count as $key => $ship) {
        $pilot = array();
        $sql = "Select ships.name, builds.upgrades, case when ships.fighter = 1 then 0 else ships.faction end FROM builds join ships on builds.ship_id = ships.id WHERE builds.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($pilot, $row[0], $row[1], $row[2]);
        }

        echo "<a href='/squad.php?s=". $squad[0] ."&d=". $d ."&f=". $f ."'>";
        switch ($pilot[2]){
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
        echo str_replace('-', '&#8209;', str_replace(' ', '&nbsp;', $pilot[0])) ."</span>";
	if (!is_null($pilot[1])) {
	$upgrades = array();
        $upgrades = explode(',', $pilot[1]);

        foreach($upgrades as $upgrade) {
          $upg_name = "";
          $sql = "Select name FROM upgrades WHERE id =". $upgrade;
          $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
          while($row = mysql_fetch_row($result)){
          $upg_name = $row[0];
          }
          echo " + ". str_replace('-', '&#8209;', str_replace(' ', '&nbsp;', $upg_name));
        }
        }
	if ($ship > 1) {
          echo "<span style='color: #CCCCCC; font-size: 18px'>&nbsp;x". $ship ."</span>";
        } 
        echo "; ";
	if ($pilot[2] != 0) {
		echo "<br>";
        }
     }
     echo "</a></td></tr>";
}

echo "</tbody></table><br><form action='http://armada.miniranker.com/addPlacing.php'><input type='hidden' name='t' value='".$t."'><input type='submit' value='Add Lists'></form></div>";             
                   
?>  

<?php include 'foot.php'; ?>
</body>
</html>

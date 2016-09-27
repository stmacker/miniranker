<?php
session_start(); 
require "db.php";

$s = $_GET['s'];
  if (is_null($s)){
    header("location: ships.php");
  }

?>
<html>
<head>
<title>Mini Ranker: Armada</title>
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
 $stats = array();
 $sql = "Select ships.name, ships.cost, ships.faction from ships where ships.id =". $s .";";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($stats, $row[0], $row[1], $row[2]);
  }
  echo "<a href='/ship.php?s=". $s ."&d=". $d ."&f=". $f ."'>";  
 	switch ($stats[2]){
		case "1":
			echo "<span style='color: #FF6666; font-size: 24px'>";
		break;
		case "2":
			echo "<span style='color: #33CC33; font-size: 24px'>";
		break;
		case "3":
			echo "<span style='color: #CCAA00; font-size: 24px'>";
		break;
		default:
		echo "<span style='color: #FF9966; font-size: 18px'>";
		break;
	}
 echo "<b>". $stats[0] ."</b></span></a> (". $stats[1] .")";
 
?>
  </div>
  <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Upgrades</b> </span>
    <span style='color: #CCCCCC; font-size: 18px'> (Cost) (Usage)<span>
 <table class="front" style="width: 100%">

   <?php
  $total = 0;
  $builds = array();
  $sql = "Select builds.id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." group by builds.id order by total desc";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($builds, $row[1]);
  }
  foreach($builds as $build) {
    $total = $total + $build;
  }   

  $upgrades = array();
  $sql = "Select upgrades.id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id join upgrades on find_in_set(upgrades.id, builds.upgrades) join list_builds on list_builds.build_id = builds.id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." group by upgrades.id order by total desc;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($upgrades, array($row[0], $row[1]));
  }

        foreach($upgrades as $upgr) {
	  $upg_details = array();
          $sql = "Select name, cost, effect FROM upgrades WHERE id =". $upgr[0];
          $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
          while($row = mysql_fetch_row($result)){
          array_push($upg_details, $row[0], $row[1], $row[2]);
          }
	  echo "<tr><td title='". $upg_details[2] ."'><a href='/ship-builds.php?s=". $s ."&u=". $upgr[0] ."&d=". $d ."&f=". $f ."'>". $upg_details[0] ." <span style='color: #CCCCCC;'>(". $upg_details[1] .") (". round($upgr[1] / $total * 100) ."%)</span></a></td></tr>";
        }
  
                   
?>  
      </tbody>
  </table>
  </div>

<?php include 'foot.php'; ?>
</body>
</html>

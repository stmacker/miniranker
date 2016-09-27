<?php
session_start(); 
require "db.php";

$p = $_GET['p'];
$u = $_GET['u'];
  if (is_null($p)){
    header("location: pilots.php");
  }

?>
<html>
<head>
<title>Mini Ranker: X-wing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="xwing.css">
  <link rel="shortcut icon" href="favicon.ico">
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
  <div class="details">
 <?php
 $stats = array();
 $sql = "Select pilots.name, ships.name, pilots.cost, pilots.skill, pilots.attack, pilots.agility, pilots.hull, pilots.shield, pilots.ship_id, pilots.faction from pilots join ships on pilots.ship_id = ships.id where pilots.id =". $p .";";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($stats, $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
  }
  echo "<a href='/pilot.php?p=". $p ."&d=". $d ."&f=". $f ."'>";  
 	switch ($stats[9]){
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
 echo "<b>". $stats[0] ."</b></span></a>";
 echo "<br><a href='/ship.php?s=". $stats[8] ."&d=". $d ."&f=". $f ."'>".$stats[1] ."</a> (". $stats[2] .")";
 echo "<br><span style='color: #FF9966'>". $stats[3] ."</span> <span style='color: #FF6666'>". $stats[4] ."</span> <span style='color: #33CC33'>". $stats[5] ."</span> <span style='color: #FFFF66'>". $stats[6] ."</span> <span style='color: #33CCFF'>". $stats[7] ."</span>";
 	if(!is_null($u)){
	  $upg = array();
          $sql = "Select name, cost, effect FROM upgrades WHERE id =". $u;
          $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
          while($row = mysql_fetch_row($result)){
          array_push($upg, $row[0], $row[1], $row[2]);
          }
          echo "<br><a title='". $upg[2] ."' href='/upgrade.php?u=". $u ."&d=". $d ."&f=". $f ."'><span style='color: #33CCFF;'> + ". $upg[0] ."</span></a> (". $upg[1] .")";
	}
?>
  </div>
  <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Builds</b> </span>
    <span style='color: #CCCCCC; font-size: 18px'> (Cost)</span>
 <table class="front" style="width: 100%">

   <?php
  
  $builds = array();
  if(!is_null($u)){	
  $sql = "Select builds.id, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from pilots join builds on pilots.id = builds.pilot_id and find_in_set(". $u .", builds.upgrades) join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE pilots.id =". $p ." group by builds.id order by total desc;";
  }
  else{
  $sql = "Select builds.id, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from pilots join builds on pilots.id = builds.pilot_id join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE pilots.id =". $p ." group by builds.id order by total desc;";
  }
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($builds, array($row[0], $row[1]));
  }
  $top = $builds[0][1];

    foreach($builds as $build) {
        $pilot = array();
        $sql = "Select pilots.name, builds.upgrades, pilots.cost, pilots.faction FROM builds join pilots on builds.pilot_id = pilots.id WHERE builds.id =". $build[0];
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($pilot, $row[0], $row[1], $row[2], $row[3]);
        }
	$cost = $pilot[2];
        echo "<tr><td><span style='font-size: 12px'>". round($build[1] / $top * 100) ." - </span><a href='/build.php?b=". $build[0] ."&d=". $d ."&f=". $f ."'>";
	switch ($pilot[3]){
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
		echo "<span style='color: #FF9966; font-size: 18px'>";
		break;
	}
	echo str_replace('-', '&#8209;', str_replace(' ', '&nbsp;', $pilot[0])) ."</span>";
        if (!is_null($pilot[1])) {
	  $upgrades = array();
          $upgrades = explode(',', $pilot[1]);

          foreach($upgrades as $upgrade) {
            $upgr = array();
            $sql = "Select name, cost FROM upgrades WHERE id =". $upgrade;
            $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
            while($row = mysql_fetch_row($result)){
            array_push($upgr, $row[0], $row[1]);
            }
            echo " + ". str_replace('-', '&#8209;', str_replace(' ', '&nbsp;', $upgr[0]));
	    $cost = $cost + $upgr[1];
          }
        }
        echo "<span style='color: #CCCCCC;'> (". $cost .") </span></a></td></tr>";
     
    }
                   
?>  
      </tbody>
  </table>

  </div>

<?php include 'foot.php'; ?>
</body>
</html>

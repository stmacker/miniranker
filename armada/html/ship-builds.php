<?php
session_start(); 
require "db.php";

$s = $_GET['s'];
$u = $_GET['u'];
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
  $sql = "Select builds.id, SUM(ships.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id and find_in_set(". $u .", builds.upgrades) join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." group by builds.id order by total desc;";
  }
  else{
  $sql = "Select builds.id, SUM(ships.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." group by builds.id order by total desc;";
  }
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($builds, array($row[0], $row[1]));
  }
  $top = $builds[0][1];

    foreach($builds as $build) {
        $pilot = array();
        $sql = "Select ships.name, builds.upgrades, ships.cost, ships.faction FROM builds join ships on builds.ship_id = ships.id WHERE builds.id =". $build[0];
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

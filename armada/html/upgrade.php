<?php
session_start(); 
require "db.php";

$u = $_GET['u'];
  if (is_null($u)){
    header("location: upgrades.php");
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
	  $upg = array();
          $sql = "Select name, cost, type, effect FROM upgrades WHERE id =". $u;
          $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
          while($row = mysql_fetch_row($result)){
          array_push($upg, $row[0], $row[1], $row[2], $row[3]);
          }
          echo "<b><span style='color: #33CCFF; font-size: 24px'>". $upg[0] ."</span></b><br><span style='font-size: 18px'>". $upg[2] ." (". $upg[1] .")</span>";
 if ($upg[3] != '') {
   echo "<br><span style='color: #FF9966; font-size: 18px'>". $upg[3] ."</span>";
 }
?>
  </div>
  <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Ships with Upgrade</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $pilots = array();
  if($f == 0){
    $sql = "Select ships.id, ships.name, ships.cost, ships.faction, SUM(ships.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id and find_in_set(". $u .", builds.upgrades) join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id group by ships.id order by total desc;";
  }else{
    $sql = "Select pilots.id, pilots.name, pilots.cost, pilots.faction, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id and find_in_set(". $u .", builds.upgrades) join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id where ships.faction = ". $f ." group by ships.id order by total desc;";
  }
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($pilots, array($row[0], $row[1], $row[2], $row[3]));
  }
  
    foreach($pilots as $pilot) {
        echo "<tr><td><a href='/ship-builds.php?s=". $pilot[0] ."&u=". $u ."&d=". $d ."&f=". $f ."'>";
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
	echo $pilot[1] ."</span>";
        echo "<span style='color: #CCCCCC;'> (". $pilot[2] .") </span></a></td></tr>";
     
    }
                   
?>  
      </tbody>
  </table>
  </div>

<?php include 'foot.php'; ?>
</body>
</html>

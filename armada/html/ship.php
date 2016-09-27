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
 $sql = "Select ships.name, ships.cost, ships.faction, ships.fighter from ships where ships.id =". $s .";";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($stats, $row[0], $row[1], $row[2], $row[3]);
  }  
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
		echo "<span style='color: #FF9966; font-size: 24px'>";
		break;
	}
 echo "<b>". $stats[0] ."</b></span> (". $stats[1] .")";

if ($stats[3] == 0){
  echo "</div><div class='list'><br><span style='font-size: 24px'> <b>Top Ranked Builds</b> </span>";
  echo "<span style='color: #CCCCCC; font-size: 18px'> (Cost) </span>";
  echo "<table class='front' style='width: 100%'>";


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

  $builds = array();
  $sql = "Select builds.id, SUM(ships.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." group by builds.id order by total desc limit 10;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($builds, array($row[0], $row[1]));
  }
  $top = $builds[0][1];
  
    foreach($builds as $build) {
        $ship = array();
        $sql = "Select ships.name, builds.upgrades, ships.cost, ships.faction FROM builds join ships on builds.ship_id = ships.id WHERE builds.id =". $build[0];
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($ship, $row[0], $row[1], $row[2], $row[3]);
        }
	$cost = $ship[2];
        echo "<tr><td><span style='font-size: 12px'>". round($build[1] / $top * 100) ." - </span><a href='/build.php?b=". $build[0] ."&d=". $d ."&f=". $f ."'>";
	switch ($ship[3]){
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
	echo str_replace('-', '&#8209;', str_replace(' ', '&nbsp;', $ship[0])) ."</span>";
        if (!is_null($ship[1])) {
	  $upgrades = array();
          $upgrades = explode(',', $ship[1]);

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
  if(count($builds) == 10){
    echo "<tr><td><a href='/ship-builds.php?p=". $s ."&d=". $d ."&f=". $f ."'><span style='color: #FF9966; font-size: 16px'>See More Builds</span></a></td></tr>";
  }                

  echo "</tbody></table></div>";

  echo "<div class='list'><br><span style='font-size: 24px'> <b>Top Ranked Upgrades</b> </span>";
  echo "<span style='color: #CCCCCC; font-size: 18px'> (Cost) (Usage)</span>";
  echo "<table class='front' style='width: 100%'>";
  
  $upgrades = array();
  $sql = "Select upgrades.id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join builds on ships.id = builds.ship_id join upgrades on find_in_set(upgrades.id, builds.upgrades) join list_builds on list_builds.build_id = builds.id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." group by upgrades.id order by total desc limit 10;";
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
  if(count($upgrades) == 10){
    echo "<tr><td><a href='/ship-upgrades.php?s=". $s ."&d=". $d ."&f=". $f ."'><span style='color: #FF9966; font-size: 16px'>See More Upgrades</span></a></td></tr>";
  }


  echo "</tbody></table></div>";
}
?>
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Squads</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from builds join lists on find_in_set(builds.id, lists.build_ids) join placing on lists.id = placing.list_id join tournaments on placing.tournament_id = tournaments.id where builds.ship_id = ". $s ." group by list_id order by total desc limit 10;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, array($row[0], $row[1]));
  }
  $top = $squads[0][1];

  foreach($squads as $key => $squad) {
    $list = "";
    $sql = "select group_concat(b.id order by b.cost desc separator ',') from list_builds lb join builds b on b.id = lb.build_id where lb.list_id = ". $squad[0];
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $ships = explode(',', $list);
    $ship_count = array_count_values($ships);
    echo "<tr><td><span style='font-size: 12px'>". round($squad[1] / $top * 100) ." - </span>";
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
                   
?>  
      </tbody>
  </table>
  </div>

<?php include 'foot.php'; ?>
</body>
</html>

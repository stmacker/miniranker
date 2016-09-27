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
 $name = array();
 $sql = "Select name, faction from ships where id =". $s .";";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($name, $row[0], $row[1]);
  }  
 switch ($name[1]){
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
 echo "<b>". $name[0] ."</b></span>";
 echo "<div class='details'>";
 echo "<br><img src='moves/". $s .".png'>"; 
?>


    <div class="list" style="width: calc(100% - 300px);vertical-align: middle">
    <br> <span style="font-size: 24px"> <b>Top Ranked Pilots</b> </span>
    <span style='color: #CCCCCC; font-size: 18px'> (Cost)</span>
 <table class="front" style="width: 100%">

   <?php
  
  $pilots = array();
if ($f == 0){
  $sql = "Select pilots.id, pilots.name, pilots.cost, pilots.faction, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from pilots left join builds on pilots.id = builds.pilot_id left join list_builds on builds.id = list_builds.build_id left join placing on list_builds.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id WHERE pilots.ship_id = ". $s ." group by pilots.id order by total desc;";
}
else {
   $sql = "Select pilots.id, pilots.name, pilots.cost, pilots.faction, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from pilots left join builds on pilots.id = builds.pilot_id left join list_builds on builds.id = list_builds.build_id left join placing on list_builds.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id WHERE pilots.ship_id = ". $s ." and pilots.faction = ". $f ." group by pilots.id order by total desc;";
}
$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($pilots, array($row[0], $row[1], $row[2], $row[3], $row[4]));
  }
  $top = $pilots[0][4];

    foreach($pilots as $pilot) {
	echo "<tr><td><span style='font-size: 12px'>" . round($pilot[4] / $top * 100) ." - </span><a href='pilot.php?p=". $pilot[0] ."&d=". $d ."&f=". $f ."'>";
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
	echo $pilot[1] ."</span> <span style='color: #CCCCCC;'>(". $pilot[2] .")</span></a></td></tr>";
     }
                   
?>  
      </tbody>
  </table>
  </div>
  </div>
  <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Builds</b> </span>
    <span style='color: #CCCCCC; font-size: 18px'> (Cost) </span>
 <table class="front" style="width: 100%">

   <?php
  $builds = array();
if ($f == 0){
  $sql = "Select builds.id, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join pilots on ships.id = pilots.ship_id join builds on pilots.id = builds.pilot_id join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." group by builds.id order by total desc limit 10;";
}else{
  $sql = "Select builds.id, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships join pilots on ships.id = pilots.ship_id join builds on pilots.id = builds.pilot_id join list_builds on builds.id = list_builds.build_id join placing on list_builds.list_id = placing.list_id join tournaments on placing.tournament_id = tournaments.id WHERE ships.id =". $s ." AND pilots.faction = ". $f ." group by builds.id order by total desc limit 10;";
} $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
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
	echo $pilot[0] ."</span>";
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
            echo " + ". $upgr[0];
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

<?php
session_start(); 
require "db.php";

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
Below are the pilots ordered by how they rank in tournaments factored by placing and cost. Click a pilot to get more info on what builds and upgrades are their most popular and effective!
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Pilots</b> </span>
    <span style='color: #CCCCCC; font-size: 18px'> (Cost)</span>
 <table class="front" style="width: 100%">

   <?php
  
  $pilots = array();
  if($f == 0){
    $sql = "Select pilots.id, pilots.name, pilots.cost, pilots.faction, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from pilots left join builds on pilots.id = builds.pilot_id left join list_builds on builds.id = list_builds.build_id left join placing on list_builds.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id group by pilots.id order by total desc limit 50;";
  }else{
  $sql = "Select pilots.id, pilots.name, pilots.cost, pilots.faction, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from pilots left join builds on pilots.id = builds.pilot_id left join list_builds on builds.id = list_builds.build_id left join placing on list_builds.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id where pilots.faction = ". $f ." group by pilots.id order by total desc limit 50;";
  }
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($pilots, array($row[0], $row[1], $row[2], $row[3], $row[4]));
  }
  $top = $pilots[0][4];

    foreach($pilots as $pilot) {
        echo "<tr><td><span style='font-size: 12px'>". round($pilot[4] / $top * 100) ." - </span><a href='pilot.php?p=". $pilot[0] ."&d=". $d ."&f=". $f ."'>";
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
	echo $pilot[1] ."</span><span style='color: #CCCCCC'> (". $pilot[2] .")</span></a></td></tr>";
     }
                   
?>  
      </tbody>
  </table>

  </div>

<?php include 'foot.php'; ?>
</body>
</html>

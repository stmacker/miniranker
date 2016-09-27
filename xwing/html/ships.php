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
Below are the pilots ordered by how they rank in tournaments factored over placing and points spent. Click a ship to get more info on its pilots!
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Ships</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $ships = array();
  if($f == 0){
    $sql = "Select ships.id, ships.name, ships.faction, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships left join pilots on ships.id = pilots.ship_id left join builds on pilots.id = builds.pilot_id left join list_builds on builds.id = list_builds.build_id left join placing on list_builds.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id group by ships.id order by total desc;";
  }else{
$sql = "Select ships.id, ships.name, ships.faction, SUM(pilots.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from ships left join pilots on ships.id = pilots.ship_id left join builds on pilots.id = builds.pilot_id left join list_builds on builds.id = list_builds.build_id left join placing on list_builds.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id where locate(". $f .", ships.faction) > 0 group by ships.id order by total desc;";
  }
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($ships, array($row[0], $row[1], $row[2], $row[3]));
  }
  $top = $ships[0][3];

    foreach($ships as $ship) {
        echo "<tr><td><span style='font-size: 12px'>" . round($ship[3] / $top * 100) ." - </span><a href='ship.php?s=". $ship[0] ."&d=". $d ."&f=". $f ."'>";
	switch ($ship[2]){
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
	echo $ship[1] ."</span></a></td></tr>";
     }
                   
?>  
      </tbody>
  </table>

  </div>
<?php include 'foot.php'; ?>
</body>
</html>

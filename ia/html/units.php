<?php
session_start(); 
require "db.php";

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
<title>Imperial Assault Squad Ranker</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="ia.css">
  <link rel="shortcut icon" href="favicon.ico">
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
  <div class="details">
Below are the units ordered by how they rank in tournaments factored by placing and cost. Click a unit to get more info on it and see what squads containing them are the most popular and effective!
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Units</b> </span>
    <span style='color: #CCCCCC; font-size: 18px'> (Cost)</span>
 <table class="front" style="width: 100%">

   <?php
  
  $units = array();
  if($f == 0){
    $sql = "Select units.id, units.name, units.cost, units.faction, SUM(units.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from units left join list_units on units.id = list_units.unit_id left join placing on list_units.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id group by units.id order by total desc limit 100;";
  }else{
  $sql = "Select units.id, units.name, units.cost, units.faction, SUM(units.cost * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from units left join list_units on units.id = list_units.unit_id left join placing on list_units.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id where units.faction = ". $f ." group by units.id order by total desc limit 100;";
  }
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($units, array($row[0], $row[1], $row[2], $row[3], $row[4]));
  }
  $top = $units[0][4];

    foreach($units as $unit) {
        echo "<tr><td><span style='font-size: 12px'>". round($unit[4] / $top * 100) ." - </span><a href='unit.php?u=". $unit[0] ."&d=". $d ."&f=". $f ."'>";
	switch ($unit[3]){
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
	echo $unit[1] ."</span><span style='color: #CCCCCC'> (". $unit[2] .")</span></a></td></tr>";
     }
                   
?>  
      </tbody>
  </table>

  </div>

<?php include 'foot.php'; ?>
</body>
</html>

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
<title>X-Wing Squad Ranker</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="ia.css">
  <link rel="shortcut icon" href="favicon.ico">
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
  <div class="details">
Below are the factions ordered by how they rank in tournaments factored over placing and attendance.
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Factions</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $factions = array();

  $sql = "Select units.faction, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from units left join list_units on units.id = list_units.unit_id left join placing on list_units.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id group by units.faction order by total desc;";

  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($factions, array($row[0], $row[1], $row[2], $row[3]));
  }
  $top = $factions[0][1];

    foreach($factions as $faction) {
        echo "<tr><td><span style='font-size: 12px'>" . round($faction[1] / $top * 100) ." - </span>";
	switch ($faction[0]){
		case "1":
			echo "<span style='color: #FF6666; font-size: 18px'>Rebel";
		break;
		case "2":
			echo "<span style='color: #33CC33; font-size: 18px'>Imperial";
		break;
		case "3":
			echo "<span style='color: #CCAA00; font-size: 18px'>Scum & Villainy";
		break;
		default:
		echo "<span style='color: #FF9966; font-size: 18px'>";
		break;
	}
	echo "</span></td></tr>";
     }
                   
?>  
      </tbody>
  </table>

  </div>
<?php include 'foot.php'; ?>
</body>
</html>

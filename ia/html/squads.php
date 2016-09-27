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
Below is a list of the top squads based on current data, select a squad to see more information on what tournaments it placed in.
<br><br>
The values to the left of each squad are relative points for better comparison of rankings.
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Squads</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
if ($f == 0){
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id group by list_id order by total desc limit 50;";
}else{
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id join lists on placing.list_id = lists.id join units on LEFT(lists.unit_ids,LOCATE(',',lists.unit_ids) - 1) = units.id where faction = ". $f ." group by list_id order by total desc limit 50";
}$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, array($row[0], $row[1]));
  }
  $top = $squads[0][1];

  foreach($squads as $key => $squad) {
    $list = "";
    $sql = "select group_concat(u.id order by u.cost desc separator ',') from list_units lu join units u on u.id = lu.unit_id where lu.list_id = ". $squad[0];
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $units = explode(',', $list);
    $unit_count = array_count_values($units);
    echo "<tr><td><span style='font-size: 12px'>". round($squad[1] / $top * 100) ." - </span>";
    foreach($unit_count as $key => $unit) {
        $current = array();
        $sql = "Select units.name, case when units.unit_type = 10 then 0 else units.faction end FROM units WHERE units.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($current, $row[0], $row[1]);
        }

        echo "<a href='/squad.php?s=". $squad[0] ."&d=". $d ."&f=". $f ."'>";
        switch ($current[1]){
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
	echo $current[0] ."</span>";
       	if ($unit > 1) {
          echo "<span style='color: #CCCCCC; font-size: 18px'> x". $unit ."</span>";
        } 
        echo "; ";
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

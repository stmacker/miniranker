<?php
session_start(); 
require "db.php";

$u = $_GET['u'];
  if (is_null($u)){
    header("location: units.php");
  }

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
 <?php
 $stats = array();
 $sql = "Select units.name, units.cost, units.reinforcement, units.group_size, units.health, units.speed, units.attack_type, units.attack_dice, units.defense_dice, units.unit_type, units.faction from units where units.id =". $u .";";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($stats, $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]);
  }

$types = array();
$sql = "Select unit_types.name from unit_types where find_in_set(id, '". $stats[9] ."')";
$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($types, $row[0]);
  }

  
 	switch ($stats[10]){
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
 echo "<b>". $stats[0] ."</b><br>";
 for ($i = 0; $i < $stats[3]; $i++){
   echo "|";
 }
 echo "</span>(".$stats[1];
 if ($stats[2] != ''){
   echo "<span style='font-size: 14px'><sup> \ ". $stats[2] ."</sup></span>";
 }
 echo ") ";
 foreach($types as $type){
   echo $type;
   if ($type != end($types)){
     echo " - ";
   } 
 }
 if($stats[9] != 10){
 echo "<br><br><span style='color: #FF9966'>Health: ". $stats[4] .", Speed: ". $stats[5] ."</span>";
 echo "<br><span style='color: #FF9966'>Defense:";
 $defense = array();
 $defense = explode(',', $stats[8]);
 foreach($defense as $die){
	switch ($die){
		case "w":
			echo "<span style='color: #FFFFFF; font-size: 32px'>&#9632;</span>";
		break;
		case "b":
			echo "<span style='color: #CCCCCC; font-size: 33px'>&#9633;</span>";
		break;
	}	
 }
 echo ", Attack";
 switch ($stats[6]){
   case "r":
	echo " (Ranged)";
   break;
   case "m":
   	echo " (Melee)";
   break;
 }
 echo ":";
 $attack = array();
 $attack = explode(',', $stats[7]);
 foreach($attack as $die){
	switch ($die){
		case "b":
			echo "<span style='color: #33CCFF; font-size: 32px'>&#9632;</span>";
		break;
		case "g":
			echo "<span style='color: #33CC33; font-size: 32px'>&#9632;</span>";
		break;
		case "r":
			echo "<span style='color: #FF6666; font-size: 32px'>&#9632;</span>";
		break;
		case "y":
			echo "<span style='color: #FFFF66; font-size: 32px'>&#9632;</span>";
		break;
		case "?":
			echo "<span style='color: #CCCCCC; font-size: 20px'>&#65533;</span>";
		break;
	}	
 }
 if(empty($stats[7])) {
 echo "-";
}
 echo "</span>";
}
 echo "<br><br><span style='font-size: 18px'>";

$abilities = array();
$sql = "Select abilities.name, abilities.text, abilities.actions, unit_abilities.value, unit_abilities.surge from unit_abilities join abilities on unit_abilities.ability_id = abilities.id where unit_abilities.unit_id = ". $u;
$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($abilities, array($row[0], $row[1], $row[2], $row[3], $row[4]));
  }
foreach($abilities as $ability){
  for($i = 0; $i < $ability[2]; $i++){
   echo "&#9698;&#8227; ";
  }
  for($i = 0; $i < $ability[4]; $i++){
   echo "~";
  }
  if (!is_null($ability[3])){
     $ability[1] = str_replace("[x]",$ability[3],$ability[1]);
  }
  echo $ability[0];
  if (!is_null($ability[1])){
    echo ": ". $ability[1];
  }
  echo "<br>";
}


?>
  </div>
 
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Squads</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from units join lists on find_in_set(units.id, lists.unit_ids) join placing on lists.id = placing.list_id join tournaments on placing.tournament_id = tournaments.id where units.id = ". $u ." group by list_id order by total desc limit 10;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
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

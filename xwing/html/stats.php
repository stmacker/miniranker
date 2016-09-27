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

  <?php include 'head.php';

    $s = $_GET['s'];
    if (is_null($s)){
        $s = date('Y-m-d', strtotime('-90 days'));
    }
      
    $e = $_GET['e'];
    if (is_null($e)){
        $e = date('Y-m-d');
    }
      
    $w = $_GET['w'];
    if (is_null($w)){
        $w = 0;
    }
      
      ?>
  <br>
  <div class="details">
Below are various statistics for the given dates.

<?php
    echo "<div class='details' style='min-height: 101px; width: 100%; font-size: 18px'><br>
    <form action='". $go ."' method='GET'>
    Start Date:
    <input type='date' name='s' value='". $s ."'>,
    End Date: <input type='date' name='e' value='". $e ."'>,
    Wins Only: <input type='checkbox' name='w' value='1'". ($w == 1 ? " checked" : "") .">";
    echo " <button type='submit'>Refresh Data</button></form></div>";
    
    ?>

    <div class="list">
    <br> <span style="font-size: 24px"> <b>Faction</b> </span>
 <table class="front" style="width: 100%">

   <?php

  $factions = array();

       $sql = "Select pilots.faction, SUM(points * SQRT(attendance)) as total from ships left join pilots on ships.id = pilots.ship_id left join builds on pilots.id = builds.pilot_id left join list_builds on builds.id = list_builds.build_id left join placing on list_builds.list_id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id where tournaments.date >= '". $s ."' and tournaments.date <= '". $e ."' ".($w == 1 ? "and placing.points = 5 " : "")."group by pilots.faction order by total desc;";

  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($factions, array($row[0], $row[1], $row[2], $row[3]));
  }
       $total = 0;
       foreach ($factions as $faction){
           $total += $faction[1];
       }

    foreach($factions as $faction) {
        echo "<tr><td>";
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
	echo "</span><span style='font-size: 12px'> - " . round($faction[1] / $total * 100) ."%</span></td></tr>";
     }
                   
?>  
      </tbody>
  </table>
  </div>

<div class="list">
<br> <span style="font-size: 24px"> <b>List Size</b> </span><br><span style="font-size: 16px">The number of ships in each list.</span>
<table class="front" style="width: 100%">

<?php
    
    $sizes = array();
    
    $sql = "select 1 + CHAR_LENGTH(l.build_ids) - CHAR_LENGTH(REPLACE(l.build_ids, ',', '')) as Winner_Size, SUM(points * SQRT(attendance)) as total from tournaments as t join placing as p on t.id = p.tournament_id join lists as l on l.id = p.list_id where t.date >= '". $s ."' and t.date <= '". $e ."' ".($w == 1 ? "and p.points = 5 " : "")."Group By Winner_Size";
    
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
        array_push($sizes, array($row[0], $row[1]));
    }
    $total = 0;
    foreach ($sizes as $size){
        $total += $size[1];
    }
    
    foreach($sizes as $size) {
        echo "<tr><td>". $size[0] ."<span style='font-size: 12px'> - " . round($size[1] / $total * 100) ."%</span></td></tr>";
    }
    
    ?>  
</tbody>
</table>
</div>

<div class="list">
<br> <span style="font-size: 24px"> <b>Pilot Skill (Max)</b> </span><br><span style="font-size: 16px">The first number represents all ships, the second only includes the highest PS in each list.</span>
<table class="front" style="width: 100%">

<?php
    
    $skills = array();
    
    $sql = "select a1.skill, a1.Wins, a2.Wins from (select IF(find_in_set(22, b.upgrades), pi.skill + 2, pi.skill) as skill, SUM(points * SQRT(attendance)) as Wins from tournaments as t join placing as p on t.id = p.tournament_id join list_builds as l on l.list_id = p.list_id join builds as b on b.id = l.build_id join pilots as pi on pi.id = b.pilot_id where t.date >= '". $s ."' and t.date <= '". $e ."' ".($w == 1 ? "and p.points = 5 " : "")."Group By IF(find_in_set(22, b.upgrades), pi.skill + 2, pi.skill)) a1 left join (select skill.skill, SUM(points * SQRT(attendance)) as Wins from tournaments as t join placing as p on t.id = p.tournament_id join ( select  l.list_id, max(IF(find_in_set(22, b.upgrades), pi.skill + 2, pi.skill)) as skill from list_builds as l join builds as b on l.build_id = b.id join pilots as pi on b.pilot_id = pi.id group by l.list_id ) as skill on skill.list_id = p.list_id where t.date >= '". $s ."' and t.date <= '". $e ."' ".($w == 1 ? "and p.points = 5 " : "")."Group By skill.skill) a2 on a1.skill = a2.skill ORDER BY skill ASC";
    
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
        array_push($skills, array($row[0], $row[1], $row[2]));
    }

    $total = 0;
    $maxtotal = 0;
    foreach ($skills as $skill){
        $total += $skill[1];
        $maxtotal += $skill[2];
    }
    
    foreach($skills as $skill) {
        echo "<tr><td>". $skill[0] ."<span style='font-size: 12px'> - " . round($skill[1] / $total * 100) ."% (" . round($skill[2] / $maxtotal * 100) ."%)</span></td></tr>";
    }
    
    ?>
</tbody>
</table>
</div>

<div class="list">
<br> <span style="font-size: 24px"> <b>Total Squad Cost</b> </span><br><span style="font-size: 16px">Breakdown by squad cost, useful for planning your iniative bids.</span>
<table class="front" style="width: 100%">

<?php
    
    $costs = array();
    
    $sql = "select case when c.cost < 100 then c.cost else 100 end, SUM(points * SQRT(attendance)) as total from tournaments as t join placing as p on t.id = p.tournament_id join (select l.list_id, SUM(pi.cost + ifnull(us.cost,0)) as cost from list_builds as l join builds as b on b.id = l.build_id join pilots as pi on pi.id = b.pilot_id left join (select bu.build_id, sum(u.cost) as cost from build_upgrades as bu join upgrades as u on u.id = bu.upgrade_id group by bu.build_id) as us on us.build_id = b.id group by l.list_id) as c on c.list_id = p.list_id where t.date >= '". $s ."' and t.date <= '". $e ."' ".($w == 1 ? "and p.points = 5 " : "")."group by case when c.cost < 100 then c.cost else 100 end order by case when c.cost < 100 then c.cost else 100 end desc";
    
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
        array_push($costs, array($row[0], $row[1]));
    }
    
    $total = 0;
    foreach ($costs as $cost){
        $total += $cost[1];
    }
    
    foreach($costs as $cost) {
        echo "<tr><td>". $cost[0] ."<span style='font-size: 12px'> - " . round($cost[1] / $total * 100) ."%</span></td></tr>";
    }
    
    ?>
</tbody>
</table>
</div>

</body>
</html>

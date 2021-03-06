<?php
session_start(); 
require "db.php";

?>


<html>
<head>
<title>Mini Ranker: Armada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="armada.css">
  <link rel="shortcut icon" href="favicon.ico">
<meta name="keywords" content="armada, fleet, fleets, list, lists, build, builds, tournaments, rankings, best, results, ships, ideas, top, winning, 2015, championship, ffg, minis">
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
<div class="list">
    <br> <span style="font-size: 24px"> <b>Most Recent Tournaments</b> </span>
 <table id="front" class="front" style="width: 100%">
   <thead>
                    <tr>
                        <th>Venue</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Attendance</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
   <?php
  
  $tournaments = array();
  $sql = "Select id, venue, city, country, attendance, date from tournaments order by date desc limit 10;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($tournaments, $row);
  }
  
  foreach($tournaments as $tourny) {
    echo "<tr><td><a href='tournament.php?t=". $tourny[0] ."&d=". $d ."&f=". $f ."'>". $tourny[1] ."</td><td>". $tourny[2] ."</td><td>". $tourny[3] ."</td><td>". $tourny[4] ."</td><td>". $tourny[5] ."</td></tr>";
}
                   
?>  
      </tbody>
  </table>

  </div>
    

<div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Squads</b> </span><br><br>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
if ($f == 0){
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id group by list_id order by total desc limit 10";
}else{
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id join lists on placing.list_id = lists.id join builds on LEFT(lists.build_ids,LOCATE(',',lists.build_ids) - 1) = builds.id join ships on builds.ship_id = ships.id where faction = ". $f ." group by list_id order by total desc limit 10";
} $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, $row[0]);
  }
  
  foreach($squads as $key => $squad) {
    $list = "";
    $sql = "select group_concat(b.id order by b.cost desc separator ',') from list_builds lb join builds b on b.id = lb.build_id where lb.list_id = ". $squad;
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $ships = explode(',', $list);
    $ship_count = array_count_values($ships);

    $count = count($ship_count);
    $at = 0;
    echo "<tr><td>";
    foreach($ship_count as $key => $ship) {
        $pilot = array();
        $sql = "Select ships.name, builds.upgrades, case when ships.fighter = 1 then 0 else ships.faction end FROM builds join ships on builds.ship_id = ships.id WHERE builds.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($pilot, $row[0], $row[1], $row[2]);
        }

        echo "<a href='/squad.php?s=". $squad ."&d=". $d ."&f=". $f ."'>";
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
	if ($pilot[2] != 0 and ++$at != $count) {
		echo "<br>";
        }
     }
     echo "</a><br><br></td></tr>";
}
                   
?>  
      </tbody>
  </table>

  </div>
<?php include 'foot.php'; ?>
</body>
</html>

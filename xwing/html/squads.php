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
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id join lists on placing.list_id = lists.id join builds on LEFT(lists.build_ids,LOCATE(',',lists.build_ids) - 1) = builds.id join pilots on builds.pilot_id = pilots.id where faction = ". $f ." group by list_id order by total desc limit 50";
}$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, array($row[0], $row[1]));
  }
  $top = $squads[0][1];

  foreach($squads as $key => $squad) {
    $list = "";
    $sql = "select group_concat(b.id order by b.cost desc, p.id separator ',') from list_builds lb join builds b on b.id = lb.build_id join pilots p on p.id = b.pilot_id where lb.list_id =". $squad[0];
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $ships = explode(',', $list);
    $ship_count = array_count_values($ships);
    echo "<tr><td><span style='font-size: 12px'>". round($squad[1] / $top * 100) ." - </span>";
    echo "<a href='/squad.php?s=". $squad[0] ."&d=". $d ."&f=". $f ."'>";
    foreach($ship_count as $key => $ship) {
        $pilot = array();
        $sql = "Select pilots.name, builds.upgrades, pilots.faction FROM builds join pilots on builds.pilot_id = pilots.id WHERE builds.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($pilot, $row[0], $row[1], $row[2]);
        }

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
		echo "<span style='color: #FF9966; font-size: 18px'>";
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
        echo ";<br>";
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

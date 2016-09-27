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
Below is a list of the top squads simplified to pilot compostion based on current data, select a squad to see more information on what tournaments it placed in.
<br><br>
The values to the left of each squad are relative points for better comparison of rankings.
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Squads</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
if ($f == 0){
  $sql = "select (select GROUP_Concat(p.id ORDER BY p.cost desc SEPARATOR ',') from list_builds lb join builds b on b.id = lb.build_id join pilots p on b.pilot_id = p.id where lb.list_id = x.list_id) as pilotlist, SUM(total) from (Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id group by list_id order by total desc) as x group by pilotlist order by SUM(total) desc limit 50;";
}else{
  $sql = "select (select GROUP_Concat(p.id ORDER BY p.cost desc SEPARATOR ',') from list_builds lb join builds b on b.id = lb.build_id join pilots p on b.pilot_id = p.id and p.faction = ". $f ." where lb.list_id = x.list_id) as pilotlist, SUM(total) from (Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id join lists on placing.list_id = lists.id join builds on LEFT(lists.build_ids,LOCATE(',',lists.build_ids) - 1) = builds.id join pilots on builds.pilot_id = pilots.id where faction = ". $f ." group by list_id order by total desc) as x group by pilotlist order by SUM(total) desc limit 50;";
}$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, array($row[0], $row[1]));
  }
  $top = $squads[0][1];

  foreach($squads as $key => $squad) {

    $ships = explode(',', $squad[0]);
    $ship_count = array_count_values($ships);
    echo "<tr><td><span style='font-size: 12px'>". round($squad[1] / $top * 100) ." - </span>";
    echo "<a href='/pilotlist.php?p=". $squad[0] ."&d=". $d ."&f=". $f ."'>";
    foreach($ship_count as $key => $ship) {
	$pilot = array();
        $sql = "Select pilots.name, pilots.faction FROM pilots WHERE pilots.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($pilot, $row[0], $row[1]);
        }
	
        switch ($pilot[1]){
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
        
	if ($ship > 1) {
          echo "<span style='color: #CCCCCC; font-size: 18px'>&nbsp;x". $ship ."</span>";
        } 
        echo "; ";
     }
     echo "</td></tr>";
}
                   
?>  
      </tbody>
  </table>

  </div>
<?php include 'foot.php'; ?>
</body>
</html>

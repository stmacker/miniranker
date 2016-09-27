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
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
  <div class="details">
Below is a list of the top fleets simplified to ship compostion based on current data, select a squad to see more information on what tournaments it placed in.
<br><br>
The values to the left of each squad are relative points for better comparison of rankings.
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Fleets</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
if ($f == 0){
  $sql = "select (select GROUP_Concat(s.id ORDER BY s.cost desc SEPARATOR ',') from list_builds lb join builds b on b.id = lb.build_id join ships s on b.ship_id = s.id where lb.list_id = x.list_id) as shiplist, SUM(total) from (Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id group by list_id order by total desc) as x group by shiplist order by SUM(total) desc limit 50;";
}else{
  $sql = "select (select GROUP_Concat(s.id ORDER BY s.cost desc SEPARATOR ',') from list_builds lb join builds b on b.id = lb.build_id join ships s on b.ship_id = s.id and s.faction = ". $f ." where lb.list_id = x.list_id) as shiplist, SUM(total) from (Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id join lists on placing.list_id = lists.id join builds on LEFT(lists.build_ids,LOCATE(',',lists.build_ids) - 1) = builds.id join ships on builds.ship_id = ships.id where faction = ". $f ." group by list_id order by total desc) as x group by shiplist order by SUM(total) desc limit 50;";
}$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, array($row[0], $row[1]));
  }
  $top = $squads[0][1];

  foreach($squads as $key => $squad) {

    $ships = explode(',', $squad[0]);
    $ship_count = array_count_values($ships);
    echo "<tr><td><span style='font-size: 12px'>". round($squad[1] / $top * 100) ." - </span>";
    echo "<a href='/shiplist.php?s=". $squad[0] ."&d=". $d ."&f=". $f ."'>";
    foreach($ship_count as $key => $ship) {
	$pilot = array();
        $sql = "Select ships.name, case when ships.fighter = 1 then 0 else ships.faction end FROM ships WHERE ships.id =". $key;
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
		echo "<span style='color: #FF9966; font-size: 16px'>";
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

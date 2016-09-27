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
<meta name="keywords" content="imperial, assault, squad, squads, list, lists, ia, starwars, tournaments, rankings, best, results, units, ideas, top, winning, 2015, championship, ffg, minis">
</head>
<body bgcolor="black">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45039417-1', 'macker.co');
  ga('send', 'pageview');

</script>

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
    <br> <span style="font-size: 24px"> <b>Top Ranked Squads</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
if ($f == 0){
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id group by list_id order by total desc limit 10";
}else{
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from placing join tournaments on placing.tournament_id = tournaments.id join lists on placing.list_id = lists.id join units on LEFT(lists.unit_ids,LOCATE(',',lists.unit_ids) - 1) = units.id where faction = ". $f ." group by list_id order by total desc limit 10";
} $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, $row[0]);
  }
  
  foreach($squads as $key => $squad) {
    $list = "";
    $sql = "select group_concat(u.id order by u.cost desc separator ',') from list_units lu join units u on u.id = lu.unit_id where lu.list_id = ". $squad;
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $units = explode(',', $list);
    $unit_count = array_count_values($units);
    echo "<tr><td>";
    foreach($unit_count as $key => $unit) {
        $current = array();
        $sql = "Select name, case when units.unit_type = 10 then 0 else units.faction end FROM units WHERE units.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($current, $row[0], $row[1]);
        }

        echo "<a href='/squad.php?s=". $squad ."&d=". $d ."&f=". $f ."'>";
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

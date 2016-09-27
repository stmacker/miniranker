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
Below are the upgrades ordered by how they rank in tournaments, click an upgrade to get more info on what builds are popular and effective!
<br><br>
The values to the left of each upgrade are relative points for better comparison of rankings.
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Upgrades</b> </span>
   <span style='color: #CCCCCC; font-size: 18px'> (Cost)<span>
 <table class="front" style="width: 100%">

   <?php
  
  $upgrades = array();
  if ($f == 0){
    $sql = "Select upgrades.id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from upgrades left join builds on find_in_set(upgrades.id, builds.upgrades) left join lists on find_in_set(builds.id, lists.build_ids) left join placing on lists.id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id group by upgrades.id order by total desc;";
  }else{
    $sql = "Select upgrades.id, SUM(case when pilots.faction = ". $f ." then 1 else 0 end * points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from upgrades left join builds on find_in_set(upgrades.id, builds.upgrades) left join lists on find_in_set(builds.id, lists.build_ids) left join placing on lists.id = placing.list_id left join tournaments on placing.tournament_id = tournaments.id left join pilots on builds.pilot_id = pilots.id where (upgrades.faction = 0 or locate(". $f .", upgrades.faction) > 0) group by upgrades.id order by total desc;";
  }
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($upgrades, array($row[0], $row[1]));
  }
  $top = $upgrades[0][1];
  
    foreach($upgrades as $upgrade) {
        $name = array();
        $sql = "Select name, cost, effect from upgrades WHERE id =". $upgrade[0];
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($name, $row[0], $row[1], $row[2]);
        }

        echo "<tr><td title='". $name[2] ."'><span style='font-size: 12px'>". round($upgrade[1] / $top * 100) ." - </span><a href='upgrade.php?u=". $upgrade[0] ."&d=". $d ."&f=". $f ."'><span style='color: #33CCFF; font-size: 18px'>". $name[0] ."</span> <span style='color: #CCCCCC;'>(". $name[1] .")</a></td></tr>";
     }
                   
?>  
      </tbody>
  </table>
  </div>

<?php include 'foot.php'; ?>
</body>
</html>

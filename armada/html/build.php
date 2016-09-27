<?php
session_start(); 
require "db.php";

$b = $_GET['b'];
  if (is_null($b)){
    header("location: builds.php");
  }

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
<?php
        $pilot = array();
        $sql = "Select ships.id, ships.name, builds.upgrades, ships.cost, ships.faction, builds.nickname FROM builds join ships on builds.ship_id = ships.id WHERE builds.id =". $b;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($pilot, $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
        }

        if ($pilot[5] != '') {
 	  echo "<span style='font-size: 24px'>". $pilot[5] ."</span><br><br>";
 	}
        
	echo "<a href='/ship.php?s=". $pilot[0] ."&d=". $d ."&f=". $f ."'>";
	switch ($pilot[4]){
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
		echo "<span style='color: #FF9966; font-size: 18px'>";
		break;
	}
	echo "<b>" .$pilot[1] ."</b></span></a> (". $pilot[3] .")";

        if (!is_null($pilot[2])) {
	$upgrades = array();
        $upgrades = explode(',', $pilot[2]);

        foreach($upgrades as $upgrade) {
          $upg = array();
          $sql = "Select name, cost, effect FROM upgrades WHERE id =". $upgrade;
          $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
          while($row = mysql_fetch_row($result)){
          array_push($upg, $row[0], $row[1], $row[2]);
          }
          echo "<br><a title='". $upg[2] ."' href='/ship-builds.php?s=". $pilot[0] ."&u=". $upgrade . "&d=". $d ."&f=". $f ."'><span style='color: #33CCFF;'> + ". $upg[0] ."</span> <span style='color: #CCCCCC;'>(". $upg[1] .")</span></a>";
        }
	
     }
?>
</div>

    <div class="list">
    <br> <span style="font-size: 24px"> <b>Top Ranked Squads</b> </span>
 <table class="front" style="width: 100%">

   <?php
  
  $squads = array();
  $sql = "Select list_id, SUM(points * SQRT(attendance) * (-(DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/abs((DATEDIFF(CURDATE(), tournaments.date) - ". $d .")/49.9)+50)) as total from lists join placing on lists.id = placing.list_id join tournaments on placing.tournament_id = tournaments.id where find_in_set(". $b .", lists.build_ids) group by list_id order by total desc;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($squads, array($row[0], $row[1]));
  }
  $top = $squads[0][1];

  foreach($squads as $key => $squad) {
    $list = "";
    $sql = "select group_concat(b.id order by b.cost desc separator ',') from list_builds lb join builds b on b.id = lb.build_id where lb.list_id = ". $squad[0];
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    }
    
    $ships = explode(',', $list);
    $ship_count = array_count_values($ships);
    echo "<tr><td><span style='font-size: 12px'>". round($squad[1] / $top * 100) ." - </span>";
    foreach($ship_count as $key => $ship) {
        $pilot = array();
        $sql = "Select ships.name, builds.upgrades, case when ships.fighter = 1 then 0 else ships.faction end FROM builds join ships on builds.ship_id = ships.id WHERE builds.id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($pilot, $row[0], $row[1], $row[2]);
        }

        echo "<a href='/squad.php?s=". $squad[0] ."&d=". $d ."&f=". $f ."'>";
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
	if ($pilot[2] != 0) {
		echo "<br>";
        }
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

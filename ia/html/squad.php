<?php
session_start(); 
require "db.php";

$s = $_GET['s'];
  if (is_null($s)){
    header("location: squads.php");
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="ia.js"></script>
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
  <div class="details">
<?php
    $list = "";
    $sql = "select group_concat(u.id order by u.cost desc separator ',') from list_units lu join units u on u.id = lu.unit_id where lu.list_id = ". $s;
    $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    while($row = mysql_fetch_row($result)){
    $list = $row[0];
    $name = $row[1];
    }
    
    if (!is_null($name)){
        echo "<span style='color: #CCCCCC; font-size: 24px'>\"". $name ."\"</span><br><br>";
    }

    $units = explode(',', $list);
    $unit_count = array_count_values($units);
    foreach($unit_count as $key => $unit) {
        $current = array();
        $sql = "Select name, cost, case when units.unit_type = 10 then 0 else units.faction end FROM units WHERE id =". $key;
        $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
        while($row = mysql_fetch_row($result)){
        array_push($current, $row[0], $row[1], $row[2]);
        }
	
        echo "<a href='/unit.php?u=". $key ."&d=". $d ."&f=". $f ."'>";
	switch ($current[2]){
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
	echo "<b>". $current[0] ."</b></span>";
	if ($unit > 1) {
          echo "<span style='color: #CCCCCC; font-size: 18px'><b> x". $unit ."</b></span>";
        } 
        echo "<span style='color: #CCCCCC; font-size: 18px'> (". $current[1] .") </span></a><br>";
     }

?></div>    <div class="list">
    <br> <span style="font-size: 24px"> <b>Most Recent Tournament Placings</b> </span>
 <table id="front" class="front" style="width: 100%">
   <thead>
                    <tr>
			<th>Placing</th>
                        <th>Venue</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Date</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
   <?php
  
  $tournaments = array();
  $sql = "Select DISTINCT tournaments.id, venue, city, country, attendance, date, points from placing join tournaments on placing.tournament_id = tournaments.id where placing.list_id =". $s ." order by date desc;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($tournaments, $row);
  }
  
  foreach($tournaments as $tourny) {
    echo "<tr><td>";
    switch ($tourny[6]){
	case 5: echo "1st"; break;
	case 4: echo "2nd"; break;
	case 3: echo "Top 4"; break;
	case 2: echo "Top 8"; break;
	case 1: echo "Top 16"; break;
    }
    echo "</td><td><a href='tournament.php?t=". $tourny[0] ."&d=". $d ."&f=". $f ."'>". $tourny[1] ."</td><td>". $tourny[2] ."</td><td>". $tourny[3] ."</td><td>". $tourny[5] ."</td><td>". $tourny[4] ."</td></tr>";
}
                   
?>  
      </tbody>
  </table>
  </div>
<?php include 'foot.php'; ?>
</body>
</html>

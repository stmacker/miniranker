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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="xwing.js"></script>
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
  <div class="details">
Below is a list of the most recent tournaments we have the results for, click a tournament to view more details and the top squads from it.
<br><br><form action='http://xwing.miniranker.com/addTournament.php'><input type='submit' value='Add New Tournament'></form>  

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
  $sql = "Select id, venue, city, country, attendance, date from tournaments where DATEDIFF(CURDATE(), tournaments.date) <= ". $d ." order by date desc;";
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
<?php include 'foot.php'; ?>
</body>
</html>

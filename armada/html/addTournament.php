<?php
session_start(); 
require "db.php";

?>
<html>
<head>
<title>Mini Ranker: Armada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="tournament.js"></script>
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="armada.css">
  <link rel="shortcut icon" href="favicon.ico">
</head>
<body bgcolor="black">

  <?php include 'head.php'; ?>
  <br>
    <div class="list">
    <br> <span style="font-size: 24px"> <b>Add New Tournament</b> </span>
 <div class="details">

<br>
<form method='post' id='squad'>
Date:<input type="date" id="date" value="<?php echo date('Y-m-d'); ?>">
<br>
Attendance:<input type='number' id='a' style='width: 4em' min='1' max='999'>
<br>
Venue:&nbsp;<input id='venue' type='text' maxlength="50">
<br>
City:&nbsp;<input id='city' type='text' maxlength="50">
<br>
Country:&nbsp;<input id='country' type='text' style='width: 3em' maxlength="2">
<br>
<input type='submit' value='Submit New Tourny' class='submit'/>
<span class="error" style="display:none; color: red"><br> Error Adding Tournament </span>
<span class="success" style="display:none; color: green"><br> Added Successfully</span>
</form>
</div>



<?php include 'foot.php'; ?>
</body>
</html>

<?php
session_start(); 
require "db.php";
?>
<html>
<head>
<title>X-Wing Squad Ranker</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="stylesheet" href="head.css">
  <link rel="stylesheet" href="armada.css">
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
<div>
Inserting: 
<?php
$i = 2;
while($i <= 1000) {
  $sql = "INSERT INTO `builds`(`id`, `nickname`, `ship_id`, `upgrades`) VALUES (". $i .", null, ". $i .", null)";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  echo "<br>". $i;
  $i++;
}

?>
</div>
<?php include 'foot.php'; ?>
</body>
</html>
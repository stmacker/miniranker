<?php
session_start(); 
require "db.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>X-Wing Squad Ranker</title>
<link rel="shortcut icon" href="favicon.ico">
</head>
<body>
<?php

$sql = "insert into comments (page, ref_id, name, comment, date, active) values ('". $_POST['page'] ."', '". $_POST['ref_id'] ."', '". $_POST['name'] ."', '". addslashes($_POST['comment']) ."', CURDATE(), 0)";
$result = mysql_query($sql) or die("Unable to select: ".mysql_error());

?>
<br> Unless you see an error your comment has been submitted and will show up once approved. Thanks!
</body>
</html>
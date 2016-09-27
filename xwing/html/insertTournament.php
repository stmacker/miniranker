<?php

require "db.php";

if($_POST)
{
	$date=$_POST['date'];
	$a=$_POST['a'];
	$v=$_POST['v'];
	$city=$_POST['city'];
	$country=$_POST['country'];

	mysql_query("insert into tournaments(date,attendance,venue,city,country) values ('".$date."',".$a.",'".$v."','".$city."','".$country."')") or die("Unable to select: ".mysql_error());
    
    $result = mysql_query("select id from tournaments order by id desc limit 1") or die("Unable to select: ".mysql_error());
    echo mysql_fetch_row($result)[0];
    

}
	


?>
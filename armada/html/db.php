<?php
$connection = mysql_connect('db.miniranker.com', 'armada', 'password');
if (!$connection){
    die("Database Connection Failed" . mysql_error());
}
$select_db = mysql_select_db('armada');
if (!$select_db){
    die("Database Selection Failed" . mysql_error());
}
?>
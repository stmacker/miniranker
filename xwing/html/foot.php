<?php

if (is_null($d)){
    $d = 120;
  }

if (is_null($f)){
    $f = 0;
  }

$page = basename($_SERVER['PHP_SELF']);

if ($page == 'tournament.php' || $page == 'squad.php' || $page == 'build.php' || $page == 'pilot.php' || $page == 'ship.php' || $page == 'upgrade.php')
{
switch ($page){
	case "tournament.php":
  		$ref_id = $t;
	break;
	case "squad.php":
		$ref_id = $s;
	break;
	case "build.php":
		$ref_id = $b;
	break;
	case "pilot.php":
		$ref_id = $p;
	break;
	case "ship.php":
		$ref_id = $s;
	break;
	case "upgrade.php":
		$ref_id = $u;
	break;
}

$comments = array();
  $sql = "Select name, date, comment from comments where active = 1 and page = '". $page ."' and ref_id = ". $ref_id ." order by date;";
  $result = mysql_query($sql) or die("Unable to select: ".mysql_error());
  while($row = mysql_fetch_row($result)){
  array_push($comments, $row);
  }

echo "<div class='list'><br>";
if (!empty($comments)){
echo "<span style='font-size: 18px'> <b>Comments</b> </span>
	<table id='front' class='front' style='width: 100%'><tbody>";

  foreach($comments as $comment) {
    echo "<tr><td width=20%>". $comment[0] ."<br><span style='font-size: 14px'>". date('Y.m.d', strtotime(str_replace('/','-',$comment[1]))) ."</span></td><td width=80%>". $comment[2] ."</td></tr>";
  }
  echo	"</tbody></table>";
}
else {
echo "<span style='font-size: 18px'> No Comments added yet for this page! </span><br>";
}
  echo "<br> <span style='font-size: 18px'><b>Add New Comment</b>
  <form action='newcomment.php' method='POST' id='newcomment'>
  <textarea rows='3' cols='60' maxlength'280' name='comment'>Comment here</textarea>
  <br> Name:<input type='text' name='name'>
  <input type='hidden' name='page' value='". $page ."'>
  <input type='hidden' name='ref_id' value='". $ref_id ."'>
  <input type='submit'> 
  </form> </span>
   
  </div>";
}

echo "<div class='details' style='min-height: 101px; width: 100%; font-size: 18px'><br>
<form action='". $go ."' method='GET'>
   Currently showing
   <input type='number' name='d' style='width: 3em' value='". $d ."' min='7' max='999'> days of data, for <select name='f'>
          <option value='0'>All Factions</option>
	  <option ";
   if($f == 1){
     echo "selected='selected' ";
   }
   echo "value='1'>Rebels</option>
          <option ";
   if($f == 2){
     echo "selected='selected' ";
   }
   echo "value='2'>Imperials</option>
	  <option ";
   if($f == 3){
     echo "selected='selected' ";
   }
   echo "value='3'>Scum & Villainy</option>
         </select>";
if (!is_null($b)){
    echo "<input type='hidden' name='b' value='". $b ."'>";
}
if (!is_null($p)){
    echo "<input type='hidden' name='p' value='". $p ."'>";
}
if (!is_null($s)){
    echo "<input type='hidden' name='s' value='". $s ."'>";
}
if (!is_null($t)){
    echo "<input type='hidden' name='t' value='". $t ."'>";
}
if (!is_null($u)){
    echo "<input type='hidden' name='u' value='". $u ."'>";
}  
echo " <button type='submit'>Refresh Data</button></form></div>";

?>

<div class="list" style="font-size: 16px">
<br><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Star Wars -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-6033037243897344"
     data-ad-slot="6710031716"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>


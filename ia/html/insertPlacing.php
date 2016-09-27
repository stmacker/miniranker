<?php

require "db.php";

if($_POST)
{
	$t=$_POST['t'];
	$p=$_POST['p'];
	$s=$_POST['s'];
	if (is_null($s) || $s == ''){
		$p1=$_POST['p1'];
		$p1copies=$_POST['p1copies'];
		
		$p2=$_POST['p2'];
		$p2copies=$_POST['p2copies'];
		
		$p3=$_POST['p3'];
		$p3copies=$_POST['p3copies'];
		
		$p4=$_POST['p4'];
		$p4copies=$_POST['p4copies'];
		
		$p5=$_POST['p5'];
		$p5copies=$_POST['p5copies'];
		
		$p6=$_POST['p6'];
		$p6copies=$_POST['p6copies'];
		
		$p7=$_POST['p7'];
		$p7copies=$_POST['p7copies'];
		
		$p8=$_POST['p8'];
		$p8copies=$_POST['p8copies'];

		$p9=$_POST['p9'];
		$p9copies=$_POST['p9copies'];

		$p0=$_POST['p0'];
		$p0copies=$_POST['p0copies'];

		
	}

	if (!is_null($s) && $s != ''){
		mysql_query("insert into placing(tournament_id, list_id, points) values (".$t.",".$s.",".$p.")") or die("Unable to select: ".mysql_error());
	}else{
	$buildids = array();	
		
	if(!is_null($p1) && $p1 != ''){
			
			$sql = "select id from units where name = '". $p1 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p1id = $row[0];
				
				
			for($i = 0; $i < $p1copies; $i++){
				array_push($buildids, $p1id);
			}
				
	}
	
	if(!is_null($p2) && $p2 != ''){
			
			$sql = "select id from units where name = '". $p2 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p2id = $row[0];
				
		
			
			for($i = 0; $i < $p2copies; $i++){
				array_push($buildids, $p2id);
			}
				
	}

	if(!is_null($p3) && $p3 != ''){
			
			$sql = "select id from units where name = '". $p3 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p3id = $row[0];
				
		
			
			for($i = 0; $i < $p3copies; $i++){
				array_push($buildids, $p3id);
			}
				
	}

	if(!is_null($p4) && $p4 != ''){
			
			$sql = "select id from units where name = '". $p4 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p4id = $row[0];
				
		
			
			for($i = 0; $i < $p4copies; $i++){
				array_push($buildids, $p4id);
			}
				
	}

	if(!is_null($p5) && $p5 != ''){
			
			$sql = "select id from units where name = '". $p5 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p5id = $row[0];
				
		
			
			for($i = 0; $i < $p5copies; $i++){
				array_push($buildids, $p5id);
			}
				
	}

	if(!is_null($p6) && $p6 != ''){
			
			$sql = "select id from units where name = '". $p6 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p6id = $row[0];
				
		
			
			for($i = 0; $i < $p6copies; $i++){
				array_push($buildids, $p6id);
			}
				
	}

	if(!is_null($p7) && $p7 != ''){
			
			$sql = "select id from units where name = '". $p7 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p7id = $row[0];
				
		
			
			for($i = 0; $i < $p7copies; $i++){
				array_push($buildids, $p7id);
			}
				
	}

	if(!is_null($p8) && $p8 != ''){
			
			$sql = "select id from units where name = '". $p8 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p8id = $row[0];
				
		
			
			for($i = 0; $i < $p8copies; $i++){
				array_push($buildids, $p8id);
			}
				
	}

	if(!is_null($p9) && $p9 != ''){
			
			$sql = "select id from units where name = '". $p9 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p9id = $row[0];
				
		
			
			for($i = 0; $i < $p9copies; $i++){
				array_push($buildids, $p9id);
			}
				
	}

	if(!is_null($p0) && $p0 != ''){
			
			$sql = "select id from units where name = '". $p0 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p0id = $row[0];
				
		
			
			for($i = 0; $i < $p0copies; $i++){
				array_push($buildids, $p0id);
			}
				
	}
	
	$squadid = '';
	
	asort($buildids);
	
				$sql = "select id from lists where unit_ids = '". implode(',',$buildids) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$squadid = $row[0];
	
	if(is_null($squadid) || $squadid == ''){
		mysql_query("insert into lists(unit_ids) values ('".implode(',',$buildids)."')") or die("Unable to select: ".mysql_error());
		
				$sql = "select id from lists where unit_ids = '". implode(',',$buildids) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$squadid = $row[0];
				
				foreach($buildids as $build){
					mysql_query("insert into list_units(list_id, unit_id) values (".$squadid.",".$build.")") or die("Unable to select: ".mysql_error());				
				}
	}
	
	mysql_query("insert into placing(tournament_id, list_id, points) values (".$t.",".$squadid.",".$p.")") or die("Unable to select: ".mysql_error());
		
	}

	

}
	


?>
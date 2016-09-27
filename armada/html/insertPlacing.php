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
		$p1u1=$_POST['p1u1'];
		$p1u2=$_POST['p1u2'];
		$p1u3=$_POST['p1u3'];
		$p1u4=$_POST['p1u4'];
		$p1u5=$_POST['p1u5'];
		$p1u6=$_POST['p1u6'];
		$p1u7=$_POST['p1u7'];
		$p1u8=$_POST['p1u8'];
		$p2=$_POST['p2'];
		$p2copies=$_POST['p2copies'];
		$p2u1=$_POST['p2u1'];
		$p2u2=$_POST['p2u2'];
		$p2u3=$_POST['p2u3'];
		$p2u4=$_POST['p2u4'];
		$p2u5=$_POST['p2u5'];
		$p2u6=$_POST['p2u6'];
		$p2u7=$_POST['p2u7'];
		$p2u8=$_POST['p2u8'];
		$p3=$_POST['p3'];
		$p3copies=$_POST['p3copies'];
		$p3u1=$_POST['p3u1'];
		$p3u2=$_POST['p3u2'];
		$p3u3=$_POST['p3u3'];
		$p3u4=$_POST['p3u4'];
		$p3u5=$_POST['p3u5'];
		$p3u6=$_POST['p3u6'];
		$p3u7=$_POST['p3u7'];
		$p3u8=$_POST['p3u8'];
		$p4=$_POST['p4'];
		$p4copies=$_POST['p4copies'];
		$p4u1=$_POST['p4u1'];
		$p4u2=$_POST['p4u2'];
		$p4u3=$_POST['p4u3'];
		$p4u4=$_POST['p4u4'];
		$p4u5=$_POST['p4u5'];
		$p4u6=$_POST['p4u6'];
		$p4u7=$_POST['p4u7'];
		$p4u8=$_POST['p4u8'];
		$p5=$_POST['p5'];
		$p5copies=$_POST['p5copies'];
		$p5u1=$_POST['p5u1'];
		$p5u2=$_POST['p5u2'];
		$p5u3=$_POST['p5u3'];
		$p5u4=$_POST['p5u4'];
		$p5u5=$_POST['p5u5'];
		$p5u6=$_POST['p5u6'];
		$p5u7=$_POST['p5u7'];
		$p5u8=$_POST['p5u8'];
		$p6=$_POST['p6'];
		$p6copies=$_POST['p6copies'];
		$p6u1=$_POST['p6u1'];
		$p6u2=$_POST['p6u2'];
		$p6u3=$_POST['p6u3'];
		$p6u4=$_POST['p6u4'];
		$p6u5=$_POST['p6u5'];
		$p6u6=$_POST['p6u6'];
		$p6u7=$_POST['p6u7'];
		$p6u8=$_POST['p6u8'];
		$p7=$_POST['p7'];
		$p7copies=$_POST['p7copies'];
		$p7u1=$_POST['p7u1'];
		$p7u2=$_POST['p7u2'];
		$p7u3=$_POST['p7u3'];
		$p7u4=$_POST['p7u4'];
		$p7u5=$_POST['p7u5'];
		$p7u6=$_POST['p7u6'];
		$p7u7=$_POST['p7u7'];
		$p7u8=$_POST['p7u8'];
		$p8=$_POST['p8'];
		$p8copies=$_POST['p8copies'];
		$p8u1=$_POST['p8u1'];
		$p8u2=$_POST['p8u2'];
		$p8u3=$_POST['p8u3'];
		$p8u4=$_POST['p8u4'];
		$p8u5=$_POST['p8u5'];
		$p8u6=$_POST['p8u6'];
		$p8u7=$_POST['p8u7'];
		$p8u8=$_POST['p8u8'];
	}

	if (!is_null($s) && $s != ''){
		mysql_query("insert into placing(tournament_id, list_id, points) values (".$t.",".$s.",".$p.")") or die("Unable to select: ".mysql_error());
	}else{
	$buildids = array();	
		
	if(!is_null($p1) && $p1 != ''){
			$p1upgrades = array();
			
			$sql = "select id from ships where name = '". $p1 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p1id = $row[0];
				
			if(!is_null($p1u1) && $p1u1 != ''){
			$sql = "select id from upgrades where name = '". $p1u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!is_null($p1u2) && $p1u2 != ''){
			$sql = "select id from upgrades where name = '". $p1u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!is_null($p1u3) && $p1u3 != ''){
			$sql = "select id from upgrades where name = '". $p1u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!is_null($p1u4) && $p1u4 != ''){
			$sql = "select id from upgrades where name = '". $p1u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!is_null($p1u5) && $p1u5 != ''){
			$sql = "select id from upgrades where name = '". $p1u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!is_null($p1u6) && $p1u6 != ''){
			$sql = "select id from upgrades where name = '". $p1u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!is_null($p1u7) && $p1u7 != ''){
			$sql = "select id from upgrades where name = '". $p1u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!is_null($p1u8) && $p1u8 != ''){
			$sql = "select id from upgrades where name = '". $p1u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p1upgrades, $row[0]);
			}
			
			if(!empty($p1upgrades)){
				asort($p1upgrades);
			
				$sql = "select id from builds where ship_id = ". $p1id ." and upgrades = '". implode(',',$p1upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p1build = $row[0];
					
				if(is_null($p1build) || $p1build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p1id.",'".implode(',',$p1upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p1id ." and upgrades = '". implode(',',$p1upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p1build = $row[0];
					
					foreach($p1upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p1build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p1id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p1build = $row[0];
			}
			
			for($i = 0; $i < $p1copies; $i++){
				array_push($buildids, $p1build);
			}
				
	}
	
	if(!is_null($p2) && $p2 != ''){
			$p2upgrades = array();
			
			$sql = "select id from ships where name = '". $p2 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p2id = $row[0];
				
			if(!is_null($p2u1) && $p2u1 != ''){
			$sql = "select id from upgrades where name = '". $p2u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!is_null($p2u2) && $p2u2 != ''){
			$sql = "select id from upgrades where name = '". $p2u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!is_null($p2u3) && $p2u3 != ''){
			$sql = "select id from upgrades where name = '". $p2u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!is_null($p2u4) && $p2u4 != ''){
			$sql = "select id from upgrades where name = '". $p2u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!is_null($p2u5) && $p2u5 != ''){
			$sql = "select id from upgrades where name = '". $p2u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!is_null($p2u6) && $p2u6 != ''){
			$sql = "select id from upgrades where name = '". $p2u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!is_null($p2u7) && $p2u7 != ''){
			$sql = "select id from upgrades where name = '". $p2u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!is_null($p2u8) && $p2u8 != ''){
			$sql = "select id from upgrades where name = '". $p2u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p2upgrades, $row[0]);
			}
			
			if(!empty($p2upgrades)){
				asort($p2upgrades);
			
				$sql = "select id from builds where ship_id = ". $p2id ." and upgrades = '". implode(',',$p2upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p2build = $row[0];
					
				if(is_null($p2build) || $p2build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p2id.",'".implode(',',$p2upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p2id ." and upgrades = '". implode(',',$p2upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p2build = $row[0];
					
					foreach($p2upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p2build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p2id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p2build = $row[0];
			}
			
			for($i = 0; $i < $p2copies; $i++){
				array_push($buildids, $p2build);
			}
				
	}
	
	if(!is_null($p3) && $p3 != ''){
			$p3upgrades = array();
			
			$sql = "select id from ships where name = '". $p3 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p3id = $row[0];
				
			if(!is_null($p3u1) && $p3u1 != ''){
			$sql = "select id from upgrades where name = '". $p3u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!is_null($p3u2) && $p3u2 != ''){
			$sql = "select id from upgrades where name = '". $p3u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!is_null($p3u3) && $p3u3 != ''){
			$sql = "select id from upgrades where name = '". $p3u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!is_null($p3u4) && $p3u4 != ''){
			$sql = "select id from upgrades where name = '". $p3u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!is_null($p3u5) && $p3u5 != ''){
			$sql = "select id from upgrades where name = '". $p3u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!is_null($p3u6) && $p3u6 != ''){
			$sql = "select id from upgrades where name = '". $p3u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!is_null($p3u7) && $p3u7 != ''){
			$sql = "select id from upgrades where name = '". $p3u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!is_null($p3u8) && $p3u8 != ''){
			$sql = "select id from upgrades where name = '". $p3u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p3upgrades, $row[0]);
			}
			
			if(!empty($p3upgrades)){
				asort($p3upgrades);
			
				$sql = "select id from builds where ship_id = ". $p3id ." and upgrades = '". implode(',',$p3upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p3build = $row[0];
					
				if(is_null($p3build) || $p3build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p3id.",'".implode(',',$p3upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p3id ." and upgrades = '". implode(',',$p3upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p3build = $row[0];
					
					foreach($p3upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p3build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p3id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p3build = $row[0];
			}
			
			for($i = 0; $i < $p3copies; $i++){
				array_push($buildids, $p3build);
			}
				
	}
	
	if(!is_null($p4) && $p4 != ''){
			$p4upgrades = array();
			
			$sql = "select id from ships where name = '". $p4 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p4id = $row[0];
				
			if(!is_null($p4u1) && $p4u1 != ''){
			$sql = "select id from upgrades where name = '". $p4u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!is_null($p4u2) && $p4u2 != ''){
			$sql = "select id from upgrades where name = '". $p4u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!is_null($p4u3) && $p4u3 != ''){
			$sql = "select id from upgrades where name = '". $p4u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!is_null($p4u4) && $p4u4 != ''){
			$sql = "select id from upgrades where name = '". $p4u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!is_null($p4u5) && $p4u5 != ''){
			$sql = "select id from upgrades where name = '". $p4u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!is_null($p4u6) && $p4u6 != ''){
			$sql = "select id from upgrades where name = '". $p4u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!is_null($p4u7) && $p4u7 != ''){
			$sql = "select id from upgrades where name = '". $p4u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!is_null($p4u8) && $p4u8 != ''){
			$sql = "select id from upgrades where name = '". $p4u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p4upgrades, $row[0]);
			}
			
			if(!empty($p4upgrades)){
				asort($p4upgrades);
			
				$sql = "select id from builds where ship_id = ". $p4id ." and upgrades = '". implode(',',$p4upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p4build = $row[0];
					
				if(is_null($p4build) || $p4build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p4id.",'".implode(',',$p4upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p4id ." and upgrades = '". implode(',',$p4upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p4build = $row[0];
					
					foreach($p4upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p4build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p4id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p4build = $row[0];
			}
			
			for($i = 0; $i < $p4copies; $i++){
				array_push($buildids, $p4build);
			}
				
	}
	
	if(!is_null($p5) && $p5 != ''){
			$p5upgrades = array();
			
			$sql = "select id from ships where name = '". $p5 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p5id = $row[0];
				
			if(!is_null($p5u1) && $p5u1 != ''){
			$sql = "select id from upgrades where name = '". $p5u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!is_null($p5u2) && $p5u2 != ''){
			$sql = "select id from upgrades where name = '". $p5u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!is_null($p5u3) && $p5u3 != ''){
			$sql = "select id from upgrades where name = '". $p5u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!is_null($p5u4) && $p5u4 != ''){
			$sql = "select id from upgrades where name = '". $p5u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!is_null($p5u5) && $p5u5 != ''){
			$sql = "select id from upgrades where name = '". $p5u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!is_null($p5u6) && $p5u6 != ''){
			$sql = "select id from upgrades where name = '". $p5u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!is_null($p5u7) && $p5u7 != ''){
			$sql = "select id from upgrades where name = '". $p5u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!is_null($p5u8) && $p5u8 != ''){
			$sql = "select id from upgrades where name = '". $p5u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p5upgrades, $row[0]);
			}
			
			if(!empty($p5upgrades)){
				asort($p5upgrades);
			
				$sql = "select id from builds where ship_id = ". $p5id ." and upgrades = '". implode(',',$p5upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p5build = $row[0];
					
				if(is_null($p5build) || $p5build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p5id.",'".implode(',',$p5upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p5id ." and upgrades = '". implode(',',$p5upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p5build = $row[0];
					
					foreach($p5upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p5build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p5id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p5build = $row[0];
			}
			
			for($i = 0; $i < $p5copies; $i++){
				array_push($buildids, $p5build);
			}
				
	}
	
	if(!is_null($p6) && $p6 != ''){
			$p6upgrades = array();
			
			$sql = "select id from ships where name = '". $p6 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p6id = $row[0];
				
			if(!is_null($p6u1) && $p6u1 != ''){
			$sql = "select id from upgrades where name = '". $p6u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!is_null($p6u2) && $p6u2 != ''){
			$sql = "select id from upgrades where name = '". $p6u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!is_null($p6u3) && $p6u3 != ''){
			$sql = "select id from upgrades where name = '". $p6u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!is_null($p6u4) && $p6u4 != ''){
			$sql = "select id from upgrades where name = '". $p6u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!is_null($p6u5) && $p6u5 != ''){
			$sql = "select id from upgrades where name = '". $p6u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!is_null($p6u6) && $p6u6 != ''){
			$sql = "select id from upgrades where name = '". $p6u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!is_null($p6u7) && $p6u7 != ''){
			$sql = "select id from upgrades where name = '". $p6u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!is_null($p6u8) && $p6u8 != ''){
			$sql = "select id from upgrades where name = '". $p6u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p6upgrades, $row[0]);
			}
			
			if(!empty($p6upgrades)){
				asort($p6upgrades);
			
				$sql = "select id from builds where ship_id = ". $p6id ." and upgrades = '". implode(',',$p6upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p6build = $row[0];
					
				if(is_null($p6build) || $p6build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p6id.",'".implode(',',$p6upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p6id ." and upgrades = '". implode(',',$p6upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p6build = $row[0];
					
					foreach($p6upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p6build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p6id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p6build = $row[0];
			}
			
			for($i = 0; $i < $p6copies; $i++){
				array_push($buildids, $p6build);
			}
				
	}
	
	if(!is_null($p7) && $p7 != ''){
			$p7upgrades = array();
			
			$sql = "select id from ships where name = '". $p7 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p7id = $row[0];
				
			if(!is_null($p7u1) && $p7u1 != ''){
			$sql = "select id from upgrades where name = '". $p7u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!is_null($p7u2) && $p7u2 != ''){
			$sql = "select id from upgrades where name = '". $p7u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!is_null($p7u3) && $p7u3 != ''){
			$sql = "select id from upgrades where name = '". $p7u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!is_null($p7u4) && $p7u4 != ''){
			$sql = "select id from upgrades where name = '". $p7u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!is_null($p7u5) && $p7u5 != ''){
			$sql = "select id from upgrades where name = '". $p7u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!is_null($p7u6) && $p7u6 != ''){
			$sql = "select id from upgrades where name = '". $p7u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!is_null($p7u7) && $p7u7 != ''){
			$sql = "select id from upgrades where name = '". $p7u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!is_null($p7u8) && $p7u8 != ''){
			$sql = "select id from upgrades where name = '". $p7u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p7upgrades, $row[0]);
			}
			
			if(!empty($p7upgrades)){
				asort($p7upgrades);
			
				$sql = "select id from builds where ship_id = ". $p7id ." and upgrades = '". implode(',',$p7upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p7build = $row[0];
					
				if(is_null($p7build) || $p7build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p7id.",'".implode(',',$p7upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p7id ." and upgrades = '". implode(',',$p7upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p7build = $row[0];
					
					foreach($p7upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p7build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p7id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p7build = $row[0];
			}
			
			for($i = 0; $i < $p7copies; $i++){
				array_push($buildids, $p7build);
			}
				
	}
	
	if(!is_null($p8) && $p8 != ''){
			$p8upgrades = array();
			
			$sql = "select id from ships where name = '". $p8 ."'";
    		$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
    		$row = mysql_fetch_row($result);
    		$p8id = $row[0];
				
			if(!is_null($p8u1) && $p8u1 != ''){
			$sql = "select id from upgrades where name = '". $p8u1 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!is_null($p8u2) && $p8u2 != ''){
			$sql = "select id from upgrades where name = '". $p8u2 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!is_null($p8u3) && $p8u3 != ''){
			$sql = "select id from upgrades where name = '". $p8u3 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!is_null($p8u4) && $p8u4 != ''){
			$sql = "select id from upgrades where name = '". $p8u4 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!is_null($p8u5) && $p8u5 != ''){
			$sql = "select id from upgrades where name = '". $p8u5 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!is_null($p8u6) && $p8u6 != ''){
			$sql = "select id from upgrades where name = '". $p8u6 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!is_null($p8u7) && $p8u7 != ''){
			$sql = "select id from upgrades where name = '". $p8u7 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!is_null($p8u8) && $p8u8 != ''){
			$sql = "select id from upgrades where name = '". $p8u8 ."'";
			$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
			$row = mysql_fetch_row($result);
    		array_push($p8upgrades, $row[0]);
			}
			
			if(!empty($p8upgrades)){
				asort($p8upgrades);
			
				$sql = "select id from builds where ship_id = ". $p8id ." and upgrades = '". implode(',',$p8upgrades) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p8build = $row[0];
					
				if(is_null($p8build) || $p8build == ''){
					mysql_query("insert into builds(ship_id, upgrades) values (".$p8id.",'".implode(',',$p8upgrades)."')") or die("Unable to select: ".mysql_error());
				
					$sql = "select id from builds where ship_id = ". $p8id ." and upgrades = '". implode(',',$p8upgrades) ."'";
					$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
					$row = mysql_fetch_row($result);
					$p8build = $row[0];
					
					foreach($p8upgrades as $upgrade){
						mysql_query("insert into build_upgrades(build_id, upgrade_id) values (".$p8build.",".$upgrade.")") or die("Unable to select: ".mysql_error());				
					}				
					
				}
			}else{
				$sql = "select id from builds where ship_id = ". $p8id ." and upgrades is null";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$p8build = $row[0];
			}
			
			for($i = 0; $i < $p8copies; $i++){
				array_push($buildids, $p8build);
			}
				
	}
	
	$squadid = '';
	
	asort($buildids);
	
				$sql = "select id from lists where build_ids = '". implode(',',$buildids) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$squadid = $row[0];
	
	if(is_null($squadid) || $squadid == ''){
		mysql_query("insert into lists(build_ids) values ('".implode(',',$buildids)."')") or die("Unable to select: ".mysql_error());
		
				$sql = "select id from lists where build_ids = '". implode(',',$buildids) ."'";
				$result = mysql_query($sql) or die("Unable to select: ".mysql_error());
				$row = mysql_fetch_row($result);
				$squadid = $row[0];
				
				foreach($buildids as $build){
					mysql_query("insert into list_builds(list_id, build_id) values (".$squadid.",".$build.")") or die("Unable to select: ".mysql_error());				
				}
	}
	
	mysql_query("insert into placing(tournament_id, list_id, points) values (".$t.",".$squadid.",".$p.")") or die("Unable to select: ".mysql_error());
		
	}
	
	mysql_query("CALL UpdateBuildCosts();") or die("Unable to select: ".mysql_error());
	

}
	


?>
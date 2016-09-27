<?php

include_once("analyticstracking.php");

$d = $_GET['d'];
  if (is_null($d)){
    $d = 90;
  }

$f = $_GET['f'];
  if (is_null($f)){
    $f = 0;
  }

echo "   <div style='min-height: 101px; width: 100%;  background-color: #282828'>
    <a href='http://www.miniranker.com'><div class='head' style='line-height: 25px; float: left; text-align: left'>
    <br><b>&nbsp;MINI<br>&nbsp;RANKER</b><br>
      </div></a>
    <div class='head' style='line-height: 35px; float: left; text-align: center'>
    <br><a href='/tournaments.php?d=". $d ."&f=". $f ."'><span style='color: #CCCCCC'><b>TOURNIES</b></span></a>
      </div>
    <div class='head' style='line-height: 35px; float: left; text-align: center'>
    <br><a href='/squads.php?d=". $d ."&f=". $f ."'><b>SQUADS</b></a>
      </div>
    <div class='head' style='line-height: 35px; float: left; text-align: center'>
    <br><a href='/units.php?d=". $d ."&f=". $f ."'><span style='color: #CCCCCC'><b>UNITS</b></span></a>
      </div>
</div>
<a href='/?d=". $d ."&f=". $f ."'><div class='title'><img src='ia.jpg' style='width: 100%; max-height: 150px; max-width: 1050px'>
</div></a>
 ";

?>
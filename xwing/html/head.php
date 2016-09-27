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

echo "
    <div style='min-height: 101px; width: 100%;  background-color: #282828'>
    <a href='http://www.miniranker.com'><div class='head' style='line-height: 25px; text-align: left'>
    <br><b>&nbsp;MINI<br>&nbsp;RANKER</b><br>
      </div></a>
    <div class='head'>
    <a href='/tournaments.php?d=". $d ."&f=". $f ."'><span style='color: #CCCCCC'><b>TOURNIES</b></span></a>
      </div>
    <div class='head'>
    <b><span style='color: #CCCCCC'>SQUADS&#x25BE;</span></b>
    <div class='head-list'>
    <a href='/shiplists.php?d=". $d ."&f=". $f ."'><b>BY SHIPS</b></a>
    <br><a href='/pilotlists.php?d=". $d ."&f=". $f ."'><b>BY PILOTS</b></a>
    <br><a href='/squads.php?d=". $d ."&f=". $f ."'><b>BY BUILDS&nbsp;</b></a> 
      </div>
      </div>
    <div class='head'>
    <b><span style='color: #CCCCCC'>UNITS&#x25BE;</span></b>
      <div class='head-list'>
    <a href='/ships.php?d=". $d ."&f=". $f ."'><b>SHIPS</b></a>
    <br><a href='/pilots.php?d=". $d ."&f=". $f ."'><b>PILOTS</b></a>
    <br><a href='/builds.php?d=". $d ."&f=". $f ."'><b>BUILDS</b></a>
    <br><a href='/upgrades.php?d=". $d ."&f=". $f ."'><b>UPGRADES&nbsp;</b></a>
      </div>  	
    </div>
</div>
<a href='/?d=". $d ."&f=". $f ."'><div class='title'><img src='xwing.jpg' style='width: 100%; max-height: 150px; max-width: 1050px'>
</div></a>";

?>
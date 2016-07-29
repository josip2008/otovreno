<?php
	mb_internal_encoding("UTF-8");
	error_reporting(0);

$fid = $_GET["fid"];

$dom = new DOMDocument();
$dom->load('podaci.xml'); 
$xp = new DOMXPath($dom); 
$query = '/podaci/sudionik[contains(' . 'fid' . ', "' .$fid . '")]';
$rez = $xp->query($query);

foreach ($rez as $reza) {
	$ime = $reza->getElementsByTagName('fid')->item(0)->nodeValue;
	if(($fid) == ($ime)){
  	echo "<b>Godina osnivanja:";
  	$ime = $reza->getElementsByTagName('godina_osnivanja')->item(0)->nodeValue;
  	echo $ime;
  	echo "</b><br/>";
  	$ime = $reza->getElementsByTagName('stadion')->item(0)->getElementsByTagName('ime_stadiona')->item(0)->nodeValue;
  	echo "<b>Stadion:";
  	echo $ime;
  	echo "</b><br/>";
  	$ime = $reza->getElementsByTagName('kljucni_igrac')->item(0)->getElementsByTagName('ime')->item(0)->nodeValue;
  	$ime2 = $reza->getElementsByTagName('kljucni_igrac')->item(0)->getElementsByTagName('prezime')->item(0)->nodeValue;
  	echo "<b>Ključni igrač:";
  	echo $ime;
  	echo ' ';
  	echo $ime2;
  	echo "</b><br/>";
  	$ime = $reza->getElementsByTagName('kljucni_igrac')->item(0)->getElementsByTagName('pozicija')->item(0)->nodeValue;
  	echo "<b>Pozicija:";
  	echo $ime;
  	echo "</b><br/>";
  	$ime = $reza->getElementsByTagName('trener')->item(0)->nodeValue;
  	echo "<b>Glavni trener:";
  	echo $ime;
  	echo "</b><br/>";
}
}
	sleep(1);
?>

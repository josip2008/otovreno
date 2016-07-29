<?php

	mb_internal_encoding("UTF-8");
	error_reporting( E_ALL );
	function trazi()
	{
		$array = array();

		if (!empty($_REQUEST['ime_kluba'])){	
			$array[] = 'contains(' . 'ime_kluba' . ', "' .$_REQUEST['ime_kluba'] . '")';
		}
		if (!empty($_REQUEST['drzava'])){
			$array[] = 'contains(' . 'drzava' . ', "' . $_REQUEST['drzava'] . '")';
		}
		if (!empty($_REQUEST['godina'])){
			$array[] = 'contains(godina_osnivanja, "'.$_REQUEST['godina'].'")';
		}

		$trener = array();
			if (!empty($_REQUEST['ime_trenera'])){
				$trener[] = 'contains(' . 'ime_trenera' . ', "' . $_REQUEST['ime_trenera'] . '")';
			}
			if (!empty($_REQUEST['prezime_trenera'])){
				$trener[] = 'contains(' . 'prezime_trenera' . ', "' . $_REQUEST['prezime_trenera'] . '")';
			}
			if (!empty($_REQUEST['uloga'])){
				$var = implode ("",$_REQUEST['uloga']);
				if(!empty($_REQUEST['ime_trenera']) or !empty($_REQUEST['prezime_trenera']))
				{$trener[] = '@uloga="' . $var . '"';}
				else 
				{$trener[] = '@uloga="' . $var . '"';}
			}
		if(!empty($trener))
			{$array[] = 'trener[' . implode(' and ', $trener) . ']';}	

		$stadion=array();
			if (!empty($_REQUEST['ime_stadiona'])){
				$stadion[] = 'contains(' . 'ime_stadiona' . ', "' . $_REQUEST['ime_stadiona'] . '")';
			}
			if (!empty($_REQUEST['kapacitet'])){
				$stadion[] = 'contains(kapacitet, "'.$_REQUEST['kapacitet'].'")';
			}
			if (!empty($_REQUEST['godina_izgradnje'])){
				$stadion[] = 'contains(godina_izgradnje, "'.$_REQUEST['godina_izgradnje'].'")';
			}
			if (!empty($_REQUEST['adresa'])){
				$stadion[] = 'contains(' . 'adresa' . ', "' . $_REQUEST['adresa'] . '")';
			}
			if(!empty($_REQUEST['pbr'])){
				$pbr = array();
				$pbr[] = '@postanski_broj="' . $_REQUEST['pbr'].'"';
				$stadion[] = 'adresa[' . implode(' ', $pbr) . ']';
				}
		if(!empty($stadion))
			{$array[] = 'stadion[' . implode(' and ', $stadion) . ']';}

		if (!empty($_REQUEST['mail'])){
			$array[] = 'contains(' . 'mail_adresa' . ', "' . $_REQUEST['mail'] . '")';
		}

		if (!empty($_REQUEST['kategorija']))
		{	$kate = array();			
			foreach ($_REQUEST['kategorija'] as $kategorija)
				{$kate[] = 'navijaci="' . $kategorija . '"';}			
			if (!empty($kate))
			{$array[] = '(' . implode(' or ', $kate) . ')';}
		}

		$igrac=array();
			if (!empty($_REQUEST['imeIgrača'])){
				$igrac[] = 'contains(' . 'ime' . ', "' . $_REQUEST['imeIgrača'] . '")';
			}

			if (!empty($_REQUEST['prezimeIgrača'])){
				$igrac[] = 'contains(' . 'prezime' . ', "' . $_REQUEST['prezimeIgrača'] . '")';
			}

			if (!empty($_REQUEST['pozicija']))
			{	$posi = array();			
				foreach ($_REQUEST['pozicija'] as $pozicija)
				{$posi[] = 'pozicija="' . $pozicija . '"';}			
				if (!empty($posi))
				{	if(!empty($_REQUEST['imeIgrača']) or !empty($_REQUEST['prezimeIgrača']))
					{$igrac[] = '' . implode(' or ', $posi) . '';}
					else
					{$igrac[] = '' . implode(' or ', $posi) . '';}
				}
			}
		if(!empty($igrac))
			{$array[] = 'kljucni_igrac[' . implode(' and ', $igrac) . ']';}	

		$preetyfy = implode(' and ', $array);
		if (!empty($preetyfy))
		{return '/podaci/sudionik['. $preetyfy .']';}
		 else
		 {return '/podaci/sudionik';}

		$brzo= array();

	if (!empty($_REQUEST['brza'])){	
			$brzo[] = 'contains(' . 'ime_kluba' . ', "' .$_REQUEST['brza'] . '")';
			$brzo[] = 'contains(' . 'drzava' . ', "' . $_REQUEST['brza'] . '")';
			$brzo[] = 'contains(godina_osnivanja, "'.$_REQUEST['brza'].'")';
			$brzo[] = 'trener[contains(' . 'ime_trenera' . ', "' . $_REQUEST['brza'] . '")]';
			$brzo[] = 'trener[contains(' . 'prezime_trenera' . ', "' . $_REQUEST['brza'] . '")]';
			$brzo[] = 'trener[@uloga="' . $_REQUEST['brza'] . '"]';
			$brzo[] = 'stadion[contains(' . 'ime_stadiona' . ', "' . $_REQUEST['brza'] . '")]';
			$brzo[] = 'stadion[contains(kapacitet, "'.$_REQUEST['brza'].'")]';
			$brzo[] = 'stadion[contains(godina_izgradnje, "'.$_REQUEST['brza'].'")]';
			$brzo[] = 'stadion[contains(' . 'adresa' . ', "' . $_REQUEST['brza'] . '")]';
			$brzo[] = 'stadion[adresa[@postanski_broj="' . $_REQUEST['brza'] . '"]]';
			$brzo[] = 'contains(' . 'mail_adresa' . ', "' . $_REQUEST['brza'] . '")';
			$brzo[] = 'kljucni_igrac[contains(' . 'ime' . ', "' . $_REQUEST['brza'] . '")]';
			$brzo[] = 'kljucni_igrac[contains(' . 'prezime' . ', "' . $_REQUEST['brza'] . '")]';
			$brzo[] = 'kljucni_igrac[pozicija="' . $_REQUEST['brza'] . '"]';
			$brzo[] = 'navijaci="' . $_REQUEST['brza'] . '"';
		}

	if (!empty($brzo))
		$var=implode(' or ', $brzo);
		{return '/podaci/sudionik['. $var .']';}


	}


function get_picture($pic){
	$upit="https://graph.facebook.com/".$pic."?fields=picture&access_token=965338460256105|973343046da369da5be11a8bf76eb418";
	$fgc = file_get_contents($upit);
	$slika = json_decode($fgc, TRUE);
	return $slika['picture']['data']['url'];
}

function get_city($adr){
	$upit="https://graph.facebook.com/".$adr."?fields=location&access_token=965338460256105|973343046da369da5be11a8bf76eb418";
	$fgc = file_get_contents($upit);
	$adresa = json_decode($fgc, TRUE);
	if(!empty ($adresa['location']['city'])){
	return $adresa['location']['city'];}
	else {
		return NULL;
	}
}
function get_country($adr){
	$upit="https://graph.facebook.com/".$adr."?fields=location&access_token=965338460256105|973343046da369da5be11a8bf76eb418";
	$fgc = file_get_contents($upit);
	$adresa = json_decode($fgc, TRUE);
	if(!empty ($adresa['location']['country'])){
	return $adresa['location']['country'];}
	else {
		return NULL;
	}
}
function get_street($adr){
	$upit="https://graph.facebook.com/".$adr."?fields=location&access_token=965338460256105|973343046da369da5be11a8bf76eb418";
	$fgc = file_get_contents($upit);
	$adresa = json_decode($fgc, TRUE);
	if(!empty ($adresa['location']['street'])){
	return $adresa['location']['street'];}
	else {
		return NULL;
	}
}

function get_parentURL($adrs){
	$upit="https://graph.facebook.com/".$adrs."?fields=website&access_token=965338460256105|973343046da369da5be11a8bf76eb418";
	$fgc = file_get_contents($upit);
	$adresa = json_decode($fgc, TRUE);
	if(!empty ($adresa['website'])){
	return $adresa['website'];}
	else {
		return NULL;
	}
}

function get_lat($adrs, $adrs2){
	$pomocna = urlencode($adrs);
	$upit="http://nominatim.openstreetmap.org/search?q=".$pomocna."&format=xml";
	$asdf = file_get_contents($upit);
	$searchresults = new SimpleXMLElement($asdf);
	$trazeno = $searchresults->place[0]["lat"];
	if(empty($trazeno)){
		$pomocna2 = urlencode($adrs2);
		$upit2="http://nominatim.openstreetmap.org/search?q=".$pomocna2."&format=xml";
		$asdf2 = file_get_contents($upit2);
		$searchresults = new SimpleXMLElement($asdf2);
		$trazeno2 = $searchresults->place[0]["lat"];
		return $trazeno2;
	}
	else {
	return $trazeno;}
	}


function get_lon($adrs, $adrs2){
	$pomocna = urlencode($adrs);
	$upit="http://nominatim.openstreetmap.org/search?q=".$pomocna."&format=xml";
	$asdf = file_get_contents($upit);
	$searchresults = new SimpleXMLElement($asdf);
	$trazeno = $searchresults->place[0]["lon"];
		if(empty($trazeno)){
		$pomocna2 = urlencode($adrs2);
		$upit2="http://nominatim.openstreetmap.org/search?q=".$pomocna2."&format=xml";
		$asdf2 = file_get_contents($upit2);
		$searchresults = new SimpleXMLElement($asdf2);
		$trazeno2 = $searchresults->place[0]["lon"];
		return $trazeno2;
	}
	return $trazeno;
	}

function get_lastpost($adrs){
	$upit="https://graph.facebook.com/".$adrs."?fields=posts&access_token=965338460256105|973343046da369da5be11a8bf76eb418";
	$last = file_get_contents($upit);
	$adresa = json_decode($last, TRUE);
		if(!empty ($adresa['posts']['data'])){
	return $adresa['posts']['data'][0]['message'];}
	else {
		return NULL;
	}
}



function flickr_img ($lat,$lon)
{

$userid = '141713165@N06';
$key = 'b054fa569b02b24147bf0a6cf0192c8f';
$secret = '32ac52f2264eb5b9';
$url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='. $key . '&lat=' . $lat .'&lon='. $lon .'&format=json&nojsoncallback=1';

	$last = file_get_contents($url);
	$adresa = json_decode($last, TRUE);

	$id_slike = $adresa['photos']['photo'][0]['id'];


$url2 = 'https://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key='.$key. '&photo_id=' . $id_slike. '&format=json&nojsoncallback=1';

	$last2 = file_get_contents($url2);
	$adresa2 = json_decode($last2, TRUE);

	$id_slike = $adresa2['photo']['urls']['url'][0]['_content'];

	$konacno = stripslashes ( $id_slike );

return $konacno;

}


?>
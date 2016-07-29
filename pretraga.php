<?php
  include ('funkcije.php');
  include ('detalji.php');
  error_reporting (E_ALL);
  $dom = new DOMDocument();
  $dom->load('podaci.xml');
  $xp = new DOMXPath($dom);
  $upit = trazi();
  #echo $upit;
  $rezultat = $xp->query($upit);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Ovo je naslov stranice</title>
  <link rel="stylesheet" type="text/css" href="dizajn.css">
  <script type="text/javascript" src="detalji.js"></script>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
</head>

<body>

<div class="wrapper">

  <div id="header">
    <h1>Euroleague</h1>
  </div>

  <div id="nav">
    <img id="slike" src="slike/EuroleagueLogo.png" alt="Euroleague Logo">
      <ul>
        <li>
          <a href="index.html">Početna</a></li>
        <li>
          <a href="obrazac.html">Pretraživanje</a></li>
        <li>
          <a href="http://www.fer.unizg.hr/predmet/or">Link na OR</a></li>
        <li>
          <a href="http://www.fer.unizg.hr" target="_blank">Link na FER</a></li>
        <li>
          <a class="link" href="mailto:josip.zuljevic@fer.hr">Kontakt e-mail</a></li>
        <li>
          <a href="podaci.xml">Podaci iz xml-a</a></li>
      </ul>

      <div id="dodaci"></div>
      <div id="refresh"><script>
              alertFunc();
              </script>
</div> 

  </div>


 <table id="query_table">
  <tr>
    <th>
      Ime Kluba
    </th>
    <th>
      Država
    </th>
    <th>
      Slika kluba
    </th>
    <th>
      Geografske koordinate  
    </th>
    <th>
     Zadnja slika
    </th>
    <th>
      Akcija
    </th>
  </tr>

<?php foreach ($rezultat as $reza) {
?>
  <tr onmouseover="ChangeColor(this)" onmouseout="ChangeBack(this)">
    <td> 
    <?php
    $drugi = $reza;
    $ime = $drugi->getElementsByTagName('ime_kluba')->item(0)->nodeValue;
    echo $drugi->getElementsByTagName('ime_kluba')->item(0)->nodeValue;
    ?>  
   </td>
    <td>    
    <?php
    echo $drugi->getElementsByTagName('drzava')->item(0)->nodeValue;
    ?> 
    </td>
          <?php
        $fid=$drugi->getElementsByTagName('fid')->item(0)->nodeValue; 
        $city=get_city($fid);
        $country=get_country($fid);
        $street=get_street($fid);
        $mjesto = $street.",".$city.",".$country;  
        $mjesto2 = $city;
        ?> 
    <td>    
    <img src="
    <?php
    $fid=$drugi->getElementsByTagName('fid')->item(0)->nodeValue; 
        echo get_picture($fid);
    ?>
    " alt="slika_kluba" />
    </td>  
     <td> 
         <?php
         $lon = get_lon($mjesto, $mjesto2);
         $lat = get_lat($mjesto, $mjesto2);
       echo get_lon($mjesto, $mjesto2);
       echo "/";
       echo get_lat($mjesto, $mjesto2);    
       ?> 
    </td>
    <td>
  
        <a href="
    <?php
        echo flickr_img($lat, $lon);
    ?>
  " target="_blank"> FLICKR SLIKA </a>

    </td>
    <td>
      
      <img src="slike/info.jpg" alt="slika_info" onclick="detalji2(' <?php echo $fid; ?> ',' <?php echo $ime; ?> ',' <?php echo $lat;?> ','<?php echo $lon; ?> ','<?php echo $city; ?> ')">
    </td>
  </tr>
  <?php } ?>
</table>

<div id="mapa"></div>

  </body>
</html>
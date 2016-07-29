function ChangeColor (row) {
	row.style.backgroundColor = "#336699";
}

function ChangeBack (row) {
	row.style.backgroundColor = "transparent";
}

var req;

function doSomething() {
	if(req.readyState == 4) {
		if(req.status == 200){ 
		document.getElementById('dodaci').innerHTML = req.responseText;
	}
	else { 
		alert("Something went wrong" + req.statusText);
		}
	}		
}

function detalji2 (fid,ime_kluba,lat,lon){

	document.getElementById('dodaci').innerHTML = '<img src="slike/7.gif" alt="Nema_slike"/>';
if (window.XMLHttpRequest) {
// FF, Safari, Opera, IE7+
req = new XMLHttpRequest();
// stvaranje novog objekta
} else if (window.ActiveXObject) {
// IE 6+
req = new ActiveXObject("Microsoft.XMLHTTP"); //ActiveX
}

if (req) {
		
		url = "http://localhost/otvoreno/detalji.php?fid="+fid;
		url = url.replace(/\s+/g, '');
		req.open("GET", url, true);
		// metoda, URL, asinkroni način
		req.send(null); //slanje (null za GET, podaci za POST)
		req.onreadystatechange = doSomething;
}
	
detalji3(lon,lat, ime_kluba);

}


function detalji3 (lon,lat, ime){

	document.getElementById('mapa').innerHTML = '<img src="slike/7.gif" alt=Nema_slike" />';
	document.getElementById('mapa').innerHTML = "<div id='mapa2'></div>";
	document.getElementById('mapa').innerHTML = "<div id='mapa3'></div>";

	var map = L.map('mapa3').setView([lat, lon], 17);
	L.tileLayer('http://tile.mtbmap.cz/mtbmap_tiles/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &amp; USGS'
}).addTo(map);

	var marker = L.marker([lat,lon]).addTo(map);
   	marker.bindPopup('Ime kluba: '+ime + '<br/>Širina: '+lat+'<br/>Dužina: '+lon).openPopup();

}


function alertFunc(){
	document.getElementById('refresh').style.visibility="visible";

document.getElementById('refresh').innerHTML = "awef";

var MyDiv1 = document.getElementById('refresh');
var MDiv2 = "novi";

if (MyDiv1.innerHTML !== MDiv2){
	document.getElementById('refresh').innerHTML = MDiv2;

}
var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > 5000){
      break;
    }
  }
    document.getElementById('refresh').style.visibility="hidden";
    alertFunc();
}

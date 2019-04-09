function napraviKanal(){
	var k = null;
	if (window.XMLHttpRequest) {
		k = new XMLHttpRequest();
	}
	else{
		k = new ActiveXObject("Microsoft.XMLHTTP");
	}
	if (k!=null) {
		return k;
	}
}

function ispisiLink(){
	document.getElementById('tbLink').value = "index.php?x=";
}

function adresa(){
	var request = napraviKanal();
	var grad = document.getElementById('ddlGrad').options[document.getElementById('ddlGrad').selectedIndex].value;
	request.open("GET","gradovi.php?g="+grad,true);
	request.onreadystatechange = ispisi;
	request.send();

	function ispisi(){
		if (request.readyState == 4) {
			document.formaRegistracija.tbPosBr.value = request.responseText;
		}
	}
}

function promenaMeni(id_meni){
	var request = napraviKanal();
	request.open("GET","dohvatiMeni.php?id_menu="+id_meni,true);
	request.onreadystatechange = ispisiMeni;
	request.send();

	function ispisiMeni(){
		if (request.readyState == 4) {
			var response = eval("("+request.responseText+")");
			document.getElementById('tbNazivMeni').value = response[2];
			document.getElementById('tbLink').value = response[1];
			document.getElementById('tbPozicija').value = response[3];
			document.getElementById('sakriveniIdMeni').value = response[0];
		}
	}
}

function promenaKorisnik(id_korisnik){
	var request = napraviKanal();
	request.open("GET","dohvatiKorisnika.php?id_kor="+id_korisnik,true);
	request.onreadystatechange = ispisiKorisnika;
	request.send();

	function ispisiKorisnika(){
		if (request.readyState == 4) {
			var response = eval("("+request.responseText+")");
			document.getElementById('tbImePrezime').value = response[1];
			document.getElementById('tbUsername').value = response[2];
			document.getElementById('tbEmail').value = response[4];
			document.getElementById('tbPassword').value = response[3];
			document.getElementById('sakriveniIdKorisnik').value = response[0];
		}
	}
}

function promenaProizvodjac(id_proizvodjac){
	var request = napraviKanal();
	request.open("GET","dohvatiProizvodjaca.php?id_proizvodjaca="+id_proizvodjac,true);
	request.onreadystatechange = ispisiProizvodjaca;
	request.send();

	function ispisiProizvodjaca(){
		if (request.readyState == 4) {
			var response = eval("("+request.responseText+")");
			document.getElementById('sakriveniIdProizvodjaca').value = response[0];
			document.getElementById('tbNazivProizvodjaca').value = response[1];
		}
	}
}

function promenaModel(id_model){
	var request = napraviKanal();
	request.open("GET","dohvatiModel.php?id_model="+id_model,true);
	request.onreadystatechange = ispisiModel;
	request.send();

	function ispisiModel(){
		if (request.readyState == 4) {
			var response = eval("("+request.responseText+")");
			document.getElementById('tbNazivModela').value = response[1];
			document.getElementById('tbCena').value = response[7];
			document.getElementById('tbKamera').value = response[2];
			document.getElementById('tbProcesor').value = response[3];
			document.getElementById('tbMemorija').value = response[4];
			document.getElementById('tbWiFi').value = response[5];
			document.getElementById('tbBoja').value = response[6];
			document.getElementById('tbKolicina').value = response[8];
			document.getElementById('sakriveniIdModela').value = response[0];
		}
	}
}

function promenaAnketa(id_anketa){
	var request = napraviKanal();
	request.open("GET","dohvatiAnketu.php?id_anketa="+id_anketa,true);
	request.onreadystatechange = ispisiAnketu;
	request.send();

	function ispisiAnketu(){
		if (request.readyState == 4) {
			var response = eval("("+request.responseText+")");
			document.getElementById('taPitanje').value = response[1];
			if (response[2] == 1) {
				document.getElementById('da').checked;
			}
			else{
				document.getElementById('ne').checked;
			}
			document.getElementById('sakriveniIdAnketa').value = response[0];
		}
	}
}

function promenaGrad(id_grad){
	var request = napraviKanal();
	request.open("GET","dohvatiGrad.php?id_grada="+id_grad,true);
	request.onreadystatechange = ispisiGrad;
	request.send();

	function ispisiGrad(){
		if (request.readyState == 4) {
			var response = eval("("+request.responseText+")");
			document.getElementById('tbImeGrada').value = response[1];
			document.getElementById('tbPosBr').value = response[2];
			document.getElementById('sakriveniIdGrad').value = response[0];
		}
	}
}

function ispisiKorisnika(id_kor){
	var request = napraviKanal();
	request.open("GET","dohvatiKorisnika.php?id_kor="+id_kor,true);
	request.onreadystatechange = ispisiKor;
	request.send();

	function ispisiKor(){
		if (request.readyState == 4) {
			var response = eval("("+request.responseText+")");
			document.getElementById('tbImePrezimeKor').value = response[1];
			document.getElementById('tbUsernameKor').value = response[2];
			document.getElementById('tbEmailKor').value = response[4];
			document.getElementById('tbPasswordKor').value = response[3];
			document.getElementById('tbAdresaKor').value = response[5];
		}
	}
}

function anketa(){
	var request = napraviKanal();
	idAnketa = document.getElementById('anketaSakriveno').value;
	id_odg = document.getElementsByName('rbAnketa');

	var glas = "";
		for(var i=0;i<id_odg.length;i++){
			if(id_odg[i].checked){
				glas = id_odg[i].value;
				break;
			}
		}

	request.open("GET","glasanje.php?id_odg="+glas+"&id_a="+idAnketa,true);
	request.onreadystatechange = upisiGlas;
	request.send();

	function upisiGlas(){
		if (request.readyState == 4) {
			document.getElementById('glas').innerHTML = request.responseText;
		}
	}
}

function izbrisiKorpu(id_korpe){
	var request = napraviKanal();
	request.open("GET","izbrisiKorpu.php?id_korpa="+id_korpe,true);
	request.onreadystatechange = izbrisisadrzajKorpe;
	request.send();

	function izbrisisadrzajKorpe(){
		if (request.readyState == 4) {
			document.getElementById('nazivModel').innerHTML = "";
			document.getElementById('cenaModel').innerHTML = "";
			document.getElementById('korpaRemove').innerHTML = "";
		}
	}
}

function proveraLog(){
	var greskeLog = new Array();
	var logUser = document.getElementById('tbLoginUsername').value;
	var logPass = document.getElementById('tbLoginPassword').value;

	var regLogUser = /^(\w)+(\d)*$/;
	var ragLogPass = /^[A-Za-z0-9]{6,10}$/;

	if (!regLogUser.test(logUser)) {
		greskeLog.push("Username nije u dobrom formatu.");
		document.getElementById('tbLoginUsername').style.border = '1px solid #ff0000';
	}
	if (!ragLogPass.test(logPass)) {
		greskeLog.push("Password nije u dobrom formatu.");
		document.getElementById('tbLoginPassword').style.border = '1px solid #ff0000';
	}

	if (greskeLog.length == 0) {
		return true;
	}
	else
	{
		return false;
	}
}

function proveraRegistracija(){
	var greske = new Array();

	var imePrezime = document.getElementById('tbImePrezime').value;
	var username = document.getElementById('tbUsername').value;
	var email = document.getElementById('tbEmail').value;
	var password = document.getElementById('tbPassword').value;
	var grad = document.getElementById('ddlGrad').options[document.getElementById('ddlGrad').selectedIndex].value;
	var posBr = document.getElementById('tbPosBr').value;
	var adresa = document.getElementById('tbAdresa').value;

	var regImePrezime = /^[A-Z][a-z]{2,24}\s[A-Z][a-z]{3,23}$/;
	var regUsername = /^(\w)+(\d)*$/;
	var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var regPassword = /^[A-Za-z0-9]{6,10}$/;
	var regPosBr = /^[0-9]{5}$/;
	var regAdresa = /^[A-Z][a-z]+\s([A-Z]([a-z])+\s)*[0-9]{1,3}$/;

	if (!regImePrezime.test(imePrezime)) {
		greske.push("Ime i prezime nije u dobrom formatu.");
		document.getElementById('tbImePrezime').style.border = '1px solid #ff0000';
	}
	if (!regUsername.test(username) || username.length > 20) {
		greske.push("Username nije u dobrom formatu.");
		document.getElementById('tbUsername').style.border = '1px solid #ff0000';
	}
	if (!regEmail.test(email) || email.length > 50) {
		greske.push("Email nije u dobrom formatu.");
		document.getElementById('tbEmail').style.border = '1px solid #ff0000';
	}
	if (!regPassword.test(password)) {
		greske.push("Password nije u dobrom formatu.");
		document.getElementById('tbPassword').style.border = '1px solid #ff0000';
	}
	if (grad == 0) {
		greske.push("Niste izabrali grad.");
		document.getElementById('ddlGrad').style.border = '1px solid #ff0000';
	}
	if (!regPosBr.test(posBr)) {
		greske.push("Postanski broj nije odgovarajuci");
		document.getElementById('tbPosBr').style.border = '1px solid #ff0000';
	}
	if (!regAdresa.test(adresa) || adresa.length > 30) {
		greske.push("Adresa nije u dobrom formatu.");
		document.getElementById('tbAdresa').style.border = '1px solid #ff0000';
	}

	if (greske.length == 0) {
		return true;
	}
	else
	{
		return false;
	}
}
function proveraCenaOd(){
	var pCenaOd = document.getElementById('tbCenaOd').value;

	var regCenaOd = /^(\d)+$/;

	var greskeCena = new Array();

	if (!regCenaOd.test(pCenaOd)) {
		greskeCena.push("Cena nije u dobrom formatu.");
		document.getElementById('tbCenaOd').style.border = '1px solid #ff0000';
	}
	
	if (greskeCena.length == 0) {
		
		document.getElementById('tbCenaOd').style.border = '1px solid #00ff00';
	}
}

function proveraCenaDo(){
	var pCenaDo = document.getElementById('tbCenaDo').value;

	var regCenaDo = /^(\d)+$/;

	var greskeCenaDo = new Array();

	if (!regCenaDo.test(pCenaDo)) {
		greskeCenaDo.push("Cena nije u dobrom formatu.");
		document.getElementById('tbCenaDo').style.border = '1px solid #ff0000';
	}
	if (greskeCenaDo.length == 0) {
		
		document.getElementById('tbCenaDo').style.border = '1px solid #00ff00';
	}
}
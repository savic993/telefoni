<?php
	session_start();
	$pretragaModel = $_POST['model'];
	$pretragaProizvodjaci = $_POST['proizvodjac'];
	$cenaOd = $_POST['cenaOd'];
	$cenaDo = $_POST['cenaDo'];

	$pModel = "";
	$pProizvodjac = "";
	$pCenaOd = "";
	$pCenaDo = "";
	$br = 0;

	if ($pretragaProizvodjaci != 0) {
		if ($br == 0) {
			$pProizvodjac.=" p.id_proizvodjac=$pretragaProizvodjaci";
			$br++;
		}
		else{
			$pProizvodjac.= " and p.id_proizvodjac=$pretragaProizvodjaci";
		}
	}
	if ($pretragaModel != 0) {
		if ($br == 0) {
			$pModel.=" m.id_model=$pretragaModel";
			$br++;
		}
		else{
			$pModel.= " and m.id_model=$pretragaModel";
		}
	}
	if ($cenaOd != "") {
		if ($br == 0) {
			$pCenaOd.=" cena>$cenaOd";
			$br++;
		}
		else{
			$pCenaOd.= " and cena>$cenaOd";
		}
	}
	if ($cenaDo != "") {
		if ($br == 0) {
			$pCenaDo.=" cena<$cenaDo";
			$br++;
		}
		else{
			$pCenaDo.= " and cena<$cenaDo";
		}
	}

	include("konekcija.inc");
	include("funkcije.inc");

	$pSve = $pProizvodjac.$pModel.$pCenaOd.$pCenaDo;
	if ($pSve != "") {
		$upitPretraga = "select * from model m inner join proizvodjac p on m.id_proizvodjac=p.id_proizvodjac inner join slika s on m.id_model=s.id_model where".$pSve." group by s.id_model;";
	}else
	{
		$upitPretraga = "select * from model m inner join proizvodjac p on m.id_proizvodjac=p.id_proizvodjac inner join slika s on m.id_model=s.id_model group by s.id_model;";
	}

	$rezSearch = izvrsiUpitPrikaz($upitPretraga,$kon);

	if (gettype($rezSearch) != "array") {
		
		while ($redPretraga = mysql_fetch_array($rezSearch)) {
			$nizOpisPr = explode(",", $redPretraga['opis']);
			echo "<div class='telefon'><a href='index.php?id_artikl=".$redPretraga['id_model']."'>";
			echo "<div class='slika'><img src='".$redPretraga['putanjaM']."' alt='".$redPretraga['alt']."'/></div>";
			echo "<div class='ime'><h4>".$redPretraga['naziv_proizvodjac']." ".$redPretraga['naziv_model']."</h4></div>";
			echo "<div class='opis'>";
			echo "<h5>Kamera</h5>".$nizOpisPr[0]."<br/><h5>Procesor</h5>".$nizOpisPr[1]."<br/><h5>Memorija</h5>".$nizOpisPr[2]."<br/><h5>Wi-fi/Bluetooth</h5>".$nizOpisPr[3]."<br/><h5>Boja</h5>".$nizOpisPr[4];
			echo "</a></div>";
			echo "<span class='cena'><h3>Cena</h3><b>".$redPretraga['cena']."&euro;</b></span>";
			if ($redPretraga['kolicina'] == 0) {
				echo "<span class='obavestenje'>Trenutno nema</span>";
			}
			if (isset($_SESSION['id_korisnik'])) {
				echo "<form method='' action='' name='formaKupi'><input type='button' name='btnNaruci' class='btnNaruci' onclick='dodajUKorpu(".$redPretraga['id_model'].");' value='Naruci'/></form>";
			}
			echo "</div>";			
		}
	}
	else{
		echo "Nema podataka po zadatom kriterijumu!";
	}
?>
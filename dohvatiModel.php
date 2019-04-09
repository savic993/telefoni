<?php
	if (isset($_GET['id_model'])) {
		$idMod = $_GET['id_model'];
		include("konekcija.inc");
		$upitDohvatiModel = "select * from model m inner join proizvodjac p on m.id_proizvodjac=p.id_proizvodjac where id_model=$idMod;";
		$rezMod = mysql_query($upitDohvatiModel,$kon)or die("Upit za dohvatanje modela nije izvrsen".mysql_error());

		$redMod = mysql_fetch_array($rezMod);

		$opis = explode(",", $redMod['opis']);
		$nizMod = array($redMod['id_model'],$redMod['naziv_model'],$opis[0],$opis[1],$opis[2],$opis[3],$opis[4],$redMod['cena'],$redMod['kolicina']);

		echo json_encode($nizMod);
	}
?>
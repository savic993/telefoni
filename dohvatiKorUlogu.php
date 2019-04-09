<?php
	if (isset($_GET['id_ku'])) {
		$idku = $_GET['id_ku'];
		include("konekcija.inc");
		$upitDohvatiKU = "select * from korisnik_uloga where id_ku=$idku;";
		$rezKU = mysql_query($upitDohvatiKU,$kon)or die("Upit za dohvatanje uloge korisnika nije izvrsen".mysql_error());

		$redKU = mysql_fetch_array($rezKU);

		$nizKU = array($redKU['id_ku'],$redKU['id_korisnik'],$redKU['id_uloga']);

		echo json_encode($nizKU);
	}
?>
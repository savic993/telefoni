<?php
	if (isset($_GET['id_kor'])) {
		$idK = $_GET['id_kor'];
		include("konekcija.inc");
		$upitkor = "select * from korisnik where id_korisnik=$idK;";
		$rezkor = mysql_query($upitkor,$kon)or die("Upit za dohvatanje korisnika nije izvrsen".mysql_error());

		$redkor = mysql_fetch_array($rezkor);

		$nizkor = array($redkor['id_korisnik'],$redkor['ime_prezime'],$redkor['username'],$redkor['password'],$redkor['email'],$redkor['adresa']);

		echo json_encode($nizkor);
	}
?>
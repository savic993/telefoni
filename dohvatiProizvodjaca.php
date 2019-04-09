<?php
	if (isset($_GET['id_proizvodjaca'])) {
		$idP = $_GET['id_proizvodjaca'];
		include("konekcija.inc");
		$upitDohvatiP = "select * from proizvodjac where id_proizvodjac=$idP;";
		$rezP = mysql_query($upitDohvatiP,$kon)or die("Upit za dohvatanje proizvodjaca nije izvrsen".mysql_error());

		$redP = mysql_fetch_array($rezP);

		$nizP = array($redP['id_proizvodjac'],$redP['naziv_proizvodjac']);

		echo json_encode($nizP);
	}
?>
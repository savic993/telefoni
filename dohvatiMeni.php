<?php
	if (isset($_GET['id_menu'])) {
		$id = $_GET['id_menu'];
		include("konekcija.inc");
		$upitM = "select * from meni where id_meni=$id;";
		$rezM = mysql_query($upitM,$kon)or die("Upit za dohvatanje menija nije izvrsen".mysql_error());

		$redM = mysql_fetch_array($rezM);

		$nizM = array($redM['id_meni'],$redM['link'],$redM['naziv_meni'],$redM['pozicija']);

		echo json_encode($nizM);
	}
?>
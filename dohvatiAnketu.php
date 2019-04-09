<?php
	if (isset($_GET['id_anketa'])) {
		$idAnkete = $_GET['id_anketa'];
		include("konekcija.inc");
		$upitA = "select * from anketa where id_anketa=$idAnkete;";
		$rezA = mysql_query($upitA,$kon)or die("Upit za dohvatanje menija nije izvrsen".mysql_error());

		$redA = mysql_fetch_array($rezA);

		$nizA = array($redA['id_anketa'],$redA['pitanje'],$redA['aktivna']);

		echo json_encode($nizA);
	}
?>
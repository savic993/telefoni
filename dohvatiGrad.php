<?php
	if (isset($_GET['id_grada'])) {
		$idGr = $_GET['id_grada'];
		include("konekcija.inc");
		$upitDohvatiGrad = "select * from grad where id_grad=$idGr;";
		$rezGrad = mysql_query($upitDohvatiGrad,$kon)or die("Upit za dohvatanje grada nije izvrsen".mysql_error());

		$redGrad = mysql_fetch_array($rezGrad);

		$nizGrad = array($redGrad['id_grad'],$redGrad['ime_grad'],$redGrad['pos_br']);

		echo json_encode($nizGrad);
	}
?>
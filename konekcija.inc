<?php
	$greske = array();
	$host = "sql204.byethost.com";
	$korisnik = "b7_19822947";
	$lozinka = "13.11.savic";
	@$kon = mysql_connect($host,$korisnik,$lozinka);
	$ime_baze = "b7_19822947_prodavnica";
	@$baza = mysql_select_db($ime_baze,$kon);

	if (!$kon) {
		$greske[] = "Zao nam je. Problem sa serverom baze podataka!";
	}
	if (!$baza) {
		$greske[] = "Zao nam je. Problem sa bazom podataka!";
	}

?>
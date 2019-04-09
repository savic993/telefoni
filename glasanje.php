<?php
	if (isset($_GET['id_odg']) && isset($_GET['id_a'])) {
		$idOdg = $_GET['id_odg'];
		$id_Ankete = $_GET['id_a'];
		include("konekcija.inc");
		include("funkcije.inc");

		$prikazRezultata = "select * from rezultat where id_odgovor=$idOdg and id_anketa=$id_Ankete;";
		$rezGlas = izvrsiUpitPrikaz($prikazRezultata,$kon);
		
		if (gettype($rezGlas) == "array") {
			$upisRez = "insert into rezultat values('',$id_Ankete,$idOdg,1);";
			$izvrsenUpit = izvrsiUpitBrisanjeUpdateUpis($upisRez,$kon);
			if ($izvrsenUpit) {
				echo "Uspesno ste glasali";
			}
			else{
				echo "Glasanje nije uspelo";
			}
		}else{
			$upitGlas = "update rezultat set rezultat=rezultat+1 where id_odgovor=$idOdg and id_anketa=$id_Ankete;";
			
			$glas = izvrsiUpitBrisanjeUpdateUpis($upitGlas,$kon);
			if ($glas) {
				echo "Uspesno ste glasali";
			}
			else{
				echo "Glasanje nije uspelo";
			}
		}
	}
?>
<?php
	include("konekcija.inc");

	if (isset($_GET['id_artikl'])) {
		$id_a = $_GET['id_artikl'];

		$upitArtikl = "select * from proizvodjac p inner join model m on p.id_proizvodjac=m.id_proizvodjac where m.id_model = $id_a;";

		$rezArtikl = izvrsiUpitPrikaz($upitArtikl,$kon);

		if (gettype($rezArtikl) != "array") {
			$redA = mysql_fetch_array($rezArtikl);

			$artiklOpis = explode(",", $redA['opis']);
			echo "<div class='telefon'>";
			$slikeArtikl = "select * from slika where id_model=$id_a";
			$rezSlikeArtikl = izvrsiUpitPrikaz($slikeArtikl,$kon);
			if(gettype($rezSlikeArtikl) != "array"){
				echo "<div id='slikaArtikli'>";
				while ($redSlikaArtikl = mysql_fetch_array($rezSlikeArtikl)) {
					echo "<div class='slika'><a href='".$redSlikaArtikl['putanjaV']."'><img src='".$redSlikaArtikl['putanjaM']."' alt='".$redSlikaArtikl['alt']."'/></a></div>";
				}
				echo "</div>";
			}
			
			echo "<div class='ime'><h4>".$redA['naziv_proizvodjac']." ".$redA['naziv_model']."</h4></div>";
			echo "<div class='opis'>";
			echo "<h5>Kamera</h5>".$artiklOpis[0]."<br/><h5>Procesor</h5>".$artiklOpis[1]."<br/><h5>Memorija</h5>".$artiklOpis[2]."<br/><h5>Wi-fi/Bluetooth</h5>".$artiklOpis[3]."<br/><h5>Boja</h5>".$artiklOpis[4];
			echo "</div>";
			echo "<span class='cena'><h3>Cena</h3><b>".$redA['cena']."&euro;</b></span>";
			if ($redA['kolicina'] == 0) {
				echo "<span class='obavestenje'>Trenutno nema</span>";
			}
			if (isset($_SESSION['id_korisnik'])) {
				echo "<form method='' action='' name='formaKupi'><input type='hidden' name='tIdModel' class='tIdModel' value='".$redA['id_model']."' /><input type='button' _naziv='".$redA['naziv_model']."' _cena='".$redA['cena']."' _idmodel='".$redA['id_model']."' name='btnNaruci' class='btnNaruci' value='Naruci'/></form>";
			}
		}
	}
?>
<div id="prikazProizvodi">
	<?php
		include("konekcija.inc");
		if (isset($_GET['x']) && $_GET['x'] == 2) {
			$upitTelefoni = "select * from proizvodjac p inner join model m on p.id_proizvodjac=m.id_proizvodjac inner join slika s on m.id_model=s.id_model group by s.id_model";
			$rezTelefon = izvrsiUpitPrikaz($upitTelefoni,$kon);
			if (gettype($rezTelefon) != "array") {
				while ($redTelefon = mysql_fetch_array($rezTelefon)) {
					$telefonOpis = explode(",", $redTelefon['opis']);
					echo "<div class='telefon'><a href='index.php?id_artikl=".$redTelefon['id_model']."'>";
					echo "<div class='slika'><img src='".$redTelefon['putanjaM']."' alt='".$redTelefon['alt']."'/></div>";
					echo "<div class='ime'><h4>".$redTelefon['naziv_proizvodjac']." ".$redTelefon['naziv_model']."</h4></div>";
					echo "<div class='opis'>";
					echo "<h5>Kamera</h5>".$telefonOpis[0]."<br/><h5>Procesor</h5>".$telefonOpis[1]."<br/><h5>Memorija</h5>".$telefonOpis[2]."<br/><h5>Wi-fi/Bluetooth</h5>".$telefonOpis[3]."<br/><h5>Boja</h5>".$telefonOpis[4];
					echo "</a></div>";
					echo "<span class='cena'><h3>Cena</h3><b>".$redTelefon['cena']."&euro;</b></span>";
					if ($redTelefon['kolicina'] == 0) {
						echo "<span class='obavestenje'>Trenutno nema</span>";
					}
					if (isset($_SESSION['id_korisnik'])) {
						echo "<form method='' action='' name='formaKupi'><input type='hidden' name='tIdModel' class='tIdModel' value='".$redTelefon['id_model']."' /><input type='button' _naziv='".$redTelefon['naziv_model']."' _cena='".$redTelefon['cena']."' _idmodel='".$redTelefon['id_model']."' name='btnNaruci' class='btnNaruci' value='Naruci'/></form>";
					}
					echo "</div>";
				}
			}
		}
	?>
</div>
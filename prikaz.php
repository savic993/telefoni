<?php
$poStrani = 5;
if (isset($_GET['str'])) {
	$str = $_GET['str'];
}
else{
		$str=0;
	}
	$upitBrSvih = "select count(id_model) from model";
	$rezBrSvi =izvrsiUpitPrikaz($upitBrSvih,$kon);

	if (gettype($rezBrSvi) != "array") {
		$redBrSvi = mysql_fetch_array($rezBrSvi);
		$ukupno = $redBrSvi[0];
		$levo = $str - $poStrani;
		$desno = $str + $poStrani;

		if ($levo<0) {
			echo "<div id='navigacija'><span>Pocetak</span><span><a href='index.php?str=".$desno."'>Sledeci</a></span></div>";
		}
		else if ($desno > $ukupno) {
			echo "<div id='navigacija'><span><a href='index.php?str=".$levo."'>Prethodni</a></span><span>Kraj</span></div>";
		}else
		{
			echo "<div id='navigacija'><a href='index.php?str=".$levo."'>Prethodni</a></span><span><a href='index.php?str=".$desno."'>Sledeci</a></span></div>";
		}

		$upitPrikazSvih = "select * from proizvodjac p inner join model m on p.id_proizvodjac=m.id_proizvodjac inner join slika s on m.id_model=s.id_model group by s.id_model limit $poStrani offset $str;";
		$rezSvi = izvrsiUpitPrikaz($upitPrikazSvih,$kon);

		if (gettype($rezSvi) != "array"){
			while ($nizSvi = mysql_fetch_array($rezSvi)) {
				$nizOpis = explode(",", $nizSvi['opis']);
				echo "<div class='telefon'><a href='index.php?id_artikl=".$nizSvi['id_model']."'>";
				echo "<div class='slika'><img src='".$nizSvi['putanjaM']."' alt='".$nizSvi['alt']."'/></div>";
				echo "<div class='ime'><h4>".$nizSvi['naziv_proizvodjac']." ".$nizSvi['naziv_model']."</h4></div>";
				echo "<div class='opis'>";
				echo "<h5>Kamera</h5>".$nizOpis[0]."<br/><h5>Procesor</h5>".$nizOpis[1]."<br/><h5>Memorija</h5>".$nizOpis[2]."<br/><h5>Wi-fi/Bluetooth</h5>".$nizOpis[3]."<br/><h5>Boja</h5>".$nizOpis[4];
				echo "</a></div>";
				echo "<span class='cena'><h3>Cena</h3><b>".$nizSvi['cena']."&euro;</b></span>";
				if ($nizSvi['kolicina'] == 0) {
					echo "<span class='obavestenje'>Trenutno nema</span>";
				}
				if (isset($_SESSION['id_korisnik'])) {
					echo "<form method='' action='' name='formaKupi'><input type='hidden' name='tIdModel' class='tIdModel' value='".$nizSvi['id_model']."' /><input type='button' _naziv='".$nizSvi['naziv_model']."' _cena='".$nizSvi['cena']."' _idmodel='".$nizSvi['id_model']."' name='btnNaruci' class='btnNaruci' value='Naruci'/></form>";
				}
				echo "</div>";
			}
		}
	}
?>
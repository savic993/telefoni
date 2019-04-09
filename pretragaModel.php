<?php
session_start();
include("konekcija.inc");

$text = $_POST['tbPretraga'];

$upitPretragaModel="select * from model m inner join proizvodjac p on m.id_proizvodjac=p.id_proizvodjac inner join slika s on m.id_model=s.id_model";

if($text!=""){
 	$upitPretragaModel.=" where naziv_model like '%".$text."%' group by s.id_model";
 	$rezPretragaModel=mysql_query($upitPretragaModel,$kon);

 	while($redPretragaModel=mysql_fetch_array($rezPretragaModel)){
 		$nizPretraga = explode(",", $redPretragaModel['opis']);
		echo "<div class='telefon'>";
		echo "<div class='slika'><img src='".$redPretragaModel['putanjaM']."' alt='".$redPretragaModel['alt']."'/></div>";
		echo "<div class='ime'><h4>".$redPretragaModel['naziv_proizvodjac']." ".$redPretragaModel['naziv_model']."</h4></div>";
		echo "<div class='opis'>";
		echo "<h5>Kamera</h5>".$nizPretraga[0]."<br/><h5>Procesor</h5>".$nizPretraga[1]."<br/><h5>Memorija</h5>".$nizPretraga[2]."<br/><h5>Wi-fi/Bluetooth</h5>".$nizPretraga[3]."<br/><h5>Boja</h5>".$nizPretraga[4];
		echo "</div>";
		echo "<span class='cena'><h3>Cena</h3><b>".$redPretragaModel['cena']."&euro;</b></span>";
		if ($redPretragaModel['kolicina'] == 0) {
			echo "<span class='obavestenje'>Trenutno nema</span>";
		}
		if (isset($_SESSION['id_korisnik'])) {
			echo "<form method='' action='' name='formaKupi'><input type='hidden' name='tIdModel' class='tIdModel' value='".$redPretragaModel['id_model']."' /><input type='button' _naziv='".$redPretragaModel['naziv_model']."' _cena='".$redPretragaModel['cena']."' _idmodel='".$redPretragaModel['id_model']."' name='btnNaruci' class='btnNaruci' value='Naruci'/></form>";
		}
		echo "</div>";
	}
} else{
 	echo "<span id='obavestenjePretraga'>Nema prikaza po zadatom kriterijumu</span>";
}
?>

<div id="brisanje">
	<?php
		if (isset($_POST['btnIzbrisi']) && isset($_GET['b']) && $_GET['b'] == 1) {
			$idMeniZaBrisanje = $_POST['izbrisi'];

			foreach($idMeniZaBrisanje as $i){
				$upitBrisanjeMeni = "delete from meni where id_meni =".$i;
				$rezBrisanje = izvrsiUpitBrisanjeUpdateUpis($upitBrisanjeMeni,$kon);
				if(gettype($rezBrisanje) != "array"){
					echo "Meni koji ima ID=$i je obrisan!<br/>";
				}
				else
				{
					echo "Greska pri brisanju menija sa ID-jem $i!<br/>";
				}
			}
		}
		else if (isset($_POST['btnIzbrisi']) && isset($_GET['b']) && $_GET['b'] == 2) {
			$idKorZaBrisanje = $_POST['izbrisi'];

			foreach($idKorZaBrisanje as $ikb){
				$upitBrisanjeKorisnik = "delete from korisnik where id_korisnik =".$ikb;
				$rezBrisanjeKorisik = izvrsiUpitBrisanjeUpdateUpis($upitBrisanjeKorisnik,$kon);
				if(gettype($rezBrisanjeKorisik) != "array"){
					echo "Korisnik koji ima ID=$ikb je obrisan!<br/>";
				}
				else
				{
					echo "Greska pri brisanju korisnika sa ID-jem $ikb!<br/>";
				}
			}
		}
		else if (isset($_POST['btnIzbrisi']) && isset($_GET['b']) && $_GET['b'] == 3) {
			$idModZaBrisanje = $_POST['izbrisi'];

			foreach($idModZaBrisanje as $imb){
				$upitBrisanjeModel = "delete from model where id_model =".$imb;
				$rezBrisanjeModel = izvrsiUpitBrisanjeUpdateUpis($upitBrisanjeModel,$kon);
				if(gettype($rezBrisanjeModel) != "array"){
					echo "Model koji ima ID=$imb je obrisan!<br/>";
				}
				else
				{
					echo "Greska pri brisanju modela sa ID-jem $imb!<br/>";
				}
			}
		}
		else if (isset($_POST['btnIzbrisi']) && isset($_GET['b']) && $_GET['b'] == 4) {
			$idAnketaZaBrisanje = $_POST['izbrisi'];

			foreach($idAnketaZaBrisanje as $iab){
				$upitBrisanjeAnketa = "delete from anketa where id_anketa =".$iab;
				$rezBrisanjeAnketa = izvrsiUpitBrisanjeUpdateUpis($upitBrisanjeAnketa,$kon);
				if(gettype($rezBrisanjeAnketa) != "array"){
					echo "Anketa koja ima ID=$iab je obrisana!<br/>";
				}
				else
				{
					echo "Greska pri brisanju ankete sa ID-jem $iab!<br/>";
				}
			}
		}
		else if (isset($_POST['btnIzbrisi']) && isset($_GET['b']) && $_GET['b'] == 5) {
			$idGradZaBrisanje = $_POST['izbrisi'];

			foreach($idGradZaBrisanje as $igb){
				$upitBrisanjeGrad = "delete from grad where id_grad =".$igb;
				$rezBrisanjeGrad = izvrsiUpitBrisanjeUpdateUpis($upitBrisanjeGrad,$kon);
				if(gettype($rezBrisanjeGrad) != "array"){
					echo "Grad koji ima ID=$igb je obrisan!<br/>";
				}
				else
				{
					echo "Greska pri brisanju grada sa ID-jem $igb!<br/>";
				}
			}
		}
		else if (isset($_POST['btnIzbrisi']) && isset($_GET['b']) && $_GET['b'] == 6) {
			$idSlikeZaBrisanje = $_POST['izbrisi'];

			foreach($idSlikeZaBrisanje as $isb){
				$upitBrisanjeSlike = "delete from slika where id_slika =".$isb;
				$rezBrisanjeSlike = izvrsiUpitBrisanjeUpdateUpis($upitBrisanjeSlike,$kon);
				if(gettype($rezBrisanjeSlike) != "array"){
					echo "Slika koji ima ID=$isb je obrisana!<br/>";
				}
				else
				{
					echo "Greska pri brisanju slike sa ID-jem $isb!<br/>";
				}
			}
		}
		else if (isset($_POST['btnIzbrisi']) && isset($_GET['b']) && $_GET['b'] == 7) {
			$idKUZaBrisanje = $_POST['izbrisi'];

			foreach($idKUZaBrisanje as $ikub){
				$upitBrisanjeKU = "delete from korisnik_uloga where id_ku =".$ikub;
				$rezBrisanjeKU = izvrsiUpitBrisanjeUpdateUpis($upitBrisanjeKU,$kon);
				if(gettype($rezBrisanjeKU) != "array"){
					echo "Uloga korisnika je obrisana!<br/>";
				}
				else
				{
					echo "Greska pri brisanju uloge korisnika!<br/>";
				}
			}
		}
	?>
	<form action="" method="POST">
		<table>
		<?php
			if (isset($_GET['b']) && $_GET['b'] == 1) {
				echo "<tr><td>Naziv menija</td><td>Link</td><td>Izbrisi</td></tr>";
				$brisanjeMeni = prikaz($kon,'meni');
				foreach ($brisanjeMeni as $bMeni) {
					echo "<tr><td>".stripslashes($bMeni['naziv_meni'])."</td><td>".stripslashes($bMeni['link'])."</td><td><input type='checkbox' name='izbrisi[]' value='".$bMeni['id_meni']."'/></td></tr>";
				}
			}
			else if (isset($_GET['b']) && $_GET['b'] == 2) {
				echo "<tr><td>Ime i prezime</td><td>Username</td><td>Email</td><td>Izbrisi</td></tr>";
				$brisanjeKor = prikaz($kon,'korisnik');
				foreach ($brisanjeKor as $bKor) {
					echo "<tr><td>".stripslashes($bKor['ime_prezime'])."</td><td>".stripslashes($bKor['username'])."</td><td>".stripslashes($bKor['email'])."</td><td><input type='checkbox' name='izbrisi[]' value='".$bKor['id_korisnik']."'/></td></tr>";
				}
			}
			else if (isset($_GET['b']) && $_GET['b'] == 3) {
				echo "<tr><td>Proizvodjac</td><td>Naziv modela</td><td>Cena</td><td>Izbrisi</td></tr>";
				$upitPrikazModela = "select * from model m inner join proizvodjac p on m.id_proizvodjac=p.id_proizvodjac;";
				$reModel = izvrsiUpitPrikaz($upitPrikazModela,$kon);

				if (gettype($reModel) != "array") {
					while ($redModel = mysql_fetch_array($reModel)) {
						echo "<tr><td>".stripslashes($redModel['naziv_proizvodjac'])."</td><td>".stripslashes($redModel['naziv_model'])."</td><td>".stripslashes($redModel['cena'])."</td><td><input type='checkbox' name='izbrisi[]' value='".$redModel['id_model']."'/></td></tr>";
					}
				}
			}
			else if (isset($_GET['b']) && $_GET['b'] == 4) {
				echo "<tr><td>Pitanje</td><td>Aktivna</td><td>Izbrisi</td></tr>";
				$brisanjeAnketa = prikaz($kon,'anketa');
				foreach ($brisanjeAnketa as $bAnketa) {
					echo "<tr><td>".stripslashes($bAnketa['pitanje'])."</td><td>".$bAnketa['aktivna']."</td><td><input type='checkbox' name='izbrisi[]' value='".$bAnketa['id_anketa']."'/></td></tr>";
				}
			}
			else if (isset($_GET['b']) && $_GET['b'] == 5) {
				echo "<tr><td>Grad</td><td>Postanski broj</td><td>Izbrisi</td></tr>";
				$brisanjeGrad = prikaz($kon,'grad');
				foreach ($brisanjeGrad as $bGrad) {
					echo "<tr><td>".stripslashes($bGrad['ime_grad'])."</td><td>".$bGrad['pos_br']."</td><td><input type='checkbox' name='izbrisi[]' value='".$bGrad['id_grad']."'/></td></tr>";
				}
			}
			else if (isset($_GET['b']) && $_GET['b'] == 6) {
				echo "<tr><td>Slika</td><td>Opis slike</td><td>Model</td><td>Izbrisi</td></tr>";
				$prikazSlika = "select * from slika s inner join model m on s.id_model=m.id_model;";
				$rezPrikazSlika = izvrsiUpitPrikaz($prikazSlika,$kon);
				if (gettype($rezPrikazSlika) != "array") {
					while ($redSlike = mysql_fetch_array($rezPrikazSlika)) {
						echo "<tr><td><img src='".$redSlike['putanjaM']."' alt='".$redSlike['alt']."'/></td><td>".$redSlike['alt']."</td><td>".$redSlike['naziv_model']."</td><td><input type='checkbox' name='izbrisi[]' value='".$redSlike['id_slika']."'/></td></tr>";
					}
				}
			}
			else if (isset($_GET['b']) && $_GET['b'] == 7) {
				echo "<tr><td>username</td><td>Uloga</td><td>Izbrisi</td></tr>";
				$upitPrikazKorUloga = "select * from korisnik k inner join korisnik_uloga ku on k.id_korisnik=ku.id_korisnik inner join uloga u on ku.id_uloga=u.id_uloga;";
				$rezPrikazKorUlogaa = izvrsiUpitPrikaz($upitPrikazKorUloga,$kon);
				if (gettype($rezPrikazKorUlogaa != "array")) {
					while ($redUK = mysql_fetch_array($rezPrikazKorUlogaa)) {
						echo "<tr><td>".$redUK['username']."</td><td>".$redUK['naziv_uloga']."</td><td><input type='checkbox' name='izbrisi[]' value='".$redUK['id_ku']."'/></td></tr>";
					}
				}
			}
		?>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" class="dugmePanel" name="btnIzbrisi" value="Izbrisi" />
				<input type="reset" class="dugmePanel" name="btnReset" value="Ponisti" />
			</td>
		</tr>
		</table>
	</form>
</div>
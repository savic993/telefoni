<div id="korisnik">
	<div id="podaciKorisnika">
		<div id="slikaKorisnik">
			<img src="slike/korisnici/profilna.jpg" alt="korisnik" onload="ispisiKorisnika(<?php echo $_SESSION['id_korisnik']; ?>);"/>
		</div>
		<div id="korisnikForma">
			<form action="" method="POST" name="formaKorisnik">
				<table>
					<tr>
						<td><label class="labela" for="tbImePrezimeKor">Ime i prezime</label></td>
						<td><input type="text" id="tbImePrezimeKor" name="tbImePrezimeKor" class="tbText" disabled /></td>
					</tr>
					<tr>
						<td><label class="labela" for="tbUsernameKor">Username</label></td>
						<td><input type="text" id="tbUsernameKor" name="tbUsernameKor" class="tbText" /></td>
					</tr>
					<tr>
						<td><label class="labela" for="tbEmailKor">Email</label></td>
						<td><input type="text" id="tbEmailKor" name="tbEmailKor" class="tbText" /></td>
					</tr>
					<tr>
						<td><label class="labela" for="tbPasswordKor">Password</label></td>
						<td><input type="password" id="tbPasswordKor" name="tbPasswordKor" class="tbText" /></td>
					</tr>
					<tr>
						<td><label class="labela" for="ddlGradKor">Grad</label></td>
						<td>
							<select name="ddlGradKor" id="ddlGradKor">
								<option value="0">Izaberite</option>
								<?php
									$upitGr = "select * from grad;";
									$rezGr = izvrsiUpitPrikaz($upitGr,$kon);
									if (gettype($rezGr) != "array") {
										while ($nizGr = mysql_fetch_array($rezGr)) {
											echo "<option value='".$nizGr['id_grad']."'>".$nizGr['ime_grad']."</option>";
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="labela" for="tbAdresaKor">Adresa</label></td>
						<td><input type="text" id="tbAdresaKor" name="tbAdresaKor" class="tbText" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" class="korisnikDugme" name="btnIzmenaKor" value="Izmenite"/><input type="reset" class="korisnikDugme" name="btnPonisti" value="Ponisti"/></td>
					</tr>
				</table>
			</form>
	</div>
	</div>
	<?php
		if (isset($_POST['btnIzmenaKor'])) {
			$usernameKor = $_POST['tbUsernameKor'];
			$emailKor = $_POST['tbEmailKor'];
			$passKor = $_POST['tbPasswordKor'];
			$gradKor = $_POST['ddlGradKor'];
			$adresaKor = $_POST['tbAdresaKor'];
			$IDK = $_SESSION['id_korisnik'];

			$regUsernameKor = "/^(\w)+(\d)*$/";
			$regEmailKor = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
			$regPasswordKor = "/^[A-Za-z0-9]{6,10}$/";
			$regAdresaKor = "/^[A-Z][a-z]+\s([A-Z]([a-z])+\s)*[0-9]{1,3}$/";

			$greskeIzmenaKor = array();

			if (!preg_match($regUsernameKor, $usernameKor) || strlen($usernameKor) > 20) {
				$greskeIzmenaKor[] = "Username nije u dobrom formatu.";
			}
			if (!preg_match($regEmailKor, $emailKor) || strlen($emailKor) > 50) {
				$greskeIzmenaKor[] = "Email nije u dobrom formatu.";
			}
			if (!preg_match($regPasswordKor, $passKor)) {
				$greskeIzmenaKor[] = "Password nije u dobrom formatu.";
			}
			if (!preg_match($regAdresaKor, $adresaKor) || strlen($adresaKor) > 30) {
				$greskeIzmenaKor[] = "Adresa nije u dobrom formatu.";
			}
			if ($gradKor == 0) {
				$greskeIzmenaKor[] = "Niste izabrali grad.";
			}

			if (count($greskeIzmenaKor) == 0) {
				$usernameKor = zastita($usernameKor);
				$emailKor = zastita($emailKor);
				$adresaKor = zastita($adresaKor);

				$passKor = md5($passKor);

				$upitIzmenaKor = "update korisnik set username=$usernameKor, email=$emailKor, password=$passKor, adresa=$adresaKor where id_korisnik=$;IDK";

				$izmenaKor = izvrsiUpitBrisanjeUpdateUpis($upitIzmenaKor,$kon);
				if ($izmenaKor) {
					$_SESSION['username'] = $usernameKor;
				}
				else{
					echo "Doslo je do greske pri izmeni podataka o korisniku";
				}
			}
			else{
				foreach ($greskeIzmenaKor as $greskaKor) {
					echo $greskaKor."<br/>";
				}
			}
		}
	?>
</div>
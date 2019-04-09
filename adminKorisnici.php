<div id="prikaz">
	<?php
		if(isset($_POST['btnIzmeni'])){
			$imePrezimeK = $_POST['tbImePrezime'];
			$usernameK = $_POST['tbUsername'];
			$emailK = $_POST['tbEmail'];
			$passwordK = $_POST['tbPassword'];
			$idSKor = $_POST['sakriveniIdKorisnik'];

			$regImePrezimeK = "/^[A-Z][a-z]{2,24}\s[A-Z][a-z]{3,23}$/";
			$regUsernameK = "/^(\w)+(\d)*$/";
			$regEmailK = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
			$regPasswordK = "/^[A-Za-z0-9]{6,10}$/";

			$greskeIzmenaK = array();

			if (!preg_match($regImePrezimeK, $imePrezimeK)) {
				$greskeUpisK[] = "Ime i prezime nije u dobrom formatu.";
			}
			if (!preg_match($regUsernameK, $usernameK) || strlen($usernameK) > 20) {
				$greskeUpisK[] = "Username nije u dobrom formatu.";
			}
			if (!preg_match($regEmailK, $emailK) || strlen($emailK) > 50) {
				$greskeUpisK[] = "Email nije u dobrom formatu.";
			}
			if (!preg_match($regPasswordK, $passwordK)) {
				$greskeUpis[] = "Password nije u dobrom formatu.";
			}

			if (count($greskeIzmenaK) == 0) {
				$imePrezimeK = zastita($imePrezimeK);
				$usernameK = zastita($usernameK);
				$emailK = zastita($emailK);

				$passwordK = md5($passwordK);

				$upitPromenaKorisnik = "update korisnik set ime_prezime='".$imePrezimeK."', username='".$usernameK."', password='".$passwordK."', email='".$emailK."' where id_korisnik=$idSKor;";
				$rezIzmenaKorisnik = izvrsiUpitBrisanjeUpdateUpis($upitPromenaKorisnik,$kon);

				if ($rezIzmenaKorisnik) {
					echo "Uspesno ste promenili podatke za korisnika";
				}
				else{
					echo "Podaci za korisnika nisu promenjeni";
				}
			}else {
				foreach ($greskeIzmenaK as $gik) {
					echo $gik."<br/>";
				}
			}
		}
		else if (isset($_POST['btnUpisi'])) {
			$imePrezime = $_POST['tbImePrezime'];
			$username = $_POST['tbUsername'];
			$email = $_POST['tbEmail'];
			$password = $_POST['tbPassword'];

			$regImePrezime = "/^[A-Z][a-z]{2,24}\s[A-Z][a-z]{3,23}$/";
			$regUsername = "/^(\w)+(\d)*$/";
			$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
			$regPassword = "/^[A-Za-z0-9]{6,10}$/";

			$greskeUpisK = array();

			if (!preg_match($regImePrezime, $imePrezime)) {
				$greskeUpisK[] = "Ime i prezime nije u dobrom formatu.";
			}
			if (!preg_match($regUsername, $username) || strlen($username) > 20) {
				$greskeUpisK[] = "Username nije u dobrom formatu.";
			}
			if (!preg_match($regEmail, $email) || strlen($email) > 50) {
				$greskeUpisK[] = "Email nije u dobrom formatu.";
			}
			if (!preg_match($regPassword, $password)) {
				$greskeUpis[] = "Password nije u dobrom formatu.";
			}

			if (count($greskeUpisK) == 0) {
				$imePrezime = zastita($imePrezime);
				$username = zastita($username);
				$email = zastita($email);

				$password = md5($password);

				$upitUnosKorisnik = "insert into korisnik (ime_prezime,username,password,email) values('$imePrezime','$username','$password','$email');";
				$rezUpisKorisnik = izvrsiUpitBrisanjeUpdateUpis($upitUnosKorisnik,$kon);

				if ($rezUpisKorisnik) {
					echo "Uspesno ste uneli korisnika";
				}
				else{
					echo "Korisnik nije unet";
				}
			}else {
				foreach ($greskeUpisK as $gk) {
					echo $gk."<br/>";
				}
			}	
		}
	?>
	<form method='POST' action='' name='formaIzmena'>
		<table>
			<tr>
				<td>Ime i prezime</td>
				<td>Username</td>
				<td>Email</td>
				<td>Izmeni</td>
			</tr>
			<?php
				$rezKorisnici = prikaz($kon,'korisnik');
				foreach ($rezKorisnici as $korisnik) {
					echo "<tr><td>".stripslashes($korisnik['ime_prezime'])."</td><td>".stripslashes($korisnik['username'])."</td><td>".stripslashes($korisnik['email'])."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' onclick='promenaKorisnik(".$korisnik['id_korisnik'].");'/></td></tr>";
				}
			?>
		</table>
	</form>
</div>
<div id="izmena">
	<form action="" method="POST" name="formaPromeni">
		<table>
			<tr>
				<td><label class='labela' for='tbImePrezime'>Ime i prezime</label></td>
				<td><input type='text' class='tbText' id='tbImePrezime' name='tbImePrezime'/></td>
			</tr>
			<tr>
				<td><label for='tbUsername' class='labela'>Username</label></td>
				<td><input type='text' class='tbText' name='tbUsername' id='tbUsername' /></td>
			</tr>
			<tr>
				<td><label class='labela' for='tbEmail'>Email</label></td>
				<td><input type='text' class='tbText' id='tbEmail' name='tbEmail'/></td>
			</tr>
			<tr>
				<td><label class='labela' for='tbPassword'>Password</label></td>
				<td>
					<input type='password' class='tbText' id='tbPassword' name='tbPassword'/>
					<input type="hidden" name="sakriveniIdKorisnik" id="sakriveniIdKorisnik" value=""/>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnIzmeni' value='Izmeni'/><input type='submit' class="dugmePanel" name='btnUpisi' value='Upisi'/></td>
			</tr>
		</table>
	</form>
</div>
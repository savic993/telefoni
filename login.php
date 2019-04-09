<?php
session_start();
include("konekcija.inc");
include("funkcije.inc");

	if (isset($_POST['btnPrijava'])) {
		$userr = $_POST['tbLoginUsername'];
		$lozinka = $_POST['tbLoginPassword'];
		$userr = trim($userr);
		$userr = stripslashes($userr);
		$lozinka = md5($lozinka);

		$upitLogin = "select * from korisnik k inner join korisnik_uloga ku on k.id_korisnik=ku.id_korisnik inner join uloga u on ku.id_uloga=u.id_uloga where username='".$userr."' and password='".$lozinka."';";
		$rezLog = izvrsiUpitPrikaz($upitLogin,$kon);

		if (gettype($rezLog) == "array") {
			header('Location:index.php');
			echo "Logovanje nije uspesno";
		}
		else{
			if (mysql_num_rows($rezLog) == 1) {
				$nizLog = mysql_fetch_array($rezLog);
				$_SESSION['id_korisnik'] = $nizLog['id_korisnik'];
				$_SESSION['username'] = $nizLog['username'];
				$_SESSION['id_uloga'] = $nizLog['id_uloga'];
				$_SESSION['naziv_uloga'] = $nizLog['naziv_uloga'];
				header('Location:index.php');
			}
			else{
				echo "Greska pri logovanju";
				header('Location:index.php');
			}
		}
	}
?>
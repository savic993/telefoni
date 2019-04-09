<?php
	include("konekcija.inc");
	include("funkcije.inc");
	if (isset($_GET['g'])) {
		$id_grad = $_GET['g'];
		$upitG = "select * from grad where id_grad=$id_grad;";
		$rezG = izvrsiUpitPrikaz($upitG,$kon);
		if (gettype($rezG) != "array") {
			if (mysql_num_rows($rezG) == 1) {
				$nizG = mysql_fetch_array($rezG);
				echo $nizG['pos_br'];
			}
			else
			{
				echo "Greska!";
			}
		}
		else{
			echo "Greska!";
			//objasniti greske konkretnije
		}
	}
	//include("zatvori.inc");
?>
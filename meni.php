<div class="okvir">
	<div id="naslov">
		<h1><a href="index.php">Telefoni</a></h1>
	</div>
	<div id="okvirMeni">
		<?php
			$upit = "select * from meni order by pozicija asc;";
			$rezMeni = izvrsiUpitPrikaz($upit,$kon);
			if (gettype($rezMeni) == "array") {
				foreach($rezMeni as $r){
					echo $r."<br/>";
				}
			}
			else{
				echo "<ul>";
				while ($red = mysql_fetch_array($rezMeni)) {
					echo "<li><a href='".$red['link'].$red['id_meni']."'>".$red['naziv_meni']."</a></li>";
				}
				echo "</ul>";
			}
		?>
	</div>
	<div id="pretraga">
		<form action="" method="" name="formaPretraga" id="formaPretraga">
			<input type="text" name="tbPretraga" id="tbPretraga" placeholder="Pretraga"/>
			<input type="submit" name="btnPretraga" id="btnPretraga" value="" class="dugmePretraga"/>
		</form>
	</div>
	<div id="okvirLogovanje">
		<?php
			if (isset($_SESSION['id_korisnik'])) {
				echo "<a href='index.php?id_k=".$_SESSION['id_korisnik']."'>".$_SESSION['username']."</a> <a href='index.php?logout=1'>Logout</a>";
				if (isset($_GET['logout']) && $_GET['logout'] == 1) {
					session_destroy();
					header('Location:index.php');
				}
			}else{			  
				echo "<div id='logovanje'>
						<form action='login.php' onsubmit='return proveraLog();' method='POST' name='formaLogin'>
							<input type='text' name='tbLoginUsername' id='tbLoginUsername' placeholder='Username' class='tbLogin' />
							<input type='password' name='tbLoginPassword' id='tbLoginPassword' placeholder='Password' class='tbLogin' />
							<input type='submit' name='btnPrijava' value='Prijavi se' class='dugme' />
						</form>
						<form action='index.php?x=1' method='POST' name='formaReg'>
							<input type='submit' name='btnRegistracija' value='Registruj se' class='dugme' />
						</form>
					</div>";
			}
		?>
	</div>
	<div id="korpa">
		<img src="slike/ikonice/korpa.png" alt="korpa"/>
		<span id="brModelaUKorpi">
		
		</span>
	</div>
	<div id="okvirKorpa">
		<div id="prikazKorpa">
			
		</div>
		<div id="futerKorpa">
			<span id="korpaUkupno">Ukupno</span>
			<div id="ukupnaCena"></div>
		</div>
	</div>
</div>
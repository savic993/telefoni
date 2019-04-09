<div id='prikaz'>
	<?php
		if(isset($_POST['btnIzmeni'])){
			$usernameUloga = $_POST['ddlUsername'];
			$ulogaDodela = $_POST['ddlUloga'];

			if ($usernameUloga != 0 && $ulogaDodela != 0) {
				$upitUlogeKorisnika = "select * from korisnik_uloga where id_korisnik=$usernameUloga and id_uloga=$ulogaDodela;";
				$rezKorisnikUloga = izvrsiUpitPrikaz($upitUlogeKorisnika,$kon);
				
				if (gettype($rezKorisnikUloga) == "array") {
					$upisUloge = "insert into korisnik_uloga values('',$usernameUloga,$ulogaDodela);";
					$dodelaUloge = izvrsiUpitBrisanjeUpdateUpis($upisUloge,$kon);
					if ($dodelaUloge) {
						echo "<div id='poruka'>Uspesno ste dodelili ulogu</div>";
					}
					else{
						echo "<div id='red'>Dodela uloge nije uspela</div>";
					}
				}else{
					$updateUlogeKorisnika = "update korisnik_uloga set id_korisnik=$usernameUloga, id_uloga=$ulogaDodela where id_korisnik=$usernameUloga and id_uloga=$ulogaDodela;";
					
					$updateKor = izvrsiUpitBrisanjeUpdateUpis($updateUlogeKorisnika,$kon);
					if ($updateKor) {
						echo "<div id='poruka'>Uspesno ste dodelili ulogu</div>";
					}
					else{
						echo "<div id='red'>Dodela uloge nije uspela</div>";
					}
				}
			}
			else {
				echo "<div id='red'>Izaberite korisnika i ulogu</div>";
			}
		}
	?>
	<form method='POST' action='' name='formaIzmena'>
		<table>
			<tr>
				<td>Username</td>
				<td>Uloga</td>
			</tr>
			<?php
				$upitKorUloga = "select * from korisnik k inner join korisnik_uloga ku on k.id_korisnik=ku.id_korisnik inner join uloga u on ku.id_uloga=u.id_uloga;";
				$rezPrikazKorUloga = izvrsiUpitPrikaz($upitKorUloga,$kon);
				if (gettype($rezPrikazKorUloga != "array")) {
					while ($redUlogaKor = mysql_fetch_array($rezPrikazKorUloga)) {
						echo "<tr><td>".$redUlogaKor['username']."</td><td>".$redUlogaKor['naziv_uloga']."</td></tr>";
					}
				}
			?>
		</table>
	</form>
</div>
<div id='izmena'>
	<form action="" method="POST" name="formaPromeni">
		<table>
			<tr>
				<td><label class='labela' for='tbUsernameDodela'>Username</label></td>
				<td>
					<select name="ddlUsername" id="ddlUsername">
						<option value="0">Izaberi</option>
						<?php
							$users = prikaz($kon,'korisnik');
							foreach ($users as $user) {
								echo "<option value='".$user['id_korisnik']."'>".$user['username']."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for='tbUloga' class='labela'>Uloga</label></td>
				<td>
					<select name="ddlUloga" id="ddlUloga">
						<option value="0">Izaberi</option>
						<?php
							$uloge = prikaz($kon,'uloga');
							foreach ($uloge as $uloga) {
								echo "<option value='".$uloga['id_uloga']."'>".$uloga['naziv_uloga']."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnIzmeni' value='Dodeli'/><input type="reset" class="dugmePanel" name="btnPonisti" value="Ponisti" /></td>
			</tr>
		</table>
	</form>
</div>
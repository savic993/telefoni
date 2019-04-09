<div id='prikaz'>
	<?php
		if(isset($_POST['btnIzmeni'])){
			$pitanjeIzmena = $_POST['taPitanje'];
			@$aktivnaIzmena = $_POST['rbAktivna'];
			$idanketa = $_POST['sakriveniIdAnketa'];
			$pitanjeIzmena = zastita($pitanjeIzmena);
			

			if (strlen($pitanjeIzmena) > 0 && isset($aktivnaIzmena)) {
				$upitIzmenaAnketa = "update anketa set pitanje='".$pitanjeIzmena."', aktivna='".$aktivnaIzmena."' where id_anketa=$idanketa;";
				$rezIzmenaAnketa = izvrsiUpitBrisanjeUpdateUpis($upitIzmenaAnketa,$kon);
				if ($rezIzmenaAnketa) {
					echo "Uspesno ste izmenili anketu";
				}
				else{
					echo "Anketa nije izmenjena";
				}
			}
			else {
				echo "Unesite pitanje i izaberite status ankete";
			}
		}
		else if (isset($_POST['btnUpisi'])) {
			$pitanje = $_POST['taPitanje'];
			@$aktivna = $_POST['rbAktivna'];

			$pitanje = zastita($pitanje);

			if (strlen($pitanje) > 0 && isset($aktivna)) {
				$upitUnosAnketa = "insert into anketa values('','$pitanje',$aktivna);";
				$rezUnosAnketa = izvrsiUpitBrisanjeUpdateUpis($upitUnosAnketa,$kon);
				if ($rezUnosAnketa) {
					echo "Uspesno ste uneli anketu";
				}
				else{
					echo "Anketa nije uneta";
				}
			}
			else {
				echo "Niste upisali pitanje ili odgovor";
			}		
		}
		else if (isset($_POST['btnUpisiOdgovor'])) {
			$idPitanje = $_POST['ddlPitanje'];
			$odgovor = $_POST['taOdgovor'];

			$odgovor = zastita($odgovor);

			if (strlen($odgovor) > 0 && $idPitanje != 0 ) {
				$upitOdgovor = "insert into odgovori values('','$odgovor',$idPitanje);";
				$rezUnosOdgovor = izvrsiUpitBrisanjeUpdateUpis($upitOdgovor,$kon);

				if ($rezUnosOdgovor) {
					echo "Uspesno ste uneli odgovor";
				}
				else
				{
					echo "Odgovor nije unet";
				}
			}
			else{
				echo "Unesite odgovor i izaberite pitanje na koje se odgovor odnosi";
			}
		}
	?>
	<h3>Anketa</h3>
	<hr/>
	<form method='POST' action='' name='formaIzmena'>
		<table>
			<tr>
				<td>Pitanje</td>
				<td>Aktivna</td>
				<td>Izmeni</td>
			</tr>
			<?php
				$anketa = prikaz($kon,"anketa");
				foreach ($anketa as $a) {
					echo "<tr><td>".stripslashes($a['pitanje'])."</td><td>".stripslashes($a['aktivna'])."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' onclick='promenaAnketa(".$a['id_anketa'].");'/></td></tr>";
				}
			?>
		</table>
	</form>
</div>
<div id='izmena'>
	<div class="izmenaAnketa">
		<h3>Dodaj pitanje</h3>
		<hr/>
		<form action="" method="POST" name="formaPromeni">
			<table>
				<tr>
					<td><label class='labela' for='taPitanje'>Pitanje</label></td>
					<td><textarea id="taPitanje" name="taPitanje"></textarea></td>
				</tr>
				<tr>
					<td><label for='tbLink' class='labela'>Aktivna</label></td>
					<td>
						<input type='radio' name='rbAktivna' id='da' value="1" />Da<br/>
						<input type='radio' name="rbAktivna" id="ne" value="0" />Ne
						<input type="hidden" name="sakriveniIdAnketa" id="sakriveniIdAnketa" value=""/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnIzmeni' value='Izmeni'/><input type='submit' class="dugmePanel" name='btnUpisi' value='Upisi'/></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="izmenaAnketa">
		<h3>Dodaj odgovor</h3>
		<hr/>
		<form action="" method="POST" name="formaDodajOdgovor">
			<table>
				<tr>
					<td>
						<label class="labela" for="ddlPitanje">Pitanje</label>
					</td>
					<td>
						<select name="ddlPitanje" id="ddlPitanje">
							<option value="0">Izaberi</option>
							<?php
								$pitanja = prikaz($kon,'anketa');
								foreach ($pitanja as $pitanje) {
									echo "<option value='".$pitanje['id_anketa']."'>".$pitanje['pitanje']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label class="labela" for="taOdgovor">Odgovor</label>
					</td>
					<td>				
						<textarea id="taOdgovor" name="taOdgovor"></textarea>			
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnUpisiOdgovor' value='Upisi'/><input type="reset" class="dugmePanel" name="btnReset" value="Ponisti"/></td>
				</tr>
			</table>
		</form>
	</div>
</div>
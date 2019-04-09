<div id='prikaz'>
	<?php
		if(isset($_POST['btnUpisiModel'])){
			$nazivModel = $_POST['tbNazivModela'];
			$proizvodjacId = $_POST['ddlProizvodjac'];
			$kamera = $_POST['tbKamera'];
			$procesor = $_POST['tbProcesor'];
			$memorija = $_POST['tbMemorija'];
			$wifi = $_POST['tbWiFi'];
			$boja = $_POST['tbBoja'];
			$cena = $_POST['tbCena'];
			$kolicina = $_POST['tbKolicina'];

			$nizZaOpis = array($kamera,$procesor,$memorija,$wifi,$boja);
			$upisOpis = implode(",", $nizZaOpis);

			$nazivModel = zastita($nazivModel);

			if (strlen($nazivModel) < 25 && $proizvodjacId != 0){
				$upitUpisModel = "insert into model values('','$nazivModel',$proizvodjacId,'$upisOpis',$cena,$kolicina);";
				$rezUpisModel = izvrsiUpitBrisanjeUpdateUpis($upitUpisModel,$kon);
				if ($rezUpisModel) {
					echo "Uspesno ste uneli model";
				}
				else{
					echo "Model nije unet";
				}
			}
			else {
				echo "Prevelik broj karaktera za naziv modela ili niste izabrali proizvodjaca";
			}
		}
		else if (isset($_POST['btnIzmeniModel'])) {
			$nazivMod = $_POST['tbNazivModela'];
			$pId = $_POST['ddlProizvodjac'];
			$idMod = $_POST['sakriveniIdModela'];
			$kameraa = $_POST['tbKamera'];
			$procesorr = $_POST['tbProcesor'];
			$memorijaa = $_POST['tbMemorija'];
			$wifii = $_POST['tbWiFi'];
			$bojaa = $_POST['tbBoja'];
			$cenaa = $_POST['tbCena'];
			$kolicinaa = $_POST['tbKolicina'];

			$nizZaOpiss = array($kameraa,$procesorr,$memorijaa,$wifii,$bojaa);
			$upisOpiss = implode(",", $nizZaOpiss);

			$nazivMod = zastita($nazivMod);

			if (strlen($nazivMod) < 25 && $pId != 0){
				$upitIzmenaModel = "update model set naziv_model='".$nazivMod."',id_proizvodjac=$pId, opis='".$upisOpiss."', cena=$cenaa, kolicina=$kolicinaa where id_model=$idMod;";
				$rezIzmenaModel = izvrsiUpitBrisanjeUpdateUpis($upitIzmenaModel,$kon);
				if ($rezIzmenaModel) {
					echo "Uspesno ste izmenili podatke za model";
				}
				else{
					echo "Model nije izmenjen";
				}
			}
			else {
				echo "Prevelik broj karaktera za naziv modela ili niste izabrali proizvodjaca";
			}
		}
		else if (isset($_POST['btnUpisiProizvodjaca'])) {
			$nazivP = $_POST['tbNazivProizvodjaca'];
			
			$nazivP = zastita($nazivP);

			if (strlen($nazivP) < 30) {
				$upitUnosProizvodjac = "insert into proizvodjac values('','$nazivP');";
				$rezUpisPr = izvrsiUpitBrisanjeUpdateUpis($upitUnosProizvodjac,$kon);
				if ($rezUpisPr) {
					echo "Uspesno ste uneli proizvodjaca";
				}
				else{
					echo "Proizvodjac nije unet";
				}
			}
			else {
				echo "Prevelik broj karaktera";
			}		
		}else if (isset($_POST['btnIzmeniProizvodjaca'])) {
			$nazivProizvodjac = $_POST['tbNazivProizvodjaca'];
			$idProizvodjac = $_POST['sakriveniIdProizvodjaca'];

			$nazivProizvodjac = zastita($nazivProizvodjac);

			if (strlen($nazivProizvodjac) < 30) {
				$upitIzmenaProizvodjac = "update proizvodjac set naziv_proizvodjac='".$nazivProizvodjac."' where id_proizvodjac=$idProizvodjac;";
				$rezIzmenaPr = izvrsiUpitBrisanjeUpdateUpis($upitIzmenaProizvodjac,$kon);
				if ($rezIzmenaPr) {
					echo "Uspesno ste promenili podatke za proizvodjaca";
				}
				else{
					echo "Proizvodjac nije izmenjen";
				}
			}
			else {
				echo "Prevelik broj karaktera";
			}
		}
	?>
	<div id="proizvodjaci">
		<h3>Proizvodjaci</h3>
		<hr/>
		<form method='POST' action='' name='formaIzmenaProizvodjac'>
			<table>
				<tr>
					<td>Naziv proizvodjaca</td>
					<td>Izmeni</td>
				</tr>
				<?php
					$proizvodjac = prikaz($kon,"proizvodjac");
					foreach ($proizvodjac as $p) {
						echo "<tr><td>".stripslashes($p['naziv_proizvodjac'])."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' onclick='promenaProizvodjac(".$p['id_proizvodjac'].");'/></td></tr>";
					}
				?>
			</table>
		</form>
	</div>
	<div id="modeli">
		<h3>Modeli</h3>
		<hr/>
		<form method='POST' action='' name='formaIzmenaModel'>
			<table>
				<tr>
					<td>Naziv modela</td>
					<td>Proizvodjac</td>
					<td>Kamera</td>
					<td>Procesor</td>
					<td>Memorija</td>
					<td>Wi-fi/Bluetooth</td>
					<td>Boja</td>
					<td>Cena</td>
					<td>Kolicina</td>
					<td>Izmeni</td>
				</tr>
				<?php
					$upitModel = "select * from model m inner join proizvodjac p on m.id_proizvodjac=p.id_proizvodjac;";
					$rezModel = izvrsiUpitPrikaz($upitModel,$kon);
					if (gettype($rezModel) != "array") {
						while ($redModel = mysql_fetch_array($rezModel)) {
							$nizOpis = explode(",", $redModel['opis']);
							echo "<tr><td>".$redModel['naziv_model']."</td><td>".$redModel['naziv_proizvodjac']."</td><td>".$nizOpis[0]."</td><td>".$nizOpis
							[1]."</td><td>".$nizOpis[2]."</td><td>".$nizOpis[3]."</td><td>".$nizOpis[4]."</td><td>".$redModel['cena']."</td><td>".$redModel['kolicina']."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' onclick='promenaModel(".$redModel['id_model'].");'/></td></tr>";
						}
					}
				?>
			</table>
		</form>
	</div>
</div>
<div id='izmena'>
	<div id="proizvodjaciIzmena">
		<h3>Proizvodjaci</h3>
		<hr/>
		<form action="" method="POST" name="formaPromeniProizvodjac">
			<table>
				<tr>
					<td><label class='labela' for='tbNazivProizvodjaca'>Naziv proizvodjaca</label></td>
					<td>
						<input type='text' class='tbText' id='tbNazivProizvodjaca' name='tbNazivProizvodjaca' />
						<input type="hidden" name="sakriveniIdProizvodjaca" id="sakriveniIdProizvodjaca" value=""/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnIzmeniProizvodjaca' value='Izmeni'/><input type='submit' class="dugmePanel" name='btnUpisiProizvodjaca' value='Upisi'/></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="modelIzmena">
		<h3>Modeli</h3>
		<hr/>
		<form action="" method="POST" name="formaPromeniModel">
			<table>
				<tr>
					<td><label class='labela' for='tbNazivModela'>Naziv modela</label></td>
					<td>
						<input type='text' class='tbText' id='tbNazivModela' name='tbNazivModela' />
						<input type="hidden" name="sakriveniIdModela" id="sakriveniIdModela" value=""/>
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbProizvodjac'>Proizvodjac</label></td>
					<td>
						<select name="ddlProizvodjac" id="ddlProizvodjac">
							<option value="0">Izaberi</option>
							<?php
								$pro = prikaz($kon,"proizvodjac");
								foreach ($pro as $pr) {
									echo "<option value='".$pr['id_proizvodjac']."'>".$pr['naziv_proizvodjac']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbKamera'>Kamera</label></td>
					<td>
						<input type='text' class='tbText' id='tbKamera' name='tbKamera' />
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbProcesor'>Procesor</label></td>
					<td>
						<input type='text' class='tbText' id='tbProcesor' name='tbProcesor' />
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbMemorija'>Memorija</label></td>
					<td>
						<input type='text' class='tbText' id='tbMemorija' name='tbMemorija' />
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbWiFi'>Wi-fi/Bluetooth</label></td>
					<td>
						<input type='text' class='tbText' id='tbWiFi' name='tbWiFi' />
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbBoja'>Boja</label></td>
					<td>
						<input type='text' class='tbText' id='tbBoja' name='tbBoja' />
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbCena'>Cena</label></td>
					<td>
						<input type='text' class='tbText' id='tbCena' name='tbCena' />
					</td>
				</tr>
				<tr>
					<td><label class='labela' for='tbKolicina'>Kolicina</label></td>
					<td>
						<input type='text' class='tbText' id='tbKolicina' name='tbKolicina' />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnIzmeniModel' value='Izmeni'/><input type='submit' class="dugmePanel" name='btnUpisiModel' value='Upisi'/></td>
				</tr>
			</table>
		</form>
	</div>
</div>
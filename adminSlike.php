<div id='prikaz'>
	<?php
		if(isset($_POST['btnUnesi'])){
			$imeSlike = $_FILES['slika']['name'];
			$tmpSlike = $_FILES['slika']['tmp_name'];
			$naziv_slike = time().$imeSlike;
			$idModelSlike = $_POST['ddlModelUnos'];
			$putanjaV = "slike/telefoni/velikeSlike/".$naziv_slike;
			$putanjaM = "slike/telefoni/maleSlike/".$naziv_slike;
			$alt = $_POST['tbAlt'];

			$greskeSlike = array();

			$tipSlike = $_FILES['slika']['type'];
			if (($tipSlike == "image/jpg" || $tipSlike == "image/jpeg" || $tipSlike == "image/png") && strlen($alt) < 30 && strlen($putanjaV) < 150 && strlen($putanjaM) < 150) {
				if (move_uploaded_file($tmpSlike, $putanjaV)) {
					malaslika($putanjaV,$putanjaM,250,250);

					$upitUpisSlika = "insert into slika values('','$putanjaV','$putanjaM','$alt',$idModelSlike);";
					$rezUnosSlika = izvrsiUpitBrisanjeUpdateUpis($upitUpisSlika,$kon);
					if (gettype($rezUnosSlika) == "array") {
						$greskeSlike[] = "Slika nije uneta u bazu";
					}
				}
				else{
					$greskeSlike[] = "Slika nije prebacena na server";
				}
			}
			else{
				$greskeSlike[] = "Tip fajla nije podrzan ili parametri nisu odgovarajuci";
			}
		}
		if(isset($greskeSlike) && count($greskeSlike) > 0){
			foreach($greskeSlike as $gs){
				echo $gs."<br/>";
			}
		}
	?>
	<div id="izaberiModel">
		<h3>Prikaz po modelima</h3>
		<hr/>
		<form method='POST' action='' name='formaPrikaz'>
			<table>
				<tr>
					<td><label for="ddlModel" class="labela">Model</label></td>
					<td>
						<select name="ddlModel" id="ddlModel">
							<option value="0">Izaberi</option>
							<?php
								$modeli = prikaz($kon,'model');
								foreach ($modeli as $m) {
									echo "<option value='".$m['id_model']."'>".$m['naziv_model']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" class="dugmePanel" name="btnPrikazi" value="Prikazi"></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="slikeModela">
		<?php
			if (isset($_POST['btnPrikazi'])) {
				$id_izabranMod = $_POST['ddlModel'];
				$slikeUpit = "select * from slika s inner join model m on s.id_model=m.id_model where s.id_model=$id_izabranMod;";

				$slikeRez = izvrsiUpitPrikaz($slikeUpit,$kon);
				if (gettype($slikeRez) != "array") {
					while ($redSlika = mysql_fetch_array($slikeRez)) {
						?>
							<div class="malaSlika">
								<a href="<?php echo $redSlika['putanjaV']; ?>"><img src="<?php echo $redSlika['putanjaM']; ?>" alt="<?php echo $redSlika['alt']; ?>" title="<?php echo $redSlika['naziv_model']; ?>"/></a>
							</div>
						<?php
					}
				}
			}
		?>
	</div>
</div>
<div id='izmena'>
	<h3>Unos slika</h3>
	<hr/>
	<form method='POST' action='' name='formaUnos' enctype="multipart/form-data">
			<table>
				<tr>
					<td><label for="ddlModelUnos" class="labela">Model</label></td>
					<td>
						<select name="ddlModelUnos" id="ddlModelUnos">
							<option value="0">Izaberi</option>
							<?php
								$modeliUnos = prikaz($kon,'model');
								foreach ($modeliUnos as $mu) {
									echo "<option value='".$mu['id_model']."'>".$mu['naziv_model']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="tbAlt" class="labela">Opis</label></td>
					<td><input type="text" name="tbAlt" id="tbAlt"/></td>
				</tr>
				<tr>
					<td><label for="slika" class="labela">Slika</label></td>
					<td><input type="file" name="slika" id="slika"/></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" class="dugmePanel" name="btnUnesi" value="Unesi"></td>
				</tr>
			</table>
		</form>
</div>
<div id="registracija">
	<h3>Forma za registraciju</h3>
	<hr/>
	<fieldset><legend>Podaci o nalogu</legend>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return proveraRegistracija();" method="post" name="formaRegistracija">
		<table>
			<tr>
				<td>
					<label class="labela" for="tbImePrezime">Ime i prezime</label>
				</td>
				<td>
					<input type="text" name="tbImePrezime" id="tbImePrezime" class="tbText" placeholder="Ime i prezime" required />
				</td>
			</tr>
			<tr>
				<td>
					<label class="labela" for="tbUsername">Username</label>
				</td>
				<td>
					<input type="text" name="tbUsername" id="tbUsername" class="tbText" placeholder="Username" required />
				</td>
			</tr>
			<tr>
				<td>
					<label class="labela" for="tbEmail">Email</label>
				</td>
				<td>
					<input type="text" name="tbEmail" id="tbEmail" class="tbText" placeholder="Email" required />
				</td>
			</tr>
			<tr>
				<td>
					<label class="labela" for="tbPassword">Password</label>
				</td>
				<td>
					<input type="password" name="tbPassword" id="tbPassword" class="tbText" placeholder="Password" required />
				</td>
			</tr>
		</table>
		</fieldset>
		<fieldset><legend>Adresa</legend>
		<table>
			<tr>
				<td>
					<label class="labela" for="ddlGrad">Grad</label>
				</td>
				<td>
					<select name="ddlGrad" id="ddlGrad" onChange="adresa();">
						<option value="0">Izaberite</option>
						<?php
							$upitGrad = "select * from grad;";
							$rezGrad = izvrsiUpitPrikaz($upitGrad,$kon);
							if (gettype($rezGrad) != "array") {
								while ($nizGrad = mysql_fetch_array($rezGrad)) {
									echo "<option value='".$nizGrad['id_grad']."'>".$nizGrad['ime_grad']."</option>";
								}
							}
						?>
					</select>
					<input type="text" name="tbPosBr" id="tbPosBr" class="tbText" placeholder="Postanski broj" disabled />
				</td>
			</tr>
			<tr>
				<td>
					<label class="labela" for="tbAdresa">Ulica i broj</label>
				</td>
				<td>
					<input type="text" name="tbAdresa" id="tbAdresa" class="tbText" placeholder="Ulica i broj" required/>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<input type="submit" name="btnPotvrdi" value="Potvrdi" class="dugme"/>
					<input type="reset" name="btnRestart" value="Ponisti" class="dugme" />
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</div>

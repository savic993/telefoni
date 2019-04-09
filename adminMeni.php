<div id='prikaz'>
	<?php
		if(isset($_POST['btnIzmeni'])){
			$nazivMenu = $_POST['tbNazivMeni'];
			$linkMenu = $_POST['tbLink'];
			$idMenu = $_POST['sakriveniIdMeni'];
			$pozicija = $_POST['tbPozicija'];
			$nazivMenu = zastita($nazivMenu);
			$linkMenu = zastita($linkMenu);

			if (strlen($nazivMenu) < 30 && strlen($linkMenu) < 50) {
				$upitIzmenaMeni = "update meni set link='".$linkMenu."', naziv_meni='".$nazivMenu."', pozicija=$pozicija where id_meni=$idMenu;";
				$rezPromenaMeni = izvrsiUpitBrisanjeUpdateUpis($upitIzmenaMeni,$kon);
				if ($rezPromenaMeni) {
					echo "Uspesno ste izmenili meni";
				}
				else{
					echo "Meni nije izmenjen";
				}
			}
			else {
				echo "Prevelik broj karaktera";
			}
		}
		else if (isset($_POST['btnUpisi'])) {
			$nazivM = $_POST['tbNazivMeni'];
			$link = $_POST['tbLink'];
			$pozicijaM = $_POST['tbPozicija'];
			$nazivM = zastita($nazivM);
			$link = zastita($link);

			if (strlen($nazivM) < 30 && strlen($link) < 50) {
				$upitUnosMeni = "insert into meni values('','$link','$nazivM',$pozicijaM);";
				$rezUpis = izvrsiUpitBrisanjeUpdateUpis($upitUnosMeni,$kon);
				if ($rezUpis) {
					echo "Uspesno ste uneli meni";
				}
				else{
					echo "Meni nije unet";
				}
			}
			else {
				echo "Prevelik broj karaktera";
			}		
		}
	?>
	<form method='POST' action='' name='formaIzmena'>
		<table>
			<tr>
				<td>Naziv menija</td>
				<td>Link</td>
				<td>Pozicija</td>
				<td>Izmeni</td>
			</tr>
			<?php
				$meni = prikaz($kon,"meni");
				foreach ($meni as $m) {
					echo "<tr><td>".stripslashes($m['naziv_meni'])."</td><td>".stripslashes($m['link'])."</td><td>".$m['pozicija']."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' onclick='promenaMeni(".$m['id_meni'].");'/></td></tr>";
				}
			?>
		</table>
	</form>
</div>
<div id='izmena'>
	<form action="" method="POST" name="formaPromeni">
		<table>
			<tr>
				<td><label class='labela' for='tbNazivMeni'>Naziv meni</label></td>
				<td><input type='text' class='tbText' id='tbNazivMeni' name='tbNazivMeni' onblur="ispisiLink();" /></td>
			</tr>
			<tr>
				<td><label for='tbLink' class='labela'>Link</label></td>
				<td>
					<input type='text' class='tbText' name='tbLink' id='tbLink' />
					<input type="hidden" name="sakriveniIdMeni" id="sakriveniIdMeni" value=""/>
				</td>
			</tr>
			<tr>
				<td><label for="tbPozicija" class="labela">Pozicija</label></td>
				<td><input type="text" name="tbPozicija" id="tbPozicija"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnIzmeni' value='Izmeni'/><input type='submit' class="dugmePanel" name='btnUpisi' value='Upisi'/></td>
			</tr>
		</table>
	</form>
</div>
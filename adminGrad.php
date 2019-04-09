<div id='prikaz'>
	<?php
		if(isset($_POST['btnIzmeni'])){
			$nazivGrad = $_POST['tbImeGrada'];
			$posbr = $_POST['tbPosBr'];
			$idGrad = $_POST['sakriveniIdGrad'];
			$nazivGrad = zastita($nazivGrad);

			if (strlen($nazivGrad) < 30 && isset($posbr)) {
				$upitIzmenaGrad = "update grad set ime_grad='".$nazivGrad."', pos_br='".$posbr."' where id_grad=$idGrad;";
				$rezPromenaGrad = izvrsiUpitBrisanjeUpdateUpis($upitIzmenaGrad,$kon);
				if ($rezPromenaGrad) {
					echo "Uspesno ste izmenili podatke za grad";
				}
				else{
					echo "Podaci za grad nisu izmenjeni";
				}
			}
			else {
				echo "Prevelik broj karaktera ili niste uneli postanski broj";
			}
		}
		else if (isset($_POST['btnUpisi'])) {
			$imeGrad = $_POST['tbImeGrada'];
			$PosBr = $_POST['tbPosBr'];
			$imeGrad = zastita($imeGrad);

			if (strlen($imeGrad) < 30 && isset($PosBr)) {
				$upitUnosGrad = "insert into grad values('','$imeGrad',$PosBr);";
				$rezUpisGrad = izvrsiUpitBrisanjeUpdateUpis($upitUnosGrad,$kon);
				if ($rezUpisGrad) {
					echo "Uspesno ste uneli grad";
				}
				else{
					echo "Grad nije unet";
				}
			}
			else {
				echo "Prevelik broj karaktera ili niste uneli postanski broj";
			}		
		}
	?>
	<form method='POST' action='' name='formaIzmena'>
		<table>
			<tr>
				<td>Grad</td>
				<td>Postanski broj</td>
				<td>Izmeni</td>
			</tr>
			<?php
				$gradovi = prikaz($kon,"grad");
				foreach ($gradovi as $g) {
					echo "<tr><td>".stripslashes($g['ime_grad'])."</td><td>".stripslashes($g['pos_br'])."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' onclick='promenaGrad(".$g['id_grad'].");'/></td></tr>";
				}
			?>
		</table>
	</form>
</div>
<div id='izmena'>
	<form action="" method="POST" name="formaPromeni">
		<table>
			<tr>
				<td><label class='labela' for='tbImeGrada'>Ime grada</label></td>
				<td><input type='text' class='tbText' id='tbImeGrada' name='tbImeGrada' /></td>
			</tr>
			<tr>
				<td><label for='tbPosBr' class='labela'>Postanski broj</label></td>
				<td>
					<input type='text' class='tbText' name='tbPosBr' id='tbPosBr' />
					<input type="hidden" name="sakriveniIdGrad" id="sakriveniIdGrad" value=""/>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type='submit' class="dugmePanel" name='btnIzmeni' value='Izmeni'/><input type='submit' class="dugmePanel" name='btnUpisi' value='Upisi'/></td>
			</tr>
		</table>
	</form>
</div>
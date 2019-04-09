<div id="galerija">
	<?php
	if (isset($_GET['x']) && $_GET['x'] == 5) {	
		include("konekcija.inc");
		$galerija = prikaz($kon,'slika');
		foreach ($galerija as $g) {
			echo "<div class='slika'>";
			echo "<a href='".$g['putanjaV']."'><img src='".$g['putanjaM']."' alt='".$g['alt']."' /></a>";
			echo "</div>";
		}
	}
	?>
</div>
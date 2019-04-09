<?php
	include("konekcija.inc");
?>
<div id="meniAdmin">
	<div id="sadrzajAdminMeni">
		<ul>
			<li><a href="index.php?a=1">Unos i izmena</a></li>
			<li><a href="index.php?a=2">Brisanje</a></li>
		</ul>
	</div>	
</div>
<div id="panelSadrzaj">
	<div id="levo">
		<div id="podmeni">
			<h3>Admin panel</h3>
			<hr/>
			<ul>
				<?php
					if (isset($_GET['a']) && $_GET['a'] == 1) {
						$a = $_GET['a'];
						echo "<li><a href='index.php?a=".$a."&y=1'>Meni</a></li>
						<li><a href='index.php?a=".$a."&y=2'>Korisnici</a></li>
						<li><a href='index.php?a=".$a."&y=3'>Modeli i proizvodjaci</a></li>
						<li><a href='index.php?a=".$a."&y=4'>Anketa</a></li>
						<li><a href='index.php?a=".$a."&y=5'>Gradovi</a></li>
						<li><a href='index.php?a=".$a."&y=6'>Slike modela</a></li>
						<li><a href='index.php?a=".$a."&y=7'>Uloge korisnika</a></li>";
					}
					else if (isset($_GET['a']) && $_GET['a'] == 2) {
						$a = $_GET['a'];
						echo "<li><a href='index.php?a=".$a."&b=1'>Meni</a></li>
						<li><a href='index.php?a=".$a."&b=2'>Korisnici</a></li>
						<li><a href='index.php?a=".$a."&b=3'>Modeli i proizvodjaci</a></li>
						<li><a href='index.php?a=".$a."&b=4'>Anketa</a></li>
						<li><a href='index.php?a=".$a."&b=5'>Gradovi</a></li>
						<li><a href='index.php?a=".$a."&b=6'>Slike modela</a></li>
						<li><a href='index.php?a=".$a."&b=7'>Uloge korisnika</a></li>";
					}
				?>
			</ul>
		</div>
	</div>
	<div id="desno">
		<?php
		if (isset($_GET['a']) && $_GET['a'] == 1 && isset($_GET['y']) && $_GET['y'] == 1) {
			include("adminMeni.php");
		}
		else if (isset($_GET['a']) && $_GET['a'] == 1 && isset($_GET['y']) && $_GET['y'] == 2) {
			include("adminKorisnici.php");
		}
		else if (isset($_GET['a']) && $_GET['a'] == 1 && isset($_GET['y']) && $_GET['y'] == 3) {
			include("adminModeliProizvodjaci.php");
		}
		else if (isset($_GET['a']) && $_GET['a'] == 1 && isset($_GET['y']) && $_GET['y'] == 4) {
			include("adminAnketa.php");
		}
		else if (isset($_GET['a']) && $_GET['a'] == 1 && isset($_GET['y']) && $_GET['y'] == 5) {
			include("adminGrad.php");			
		}
		else if (isset($_GET['a']) && $_GET['a'] == 1 && isset($_GET['y']) && $_GET['y'] == 6) {
			include("adminSlike.php");
		}
		else if(isset($_GET['a']) && $_GET['a'] == 1 && isset($_GET['y']) && $_GET['y'] == 7){
			include("adminUloge.php");
		}
		else if (isset($_GET['a']) && $_GET['a'] == 2) {
			include("adminBrisanje.php");
		}
		?>
	</div>
</div>
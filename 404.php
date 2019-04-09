<?php
	include("konekcija.inc");
	include("funkcije.inc");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<title>Mobilni telefoni | 404</title>
	<script type="text/javascript" src="js/skripta.js"></script>
	<script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="jquery.lightbox-0.5.css"/>
	<script type="text/javascript" src="lib/jquery.lightbox-0.5.min.js"></script>
	<script type="text/javascript" src="lib/jquery.scrollTo.js" charset="utf-8"></script>
	<!--<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>-->
	<link rel="stylesheet" type="text/css" href="css/stil.css"/>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnFinaPretraga').click(function(){
				var pretragaProizvodjaci = document.getElementById('ddlProizvodjaciPretraga').options[document.getElementById('ddlProizvodjaciPretraga').selectedIndex].value;
				var pretragaModeli = document.getElementById('ddlModeliPretraga').options[document.getElementById('ddlModeliPretraga').selectedIndex].value;
				var cenaOd = document.getElementById('tbCenaOd').value;
				var cenaDo = document.getElementById('tbCenaDo').value;

				$.ajax({
					type: 'POST',
					url: 'pretraga.php',
					data: {
						proizvodjac: pretragaProizvodjaci,
						model: pretragaModeli,
						cenaOd: cenaOd,
						cenaDo: cenaDo
					},
					success: function(dobijeniPodaci){
						$("#sadrzajKolonaPrikaz").html(dobijeniPodaci);
					}
				});
			});

			$('.btnNaruci').click(function(){
				var imeModel = $(this).attr("_naziv");
				var cenaModel = $(this).attr("_cena");

				var br = 0;

				var model = "<div class='model'><span id='nazivModel'>"+imeModel+"&nbsp;</span><span id='cena'>"+cenaModel+" &euro;</span></div>";

				$("#prikazKorpa").html($("#prikazKorpa").html()+ model);

				var total = 0;
 				var cenaU="";
 				$(".model #cena").each(function() {
 					var cenaSum = parseInt($(this).html());
					total += cenaSum;
					br++;
				});
				$("#futerKorpa #ukupnaCena").html(total+"&nbsp;&euro;");
				$("#korpa #brModelaUKorpi").html(br);
			});
			
			function slideShow() {
  				var trenutna = $('#slike .prikazana');
  				var sledeca = trenutna.next().length ? trenutna.next() : trenutna.parent().children(':first');
  
  				trenutna.hide().removeClass('prikazana');
  				sledeca.fadeIn().addClass('prikazana');
  
  				setTimeout(slideShow, 5000);
			}
			slideShow();

			$("#korpa").click(function(){
				$("#okvirKorpa").slideToggle('slow');
			});

 			$(".dugmePretraga").click(function(){
 				var podaci = $("#tbPretraga").serialize();
 				$.post("pretragaModel.php", podaci, function(podaci){
 					$("#sadrzajKolonaPrikaz").html(podaci);
 				});
 				return false;
 			});
		
		$(window).scroll(function(){
  			if ($(this).scrollTop() > 220) {
           		$('#vrh').fadeIn();
        	} else {
        	 	$('#vrh').fadeOut();
       		}
  		});

  			$('#vrh a[href=#]').click(function(){
    			$.scrollTo(0,'slow');
   				return false;
  			});
		});
	</script>
</head>
</head>
<body>
	<div id="meni">
		<?php 
			include("meni.php");
		?>
	</div>
	<div class="cisti"></div>
	<div id="zaglavlje">
		<div class="okvir">
			<div id="slike">
				<img src="slike/slajder/iphone7.jpg" alt="iphone7" class="prikazana" />
				<img src="slike/slajder/samsunggalaxynote7.jpg" alt="samsung galaxy note7" />
				<img src="slike/slajder/samsungj5.jpg" alt="samsung j5" />
				<img src="slike/slajder/samsungs7edge.jpg" alt="samsung s7 edge" />
				<img src="slike/slajder/tesla.jpg" alt="tesla" />
				<img src="slike/slajder/tesla9.jpg" alt="tesla9" />
			</div>
			<div id="snizenje">
				<img src="slike/slajder/snizenje-20.png" alt="snizenje 20 %"/>
			</div>
		</div>
	</div>
	<div class="cisti"></div>
	<div id="sadrzaj"><?php
			if (isset($_SESSION['naziv_uloga']) && $_SESSION['naziv_uloga']== "Administrator") {
				include("admin.php");
			}
			else{
		?>
		<div class="sadrzajRed">
			<div class="sadrzajKolona">
				<div id="blokPretraga">
					<h3>Pretraga</h3>
					<form action="" method="" name="finaPretraga" id="finaPretraga">
						<h5>Proizvodjaci</h5>
						<hr/>
						<select name="ddlProizvodjaciPretraga" id="ddlProizvodjaciPretraga">
							<option value="0">Izaberite</option>
						<?php
							$rezProizvodjaci =prikaz($kon,'proizvodjac');
							foreach($rezProizvodjaci as $rezProizvodjac){
								echo "<option value='".$rezProizvodjac['id_proizvodjac']."'>".$rezProizvodjac['naziv_proizvodjac']."</option>";
							}
						?>
						</select>
						<hr/>
						<h5>Modeli</h5>
						<hr/>
						<select name="ddlModeliPretraga" id="ddlModeliPretraga">
							<option value="0">Izaberite</option>
						<?php
							$rezModeli = prikaz($kon,'model');
							foreach($rezModeli as $rezModel){
								echo "<option value='".$rezModel['id_model']."'>".$rezModel['naziv_model']."</option>";
							}
						?>
						</select>
						<hr/>
						<h5>Cena</h5>
						<hr/>
						<h6>Od</h6><input type="text" name="tbCenaOd" id="tbCenaOd" onblur="proveraCenaOd();" /><br/>
						<h6>Do</h6><input type="text" name="tbCenaDo" id="tbCenaDo" onblur="proveraCenaDo();"/>
						<hr/>
						<input type="button" id="btnFinaPretraga" name="btnFinaPretraga" value="Pretraga"/>
					</form>
				</div>
			</div>
			<div class="sadrzajKolona" id="sadrzajKolonaPrikaz">
				<h2>Zao nam je. Vratite se na <a href="index.php">pocentu stranu</a>.</h2>
			</div>
		</div>
		<div class="cisti"></div>
		<div class="sadrzajRed">
			<div class="sadrzajKolona">
				<h3>Anketa</h3>
				<hr/>
				<span id="glas"></span>
				<?php
					$upitPitanje = "select * from anketa where aktivna=1;";
					$rezPitanje = izvrsiUpitPrikaz($upitPitanje,$kon);
					if (gettype($rezPitanje) != "array") {
						while ($nizAnketa = mysql_fetch_array($rezPitanje)) {
							echo "<div class='anketa'>";
							echo "<form action='' method='POST' name='formaAnketa".$nizAnketa['id_anketa']."'>";
							echo "<h4>".$nizAnketa['pitanje']."</h4><br/>";
							$upitZaodg ="select * from odgovori o inner join anketa a on a.id_anketa=o.id_anketa where a.aktivna=1;";
							$rezPrikazOdg = izvrsiUpitPrikaz($upitZaodg,$kon);
							if (gettype($rezPrikazOdg) != "array") {
								while ($redOdg = mysql_fetch_array($rezPrikazOdg)) {
									if ($redOdg['id_anketa'] == $nizAnketa['id_anketa']) {
										echo "<input type='radio' name='rbAnketa' id='".$redOdg['id_odgovor']."' value='".$redOdg['id_odgovor']."'/>".stripslashes($redOdg['odgovor'])."<br/>";
									}									
								}
							}
							echo "<input type='hidden' value='".$nizAnketa['id_anketa']."' id='anketaSakriveno' name='anketaSakriveno'/><br/><input type='button' onclick='anketa();' name='btnGlasaj' class='dugmeAnketa' value='Glasaj' /><input type='reset' name='btnReset' class='dugmeAnketa' value='Ponisti'/>";
							echo "</form></div>";
						}
					}
					else{
						echo "<p>Trenutno nema aktivnih anketa!</p>";
					}
				?>
			</div>
			<div class="sadrzajKolona">
				<h3>Rezultati anketa</h3>
				<hr/>
				<?php
					$upitRezAnketa = "select * from anketa where aktivna=1;";
					$rezRezultati = izvrsiUpitPrikaz($upitRezAnketa,$kon);
					if (gettype($rezRezultati) != "array") {
						while ($nizRez = mysql_fetch_array($rezRezultati)) {
							echo "<div class='rezultatAnkete'>";
							echo "<h4>".$nizRez['pitanje']."</h4>";
							$upitOdgovori = "select * from odgovori o inner join anketa a on a.id_anketa=o.id_anketa inner join rezultat r on o.id_odgovor=r.id_odgovor where a.aktivna=1;";
							$rezOdgovor = izvrsiUpitPrikaz($upitOdgovori,$kon);
							if (gettype($rezOdgovor) != "array") {
								while ($nizOdg = mysql_fetch_array($rezOdgovor)) {
									if ($nizRez['id_anketa'] == $nizOdg['id_anketa']){
										echo "<p>".$nizOdg['odgovor'].": ".$nizOdg['rezultat']." glasova</p>";
									}
								}
							}
							echo "</div>";
						}
					}
					else{
						echo "<p>Trenutno nema aktivnih anketa!</p>";
					}
				?>
			</div>
		</div>
		<?php
			}
		?>
	</div>
	<div class="cisti"></div>
	<div id="futer">
		<?php
			include("futer.php");
		?>
	</div>
	<div id="vrh">
		<a href="#">
			<img src="slike/ikonice/up.png" alt="vrati se na vrh" />
		</a>
	</div>
	<script type="text/javascript">
		$(function() {
   			$('#slikaArtikli .slika a').lightBox();
		});
		$(function() {
   			$('#slikeModela .malaSlika a').lightBox();
		});
	</script>
</body>
</html>
<?php
	include("zatvori.inc");
?>
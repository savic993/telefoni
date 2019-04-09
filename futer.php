<div class="okvir">
	<div class="red">
		<div class="kolona">
			<h3>Linkovi</h3>
			<?php
				$upitLinkovi = "select * from meni order by pozicija asc;";
				$rezLinkovi = izvrsiUpitPrikaz($upitLinkovi,$kon);
				if (gettype($rezLinkovi) == "array") {
					foreach($rezLinkovi as $re){
						echo $re."<br/>";
					}
				}
				else{
					$broj = mysql_num_rows($rezLinkovi);
					$i=0;
					echo "<ul>";
					while ($redLink = mysql_fetch_array($rezLinkovi)) {
						if ($i < $broj) {
							echo "<li><a href='".$redLink['link'].$redLink['id_meni']."'>".$redLink['naziv_meni']."</a></li><hr/>";
						}else{
							echo "<li><a href='".$redLink['link'].$redLink['id_meni']."'>".$redLink['naziv_meni']."</a></li>";
						}
						$i++;							
					}
					echo "</ul>";
				}
			?>
		</div>
		<div class="kolona">
			<h3>O sajtu i autoru</h3>
			<ul>
				<li><a href="doc/dokumentacija.pdf" target="_blank">Dokumentacija</a></li>
				<li><a href="sitemap.xml">Mapa sajta</a></li>
				<li><a href="index.php?autor=1">O autoru</a></li>
			</ul>
		</div>
		<div class="kolona">
			<h3>Pratite nas:</h3>
			<a href="www.facebook.com" target="_blank">
				<img src="slike/ikonice/facebook.png" alt="facebook"/>
			</a>
			<a href="www.twitter.com" target="_blank">
				<img src="slike/ikonice/twitter.png" alt="twitter"/>
			</a>
		</div>
	</div>
	<div class="cisti"></div>
	<div class="red">
		<div class="kolona" id="prvaKolona">
			<b>&copy;WEB programiranje PHP1 2017 <br/> Nemanja Savic 21/12</b>
		</div>
		<div class="kolona">
			Sajt je uradjen u svrhu polaganja predispitivnih obaveza.
		</div>
	</div>
</div>
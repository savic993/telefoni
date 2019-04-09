<?php
	function ddl($tabela,$konekcija,$kolona1,$kolona2){
			if ($konekcija) {
				$upitDDL = "select * from $tabela";
				$rezDDL = mysql_query($upitDDL,$konekcija);
				while ($redDDL = mysql_fetch_array($rezDDL))
				{
					echo "<option value='".$redDDL["$kolona1"]."'>".$redDDL["$kolona2"]."</option>";
				}
			}
		}
	function izvrsiUpitBrisanjeUpdateUpis($upit,$konekcija){
		$error = array();
		$rez = mysql_query($upit,$konekcija) or die("Greska pri izvrsavanju upita za brisanje i update!".mysql_error());
		if (!$rez) {
			$error[] = "Zao nam je. Akcija nije uspesno izvrsena!";
			return $error;
		}
		else{
			return $rez;
		}
	}
	function izvrsiUpitPrikaz($u,$con){
		$err = array();
		$r = mysql_query($u,$con)or die("Greska pri izvrsavanju upita za ispis podataka!".mysql_error());
		if (mysql_num_rows($r) == 0) {
			$err[] = "Zao nam je. Trenutno nema podataka po zadatim kriterijumima.";
			return $err;
		}
		else{
			return $r;
		}
	}
	function prikaz($conn,$ime_tabele){
    $nizPrikaz = array();
    if($conn){
        $upitPrikaz = "select * from $ime_tabele";
        $rezultat = mysql_query($upitPrikaz);
        while($red = mysql_fetch_array($rezultat)){
            $nizPrikaz[] = $red;
        }
    }
    return $nizPrikaz;
	}
	function zastita($prom){
		$p = trim($prom);
		$p = addslashes($prom);
		return $p;
	}
	function malaslika($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	if (preg_match('/jpg|jpeg/i',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/i',$system[1])){
		$src_img=imagecreatefrompng($name);
	}

	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y) {
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}

	$dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);


	if (preg_match("/png/i",$system[1])){
		imagepng($dst_img,$filename);
    } else {
	  	imagejpeg($dst_img,$filename);
	}
	imagedestroy($dst_img);
	imagedestroy($src_img);
}
?>
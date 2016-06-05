<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<Html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Wellness Team BH</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Stil.css">
<SCRIPT src="Izracunaj.js" type="text/javascript"></SCRIPT>
<SCRIPT src="provjeriDrzave.js" type="text/javascript"></SCRIPT>
<SCRIPT src="neprocitaniKomentari.js" type="text/javascript"></SCRIPT>
<script type="text/javascript">
function bodyOnLoad() {
  racunaj();
  <?php
  	session_start();
  	if(isset($_SESSION['username']))
  	{print "provjeriKomentare(\"".$_SESSION['username']."\");";}
  ?>
  }	
</script>
</head>
<body onload="bodyOnLoad();">
<?php



	if(isset($_REQUEST['Odjava']))
	{
		session_unset();
	}
	if(isset($_SESSION['username']))
	{
		print "<p class=\"natpis\"> Uspjesno ste logirani! </p>";
	}
	else
	{
		print "<a class=\"natpi\" href =\"Login.php\">Logirajte se!</a>";
	}


if(isset($_REQUEST['promijeniSifru']))
{
	print "<form action=\"Main.php\" method=\"post\">
		 <p> 
		 Novi password:
		 </p>
		<input type=\"text\" name=\"sifraN\"  required>	
		<p>
		Potvrdi password:
		</p>
		<input type=\"text\" name=\"PotvrdaN\" required>
			
	   <input type=\"submit\" name=\"Mijenjaj\" value=\"Promijeni\">
	   </form>";
}
if(isset($_SESSION['username']))
	{
		if($_SESSION['username']!="administrator")
		{
			print "<form action=\"Main.php\" method=\"post\">
			<input type=\"submit\" name=\"promijeniSifru\" value=\"Promijeni sifru\">
			</form>
			";
		}
	}
?>

<div id="forma1">
<?php
		if(isset($_REQUEST['Odjava']))
	{
		session_unset();
	}
	if(isset($_REQUEST['Korisnikci']))
	{

	}
	if(isset($_SESSION['username']))
	{
		print "<form id=\"izgen\"action=\"Main.php\" method=\"get\">
		<input type=\"submit\" class=\"Odjava\" name=\"Odjava\" value=\"Odjava\">";
		if($_SESSION['username']=="administrator")
		{
			print "<a class=\"natpi\" href =\"Autori.php\">Autori</a>";
		}
	}

?>
</div>
<div id="zaglavlje">
<h1 id="imeklub">Wellness Nutrition Club-Fit &amp Sit</h1>
</div>
<div id="slike">
<img class="prva" alt="LOGO" src="kolaz.jpg">
</div>
<div id="meni">
	<ul class="menilista">
		<li id="Pocetna"><a class="linkmeni" href="Main.php" >Početna</a></li>
		<li id="Zdrava"><a href="Linkovi.html" class="linkmeni">Zdrava ishrana</a></li>
		<li id="Sport"><a href="Tabela.html" class="linkmeni">Sport i rekreacija</a></li>
		<li id="Kontakt"><a href="Forma.html" class="linkmeni">Kontakt</a></li>
	</ul>
</div>

<div id="kontrole">
<ul class="kontlist">
<li id="Danas" onclick="prikazi(1)">Danas</li>
<li id="Sedmica" onclick="prikazi(2)">Sedmica</li>
<li id="Mjesec" onclick="prikazi(3)">Mjesec</li>
<li id="Starije" onclick="prikazi(4)">Sve novosti</li>
<li id="SortirajPoDat"><form class="Dugmad" action="Main.php" method="post"><input id="Datumski" type="submit" name="PoDatumu" value="Sortiraj po datumu"></form></li>
<li id="SortirajPoAbc"><form class="Dugmad" action="Main.php" method="post"><input id="Datumski" type="submit" name="PoAbc" value="Sortiraj po abecedi"></form></li>
<?php
 
	if(isset($_SESSION['username']))
	{
		print "<li id=\"MojeNovosti\"><form class=\"Dugmad\" action=\"Main.php\" method=\"post\"><input id=\"Datumski\" type=\"submit\" name=\"MojeNov\" value=\"MojeNovosti\"></form></li>";
	}	
?>
</ul>
</div>
<p id="Neprocitani"></p>
<?php
	
	 $veza = new PDO("mysql:dbname=wnclub_database;host=localhost;port=3306;charset=utf8","DBuser");
     $veza->exec("set names utf8");
     if(isset($_REQUEST['Mijenjaj']))
{
	$pass=md5($_REQUEST['sifraN']);
	$potvrda=md5($_REQUEST['PotvrdaN']);
	if($pass!=$potvrda)
	{
		print "Neispravna potvrda lozinke";
	}
	else{
		$upit=$veza->prepare("update autori set Password=? where Username=?");
		$upit->execute(array($pass, $_SESSION['username']));
	}
}
	if(isset($_REQUEST['Potvrdi']))
	{
		$naslov=htmlEntities($_REQUEST['Naslovi'], ENT_QUOTES);
		$tekst=htmlEntities($_REQUEST['NovostTxt'], ENT_QUOTES);
		$slike=htmlEntities($_REQUEST['pic'], ENT_QUOTES);
		$datum=getdate();
		$naslov=str_replace(",","&#44;",$naslov);
		$tekst=str_replace(",","&#44;",$tekst);
		//$datum=date ('D M j Y H:i:s');
		$datum=date ('D M j Y H:i:s',strtotime('+2 hours'))." GMT+0200";
		//$datum=$datum." GMT+0200";
		$rez=$veza->query("select ID from autori where Username='".$_SESSION['username']."'");
		foreach ($rez as $r) {
		$veza->exec("insert into novosti set Naslov='".$naslov."', NovostiTxt='".$tekst."', Slika='".$slike."',Otvoren='".$_REQUEST['Zakom']."', AutorID='".$r['ID']."'");
		}
		
	}
	if(isset($_SESSION['username']))
	{
		
		print "<div id=\"forma2\">
		<h1>Unesite novu vijest</h1>
		<form id=\"izgen\"action=\"Main.php\" method=\"post\">
		<label for=\"Naslovi\">Unesite naslov:</label>
		<input type=\"text\" id=\"Naslovi\" name=\"Naslovi\" required>
		<label for=\"NovostTxt\">Unesite vijest:</label>
		<textarea id=\"NovostTxt\" name=\"NovostTxt\" rows=\"20\" cols=\"50\" required></textarea>
		<input type=\"file\" id=\"pic\" name=\"pic\" accept=\"image/*\" required>
		<label for=\"Drzava\" >Unesite dvoslovni kod drzave:</label>
		<input type=\"text\" id=\"Drzava\" name=\"Drzava\" required onblur=\"provjeriBroj()\">
		<label for=\"Broj\">Unesite pozivni broj:</label>
		<input type=\"text\" id=\"Broj\" name=\"Broj\" required onblur=\"provjeriDrzave()\">
		<br>
		<p>Dozvoli komentare:</p>
		<input type=\"radio\" name=\"Zakom\" value=\"DA\" checked>DA
		<input type=\"radio\" name=\"Zakom\" value=\"NE\">NE
		<p id=\"Postavi\"><p>
		<br>
		<input type=\"submit\" id=\"Potvrdi\" name=\"Potvrdi\" value=\"Potvrdi\">
		</form>
		</div>";
	}
?>

<div id="glavni"> 

  <div id="sadrzajnovosti">
  <?php

  function my_sort($a,$b)
	{
		if($a!=null && $b!=null)
		{	
			$rijeci1=explode(',',$a);
			$rijeci2=explode(',',$b);
			$a=$rijeci1[0];
			$b=$rijeci2[0];	
		}
		if ($a==$b) {return 0;}
		return ($a<$b)?-1:1;
	}
	if(isset($_REQUEST['ObrisiNovost']))
	{
		$brojId=$_REQUEST['novost'];
		$upit=$veza->prepare("delete from novosti where NovostID=?");
		$upit->execute(array($brojId));
	}
	if(isset($_REQUEST['PotvrdiPromjenu']))
	{
		$brojId=$_REQUEST['novost'];
		$obv=$_REQUEST['Zakom'];
		$upit=$veza->prepare("update novosti set Otvoren=? where NovostID=?");
		$upit->execute(array($obv,$brojId));
	}
   $novosti=$veza->query("select * from novosti order by Vrijeme desc");
	
	if(isset($_REQUEST['PoDatumu']))
	{	
		$brojac=0;
				foreach($novosti as $vijest)
				{	
						$naslov=str_replace("&#44;",",",$vijest['Naslov']);
						$vijesti=str_replace("&#44;",",",$vijest['NovostiTxt']);
						$datum=$vijest['Vrijeme'];
						$slika=$vijest['Slika'];
						$dat=date("D M j Y H:i:s",strtotime($datum));
						$datum=$dat." GMT+0200";
						$autori=$veza->query("select a.Username from autori a where a.ID=".$vijest['AutorID']);
						foreach($autori as $aut)
					{
						print "<div class=\"novostiDiv\">
						<h1 class=\"NaslovNovosti\"><a href=\"Detalji.php?NaslovNovosti=$naslov\">".$naslov."</a></h1>
						<p class=\"datumobjave\">".$datum."</p>
						<p class=\"autorKomentar\">Autor teksta: ".$aut['Username']."</p>
						<p class=\"datumi\"></p>
						<p class=\"novosti\"> <img class=\"novostiSlike\" alt=\"LOGO\" src=".$slika.">".$vijesti."</p>
						</div>";

						if(isset($_SESSION['username']) && $_SESSION['username']=="administrator" )
						{
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"submit\" name=\"ObrisiNovost\" id=\"ObrisiNovost\" value=\"Obrisi\">
							</form>
							";
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"radio\" name=\"Zakom\" value=\"DA\" checked>DA
							<input type=\"radio\" name=\"Zakom\" value=\"NE\">NE
							<input type=\"submit\" name=\"PotvrdiPromjenu\" id=\"PotvrdiPromjenu\" value=\"Potvrdi\">
							</form>";

						}
					}
				}
	}
	else if(isset($_REQUEST['PoAbc']))
	{
		$novostiAbc=$veza->query("select * from novosti order by Naslov asc");
		$brojac=0;
		foreach($novostiAbc as $vijest)
				{	
						$naslov=str_replace("&#44;",",",$vijest['Naslov']);
						$vijesti=str_replace("&#44;",",",$vijest['NovostiTxt']);
						$datum=$vijest['Vrijeme'];
						$slika=$vijest['Slika'];
						$dat=date("D M j Y H:i:s",strtotime($datum));
						$datum=$dat." GMT+0200";
						$autori=$veza->query("select a.Username from autori a where a.ID=".$vijest['AutorID']);
						foreach($autori as $aut)
					{
						print "<div class=\"novostiDiv\">
						<h1 class=\"NaslovNovosti\"><a href=\"Detalji.php?NaslovNovosti=$naslov\">".$naslov."</a></h1>
						<p class=\"datumobjave\">".$datum."</p>
						<p class=\"autorKomentar\">Autor teksta: ".$aut['Username']."</p>
						<p class=\"datumi\"></p>
						<p class=\"novosti\"> <img class=\"novostiSlike\" alt=\"LOGO\" src=".$slika.">".$vijesti."</p>
						</div>";

						if(isset($_SESSION['username']) && $_SESSION['username']=="administrator")
						{
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"submit\" name=\"ObrisiNovost\" id=\"ObrisiNovost\" value=\"Obrisi\">
							</form>
							";
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"radio\" name=\"Zakom\" value=\"DA\" checked>DA
							<input type=\"radio\" name=\"Zakom\" value=\"NE\">NE
							<input type=\"submit\" name=\"PotvrdiPromjenu\" id=\"PotvrdiPromjenu\" value=\"Potvrdi\">
							</form>";

						}

					}

			
				}

	}
	else if(isset($_REQUEST['MojeNov']))
	{	
		$autori=$veza->query("select * from autori where Username=\"".$_SESSION['username']."\"");
		foreach ($autori as $autor) 
		{
		
			$mojeNovosti=$veza->query("select * from novosti where AutorID=\"".$autor['ID']."\"");

			foreach($mojeNovosti as $vijest)
			{
						$naslov=str_replace("&#44;",",",$vijest['Naslov']);

						$datum=$vijest['Vrijeme'];
						$slika=$vijest['Slika'];
						$dat=date("D M j Y H:i:s",strtotime($datum));
						$datum=$dat." GMT+0200";

						print "<div class=\"novostiDiv\">
						<h1 class=\"NaslovNovosti\"><a href=\"Detalji.php?NaslovNovosti=$naslov\">".$vijest['Naslov']."</a></h1>
						<p class=\"datumobjave\">".$datum."</p>
						<p class=\"autorKomentar\">Autor teksta: ".$autor['Username']."</p>
						<p class=\"datumi\"></p>
						<p class=\"novosti\"> <img class=\"novostiSlike\" alt=\"LOGO\" src=".$vijest['Slika'].">".$vijest['NovostiTxt']."</p>
						</div>";

						if(isset($_SESSION['username']) && $_SESSION['username']=="administrator")
						{
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"submit\" name=\"ObrisiNovost\" id=\"ObrisiNovost\" value=\"Obrisi\">
							</form>
							";
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"radio\" name=\"Zakom\" value=\"DA\" checked>DA
							<input type=\"radio\" name=\"Zakom\" value=\"NE\">NE
							<input type=\"submit\" name=\"PotvrdiPromjenu\" id=\"PotvrdiPromjenu\" value=\"Potvrdi\">
							</form>";

						}


			}

		}
		

	}
	else{
		foreach($novosti as $vijest)
		{	
					$naslov=str_replace("&#44;",",",$vijest['Naslov']);
					$vijesti=str_replace("&#44;",",",$vijest['NovostiTxt']);
					$datum=$vijest['Vrijeme'];
					$slika=$vijest['Slika'];
					$dat=date("D M j Y H:i:s",strtotime($datum));
					$datum=$dat." GMT+0200";
					$autori=$veza->query("select a.Username from autori a where a.ID=".$vijest['AutorID']);
					foreach($autori as $aut)
					{
						print "<div class=\"novostiDiv\">
						<h1 class=\"NaslovNovosti\"><a href=\"Detalji.php?NaslovNovosti=$naslov\">".$naslov."</a></h1>
						<p class=\"datumobjave\">".$datum."</p>
						<p class=\"autorKomentar\">Autor teksta: ".$aut['Username']."</p>
						<p class=\"datumi\"></p>
						<p class=\"novosti\"> <img class=\"novostiSlike\" alt=\"LOGO\" src=".$slika.">".$vijesti."</p>
						</div>";
		
						if(isset($_SESSION['username']) && $_SESSION['username']=="administrator")
						{
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"submit\" name=\"ObrisiNovost\" id=\"ObrisiNovost\" value=\"Obrisi\">
							</form>
							";
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$vijest['NovostID']."\">
							<input type=\"radio\" name=\"Zakom\" value=\"DA\" checked>DA
							<input type=\"radio\" name=\"Zakom\" value=\"NE\">NE
							<input type=\"submit\" name=\"PotvrdiPromjenu\" id=\"PotvrdiPromjenu\" value=\"Potvrdi\">
							</form>";

						}	
					}

		}
	}

?>

</div>
</div>

<div id="desnog">
<h1 id="des">Savjet mjeseca</h1>
<p>Najmanje dvije litre vode na dan recept je za zdravlje i ljepotu. Stručnjaci nas gotovo svakodnevno upozoravaju na to da ne zaboravimo popiti svojih osam čaša vode na dan, a ako se bavimo tjelesnom aktivnošću, čak i više. Voda čisti organizam iznutra, ali čini i našu kožu i kosu elastičnijom i ljepšom. Dehidracija može biti okidač za mnoge ozbiljne zdravstvene probleme.</p>
</div>

</body>
</Html>
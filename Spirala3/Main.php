<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<Html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Wellness Team BH</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Stil.css">
<SCRIPT src="Izracunaj.js" type="text/javascript"></SCRIPT>
<SCRIPT src="provjeriDrzave.js" type="text/javascript"></SCRIPT>
</head>
<body onload="racunaj()">
<?php
session_start();


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
?>
<div id="forma1">
<?php
		if(isset($_REQUEST['Odjava']))
	{
		session_unset();
	}
	if(isset($_SESSION['username']))
	{
		print "<form id=\"izgen\"action=\"Main.php\" method=\"get\">
		<input type=\"submit\" id=\"Odjava\" name=\"Odjava\" value=\"Odjava\">";
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
</ul>
</div>

<?php

	if(isset($_REQUEST['Potvrdi']))
	{
		$naslov=htmlEntities($_REQUEST['Naslovi'], ENT_QUOTES);
		$tekst=htmlEntities($_REQUEST['NovostTxt'], ENT_QUOTES);
		$slika=htmlEntities($_REQUEST['pic'], ENT_QUOTES);
		$datum=getdate();
		$naslov=str_replace(",","&#44;",$naslov);
		$tekst=str_replace(",","&#44;",$tekst);
		$datum=date ('D M j Y H:i:s')." GMT+0200";
		file_put_contents("vijesti.csv",$naslov.','.$tekst.','.$slika.','.$datum."%%%", FILE_APPEND);
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
	
    $redovi = file_get_contents("vijesti.csv");
	$novosti=explode('%%%',$redovi);
	array_splice($novosti, (sizeof($novosti)-1),1);
	
	if(isset($_REQUEST['PoDatumu']))
	{
		$novosti=array_reverse($novosti);
				foreach($novosti as $vijest)
				{	
					$celije=explode(',',$vijest);
					if(sizeof($celije)>=3)
					{
						$naslov=str_replace("&#44;",",",$celije[0]);
						$vijest=str_replace("&#44;",",",$celije[1]);
						$slika=$celije[2];
						$datum=$celije[3];
						print "<div class=\"novostiDiv\">
						<h1 class=\"NaslovNovosti\">".$naslov."</h1>
						<p class=\"datumobjave\">".$datum."</p>
						<p class=\"datumi\"></p>
						<p class=\"novosti\"> <img class=\"novostiSlike\" alt=\"LOGO\" src=".$slika.">".$vijest."</p>
						</div>";
			
					}

				}
	}
	else if(isset($_REQUEST['PoAbc']))
	{
		usort($novosti,"my_sort");

		foreach($novosti as $vijest)
				{	
					$celije=explode(',',$vijest);
					if(sizeof($celije)>=3)
					{
						$naslov=str_replace("&#44;",",",$celije[0]);
						$vijest=str_replace("&#44;",",",$celije[1]);
						$slika=$celije[2];
						$datum=$celije[3];
						print "<div class=\"novostiDiv\">
						<h1 class=\"NaslovNovosti\">".$naslov."</h1>
						<p class=\"datumobjave\">".$datum."</p>
						<p class=\"datumi\"></p>
						<p class=\"novosti\"> <img class=\"novostiSlike\" alt=\"LOGO\" src=".$slika.">".$vijest."</p>
						</div>";
			
					}

				}

	}
	else{
		$novosti=array_reverse($novosti);
		foreach($novosti as $vijest)
		{	
			$celije=explode(',',$vijest);
			if(sizeof($celije)>=3)
				{
					$naslov=str_replace("&#44;",",",$celije[0]);
					$vijest=str_replace("&#44;",",",$celije[1]);
					$slika=$celije[2];
					$datum=$celije[3];
					print "<div class=\"novostiDiv\">
					<h1 class=\"NaslovNovosti\">".$naslov."</h1>
					<p class=\"datumobjave\">".$datum."</p>
					<p class=\"datumi\"></p>
					<p class=\"novosti\"> <img class=\"novostiSlike\" alt=\"LOGO\" src=".$slika.">".$vijest."</p>
					</div>";
			
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
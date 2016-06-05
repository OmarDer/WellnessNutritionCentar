<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<Html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Wellness Team BH</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Stil.css">
<SCRIPT src="Izracunaj.js" type="text/javascript"></SCRIPT>
<SCRIPT src="IzracunajKomentare.js" type="text/javascript"></SCRIPT>
<SCRIPT src="provjeriDrzave.js" type="text/javascript"></SCRIPT>
<script type="text/javascript">
function bodyOnLoad() {
  racunaj();
  racunajKomentare();
}
</script>
</head>
<body onload="bodyOnLoad()">


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
	session_start();
	 $veza = new PDO("mysql:dbname=wnclub_database;host=localhost;port=3306;charset=utf8","DBuser");
     $veza->exec("set names utf8");

	if(isset($_REQUEST['Potvrdi']))
	{
		$naslov=htmlEntities($_REQUEST['Naslovi'], ENT_QUOTES);
		$tekst=htmlEntities($_REQUEST['NovostTxt'], ENT_QUOTES);
		$slike=htmlEntities($_REQUEST['pic'], ENT_QUOTES);
		$datum=getdate();
		$naslov=str_replace(",","&#44;",$naslov);
		$tekst=str_replace(",","&#44;",$tekst);
		$datum=date ('D M j Y H:i:s');
		//$datum->modify("+2 hours");
		$datum=$datum." GMT+0200";
		$rez=$veza->query("select ID from autori where Username='".$_SESSION['username']."'");
		foreach ($rez as $r) {
		$veza->exec("insert into novosti set Naslov='".$naslov."', NovostiTxt='".$tekst."', Slika='".$slike."',Otvoren='".$_REQUEST['Zakom']."', AutorID='".$r['ID']."'");
		var_dump($veza->errorInfo());
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
 
  $nesto;
if(isset($_GET['NaslovNovosti']))
{
	$nesto=$_GET['NaslovNovosti'];
   	

   	if(isset($_SESSION['username']))
   	{  	
   		$_SESSION['user']=$_SESSION['username'];
   		$_SESSION['NaslovNovosti']=$nesto;
   	}
   	else
   	{
   		$_SESSION['user']="Gost";
   		$_SESSION['NaslovNovosti']=$nesto;
   	}
}
else{
	$nesto=$_SESSION['NaslovNovosti'];   

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

if(isset ($_REQUEST['ObrisiKomentar']))
	{
		$idKom=$_REQUEST['kom'];
		$upit=$veza->prepare("delete from komentar where ID=?");
		$upit->execute(array($idKom));


	}

if(isset($_REQUEST['autorovaLista']))
{
	$lista=$veza->query("select * from novosti n left join autori a on n.AutorID=a.ID where a.Username=\"".$_REQUEST['autorovaLista']."\"");
	foreach($lista as $li)
	{
					$naslov=str_replace("&#44;",",",$li['Naslov']);
					$vijesti=str_replace("&#44;",",",$li['NovostiTxt']);
					$datum=$li['Vrijeme'];
					$slika=$li['Slika'];
					$dat=date("D M j Y H:i:s",strtotime($datum));
					$datum=$dat." GMT+0200";
					$autori=$veza->query("select a.Username from autori a where a.ID=".$li['AutorID']);
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
							<input type=\"hidden\" name=\"novost\" value=\"".$li['NovostID']."\">
							<input type=\"submit\" name=\"ObrisiNovost\" id=\"ObrisiNovost\" value=\"Obrisi\">
							</form>
							";
							print "<form action=\"Main.php\" method=\"post\">
							<input type=\"hidden\" name=\"novost\" value=\"".$li['NovostID']."\">
							<input type=\"radio\" name=\"Zakom\" value=\"DA\" checked>DA
							<input type=\"radio\" name=\"Zakom\" value=\"NE\">NE
							<input type=\"submit\" name=\"PotvrdiPromjenu\" id=\"PotvrdiPromjenu\" value=\"Potvrdi\">
							</form>";

						}
					}
	}
}
else{
$novosti=$veza->query("select * from novosti where Naslov='".$nesto."'");

  if(isset($_REQUEST['PotvrdiKom']))
  {	
  	$KomentarUbaci=htmlEntities($_REQUEST['komentar'], ENT_QUOTES);
  	$KomentarUbaci=str_replace(",","&#44;",$KomentarUbaci);
  	$rez=$veza->query("select * from autori where Username='".$_SESSION['user']."'");
  	
  	foreach ($novosti as $nov) {

  		if($rez->rowCount()==0)
  		{
  			$veza->exec("insert into komentar set KomentarTxt='".$KomentarUbaci."', IDNovost='".$nov['NovostID']."', Pogledan= '0' "); //Kada god gost napise komentar on se stavi na pogledan 0
  		}
  		else
  		{
  			foreach ($rez as $r) {
  					if($r['ID']==$nov['AutorID'])
  					{
  						$veza->exec("insert into komentar set KomentarTxt='".$KomentarUbaci."',IDAutor='".$r['ID']."', IDNovost='".$nov['NovostID']."', Pogledan=1");
  					}
  					else
  					{
  						$veza->exec("insert into komentar set KomentarTxt='".$KomentarUbaci."',IDAutor='".$r['ID']."', IDNovost='".$nov['NovostID']."', Pogledan=0");
  					}
  			}
  		}
  	}
  	$novosti->execute();
  }
  if(isset($_REQUEST['Odgovor'])) //Odgovor na komentar!
  {
  	$OdgovorKomentar=htmlEntities($_REQUEST['odgkomentar'], ENT_QUOTES);
  	$OdgovorKomentar=str_replace(",","&#44;",$OdgovorKomentar);
  	$rez=$veza->query("select ID from autori where Username='".$_SESSION['user']."'");
  	foreach ($novosti as $nov) {

  		if($rez->rowCount()==0)
  		{
  			$veza->exec("insert into komentar set KomentarTxt='".$OdgovorKomentar."', IDNovost='".$nov['NovostID']."',IDkomentar='".$_REQUEST['red']."', Pogledan=0"); //Kada god gost napise komentar on se stavi na pogledan 0
  		}
  		else
  		{
  			foreach ($rez as $r) {
  					if($r['ID']==$nov['AutorID'])
  					{
  						$veza->exec("insert into komentar set KomentarTxt='".$OdgovorKomentar."',IDAutor='".$r['ID']."', IDNovost='".$nov['NovostID']."', Pogledan=1, IDkomentar='".$_REQUEST['red']."'");
  					}
  					else
  					{
  						$veza->exec("insert into komentar set KomentarTxt='".$OdgovorKomentar."',IDAutor='".$r['ID']."', IDNovost='".$nov['NovostID']."', Pogledan=0, IDkomentar='".$_REQUEST['red']."'");
  					}
  			}
  		}
  	}
  	$novosti->execute();
  }
  $Idnov=0;
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
						print "<form id=\"prikaziAutora\" action = \"Detalji.php\" method=\"post\">
							   <input type=\"submit\" name=\"autorovaLista\" id=\"autorovaLista\" value=".$aut['Username'].">
							   </form>";
						
						print "<div class=\"novostiDiv\">
						<h1 class=\"NaslovNovosti\">".$naslov."</h1>
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
						//Kada se vijest pogleda umanji komentare
						if($aut['Username']==$_SESSION['user'])
						{
							$kom=$veza->query("select k.* from komentar k left join novosti n ON k.IDNovost=n.NovostID where k.IDNovost=".$vijest['NovostID']);
							foreach($kom as $komcic)
							{
								$veza->exec("update komentar set Pogledan=1 where ID=".$komcic['ID']);
							}
						}
					}
					$Idnov = $vijest['NovostID'];

		}
		
	//Izvuci samo glavne komentare
	$komentari=$veza->query("select k.* from komentar k left join novosti n ON k.IDNovost=n.NovostID where k.IDNovost=".$Idnov." and k.IDKomentar is null");


$brojac=1;
foreach ($komentari as $komentar) {
			$koment=str_replace("&#44;",",",$komentar['KomentarTxt']);
			$datum=$komentar['Vrijeme'];
			$autor=$komentar['IDAutor'];
			$autori=$veza->query("select a.Username from autori a, komentar k where k.ID='".$komentar['ID']."' and a.ID=k.IDAutor");
			$brojac=$komentar['ID'];
			$aut;
			if($autori->rowCount()==0)
			{
				print "<div class=\"KomentariDiv\">
				<p class=\"autorKomentar\">Autor: Gost</p>";
			}
			else
			{
				foreach ($autori as $a) 
				{
					$aut=$a;
				}
			  print "<div class=\"KomentariDiv\">
			  <p class=\"autorKomentar\">Autor: ".$aut['Username']."</p>";
			}

			$dat=date("D M j Y H:i:s",strtotime($datum));
			$datum=$dat." GMT+0200";
			
			print "<p class=\"datumobjaveKom\"> ".$datum."</p>
			<p class=\"datumiKomentari\"></p>
			<p class=\"KomentarTxt\">".$koment."</p>
			<form class=\"DugmeKomentar\" action=\"Detalji.php\" method=\"post\">
			<input type=\"hidden\" name=\"red\" value=\"$brojac\" >";

			if(isset($_SESSION['username']) && $_SESSION['username']=="administrator")
			{
				print "<input type=\"hidden\" name=\"kom\" value=\"".$komentar['ID']."\">

				   <input type=\"submit\" name=\"ObrisiKomentar\" id=\"ObrisiKomentar\" value=\"Obrisi\">";
		    }
			//Izvuci odgovore na komentare
			$odgovoreniKomentari=$veza->query("select k2.* FROM komentar k1 left join komentar k2 on k1.ID=k2.IDKomentar WHERE k1.ID=k2.IDKomentar and k1.ID=".$komentar['ID']);
			foreach($odgovoreniKomentari as $odg)
			{
				$komentOdg=str_replace("&#44;",",",$odg['KomentarTxt']);
				$datumOdg=$odg['Vrijeme'];
				$autorOdg=$odg['IDAutor'];
				$autoriOdg=$veza->query("select a.Username from autori a, komentar k where k.ID='".$odg['ID']."' and a.ID=k.IDAutor");
				$autOdg;
			if($autoriOdg->rowCount()==0)
			{
				print "<p class=\"autorKomentar\">Autor: Gost</p>";
			}
			else
			{
				foreach ($autoriOdg as $a) 
				{
					$autOdg=$a;
				}
			  print "<p class=\"autorKomentar\">Autor: ".$autOdg['Username']."</p>";
			}

			$datOdg=date("D M j Y H:i:s",strtotime($datumOdg));
			$datumOdg=$datOdg." GMT+0200";
				print "<p class=\"datumobjaveKom\"> ".$datumOdg."</p>
				<p class=\"datumiKomentari\"></p>
				<p class=\"KomentarTxt\"> Re:".$komentOdg."</p>
				<form class=\"DugmeKomentar\" action=\"Detalji.php\" method=\"post\">
				<input type=\"hidden\" name=\"red\" value=\"$brojac\" >";
				
				if(isset($_SESSION['username']) && $_SESSION['username']=="administrator")
				{print "<input type=\"hidden\" name=\"kom\" value=\"".$odg['ID']."\">
				<input type=\"submit\" name=\"ObrisiKomentar\" id=\"ObrisiKomentar\" value=\"Obrisi\">";
				}		
					

			}
			
			//Izvuci odgovore na komentare
			if(isset($_REQUEST['Komodg']) && $_REQUEST['red']==$komentar['ID'])  //Ako je odgovor na komentar onda treba drugi button da se prikaze kako bi se moglo odgovoriti!!
			{
				print"<textarea id=\"odgkomentar\" name=\"odgkomentar\" rows=\"10\" cols=\"30\" required></textarea>
				      <input type=\"submit\" id=\"Odgovor\" name=\"Odgovor\" value=\"Odgovori\">
				      </form>";
			}
			else{
			print"<input type=\"submit\" id=\"Komodg\" name=\"Komodg\" value=\"Odgovori\">
			</form>";
			}

			print "</form>";

           

			print"</div>
			";
		}
$novosti->execute();
foreach($novosti as $nov)
{
	if($nov['Otvoren']=="DA")
	{
		print "<form class=\"KomentarForma\" action=\"Detalji.php\" method=\"post\">
		<label for=\"komentar\"> Unesite komentar:</label>
		<textarea id=\"komentar\" name=\"komentar\" rows=\"10\" cols=\"30\" required></textarea>
		<br>
		<input type=\"submit\" id=\"PotvrdiKom\" name=\"PotvrdiKom\" value=\"Ostavi komentar\">
		</form>";
	}
}

}
?>

  
</div>
</div>

</body>
</Html>
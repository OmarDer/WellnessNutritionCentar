<!DOCTYPE html>
<Html>
<head>
<meta charset="UTF-8">
<title>Wellness Team BH-Login</title>
<link rel="stylesheet" type="text/css" href="Login.css">
</head>
<body>

<div id="zaglavlje">
<h1 id="pocetni">WELLNESS NUTRITION CLUB</h1>
</div>
<?php 
$username;
session_start();

	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		
	}
	else if (isset($_REQUEST['user']) && isset($_REQUEST['passw'])) {
		$redovi = file("sifra.csv");
		$red=$redovi[0];
		$usr=htmlEntities($_REQUEST['user'], ENT_QUOTES);
		$pass=htmlEntities($_REQUEST['passw'], ENT_QUOTES);

		$celije=explode(',',$red);
		$sifra=md5($pass);
		if ($usr === $celije[0] && $sifra === $celije[1])
				{
					$username = $usr;
					$_SESSION['username'] = $username;
					print "<p class=\"poruka\">Uspjesan login!</p>";


				}
		else
				{
					print "<p class=\"poruka\">Pogreska prilikom logina!</p>";
				}

	}
	
?>
<div id="meni">
	<ul class="menilista">
		<li id="Pocetna"><a class="linkmeni" href="index.php" >Početna</a></li>
		<li id="Zdrava"><a href="Linkovi.html" class="linkmeni">Zdrava ishrana</a></li>
		<li id="Sport"><a href="Tabela.html" class="linkmeni">Sport i rekreacija</a></li>
		<li id="Kontakt"><a href="Forma.html" class="linkmeni">Kontakt</a></li>
	</ul>
</div>
<form action=Login.php method=post>
<h1 id="naslovforme">Forma za login</h1>
<label for="usernameTxt" id="Username">Username</label>
<br>
<input type="text" name='user' id="usernameTxt">
<br>
<label for="passwordTxt" id="pass">Password</label>
<br>
<input type="text" name='passw' id="passwordTxt" ><br>

<input type="submit" id="pritisni" value="Loguj se!">
</form>

</body>
</Html>
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


	$veza = new PDO("mysql:dbname=wnclub_database;host=localhost;port=3306;charset=utf8","DBuser");
    $veza->exec("set names utf8");
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		
	}
	else if (isset($_REQUEST['user']) && isset($_REQUEST['passw'])) {
		$upit=$veza->prepare("select * from autori where Username=? and Password=?");
		$usr=$_REQUEST['user'];
		$pass=md5($_REQUEST['passw']);
		$upit->execute(array($usr,$pass));
		foreach($upit as $u)
		{
			if ($usr === $u['Username'] && $pass === $u['Password'])
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
		

	}
	
?>
<div id="meni">
	<ul class="menilista">
		<li id="Pocetna"><a class="linkmeni" href="Main.php" >Početna</a></li>
		<li id="Zdrava"><a href="Linkovi.html" class="linkmeni">Zdrava ishrana</a></li>
		<li id="Sport"><a href="Tabela.html" class="linkmeni">Sport i rekreacija</a></li>
		<li id="Kontakt"><a href="Forma.html" class="linkmeni">Kontakt</a></li>
	</ul>
</div>
<form class="LoginForma" action=Login.php method=post>
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
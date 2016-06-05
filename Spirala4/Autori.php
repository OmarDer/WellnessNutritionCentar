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

	
?>
<div id="meni">
	<ul class="menilista">
		<li id="Pocetna"><a class="linkmeni" href="Main.php" >Početna</a></li>
		<li id="Zdrava"><a href="Linkovi.html" class="linkmeni">Zdrava ishrana</a></li>
		<li id="Sport"><a href="Tabela.html" class="linkmeni">Sport i rekreacija</a></li>
		<li id="Kontakt"><a href="Forma.html" class="linkmeni">Kontakt</a></li>
	</ul>
</div>
<?php
	define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
	define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
	define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
	define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
	define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
	$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
	$veza = new PDO($dsn, DB_USER, DB_PASS);
//$veza = new PDO("mysql:dbname=wnclub;host=127.4.179.2;port=3306;charset=utf8","DBuser");
$veza->exec("set names utf8");



if(isset($_REQUEST['del'])) //Obrisi korisnika
{
	$obrisani=$veza->exec("delete from autori where id =".$_REQUEST['red']);
}

if(isset($_REQUEST['pritisni']))
{
	$paswordKor=md5($_REQUEST['passw']);
	$korIme=$_REQUEST['user'];
	try{
	
	$broj=$veza->prepare("insert into autori set Username=? ,Password= ?");
	$broj->execute(array($korIme,$paswordKor));
	}
	catch(Exception $e)
	{
		print "Korisnik sa ovim imenom vec postoji!!";
	}
}
if(isset($_REQUEST['Mijenjaj'])) //ZaModifikaciju
{
	$Id=$_REQUEST['redN'];
	$passNOvi=md5($_REQUEST['sifraN']);
	$korIme=$_REQUEST['imeN'];
	$upit=$veza->prepare("update autori set Username=?, Password= ? where ID=?");
	$upit->execute(array($korIme,$passNOvi,$Id));

}
$autori=$veza->query("select * from autori where ID !=1");

if(isset($_REQUEST['edit'])) //Modificiraj
{
print "<form action=\"Autori.php\" method=\"post\">
		<p>
		Novi Username:
		</p>
         <input type=\"text\" name=\"imeN\"  required>
		 <p> 
		 Novi Password:
		 </p>
		<input type=\"text\" name=\"sifraN\"  required>
		
		<p>
		<input type=\"hidden\" name=\"redN\" value=\"".$_REQUEST['red']."\">
		
	   <input type=\"submit\" name=\"Mijenjaj\" value=\"Promijeni\">
	   </form>";
}


if($autori->rowCount()>0)
{
print "<table>";
print "<TR><TH>Username</TH><TH>Password</TH></TR>";
$brojac=0;
}
foreach($autori as $autor)
{
		$brojac=$autor['ID'];
		print "<TR>";
		print "</TR>";
		print "<td>".$autor['Username']."</td>";
		print "<td>".$autor['Password']."</td>";	
		print "<td> <form id=\"Autor\" action= \"Autori.php\" method=\"post\">
		<input type=\"hidden\" name=\"red\" value=\"".$brojac."\">
		<input type=\"submit\" name=\"edit\" value=\"E\">
      	<input type=\"submit\" name=\"del\" value=\"X\">
     	</form></td>";  
}
print "</table>"
?>
<form class="LoginForma" action="Autori.php" method="post">
<h1 id="naslovforme">Dodavanje korisnika</h1>
<label for="usernameTxt" id="Username">Username</label>
<br>
<input type="text" name='user' id="usernameTxt" required>
<br>
<label for="passwordTxt" id="pass">Password</label>
<br>
<input type="text" name='passw' id="passwordTxt" required><br>

<input type="submit" name="pritisni" id="pritisni" value="Registruj!">
</form>

</body>
</Html>
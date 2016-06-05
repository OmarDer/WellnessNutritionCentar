<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) {

$veza = new PDO("mysql:dbname=wnclub_database;host=localhost;port=3306;charset=utf8","DBuser");
$veza->exec("set names utf8");
$autor=$_GET['autor'];

$upit = $veza->prepare("SELECT n.* FROM novosti n left join autori a on n.AutorID=a.ID WHERE a.Username=?");
$upit->bindValue(1, $autor, PDO::PARAM_STR);
$upit->execute();
$novosti=$upit->fetchAll();
$broj=$_GET['brojnovosti'];


$niz=array();
$brojac=0;
foreach($novosti as $novost)
{
     array_push($niz,array('NovostID'=> $novost['NovostID'],
                  'Naslov' => $novost['Naslov'],
                  'NovostiTxt' => $novost['NovostiTxt'],
                  'Slika'=> $novost['Slika'],
                  'AutorID'=> $novost['AutorID'],
                  'Otvoren'=> $novost['Otvoren'],
                  'Vrijeme' => $novost['Vrijeme']));
               
    $brojac=$brojac+1;
    if($brojac==$broj)
    {
      break;
    }

}

print "{ \"Novosti\": " . json_encode($niz). "}";
return json_encode($niz); 
 
 }
function rest_post($request, $data) {}
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>
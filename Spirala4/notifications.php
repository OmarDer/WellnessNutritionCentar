<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) {

$veza = new PDO("mysql:dbname=wnclub_database;host=127.4.179.2;port=3306;charset=utf8","DBuser");
$veza->exec("set names utf8");
$autor=$_GET['autor'];
$upit = $veza->prepare("SELECT n.Naslov, k.* FROM komentar k join novosti n on k.IDNovost=n.NovostID join autori a on a.ID=n.AutorID WHERE a.Username=? and k.Pogledan=0 order by k.IDNovost Asc");
$upit->bindValue(1, $autor, PDO::PARAM_STR);
$upit->execute();
$novosti=$upit->fetchAll();


print  json_encode($novosti);
//return json_encode($novosti); 
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
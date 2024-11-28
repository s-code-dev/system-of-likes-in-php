<?php

define('HOST', 'localhost');
define('NAMEDB', 's');
define('NAME', '');
define('PASSWORD', '');


$pdo = new PDO('mysql:host='.HOST.';dbname='.NAMEDB, NAME, PASSWORD);
$pdo->exec('SET NAMES UTF8');


?>


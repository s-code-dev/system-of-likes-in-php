<?php

define('HOST', 'localhost');
define('NAMEDB', 'cy86747_likes');
define('NAME', 'cy86747_likes');
define('PASSWORD', 'Mypassword21388');


$pdo = new PDO('mysql:host='.HOST.';dbname='.NAMEDB, NAME, PASSWORD);
$pdo->exec('SET NAMES UTF8');


?>


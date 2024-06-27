<?php

include __DIR__ . '/db.php';
$aid = (int)$_GET['data'];
$ip = (string) $_SERVER['REMOTE_ADDR'];

$sqlId = "SELECT * FROM likes JOIN articles ON likes.aid = articles.id WHERE articles.id = ? AND likes.ip = ?";

$elem = $pdo->prepare($sqlId);
$elem->execute([$aid, $ip]);
$likeCount = $elem->fetch()['likes'];


if($likeCount ===  null){
        $queryIns = 'INSERT INTO likes (aid, ip, red) VALUES (?, ?, ?)';
        $elem = $pdo->prepare($queryIns);
        $elem->execute([$aid, $ip, 1]);
        $updateLike = 'UPDATE articles SET likes = likes + 1, red = 1 WHERE id = ? LIMIT 1';
        $el = $pdo->prepare($updateLike);
        $el->execute([$aid]);
        $like = getLike($aid, $pdo);
        $lenght = $like['likes'];
        // $red = $like['red'];
        echo $lenght;
        echo 1;
        
}elseif($likeCount !== NULL){
        $queryIns = 'DELETE FROM likes WHERE aid = ? AND ip = ?';
        $elem = $pdo->prepare($queryIns);
        $elem->execute([$aid, $ip]);
        $updateLike = 'UPDATE articles SET likes = likes - 1, red = 2   WHERE id = ? LIMIT 1';
        $el = $pdo->prepare($updateLike);
        $el->execute([$aid]);
        $like = getLike($aid, $pdo);
        $lenght = $like['likes'];
        echo $lenght;
        echo 2;
     
}
function getLike($aid, $pdo){
        $likes = 'SELECT * FROM articles WHERE id = ?';
        $lik = $pdo->prepare($likes);
        $lik->execute([$aid]);
        $likeMain = $lik->fetch();
        
        return $likeMain;
}

$sqlId = "SELECT * FROM `table` ";

$elem = $pdo->prepare($sqlId);
$elem->execute([$aid, $ip]);
$likeCount = $elem->fetchAll(PDO::FETCH_ASSOC)['likes'];


?>
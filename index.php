<?php

/**
 * Without explanation, your task is to figure it out on your own | Author code -s | j.wind@list.ru
 */

include __DIR__ . '/db.php';

$elem = $pdo->prepare('SELECT * FROM articles');
$ip = (string) $_SERVER['REMOTE_ADDR'];
$elem->execute([]);

$articles = $elem->fetchAll(\PDO::FETCH_ASSOC);

function getLikeRed($ip, $pdo, $id)
{
    $likes = 'SELECT * FROM likes WHERE ip = ? AND aid = ?';
    $lik = $pdo->prepare($likes);
    $lik->execute([$ip, $id]);
    $likeMain = $lik->fetch();

    return $likeMain['red'];
}

getLikeRed($ip, $pdo, 2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Система лайков на PHP</title>
</head>

<body>

    <?php foreach ($articles as $article): ?>

    <div class="block__main">
        <h2><?= $article['name'] ?></h2>
        <div><?= $article['description'] ?></span></div>
        <a class="link-<?= $article['id'] ?>" href="#" onclick="ajax(<?= $article['id'] ?>)"></a>
        <div class="count__like" id="<?= $article['id'] ?>"><?= $article['likes'] ?></div>
        <?php if (getLikeRed($ip, $pdo, $article['id']) == 1): ?>
        <script>
        let elem<?= $article['id'] ?> = document.querySelector(".link-<?= $article['id'] ?>");
        elem<?= $article['id'] ?>.classList.add('b');
        </script>
        <?php else: ?>
        <script>
        let elem<?= $article['id'] ?> = document.querySelector(".link-<?= $article['id'] ?>");
        elem<?= $article['id'] ?>.classList.remove('b');
        </script>
        <?php endif ?>
    </div>

    <?php endforeach; ?>

    <script>
    function ajax(user) {
        event.preventDefault();
        let elem = fetch(`/like.php?data=${user}`)
            .then((response) => {
                return response.text()
            })
            .then((data) => {

                let el = data.split('');
                // console.log(elem.splice(-1,1));
                let res = el.pop();

                if (+res === 1) {
                    document.getElementById(`${user}`).innerText = el.join('');
                    let elem = document.querySelector(`.link-${user}`);
                    elem.classList.add('b');

                }
                if (+res === 2) {
                    document.getElementById(`${user}`).innerText = el.join('');
                    let elem = document.querySelector(`.link-${user}`);
                    elem.classList.remove('b');

                };
            })

    }
    </script>

</body>

</html>
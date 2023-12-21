<?php

$user = "root";
$pass = "hiro0121";

//DBと接続
//pdoは設計図みたいなもの。詳しくは公式ドキュ
//tryは接続を開始してみる、うまくいかなかったら、catchにいく
try {
    $pdo = new PDO('mysql:host=localhost;dbname=2chan-bbs', $user, $pass);
    // echo "DBとの接続に成功しました";
} catch (PDOException $error) {
    echo $error->getMessage();
}


//
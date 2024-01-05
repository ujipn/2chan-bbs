<?php

$user = "root";
$pass = "";

//DBと接続
//pdoは設計図みたいなもの。詳しくは公式ドキュ
//tryは接続を開始してみる、うまくいかなかったら、catchにいく
try {
    $pdo = new PDO('mysql:host=localhost;dbname=comp_area', $user, $pass);
    // データベースへの接続成功
} catch (PDOException $error) {
    echo $error->getMessage();
}


//
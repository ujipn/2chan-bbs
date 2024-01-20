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


// ログインチェク処理 loginCheck()
function loginCheck()
{
    if (!isset($_SESSION['chk_ssid'])  ||  $_SESSION['chk_ssid']  !==  session_id()) {
        exit('LOGIN ERROR');
    } else {
        // ログイン済み処理
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

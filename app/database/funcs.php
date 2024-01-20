<?php
//必要なパッケージを自動で読み込むための記述
require __DIR__ . '/../../vendor/autoload.php';
//phpdotenvの機能を使って__DIR__=ファイルの存在する階層にある.envを指定する
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//.env中の設定値をロードし、$_ENVとして使用できるようにする
$dotenv->load();

try {
    $db_name = $_ENV['DB_NAME']; //データベース名
    $db_id   = $_ENV['DB_ID']; //アカウント名
    $db_pw   = $_ENV['DB_PASS']; //パスワード：MAMPは'root'
    $db_host = $_ENV['DB_HOST']; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
    // return $pdo;
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
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

<?php
session_start();
require_once('../database/funcs.php');
loginCheck();

$id = $_POST['comment_id'];
echo ($id);


// データ削除SQL作成
$stmt = $pdo->prepare('DELETE FROM comment WHERE id = :id;');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    // エラー処理関数を呼び出します（正しい変数名を使用してください）
    sql_error($stmt);
} else {
    // リダイレクト関数を呼び出します
    redirect('../../index.php');
}
?>

<?php
try {
    $db_name = 'bbs_test';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = '';      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
    // return $pdo;
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

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

<?php
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

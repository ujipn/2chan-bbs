<?php
session_start();
require_once('app/database/funcs.php');
loginCheck();

$id = $_GET['id']; //?id~**を受け取る
// $pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM retreat_locations WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/detail.css" />
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="index.php">topへ戻る</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->
    <form method="POST" action="update.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <div>
                    <label for="name">名前：</label>
                    <input type="text" id="name" name="name" value="<?= ($row['name']) ?>">
                </div>
                <div>
                    <label for="email">Email：</label>
                    <input type="text" id="email" name="email" value="<?= ($row['email']) ?>">
                </div>
                <div>
                    <label for="age">年齢：</label>
                    <input type="text" id="age" name="age" value="<?= ($row['age']) ?>">
                </div>
                <div>
                    <label for="content">内容：</label>
                    <textarea id="content" name="content" rows="4" cols="40"><?= ($row['content']) ?></textarea>
                </div>
                <?php
                if (!empty($row['image'])){
                echo'<img src="'.$row['image'].'">';
                }
                 ?>
                <div>
                    <input type="submit" value="更新">
                    <input type="hidden" name="id" value="<?= $id ?>">
                </div>
            </fieldset>
        </div>
    </form>
</body>
</html>

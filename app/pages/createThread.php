<?php //phpの読み込み開始

include_once("../database/funcs.php"); //データべ＾スと接続開始
include_once("../../app/functions/thread_add.php"); //データべ＾スと接続開始


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新たな合宿施設情報アップ</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <?php include("../parts/validation.php"); ?>

    <div style="padding-left:36px; color: blue;">
        <h2 style="margin-top:20px; margin-bottom:0;">新たな合宿施設情報アップ</h2>
    </div>
    <form method="POST">施設名
        <input type="text" name="title">
        <label>あなたの名前</label>
        <input type="text" name=username>

        <div>
            <textarea name="body" class="commenttextarea"></textarea>
        </div>
        <input type="submit" value="立ち上げ" name="threadSubmitButton">
    </form>




</body>

</html>
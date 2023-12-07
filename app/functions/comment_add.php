<?php
$error_message = array();

if (isset($_POST["submitButton"])) { //ボタンを推すと、まずデータがセット

    //お名前入力チェック
    if (empty($_POST["username"])) {
        $error_message["username"] = "お名前を入力してください。";
    } else {
        //エスケープ
        $escaped["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    }
    //コメント入力チェック
    if (empty($_POST["body"])) {
        $error_message["body"] = "コメントを入力してください。";
    } else {
        //エスケープ
        $escaped["body"] = htmlspecialchars($_POST["body"], ENT_QUOTES, "UTF-8");
    }

    if (empty($error_message)) { //エラーがないときだけ書き込める設計
        $post_date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`,`thread_id`)
         VALUES (:username, :body, :post_date,:thread_id);";
        $statement = $pdo->prepare($sql);

        //値をせっと
        $statement->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
        $statement->bindParam(":body", $escaped["body"], PDO::PARAM_STR);
        $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
        $statement->bindParam(":thread_id", $_POST["threadID"], PDO::PARAM_STR);

        $statement->execute();
    }
}
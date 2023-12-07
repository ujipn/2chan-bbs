<?php
$comment_array = array();

//コメントデータをテーブルから取って来る
$sql = "SELECT * FROM comment";
//効率的にデータを取得するためのprepare
$statement = $pdo->prepare($sql);
//executeは実行
$statement->execute();

$comment_array = $statement;

// var_dump($comment_array->fetchAll());
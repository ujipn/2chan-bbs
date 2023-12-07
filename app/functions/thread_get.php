<?php
$thread_array = array();

//コメントデータをテーブルから取って来る
$sql = "SELECT * FROM thread";
//効率的にデータを取得するためのprepare
$statement = $pdo->prepare($sql);
//executeは実行
$statement->execute();

$thread_array = $statement;



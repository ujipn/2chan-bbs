<?php

include("app/database/funcs.php"); // データベース接続スクリプトをインクルード

header('Content-Type: application/json'); // 出力をJSON形式に設定

// URLに 'area' が指定されているかをチェック
if (isset($_GET['area']) && !empty($_GET['area'])) {
    $area = $_GET['area'];
    // 地域に基づいてロケーションを選択するためのステートメントを準備
    $stmt = $pdo->prepare('SELECT * FROM retreat_locations WHERE area = :area');
    $stmt->execute(['area' => $area]);
} else {
    // 地域が指定されていない場合は、すべてのロケーションを選択
    $stmt = $pdo->query('SELECT * FROM retreat_locations');
}

// 結果を取得
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 結果をJSON形式で出力
echo json_encode($locations);

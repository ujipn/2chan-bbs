<?php

include("app/database/areaconnect.php"); // データベース接続スクリプトをインクルード

header('Content-Type: application/json'); // JSONとして出力することを明示

try {
    $stmt = $pdo->query('SELECT * FROM retreat_locations');
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($locations);
} catch (PDOException $error) {
    echo $error->getMessage();
}


<?php //phpの読み込み開始

include_once("./app/database/connect.php"); //データべ＾スと接続開始

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>合宿メモ</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header class="header">
        <p>日程、エリア（おすすめ）、予算、目的、人数（キャパ）</p>
        <p>自分で探す、専門家に頼む、AIに頼む、施設からの提案（ウチやったらこんなんできるでー）</p>
        <p>宿泊施設、移動手段、行程、食事、コンテンツ</p>
        <p>体験共有</p>
        <p>企画呼びかけ、カレンダー、企業協賛、企業合同合宿、合宿あいのり、企画へのコメント</p>
        <div class="search-form">
            <input type="text" id="location" placeholder="場所">
            <input type="date" id="check-in-date" placeholder="チェックイン">
            <input type="date" id="check-out-date" placeholder="チェックアウト">
            <input type="number" id="guests" placeholder="人数" min="1">
            <button id="search-button" type="submit">検索</button>
        </div>
    </header>
    <div id="myMap" style="width:60%;height:400px;margin:0 auto;"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function GetMap() {
            map = new Microsoft.Maps.Map('#myMap', {
                center: new Microsoft.Maps.Location(35.68944, 139.69167),
                zoom: 10
            });

            // Searchモジュールをロード
            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function() {
                // SearchManagerを初期化
                searchManager = new Microsoft.Maps.Search.SearchManager(map);
            });
        }

        function updateMap(location) {
            if (!searchManager) {
                alert("検索マネージャーが初期化されていません。");
                return;
            }

            // 検索リクエストを設定
            const searchRequest = {
                where: location,
                callback: function(r) {
                    if (r && r.results && r.results.length > 0) {
                        const firstResult = r.results[0];
                        const pin = new Microsoft.Maps.Pushpin(firstResult.location);
                        map.entities.push(pin);
                        map.setView({
                            center: firstResult.location,
                            zoom: 15
                        });
                    } else {
                        alert('場所が見つかりませんでした。');
                    }
                },
                errorCallback: function(e) {
                    alert('エラーが発生しました。');
                }
            };

            // 検索を実行
            searchManager.geocode(searchRequest);
        }

        document.getElementById('search-button').addEventListener('click', function() {
            const location = document.getElementById('location').value;
            updateMap(location);
        });

        window.onload = GetMap;
    </script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src='https://www.bing.com/api/maps/mapcontrol?key=AoHPWA9yjgEBfopraPJU8a_aGvHCDmt_T8X5swu1glCtisNV2dM-HZ5Go52J44rq&callback=GetMap' async defer></script>
    <script src="js/BmapQuery.js"></script>

    <?php include("app/parts/header.php"); ?>
    <?php include("app/parts/validation.php"); ?>
    <?php include("app/parts/thread.php"); ?>
    <?php include("app/parts/newThreadButton.php"); ?>

</body>

</html>
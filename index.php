<?php //phpの読み込み開始

include_once("./app/database/connect.php"); //データべ＾スと接続開始

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>合宿メモ</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header class="header">
        <h1>合宿を通じて->劇的進化しよう</h1>
        <p>企画呼びかけ、カレンダー、企業協賛、企業合同合宿、合宿あいのり、企画へのコメント</p>
        <hr>

        <h1 class="title">合宿を計画する</h1>
        <div class="choice">
            <button>自分で探す</button>
            <button>現地コーディネーターに依頼する</button>
            <button>AIに依頼する</button>
            <button>施設からの提案を待つ</button>
            <!-- データベースを呼び出す -->
        </div>
        <div class="search-form">
            <input type="text" id="location" placeholder="目的地を入力">
            <input type="date" id="check-in-date" placeholder="チェックイン">
            <input type="date" id="check-out-date" placeholder="チェックアウト">
            <input type="text" id="check-out-date" placeholder="目的を入力">
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

            // 追加
            loadRetreatLocations(); // 候補地をロードする関数を呼び出す
        }

        // 追加②
        function loadRetreatLocations() {
            $.ajax({
                url: 'http://localhost/2chan-bbs/get_locations.php', // PHPスクリプトのURL
                type: 'GET',
                dataType: 'json',
                success: function(locations) {
                    locations.forEach(function(location) {
                        addPinToMap(location);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error in retrieving locations: ", error);
                }
            });
        }

        function addPinToMap(location) {
            var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(location.latitude, location.longitude), {
                title: location.name, // 合宿地の名前
                text: 'G' // ピン上に表示するテキスト
            });

            // ピンのスタイルをカスタマイズ（例：色の変更）
            pin.setOptions({
                color: 'red'
            });
            map.entities.push(pin);
        }

        // 

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
    <script src='https://www.bing.com/api/maps/mapcontrol?key=AoHPWA9yjgEBfopraPJU8a_aGvHCDmt_T8X5swu1glCtisNV2dM-HZ5Go52J44rq&callback=GetMap' async defer></script>


    <!-- ここに比較一覧を表示 -->
    <div class="compArea">
        <h1>以下が有力候補です</h1>
    </div>
    <article>
        <div class="Wrapper">
            <div class="compArea">
                <span>候補①：信貴山玉蔵院</span>
            </div>
            <p class="">総費用</p>
            <p class="">宿泊費</p>
            <p class="">会議費</p>
            <p class="">交通機関</p>
            <p class="">上限人数</p>
            <p class="">食事有り</p>
        </div>
    </article>
    <div class="compPlan">
        <h1>以下がおすすめ行程です</h1>
    </div>
    <article>
        <div class="Wrapper">
            <div class="compPlan">
                <span>候補①：信貴山玉蔵院1泊2日プラン</span>
            </div>
            <p>【1日目】</p>
            <p class="">10:00 法隆寺駅到着</p>
            <p class="">10:30 住職のありがたいお言葉</p>
            <p class="">12:00 昼食</p>
            <p class="">13:00 移動</p>
            <p class="">14:00 信貴山玉蔵院到着</p>
            <p class="">15:00 チームビルディング</p>
            <p class="">19:00 夕食</p>
            <p class="">21:00 就寝</p>

            <p>【2日目】</p>
            <p class="">5:00 御祈祷</p>
            <p class="">6:30 朝食</p>
            <p class="">8:00 チームビルディング</p>
            <p class="">12:00 移動</p>
            <p class="">12:30 解散</p>


        </div>
    </article>
    <!-- ここまで -->

    <?php include("app/parts/header.php"); ?>
    <?php include("app/parts/validation.php"); ?>
    <?php include("app/parts/thread.php"); ?>
    <?php include("app/parts/newThreadButton.php"); ?>
    <?php include("app/parts/event.php"); ?>


</body>

</html>
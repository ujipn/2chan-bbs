<?php //phpの読み込み開始
require_once('app/database/funcs.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>合宿メモ</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css" rel="stylesheet">
</head>

<body>
    </head>

    <body>
        <div class="header">
            <div class="header-left">Spot-Retreat</div>
            <div class="header-right">
                <ul>
                    <li>候補検索</li>
                    <li>新着情報</li>
                    <li class="selected">お問い合わせ</li>
                </ul>
            </div>
        </div>
        <header class="header">
            <h1>合宿を通じて新しい自分を発見しましょう</h1>
            <ul>
                <li>煩わしい合宿の下準備</li>
                <li>合宿のコンテンツのクオリティアップ</li>
                <div class="choice">
                    <button>企業合宿</button>
                    <button>個人合宿</button>
                    <button>家族合宿</button>
            </ul>
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
            <h1 class="title">日程を決めましょう</h1>
            <form>
                <label for="start">出発日:</label>
                <input type="date" id="start" name="trip-start" value="2023-01-01" min="2023-01-01" max="2023-12-31">

                <label for="end">終了日:</label>
                <input type="date" id="end" name="trip-end" value="2023-01-02" min="2023-01-01" max="2023-12-31">

                <input type="submit">
            </form>
            <h1 class="title">予算はいくらですか？</h1>
            <div id="price-slider"></div>
            <p>
                価格範囲: <span id="price-lower"></span> - <span id="price-upper"></span>円
            </p>

            <script src="https://cdn.jsdelivr.net/npm/nouislider"></script>
            <script src="https://cdn.jsdelivr.net/npm/wnumb/wNumb.js"></script>

            <script>
                const slider = document.getElementById('price-slider');
                const lowerValue = document.getElementById('price-lower');
                const upperValue = document.getElementById('price-upper');
                document.addEventListener('DOMContentLoaded', function() {
                    noUiSlider.create(slider, {
                        start: [0, 100000], // スライダーの開始位置を最小値と最大値に設定
                        connect: true,
                        range: {
                            'min': 0,
                            'max': 100000
                        },
                        tooltips: wNumb({
                            decimals: 0 // 小数点以下を表示しない
                        }),
                        pips: {
                            mode: 'values',
                            values: [0, 25000, 50000, 75000, 100000],
                            density: 4,
                            format: wNumb({ // ピップスのフォーマットを整数に設定
                                decimals: 0,
                                thousand: ',',
                                suffix: '円'
                            })
                        }
                    });

                    slider.noUiSlider.on('update', function(values, handle) {
                        let value = values[handle];
                        // ツールチップの値から小数点以下を削除する
                        value = wNumb({
                            decimals: 0
                        }).to(Number(value));
                        if (handle) {
                            upperValue.innerHTML = value;
                        } else {
                            lowerValue.innerHTML = value;
                        }
                    });

                    // ページ読み込み時にスライダーの値を設定
                    slider.noUiSlider.set([10000, 100000]);
                });
            </script>
            <h1 class="title">場所を決めましょう</h1>
            <div class="search-form">
                <select id="location-dropdown">
                    <option value="">地域を選択してください</option>
                    <option value="nara">奈良</option>
                    <option value="tokyo">東京</option>
                    <!-- 必要に応じて他の地域を追加 -->
                </select>
                <button id="search-button" type="submit">検索</button>
            </div>
        </header>
        <div id="myMap" style="width:60%;height:400px;margin:0 auto;"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            function GetMap() {
                map = new Microsoft.Maps.Map('#myMap', {
                    center: new Microsoft.Maps.Location(34.684051, 135.8273687),
                    zoom: 10
                });

                // Searchモジュールをロード
                Microsoft.Maps.loadModule('Microsoft.Maps.Search', function() {
                    // SearchManagerを初期化
                    searchManager = new Microsoft.Maps.Search.SearchManager(map);
                });

            }

            // 追加②


            function loadRetreatLocations(area) {
                var url = 'http://localhost/kadai_test/get_locations.php';
                if (area) {
                    url += '?area=' + encodeURIComponent(area);
                }

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(locations) {
                        // マップのピンをクリア
                        map.entities.clear();

                        if (locations.length > 0) {
                            locations.forEach(function(location) {
                                addPinToMap(location);
                            });
                            createTable(locations); // ピンがある場合のみテーブルを作成する
                        } else {
                            // ピンがない場合はテーブルを空にする
                            $('#locationsTable').empty().append('<p>選択された地域の施設はありません。</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error in retrieving locations: ", error);
                        // エラーが発生した場合もテーブルを空にする
                        $('#locationsTable').empty().append('<p>データの取得中にエラーが発生しました。</p>');
                    }
                });
            }

            // マップ上のピンを追加する関数
            function addPinToMap(location) {
                var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(location.latitude, location.longitude), {
                    title: location.name, // 合宿地の名前
                    text: '☆' // ピン上に表示するテキスト
                });

                // ピンのスタイルをカスタマイズ（例：色の変更）
                pin.setOptions({
                    color: 'red'
                });
                map.entities.push(pin);
            }


            // テーブルを作成してHTMLに挿入する関数
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


            // 検索ボタンがクリックされた時のイベントハンドラ
            document.getElementById('search-button').addEventListener('click', function() {
                // ドロップダウンから選択された地域を取得
                var area = document.getElementById('location-dropdown').value;
                if (area) {
                    loadRetreatLocations(area);
                    updateMapCenter(area);
                } else {
                    alert('地域が選択されていません。');
                }
            });

            // 地図の中心を更新する関数
            function updateMapCenter(area) {

                // 選択された地域に応じてマップを移動させる
                var locations = {
                    'nara': {
                        lat: 34.685087,
                        lon: 135.805000,
                        zoom: 10
                    },
                    'tokyo': {
                        lat: 35.689487,
                        lon: 139.691706,
                        zoom: 10
                    },
                    // 他の地域についても同様に追加
                };

                if (locations[area]) {
                    map.setView({
                        center: new Microsoft.Maps.Location(locations[area].lat, locations[area].lon),
                        zoom: locations[area].zoom
                    });
                }
            };




            window.onload = GetMap;
        </script>
        <script src='https://www.bing.com/api/maps/mapcontrol?key=AoHPWA9yjgEBfopraPJU8a_aGvHCDmt_T8X5swu1glCtisNV2dM-HZ5Go52J44rq&callback=GetMap' async defer></script>

        <div id="locationsTable" class="locations-table">
            <!-- ここに表が挿入されます -->
        </div>
        <!-- table作成 -->
        <script>
            function createTable(locations) {
                // テーブルの作成
                const table = $('<table></table>').addClass('location-table');

                // テーブルのヘッダーを追加
                var thead = $('<thead></thead>');
                thead.append('<tr><th>施設名</th><th>住所</th><th>人数上限</th><th>会議室有無</th><th>宿泊可否</th><th>施設URL</th></tr>');
                table.append(thead);

                // テーブルのボディを追加
                var tbody = $('<tbody></tbody>');

                // 各ロケーションのデータで行を作成
                locations.forEach(function(location) {
                    var row = $('<tr></tr>');
                    row.append('<td><a href="detail.php?id=' + location.id + '">' + location.name + '</a></td>');
                    row.append('<td>' + location.address + '</td>');
                    row.append('<td>' + location.capacity + '</td>');
                    row.append('<td>' + location.conference + '</td>');
                    row.append('<td>' + location.stay + '</td>');

                    // URLをクリック可能なリンクとして挿入
                    var link = location.url ? '<a href="' + location.url + '" target="_blank">' + location.url + '</a>' : '';
                    row.append('<td>' + link + '</td>');

                    tbody.append(row);
                });

                table.append(tbody);

                // 作成したテーブルをHTMLに挿入
                $('#locationsTable').html(table);
            }
        </script>

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

        <!-- BBS開始 -->
        <header>
            <hr>
            <h1 class="title">新着合宿キロク</h1>
            <p>合宿に行った記録や口コミを残してみよう</p>
        </header>
        <?php include("app/parts/validation.php"); ?>
        <?php //phpの読み込み開始
        include_once("./app/database/funcs.php"); //データべースと接続開始
        include("app/functions/comment_add.php");
        include("app/functions/thread_get.php");
        ?>

        <?php foreach ($thread_array as $thread) : ?>
            <div class="threadWrapper">
                <div class="childWrapper">
                    <div class="threadTitle">
                        <span>【タイトル】</span>
                        <h1><?php echo $thread["title"] ?></h1>
                    </div>
                    <?php include("app/parts/commentSection.php"); ?>
                    <?php include("app/parts/commentForm.php"); ?>
                </div>
            </div>
        <?php endforeach ?>

        <?php include("app/parts/newThreadButton.php"); ?>
        <?php include("app/parts/event.php"); ?>


    </body>

</html>
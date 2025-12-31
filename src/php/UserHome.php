<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="../css/Home.css">
</head>
<body>
<div class="area">
<?php
//階数表示のためのループ
for ($i = 0; $i < 9 ;$i++) {
?>

<div id="floorNumArea" class="floorNumArea">
</div>

<div class="classRoomNumArea">
    <div class="classRoomNumArea2">
    <?php
    //教室数表示のためのループ
    for ($j = 0; $j < 9; $j++) {
        $classRoomNum = 100 + ($i + 1) * 10 + $j + 1;
    ?>

    <div id="room-<?php echo $classRoomNum;?>"class="">
    </div>
    <?php 
    if($j % 2 == 1){
    ?>
    </div><div class="classRoomNumArea2">
    <?php
    }
    }
    ?>
    </div>
</div>

<?php
}
?>
</div>
<script>
    //GASのWebアプリURL
    const GAS_URL = 'https://script.google.com/macros/s/AKfycbz0Oh8RQT_N6sl2Fx_-THKNYCf-n3jbc9h_wmLaJfQSYXotE0_Z8t1o1NljW6btak2Paw/exec?sheet=ClassInfo';

    //スプレッドシートからデータを取得
    async function loadData(){
        try{
            const roomNum = await fetch(GAS_URL);
            const data = await roomNum.json();
            console.log(data);
            data.sort(function(a,b){
                if(a.ClassName < b.ClassName) return -1;
                if(a.ClassName > b.ClassName) return 1;
            });
            console.log(data);

            var floor = 0;
            data.forEach(function(value){
                const btn = document.getElementById(`room-${value.ClassName}`);
                let classbox = value.ClassName;
                const floorbox = Math.floor((classbox - 100) / 10);
                const floordata = document.getElementById(`floorNumArea`);
                console.log(floorbox);
                if(!btn)return;
                if(floor != floorbox){
                    floor = floorbox;
                    console.log(floordata);
                    floordata.innerHTML = '<span name="floorNum-'+floor+'" class="floorNum">'+floor+'階</span>';
                }
                if(value.status === "true" ){
                    btn.classList.remove();
                    btn.classList.add("classRoomSafe");
                }else{
                    btn.classList.remove();
                    btn.classList.add("classRoomDanger");
                }
                btn.innerHTML = '<div class="classRoomName">'+value.ClassName+'教室</div>';
                console.log(btn);
            });
        }catch (e){
            console.error("データの取得に失敗しました:",e);

        }    
    }
    //ページ読み込み時実行
    loadData();
    </script>
</body>
</html>
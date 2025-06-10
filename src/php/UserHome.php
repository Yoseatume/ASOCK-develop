<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="../css/Home.css">
</head>
<body>
<div class="area">
<?php
//階数表示のためのループ
for ($i = 0; $i < 7 ;$i++) {
?>

<div class="floorNumArea">
    <span name="floorNum" class="floorNum"><?php echo $i + 1; ?>階</span>
</div>

<div class="classRoomNumArea">
    <?php
    //教室数表示のためのループ
    for ($j = 0; $j < 9; $j++) {
        $classRoomNum = 100 + ($i + 1) * 10 + $j + 1;
        //↓ここで鍵が開いているかを判定する予定
        if($j % 2 == 0){
    ?>
    <button class="classRoomSafe"><?php echo $classRoomNum; ?>教室</button>
    <?php }else{ ?>
    <button class="classRoomDanger"><?php echo $classRoomNum; ?>教室</button>
    <br />
    <?php 
    }
    }
    ?>
</div>

<?php
}
?>
</div>
</body>
</html>
<body>
<?php
?>
<div class="container">
    <div>
        <input type="text" class="form-control" id="sender" placeholder="sender">
        <input type="text" class="form-control" id="name" placeholder="name">
        <input type="text" class="form-control" id="isbn" placeholder="isbn">
        <input type="button" class="btn btn-primary" id="send" value="送信">
    </div>
</div>
<script>
$(function () {

    function guid() {
      function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
          .toString(16)
          .substring(1);
      }
      return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    }
// 「#execute」をクリックしたとき
$('#send').click(function () {
    console.log("いらっしゃってますでしょうか？");
    console.log(guid());
    // Ajax通信を開始する
    $.ajax({
        url: '<?php echo APIPATH;?>' + 'register',
        type: 'post',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({
            sender: $('#sender').val(),
            name: $('#name').val(),
            isbn: $('#isbn').val(),
            book_material_id: guid(),
        }),
    })
    .done(function (response) {
        alert("登録できたね超いいね！！！");
        window.location.href = '/home'; // 通常の遷移
    })
    .fail(function () {
        alert("失敗したよ！もっかい試してね！多分ジーノのせいだよ！");
        window.location.href = '/register'; // 通常の遷移
    });
});
});
</script>

</body>
</html>

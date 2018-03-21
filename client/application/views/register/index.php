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
        // url: 'http://35.229.217.28/register',
        url: 'http://localhost:5000/register',
        type: 'post',
        dataType: 'json',
        data: {
            sender: $('#sender').val(),
            name: $('#name').val(),
            isbn: $('#isbn').val(),
            book_material_id: guid(),
        },
    })
    .done(function (response) {
        console.log("success!!");
    })
    .fail(function () {
        console.log("failed!!");
        alert("failed!!");
    });
});
});
</script>

</body>
</html>

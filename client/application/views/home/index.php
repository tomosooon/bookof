<body>
<div class="container">
    <?php
        //if (isset($_SESSION['email'])) {
            //echo "your email address {$_SESSION['email']}";
        //}
    ?>
  <h2>本の一覧</h2>
  <div>
      <div>
          <input type="text" class="form-control" id="sender" placeholder="your email address">
      </div>
  </div>
  <?php for($i = 1; $i <= count($books); $i+=2) { ?>
    <div class = "row">
      <div class="col-sm-6">
          <p>
            <?php echo $books[$i-1]->isbn; ?>
          </p>
          <p>
            <?php echo $books[$i-1]->name; ?>
          </p>
          <input type="button" class="request btn btn-primary" value="Request！">

      </div>
      <div class="col-sm-6" >
          <p>
            <?php if ($i < count($books)) {echo $books[$i]->isbn; }?>
          </p>
          <p>
            <?php if ($i < count($books)) {echo $books[$i]->name; }?>
          </p>
          <input type="button" class="request btn btn-primary" value="Request！">
      </div>
    </div>
  <?php } ?>
</div>
<a href="http://localhost:8000/accept">accept 一覧</a>


<input id="isbn" value="9784088700113" type="hidden">


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
$('.request').click(function () {
    console.log("いらっしゃってますでしょうか？");
    console.log($('#isbn').val());
    console.log(guid());
    // Ajax通信を開始する
    $.ajax({
        url: '<?php echo APIPATH;?>' + 'request',
        type: 'post',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({
            sender: $('#sender').val(),
            isbn: $('#isbn').val(),
            request_id: guid(),
            from_date: "2018/03/20",
        }),
    })
    .done(function (response) {
        alert("登録できたね超いいね！！！");
        // window.location.href = '/home'; // 通常の遷移
    })
    .fail(function () {
        alert("失敗したよ！もっかい試してね！多分ジーノのせいだよ！");
        // window.location.href = '/register'; // 通常の遷移
    });
});
});
</script>

</body>
</html>

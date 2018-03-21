<body>
<div class="container">
  <h2>リクエストの一覧</h2>
  <?php foreach($requests as $request) { ?>
    <div>
      <p><?php echo $request->book->isbn; ?></p>
      <p><?php echo $request->book->name; ?></p>
    </div>
    <input type="button" class="btn btn-primary" id="send" value="accept!">
  <?php } ?>
</div>

</body>
</html>
<?php


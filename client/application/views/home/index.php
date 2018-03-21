<body>
<div class="container">
    <?php
        //if (isset($_SESSION['email'])) {
            //echo "your email address {$_SESSION['email']}";
        //}
    ?>
  <h2>本の一覧</h2>
  <?php for($i = 1; $i < count($books); $i+=2) { ?>
    <div class = "row">
      <div class="col-sm-6"><?php echo $books[$i-1]->isbn; ?></div>
      <div class="col-sm-6"><?php echo $books[$i]->isbn; ?></div>
    </div>
  <?php } ?>
</div>
</body>
</html>
<?php


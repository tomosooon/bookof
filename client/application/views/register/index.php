<body>
<?php
$this->load->helper('form');
?>
<div class="container">
    <form method="post" accept-charset="utf-8" action="http://<? echo base_url() ?>register">
    <div class="form-group has-success">
        <labe>sender</labe>
        <input type="text" class="form-control" name="sender">
    </div>
    <div class="form-group has-warning">
        <labe>title</labe>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group has-error">
        <labe>isbn</labe>
        <input type="text" class="form-control" name="isbn">
    </div>
    <button type="submit" class="btn btn-primary" name="send" value="true">Send</button>
    </form>
</div>

</body>
</html>



<body>
<?php
$this->load->helper('form');
?>
<div class="container">
    <form method="post" accept-charset="utf-8" action="http://<? echo base_url() ?>login">
    <div class="form-group has-success">
        <labe>email address</labe>
        <input type="text" class="form-control" name="email">
    </div>
    <button type="submit" class="btn btn-primary" name="send" value="true">Send</button>
    </form>
</div>

</body>
</html>



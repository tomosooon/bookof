<body>
<div class="container">
  <h2>マイページ</h2>
  <p>email: <?php echo $user->email ?></p>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Book Name</th>
        <th>isbn</th>
        <th>user</th>
        <th>uuid</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
<?php
foreach($user->reviews as $review) {
  echo $review->star + " ";
}
foreach($user->bookMaterials as $material) {
  echo $material->isbn;
}
?>
</div>
</body>

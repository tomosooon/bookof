<body>
<div class="container">
  <h2>マイページ</h2>
  <p>email: <?php echo $user->email ?></p>
  <h3>所有している本の一覧</h3>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Book Name</th>
        <th>isbn</th>
        <th>uuid</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($user->bookMaterials as $material) { ?>
        <tr>
          <th>test</th>
          <th><?php echo $material->book->isbn; ?></th>
          <th><?php echo $material->bookMaterialId; ?></th>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>

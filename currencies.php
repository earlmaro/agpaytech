<?php

namespace App;

require_once __DIR__ . '\app\DataModel.php';
$DataModel = new DataModel();
if (!isset($_POST["submitSearch"])) {
  $currencies = $DataModel->getAllCurrencies();
}
if (isset($_POST["submitSearch"])) {
  $currencies = $DataModel->getAllCurrencies();
}
if (!empty($currencies)) {
?>
  <?php include './header.php'; ?>
  <h3>Imported records(Currencies)</h3>
  <form action="" method="post" name="" id="" class="row g-3 mt-4 w-75">
        <div class="col-auto">
            <input type="text" name="search" value="<?php if (isset($_POST["search"])) {echo $_POST["search"];} ?>" class="form-control" required>
        </div>
        <div class="col-auto">
            <button type="submit" name="submitSearch" class="btn btn-primary mb-3">Search</button>
        </div>
    </form>
  <table id='userTable'>
    <thead>
      <tr>
        <th>iso_code</th>
        <th>iso_numeric_code</th>
        <th>common_name</th>
        <th>official_name</th>
        <th>symbol</th>
      </tr>
    </thead>
    <?php
    foreach ($currencies['body'] as $row) {
    ?>
      <tbody>
        <tr>
          <td><?php echo $row['iso_code']; ?></td>
          <td><?php echo $row['iso_numeric_code']; ?></td>
          <td><?php echo $row['common_name']; ?></td>
          <td><?php echo $row['official_name']; ?></td>
          <td><?php echo $row['symbol']; ?></td>
        </tr>
      <?php
    }
      ?>
      </tbody>
  </table>
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="./currencies.php?page=<?= $currencies['Previous']; ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php for ($i = 1; $i <= $currencies['pages']; $i++) : ?>
        <li class="page-item"><a class="page-link" href="./currencies.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php endfor; ?>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
<?php
}
?>
<?php

namespace App;
use App\DataModel;

require_once __DIR__ . '\app\DataModel.php';
$DataModel = new DataModel();
if (isset($_POST["importCountry"])) {
  $response = $DataModel->readCountry();
}
if (isset($_POST["importCurrency"])) {
  $response = $DataModel->readCurrency();
}
?>
<?php include './inc/header.php'; ?>

<div class="row">
  <div class="col border p-4">
    <form action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data" onsubmit="return validateFile()" class="mt-4 w-75">
      <div class="form-group">
        <label for="exampleInputEmail1"><a href="./csv/country.csv" download> Download country template</a></label>
        <input class="mt-5" type="file" name="file" id="file" class="file" accept=".csv,.xls,.xlsx">
      </div>
      <div class="mt-5">
        <button type="submit" id="submit" name="importCountry" class="btn btn-primary">Import Country csv and Save Data</button>
      </div>
    </form>
  </div>


  <div class="col border p-4">
    <form action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data" onsubmit="return validateFile()" class="mt-4 w-75">
      <div class="form-group">
        <label for="exampleInputEmail1"><a href="./csv/currencies.csv" download> Download currency template</a></label>
        <input class="mt-5" type="file" name="file" id="file" class="file" accept=".csv,.xls,.xlsx">
      </div>
      <div class="mt-5">
        <button type="submit" id="submit" name="importCurrency" class="btn btn-primary">Import Currency csv and Save Data</button>
      </div>
    </form>
  </div>
</div>
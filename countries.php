<?php namespace App; ?>
<?php include './header.php'; ?>
<?php


require_once __DIR__ . '\app\DataModel.php';
$DataModel = new DataModel();
if (!isset($_POST["submitSearch"])) {
    $countries = $DataModel->getAllCountries();
}
if (isset($_POST["submitSearch"])) {
    $countries = $DataModel->getAllCountries();
}
if (!empty($countries) && $countries['body'] != null) {
?>
    <h3>Imported records (Countries):</h3>
    <form action="" method="get" name="" id="" class="row g-3 mt-4 w-75">
        <div class="col-auto">
            <input type="text" name="search" value="<?php if (isset($_GET["search"])) {
                                                        echo $_GET["search"];
                                                    } ?>" class="form-control" required>
        </div>
        <div class="col-auto">
            <button type="submit" name="submitSearch" class="btn btn-primary mb-3">Search</button>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>continent_code</th>
                <th>currency_code</th>
                <th>iso2_code</th>
                <th>iso3_code</th>
                <th>iso_numeric_code</th>
                <th>fips_code</th>
                <th>calling_code</th>
                <th>common_name</th>
                <th>official_name</th>
                <th>endonym</th>
                <th>demonym</th>
            </tr>
        </thead>
        <?php
        foreach ($countries['body'] as $row) {
        ?>
            <tbody>
                <tr>
                    <td><?php echo $row['continent_code']; ?></td>
                    <td><?php echo $row['currency_code']; ?></td>
                    <td><?php echo $row['iso2_code']; ?></td>
                    <td><?php echo $row['iso3_code']; ?></td>
                    <td><?php echo $row['iso_numeric_code']; ?></td>
                    <td><?php echo $row['fips_code']; ?></td>
                    <td><?php echo $row['calling_code']; ?></td>
                    <td><?php echo $row['common_name']; ?></td>
                    <td><?php echo $row['official_name']; ?></td>
                    <td><?php echo $row['endonym']; ?></td>
                    <td><?php echo $row['demonym']; ?></td>
                </tr>
            <?php
        }
            ?>
            </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="./countries.php?page=<?= $countries['Previous']; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $countries['pages']; $i++) : ?>
                <li class="page-item"><a class="page-link" href="./countries.php?page=<?= $i; ?>"><?= $i; ?></a></li>
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
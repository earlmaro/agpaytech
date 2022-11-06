<?php
namespace App;

use App\DataSource;

class DataModel
{

    private $conn;

    function __construct()
    {
        require_once 'DataSource.php';
        $this->conn = new DataSource();
    }

    function getAllCountries()
    {
        $limit =  50;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;
         if(isset($_POST['search'])){
            $value = $_POST['search'];
            $body = $this->conn->select("SELECT * FROM Countries WHERE CONCAT(
                continent_code,
                currency_code,
                iso2_code,
                iso3_code,
                iso_numeric_code,
                fips_code,
                calling_code,
                common_name,
                official_name,
                endonym,
                demonym
                ) LIKE '%". $value ."%' LIMIT $start, $limit");
            $custCount = $this->conn->select(
            "SELECT count(*) AS total FROM Countries WHERE CONCAT(
                continent_code,
                currency_code,
                iso2_code,
                iso3_code,
                iso_numeric_code,
                fips_code,
                calling_code,
                common_name,
                official_name,
                endonym,
                demonym
                ) LIKE '%" . $value . "%' LIMIT $start, $limit");
        }else{
            $body = $this->conn->select("SELECT * FROM Countries LIMIT $start, $limit");
            $custCount = $this->conn->select("SELECT count(*) AS total FROM Countries");
        }

        $total = $custCount[0]['total'];
        $pages = ceil($total / $limit);

        $Previous = $page - 1;
        $Next = $page + 1;

        $result = array(
            'Previous' => $Previous,
            'Next' => $Next,
            'body' => $body,
            'pages' => $pages,
            'Limit' => $limit
        );
        return $result;
    }
    function getAllCurrencies()
    {
        $limit =  50;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;
        if (isset($_POST['search'])) {
            $value = $_POST['search'];
            $body = $this->conn->select("SELECT * FROM Currencies WHERE CONCAT(
                iso_code,
                iso_numeric_code,
                common_name,
                official_name,
                symbol
                ) LIKE '%" . $value . "%' LIMIT $start, $limit");
            $custCount = $this->conn->select(
                "SELECT count(*) AS total FROM Currencies WHERE CONCAT(
                iso_code,
                iso_numeric_code,
                common_name,
                official_name,
                symbol
                ) LIKE '%" . $value . "%' LIMIT $start, $limit"
            );
        } else {
            $body = $this->conn->select("SELECT * FROM Currencies LIMIT $start, $limit");
            $custCount = $this->conn->select("SELECT count(*) AS total FROM Currencies");
        }

        $total = $custCount[0]['total'];
        $pages = ceil($total / $limit);

        $Previous = $page - 1;
        $Next = $page + 1;

        $result = array(
            'Previous' => $Previous,
            'Next' => $Next,
            'body' => $body,
            'pages' => $pages,
            'Limit' => $limit
        );
        return $result;
    }

    function readCountry()
    {
        $fileName = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($fileName, "r");
            $importCount = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if (!empty($column) && is_array($column)) {
                    if ($this->hasEmptyRow($column)) {
                        continue;
                    }
                    $continentCode = $column[0];
                    $currencyCode = $column[1];
                    $iso2Code = $column[2];
                    $iso3Code = $column[3];
                    $isoNumeric_code = $column[4];
                    $fipsCode = $column[5];
                    $callingCode = $column[6];
                    $commonName = $column[7];
                    $officialName = $column[8];
                    $endonym = $column[9];
                    $demonym = $column[10];
                    // echo $isoCode;
                    // return;
                    if ($importCount != 0) {
                        $insertData = $this->insertCountry(
                            $continentCode,
                            $currencyCode,
                            $iso2Code,
                            $iso3Code,
                            $isoNumeric_code,
                            $fipsCode,
                            $callingCode,
                            $commonName,
                            $officialName,
                            $endonym,
                            $demonym
                            );
                    } else {
                        $output["type"] = "success";
                        $output["message"] = "Import completed.";
                        $importCount++;
                    }
                    if (!empty($insertData)) {
                        $output["type"] = "success";
                        $output["message"] = "Import completed.";
                        $importCount++;
                    }
                } else {
                    $output["type"] = "error";
                    $output["message"] = "Problem in importing data.";
                }
            }
            if ($importCount == 0) {
                $output["type"] = "error";
                $output["message"] = "Duplicate data found.";
            }
            print_r($output);
            return $output;
        }
    }

    function readCurrency()
    {
        $fileName = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($fileName, "r");
            $importCount = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if (! empty($column) && is_array($column)) {
                    if ($this->hasEmptyRow($column)) {
                        continue;
                    }
                    $isoCode = $column[0];
                    $isoNumericCode = $column[1];
                    $commonName = $column[2];
                    $official_name = $column[3];
                    $symbol = $column[4];
                    if($importCount != 0){
                        $insertData = $this->insertCurrency($isoCode, $isoNumericCode, $commonName, $official_name, $symbol);
                    }else{
                        $output["type"] = "success";
                        $output["message"] = "Import completed.";
                        $importCount++;
                    }
                    if (! empty($insertData)) {
                        $output["type"] = "success";
                        $output["message"] = "Import completed.";
                        $importCount ++;
                    }
                } else {
                    $output["type"] = "error";
                    $output["message"] = "Problem in importing data.";
                }
            }
            if ($importCount == 0) {
                $output["type"] = "error";
                $output["message"] = "Duplicate data found.";
            }
            print_r($output);
            return $output;
        }
    }

    function hasEmptyRow(array $column)
    {
        $columnCount = count($column);
        $isEmpty = true;
        for ($i = 0; $i < $columnCount; $i ++) {
            if (! empty($column[$i]) || $column[$i] !== '') {
                $isEmpty = false;
            }
        }
        return $isEmpty;
    }

    // function currencyAPI(){
    //     $sqlSelect = "SELECT * FROM Currencies";
    //     $result = $this->conn->select($sqlSelect);
    //     return $result;
    // }

    function insertCurrency($isoCode, $isoNumericCode,$commonName, $official_name, $symbol)
    {
        $sql = "INSERT INTO currencies (iso_code, iso_numeric_code, common_name, official_name, symbol) VALUES (?, ?, ?, ?, ?)";
        $paramType = "sssss";
        $paramArray = array( $isoCode, $isoNumericCode, $commonName, $official_name, $symbol);
        $insertData = $this->conn->insertCurrency($sql, $paramType, $paramArray);
        return $insertData;
    }

    function insertCountry(
        $continentCode,
        $currencyCode,
        $iso2Code,
        $iso3Code,
        $isoNumeric_code,
        $fipsCode,
        $callingCode,
        $commonName,
        $officialName,
        $endonym,
        $demonym
    )
    {

        $sql = "INSERT into countries (
            continent_code,
            currency_code,
            iso2_code,
            iso3_code,
            iso_numeric_code,
            fips_code,
            calling_code,
            common_name,
            official_name,
            endonym,
            demonym
            ) 
        values (?,?,?,?,?,?,?,?,?,?,?)";
        $paramType = "sssssssssss";
        $paramArray = array(
            $continentCode,
            $currencyCode,
            $iso2Code,
            $iso3Code,
            $isoNumeric_code,
            $fipsCode,
            $callingCode,
            $commonName,
            $officialName,
            $endonym,
            $demonym
        );
        $insertData = $this->conn->insertCountry($sql, $paramType, $paramArray);
        return $insertData;
    }
}

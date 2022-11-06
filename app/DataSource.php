<?php

namespace App;

use \Exception as Exception;
/**
 * Generic datasource class for handling DB operations.
 * Uses MySqli and PreparedStatements.
 *
 * @version 2.3
 */
class DataSource
{

    // PHP 7.1.0 visibility modifiers are allowed for class constants.
    // when using above 7.1.0, declare the below constants as private
    const HOST = 'localhost';

    const USERNAME = 'root';

    const PASSWORD = '';

    const DATABASENAME = 'tests';

    private $conn;

    /**
     * PHP implicitly takes care of cleanup for default connection types.
     * So no need to worry about closing the connection.
     *
     * Singletons not required in PHP as there is no
     * concept of shared memory.
     * Every object lives only for a request.
     *
     * Keeping things simple and that works!
     */
    function __construct()
    {
        $this->conn = $this->getConnection();
    }

    /**
     * If connection object is needed use this method and get access to it.
     * Otherwise, use the below methods for insert / update / etc.
     *
     * @return \mysqli
     */
    public function getConnection()
    {
        $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

        if (mysqli_connect_errno()) {
            trigger_error("Problem with connecting to database.");
        }
        
        $conn->set_charset("utf8");
        return $conn;
    }

    /**
     * To get database results
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (!empty($resultset)) {
            return $resultset;
        }
    }

    /**
     * To insert
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insertCurrency($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($paramType, $isoCode, $isoNumericCode, $commonName, $officialName, $symbol);
        if (!$stmt) {
            throw new Exception($this->conn->error);
        }
        $isoCode = $paramArray[0];
        $isoNumericCode = $paramArray[1];
        $commonName = $paramArray[2];
        $officialName = $paramArray[3];
        $symbol = $paramArray[4];
        $stmt->execute();
    }

    public function insertCountry($query, $paramType, $paramArray)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            $paramType,
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
        if (!$stmt) {
            throw new Exception($this->conn->error);
        }
        $continentCode = $paramArray[0];
        $currencyCode = $paramArray[1];
        $iso2Code = $paramArray[2];
        $iso3Code = $paramArray[3];
        $isoNumeric_code = $paramArray[4];
        $fipsCode = $paramArray[5];
        $callingCode = $paramArray[6];
        $commonName = $paramArray[7];
        $officialName = $paramArray[8];
        $endonym = $paramArray[9];
        $demonym = $paramArray[10];
        $stmt->execute();
    }


    /**
     * To get database results
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function numRows($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;
        return $recordCount;
    }
}

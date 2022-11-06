--
-- Database: `tests`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `continent_code` varchar(255) NULL,
  `currency_code` varchar(255) NULL,
  `iso2_code` varchar(255) NULL,
  `iso3_code` varchar(255) NULL,
  `iso_numeric_code` varchar(255) NULL,
  `fips_code` varchar(255) NULL,
  `calling_code` varchar(255) NULL,
  `common_name` varchar(255) NULL,
  `official_name` varchar(255) NULL,
  `endonym` varchar(255) NULL,
  `demonym` varchar(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

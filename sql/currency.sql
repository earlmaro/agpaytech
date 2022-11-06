--
-- Database: `tests`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `iso_code` varchar(255) NULL,
  `iso_numeric_code` varchar(255) NULL,
  `common_name` varchar(255) NULL,
  `official_name` varchar(255) NULL,
  `symbol` varchar(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

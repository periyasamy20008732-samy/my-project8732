-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 03:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenbiller`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountsettings`
--

CREATE TABLE `accountsettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `upi_id` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountsettings`
--

INSERT INTO `accountsettings` (`id`, `account_name`, `bank_name`, `account_number`, `ifsc_code`, `upi_id`, `balance`, `user_id`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '11111', '1', '2', '11', '11', '4', '2025-06-07 03:52:35', '2025-06-07 03:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `ac_accounts`
--

CREATE TABLE `ac_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `sort_code` varchar(255) DEFAULT NULL,
  `account_code` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `delete_bit` varchar(255) DEFAULT NULL,
  `account_selection_name` varchar(255) DEFAULT NULL,
  `paymenttypes_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `expense_id` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ac_moneydeposits`
--

CREATE TABLE `ac_moneydeposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `deposit_date` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `debit_account_id` varchar(255) DEFAULT NULL,
  `credit_account_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ac_moneytransfer`
--

CREATE TABLE `ac_moneytransfer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `transfer_code` varchar(255) DEFAULT NULL,
  `transfer_date` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `debit_account_id` varchar(255) DEFAULT NULL,
  `credit_account_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ac_transactions`
--

CREATE TABLE `ac_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `transaction_date` varchar(255) DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `debit_account_id` varchar(255) DEFAULT NULL,
  `credit_account_id` varchar(255) DEFAULT NULL,
  `debit_amt` varchar(255) DEFAULT NULL,
  `credit_amt` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `ref_accounts_id` varchar(255) DEFAULT NULL,
  `ref_moneytransfer_id` varchar(255) DEFAULT NULL,
  `ref_moneydeposits_id` varchar(255) DEFAULT NULL,
  `ref_salespayments_id` varchar(255) DEFAULT NULL,
  `ref_salespaymentsreturn_id` varchar(255) DEFAULT NULL,
  `ref_purchasepayments_id` varchar(255) DEFAULT NULL,
  `ref_purchasepaymentsreturn_id` varchar(255) DEFAULT NULL,
  `ref_expense_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `short_code` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) NOT NULL,
  `brand_code` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_image` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `inapp_view` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `parent_id` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) NOT NULL,
  `category_code` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `inapp_view` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `store_id`, `parent_id`, `slug`, `count_id`, `category_code`, `category_name`, `image`, `description`, `status`, `inapp_view`, `created_at`, `updated_at`) VALUES
(1, '11', '2', 'ilrty', '2', '123', 'prod', 'storage/public/category/1749547481.Screenshot 2025-05-20 002723.png', 'ggog', 1, '1', '2025-06-10 03:54:41', '2025-06-10 03:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `core_setting`
--

CREATE TABLE `core_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siteurl` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `app_version` varchar(255) DEFAULT NULL,
  `app_package_name` varchar(255) DEFAULT NULL,
  `ios_app_version` varchar(255) DEFAULT NULL,
  `ios_packageid` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_details` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `min_logo` varchar(255) DEFAULT NULL,
  `fav_icon` varchar(255) DEFAULT NULL,
  `web_logo` varchar(255) DEFAULT NULL,
  `app_logo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `sendgrid_API` varchar(255) DEFAULT NULL,
  `if_googlemap` varchar(255) DEFAULT NULL,
  `if_firebase` varchar(255) DEFAULT NULL,
  `firebase_config` varchar(255) DEFAULT NULL,
  `firebase_API` varchar(255) DEFAULT NULL,
  `cod_status` varchar(255) DEFAULT NULL,
  `if_bank_transfer` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `if_razorpay` varchar(255) DEFAULT NULL,
  `razo_key_id` varchar(255) DEFAULT NULL,
  `razo_key_secret` varchar(255) DEFAULT NULL,
  `if_ccavenue` varchar(255) DEFAULT NULL,
  `ccavenue_testmode` varchar(255) DEFAULT NULL,
  `ccavenue_merchant_id` varchar(255) DEFAULT NULL,
  `ccavenue_access_code` varchar(255) DEFAULT NULL,
  `ccavenue_working_key` varchar(255) DEFAULT NULL,
  `if_phonepe` varchar(255) DEFAULT NULL,
  `phonepe_merchantId` varchar(255) DEFAULT NULL,
  `phonepe_saltkey` varchar(255) DEFAULT NULL,
  `phonepe_mode` varchar(255) DEFAULT NULL,
  `if_onesignal` varchar(255) DEFAULT NULL,
  `onesignal_id` varchar(255) DEFAULT NULL,
  `onesignal_key` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `if_testotp` varchar(255) DEFAULT NULL,
  `if_msg91` varchar(255) DEFAULT NULL,
  `msg91_apikey` varchar(255) DEFAULT NULL,
  `if_textlocal` varchar(255) DEFAULT NULL,
  `textlocal_apikey` varchar(255) DEFAULT NULL,
  `if_greensms` varchar(255) DEFAULT NULL,
  `greensms_accessToken` varchar(255) DEFAULT NULL,
  `greensms_accessTokenKey` varchar(255) DEFAULT NULL,
  `sms_senderid` varchar(255) DEFAULT NULL,
  `sms_entityId` varchar(255) DEFAULT NULL,
  `sms_dltid` varchar(255) DEFAULT NULL,
  `sms_msg` varchar(255) DEFAULT NULL,
  `maintenance_mode` varchar(255) DEFAULT NULL,
  `app_maintenance_mode` varchar(255) DEFAULT NULL,
  `device_id_check_reg` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country_settings`
--

CREATE TABLE `country_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_code` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_symble` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `customer_code` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `tax_number` varchar(255) DEFAULT NULL,
  `vatin` varchar(255) DEFAULT NULL,
  `opening_balance` varchar(255) DEFAULT NULL,
  `sales_due` varchar(255) DEFAULT NULL,
  `sales_return_due` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location_link` varchar(255) DEFAULT NULL,
  `attachment_1` varchar(255) DEFAULT NULL,
  `price_level_type` varchar(255) DEFAULT NULL,
  `price_level` varchar(255) DEFAULT NULL,
  `delete_bit` varchar(255) DEFAULT NULL,
  `tot_advance` varchar(255) DEFAULT NULL,
  `credit_limit` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_advance`
--

CREATE TABLE `customer_advance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salespayment_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_shippingaddress`
--

CREATE TABLE `customer_shippingaddress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `shipping_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location_link` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `default` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_05_041249_create_brands_table', 1),
(5, '2025_05_05_043949_create_categories_table', 1),
(6, '2025_05_13_171128_create_oauth_auth_codes_table', 1),
(7, '2025_05_13_171129_create_oauth_access_tokens_table', 1),
(8, '2025_05_13_171130_create_oauth_refresh_tokens_table', 1),
(9, '2025_05_13_171131_create_oauth_clients_table', 1),
(10, '2025_05_13_171132_create_oauth_device_codes_table', 1),
(11, '2025_05_14_051652_create_core_setting_table', 1),
(12, '2025_05_14_093134_create_packages_table', 1),
(13, '2025_05_14_112530_create_customers_table', 1),
(14, '2025_05_14_114935_create_ac_accounts_table', 1),
(15, '2025_05_14_115621_create_warehouse_table', 1),
(16, '2025_05_14_122326_create_store_table', 1),
(17, '2025_05_15_045411_create_subcription_purchase_table', 1),
(18, '2025_05_15_045830_create_online_payment_table', 1),
(19, '2025_05_16_040659_create_supplier_table', 1),
(20, '2025_05_16_105558_create_store_app_settings_table', 1),
(21, '2025_05_17_072931_create_country_settings_table', 1),
(22, '2025_05_19_074544_create_warehouseitems_table', 1),
(23, '2025_05_19_104440_create_purchase_table', 1),
(24, '2025_05_19_110921_create_purchaseitems_table', 1),
(25, '2025_05_23_033957_create_units_table', 1),
(26, '2025_05_23_123828_create_onesignal_id_table', 1),
(27, '2025_05_24_111110_create_sales_table', 1),
(28, '2025_05_27_034439_create_sales_item_table', 1),
(29, '2025_05_29_062843_create_purchase_payments_table', 1),
(30, '2025_05_31_034530_create_purchase_payment_returns_table', 1),
(31, '2025_05_31_034558_create_purchase_item_returns_table', 1),
(32, '2025_06_02_054354_create_purchase_return_table', 1),
(33, '2025_06_02_072859_create_sales_payments_table', 1),
(34, '2025_06_02_103010_create_sales_payments_return_table', 1),
(35, '2025_06_02_105945_create_sales_return_table', 1),
(36, '2025_06_02_110509_create_tax_table', 1),
(37, '2025_06_03_052434_create_sales_item_return_table', 1),
(38, '2025_06_03_113617_create_stock_adjustment_table', 1),
(39, '2025_06_03_123727_create_stock_adjustment_item_table', 1),
(40, '2025_06_04_035040_create_stock_transfer_item_table', 1),
(41, '2025_06_04_041215_create_stock_transfer_table', 1),
(42, '2025_06_04_081927_create_ac_moneydeposits_table', 1),
(43, '2025_06_04_083140_create_ac_moneytransfer_table', 1),
(44, '2025_06_04_084336_create_ac_transactions_table', 1),
(45, '2025_06_04_113459_create_customer_advance_table', 1),
(46, '2025_06_04_113630_create_customer_payments_table', 1),
(47, '2025_06_04_113748_create_customer_shippingaddress_table', 1),
(48, '2025_06_05_065104_create_orders_table', 1),
(49, '2025_06_05_065958_create_orderstatuses_table', 1),
(50, '2025_06_05_070056_create_orders_items_table', 1),
(51, '2025_06_05_070357_create_order_log_table', 1),
(52, '2025_06_06_081712_create_pos_hold_table', 2),
(53, '2025_06_07_041001_create_pos_holditems_table', 3),
(54, '2025_06_07_044658_create_paymenttypes_table', 4),
(55, '2025_06_07_070529_create_accountsettings_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('14f303cd1a43cb060c6cf8a54cdbe0c69c5d2eeb269ed030d83089e74531066a65b8b2e6d354298f', 1, '01974449-86a0-7121-8964-225383bfe435', 'auth_token', '[]', 0, '2025-06-09 23:52:48', '2025-06-09 23:52:48', '2025-12-10 05:22:48'),
('18ca02919b2b7bbe975f8c70f456f3e37961aee92d90c797725365b7807363780dcd0abb9129cf06', 1, '01974449-86a0-7121-8964-225383bfe435', 'access_token', '[]', 0, '2025-06-06 02:43:36', '2025-06-06 02:43:36', '2025-12-06 08:13:36'),
('337505e4de02c5b833ac311ef90e8bde1ffaebb3c52a860dc99e6f0b52d7d08b34013cee784f3677', 1, '01974449-86a0-7121-8964-225383bfe435', 'access_token', '[]', 0, '2025-06-07 03:11:52', '2025-06-07 03:11:52', '2025-12-07 08:41:52'),
('445944906165e5682413cd13526a5564e49724b3aecc9b148705b630e7fa3d6daa5ac6c4caec7653', 1, '01974449-86a0-7121-8964-225383bfe435', 'auth_token', '[]', 0, '2025-06-06 22:23:41', '2025-06-06 22:23:41', '2025-12-07 03:53:41'),
('6b0ac0fa8da8f6a6aebed377d4f4d8867fbe8597a20a7e9b675384162b14cbbe75499bd7bee610e2', 1, '01974449-86a0-7121-8964-225383bfe435', 'access_token', '[]', 0, '2025-06-07 01:54:56', '2025-06-07 01:54:56', '2025-12-07 07:24:56'),
('b1183ea0dcca31f5cfc542a9133f2d08d2100976bbbf62b7b58e54bdf29cfc9a2bcee3518f65e829', 1, '01974449-86a0-7121-8964-225383bfe435', 'access_token', '[]', 0, '2025-06-07 01:52:14', '2025-06-07 01:52:15', '2025-12-07 07:22:14'),
('f28e724b44c546d51a6c2b1bf1daf488e9e65e83f97948af6ca387eaf8a28aa08a32fed841595fec', 1, '01974449-86a0-7121-8964-225383bfe435', 'auth_token', '[]', 0, '2025-06-07 01:53:32', '2025-06-07 01:53:32', '2025-12-07 07:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) NOT NULL,
  `owner_type` varchar(255) DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect_uris` text NOT NULL,
  `grant_types` text NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `owner_type`, `owner_id`, `name`, `secret`, `provider`, `redirect_uris`, `grant_types`, `revoked`, `created_at`, `updated_at`) VALUES
('01974449-86a0-7121-8964-225383bfe435', NULL, NULL, 'Laravel', '$2y$12$oAGoO6CMaSL2c2Qby4Yp6.yyyRD0n7ppGsCXUdvV3.kbBx8ih5PBK', 'users', '[]', '[\"personal_access\"]', 0, '2025-06-06 02:39:18', '2025-06-06 02:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_device_codes`
--

CREATE TABLE `oauth_device_codes` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `user_code` char(8) NOT NULL,
  `scopes` text NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `user_approved_at` datetime DEFAULT NULL,
  `last_polled_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` char(80) NOT NULL,
  `access_token_id` char(80) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onesignal_id`
--

CREATE TABLE `onesignal_id` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `player_id` varchar(255) NOT NULL,
  `external_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_payment`
--

CREATE TABLE `online_payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `tax_amount` varchar(255) NOT NULL,
  `price_tax` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_order_id` varchar(255) DEFAULT NULL,
  `orderstatus_id` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `if_sales` varchar(255) DEFAULT NULL,
  `sales_id` varchar(255) DEFAULT NULL,
  `customer_latitude` varchar(255) DEFAULT NULL,
  `customer_longitude` varchar(255) DEFAULT NULL,
  `shipping_address_id` varchar(255) DEFAULT NULL,
  `order_address` varchar(255) DEFAULT NULL,
  `reward_point` varchar(255) DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `taxrate` varchar(255) DEFAULT NULL,
  `tax_amt` varchar(255) DEFAULT NULL,
  `delivery_charge` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `coupon_id` varchar(255) DEFAULT NULL,
  `coupon_amount` varchar(255) DEFAULT NULL,
  `handling_charge` varchar(255) DEFAULT NULL,
  `order_totalamt` varchar(255) DEFAULT NULL,
  `if_redeem` varchar(255) DEFAULT NULL,
  `redeem_point` varchar(255) DEFAULT NULL,
  `redeem_cash` varchar(255) DEFAULT NULL,
  `after_redeem_bill_amt` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `map_distance` varchar(255) DEFAULT NULL,
  `delivery_pin` varchar(255) DEFAULT NULL,
  `deliveryboy_id` varchar(255) DEFAULT NULL,
  `notifi_admin` varchar(255) DEFAULT NULL,
  `notifi_store` varchar(255) DEFAULT NULL,
  `notifi_deliveryboy` varchar(255) DEFAULT NULL,
  `delivery_timeslote_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderstatuses`
--

CREATE TABLE `orderstatuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `tax_rate` varchar(255) NOT NULL,
  `tax_type` varchar(255) NOT NULL,
  `tax_amt` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `if_offer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_log`
--

CREATE TABLE `order_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `log_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `validity_date` varchar(255) NOT NULL,
  `if_webpanel` varchar(255) NOT NULL,
  `if_android` varchar(255) NOT NULL,
  `if_ios` varchar(255) NOT NULL,
  `if_windows` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `if_customerapp` varchar(255) NOT NULL,
  `if_deliveryapp` varchar(255) NOT NULL,
  `if_exicutiveapp` varchar(255) NOT NULL,
  `if_multistore` varchar(255) NOT NULL,
  `if_numberof_store` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymenttypes`
--

CREATE TABLE `paymenttypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_hold`
--

CREATE TABLE `pos_hold` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `sales_date` varchar(255) DEFAULT NULL,
  `sales_status` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `other_charges_input` varchar(255) DEFAULT NULL,
  `other_charges_tax_id` varchar(255) DEFAULT NULL,
  `other_charges_amt` varchar(255) DEFAULT NULL,
  `discount_to_all_input` varchar(255) DEFAULT NULL,
  `discount_to_all_type` varchar(255) DEFAULT NULL,
  `tot_discount_to_all_amt` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `round_off` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `sales_note` varchar(255) DEFAULT NULL,
  `pos` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_hold`
--

INSERT INTO `pos_hold` (`id`, `store_id`, `warehouse_id`, `reference_id`, `reference_no`, `sales_date`, `sales_status`, `customer_id`, `other_charges_input`, `other_charges_tax_id`, `other_charges_amt`, `discount_to_all_input`, `discount_to_all_type`, `tot_discount_to_all_amt`, `subtotal`, `round_off`, `grand_total`, `sales_note`, `pos`, `created_by`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-06 22:36:42', '2025-06-06 22:36:42'),
(2, '2', '2', '2', '2', '2', '2', '1', '2', '3', 'e', '3', '2', '4', '4', '4', '3', '2', '3', '4', '2025-06-06 22:37:53', '2025-06-06 22:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `pos_holditems`
--

CREATE TABLE `pos_holditems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `hold_id` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sales_qty` varchar(255) DEFAULT NULL,
  `price_per_unit` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `tax_amt` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `discount_input` varchar(255) DEFAULT NULL,
  `discount_amt` varchar(255) DEFAULT NULL,
  `unit_total_cost` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `ifexpire` varchar(255) DEFAULT NULL,
  `item_purchasetable_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_holditems`
--

INSERT INTO `pos_holditems` (`id`, `store_id`, `hold_id`, `item_id`, `description`, `sales_qty`, `price_per_unit`, `tax_type`, `tax_id`, `tax_amt`, `discount_type`, `discount_input`, `discount_amt`, `unit_total_cost`, `total_cost`, `ifexpire`, `item_purchasetable_id`, `created_at`, `updated_at`) VALUES
(1, '4', '7', '1', '1', '123', 'hello_world', 'plus_4', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2025-06-06 23:10:17', '2025-06-06 23:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `purchase_date` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `other_charges_input` varchar(255) DEFAULT NULL,
  `other_charges_tax_id` varchar(255) DEFAULT NULL,
  `other_charges_amt` varchar(255) DEFAULT NULL,
  `discount_to_all_input` varchar(255) DEFAULT NULL,
  `discount_to_all_type` varchar(255) DEFAULT NULL,
  `tot_discount_to_all_amt` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `round_off` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `purchase_note` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `return_bit` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `store_id`, `warehouse_id`, `count_id`, `purchase_code`, `reference_no`, `purchase_date`, `supplier_id`, `other_charges_input`, `other_charges_tax_id`, `other_charges_amt`, `discount_to_all_input`, `discount_to_all_type`, `tot_discount_to_all_amt`, `subtotal`, `round_off`, `grand_total`, `purchase_note`, `payment_status`, `paid_amount`, `company_id`, `status`, `return_bit`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '0', '1', '122', NULL, '91', '7120583250', 'Admin@143', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-09 23:54:02', '2025-06-09 23:54:02'),
(2, '0', '1', '122', NULL, '91', '7120583250', 'Admin@143', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-09 23:54:05', '2025-06-09 23:54:05'),
(3, '0', '1', '122', NULL, '91', '7120583250', 'Admin@143', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-09 23:54:07', '2025-06-09 23:54:07'),
(4, '0', '1', '122', NULL, '91', '12/02/2024', 'Admin@143', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-09 23:56:09', '2025-06-09 23:56:09'),
(5, '0', '1', '122', NULL, '91', '12/02/2024', 'Admin@143', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-09 23:56:10', '2025-06-09 23:56:10'),
(6, '0', '1', '122', NULL, '91', '12/02/2025', 'Admin@143', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-09 23:56:19', '2025-06-09 23:56:19'),
(7, '0', '1', '122', NULL, '91', '12/02/2025', '2', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-10 00:26:47', '2025-06-10 00:26:47'),
(8, '0', '1', '122', NULL, '91', '12/02/2025', '2', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-10 00:26:49', '2025-06-10 00:26:49'),
(9, '0', '1', '122', NULL, '91', '12/02/2025', '3', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-10 00:26:56', '2025-06-10 00:26:56'),
(10, '0', '1', '122', NULL, '91', '16/02/2025', '3', 'Admin@143', '9852631285', NULL, '11', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '2025-06-10 05:45:18', '2025-06-10 05:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitems`
--

CREATE TABLE `purchaseitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `purchase_id` varchar(255) DEFAULT NULL,
  `purchase_status` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `purchase_qty` varchar(255) DEFAULT NULL,
  `price_per_unit` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `tax_amt` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `discount_input` varchar(255) DEFAULT NULL,
  `discount_amt` varchar(255) DEFAULT NULL,
  `unit_total_cost` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `profit_margin_per` varchar(255) DEFAULT NULL,
  `unit_sales_price` varchar(255) DEFAULT NULL,
  `stock` varchar(255) NOT NULL,
  `if_batch` varchar(255) NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `if_expirydate` varchar(255) NOT NULL,
  `expire_date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item_returns`
--

CREATE TABLE `purchase_item_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `purchase_id` varchar(255) DEFAULT NULL,
  `return_id` varchar(255) DEFAULT NULL,
  `return_status` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `return_qty` varchar(255) DEFAULT NULL,
  `price_per_unit` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `tax_amt` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `discount_input` varchar(255) DEFAULT NULL,
  `discount_amt` varchar(255) DEFAULT NULL,
  `unit_total_cost` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `profit_margin_per` varchar(255) DEFAULT NULL,
  `unit_sales_price` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `if_bach` varchar(255) DEFAULT NULL,
  `bach_no` varchar(255) DEFAULT NULL,
  `if_expirydate` varchar(255) DEFAULT NULL,
  `expire_date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `purchase_id` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `short_code` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payment_returns`
--

CREATE TABLE `purchase_payment_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `purchase_id` varchar(255) DEFAULT NULL,
  `return_id` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `short_code` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `purchase_id` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `return_code` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `return_date` varchar(255) DEFAULT NULL,
  `return_status` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `other_charges_input` varchar(255) DEFAULT NULL,
  `other_charges_tax_id` varchar(255) DEFAULT NULL,
  `other_charges_amt` varchar(255) DEFAULT NULL,
  `discount_to_all_input` varchar(255) DEFAULT NULL,
  `discount_to_all_type` varchar(255) DEFAULT NULL,
  `tot_discount_to_all_amt` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `round_off` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `return_note` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `init_code` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `sales_code` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `sales_date` varchar(255) DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `sales_status` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `other_charges_input` varchar(255) DEFAULT NULL,
  `other_charges_tax_id` varchar(255) DEFAULT NULL,
  `other_charges_amt` varchar(255) DEFAULT NULL,
  `discount_to_all_input` varchar(255) DEFAULT NULL,
  `discount_to_all_type` varchar(255) DEFAULT NULL,
  `tot_discount_to_all_amt` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `round_off` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `sales_note` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `pos` varchar(255) DEFAULT NULL,
  `return_bit` varchar(255) DEFAULT NULL,
  `customer_previous_due` varchar(255) DEFAULT NULL,
  `customer_total_due` varchar(255) DEFAULT NULL,
  `quotation_id` varchar(255) DEFAULT NULL,
  `coupon_id` varchar(255) DEFAULT NULL,
  `coupon_amt` varchar(255) DEFAULT NULL,
  `invoice_terms` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `app_order` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `tax_report` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `store_id`, `warehouse_id`, `init_code`, `count_id`, `sales_code`, `reference_no`, `sales_date`, `due_date`, `sales_status`, `customer_id`, `other_charges_input`, `other_charges_tax_id`, `other_charges_amt`, `discount_to_all_input`, `discount_to_all_type`, `tot_discount_to_all_amt`, `subtotal`, `round_off`, `grand_total`, `sales_note`, `payment_status`, `paid_amount`, `company_id`, `pos`, `return_bit`, `customer_previous_due`, `customer_total_due`, `quotation_id`, `coupon_id`, `coupon_amt`, `invoice_terms`, `status`, `app_order`, `order_id`, `tax_report`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '1', '0', 'Super Admin', 'admin32@admin.com', '91', '7120583250', '12/12/2022', '11/11/2021', '9852631285', '1', '1.jpg', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', '1', '1', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2', '2', '2', NULL, '2025-06-06 23:38:45', '2025-06-06 23:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `sales_item`
--

CREATE TABLE `sales_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `sales_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `sales_status` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sales_qty` varchar(255) DEFAULT NULL,
  `price_per_unit` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `tax_amt` varchar(255) DEFAULT NULL,
  `dicount_type` varchar(255) DEFAULT NULL,
  `discount_input` varchar(255) DEFAULT NULL,
  `discount_amt` varchar(255) DEFAULT NULL,
  `unit_total_cost` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `seller_points` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_item`
--

INSERT INTO `sales_item` (`id`, `store_id`, `sales_id`, `customer_id`, `sales_status`, `item_id`, `item_name`, `description`, `sales_qty`, `price_per_unit`, `tax_type`, `tax_id`, `tax_amt`, `dicount_type`, `discount_input`, `discount_amt`, `unit_total_cost`, `total_cost`, `status`, `seller_points`, `purchase_price`, `created_at`, `updated_at`) VALUES
(1, '0', '1', NULL, NULL, NULL, NULL, 's', 'sdf', 'ss', '1', '1.jpg', '3/5/10', NULL, NULL, NULL, NULL, NULL, '1', '0', '1', '2025-06-07 03:13:58', '2025-06-07 03:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `sales_item_return`
--

CREATE TABLE `sales_item_return` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `sales_id` varchar(255) DEFAULT NULL,
  `return_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `sales_status` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sales_qty` varchar(255) DEFAULT NULL,
  `price_per_unit` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `tax_amt` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `discount_input` varchar(255) DEFAULT NULL,
  `discount_amt` varchar(255) DEFAULT NULL,
  `unit_total_cost` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `seller_points` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_item_return`
--

INSERT INTO `sales_item_return` (`id`, `store_id`, `sales_id`, `return_id`, `customer_id`, `sales_status`, `item_id`, `item_name`, `description`, `sales_qty`, `price_per_unit`, `tax_type`, `tax_id`, `tax_amt`, `discount_type`, `discount_input`, `discount_amt`, `unit_total_cost`, `total_cost`, `status`, `seller_points`, `purchase_price`, `created_at`, `updated_at`) VALUES
(1, '1', '0', 'Super Admin', '1', '91', '7120583250', 'Admin@143', 'Admin@143', '9852631285', NULL, '1', '1.jpg', '3/5/10', '1', NULL, NULL, NULL, NULL, '1', '0', NULL, '2025-06-07 03:12:48', '2025-06-07 03:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `sales_payments`
--

CREATE TABLE `sales_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `sales_id` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_note` varchar(255) DEFAULT NULL,
  `change_return` varchar(255) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `short_code` varchar(255) DEFAULT NULL,
  `advance_adjusted` varchar(255) DEFAULT NULL,
  `cheque_number` varchar(255) DEFAULT NULL,
  `cheque_period` varchar(255) DEFAULT NULL,
  `cheque_status` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_payments_return`
--

CREATE TABLE `sales_payments_return` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `payment_code` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `sales_id` varchar(255) DEFAULT NULL,
  `return_id` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `payment_note` varchar(255) DEFAULT NULL,
  `change_return` varchar(255) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `cheque_number` varchar(255) DEFAULT NULL,
  `cheque_period` varchar(255) DEFAULT NULL,
  `cheque_status` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return`
--

CREATE TABLE `sales_return` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `sales_id` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `return_code` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `return_date` varchar(255) DEFAULT NULL,
  `return_status` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `other_charges_input` varchar(255) DEFAULT NULL,
  `other_charges_tax_id` varchar(255) DEFAULT NULL,
  `other_charges_amt` varchar(255) DEFAULT NULL,
  `discount_to_all_input` varchar(255) DEFAULT NULL,
  `discount_to_all_type` varchar(255) DEFAULT NULL,
  `tot_discount_to_all_amt` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `round_off` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `return_note` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `pos` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `return_bit` varchar(255) DEFAULT NULL,
  `coupon_id` varchar(255) DEFAULT NULL,
  `coupon_amt` varchar(255) DEFAULT NULL,
  `app_order` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('b3NonkYWkQtVH6fh1xh5CWnZDQTuhMQe8z3NwogO', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXFMQ2lRQ1MyNHVWOGF2S0ZheFh3N21rUmNwVW0xRXdjM3NkNVI1RiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91bml0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750749846),
('HtTXT47nWfAMH73QCn3sr2cfJrvfdAP68LngcOEI', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzF1QWVDN3BnRDBMaVJ0amxGMXhXWldldE9ZUVFBUmVEOEc0SnkzWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750762969);

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE `site_config` (
  `id` int(10) NOT NULL,
  `siteurl` text NOT NULL,
  `version` varchar(250) NOT NULL,
  `site_title` text NOT NULL,
  `license_validity` int(250) NOT NULL COMMENT '0-expired ;1 -waring start; 2 has validity',
  `license_key` varchar(250) NOT NULL,
  `footer_copyright` text NOT NULL,
  `site_description` varchar(250) NOT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_details` text DEFAULT NULL,
  `logo` varchar(250) NOT NULL,
  `min_logo` varchar(250) NOT NULL,
  `fav_icon` varchar(250) NOT NULL,
  `web_logo` varchar(250) NOT NULL,
  `app_logo` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `site_email` text NOT NULL,
  `whatsapp_no` text NOT NULL,
  `timezone` varchar(250) NOT NULL,
  `sendgrid_API` text NOT NULL,
  `if_googleanalytics` int(11) NOT NULL,
  `google_analytics_id` varchar(250) NOT NULL,
  `cod_status` int(10) NOT NULL COMMENT '1 to enable',
  `bank_transfer_status` int(11) NOT NULL,
  `bank_details` text NOT NULL,
  `razorpay_status` int(10) NOT NULL COMMENT '1 to enable',
  `razo_key_id` text NOT NULL,
  `razo_key_secret` text NOT NULL,
  `if_phonepe` int(11) NOT NULL,
  `phonepe_merchantId` varchar(150) NOT NULL,
  `phonepe_saltkey` varchar(150) NOT NULL,
  `phonepe_mode` varchar(150) NOT NULL,
  `if_googlemap` int(5) NOT NULL,
  `googlemap_API` varchar(150) NOT NULL,
  `if_firebase` int(5) NOT NULL,
  `firebase_config` text NOT NULL,
  `firebase_API` varchar(150) NOT NULL,
  `if_onesignal` int(5) NOT NULL,
  `onesignal_id` text NOT NULL,
  `onesignal_key` text NOT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_port` varchar(250) NOT NULL,
  `smtp_username` varchar(250) NOT NULL,
  `smtp_password` varchar(250) NOT NULL,
  `if_testotp` int(5) NOT NULL,
  `mg91_status` int(11) NOT NULL,
  `sms_apikey` varchar(250) NOT NULL,
  `if_textlocal` int(5) NOT NULL,
  `textlocal_apikey` varchar(150) NOT NULL,
  `if_greensms` int(5) NOT NULL,
  `greensms_accessToken` varchar(150) NOT NULL,
  `greensms_accessTokenKey` varchar(150) NOT NULL,
  `sms_senderid` varchar(250) NOT NULL,
  `sms_entityId` varchar(150) NOT NULL,
  `sms_dltid` varchar(250) NOT NULL,
  `sms_msg` text NOT NULL,
  `purchase_date` varchar(250) NOT NULL,
  `validity_end` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_config`
--

INSERT INTO `site_config` (`id`, `siteurl`, `version`, `site_title`, `license_validity`, `license_key`, `footer_copyright`, `site_description`, `meta_keyword`, `meta_details`, `logo`, `min_logo`, `fav_icon`, `web_logo`, `app_logo`, `address`, `site_email`, `whatsapp_no`, `timezone`, `sendgrid_API`, `if_googleanalytics`, `google_analytics_id`, `cod_status`, `bank_transfer_status`, `bank_details`, `razorpay_status`, `razo_key_id`, `razo_key_secret`, `if_phonepe`, `phonepe_merchantId`, `phonepe_saltkey`, `phonepe_mode`, `if_googlemap`, `googlemap_API`, `if_firebase`, `firebase_config`, `firebase_API`, `if_onesignal`, `onesignal_id`, `onesignal_key`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `if_testotp`, `mg91_status`, `sms_apikey`, `if_textlocal`, `textlocal_apikey`, `if_greensms`, `greensms_accessToken`, `greensms_accessTokenKey`, `sms_senderid`, `sms_entityId`, `sms_dltid`, `sms_msg`, `purchase_date`, `validity_end`) VALUES
(1, 'https://rajakumarischeme.com', '1.0.1', 'Rajakumari Gold Scheme', 2, '', 'POWERED BY GREENCREON', 'Rajakumari Gold Scheme', 'Rajakumari Gold Scheme', 'Rajakumari Gold Scheme', 'uploads/site/1737100156.png', 'uploads/site/1737099964.png', 'uploads/site/1737099976.png', 'uploads/site/1737100387.png', 'uploads/site/1737100369.png', '', 'gold@gmail.com', '+919072222112', '', '', 0, '', 0, 0, '', 0, 'rzp_test_TbwuCdRJ6gz6XH', 'Kkcx3APIfnoo9jSceB0g67Zs', 1, 'M228LSILXY3C1', 'b26a4aca-614b-4546-9bc0-fd16d3384778', 'PRODUCTION', 0, '', 0, '', '', 1, '895f4a94-3f79-4d1d-bea8-d365c4658b3d', 'os_v2_app_rfpuvfb7pfgr3pvi2ns4izmlhugjfq7fpfcel7nmsrhch5jxtgca5r2hgnwo3z7cdionapma4ukgkrx7qyzvi6tl7rpxkg7plmhx3wa', 'mail.almuqtadir.in', '465', 'info@rajakumarischeme.com', 'Admin@143', 0, 0, '340715A6QD8RXn2Cg56378f2b3P1', 0, 'NjI0OTY3NGEzODQ2Mzg2YTM2NTU0NzQ5NGQ0ODU0NDE', 1, '9UJI3Q66LF10989', '7Frj/LeP5HT&i1gE9bx)D4h28Jw0UmZ(', 'GRNLLP', '1701174193705338165', '1707174244761113638', '{code} is your OTP for login . OTP is valid for 8 minutes. Do not share this OTP with anyone. Powered by Greencreon LLP', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment`
--

CREATE TABLE `stock_adjustment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `adjustment_date` varchar(255) DEFAULT NULL,
  `adjustment_note` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_item`
--

CREATE TABLE `stock_adjustment_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `adjustment_id` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `adjustment_qty` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `to_store_id` varchar(255) DEFAULT NULL,
  `warehouse_from` varchar(255) DEFAULT NULL,
  `warehouse_to` varchar(255) DEFAULT NULL,
  `transfer_date` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer_item`
--

CREATE TABLE `stock_transfer_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stocktransfer_id` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `to_store_id` varchar(255) DEFAULT NULL,
  `warehouse_from` varchar(255) DEFAULT NULL,
  `warehouse_to` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `transfer_qty` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_code` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `store_website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `store_logo` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `if_gst` int(11) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `if_vat` int(11) DEFAULT NULL,
  `vat_no` varchar(255) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `upi_code` varchar(255) DEFAULT NULL,
  `bank_details` text DEFAULT NULL,
  `cid` varchar(255) DEFAULT NULL,
  `category_init` varchar(255) DEFAULT NULL,
  `item_init` varchar(255) DEFAULT NULL,
  `supplier_init` varchar(255) DEFAULT NULL,
  `purchase_init` varchar(255) DEFAULT NULL,
  `purchase_return_init` varchar(255) DEFAULT NULL,
  `customer_init` varchar(255) DEFAULT NULL,
  `sales_init` varchar(255) DEFAULT NULL,
  `sales_return_init` varchar(255) DEFAULT NULL,
  `expense_init` varchar(255) DEFAULT NULL,
  `accounts_init` varchar(255) DEFAULT NULL,
  `journal_init` varchar(255) DEFAULT NULL,
  `cust_advance_init` varchar(255) DEFAULT NULL,
  `quotation_init` varchar(255) DEFAULT NULL,
  `money_transfer_init` varchar(255) DEFAULT NULL,
  `sales_payment_init` varchar(255) DEFAULT NULL,
  `sales_return_payment_init` varchar(255) DEFAULT NULL,
  `purchase_payment_init` varchar(255) DEFAULT NULL,
  `purchase_return_payment_init` varchar(255) DEFAULT NULL,
  `expense_payment_init` varchar(255) DEFAULT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT 0,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_id` varchar(255) DEFAULT NULL,
  `currency_placement` varchar(255) NOT NULL DEFAULT 'left',
  `timezone` varchar(255) DEFAULT NULL,
  `date_format` varchar(255) NOT NULL DEFAULT 'Y-m-d',
  `time_format` varchar(255) NOT NULL DEFAULT 'H:i',
  `default_sales_discount` varchar(255) NOT NULL DEFAULT '0',
  `currencywsymbol_id` bigint(20) UNSIGNED DEFAULT NULL,
  `regno_key` varchar(255) DEFAULT NULL,
  `fav_icon` varchar(255) DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL,
  `change_return` tinyint(1) NOT NULL DEFAULT 0,
  `sales_invoice_format_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pos_invoice_format_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_invoice_footer_text` text DEFAULT NULL,
  `if_serialno` int(11) DEFAULT NULL,
  `if_modelno` int(11) DEFAULT NULL,
  `if_expiry` int(11) DEFAULT NULL,
  `if_batchno` int(11) DEFAULT NULL,
  `round_off` tinyint(1) NOT NULL DEFAULT 0,
  `decimals` int(11) NOT NULL DEFAULT 2,
  `qty_decimals` int(11) NOT NULL DEFAULT 2,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_status` tinyint(1) NOT NULL DEFAULT 0,
  `if_otp` tinyint(1) NOT NULL DEFAULT 0,
  `sms_url` text DEFAULT NULL,
  `if_msg91` tinyint(1) NOT NULL DEFAULT 0,
  `msg91_apikey` varchar(255) DEFAULT NULL,
  `sms_senderid` varchar(255) DEFAULT NULL,
  `sms_dltid` varchar(255) DEFAULT NULL,
  `sms_msg` text DEFAULT NULL,
  `if_cod` tinyint(1) NOT NULL DEFAULT 0,
  `if_pickupatestore` tinyint(1) NOT NULL DEFAULT 0,
  `if_fixeddelivery` tinyint(1) NOT NULL DEFAULT 0,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `if_handlingcharge` tinyint(1) NOT NULL DEFAULT 0,
  `handling_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `signature` varchar(255) DEFAULT NULL,
  `show_signature` tinyint(1) NOT NULL DEFAULT 0,
  `t_and_c_status` tinyint(1) NOT NULL DEFAULT 0,
  `t_and_c_status_pos` tinyint(1) NOT NULL DEFAULT 0,
  `number_to_words` tinyint(1) NOT NULL DEFAULT 0,
  `if_exictiveapp` tinyint(1) NOT NULL DEFAULT 0,
  `if_customerapp` tinyint(1) NOT NULL DEFAULT 0,
  `if_deliveryapp` tinyint(1) NOT NULL DEFAULT 0,
  `if_onesignal` tinyint(1) NOT NULL DEFAULT 0,
  `onesignal_id` varchar(255) DEFAULT NULL,
  `onesignal_key` varchar(255) DEFAULT NULL,
  `current_subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_view` varchar(255) DEFAULT NULL,
  `previous_balancebit` tinyint(1) NOT NULL DEFAULT 0,
  `default_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_app_settings`
--

CREATE TABLE `store_app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `home_block1` varchar(255) NOT NULL,
  `home_block2` varchar(255) NOT NULL,
  `home_block3` varchar(255) NOT NULL,
  `home_block4` varchar(255) NOT NULL,
  `home_block5` varchar(255) NOT NULL,
  `home_block6` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcription_purchase`
--

CREATE TABLE `subcription_purchase` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `package_id` varchar(255) NOT NULL,
  `validity_date` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `if_webpanel` varchar(255) NOT NULL,
  `if_android` varchar(255) NOT NULL,
  `if_ios` varchar(255) NOT NULL,
  `if_windows` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `if_customerapp` varchar(255) NOT NULL,
  `if_deliveryapp` varchar(255) NOT NULL,
  `if_exicutiveapp` varchar(255) NOT NULL,
  `if_multistore` varchar(255) NOT NULL,
  `if_numberof_store` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `cound_id` varchar(255) DEFAULT NULL,
  `supplier_code` varchar(255) DEFAULT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `tax_number` varchar(255) DEFAULT NULL,
  `vatin` varchar(255) DEFAULT NULL,
  `opening_balance` varchar(255) DEFAULT NULL,
  `purchase_due` varchar(255) DEFAULT NULL,
  `purchase_return_due` varchar(255) DEFAULT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `if_group` varchar(255) NOT NULL,
  `subtax_ids` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `parent_id` varchar(255) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_value` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_level` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `user_card` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `count_id` varchar(255) DEFAULT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `current_latitude` varchar(255) DEFAULT NULL,
  `current_longitude` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `expires_at` varchar(255) DEFAULT NULL,
  `mobile_verify` varchar(255) DEFAULT NULL,
  `email_verify` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `ban` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `subcription_id` varchar(255) DEFAULT NULL,
  `subcription_start` varchar(255) DEFAULT NULL,
  `subcription_end` varchar(255) DEFAULT NULL,
  `license_key` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_level`, `store_id`, `name`, `email`, `country_code`, `mobile`, `password`, `whatsapp_no`, `user_card`, `profile_image`, `dob`, `count_id`, `employee_code`, `warehouse_id`, `current_latitude`, `current_longitude`, `zone`, `otp`, `expires_at`, `mobile_verify`, `email_verify`, `status`, `ban`, `created_by`, `subcription_id`, `subcription_start`, `subcription_end`, `license_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(12, 'admin', NULL, 'Admin', 'admin@example.com', NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yBZ3tQHJPYg7SrRtmR6SesGY3UwCYYuMFoJmFxXPQvfSuaqB59pBXexMwv13', '2025-06-18 00:01:47', '2025-06-18 00:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `warehouse_type` varchar(255) NOT NULL,
  `warehouse_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouseitems`
--

CREATE TABLE `warehouseitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `warehouse_id` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `available_qty` varchar(255) NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountsettings`
--
ALTER TABLE `accountsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_accounts`
--
ALTER TABLE `ac_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_moneydeposits`
--
ALTER TABLE `ac_moneydeposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_moneytransfer`
--
ALTER TABLE `ac_moneytransfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_transactions`
--
ALTER TABLE `ac_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_setting`
--
ALTER TABLE `core_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_settings`
--
ALTER TABLE `country_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_advance`
--
ALTER TABLE `customer_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_shippingaddress`
--
ALTER TABLE `customer_shippingaddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_owner_type_owner_id_index` (`owner_type`,`owner_id`);

--
-- Indexes for table `oauth_device_codes`
--
ALTER TABLE `oauth_device_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `oauth_device_codes_user_code_unique` (`user_code`),
  ADD KEY `oauth_device_codes_user_id_index` (`user_id`),
  ADD KEY `oauth_device_codes_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `onesignal_id`
--
ALTER TABLE `onesignal_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_payment`
--
ALTER TABLE `online_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderstatuses`
--
ALTER TABLE `orderstatuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `paymenttypes`
--
ALTER TABLE `paymenttypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_hold`
--
ALTER TABLE `pos_hold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_holditems`
--
ALTER TABLE `pos_holditems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_item_returns`
--
ALTER TABLE `purchase_item_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_payment_returns`
--
ALTER TABLE `purchase_payment_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_item_return`
--
ALTER TABLE `sales_item_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_payments`
--
ALTER TABLE `sales_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_payments_return`
--
ALTER TABLE `sales_payments_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return`
--
ALTER TABLE `sales_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_config`
--
ALTER TABLE `site_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustment`
--
ALTER TABLE `stock_adjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustment_item`
--
ALTER TABLE `stock_adjustment_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfer_item`
--
ALTER TABLE `stock_transfer_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_app_settings`
--
ALTER TABLE `store_app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcription_purchase`
--
ALTER TABLE `subcription_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouseitems`
--
ALTER TABLE `warehouseitems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountsettings`
--
ALTER TABLE `accountsettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ac_accounts`
--
ALTER TABLE `ac_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ac_moneydeposits`
--
ALTER TABLE `ac_moneydeposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ac_moneytransfer`
--
ALTER TABLE `ac_moneytransfer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ac_transactions`
--
ALTER TABLE `ac_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `core_setting`
--
ALTER TABLE `core_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country_settings`
--
ALTER TABLE `country_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_advance`
--
ALTER TABLE `customer_advance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_shippingaddress`
--
ALTER TABLE `customer_shippingaddress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `onesignal_id`
--
ALTER TABLE `onesignal_id`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_payment`
--
ALTER TABLE `online_payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderstatuses`
--
ALTER TABLE `orderstatuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_log`
--
ALTER TABLE `order_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymenttypes`
--
ALTER TABLE `paymenttypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_hold`
--
ALTER TABLE `pos_hold`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_holditems`
--
ALTER TABLE `pos_holditems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_item_returns`
--
ALTER TABLE `purchase_item_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_payment_returns`
--
ALTER TABLE `purchase_payment_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_item_return`
--
ALTER TABLE `sales_item_return`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_payments`
--
ALTER TABLE `sales_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_payments_return`
--
ALTER TABLE `sales_payments_return`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_return`
--
ALTER TABLE `sales_return`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_adjustment`
--
ALTER TABLE `stock_adjustment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustment_item`
--
ALTER TABLE `stock_adjustment_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfer_item`
--
ALTER TABLE `stock_transfer_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_app_settings`
--
ALTER TABLE `store_app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcription_purchase`
--
ALTER TABLE `subcription_purchase`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouseitems`
--
ALTER TABLE `warehouseitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2017 at 08:35 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` varchar(12) NOT NULL COMMENT 'Acocunt ID',
  `type` enum('SAVING','LOAN','SUPPLIER','CANVASSER','BANK','TELLER','GENERAL') NOT NULL COMMENT 'Type',
  `balance` decimal(10,2) NOT NULL COMMENT 'Balance',
  `protection` enum('NONE','PLUS','MINUS','') NOT NULL COMMENT 'Protection'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `type`, `balance`, `protection`) VALUES
('1000000001', 'SAVING', '0.00', 'PLUS'),
('1000000002', 'SAVING', '0.00', 'PLUS'),
('1000000003', 'SAVING', '0.00', 'PLUS'),
('1000000004', 'SAVING', '0.00', 'PLUS'),
('1000000005', 'SAVING', '23.71', 'PLUS'),
('1000000006', 'SAVING', '0.00', 'PLUS'),
('1000000011', 'SAVING', '0.00', 'PLUS'),
('1000000012', 'SAVING', '1500.00', 'PLUS'),
('1000000013', 'SAVING', '0.00', 'PLUS'),
('1000000014', 'SAVING', '0.00', 'PLUS'),
('1000000015', 'SAVING', '20372.45', 'PLUS'),
('1000000016', 'SAVING', '1532.00', 'PLUS'),
('1000000017', 'SAVING', '111.00', 'PLUS'),
('1000000018', 'SAVING', '0.00', 'PLUS'),
('1000000019', 'SAVING', '0.00', 'PLUS'),
('1000000020', 'SAVING', '0.00', 'PLUS'),
('1000000021', 'SAVING', '1122.00', 'PLUS'),
('1000000022', 'SAVING', '0.00', 'PLUS'),
('1000000023', 'SAVING', '0.00', 'PLUS'),
('1000000024', 'SAVING', '29.34', 'PLUS'),
('1000000025', 'SAVING', '0.00', 'PLUS'),
('2000000001', 'LOAN', '0.00', 'MINUS'),
('2000000002', 'LOAN', '0.00', 'MINUS'),
('2000000003', 'LOAN', '0.00', 'MINUS'),
('2000000004', 'LOAN', '0.00', 'MINUS'),
('2000000005', 'LOAN', '-9506.91', 'MINUS'),
('2000000006', 'LOAN', '-1111.00', 'MINUS'),
('2000000011', 'LOAN', '-100000.00', 'MINUS'),
('2000000012', 'LOAN', '-20000.00', 'MINUS'),
('2000000013', 'LOAN', '0.00', 'MINUS'),
('2000000014', 'LOAN', '-100000.00', 'MINUS'),
('2000000015', 'LOAN', '-91312.21', 'MINUS'),
('2000000016', 'LOAN', '-10000.00', 'MINUS'),
('2000000017', 'LOAN', '-10000.00', 'MINUS'),
('2000000018', 'LOAN', '-70000.00', 'MINUS'),
('2000000019', 'LOAN', '-103123.00', 'MINUS'),
('2000000020', 'LOAN', '-101110.00', 'MINUS'),
('2000000021', 'LOAN', '0.00', 'MINUS'),
('2000000022', 'LOAN', '-15000.00', 'MINUS'),
('2000000023', 'LOAN', '-2140.00', 'MINUS'),
('2000000024', 'LOAN', '-1148.06', 'MINUS'),
('2000000025', 'LOAN', '-1000.00', 'MINUS'),
('3000000001', 'SUPPLIER', '2150.00', 'PLUS'),
('3000000002', 'SUPPLIER', '12.22', 'PLUS'),
('4000000001', 'CANVASSER', '2112.22', 'PLUS'),
('7000000001', 'BANK', '10000.00', 'NONE'),
('7000000002', 'BANK', '-14522.00', 'NONE'),
('8000000001', 'TELLER', '-1112919.67', 'MINUS'),
('8000000003', 'TELLER', '0.00', 'MINUS'),
('8000000004', 'TELLER', '0.00', 'MINUS'),
('9000000001', 'GENERAL', '532667.00', 'PLUS'),
('9000000002', 'GENERAL', '-16485.25', 'MINUS'),
('9000000003', 'GENERAL', '2525.17', 'PLUS'),
('9000000004', 'GENERAL', '2628.01', 'PLUS'),
('9000000005', 'GENERAL', '-523.36', 'NONE'),
('9000000006', 'GENERAL', '-600.00', 'MINUS'),
('9000000007', 'GENERAL', '10000.00', 'PLUS');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `description`) VALUES
(1, 'Colombo', 'Area colombo'),
(2, 'Kurunegala', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('loanAuthorizer', 3, 1501438492),
('teller', 3, 1501438524),
('teller', 4, 1501438557),
('usermanager', 3, 1501438492);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/account/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/account/create', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/account/history', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/account/index', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/account/ledger', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/account/update', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/account/view', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/area/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/area/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/area/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/area/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/area/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/area/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/bank-account/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank-account/create', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank-account/delete', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank-account/index', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank-account/update', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank-account/view', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank/create', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank/delete', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank/index', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank/update', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/bank/view', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/canvasser/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/canvasser/create', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/canvasser/index', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/canvasser/update', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/canvasser/view', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/customer/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/customer/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/customer/createnic', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/customer/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/customer/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/customer/removespouse', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/customer/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/customer/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/debug/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/debug/default/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/debug/default/db-explain', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/debug/default/download-mail', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/debug/default/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/debug/default/toolbar', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/debug/default/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/general-account/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/general-account/create', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/general-account/delete', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/general-account/index', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/general-account/update', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/general-account/view', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/gii/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/action', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/diff', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/preview', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/view', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/hp-new-vehicle-loan/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/hp-new-vehicle-loan/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/hp-new-vehicle-loan/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/hp-new-vehicle-loan/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/hp-new-vehicle-loan/set-customer', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/hp-new-vehicle-loan/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/hp-new-vehicle-loan/updatex', 3, NULL, NULL, NULL, 1500105002, 1500105002, NULL),
('/hp-new-vehicle-loan/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/lms/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/cancel', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/loan/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/createx', 3, NULL, NULL, NULL, 1500100589, 1500100589, NULL),
('/loan/customer', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/loan/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/disburse', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/recover', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/remove-customer', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/loan/schedule', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/schedulex', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/loan/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/loan/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/site/*', 3, NULL, NULL, NULL, 1499834414, 1499834414, NULL),
('/site/about', 3, NULL, NULL, NULL, 1499834414, 1499834414, NULL),
('/site/captcha', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/site/contact', 3, NULL, NULL, NULL, 1499834414, 1499834414, NULL),
('/site/error', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/site/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/site/login', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/site/logout', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/supplier/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/supplier/create', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/supplier/index', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/supplier/update', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/supplier/view', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/teller/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/teller/expense-payment', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/teller/expense-receipt', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/teller/payment', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/teller/receipt', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/*', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/bank-to-safe', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/investment', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/manual', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/safe-to-bank', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/safe-to-teller', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/teller-to-safe', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/transaction/view', 3, NULL, NULL, NULL, 1501436819, 1501436819, NULL),
('/user-management/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/auth-item-group/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/bulk-activate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/bulk-deactivate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/bulk-delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/grid-page-size', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/grid-sort', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/toggle-attribute', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth-item-group/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/captcha', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/change-own-password', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/auth/confirm-email', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/confirm-email-receive', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/confirm-registration-email', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/login', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/logout', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/password-recovery', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/password-recovery-receive', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/auth/registration', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/bulk-activate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/bulk-deactivate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/bulk-delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/grid-page-size', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/grid-sort', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/refresh-routes', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/set-child-permissions', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/set-child-routes', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/toggle-attribute', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/permission/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/bulk-activate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/bulk-deactivate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/bulk-delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/grid-page-size', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/grid-sort', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/set-child-permissions', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/set-child-roles', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/toggle-attribute', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/role/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-permission/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-permission/set', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user-permission/set-roles', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user-visit-log/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/bulk-activate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/bulk-deactivate', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/bulk-delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/create', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/delete', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/grid-page-size', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/grid-sort', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/index', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/toggle-attribute', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/update', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user-visit-log/view', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user/*', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user/bulk-activate', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/bulk-deactivate', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/bulk-delete', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/change-password', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/create', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/delete', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/grid-page-size', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/grid-sort', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/toggle-attribute', 3, NULL, NULL, NULL, 1499834415, 1499834415, NULL),
('/user-management/user/update', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/view', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/vehicle-brand/*', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-brand/create', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-brand/delete', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-brand/index', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-brand/update', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-brand/view', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-type/*', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-type/create', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-type/delete', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-type/index', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-type/update', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('/vehicle-type/view', 3, NULL, NULL, NULL, 1500050541, 1500050541, NULL),
('administrator', 2, 'Administrator', NULL, NULL, 1501437426, 1501437426, 'Admin'),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('authorizeLoan', 2, 'Authorize Loan', NULL, NULL, 1500101122, 1500101122, 'loanManagement'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1498749424, 1498749424, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('common', 1, 'Common', NULL, NULL, 1501438685, 1501438685, NULL),
('commonPermission', 2, 'Common permission', NULL, NULL, 1498749424, 1498749424, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('loanAuthorizer', 1, 'Loan Authorizer', NULL, NULL, 1500101050, 1500101050, NULL),
('manageLoans', 2, 'Mange Loans', NULL, NULL, 1500050502, 1500050502, 'loanManagement'),
('site', 2, 'Site Permission', NULL, NULL, 1501438628, 1501438628, 'userCommonPermissions'),
('teller', 1, 'Teller', NULL, NULL, 1500100561, 1500100561, NULL),
('tellerTransactions', 2, 'Teller Transactions', NULL, NULL, 1501436941, 1501436941, 'teller'),
('usermanager', 1, 'Usermanager', NULL, NULL, 1501438432, 1501438432, NULL),
('viewRegistrationIp', 2, 'View registration IP', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('viewUserEmail', 2, 'View user email', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('viewUserRoles', 2, 'View user roles', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('viewUsers', 2, 'View users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('viewVisitLog', 2, 'View visit log', NULL, NULL, 1498749424, 1498749424, 'userManagement');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('administrator', '/account/*'),
('administrator', '/area/*'),
('administrator', '/bank-account/*'),
('administrator', '/bank/*'),
('administrator', '/canvasser/*'),
('administrator', '/customer/*'),
('administrator', '/general-account/*'),
('administrator', '/hp-new-vehicle-loan/*'),
('administrator', '/loan/*'),
('administrator', '/site/*'),
('administrator', '/supplier/*'),
('administrator', '/teller/*'),
('administrator', '/transaction/*'),
('administrator', '/user-management/*'),
('administrator', '/user-management/auth-item-group/*'),
('administrator', '/user-management/auth/*'),
('administrator', '/user-management/permission/*'),
('administrator', '/user-management/role/*'),
('administrator', '/user-management/user-permission/*'),
('administrator', '/user-management/user-visit-log/*'),
('administrator', '/user-management/user/*'),
('administrator', '/vehicle-brand/*'),
('administrator', '/vehicle-type/*'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('assignRolesToUsers', 'viewUserRoles'),
('assignRolesToUsers', 'viewUsers'),
('authorizeLoan', '/loan/disburse'),
('changeOwnPassword', '/user-management/auth/change-own-password'),
('changeUserPassword', '/user-management/user/change-password'),
('changeUserPassword', 'viewUsers'),
('common', 'changeOwnPassword'),
('common', 'site'),
('createUsers', '/user-management/user/create'),
('createUsers', 'viewUsers'),
('deleteUsers', '/user-management/user/bulk-delete'),
('deleteUsers', '/user-management/user/delete'),
('deleteUsers', 'viewUsers'),
('editUserEmail', 'viewUserEmail'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('editUsers', '/user-management/user/update'),
('editUsers', 'viewUsers'),
('loanAuthorizer', 'authorizeLoan'),
('loanAuthorizer', 'common'),
('loanAuthorizer', 'manageLoans'),
('manageLoans', '/account/ledger'),
('manageLoans', '/account/view'),
('manageLoans', '/area/index'),
('manageLoans', '/area/view'),
('manageLoans', '/bank-account/index'),
('manageLoans', '/bank-account/view'),
('manageLoans', '/bank/index'),
('manageLoans', '/bank/view'),
('manageLoans', '/canvasser/*'),
('manageLoans', '/canvasser/create'),
('manageLoans', '/canvasser/index'),
('manageLoans', '/canvasser/update'),
('manageLoans', '/canvasser/view'),
('manageLoans', '/customer/*'),
('manageLoans', '/customer/create'),
('manageLoans', '/customer/createnic'),
('manageLoans', '/customer/index'),
('manageLoans', '/customer/removespouse'),
('manageLoans', '/customer/update'),
('manageLoans', '/customer/view'),
('manageLoans', '/general-account/index'),
('manageLoans', '/general-account/view'),
('manageLoans', '/hp-new-vehicle-loan/create'),
('manageLoans', '/hp-new-vehicle-loan/index'),
('manageLoans', '/hp-new-vehicle-loan/set-customer'),
('manageLoans', '/hp-new-vehicle-loan/update'),
('manageLoans', '/hp-new-vehicle-loan/view'),
('manageLoans', '/loan/cancel'),
('manageLoans', '/loan/create'),
('manageLoans', '/loan/createx'),
('manageLoans', '/loan/customer'),
('manageLoans', '/loan/index'),
('manageLoans', '/loan/recover'),
('manageLoans', '/loan/remove-customer'),
('manageLoans', '/loan/schedule'),
('manageLoans', '/loan/update'),
('manageLoans', '/loan/view'),
('manageLoans', '/supplier/*'),
('manageLoans', '/supplier/create'),
('manageLoans', '/supplier/index'),
('manageLoans', '/supplier/update'),
('manageLoans', '/supplier/view'),
('manageLoans', '/vehicle-brand/index'),
('manageLoans', '/vehicle-brand/view'),
('manageLoans', '/vehicle-type/index'),
('manageLoans', '/vehicle-type/view'),
('site', '/site/*'),
('teller', 'common'),
('teller', 'manageLoans'),
('teller', 'tellerTransactions'),
('tellerTransactions', '/teller/*'),
('tellerTransactions', '/teller/expense-payment'),
('tellerTransactions', '/teller/expense-receipt'),
('tellerTransactions', '/teller/payment'),
('tellerTransactions', '/teller/receipt'),
('tellerTransactions', '/transaction/view'),
('usermanager', 'assignRolesToUsers'),
('usermanager', 'bindUserToIp'),
('usermanager', 'changeUserPassword'),
('usermanager', 'common'),
('usermanager', 'createUsers'),
('usermanager', 'deleteUsers'),
('usermanager', 'editUserEmail'),
('usermanager', 'editUsers'),
('usermanager', 'viewRegistrationIp'),
('usermanager', 'viewUserEmail'),
('usermanager', 'viewUserRoles'),
('usermanager', 'viewUsers'),
('usermanager', 'viewVisitLog'),
('viewUsers', '/user-management/user/grid-page-size'),
('viewUsers', '/user-management/user/index'),
('viewUsers', '/user-management/user/view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_group`
--

CREATE TABLE `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_group`
--

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('Admin', 'Administrator', 1501437330, 1501437330),
('loanManagement', 'Loan Management', 1500050459, 1500050459),
('teller', 'Teller', 1501436910, 1501436910),
('userCommonPermissions', 'User common permission', 1498749424, 1498749424),
('userManagement', 'User management', 1498749424, 1498749424);

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`) VALUES
(1, 'Sampath Bank PLC'),
(2, 'Commercial Bank PLC');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `bank_account_id` varchar(24) NOT NULL,
  `account_id` varchar(10) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`id`, `bank`, `bank_account_id`, `account_id`, `description`) VALUES
(1, 1, '123123', '7000000001', 'sdfdsf'),
(2, 2, '8009899121', '7000000002', 'sdadas');

-- --------------------------------------------------------

--
-- Table structure for table `canvasser`
--

CREATE TABLE `canvasser` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(128) NOT NULL COMMENT 'Name',
  `phone` varchar(16) NOT NULL COMMENT 'Phone',
  `mobile` varchar(16) DEFAULT NULL COMMENT 'Mobile',
  `email` varchar(64) DEFAULT NULL COMMENT 'Email',
  `address` text COMMENT 'Address',
  `status` enum('ACTIVE','INACTIVE') NOT NULL COMMENT 'Status',
  `account` varchar(12) DEFAULT NULL COMMENT 'Account No.',
  `bank` int(11) DEFAULT NULL COMMENT 'Bank',
  `bank_account_name` varchar(128) DEFAULT NULL COMMENT 'Bank Account Name',
  `bank_account` varchar(20) DEFAULT NULL COMMENT 'Bank Account No.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `canvasser`
--

INSERT INTO `canvasser` (`id`, `name`, `phone`, `mobile`, `email`, `address`, `status`, `account`, `bank`, `bank_account_name`, `bank_account`) VALUES
(1, 'Cow Boy', '+94777234321', '+94712332321', 'asd@asd.cs', 'asd', 'ACTIVE', '4000000001', 1, 'aa', '22');

-- --------------------------------------------------------

--
-- Table structure for table `collection_method`
--

CREATE TABLE `collection_method` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL,
  `penal_after` int(11) NOT NULL,
  `penal_after_unit` enum('days','months') NOT NULL,
  `penal` decimal(10,2) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection_method`
--

INSERT INTO `collection_method` (`id`, `name`, `penal_after`, `penal_after_unit`, `penal`, `enabled`) VALUES
(1, 'Monthly', 7, 'days', '3.00', 1),
(2, 'Weekly', 3, 'days', '2.00', 1),
(3, 'Daily', 1, 'days', '1.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL COMMENT 'Client ID',
  `nic` varchar(12) NOT NULL COMMENT 'NIC number',
  `full_name` varchar(256) NOT NULL COMMENT 'Name in full',
  `name` varchar(64) NOT NULL COMMENT 'Name with initials',
  `gender` enum('Male','Female') NOT NULL COMMENT 'Gender',
  `dob` date NOT NULL COMMENT 'Date of birth',
  `area` int(11) NOT NULL COMMENT 'Area',
  `residential_address` text NOT NULL COMMENT 'Residential Address',
  `billing_address` text COMMENT 'Billing Address',
  `phone` varchar(12) DEFAULT NULL COMMENT 'Phone',
  `mobile` varchar(12) DEFAULT NULL COMMENT 'Mobile Phone',
  `email` varchar(64) DEFAULT NULL COMMENT 'Email',
  `occupation` varchar(64) DEFAULT NULL COMMENT 'Occupation',
  `work_address` text COMMENT 'Work Address',
  `work_phone` varchar(12) NOT NULL COMMENT 'Work Phone',
  `work_email` varchar(64) DEFAULT NULL COMMENT 'Work Email',
  `fixed_salary` decimal(10,2) DEFAULT NULL COMMENT 'Fixed Salary',
  `other_incomes` decimal(10,2) DEFAULT NULL COMMENT 'Other Incomes',
  `spouse_id` int(11) DEFAULT NULL COMMENT 'Spouse ID'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nic`, `full_name`, `name`, `gender`, `dob`, `area`, `residential_address`, `billing_address`, `phone`, `mobile`, `email`, `occupation`, `work_address`, `work_phone`, `work_email`, `fixed_salary`, `other_incomes`, `spouse_id`) VALUES
(1, '198636601586', 'Sdfsdfssdf Sdf Sdf Sdf', 'S. S. S. Sdf', 'Male', '1987-10-09', 2, 'asdadasd\r\nasdasda', 'asdasdas\r\ndad', '+94777777777', '', '', '', 'qdawe', '', '', '123.00', '123.00', 1),
(2, '85452515', '112', 'sdfsdf', 'Male', '2017-07-17', 1, 'asd', '', '', '', '', '', '', '12321', '', NULL, NULL, NULL),
(3, '876562123V', 'Rasda', 'asdAEss', 'Female', '1987-06-04', 1, 'asd', '', '12312', '', '', '', '', '', '', NULL, NULL, NULL),
(4, '200158512511', 'Wssa Eras Ass', 'W.E. Ass', 'Female', '2001-03-25', 1, 'Ad\r\nasdasd\r\nasd\r\nasd', '', '+94777102212', '+94777145555', 'sasd@as.fg', '', '', '+94777888555', 'asd@as.s', NULL, NULL, 2),
(5, '251451521V', 'EEEEEEEEEE', 'aAAAA', 'Male', '1925-05-24', 2, 'ASDs', '', '+94777848484', '', '', '', '', '+94777152548', '', NULL, NULL, 2),
(6, '852852012V', 'EEEEEEEYAAAAAAAAAAA', 'asdas', 'Male', '1985-10-11', 1, 'as', '', '+94919922999', '', '', '', '', '', '', NULL, NULL, 2),
(7, '865264124V', 'REEEEEE', 'AS', 'Female', '1986-01-26', 1, 'asd', '', '+94777777777', '', '', '', '', '', '', NULL, NULL, 2),
(8, '852841858V', 'Donkey Monkey', 'D. Monkey', 'Male', '1985-10-10', 1, 'ADAs', '', '+94585454455', '', '', '', '', '', '', NULL, NULL, 9),
(9, '865841252V', 'All Kind Of Genuine Motor Cycle And Threewheelers Sparaparts', 'A. K. O. G. M. C. A. T. Sparaparts', 'Female', '1986-03-24', 1, 'Sdf', '', '+94777777777', '', '', '', '', '', '', '10000.00', '5000.00', NULL),
(10, '852123623V', 'AASDasd', 'asdasasd', 'Male', '1985-07-30', 1, 'sadsa', '', '+94777858585', '', '', '', '', '', '', NULL, NULL, 11),
(11, '896562522V', 'aasdasd', 'asdasdasd', 'Female', '1989-06-04', 1, 'sad', '', '+94777777777', '', '', '', '', '', '', NULL, NULL, 10),
(12, '925452522V', 'sdf sfd sf sd', 'f sdf sdf', 'Female', '1992-02-14', 1, 'sdf sfd', '', '+94222222222', '', '', '', '', '', '', NULL, NULL, NULL),
(13, '862841808V', 'Bulath Puwak Hunu Dunkola', 'B.P.H. Dunkola', 'Male', '1986-10-10', 1, 'Kela para,\r\nPadikkama', '', '+94777102102', '', '', '', '', '', '', NULL, NULL, NULL),
(14, '200154212562', 'Goroki Undiya', 'G. Undiya', 'Female', '2001-02-11', 1, 'Aasadasda\r\nsda\r\nsdasd', '', '+94785756589', '', '', '', '', '', '', NULL, NULL, NULL),
(15, '866740577V', 'Resa Asd AS Asd Asdasdasd', 'R. A. A. A. Asdasdasd', 'Female', '1986-06-22', 1, 'ASDasd', '', '+94777105842', '', '', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `general_account`
--

CREATE TABLE `general_account` (
  `id` varchar(10) NOT NULL COMMENT 'Account ID',
  `name` varchar(32) NOT NULL COMMENT 'Name',
  `description` varchar(128) NOT NULL COMMENT 'Description'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_account`
--

INSERT INTO `general_account` (`id`, `name`, `description`) VALUES
('9000000001', 'PAYABLE', 'Keep payable amount'),
('9000000002', 'SAFE', 'Main Safe'),
('9000000003', 'INTEREST', 'Transfer interest at loan recovery'),
('9000000004', 'PENALTY', 'Transfer penalty at loan recovery'),
('9000000005', 'PARK', 'Intermediate account to divide or merge transaction'),
('9000000006', 'EXPENSES', 'General expenses'),
('9000000007', 'INVESTMENT', 'Company Investment');

-- --------------------------------------------------------

--
-- Table structure for table `hp_new_vehicle_loan`
--

CREATE TABLE `hp_new_vehicle_loan` (
  `id` int(11) NOT NULL COMMENT 'Loan ID',
  `vehicle_type` int(11) NOT NULL COMMENT 'Vehicle Type',
  `vehicle_no` varchar(10) DEFAULT NULL COMMENT 'Vehicle Number',
  `engine_no` varchar(128) NOT NULL COMMENT 'Engine Number',
  `chasis_no` varchar(128) NOT NULL COMMENT 'Chasis Number',
  `model` varchar(128) NOT NULL COMMENT 'Model',
  `make` int(11) NOT NULL COMMENT 'Make/Brand',
  `supplier` int(11) DEFAULT NULL COMMENT 'Supplier',
  `price` decimal(10,2) NOT NULL COMMENT 'Selling Price',
  `loan_amount` decimal(10,2) NOT NULL COMMENT 'Loan Amount',
  `sales_commision_type` enum('Percentage','Amount') NOT NULL COMMENT 'Sales Commission Type',
  `sales_commision` decimal(10,2) DEFAULT '0.00' COMMENT 'Sales Commision',
  `canvassed` int(11) DEFAULT NULL COMMENT 'Canvassed By',
  `canvassing_commision_type` enum('Percentage','Amount') NOT NULL COMMENT 'Canvassing Commission Type',
  `canvassing_commision` decimal(10,2) DEFAULT '0.00' COMMENT 'Canvassing Commision',
  `insurance` decimal(10,2) DEFAULT '0.00' COMMENT 'Insurance Premium',
  `rmv_sent_date` date DEFAULT NULL COMMENT 'RMV Sent Date',
  `rmv_sent_agent` varchar(64) DEFAULT NULL COMMENT 'RMV Sent Agent',
  `rmv_sent_by` varchar(64) DEFAULT NULL COMMENT 'RMV Sent By',
  `rmv_recv_date` date DEFAULT NULL COMMENT 'RMV Received Date',
  `rmv_recv_agent` varchar(64) DEFAULT NULL COMMENT 'RMV Received Agent',
  `rmv_recv_by` varchar(64) DEFAULT NULL COMMENT 'RMV Received By'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_new_vehicle_loan`
--

INSERT INTO `hp_new_vehicle_loan` (`id`, `vehicle_type`, `vehicle_no`, `engine_no`, `chasis_no`, `model`, `make`, `supplier`, `price`, `loan_amount`, `sales_commision_type`, `sales_commision`, `canvassed`, `canvassing_commision_type`, `canvassing_commision`, `insurance`, `rmv_sent_date`, `rmv_sent_agent`, `rmv_sent_by`, `rmv_recv_date`, `rmv_recv_agent`, `rmv_recv_by`) VALUES
(7, 1, '', '12', '1', '1', 1, 12, '111.00', '111.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '11.00', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, '', '1', '1', 'edas', 2, NULL, '11.00', '10.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, '', '1', '1', 'edas', 2, NULL, '1000.00', '560.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '0.00', '2017-07-25', 'AASD', 'ASD', '2017-07-29', 'dsa', 'ds'),
(10, 1, '', '1', '1', 'edas', 2, NULL, '11.00', '10.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, '', '111', '111', '2251', 2, NULL, '100000.00', '100000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '100.00', NULL, '', '', NULL, '', ''),
(12, 1, '2323', '12', '12', '11', 1, NULL, '100000.00', '20000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '1000.00', NULL, '', '', NULL, '', ''),
(13, 1, '', '123', '123', '121', 1, NULL, '100000.00', '100000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '1000.00', NULL, '', '', NULL, '', ''),
(14, 1, '', '123', '123', 'fd', 1, NULL, '100000.00', '100000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '122.00', NULL, '', '', NULL, '', ''),
(15, 1, '', '221', '12', '121', 6, NULL, '121112.00', '100000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '12.00', NULL, '', '', NULL, '', ''),
(16, 1, '', '12', 'sdf', '112', 2, NULL, '10000.00', '10000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '100.00', NULL, '', '', '2017-07-20', '', ''),
(17, 1, '444', '222', '333', '111', 8, NULL, '20000.00', '10000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '900.00', '2017-07-10', '', '', NULL, '', ''),
(18, 1, 'CAX 7585', 'werwer', '324234', '234', 1, NULL, '100000.00', '70000.00', 'Percentage', '1000.00', NULL, 'Percentage', NULL, '1000.00', NULL, '', '', NULL, '', ''),
(19, 1, '', '2', '2', '11', 1, 1, '100000.00', '100000.00', 'Percentage', '2.00', 1, 'Percentage', '1.00', '100.00', NULL, '', '', NULL, '', ''),
(20, 1, '', '234', '234', '232', 3, 1, '100000.00', '100000.00', 'Amount', '110.00', 1, 'Percentage', '1.00', '100.00', NULL, '', '', NULL, '', ''),
(21, 1, '', '12', '12', '12', 1, 0, '20000.00', '15000.00', 'Percentage', NULL, 1, 'Percentage', '2.00', '2000.00', NULL, '', '', NULL, '', ''),
(22, 1, '', '12', '12', '12', 1, 0, '20000.00', '15000.00', 'Percentage', NULL, 0, 'Percentage', '2.50', '2000.00', NULL, '', '', NULL, '', ''),
(23, 1, '', '1', '23', '12', 2, 1, '1112.00', '2000.00', 'Percentage', '2.00', 1, 'Amount', '100.00', '2232.00', NULL, '', '', NULL, '', ''),
(24, 2, '', '232', '123', '12', 3, 2, '1111.00', '1222.00', 'Percentage', '1.00', 1, 'Percentage', '1.00', '2222.00', NULL, '', '', NULL, '', ''),
(25, 2, '', '1ad', 'asd', 'aas', 2, NULL, '1222.00', '1000.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '121.00', NULL, '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL COMMENT 'Loan ID',
  `type` int(11) NOT NULL COMMENT 'Loan Type',
  `customer_id` int(11) NOT NULL COMMENT 'Customer ID',
  `saving_account` varchar(12) DEFAULT NULL COMMENT 'Saving Account',
  `loan_account` varchar(12) DEFAULT NULL COMMENT 'Loan Account',
  `amount` decimal(10,2) NOT NULL COMMENT 'Amount',
  `interest` decimal(10,2) NOT NULL COMMENT 'Interest',
  `penalty` decimal(10,2) NOT NULL,
  `charges` decimal(10,2) NOT NULL COMMENT 'Charges',
  `collection_method` int(11) NOT NULL COMMENT 'Collection Method',
  `period` int(11) NOT NULL COMMENT 'Period',
  `status` enum('PENDING','ACTIVE','COMPLETED','CLOSED') NOT NULL DEFAULT 'PENDING' COMMENT 'Status',
  `disbursed_date` date DEFAULT NULL COMMENT 'Disbursed Date',
  `closed_date` date DEFAULT NULL COMMENT 'Closed Date',
  `installment` decimal(10,2) DEFAULT NULL COMMENT 'Installment',
  `total_interest` decimal(10,2) DEFAULT NULL COMMENT 'Total Interest',
  `total_payment` decimal(10,2) DEFAULT NULL COMMENT 'Total Payment',
  `guarantor_1` int(11) DEFAULT NULL COMMENT 'Guarantor 1',
  `guarantor_2` int(11) DEFAULT NULL COMMENT 'Guarantor 2',
  `guarantor_3` int(11) DEFAULT NULL COMMENT 'Guarantor 3',
  `paid` int(11) NOT NULL DEFAULT '0' COMMENT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `type`, `customer_id`, `saving_account`, `loan_account`, `amount`, `interest`, `penalty`, `charges`, `collection_method`, `period`, `status`, `disbursed_date`, `closed_date`, `installment`, `total_interest`, `total_payment`, `guarantor_1`, `guarantor_2`, `guarantor_3`, `paid`) VALUES
(1, 1, 1, '1000000001', '2000000001', '1000.00', '0.00', '3.00', '0.00', 1, 12, 'PENDING', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 1, 1, '1000000002', '2000000002', '2000.00', '0.00', '5.00', '0.00', 2, 36, 'PENDING', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 1, 1, '1000000003', '2000000003', '1000.00', '0.00', '10.00', '0.00', 1, 12, 'PENDING', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 1, 1, '1000000004', '2000000004', '1223.00', '12.24', '10.00', '1232.00', 1, 12, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 1, 1, '1000000005', '2000000005', '1000.00', '12.00', '10.00', '100.00', 1, 60, 'ACTIVE', '2017-07-02', NULL, '23.90', '434.40', '1434.40', NULL, NULL, NULL, 0),
(6, 1, 1, '1000000006', '2000000006', '1111.00', '11.00', '10.00', '11.00', 2, 12, 'ACTIVE', '2017-07-02', NULL, '94.77', '26.32', '1137.32', NULL, NULL, NULL, 0),
(7, 1, 1, NULL, NULL, '111.00', '11.00', '0.00', '0.00', 1, 36, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, 1, 1, NULL, NULL, '10.00', '1.00', '0.00', '0.00', 1, 1, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 1, 1, NULL, NULL, '560.00', '1.00', '0.00', '0.00', 1, 36, 'ACTIVE', '2017-07-14', NULL, '15.79', '8.44', '568.44', 4, NULL, NULL, 0),
(10, 1, 1, NULL, NULL, '10.00', '1.00', '0.00', '0.00', 1, 1, 'ACTIVE', '2017-07-14', NULL, '10.00', '0.00', '10.00', 9, NULL, NULL, 0),
(11, 1, 9, '1000000011', '2000000011', '100000.00', '12.00', '0.00', '0.00', 1, 12, 'ACTIVE', '2017-07-15', NULL, '8884.87', '6618.44', '106618.44', NULL, NULL, NULL, 0),
(12, 1, 9, '1000000012', '2000000012', '20000.00', '12.00', '0.00', '0.00', 1, 12, 'ACTIVE', '2017-07-15', NULL, '1776.97', '1323.64', '21323.64', NULL, NULL, NULL, 0),
(13, 1, 13, '1000000013', '2000000013', '100000.00', '12.00', '0.00', '0.00', 1, 12, 'ACTIVE', '2017-07-15', NULL, '8884.87', '6618.44', '106618.44', NULL, NULL, NULL, 0),
(14, 1, 10, '1000000014', '2000000014', '100000.00', '12.00', '0.00', '0.00', 1, 12, 'ACTIVE', '2017-07-15', NULL, '8884.87', '6618.44', '106618.44', NULL, NULL, NULL, 0),
(15, 1, 13, '1000000015', '2000000015', '100000.00', '10.00', '0.00', '0.00', 1, 24, 'ACTIVE', '2017-07-15', NULL, '4614.49', '10747.76', '110747.76', NULL, NULL, NULL, 0),
(16, 1, 9, '1000000016', '2000000016', '10000.00', '12.00', '0.00', '0.00', 1, 12, 'ACTIVE', '2017-07-16', NULL, '888.48', '661.76', '10661.76', NULL, NULL, NULL, 0),
(17, 1, 9, '1000000017', '2000000017', '10000.00', '12.00', '0.00', '0.00', 1, 12, 'ACTIVE', '2017-07-15', NULL, '888.48', '661.76', '10661.76', NULL, NULL, NULL, 0),
(18, 1, 15, '1000000018', '2000000018', '70000.00', '12.00', '0.00', '1000.00', 1, 36, 'ACTIVE', '2017-07-16', NULL, '2352.77', '14700.00', '84700.00', NULL, NULL, NULL, 0),
(19, 1, 9, '1000000019', '2000000019', '100000.00', '12.00', '3.00', '3000.00', 1, 36, 'ACTIVE', '2017-07-17', NULL, '3404.76', '22571.48', '122571.48', NULL, NULL, NULL, 0),
(20, 1, 9, '1000000020', '2000000020', '100000.00', '12.00', '0.00', '1110.00', 1, 36, 'ACTIVE', '2017-07-18', NULL, '3352.26', '20681.48', '120681.48', NULL, NULL, NULL, 1),
(21, 1, 9, '1000000021', '2000000021', '15000.00', '10.00', '3.00', '300.00', 1, 6, 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(22, 1, 9, '1000000022', '2000000022', '15000.00', '10.00', '3.00', '0.00', 1, 6, 'ACTIVE', '2017-07-30', NULL, '2573.42', '440.52', '15440.52', NULL, NULL, NULL, 0),
(23, 1, 9, '1000000023', '2000000023', '2000.00', '12.00', '3.00', '140.00', 1, 36, 'ACTIVE', '2017-07-30', NULL, '70.30', '531.12', '2531.12', NULL, NULL, NULL, 0),
(24, 1, 9, '1000000024', '2000000024', '1222.00', '12.00', '3.00', '24.44', 1, 12, 'ACTIVE', '2017-05-04', NULL, '110.60', '105.28', '1327.28', NULL, NULL, NULL, 0),
(25, 2, 5, '1000000025', '2000000025', '1000.00', '12.00', '3.00', '0.00', 1, 6, 'ACTIVE', '2017-07-30', NULL, '172.54', '35.24', '1035.24', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedule`
--

CREATE TABLE `loan_schedule` (
  `loan_id` int(11) NOT NULL COMMENT 'Loan ID',
  `installment_id` int(11) NOT NULL COMMENT 'Installment ID',
  `status` enum('PENDING','DEMANDED','ARREARS','PAYED') NOT NULL COMMENT 'Status',
  `demand_date` date NOT NULL COMMENT 'Demand Date',
  `principal` decimal(10,2) NOT NULL COMMENT 'Principal',
  `interest` decimal(10,2) NOT NULL COMMENT 'Interest',
  `charges` decimal(10,2) NOT NULL COMMENT 'Charges',
  `arrears` int(11) NOT NULL,
  `penalty` decimal(10,2) NOT NULL COMMENT 'Penalty',
  `paid` decimal(10,2) NOT NULL COMMENT 'Paid',
  `due` decimal(10,2) NOT NULL COMMENT 'Due',
  `balance` decimal(10,2) NOT NULL COMMENT 'Balance'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_schedule`
--

INSERT INTO `loan_schedule` (`loan_id`, `installment_id`, `status`, `demand_date`, `principal`, `interest`, `charges`, `arrears`, `penalty`, `paid`, `due`, `balance`) VALUES
(5, 1, 'PAYED', '2017-08-02', '12.24', '10.00', '1.66', 0, '0.00', '23.90', '0.00', '987.76'),
(5, 2, 'PAYED', '2017-09-02', '12.36', '9.88', '1.66', 3, '7.41', '31.31', '0.00', '975.40'),
(5, 3, 'PAYED', '2017-10-02', '12.49', '9.75', '1.66', 2, '4.78', '28.68', '0.00', '962.91'),
(5, 4, 'PAYED', '2017-11-02', '12.61', '9.63', '1.66', 1, '2.39', '26.29', '0.00', '950.30'),
(5, 5, 'PAYED', '2017-12-02', '12.74', '9.50', '1.66', 1, '2.39', '26.29', '0.00', '937.56'),
(5, 6, 'PAYED', '2018-01-02', '12.86', '9.38', '1.66', 0, '0.00', '23.90', '0.00', '924.70'),
(5, 7, 'PAYED', '2018-02-02', '12.99', '9.25', '1.66', 0, '0.00', '23.90', '0.00', '911.71'),
(5, 8, 'PAYED', '2018-03-02', '13.12', '9.12', '1.66', 1, '2.39', '26.29', '0.00', '898.59'),
(5, 9, 'PAYED', '2018-04-02', '13.25', '8.99', '1.66', 0, '0.00', '23.90', '0.00', '885.34'),
(5, 10, 'PAYED', '2018-05-02', '13.39', '8.85', '1.66', 2, '0.20', '24.10', '0.00', '871.95'),
(5, 11, 'ARREARS', '2018-06-02', '13.52', '8.72', '1.66', 1, '2.39', '2.39', '23.90', '858.43'),
(5, 12, 'PENDING', '2018-07-02', '13.66', '8.58', '1.66', 0, '0.00', '0.00', '0.00', '844.77'),
(5, 13, 'PENDING', '2018-08-02', '13.79', '8.45', '1.66', 0, '0.00', '0.00', '0.00', '830.98'),
(5, 14, 'PENDING', '2018-09-02', '13.93', '8.31', '1.66', 0, '0.00', '0.00', '0.00', '817.05'),
(5, 15, 'PENDING', '2018-10-02', '14.07', '8.17', '1.66', 0, '0.00', '0.00', '0.00', '802.98'),
(5, 16, 'PENDING', '2018-11-02', '14.21', '8.03', '1.66', 0, '0.00', '0.00', '0.00', '788.77'),
(5, 17, 'PENDING', '2018-12-02', '14.35', '7.89', '1.66', 0, '0.00', '0.00', '0.00', '774.42'),
(5, 18, 'PENDING', '2019-01-02', '14.50', '7.74', '1.66', 0, '0.00', '0.00', '0.00', '759.92'),
(5, 19, 'PENDING', '2019-02-02', '14.64', '7.60', '1.66', 0, '0.00', '0.00', '0.00', '745.28'),
(5, 20, 'PENDING', '2019-03-02', '14.79', '7.45', '1.66', 0, '0.00', '0.00', '0.00', '730.49'),
(5, 21, 'PENDING', '2019-04-02', '14.94', '7.30', '1.66', 0, '0.00', '0.00', '0.00', '715.55'),
(5, 22, 'PENDING', '2019-05-02', '15.08', '7.16', '1.66', 0, '0.00', '0.00', '0.00', '700.47'),
(5, 23, 'PENDING', '2019-06-02', '15.24', '7.00', '1.66', 0, '0.00', '0.00', '0.00', '685.23'),
(5, 24, 'PENDING', '2019-07-02', '15.39', '6.85', '1.66', 0, '0.00', '0.00', '0.00', '669.84'),
(5, 25, 'PENDING', '2019-08-02', '15.54', '6.70', '1.66', 0, '0.00', '0.00', '0.00', '654.30'),
(5, 26, 'PENDING', '2019-09-02', '15.70', '6.54', '1.66', 0, '0.00', '0.00', '0.00', '638.60'),
(5, 27, 'PENDING', '2019-10-02', '15.85', '6.39', '1.66', 0, '0.00', '0.00', '0.00', '622.75'),
(5, 28, 'PENDING', '2019-11-02', '16.01', '6.23', '1.66', 0, '0.00', '0.00', '0.00', '606.74'),
(5, 29, 'PENDING', '2019-12-02', '16.17', '6.07', '1.66', 0, '0.00', '0.00', '0.00', '590.57'),
(5, 30, 'PENDING', '2020-01-02', '16.33', '5.91', '1.66', 0, '0.00', '0.00', '0.00', '574.24'),
(5, 31, 'PENDING', '2020-02-02', '16.50', '5.74', '1.66', 0, '0.00', '0.00', '0.00', '557.74'),
(5, 32, 'PENDING', '2020-03-02', '16.66', '5.58', '1.66', 0, '0.00', '0.00', '0.00', '541.08'),
(5, 33, 'PENDING', '2020-04-02', '16.83', '5.41', '1.66', 0, '0.00', '0.00', '0.00', '524.25'),
(5, 34, 'PENDING', '2020-05-02', '17.00', '5.24', '1.66', 0, '0.00', '0.00', '0.00', '507.25'),
(5, 35, 'PENDING', '2020-06-02', '17.17', '5.07', '1.66', 0, '0.00', '0.00', '0.00', '490.08'),
(5, 36, 'PENDING', '2020-07-02', '17.34', '4.90', '1.66', 0, '0.00', '0.00', '0.00', '472.74'),
(5, 37, 'PENDING', '2020-08-02', '17.51', '4.73', '1.66', 0, '0.00', '0.00', '0.00', '455.23'),
(5, 38, 'PENDING', '2020-09-02', '17.69', '4.55', '1.66', 0, '0.00', '0.00', '0.00', '437.54'),
(5, 39, 'PENDING', '2020-10-02', '17.86', '4.38', '1.66', 0, '0.00', '0.00', '0.00', '419.68'),
(5, 40, 'PENDING', '2020-11-02', '18.04', '4.20', '1.66', 0, '0.00', '0.00', '0.00', '401.64'),
(5, 41, 'PENDING', '2020-12-02', '18.22', '4.02', '1.66', 0, '0.00', '0.00', '0.00', '383.42'),
(5, 42, 'PENDING', '2021-01-02', '18.41', '3.83', '1.66', 0, '0.00', '0.00', '0.00', '365.01'),
(5, 43, 'PENDING', '2021-02-02', '18.59', '3.65', '1.66', 0, '0.00', '0.00', '0.00', '346.42'),
(5, 44, 'PENDING', '2021-03-02', '18.78', '3.46', '1.66', 0, '0.00', '0.00', '0.00', '327.64'),
(5, 45, 'PENDING', '2021-04-02', '18.96', '3.28', '1.66', 0, '0.00', '0.00', '0.00', '308.68'),
(5, 46, 'PENDING', '2021-05-02', '19.15', '3.09', '1.66', 0, '0.00', '0.00', '0.00', '289.53'),
(5, 47, 'PENDING', '2021-06-02', '19.34', '2.90', '1.66', 0, '0.00', '0.00', '0.00', '270.19'),
(5, 48, 'PENDING', '2021-07-02', '19.54', '2.70', '1.66', 0, '0.00', '0.00', '0.00', '250.65'),
(5, 49, 'PENDING', '2021-08-02', '19.73', '2.51', '1.66', 0, '0.00', '0.00', '0.00', '230.92'),
(5, 50, 'PENDING', '2021-09-02', '19.93', '2.31', '1.66', 0, '0.00', '0.00', '0.00', '210.99'),
(5, 51, 'PENDING', '2021-10-02', '20.13', '2.11', '1.66', 0, '0.00', '0.00', '0.00', '190.86'),
(5, 52, 'PENDING', '2021-11-02', '20.33', '1.91', '1.66', 0, '0.00', '0.00', '0.00', '170.53'),
(5, 53, 'PENDING', '2021-12-02', '20.53', '1.71', '1.66', 0, '0.00', '0.00', '0.00', '150.00'),
(5, 54, 'PENDING', '2022-01-02', '20.74', '1.50', '1.66', 0, '0.00', '0.00', '0.00', '129.26'),
(5, 55, 'PENDING', '2022-02-02', '20.95', '1.29', '1.66', 0, '0.00', '0.00', '0.00', '108.31'),
(5, 56, 'PENDING', '2022-03-02', '21.16', '1.08', '1.66', 0, '0.00', '0.00', '0.00', '87.15'),
(5, 57, 'PENDING', '2022-04-02', '21.37', '0.87', '1.66', 0, '0.00', '0.00', '0.00', '65.78'),
(5, 58, 'PENDING', '2022-05-02', '21.58', '0.66', '1.66', 0, '0.00', '0.00', '0.00', '44.20'),
(5, 59, 'PENDING', '2022-06-02', '21.80', '0.44', '1.66', 0, '0.00', '0.00', '0.00', '22.40'),
(5, 60, 'PENDING', '2022-07-02', '22.40', '-0.56', '2.06', 0, '0.00', '0.00', '0.00', '0.00'),
(6, 1, 'PAYED', '2017-07-09', '91.51', '2.35', '0.91', 3, '31.38', '0.00', '0.00', '1019.49'),
(6, 2, 'PAYED', '2017-07-16', '91.51', '2.35', '0.91', 2, '19.91', '0.00', '0.00', '1019.49'),
(6, 3, 'PAYED', '2017-07-23', '91.51', '2.35', '0.91', 1, '9.48', '0.00', '0.00', '1019.49'),
(6, 4, 'PAYED', '2017-07-30', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 5, 'PENDING', '2017-08-06', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 6, 'PENDING', '2017-08-13', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 7, 'PENDING', '2017-08-20', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 8, 'PENDING', '2017-08-27', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 9, 'PENDING', '2017-09-03', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 10, 'PENDING', '2017-09-10', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 11, 'PENDING', '2017-09-17', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(6, 12, 'PENDING', '2017-09-24', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49'),
(14, 1, 'PENDING', '2017-08-15', '7884.87', '1000.00', '0.00', 0, '0.00', '0.00', '0.00', '92115.13'),
(14, 2, 'PENDING', '2017-09-15', '7963.72', '921.15', '0.00', 0, '0.00', '0.00', '0.00', '84151.41'),
(14, 3, 'PENDING', '2017-10-15', '8043.36', '841.51', '0.00', 0, '0.00', '0.00', '0.00', '76108.05'),
(14, 4, 'PENDING', '2017-11-15', '8123.79', '761.08', '0.00', 0, '0.00', '0.00', '0.00', '67984.26'),
(14, 5, 'PENDING', '2017-12-15', '8205.03', '679.84', '0.00', 0, '0.00', '0.00', '0.00', '59779.23'),
(14, 6, 'PENDING', '2018-01-15', '8287.08', '597.79', '0.00', 0, '0.00', '0.00', '0.00', '51492.15'),
(14, 7, 'PENDING', '2018-02-15', '8369.95', '514.92', '0.00', 0, '0.00', '0.00', '0.00', '43122.20'),
(14, 8, 'PENDING', '2018-03-15', '8453.65', '431.22', '0.00', 0, '0.00', '0.00', '0.00', '34668.55'),
(14, 9, 'PENDING', '2018-04-15', '8538.18', '346.69', '0.00', 0, '0.00', '0.00', '0.00', '26130.37'),
(14, 10, 'PENDING', '2018-05-15', '8623.57', '261.30', '0.00', 0, '0.00', '0.00', '0.00', '17506.80'),
(14, 11, 'PENDING', '2018-06-15', '8709.80', '175.07', '0.00', 0, '0.00', '0.00', '0.00', '8797.00'),
(14, 12, 'PENDING', '2018-07-15', '8797.00', '87.87', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(15, 1, 'PAYED', '2017-08-15', '3781.16', '833.33', '0.00', 5, '734.97', '5349.46', '0.00', '96218.84'),
(15, 2, 'ARREARS', '2017-09-15', '3812.67', '801.82', '0.00', 4, '579.16', '579.16', '4614.49', '92406.17'),
(15, 3, 'ARREARS', '2017-10-15', '3844.44', '770.05', '0.00', 3, '427.89', '427.89', '4614.49', '88561.73'),
(15, 4, 'ARREARS', '2017-11-15', '3876.48', '738.01', '0.00', 2, '281.02', '281.02', '4614.49', '84685.25'),
(15, 5, 'ARREARS', '2017-12-15', '3908.78', '705.71', '0.00', 1, '138.43', '138.43', '4614.49', '80776.47'),
(15, 6, 'DEMANDED', '2018-01-15', '3941.35', '673.14', '0.00', 0, '0.00', '0.00', '4614.49', '76835.12'),
(15, 7, 'PENDING', '2018-02-15', '3974.20', '640.29', '0.00', 0, '0.00', '0.00', '0.00', '72860.92'),
(15, 8, 'PENDING', '2018-03-15', '4007.32', '607.17', '0.00', 0, '0.00', '0.00', '0.00', '68853.60'),
(15, 9, 'PENDING', '2018-04-15', '4040.71', '573.78', '0.00', 0, '0.00', '0.00', '0.00', '64812.89'),
(15, 10, 'PENDING', '2018-05-15', '4074.38', '540.11', '0.00', 0, '0.00', '0.00', '0.00', '60738.51'),
(15, 11, 'PENDING', '2018-06-15', '4108.34', '506.15', '0.00', 0, '0.00', '0.00', '0.00', '56630.17'),
(15, 12, 'PENDING', '2018-07-15', '4142.57', '471.92', '0.00', 0, '0.00', '0.00', '0.00', '52487.60'),
(15, 13, 'PENDING', '2018-08-15', '4177.09', '437.40', '0.00', 0, '0.00', '0.00', '0.00', '48310.51'),
(15, 14, 'PENDING', '2018-09-15', '4211.90', '402.59', '0.00', 0, '0.00', '0.00', '0.00', '44098.61'),
(15, 15, 'PENDING', '2018-10-15', '4247.00', '367.49', '0.00', 0, '0.00', '0.00', '0.00', '39851.61'),
(15, 16, 'PENDING', '2018-11-15', '4282.39', '332.10', '0.00', 0, '0.00', '0.00', '0.00', '35569.22'),
(15, 17, 'PENDING', '2018-12-15', '4318.08', '296.41', '0.00', 0, '0.00', '0.00', '0.00', '31251.14'),
(15, 18, 'PENDING', '2019-01-15', '4354.06', '260.43', '0.00', 0, '0.00', '0.00', '0.00', '26897.08'),
(15, 19, 'PENDING', '2019-02-15', '4390.35', '224.14', '0.00', 0, '0.00', '0.00', '0.00', '22506.73'),
(15, 20, 'PENDING', '2019-03-15', '4426.93', '187.56', '0.00', 0, '0.00', '0.00', '0.00', '18079.80'),
(15, 21, 'PENDING', '2019-04-15', '4463.82', '150.67', '0.00', 0, '0.00', '0.00', '0.00', '13615.98'),
(15, 22, 'PENDING', '2019-05-15', '4501.02', '113.47', '0.00', 0, '0.00', '0.00', '0.00', '9114.96'),
(15, 23, 'PENDING', '2019-06-15', '4538.53', '75.96', '0.00', 0, '0.00', '0.00', '0.00', '4576.43'),
(15, 24, 'PENDING', '2019-07-15', '4576.43', '38.06', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(16, 1, 'PENDING', '2017-08-16', '788.48', '100.00', '0.00', 0, '0.00', '0.00', '0.00', '9211.52'),
(16, 2, 'PENDING', '2017-09-16', '796.36', '92.12', '0.00', 0, '0.00', '0.00', '0.00', '8415.16'),
(16, 3, 'PENDING', '2017-10-16', '804.33', '84.15', '0.00', 0, '0.00', '0.00', '0.00', '7610.83'),
(16, 4, 'PENDING', '2017-11-16', '812.37', '76.11', '0.00', 0, '0.00', '0.00', '0.00', '6798.46'),
(16, 5, 'PENDING', '2017-12-16', '820.50', '67.98', '0.00', 0, '0.00', '0.00', '0.00', '5977.96'),
(16, 6, 'PENDING', '2018-01-16', '828.70', '59.78', '0.00', 0, '0.00', '0.00', '0.00', '5149.26'),
(16, 7, 'PENDING', '2018-02-16', '836.99', '51.49', '0.00', 0, '0.00', '0.00', '0.00', '4312.27'),
(16, 8, 'PENDING', '2018-03-16', '845.36', '43.12', '0.00', 0, '0.00', '0.00', '0.00', '3466.91'),
(16, 9, 'PENDING', '2018-04-16', '853.81', '34.67', '0.00', 0, '0.00', '0.00', '0.00', '2613.10'),
(16, 10, 'PENDING', '2018-05-16', '862.35', '26.13', '0.00', 0, '0.00', '0.00', '0.00', '1750.75'),
(16, 11, 'PENDING', '2018-06-16', '870.97', '17.51', '0.00', 0, '0.00', '0.00', '0.00', '879.78'),
(16, 12, 'PENDING', '2018-07-16', '879.78', '8.70', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(17, 1, 'PAYED', '2017-08-15', '788.48', '100.00', '0.00', 6, '26.65', '915.13', '0.00', '9211.52'),
(17, 2, 'PAYED', '2017-09-15', '796.36', '92.12', '0.00', 5, '26.65', '915.13', '0.00', '8415.16'),
(17, 3, 'ARREARS', '2017-10-15', '804.33', '84.15', '0.00', 4, '26.65', '26.65', '888.48', '7610.83'),
(17, 4, 'ARREARS', '2017-11-15', '812.37', '76.11', '0.00', 3, '26.65', '26.65', '888.48', '6798.46'),
(17, 5, 'ARREARS', '2017-12-15', '820.50', '67.98', '0.00', 2, '26.65', '26.65', '888.48', '5977.96'),
(17, 6, 'ARREARS', '2018-01-15', '828.70', '59.78', '0.00', 1, '26.65', '26.65', '888.48', '5149.26'),
(17, 7, 'PENDING', '2018-02-15', '836.99', '51.49', '0.00', 0, '0.00', '0.00', '0.00', '4312.27'),
(17, 8, 'PENDING', '2018-03-15', '845.36', '43.12', '0.00', 0, '0.00', '0.00', '0.00', '3466.91'),
(17, 9, 'PENDING', '2018-04-15', '853.81', '34.67', '0.00', 0, '0.00', '0.00', '0.00', '2613.10'),
(17, 10, 'PENDING', '2018-05-15', '862.35', '26.13', '0.00', 0, '0.00', '0.00', '0.00', '1750.75'),
(17, 11, 'PENDING', '2018-06-15', '870.97', '17.51', '0.00', 0, '0.00', '0.00', '0.00', '879.78'),
(17, 12, 'PENDING', '2018-07-15', '879.78', '8.70', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(18, 1, 'PAYED', '2017-08-16', '1625.00', '700.00', '27.77', 2, '143.28', '2496.05', '0.00', '68375.00'),
(18, 2, 'PAYED', '2017-09-16', '1641.25', '683.75', '27.77', 1, '70.58', '2423.35', '0.00', '66733.75'),
(18, 3, 'PENDING', '2017-10-16', '1657.66', '667.34', '27.77', 0, '0.00', '0.00', '0.00', '65076.09'),
(18, 4, 'PENDING', '2017-11-16', '1674.24', '650.76', '27.77', 0, '0.00', '0.00', '0.00', '63401.85'),
(18, 5, 'PENDING', '2017-12-16', '1690.98', '634.02', '27.77', 0, '0.00', '0.00', '0.00', '61710.87'),
(18, 6, 'PENDING', '2018-01-16', '1707.89', '617.11', '27.77', 0, '0.00', '0.00', '0.00', '60002.98'),
(18, 7, 'PENDING', '2018-02-16', '1724.97', '600.03', '27.77', 0, '0.00', '0.00', '0.00', '58278.01'),
(18, 8, 'PENDING', '2018-03-16', '1742.22', '582.78', '27.77', 0, '0.00', '0.00', '0.00', '56535.79'),
(18, 9, 'PENDING', '2018-04-16', '1759.64', '565.36', '27.77', 0, '0.00', '0.00', '0.00', '54776.15'),
(18, 10, 'PENDING', '2018-05-16', '1777.24', '547.76', '27.77', 0, '0.00', '0.00', '0.00', '52998.91'),
(18, 11, 'PENDING', '2018-06-16', '1795.01', '529.99', '27.77', 0, '0.00', '0.00', '0.00', '51203.90'),
(18, 12, 'PENDING', '2018-07-16', '1812.96', '512.04', '27.77', 0, '0.00', '0.00', '0.00', '49390.94'),
(18, 13, 'PENDING', '2018-08-16', '1831.09', '493.91', '27.77', 0, '0.00', '0.00', '0.00', '47559.85'),
(18, 14, 'PENDING', '2018-09-16', '1849.40', '475.60', '27.77', 0, '0.00', '0.00', '0.00', '45710.45'),
(18, 15, 'PENDING', '2018-10-16', '1867.90', '457.10', '27.77', 0, '0.00', '0.00', '0.00', '43842.55'),
(18, 16, 'PENDING', '2018-11-16', '1886.57', '438.43', '27.77', 0, '0.00', '0.00', '0.00', '41955.98'),
(18, 17, 'PENDING', '2018-12-16', '1905.44', '419.56', '27.77', 0, '0.00', '0.00', '0.00', '40050.54'),
(18, 18, 'PENDING', '2019-01-16', '1924.49', '400.51', '27.77', 0, '0.00', '0.00', '0.00', '38126.05'),
(18, 19, 'PENDING', '2019-02-16', '1943.74', '381.26', '27.77', 0, '0.00', '0.00', '0.00', '36182.31'),
(18, 20, 'PENDING', '2019-03-16', '1963.18', '361.82', '27.77', 0, '0.00', '0.00', '0.00', '34219.13'),
(18, 21, 'PENDING', '2019-04-16', '1982.81', '342.19', '27.77', 0, '0.00', '0.00', '0.00', '32236.32'),
(18, 22, 'PENDING', '2019-05-16', '2002.64', '322.36', '27.77', 0, '0.00', '0.00', '0.00', '30233.68'),
(18, 23, 'PENDING', '2019-06-16', '2022.66', '302.34', '27.77', 0, '0.00', '0.00', '0.00', '28211.02'),
(18, 24, 'PENDING', '2019-07-16', '2042.89', '282.11', '27.77', 0, '0.00', '0.00', '0.00', '26168.13'),
(18, 25, 'PENDING', '2019-08-16', '2063.32', '261.68', '27.77', 0, '0.00', '0.00', '0.00', '24104.81'),
(18, 26, 'PENDING', '2019-09-16', '2083.95', '241.05', '27.77', 0, '0.00', '0.00', '0.00', '22020.86'),
(18, 27, 'PENDING', '2019-10-16', '2104.79', '220.21', '27.77', 0, '0.00', '0.00', '0.00', '19916.07'),
(18, 28, 'PENDING', '2019-11-16', '2125.84', '199.16', '27.77', 0, '0.00', '0.00', '0.00', '17790.23'),
(18, 29, 'PENDING', '2019-12-16', '2147.10', '177.90', '27.77', 0, '0.00', '0.00', '0.00', '15643.13'),
(18, 30, 'PENDING', '2020-01-16', '2168.57', '156.43', '27.77', 0, '0.00', '0.00', '0.00', '13474.56'),
(18, 31, 'PENDING', '2020-02-16', '2190.25', '134.75', '27.77', 0, '0.00', '0.00', '0.00', '11284.31'),
(18, 32, 'PENDING', '2020-03-16', '2212.16', '112.84', '27.77', 0, '0.00', '0.00', '0.00', '9072.15'),
(18, 33, 'PENDING', '2020-04-16', '2234.28', '90.72', '27.77', 0, '0.00', '0.00', '0.00', '6837.87'),
(18, 34, 'PENDING', '2020-05-16', '2256.62', '68.38', '27.77', 0, '0.00', '0.00', '0.00', '4581.25'),
(18, 35, 'PENDING', '2020-06-16', '2279.19', '45.81', '27.77', 0, '0.00', '0.00', '0.00', '2302.06'),
(18, 36, 'PENDING', '2020-07-16', '2302.06', '22.66', '28.05', 0, '0.00', '0.00', '0.00', '0.00'),
(19, 1, 'PENDING', '2017-08-17', '2321.43', '1000.00', '83.33', 0, '0.00', '0.00', '0.00', '97678.57'),
(19, 2, 'PENDING', '2017-09-17', '2344.64', '976.79', '83.33', 0, '0.00', '0.00', '0.00', '95333.93'),
(19, 3, 'PENDING', '2017-10-17', '2368.09', '953.34', '83.33', 0, '0.00', '0.00', '0.00', '92965.84'),
(19, 4, 'PENDING', '2017-11-17', '2391.77', '929.66', '83.33', 0, '0.00', '0.00', '0.00', '90574.07'),
(19, 5, 'PENDING', '2017-12-17', '2415.69', '905.74', '83.33', 0, '0.00', '0.00', '0.00', '88158.38'),
(19, 6, 'PENDING', '2018-01-17', '2439.85', '881.58', '83.33', 0, '0.00', '0.00', '0.00', '85718.53'),
(19, 7, 'PENDING', '2018-02-17', '2464.24', '857.19', '83.33', 0, '0.00', '0.00', '0.00', '83254.29'),
(19, 8, 'PENDING', '2018-03-17', '2488.89', '832.54', '83.33', 0, '0.00', '0.00', '0.00', '80765.40'),
(19, 9, 'PENDING', '2018-04-17', '2513.78', '807.65', '83.33', 0, '0.00', '0.00', '0.00', '78251.62'),
(19, 10, 'PENDING', '2018-05-17', '2538.91', '782.52', '83.33', 0, '0.00', '0.00', '0.00', '75712.71'),
(19, 11, 'PENDING', '2018-06-17', '2564.30', '757.13', '83.33', 0, '0.00', '0.00', '0.00', '73148.41'),
(19, 12, 'PENDING', '2018-07-17', '2589.95', '731.48', '83.33', 0, '0.00', '0.00', '0.00', '70558.46'),
(19, 13, 'PENDING', '2018-08-17', '2615.85', '705.58', '83.33', 0, '0.00', '0.00', '0.00', '67942.61'),
(19, 14, 'PENDING', '2018-09-17', '2642.00', '679.43', '83.33', 0, '0.00', '0.00', '0.00', '65300.61'),
(19, 15, 'PENDING', '2018-10-17', '2668.42', '653.01', '83.33', 0, '0.00', '0.00', '0.00', '62632.19'),
(19, 16, 'PENDING', '2018-11-17', '2695.11', '626.32', '83.33', 0, '0.00', '0.00', '0.00', '59937.08'),
(19, 17, 'PENDING', '2018-12-17', '2722.06', '599.37', '83.33', 0, '0.00', '0.00', '0.00', '57215.02'),
(19, 18, 'PENDING', '2019-01-17', '2749.28', '572.15', '83.33', 0, '0.00', '0.00', '0.00', '54465.74'),
(19, 19, 'PENDING', '2019-02-17', '2776.77', '544.66', '83.33', 0, '0.00', '0.00', '0.00', '51688.97'),
(19, 20, 'PENDING', '2019-03-17', '2804.54', '516.89', '83.33', 0, '0.00', '0.00', '0.00', '48884.43'),
(19, 21, 'PENDING', '2019-04-17', '2832.59', '488.84', '83.33', 0, '0.00', '0.00', '0.00', '46051.84'),
(19, 22, 'PENDING', '2019-05-17', '2860.91', '460.52', '83.33', 0, '0.00', '0.00', '0.00', '43190.93'),
(19, 23, 'PENDING', '2019-06-17', '2889.52', '431.91', '83.33', 0, '0.00', '0.00', '0.00', '40301.41'),
(19, 24, 'PENDING', '2019-07-17', '2918.42', '403.01', '83.33', 0, '0.00', '0.00', '0.00', '37382.99'),
(19, 25, 'PENDING', '2019-08-17', '2947.60', '373.83', '83.33', 0, '0.00', '0.00', '0.00', '34435.39'),
(19, 26, 'PENDING', '2019-09-17', '2977.08', '344.35', '83.33', 0, '0.00', '0.00', '0.00', '31458.31'),
(19, 27, 'PENDING', '2019-10-17', '3006.85', '314.58', '83.33', 0, '0.00', '0.00', '0.00', '28451.46'),
(19, 28, 'PENDING', '2019-11-17', '3036.92', '284.51', '83.33', 0, '0.00', '0.00', '0.00', '25414.54'),
(19, 29, 'PENDING', '2019-12-17', '3067.28', '254.15', '83.33', 0, '0.00', '0.00', '0.00', '22347.26'),
(19, 30, 'PENDING', '2020-01-17', '3097.96', '223.47', '83.33', 0, '0.00', '0.00', '0.00', '19249.30'),
(19, 31, 'PENDING', '2020-02-17', '3128.94', '192.49', '83.33', 0, '0.00', '0.00', '0.00', '16120.36'),
(19, 32, 'PENDING', '2020-03-17', '3160.23', '161.20', '83.33', 0, '0.00', '0.00', '0.00', '12960.13'),
(19, 33, 'PENDING', '2020-04-17', '3191.83', '129.60', '83.33', 0, '0.00', '0.00', '0.00', '9768.30'),
(19, 34, 'PENDING', '2020-05-17', '3223.75', '97.68', '83.33', 0, '0.00', '0.00', '0.00', '6544.55'),
(19, 35, 'PENDING', '2020-06-17', '3255.98', '65.45', '83.33', 0, '0.00', '0.00', '0.00', '3288.57'),
(19, 36, 'PENDING', '2020-07-17', '3288.57', '32.74', '83.45', 0, '0.00', '0.00', '0.00', '0.00'),
(20, 1, 'PENDING', '2017-08-18', '2321.43', '1000.00', '30.83', 0, '0.00', '0.00', '0.00', '97678.57'),
(20, 2, 'PENDING', '2017-09-18', '2344.64', '976.79', '30.83', 0, '0.00', '0.00', '0.00', '95333.93'),
(20, 3, 'PENDING', '2017-10-18', '2368.09', '953.34', '30.83', 0, '0.00', '0.00', '0.00', '92965.84'),
(20, 4, 'PENDING', '2017-11-18', '2391.77', '929.66', '30.83', 0, '0.00', '0.00', '0.00', '90574.07'),
(20, 5, 'PENDING', '2017-12-18', '2415.69', '905.74', '30.83', 0, '0.00', '0.00', '0.00', '88158.38'),
(20, 6, 'PENDING', '2018-01-18', '2439.85', '881.58', '30.83', 0, '0.00', '0.00', '0.00', '85718.53'),
(20, 7, 'PENDING', '2018-02-18', '2464.24', '857.19', '30.83', 0, '0.00', '0.00', '0.00', '83254.29'),
(20, 8, 'PENDING', '2018-03-18', '2488.89', '832.54', '30.83', 0, '0.00', '0.00', '0.00', '80765.40'),
(20, 9, 'PENDING', '2018-04-18', '2513.78', '807.65', '30.83', 0, '0.00', '0.00', '0.00', '78251.62'),
(20, 10, 'PENDING', '2018-05-18', '2538.91', '782.52', '30.83', 0, '0.00', '0.00', '0.00', '75712.71'),
(20, 11, 'PENDING', '2018-06-18', '2564.30', '757.13', '30.83', 0, '0.00', '0.00', '0.00', '73148.41'),
(20, 12, 'PENDING', '2018-07-18', '2589.95', '731.48', '30.83', 0, '0.00', '0.00', '0.00', '70558.46'),
(20, 13, 'PENDING', '2018-08-18', '2615.85', '705.58', '30.83', 0, '0.00', '0.00', '0.00', '67942.61'),
(20, 14, 'PENDING', '2018-09-18', '2642.00', '679.43', '30.83', 0, '0.00', '0.00', '0.00', '65300.61'),
(20, 15, 'PENDING', '2018-10-18', '2668.42', '653.01', '30.83', 0, '0.00', '0.00', '0.00', '62632.19'),
(20, 16, 'PENDING', '2018-11-18', '2695.11', '626.32', '30.83', 0, '0.00', '0.00', '0.00', '59937.08'),
(20, 17, 'PENDING', '2018-12-18', '2722.06', '599.37', '30.83', 0, '0.00', '0.00', '0.00', '57215.02'),
(20, 18, 'PENDING', '2019-01-18', '2749.28', '572.15', '30.83', 0, '0.00', '0.00', '0.00', '54465.74'),
(20, 19, 'PENDING', '2019-02-18', '2776.77', '544.66', '30.83', 0, '0.00', '0.00', '0.00', '51688.97'),
(20, 20, 'PENDING', '2019-03-18', '2804.54', '516.89', '30.83', 0, '0.00', '0.00', '0.00', '48884.43'),
(20, 21, 'PENDING', '2019-04-18', '2832.59', '488.84', '30.83', 0, '0.00', '0.00', '0.00', '46051.84'),
(20, 22, 'PENDING', '2019-05-18', '2860.91', '460.52', '30.83', 0, '0.00', '0.00', '0.00', '43190.93'),
(20, 23, 'PENDING', '2019-06-18', '2889.52', '431.91', '30.83', 0, '0.00', '0.00', '0.00', '40301.41'),
(20, 24, 'PENDING', '2019-07-18', '2918.42', '403.01', '30.83', 0, '0.00', '0.00', '0.00', '37382.99'),
(20, 25, 'PENDING', '2019-08-18', '2947.60', '373.83', '30.83', 0, '0.00', '0.00', '0.00', '34435.39'),
(20, 26, 'PENDING', '2019-09-18', '2977.08', '344.35', '30.83', 0, '0.00', '0.00', '0.00', '31458.31'),
(20, 27, 'PENDING', '2019-10-18', '3006.85', '314.58', '30.83', 0, '0.00', '0.00', '0.00', '28451.46'),
(20, 28, 'PENDING', '2019-11-18', '3036.92', '284.51', '30.83', 0, '0.00', '0.00', '0.00', '25414.54'),
(20, 29, 'PENDING', '2019-12-18', '3067.28', '254.15', '30.83', 0, '0.00', '0.00', '0.00', '22347.26'),
(20, 30, 'PENDING', '2020-01-18', '3097.96', '223.47', '30.83', 0, '0.00', '0.00', '0.00', '19249.30'),
(20, 31, 'PENDING', '2020-02-18', '3128.94', '192.49', '30.83', 0, '0.00', '0.00', '0.00', '16120.36'),
(20, 32, 'PENDING', '2020-03-18', '3160.23', '161.20', '30.83', 0, '0.00', '0.00', '0.00', '12960.13'),
(20, 33, 'PENDING', '2020-04-18', '3191.83', '129.60', '30.83', 0, '0.00', '0.00', '0.00', '9768.30'),
(20, 34, 'PENDING', '2020-05-18', '3223.75', '97.68', '30.83', 0, '0.00', '0.00', '0.00', '6544.55'),
(20, 35, 'PENDING', '2020-06-18', '3255.98', '65.45', '30.83', 0, '0.00', '0.00', '0.00', '3288.57'),
(20, 36, 'PENDING', '2020-07-18', '3288.57', '32.74', '30.95', 0, '0.00', '0.00', '0.00', '0.00'),
(22, 1, 'PENDING', '2017-08-30', '2448.42', '125.00', '0.00', 0, '0.00', '0.00', '0.00', '12551.58'),
(22, 2, 'PENDING', '2017-09-30', '2468.82', '104.60', '0.00', 0, '0.00', '0.00', '0.00', '10082.76'),
(22, 3, 'PENDING', '2017-10-30', '2489.40', '84.02', '0.00', 0, '0.00', '0.00', '0.00', '7593.36'),
(22, 4, 'PENDING', '2017-11-30', '2510.14', '63.28', '0.00', 0, '0.00', '0.00', '0.00', '5083.22'),
(22, 5, 'PENDING', '2017-12-30', '2531.06', '42.36', '0.00', 0, '0.00', '0.00', '0.00', '2552.16'),
(22, 6, 'PENDING', '2018-01-30', '2552.16', '21.26', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(23, 1, 'PENDING', '2017-08-30', '46.42', '20.00', '3.88', 0, '0.00', '0.00', '0.00', '1953.58'),
(23, 2, 'PENDING', '2017-09-30', '46.88', '19.54', '3.88', 0, '0.00', '0.00', '0.00', '1906.70'),
(23, 3, 'PENDING', '2017-10-30', '47.35', '19.07', '3.88', 0, '0.00', '0.00', '0.00', '1859.35'),
(23, 4, 'PENDING', '2017-11-30', '47.83', '18.59', '3.88', 0, '0.00', '0.00', '0.00', '1811.52'),
(23, 5, 'PENDING', '2017-12-30', '48.30', '18.12', '3.88', 0, '0.00', '0.00', '0.00', '1763.22'),
(23, 6, 'PENDING', '2018-01-30', '48.79', '17.63', '3.88', 0, '0.00', '0.00', '0.00', '1714.43'),
(23, 7, 'PENDING', '2018-03-02', '49.28', '17.14', '3.88', 0, '0.00', '0.00', '0.00', '1665.15'),
(23, 8, 'PENDING', '2018-04-02', '49.77', '16.65', '3.88', 0, '0.00', '0.00', '0.00', '1615.38'),
(23, 9, 'PENDING', '2018-05-02', '50.27', '16.15', '3.88', 0, '0.00', '0.00', '0.00', '1565.11'),
(23, 10, 'PENDING', '2018-06-02', '50.77', '15.65', '3.88', 0, '0.00', '0.00', '0.00', '1514.34'),
(23, 11, 'PENDING', '2018-07-02', '51.28', '15.14', '3.88', 0, '0.00', '0.00', '0.00', '1463.06'),
(23, 12, 'PENDING', '2018-08-02', '51.79', '14.63', '3.88', 0, '0.00', '0.00', '0.00', '1411.27'),
(23, 13, 'PENDING', '2018-09-02', '52.31', '14.11', '3.88', 0, '0.00', '0.00', '0.00', '1358.96'),
(23, 14, 'PENDING', '2018-10-02', '52.83', '13.59', '3.88', 0, '0.00', '0.00', '0.00', '1306.13'),
(23, 15, 'PENDING', '2018-11-02', '53.36', '13.06', '3.88', 0, '0.00', '0.00', '0.00', '1252.77'),
(23, 16, 'PENDING', '2018-12-02', '53.89', '12.53', '3.88', 0, '0.00', '0.00', '0.00', '1198.88'),
(23, 17, 'PENDING', '2019-01-02', '54.43', '11.99', '3.88', 0, '0.00', '0.00', '0.00', '1144.45'),
(23, 18, 'PENDING', '2019-02-02', '54.98', '11.44', '3.88', 0, '0.00', '0.00', '0.00', '1089.47'),
(23, 19, 'PENDING', '2019-03-02', '55.53', '10.89', '3.88', 0, '0.00', '0.00', '0.00', '1033.94'),
(23, 20, 'PENDING', '2019-04-02', '56.08', '10.34', '3.88', 0, '0.00', '0.00', '0.00', '977.86'),
(23, 21, 'PENDING', '2019-05-02', '56.64', '9.78', '3.88', 0, '0.00', '0.00', '0.00', '921.22'),
(23, 22, 'PENDING', '2019-06-02', '57.21', '9.21', '3.88', 0, '0.00', '0.00', '0.00', '864.01'),
(23, 23, 'PENDING', '2019-07-02', '57.78', '8.64', '3.88', 0, '0.00', '0.00', '0.00', '806.23'),
(23, 24, 'PENDING', '2019-08-02', '58.36', '8.06', '3.88', 0, '0.00', '0.00', '0.00', '747.87'),
(23, 25, 'PENDING', '2019-09-02', '58.94', '7.48', '3.88', 0, '0.00', '0.00', '0.00', '688.93'),
(23, 26, 'PENDING', '2019-10-02', '59.53', '6.89', '3.88', 0, '0.00', '0.00', '0.00', '629.40'),
(23, 27, 'PENDING', '2019-11-02', '60.13', '6.29', '3.88', 0, '0.00', '0.00', '0.00', '569.27'),
(23, 28, 'PENDING', '2019-12-02', '60.73', '5.69', '3.88', 0, '0.00', '0.00', '0.00', '508.54'),
(23, 29, 'PENDING', '2020-01-02', '61.33', '5.09', '3.88', 0, '0.00', '0.00', '0.00', '447.21'),
(23, 30, 'PENDING', '2020-02-02', '61.95', '4.47', '3.88', 0, '0.00', '0.00', '0.00', '385.26'),
(23, 31, 'PENDING', '2020-03-02', '62.57', '3.85', '3.88', 0, '0.00', '0.00', '0.00', '322.69'),
(23, 32, 'PENDING', '2020-04-02', '63.19', '3.23', '3.88', 0, '0.00', '0.00', '0.00', '259.50'),
(23, 33, 'PENDING', '2020-05-02', '63.82', '2.60', '3.88', 0, '0.00', '0.00', '0.00', '195.68'),
(23, 34, 'PENDING', '2020-06-02', '64.46', '1.96', '3.88', 0, '0.00', '0.00', '0.00', '131.22'),
(23, 35, 'PENDING', '2020-07-02', '65.11', '1.31', '3.88', 0, '0.00', '0.00', '0.00', '66.11'),
(23, 36, 'PENDING', '2020-08-02', '66.11', '-0.01', '4.20', 0, '0.00', '0.00', '0.00', '0.00'),
(24, 1, 'PAYED', '2017-06-04', '96.35', '12.22', '2.03', 2, '6.74', '117.34', '0.00', '1125.65'),
(24, 2, 'ARREARS', '2017-07-04', '97.31', '11.26', '2.03', 1, '3.32', '3.32', '110.60', '1028.34'),
(24, 3, 'PENDING', '2017-08-04', '98.29', '10.28', '2.03', 0, '0.00', '0.00', '0.00', '930.05'),
(24, 4, 'PENDING', '2017-09-04', '99.27', '9.30', '2.03', 0, '0.00', '0.00', '0.00', '830.78'),
(24, 5, 'PENDING', '2017-10-04', '100.26', '8.31', '2.03', 0, '0.00', '0.00', '0.00', '730.52'),
(24, 6, 'PENDING', '2017-11-04', '101.26', '7.31', '2.03', 0, '0.00', '0.00', '0.00', '629.26'),
(24, 7, 'PENDING', '2017-12-04', '102.28', '6.29', '2.03', 0, '0.00', '0.00', '0.00', '526.98'),
(24, 8, 'PENDING', '2018-01-04', '103.30', '5.27', '2.03', 0, '0.00', '0.00', '0.00', '423.68'),
(24, 9, 'PENDING', '2018-02-04', '104.33', '4.24', '2.03', 0, '0.00', '0.00', '0.00', '319.35'),
(24, 10, 'PENDING', '2018-03-04', '105.38', '3.19', '2.03', 0, '0.00', '0.00', '0.00', '213.97'),
(24, 11, 'PENDING', '2018-04-04', '106.43', '2.14', '2.03', 0, '0.00', '0.00', '0.00', '107.54'),
(24, 12, 'PENDING', '2018-05-04', '107.54', '0.95', '2.11', 0, '0.00', '0.00', '0.00', '0.00'),
(25, 1, 'PENDING', '2017-08-30', '162.54', '10.00', '0.00', 0, '0.00', '0.00', '0.00', '837.46'),
(25, 2, 'PENDING', '2017-09-30', '164.17', '8.37', '0.00', 0, '0.00', '0.00', '0.00', '673.29'),
(25, 3, 'PENDING', '2017-10-30', '165.81', '6.73', '0.00', 0, '0.00', '0.00', '0.00', '507.48'),
(25, 4, 'PENDING', '2017-11-30', '167.47', '5.07', '0.00', 0, '0.00', '0.00', '0.00', '340.01'),
(25, 5, 'PENDING', '2017-12-30', '169.14', '3.40', '0.00', 0, '0.00', '0.00', '0.00', '170.87'),
(25, 6, 'PENDING', '2018-01-30', '170.87', '1.67', '0.00', 0, '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`id`, `name`, `description`) VALUES
(1, 'HP - New Vehicle', 'Hire purchase a new vehicle'),
(2, 'HP - Reg. Vehicle Re-finance', 'Hire purchase a registered vehicle refinance'),
(3, 'HP - Reg. Vehicle - Other', 'Hire purchase a registered vehicle (other)'),
(4, 'Personal', 'Personal loan');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1498749419),
('m140608_173539_create_user_table', 1498749423),
('m140611_133903_init_rbac', 1498749423),
('m140808_073114_create_auth_item_group_table', 1498749423),
('m140809_072112_insert_superadmin_to_user', 1498749424),
('m140809_073114_insert_common_permisison_to_auth_item', 1498749424),
('m141023_141535_create_user_visit_log', 1498749424),
('m141116_115804_add_bind_to_ip_and_registration_ip_to_user', 1498749424),
('m141121_194858_split_browser_and_os_column', 1498749424),
('m141201_220516_add_email_and_email_confirmed_to_user', 1498749424),
('m141207_001649_create_basic_user_permissions', 1498749425);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(128) NOT NULL COMMENT 'Name',
  `account` varchar(12) DEFAULT NULL COMMENT 'Account',
  `status` enum('ACTIVE','INACTIVE') NOT NULL COMMENT 'Status',
  `contact` varchar(128) DEFAULT NULL COMMENT 'Contact Person',
  `address` text NOT NULL COMMENT 'Address',
  `phone` varchar(16) NOT NULL COMMENT 'Phone',
  `mobile` varchar(16) DEFAULT NULL COMMENT 'Mobile',
  `email` varchar(64) DEFAULT NULL COMMENT 'Email',
  `bank` int(11) DEFAULT NULL COMMENT 'Bank',
  `bank_account_name` varchar(128) DEFAULT NULL,
  `bank_account` varchar(20) DEFAULT NULL COMMENT 'Bank Account'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `account`, `status`, `contact`, `address`, `phone`, `mobile`, `email`, `bank`, `bank_account_name`, `bank_account`) VALUES
(1, 'Donkey provider (Pvt) Ltd.', '3000000001', 'ACTIVE', '', 'Asdff\r\ns', '+94777102545', '', '', 2, 'Donkey provider (Pvt) Ltd.', '12345'),
(2, 'Pilihuduwa & Sons Traders.', '3000000002', 'ACTIVE', 'No person', 'Fosa\r\nsdf', '+94777888999', '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `txid` int(11) NOT NULL COMMENT 'Transaction ID',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Transaction Time',
  `cr_account` varchar(12) NOT NULL COMMENT 'Credit Account',
  `dr_account` varchar(12) NOT NULL COMMENT 'Debit Account',
  `cr_balance` decimal(10,2) NOT NULL COMMENT 'Credit Balance',
  `dr_balance` decimal(10,2) NOT NULL COMMENT 'Debit Balance',
  `amount` decimal(10,2) NOT NULL COMMENT 'Amount',
  `type` varchar(10) NOT NULL COMMENT 'Transaction Type',
  `payment` enum('CASH','CHEQUE','INTERNAL') NOT NULL DEFAULT 'CASH',
  `cheque` varchar(32) DEFAULT NULL,
  `txlink` varchar(20) NOT NULL COMMENT 'Link',
  `description` varchar(128) NOT NULL COMMENT 'Description'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`txid`, `timestamp`, `cr_account`, `dr_account`, `cr_balance`, `dr_balance`, `amount`, `type`, `payment`, `cheque`, `txlink`, `description`) VALUES
(2, '2017-06-29 19:22:51', '9000000002', '9000000001', '-1000.00', '1000.00', '1000.00', 'CAPITAL', 'CASH', NULL, '', 'Initial transfer'),
(3, '2017-06-29 19:23:49', '9000000001', '9000000002', '0.00', '0.00', '1000.00', 'CAPITAL', 'CASH', NULL, '', 'Initial transfer'),
(4, '2017-07-02 12:39:48', '2000000006', '9000000001', '-1111.00', '1111.00', '1111.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #6'),
(5, '2017-07-02 12:39:48', '9000000002', '9000000001', '-1111.00', '2222.00', '1111.00', 'CHARGES', 'CASH', NULL, '', 'Disbursement charges of the loan #6'),
(6, '2017-07-02 13:09:11', '2000000005', '9000000001', '-1000.00', '3222.00', '1000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #5'),
(7, '2017-07-02 13:09:11', '9000000002', '9000000001', '-1211.00', '3322.00', '100.00', 'CHARGES', 'CASH', NULL, '', 'Disbursement charges of the loan #5'),
(8, '2017-07-03 18:36:48', '1000000005', '9000000004', '0.00', '25.00', '25.00', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(9, '2017-07-03 18:39:07', '1000000005', '9000000004', '64.23', '60.77', '35.77', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(10, '2017-07-03 18:39:13', '1000000005', '9000000005', '40.33', '23.90', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-08-02'),
(11, '2017-07-03 18:39:13', '9000000005', '2000000005', '11.66', '-9988.76', '12.24', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-08-02'),
(12, '2017-07-03 18:39:13', '9000000005', '9000000003', '1.66', '10.00', '10.00', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-08-02'),
(13, '2017-07-03 18:39:13', '9000000005', '9000000002', '-8.34', '-1201.00', '10.00', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-08-02'),
(14, '2017-07-03 18:39:14', '1000000005', '9000000005', '71.71', '-39.72', '-31.38', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-07-09'),
(15, '2017-07-03 18:39:14', '9000000005', '2000000005', '-131.23', '-9897.25', '91.51', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-07-09'),
(16, '2017-07-03 18:39:14', '9000000005', '9000000003', '-133.58', '12.35', '2.35', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-07-09'),
(17, '2017-07-03 18:39:14', '9000000005', '9000000002', '-135.93', '-1198.65', '2.35', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-07-09'),
(18, '2017-07-03 18:39:14', '1000000005', '9000000005', '91.62', '-155.84', '-19.91', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-07-16'),
(19, '2017-07-03 18:39:14', '9000000005', '2000000005', '-247.35', '-9805.74', '91.51', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-07-16'),
(20, '2017-07-03 18:39:14', '9000000005', '9000000003', '-249.70', '14.70', '2.35', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-07-16'),
(21, '2017-07-03 18:39:14', '9000000005', '9000000002', '-252.05', '-1196.30', '2.35', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-07-16'),
(22, '2017-07-03 18:39:14', '1000000005', '9000000005', '101.10', '-261.53', '-9.48', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-07-23'),
(23, '2017-07-03 18:39:14', '9000000005', '2000000005', '-353.04', '-9714.23', '91.51', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-07-23'),
(24, '2017-07-03 18:39:14', '9000000005', '9000000003', '-355.39', '17.05', '2.35', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-07-23'),
(25, '2017-07-03 18:39:15', '9000000005', '9000000002', '-357.74', '-1193.95', '2.35', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-07-23'),
(26, '2017-07-03 18:39:15', '9000000005', '2000000005', '-449.25', '-9622.72', '91.51', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-07-30'),
(27, '2017-07-03 18:39:15', '9000000005', '9000000003', '-451.60', '19.40', '2.35', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-07-30'),
(28, '2017-07-03 18:39:15', '9000000005', '9000000002', '-453.95', '-1191.60', '2.35', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-07-30'),
(29, '2017-07-05 17:31:07', '1000000005', '9000000004', '17.59', '68.18', '7.41', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(30, '2017-07-05 17:32:43', '1000000005', '9000000004', '10.42', '75.35', '7.17', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(31, '2017-07-05 17:33:38', '1000000005', '9000000005', '16.10', '-430.05', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-09-02'),
(32, '2017-07-05 17:33:38', '9000000005', '2000000005', '-442.41', '-9610.36', '12.36', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-09-02'),
(33, '2017-07-05 17:33:38', '9000000005', '9000000003', '-452.29', '29.28', '9.88', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-09-02'),
(34, '2017-07-05 17:33:38', '9000000005', '9000000002', '-462.17', '-1181.72', '9.88', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-09-02'),
(35, '2017-07-05 17:34:07', '1000000005', '9000000005', '76.10', '-438.27', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-10-02'),
(36, '2017-07-05 17:34:07', '9000000005', '2000000005', '-450.76', '-9597.87', '12.49', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-10-02'),
(37, '2017-07-05 17:34:07', '9000000005', '9000000003', '-460.51', '39.03', '9.75', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-10-02'),
(38, '2017-07-05 17:34:07', '9000000005', '9000000002', '-470.26', '-1171.97', '9.75', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-10-02'),
(39, '2017-07-05 17:34:07', '1000000005', '9000000005', '52.20', '-446.36', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-11-02'),
(40, '2017-07-05 17:34:07', '9000000005', '2000000005', '-458.97', '-9585.26', '12.61', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-11-02'),
(41, '2017-07-05 17:34:07', '9000000005', '9000000003', '-468.60', '48.66', '9.63', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-11-02'),
(42, '2017-07-05 17:34:07', '9000000005', '9000000002', '-478.23', '-1162.34', '9.63', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-11-02'),
(43, '2017-07-05 17:34:50', '1000000005', '9000000004', '49.81', '77.74', '2.39', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(44, '2017-07-05 17:34:50', '1000000005', '9000000005', '25.91', '-454.33', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2017-12-02'),
(45, '2017-07-05 17:34:50', '9000000005', '2000000005', '-467.07', '-9572.52', '12.74', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2017-12-02'),
(46, '2017-07-05 17:34:50', '9000000005', '9000000003', '-476.57', '58.16', '9.50', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2017-12-02'),
(47, '2017-07-05 17:34:50', '9000000005', '9000000002', '-486.07', '-1152.84', '9.50', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2017-12-02'),
(48, '2017-07-05 17:34:50', '1000000005', '9000000005', '2.01', '-462.17', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2018-01-02'),
(49, '2017-07-05 17:34:50', '9000000005', '2000000005', '-475.03', '-9559.66', '12.86', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2018-01-02'),
(50, '2017-07-05 17:34:50', '9000000005', '9000000003', '-484.41', '67.54', '9.38', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2018-01-02'),
(51, '2017-07-05 17:34:50', '9000000005', '9000000002', '-493.79', '-1143.46', '9.38', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2018-01-02'),
(52, '2017-07-05 17:37:38', '1000000005', '9000000005', '26.10', '-469.89', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2018-02-02'),
(53, '2017-07-05 17:37:38', '9000000005', '2000000005', '-482.88', '-9546.67', '12.99', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2018-02-02'),
(54, '2017-07-05 17:37:38', '9000000005', '9000000003', '-492.13', '76.79', '9.25', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2018-02-02'),
(55, '2017-07-05 17:37:38', '9000000005', '9000000002', '-501.38', '-1134.21', '9.25', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2018-02-02'),
(56, '2017-07-05 17:44:54', '1000000005', '9000000004', '23.71', '80.13', '2.39', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(57, '2017-07-05 17:45:35', '1000000005', '9000000005', '24.10', '-477.48', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2018-03-02'),
(58, '2017-07-05 17:45:35', '9000000005', '2000000005', '-490.60', '-9533.55', '13.12', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2018-03-02'),
(59, '2017-07-05 17:45:35', '9000000005', '9000000003', '-499.72', '85.91', '9.12', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2018-03-02'),
(60, '2017-07-05 17:45:35', '9000000005', '9000000002', '-508.84', '-1125.09', '9.12', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2018-03-02'),
(61, '2017-07-05 17:45:35', '1000000005', '9000000005', '0.20', '-484.94', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2018-04-02'),
(62, '2017-07-05 17:45:35', '9000000005', '2000000005', '-498.19', '-9520.30', '13.25', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2018-04-02'),
(63, '2017-07-05 17:45:35', '9000000005', '9000000003', '-507.18', '94.90', '8.99', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2018-04-02'),
(64, '2017-07-05 17:45:35', '9000000005', '9000000002', '-516.17', '-1116.10', '8.99', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2018-04-02'),
(65, '2017-07-05 17:46:18', '1000000005', '9000000004', '0.00', '80.33', '0.20', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(66, '2017-07-05 17:48:56', '1000000005', '9000000004', '47.61', '82.72', '2.39', 'PENALTY', 'CASH', NULL, '', 'Penalty charge for loan #5'),
(67, '2017-07-05 17:48:56', '1000000005', '9000000005', '23.71', '-492.27', '23.90', 'RECOVERY', 'CASH', NULL, '', 'Installment recovery of loan #5 for 2018-05-02'),
(68, '2017-07-05 17:48:56', '9000000005', '2000000005', '-505.66', '-9506.91', '13.39', 'CAPITAL', 'CASH', NULL, '', 'Capital recovery of loan #5 for 2018-05-02'),
(69, '2017-07-05 17:48:56', '9000000005', '9000000003', '-514.51', '103.75', '8.85', 'INTEREST', 'CASH', NULL, '', 'Interest recovery of loan #5 for 2018-05-02'),
(70, '2017-07-05 17:48:56', '9000000005', '9000000002', '-523.36', '-1107.25', '8.85', 'CHARGES', 'CASH', NULL, '', 'Charges recovery of loan #5 for 2018-05-02'),
(71, '2017-07-15 05:56:00', '2000000011', '9000000001', '-100000.00', '103322.00', '100000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #11'),
(72, '2017-07-15 06:02:31', '2000000012', '9000000001', '-20000.00', '123322.00', '20000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #12'),
(73, '2017-07-15 06:15:17', '2000000014', '9000000001', '-100000.00', '223322.00', '100000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #14'),
(74, '2017-07-15 06:19:30', '2000000015', '9000000001', '-100000.00', '323322.00', '100000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #15'),
(75, '2017-07-15 06:48:04', '2000000017', '9000000001', '-10000.00', '333322.00', '10000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #17'),
(76, '2017-07-16 08:30:36', '2000000016', '9000000001', '-10000.00', '343322.00', '10000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #16'),
(77, '2017-07-16 10:17:23', '2000000018', '9000000001', '-70000.00', '413322.00', '70000.00', 'DISBURSE', 'CASH', NULL, '', 'Disbursement of the loan #18'),
(78, '2017-07-16 10:17:23', '9000000002', '9000000001', '-2107.25', '414322.00', '1000.00', 'CHARGES', 'CASH', NULL, '', 'Disbursement charges of the loan #18'),
(79, '2017-07-17 17:03:12', '2000000019', '9000000005', '-103000.00', '102476.64', '103000.00', 'DISBURSE', 'CASH', NULL, '596cedd0ba467', 'Disbursement of the loan #19'),
(80, '2017-07-17 17:03:12', '9000000005', '9000000001', '2476.64', '514322.00', '100000.00', 'DISBURSE', 'CASH', NULL, '596cedd0ba467', 'Disbursement of the loan #19'),
(81, '2017-07-17 17:03:12', '9000000005', '3000000001', '476.64', '2000.00', '2000.00', 'DISBURSE', 'CASH', NULL, '596cedd0ba467', 'Sales commission of the loan #19'),
(82, '2017-07-17 17:03:12', '9000000005', '4000000001', '-523.36', '1000.00', '1000.00', 'DISBURSE', 'CASH', NULL, '596cedd0ba467', 'Canvassing commission of the loan #19'),
(107, '2017-07-18 03:58:46', '2000000020', '9000000005', '-101110.00', '100586.64', '101110.00', 'DISBURSE', 'CASH', NULL, '596d877645b00', 'Disbursement of the loan #20'),
(108, '2017-07-18 03:58:46', '9000000005', '9000000001', '586.64', '614322.00', '100000.00', 'DISBURSE', 'CASH', NULL, '596d877645b00', 'Disbursement of the loan #20'),
(109, '2017-07-18 03:58:46', '9000000005', '3000000001', '476.64', '2110.00', '110.00', 'DISBURSE', 'CASH', NULL, '596d877645b00', 'Sales commission of the loan #20'),
(110, '2017-07-18 03:58:46', '9000000005', '4000000001', '-523.36', '2000.00', '1000.00', 'DISBURSE', 'CASH', NULL, '596d877645b00', 'Canvassing commission of the loan #20'),
(111, '2017-07-18 04:32:40', '9000000001', '9000000002', '613322.00', '-1107.25', '1000.00', 'CAPITAL', 'CASH', NULL, '596d8f685b10e', 'Initial transfer'),
(112, '2017-07-18 18:12:05', '1000000015', '9000000004', '12464.77', '2617.95', '2535.23', 'PENALTY', 'CASH', NULL, '596e4f75963ab', 'Penalty charge for loan #15'),
(113, '2017-07-18 18:12:05', '1000000015', '9000000005', '11576.29', '365.12', '888.48', 'RECOVERY', 'CASH', NULL, '596e4f75963ab', 'Installment recovery of loan #15 for 2017-08-15'),
(114, '2017-07-18 18:12:05', '9000000005', '2000000015', '-423.36', '-99211.52', '788.48', 'CAPITAL', 'CASH', NULL, '596e4f75963ab', 'Capital recovery of loan #15 for 2017-08-15'),
(115, '2017-07-18 18:12:05', '9000000005', '9000000003', '-523.36', '203.75', '100.00', 'INTEREST', 'CASH', NULL, '596e4f75963ab', 'Interest recovery of loan #15 for 2017-08-15'),
(116, '2017-07-18 18:12:05', '1000000015', '9000000005', '6961.80', '4091.13', '4614.49', 'RECOVERY', 'CASH', NULL, '596e4f75963ab', 'Installment recovery of loan #15 for 2017-08-15'),
(117, '2017-07-18 18:12:05', '9000000005', '2000000015', '309.97', '-95430.36', '3781.16', 'CAPITAL', 'CASH', NULL, '596e4f75963ab', 'Capital recovery of loan #15 for 2017-08-15'),
(118, '2017-07-18 18:12:05', '9000000005', '9000000003', '-523.36', '1037.08', '833.33', 'INTEREST', 'CASH', NULL, '596e4f75963ab', 'Interest recovery of loan #15 for 2017-08-15'),
(119, '2017-07-18 18:12:05', '1000000015', '9000000005', '4609.03', '1829.41', '2352.77', 'RECOVERY', 'CASH', NULL, '596e4f75963ab', 'Installment recovery of loan #15 for 2017-08-16'),
(120, '2017-07-18 18:12:05', '9000000005', '2000000015', '176.64', '-93777.59', '1652.77', 'CAPITAL', 'CASH', NULL, '596e4f75963ab', 'Capital recovery of loan #15 for 2017-08-16'),
(121, '2017-07-18 18:12:05', '9000000005', '9000000003', '-523.36', '1737.08', '700.00', 'INTEREST', 'CASH', NULL, '596e4f75963ab', 'Interest recovery of loan #15 for 2017-08-16'),
(122, '2017-07-18 18:12:05', '1000000015', '9000000005', '3720.55', '365.12', '888.48', 'RECOVERY', 'CASH', NULL, '596e4f75963ab', 'Installment recovery of loan #15 for 2017-09-15'),
(123, '2017-07-18 18:12:05', '9000000005', '2000000015', '-431.24', '-92981.23', '796.36', 'CAPITAL', 'CASH', NULL, '596e4f75963ab', 'Capital recovery of loan #15 for 2017-09-15'),
(124, '2017-07-18 18:12:05', '9000000005', '9000000003', '-523.36', '1829.20', '92.12', 'INTEREST', 'CASH', NULL, '596e4f75963ab', 'Interest recovery of loan #15 for 2017-09-15'),
(125, '2017-07-18 18:12:05', '1000000015', '9000000005', '1367.78', '1829.41', '2352.77', 'RECOVERY', 'CASH', NULL, '596e4f75963ab', 'Installment recovery of loan #15 for 2017-09-16'),
(126, '2017-07-18 18:12:06', '9000000005', '2000000015', '160.39', '-91312.21', '1669.02', 'CAPITAL', 'CASH', NULL, '596e4f75963ab', 'Capital recovery of loan #15 for 2017-09-16'),
(127, '2017-07-18 18:12:06', '9000000005', '9000000003', '-523.36', '2512.95', '683.75', 'INTEREST', 'CASH', NULL, '596e4f75963ab', 'Interest recovery of loan #15 for 2017-09-16'),
(128, '2017-07-21 06:20:29', '8000000001', '1000000015', '-704.67', '2072.45', '704.67', 'PAYMENT', 'CASH', NULL, '59719d2d002fe', 'Test'),
(129, '2017-07-21 06:22:20', '8000000001', '1000000015', '-18704.67', '20072.45', '18000.00', 'PAYMENT', 'CASH', NULL, '59719d9bef905', 'gewwa\r\nok'),
(130, '2017-07-21 06:22:52', '8000000001', '1000000015', '-18804.67', '20172.45', '100.00', 'PAYMENT', 'CASH', NULL, '59719dbc270be', 'asd'),
(131, '2017-07-21 06:22:58', '8000000001', '1000000015', '-18904.67', '20272.45', '100.00', 'PAYMENT', 'CASH', NULL, '59719dc244ea2', 'asd'),
(132, '2017-07-21 06:29:08', '8000000001', '1000000015', '-19004.67', '20372.45', '100.00', 'PAYMENT', 'CASH', NULL, '59719f2ba9148', 'Grrr'),
(133, '2017-07-23 18:14:55', '8000000001', '1000000012', '-20504.67', '1500.00', '1500.00', 'PAYMENT', 'CASH', NULL, '5974e780929e7', 'Rsad'),
(134, '2017-07-23 18:43:44', '8000000001', '1000000017', '-20615.67', '111.00', '111.00', 'PAYMENT', '', NULL, '5974ee604db21', '5974ee31d1caf'),
(135, '2017-07-23 18:44:13', '8000000001', '1000000016', '-20737.67', '122.00', '122.00', 'PAYMENT', '', NULL, '5974ee7d144ce', '5974ee6a47b7a'),
(136, '2017-07-24 03:58:33', '8000000001', '1000000016', '-20848.67', '233.00', '111.00', 'PAYMENT', '', NULL, '59757069a7605', '5975705c601c5'),
(137, '2017-07-24 04:19:03', '8000000001', '1000000016', '-22147.67', '1532.00', '100.00', 'PAYMENT', 'CASH', NULL, '59757279f0730', 'Loan payment #16'),
(138, '2017-07-24 04:21:22', '8000000001', '1000000021', '-23147.67', '1000.00', '1000.00', 'PAYMENT', 'CASH', NULL, '597575a98158f', 'Loan payment #21'),
(139, '2017-07-30 05:06:26', '8000000001', '1000000021', '-23269.67', '1122.00', '122.00', 'PAYMENT', 'CASH', '33212', '597d639de6538', 'Loan receipt #21'),
(140, '2017-07-30 05:23:22', '9000000001', '8000000001', '513322.00', '-1123269.67', '100000.00', 'PAYMENT', 'CASH', NULL, '597d6cb443b3c', 'Loan payment #20'),
(141, '2017-07-30 06:51:53', '9000000006', '8000000001', '-100.00', '-1123169.67', '100.00', 'EXPENSE', 'CASH', NULL, '597d802ddc151', 'asdf'),
(142, '2017-07-30 06:55:51', '9000000006', '8000000001', '-311.00', '-1122958.67', '211.00', 'EXPENSE', 'CASH', NULL, '597d82ece42ad', 'sd'),
(143, '2017-07-30 06:58:08', '9000000006', '8000000001', '-433.00', '-1122836.67', '122.00', 'EXPENSE', 'CASH', NULL, '597d837c133aa', 'sdf'),
(144, '2017-07-30 06:58:16', '9000000006', '8000000001', '-556.00', '-1122713.67', '123.00', 'EXPENSE', 'CASH', NULL, '597d83830eb10', 'ff'),
(145, '2017-07-30 06:58:27', '9000000006', '8000000001', '-600.00', '-1122669.67', '44.00', 'EXPENSE', 'CASH', NULL, '597d838f50072', '23'),
(146, '2017-07-30 07:08:27', '2000000022', '9000000005', '-15000.00', '14476.64', '15000.00', 'DISBURSE', 'INTERNAL', NULL, '597d85eb09e44', 'Disbursement of the loan #22'),
(147, '2017-07-30 07:08:27', '9000000005', '9000000001', '-523.36', '528322.00', '15000.00', 'DISBURSE', 'INTERNAL', NULL, '597d85eb09e44', 'Disbursement of the loan #22'),
(154, '2017-07-30 08:15:59', '2000000023', '9000000005', '-2140.00', '1616.64', '2140.00', 'DISBURSE', 'INTERNAL', NULL, '597d95bf5be43', 'Disbursement of the loan #23'),
(155, '2017-07-30 08:15:59', '9000000005', '9000000001', '-383.36', '530322.00', '2000.00', 'DISBURSE', 'INTERNAL', NULL, '597d95bf5be43', 'Disbursement of the loan #23'),
(156, '2017-07-30 08:15:59', '9000000005', '3000000001', '-423.36', '2150.00', '40.00', 'DISBURSE', 'INTERNAL', NULL, '597d95bf5be43', 'Sales commission of the loan #23'),
(157, '2017-07-30 08:15:59', '9000000005', '4000000001', '-523.36', '2100.00', '100.00', 'DISBURSE', 'INTERNAL', NULL, '597d95bf5be43', 'Canvassing commission of the loan #23'),
(170, '2017-07-30 08:19:56', '2000000024', '9000000005', '-1246.44', '723.08', '1246.44', 'DISBURSE', 'INTERNAL', NULL, '597d96ac99a32', 'Disbursement of the loan #24'),
(171, '2017-07-30 08:19:56', '9000000005', '9000000001', '-498.92', '531544.00', '1222.00', 'DISBURSE', 'INTERNAL', NULL, '597d96ac99a32', 'Disbursement of the loan #24'),
(172, '2017-07-30 08:19:59', '9000000005', '3000000002', '-511.14', '12.22', '12.22', 'DISBURSE', 'INTERNAL', NULL, '597d96ac99a32', 'Sales commission of the loan #24'),
(173, '2017-07-30 08:19:59', '9000000005', '4000000001', '-523.36', '2112.22', '12.22', 'DISBURSE', 'INTERNAL', NULL, '597d96ac99a32', 'Canvassing commission of the loan #24'),
(174, '2017-07-30 08:21:28', '8000000001', '1000000024', '-1122819.67', '150.00', '150.00', 'RECEIPT', 'CASH', '', '597d96cfc0b5c', 'Loan receipt #24'),
(175, '2017-07-30 08:21:29', '1000000024', '9000000004', '139.94', '2628.01', '10.06', 'PENALTY', 'INTERNAL', NULL, '597d9708e9587', 'Penalty charge for loan #24'),
(176, '2017-07-30 08:21:29', '1000000024', '9000000005', '29.34', '-412.76', '110.60', 'RECOVERY', 'INTERNAL', NULL, '597d9708e9587', 'Installment recovery of loan #24 for 2017-06-04'),
(177, '2017-07-30 08:21:29', '9000000005', '2000000024', '-511.14', '-1148.06', '98.38', 'CAPITAL', 'INTERNAL', NULL, '597d9708e9587', 'Capital recovery of loan #24 for 2017-06-04'),
(178, '2017-07-30 08:21:29', '9000000005', '9000000003', '-523.36', '2525.17', '12.22', 'INTEREST', 'INTERNAL', NULL, '597d9708e9587', 'Interest recovery of loan #24 for 2017-06-04'),
(179, '2017-07-30 09:10:00', '2000000025', '9000000005', '-1000.00', '476.64', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '597da267eadd1', 'Disbursement of the loan #25'),
(180, '2017-07-30 09:10:00', '9000000005', '9000000001', '-523.36', '532544.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '597da267eadd1', 'Disbursement of the loan #25'),
(181, '2017-07-30 15:53:25', '2000000019', '9000000001', '-103123.00', '532667.00', '123.00', 'MANUAL', 'CASH', NULL, '597e00f4ef713', '12'),
(182, '2017-07-30 16:46:25', '9000000002', '9000000007', '-11107.25', '10000.00', '10000.00', 'INVESTMENT', 'INTERNAL', NULL, '597e0d61c796e', 'asd'),
(183, '2017-07-30 16:53:25', '8000000001', '9000000002', '-1122919.67', '-11007.25', '100.00', 'INTENAL', 'INTERNAL', NULL, '597e0f05669fb', 'lk'),
(184, '2017-07-30 16:57:58', '9000000002', '8000000001', '-21007.25', '-1112919.67', '10000.00', 'INTENAL', 'INTERNAL', NULL, '597e10161bfa5', 'asd'),
(185, '2017-07-30 17:36:14', '9000000002', '7000000001', '-31007.25', '10000.00', '10000.00', 'BANK', 'INTERNAL', NULL, '597e190e895d3', 'lkl'),
(186, '2017-07-30 17:40:50', '7000000002', '9000000002', '-14522.00', '-16485.25', '14522.00', 'BANK', 'CASH', NULL, '597e1a22a98bb', 'jgj');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `superadmin` smallint(6) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(15) DEFAULT NULL,
  `bind_to_ip` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `email_confirmed` smallint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`) VALUES
(1, 'superadmin', '9dg8QDmu8FWCXm1fS-909fs4II7MACVC', '$2y$13$E8vLRFzFDfSgBnuRPscVxedolcGrPebMunTmLx/AQf691owHcTB0O', NULL, 1, 1, 1498749424, 1498749424, NULL, NULL, NULL, 0),
(2, 'teller1', '85WqMZGGbb4rUhrGtOA9UAzbuWgDxV-6', '$2y$13$HDKtwrmVvHA1U7SapXmHM.HTsy9.o2Iv.pDZDif9VBG0IzCG38IGu', NULL, 1, 0, 1500100519, 1500100519, '::1', '', '', 0),
(3, 'admin', 'maBgtzMu1bua2MdCssJQA-WQ1Dr6wspI', '$2y$13$fYOG/tyD0N9p4/Q0meIe8O5NRRuxcMwz24uynQEbuSQ5vo6.GzDEm', NULL, 1, 0, 1501437522, 1501437522, '::1', '', '', 0),
(4, 'teller2', 'xSSVPS4OVLSz6b1JRrQz390wcqw0Rt2n', '$2y$13$u7GvEFEyIbcCVL.6KBz5mOk5.wPwPK7bohPw2z1kho7U9TxBcOp1u', NULL, 1, 0, 1501438098, 1501438098, '::1', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_visit_log`
--

CREATE TABLE `user_visit_log` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_visit_log`
--

INSERT INTO `user_visit_log` (`id`, `token`, `ip`, `language`, `user_agent`, `user_id`, `visit_time`, `browser`, `os`) VALUES
(1, '59551ba6342e0', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1498749862, 'Chrome', 'Windows'),
(2, '59551cc12e893', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1498750145, 'Chrome', 'Windows'),
(3, '59551ccaeb633', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1498750154, 'Chrome', 'Windows'),
(4, '595737b81b687', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1498888120, 'Chrome', 'Windows'),
(5, '595902ce166f3', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499005646, 'Chrome', 'Windows'),
(6, '595a88f5ce770', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499105525, 'Chrome', 'Windows'),
(7, '595d274c6c28c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499277132, 'Chrome', 'Windows'),
(8, '595db509ee920', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499313417, 'Chrome', 'Windows'),
(9, '59625369c086b', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499616105, 'Chrome', 'Windows'),
(10, '59659f4a86404', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499832138, 'Chrome', 'Windows'),
(11, '59663e93678d7', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499872915, 'Chrome', 'Windows'),
(12, '596646dbb4d2d', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499875035, 'Chrome', 'Windows'),
(13, '5966e7100640d', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499916048, 'Chrome', 'Windows'),
(14, '5968f399a1c81', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500050329, 'Chrome', 'Windows'),
(15, '5968f4ecb9049', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500050668, 'Chrome', 'Windows'),
(16, '5968f5a0d7006', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500050848, 'Chrome', 'Windows'),
(17, '5969ade28b3a0', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500098018, 'Chrome', 'Windows'),
(18, '5969b83d16aea', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 2, 1500100669, 'Chrome', 'Windows'),
(19, '5969c90380706', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 2, 1500104963, 'Chrome', 'Windows'),
(20, '596b19dc6d0d9', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500191196, 'Chrome', 'Windows'),
(21, '596c30025a505', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500262402, 'Chrome', 'Windows'),
(22, '596cdd2c8aa43', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500306732, 'Chrome', 'Windows'),
(23, '596d6ec0aadb5', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500344000, 'Chrome', 'Windows'),
(24, '596d898d90125', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500350861, 'Chrome', 'Windows'),
(25, '596e474181d25', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500399425, 'Chrome', 'Windows'),
(26, '596ed3df706a1', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500435423, 'Chrome', 'Windows'),
(27, '596f969ebf37e', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500485278, 'Chrome', 'Windows'),
(28, '59702776f221a', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500522359, 'Chrome', 'Windows'),
(29, '5970e37298de1', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500570482, 'Chrome', 'Windows'),
(30, '59718ff97243c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500614649, 'Chrome', 'Windows'),
(31, '5974e72a702e0', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500833578, 'Chrome', 'Windows'),
(32, '5975705c3abe3', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1500868700, 'Chrome', 'Windows'),
(33, '597d6348699f4', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501389640, 'Chrome', 'Windows'),
(34, '597e1e670b0bd', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 3, 1501437543, 'Chrome', 'Windows'),
(35, '597e21047462f', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 3, 1501438212, 'Chrome', 'Windows'),
(36, '597e21af9386c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 4, 1501438383, 'Chrome', 'Windows'),
(37, '597e2250d97c4', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 3, 1501438544, 'Chrome', 'Windows'),
(38, '597e230374497', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 4, 1501438723, 'Chrome', 'Windows');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_brand`
--

CREATE TABLE `vehicle_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_brand`
--

INSERT INTO `vehicle_brand` (`id`, `name`) VALUES
(1, 'Yamaha'),
(2, 'Bajaj'),
(3, 'Honda'),
(4, 'Hero Honda'),
(5, 'Suzuki'),
(6, 'Toyota'),
(7, 'Nissan'),
(8, 'Tata');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`id`, `name`) VALUES
(1, 'Motor Bike'),
(2, 'Three Wheller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`),
  ADD KEY `fk_auth_item_group_code` (`group_code`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_item_group`
--
ALTER TABLE `auth_item_group`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canvasser`
--
ALTER TABLE `canvasser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_method`
--
ALTER TABLE `collection_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_NIC` (`nic`) USING BTREE,
  ADD KEY `FK_CUSTOMER_AREA` (`area`);

--
-- Indexes for table `general_account`
--
ALTER TABLE `general_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_new_vehicle_loan`
--
ALTER TABLE `hp_new_vehicle_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_LOAN_TYPE` (`type`),
  ADD KEY `FK_LOAN_COLLECTION_METHOD` (`collection_method`);

--
-- Indexes for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  ADD PRIMARY KEY (`loan_id`,`installment_id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`txid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vehicle_brand`
--
ALTER TABLE `vehicle_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `canvasser`
--
ALTER TABLE `canvasser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `collection_method`
--
ALTER TABLE `collection_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Client ID', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Loan ID', AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `txid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Transaction ID', AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `vehicle_brand`
--
ALTER TABLE `vehicle_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_CUSTOMER_AREA` FOREIGN KEY (`area`) REFERENCES `area` (`id`);

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `FK_LOAN_COLLECTION_METHOD` FOREIGN KEY (`collection_method`) REFERENCES `collection_method` (`id`),
  ADD CONSTRAINT `FK_LOAN_TYPE` FOREIGN KEY (`type`) REFERENCES `loan_type` (`id`);

--
-- Constraints for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

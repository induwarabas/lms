-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2017 at 06:39 AM
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
('1000000026', 'SAVING', '39.29', 'PLUS'),
('1000000027', 'SAVING', '1868.40', 'PLUS'),
('1000000028', 'SAVING', '746.43', 'PLUS'),
('1000000029', 'SAVING', '1000.00', 'PLUS'),
('1000000030', 'SAVING', '10000.00', 'PLUS'),
('1000000031', 'SAVING', '0.00', 'PLUS'),
('1000000032', 'SAVING', '0.00', 'PLUS'),
('1000000033', 'SAVING', '0.00', 'PLUS'),
('1000000035', 'SAVING', '5820.00', 'PLUS'),
('1000000036', 'SAVING', '0.00', 'PLUS'),
('1000000037', 'SAVING', '0.00', 'PLUS'),
('1000000038', 'SAVING', '0.00', 'PLUS'),
('1000000039', 'SAVING', '0.00', 'PLUS'),
('2000000026', 'LOAN', '-48839.29', 'MINUS'),
('2000000027', 'LOAN', '-146517.86', 'MINUS'),
('2000000028', 'LOAN', '-146399.45', 'MINUS'),
('2000000029', 'LOAN', '-150000.00', 'MINUS'),
('2000000030', 'LOAN', '-50000.00', 'MINUS'),
('2000000031', 'LOAN', '-101000.00', 'MINUS'),
('2000000032', 'LOAN', '-150000.00', 'MINUS'),
('2000000033', 'LOAN', '-104000.00', 'MINUS'),
('2000000035', 'LOAN', '-100000.00', 'MINUS'),
('2000000036', 'LOAN', '-1000.00', 'MINUS'),
('2000000037', 'LOAN', '-103000.00', 'MINUS'),
('2000000038', 'LOAN', '-124477.20', 'MINUS'),
('2000000039', 'LOAN', '-103000.00', 'MINUS'),
('3000000003', 'SUPPLIER', '1000.00', 'PLUS'),
('4000000002', 'CANVASSER', '500.00', 'PLUS'),
('7000000001', 'BANK', '976122.97', 'NONE'),
('8000000001', 'TELLER', '-73088.77', 'MINUS'),
('8000000003', 'TELLER', '-1700.00', 'MINUS'),
('8000000004', 'TELLER', '0.00', 'MINUS'),
('9000000001', 'GENERAL', '350000.00', 'PLUS'),
('9000000002', 'GENERAL', '-50000.00', 'MINUS'),
('9000000003', 'GENERAL', '3500.00', 'PLUS'),
('9000000004', 'GENERAL', '302.48', 'PLUS'),
('9000000005', 'GENERAL', '2123.00', 'NONE'),
('9000000006', 'GENERAL', '0.00', 'MINUS'),
('9000000007', 'GENERAL', '100000.00', 'PLUS'),
('9000000008', 'GENERAL', '0.00', 'MINUS'),
('9000000009', 'GENERAL', '0.00', 'PLUS');

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
(3, 'Colombo', 'Colombo');

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
('advancedtxhandler', 3, 1501474594),
('common', 3, 1501474431),
('companydatamanager', 3, 1501474431),
('loanAuthorizer', 3, 1501438492),
('loanhandler', 3, 1501474431),
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
('advancedtxcreate', 2, 'Advanced Transaction Create', NULL, NULL, 1501474524, 1501474524, 'Admin'),
('advancedtxhandler', 1, 'Advanced Transaction Handler', NULL, NULL, 1501474565, 1501474565, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1498749424, 1498749424, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('common', 1, 'Common', NULL, NULL, 1501438685, 1501438685, NULL),
('commonPermission', 2, 'Common permission', NULL, NULL, 1498749424, 1498749424, NULL),
('companydatamanager', 1, 'Company Data Manager', NULL, NULL, 1501474286, 1501474286, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('editafterdisburse', 2, 'Edit Loan After Disburse', NULL, NULL, 1501475180, 1501475180, 'loanManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('loanAuthorizer', 1, 'Loan Authorizer', NULL, NULL, 1500101050, 1500101050, NULL),
('loanbasic', 2, 'Basic loan handling', NULL, NULL, 1501473688, 1501473813, 'loanManagement'),
('loandisburse', 2, 'Loan Disburse', NULL, NULL, 1501474073, 1501474073, 'loanManagement'),
('loanhandler', 1, 'Loan Handler', NULL, NULL, 1501474172, 1501474172, NULL),
('loanpayment', 2, 'Loan Payment', NULL, NULL, 1501644770, 1501644770, 'loanManagement'),
('partnerhandling', 2, 'Partner Handling', NULL, NULL, 1501473984, 1501473984, 'loanManagement'),
('referencedatamanage', 2, 'Reference Data Manage', NULL, NULL, 1501474330, 1501474330, 'Admin'),
('site', 2, 'Site Permission', NULL, NULL, 1501438628, 1501438628, 'userCommonPermissions'),
('teller', 1, 'Teller', NULL, NULL, 1500100561, 1500100561, NULL),
('tellerTransactions', 2, 'Teller Transactions', NULL, NULL, 1501436941, 1501436941, 'teller'),
('usermanager', 1, 'Usermanager', NULL, NULL, 1501438432, 1501438432, NULL),
('viewreferencedata', 2, 'Reference Data View', NULL, NULL, 1501473932, 1501473932, 'loanManagement'),
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
('advancedtxcreate', '/transaction/*'),
('advancedtxhandler', 'advancedtxcreate'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('assignRolesToUsers', 'viewUserRoles'),
('assignRolesToUsers', 'viewUsers'),
('changeOwnPassword', '/user-management/auth/change-own-password'),
('changeUserPassword', '/user-management/user/change-password'),
('changeUserPassword', 'viewUsers'),
('common', 'changeOwnPassword'),
('common', 'site'),
('companydatamanager', 'referencedatamanage'),
('createUsers', '/user-management/user/create'),
('createUsers', 'viewUsers'),
('deleteUsers', '/user-management/user/bulk-delete'),
('deleteUsers', '/user-management/user/delete'),
('deleteUsers', 'viewUsers'),
('editafterdisburse', '/hp-new-vehicle-loan/updatex'),
('editUserEmail', 'viewUserEmail'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('editUsers', '/user-management/user/update'),
('editUsers', 'viewUsers'),
('loanAuthorizer', 'common'),
('loanAuthorizer', 'editafterdisburse'),
('loanAuthorizer', 'loandisburse'),
('loanAuthorizer', 'loanhandler'),
('loanAuthorizer', 'loanpayment'),
('loanbasic', '/hp-new-vehicle-loan/create'),
('loanbasic', '/hp-new-vehicle-loan/index'),
('loanbasic', '/hp-new-vehicle-loan/set-customer'),
('loanbasic', '/hp-new-vehicle-loan/update'),
('loanbasic', '/hp-new-vehicle-loan/view'),
('loanbasic', '/loan/create'),
('loanbasic', '/loan/createx'),
('loanbasic', '/loan/customer'),
('loanbasic', '/loan/index'),
('loanbasic', '/loan/recover'),
('loanbasic', '/loan/remove-customer'),
('loanbasic', '/loan/schedule'),
('loanbasic', '/loan/schedulex'),
('loanbasic', '/loan/update'),
('loanbasic', '/loan/view'),
('loanbasic', 'partnerhandling'),
('loanbasic', 'viewreferencedata'),
('loandisburse', '/loan/disburse'),
('loandisburse', 'loanbasic'),
('loanhandler', 'loanbasic'),
('loanhandler', 'partnerhandling'),
('loanhandler', 'viewreferencedata'),
('loanpayment', '/teller/payment'),
('partnerhandling', '/account/*'),
('partnerhandling', '/canvasser/*'),
('partnerhandling', '/customer/*'),
('partnerhandling', '/supplier/*'),
('referencedatamanage', '/area/*'),
('referencedatamanage', '/bank-account/*'),
('referencedatamanage', '/bank/*'),
('referencedatamanage', '/general-account/index'),
('referencedatamanage', '/general-account/view'),
('referencedatamanage', '/vehicle-brand/*'),
('referencedatamanage', '/vehicle-type/*'),
('site', '/site/*'),
('teller', 'common'),
('teller', 'tellerTransactions'),
('tellerTransactions', '/teller/*'),
('tellerTransactions', '/teller/expense-payment'),
('tellerTransactions', '/teller/expense-receipt'),
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
('viewreferencedata', '/area/index'),
('viewreferencedata', '/area/view'),
('viewreferencedata', '/bank-account/index'),
('viewreferencedata', '/bank-account/view'),
('viewreferencedata', '/bank/index'),
('viewreferencedata', '/bank/view'),
('viewreferencedata', '/vehicle-brand/index'),
('viewreferencedata', '/vehicle-brand/view'),
('viewreferencedata', '/vehicle-type/index'),
('viewreferencedata', '/vehicle-type/view'),
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
(1, 'People\'s Bank'),
(2, 'Amana Bank'),
(3, 'Axis Bank Ltd'),
(4, 'Bank of Ceylon'),
(5, 'Cargills Bank Ltd'),
(6, 'Citibank N.A.'),
(7, 'Commercial Bank of Ceylon PLC'),
(8, 'Deutsche Bank AG'),
(9, 'DFCC Bank PLC'),
(10, 'Habib Bank Ltd'),
(11, 'Hatton National Bank PLC'),
(12, 'ICICI Bank Ltd'),
(13, 'Indian Bank'),
(14, 'Indian Overseas Bank'),
(15, 'MCB Bank Ltd'),
(16, 'National Development Bank PLC'),
(17, 'Nations Trust Bank PLC'),
(18, 'Pan Asia Banking Corporation PLC'),
(19, 'Public Bank Berhad'),
(20, 'Sampath Bank PLC'),
(21, 'Seylan Bank PLC'),
(22, 'Standard Chartered Bank'),
(23, 'State Bank of India'),
(24, 'The Hong Kong and Shanghai Banking Corporation Ltd (HSBC)'),
(25, 'Union Bank of Colombo PLC');

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
(1, 7, '190964456444', '7000000001', 'sdf');

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
(2, 'Gasd', '+94987872121', '', '', '', 'ACTIVE', '4000000002', NULL, '', '');

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
(16, '862841808V', 'Bohingamuwa Appuhamilage Supun Induwara', 'B. A. S. Induwara', 'Male', '1986-10-10', 3, '51, Pahala Murutenge, Wewagama', '', '+94777102734', '', '', '', '', '', '', NULL, NULL, NULL),
(17, '740052942V', 'Donkey Monkey', 'D. Monkey', 'Male', '1974-01-05', 3, 'asdsa', '', '+94789898542', '', '', '', '', '', '', NULL, NULL, NULL),
(18, '852524515V', 'Resa Asd AS Asd Asdasdasd', 'R. A. A. A. Asdasdasd', 'Male', '1985-09-08', 3, 'sda', '', '+94718185874', '', '', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `general_account`
--

CREATE TABLE `general_account` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `account_id` varchar(10) NOT NULL COMMENT 'Account ID',
  `type` enum('NON_CURRENT_ASSET','CURRENT_ASSET','NON_CURRENT_LIABILITY','CURRENT_LIABILITY','CAPITAL','INCOME','EXPENDITURE','SYSTEM') NOT NULL COMMENT 'Type',
  `name` varchar(32) NOT NULL COMMENT 'Name',
  `description` varchar(128) NOT NULL COMMENT 'Description'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_account`
--

INSERT INTO `general_account` (`id`, `account_id`, `type`, `name`, `description`) VALUES
(1, '9000000001', 'CURRENT_LIABILITY', 'PAYABLE', 'Keep payable amount'),
(2, '9000000002', 'CURRENT_ASSET', 'SAFE', 'Main Safe'),
(3, '9000000003', 'INCOME', 'INTEREST', 'Transfer interest at loan recovery'),
(4, '9000000004', 'INCOME', 'PENALTY', 'Transfer penalty at loan recovery'),
(5, '9000000005', 'SYSTEM', 'PARK', 'Intermediate account to divide or merge transaction'),
(6, '9000000006', 'EXPENDITURE', 'EXPENSES', 'General expenses'),
(7, '9000000007', 'CAPITAL', 'INVESTMENT', 'Company Investment'),
(8, '9000000008', 'EXPENDITURE', 'SALARY', 'Employee Salaries'),
(9, '9000000009', 'CURRENT_LIABILITY', 'CHARGES', 'Charges to be payed');

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
  `charges` decimal(10,2) NOT NULL COMMENT 'Charges',
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

INSERT INTO `hp_new_vehicle_loan` (`id`, `vehicle_type`, `vehicle_no`, `engine_no`, `chasis_no`, `model`, `make`, `supplier`, `price`, `loan_amount`, `charges`, `sales_commision_type`, `sales_commision`, `canvassed`, `canvassing_commision_type`, `canvassing_commision`, `insurance`, `rmv_sent_date`, `rmv_sent_agent`, `rmv_sent_by`, `rmv_recv_date`, `rmv_recv_agent`, `rmv_recv_by`) VALUES
(26, 3, '', '123123131', '123123123', 'Gona', 9, 0, '500000.00', '50000.00', '0.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '1000.00', NULL, '', '', NULL, '', ''),
(27, 3, '', 'sdf', 'sdf', '21', 9, 0, '198000.00', '150000.00', '0.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '1000.00', NULL, '', '', '2017-08-24', '', ''),
(28, 3, 'CAP-6742', 'as', 'asf', '12', 9, NULL, '150000.00', '150000.00', '0.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '100.00', NULL, '', '', NULL, '', ''),
(29, 3, '', '123', '123', '123', 9, 0, '150000.00', '150000.00', '0.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '0.00', NULL, '', '', NULL, '', ''),
(30, 3, '', 'sad', 'sdf', 'sad', 9, NULL, '15000.00', '50000.00', '0.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '234.00', NULL, '', '', NULL, '', ''),
(31, 3, '', 'sdfsf', 'sdf', 'wdfsdf', 9, 3, '100000.00', '100000.00', '0.00', 'Percentage', '1.00', NULL, 'Percentage', NULL, '100.00', NULL, '', '', NULL, '', ''),
(32, 3, '', 'asdf', 'asdf', 'asdf', 9, NULL, '200000.00', '150000.00', '0.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '1000.00', NULL, '', '', NULL, '', ''),
(33, 3, '', '23', '123', '112', 9, 3, '100000.00', '100000.00', '1000.00', 'Percentage', '2.00', 2, 'Amount', '1000.00', '2002.00', NULL, '', '', NULL, '', ''),
(35, 3, '', 'safd', 'adf', 'sdaf', 9, 3, '100000.00', '100000.00', '0.00', 'Percentage', NULL, 2, 'Percentage', NULL, '11.00', NULL, '', '', NULL, '', ''),
(36, 3, '', 'asd', 'sd', 'asd', 9, NULL, '1000.00', '1000.00', '0.00', 'Percentage', NULL, NULL, 'Percentage', NULL, '100.00', NULL, '', '', NULL, '', ''),
(37, 3, 'sad', 'asd', 'asd', 'sadsd', 9, 3, '100000.00', '100000.00', '1000.00', 'Percentage', '1.00', 2, 'Percentage', '1.00', '100.00', NULL, '', '', NULL, '', ''),
(38, 3, 'sdf', 'sdfsd', 'sdf', 'sdf', 9, 3, '2321.00', '123122.97', '123.00', 'Percentage', '1.00', NULL, 'Percentage', NULL, '12.00', NULL, '', '', NULL, '', ''),
(39, 3, 'sdf', 'sdfsf', 'sdf', 'sdfs', 9, 3, '100000.00', '100000.00', '1500.00', 'Percentage', '1.00', 2, 'Amount', '500.00', '11.00', NULL, '', '', NULL, '', '');

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
(26, 1, 16, '1000000026', '2000000026', '50000.00', '12.00', '3.00', '0.00', 1, 36, 'ACTIVE', '2017-06-25', NULL, '1660.71', '9785.56', '59785.56', NULL, NULL, NULL, 0),
(27, 1, 16, '1000000027', '2000000027', '150000.00', '12.00', '3.00', '0.00', 1, 36, 'ACTIVE', '2017-06-14', NULL, '4982.14', '29357.04', '179357.04', NULL, NULL, NULL, 0),
(28, 1, 16, '1000000028', '2000000028', '150000.00', '12.00', '3.00', '0.00', 1, 35, 'ACTIVE', '2017-06-13', NULL, '5100.55', '28519.25', '178519.25', NULL, NULL, NULL, 242),
(29, 1, 16, '1000000029', '2000000029', '150000.00', '12.00', '3.00', '0.00', 1, 36, 'ACTIVE', '2017-07-30', NULL, '4982.14', '29357.04', '179357.04', NULL, NULL, NULL, 225),
(30, 1, 16, '1000000030', '2000000030', '50000.00', '12.00', '3.00', '0.00', 1, 36, 'ACTIVE', '2017-08-02', NULL, '1660.71', '9785.56', '59785.56', NULL, NULL, NULL, 224),
(31, 1, 16, '1000000031', '2000000031', '100000.00', '12.00', '0.00', '1000.00', 1, 36, 'ACTIVE', '2017-08-02', NULL, '3349.20', '20571.48', '120571.48', NULL, NULL, NULL, 223),
(32, 1, 16, '1000000032', '2000000032', '150000.00', '12.00', '3.00', '0.00', 1, 24, 'ACTIVE', '2017-08-03', NULL, '7061.02', '19464.48', '169464.48', NULL, NULL, NULL, 0),
(33, 1, 16, '1000000033', '2000000033', '100000.00', '12.00', '3.00', '4000.00', 1, 36, 'ACTIVE', '2017-06-01', NULL, '3432.54', '23571.48', '123571.48', NULL, NULL, NULL, 0),
(35, 1, 17, '1000000035', '2000000035', '100000.00', '12.00', '0.00', '0.00', 1, 36, 'ACTIVE', '2017-08-07', NULL, '3321.43', '19571.48', '119571.48', NULL, NULL, NULL, 241),
(36, 1, 17, '1000000036', '2000000036', '1000.00', '12.00', '3.00', '0.00', 1, 36, 'ACTIVE', '2017-08-07', NULL, '33.21', '195.56', '1195.56', 16, NULL, NULL, 238),
(37, 1, 18, '1000000037', '2000000037', '100000.00', '12.00', '0.00', '3000.00', 1, 36, 'ACTIVE', '2017-08-07', NULL, '3404.76', '22571.48', '122571.48', NULL, NULL, NULL, 234),
(38, 1, 16, '1000000038', '2000000038', '123122.97', '12.00', '3.00', '1354.23', 1, 36, 'ACTIVE', '2017-08-07', NULL, '4127.05', '25451.10', '148574.07', NULL, NULL, NULL, 246),
(39, 1, 18, '1000000039', '2000000039', '100000.00', '12.00', '3.00', '3000.00', 1, 36, 'ACTIVE', '2017-08-08', NULL, '3404.76', '22571.48', '122571.48', NULL, NULL, NULL, 259);

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
(26, 1, 'PAYED', '2017-07-25', '1160.71', '500.00', '0.00', 0, '0.00', '1660.71', '0.00', '48839.29'),
(26, 2, 'PENDING', '2017-08-25', '1172.32', '488.39', '0.00', 0, '0.00', '0.00', '0.00', '47666.97'),
(26, 3, 'PENDING', '2017-09-25', '1184.04', '476.67', '0.00', 0, '0.00', '0.00', '0.00', '46482.93'),
(26, 4, 'PENDING', '2017-10-25', '1195.88', '464.83', '0.00', 0, '0.00', '0.00', '0.00', '45287.05'),
(26, 5, 'PENDING', '2017-11-25', '1207.84', '452.87', '0.00', 0, '0.00', '0.00', '0.00', '44079.21'),
(26, 6, 'PENDING', '2017-12-25', '1219.92', '440.79', '0.00', 0, '0.00', '0.00', '0.00', '42859.29'),
(26, 7, 'PENDING', '2018-01-25', '1232.12', '428.59', '0.00', 0, '0.00', '0.00', '0.00', '41627.17'),
(26, 8, 'PENDING', '2018-02-25', '1244.44', '416.27', '0.00', 0, '0.00', '0.00', '0.00', '40382.73'),
(26, 9, 'PENDING', '2018-03-25', '1256.88', '403.83', '0.00', 0, '0.00', '0.00', '0.00', '39125.85'),
(26, 10, 'PENDING', '2018-04-25', '1269.45', '391.26', '0.00', 0, '0.00', '0.00', '0.00', '37856.40'),
(26, 11, 'PENDING', '2018-05-25', '1282.15', '378.56', '0.00', 0, '0.00', '0.00', '0.00', '36574.25'),
(26, 12, 'PENDING', '2018-06-25', '1294.97', '365.74', '0.00', 0, '0.00', '0.00', '0.00', '35279.28'),
(26, 13, 'PENDING', '2018-07-25', '1307.92', '352.79', '0.00', 0, '0.00', '0.00', '0.00', '33971.36'),
(26, 14, 'PENDING', '2018-08-25', '1321.00', '339.71', '0.00', 0, '0.00', '0.00', '0.00', '32650.36'),
(26, 15, 'PENDING', '2018-09-25', '1334.21', '326.50', '0.00', 0, '0.00', '0.00', '0.00', '31316.15'),
(26, 16, 'PENDING', '2018-10-25', '1347.55', '313.16', '0.00', 0, '0.00', '0.00', '0.00', '29968.60'),
(26, 17, 'PENDING', '2018-11-25', '1361.02', '299.69', '0.00', 0, '0.00', '0.00', '0.00', '28607.58'),
(26, 18, 'PENDING', '2018-12-25', '1374.63', '286.08', '0.00', 0, '0.00', '0.00', '0.00', '27232.95'),
(26, 19, 'PENDING', '2019-01-25', '1388.38', '272.33', '0.00', 0, '0.00', '0.00', '0.00', '25844.57'),
(26, 20, 'PENDING', '2019-02-25', '1402.26', '258.45', '0.00', 0, '0.00', '0.00', '0.00', '24442.31'),
(26, 21, 'PENDING', '2019-03-25', '1416.29', '244.42', '0.00', 0, '0.00', '0.00', '0.00', '23026.02'),
(26, 22, 'PENDING', '2019-04-25', '1430.45', '230.26', '0.00', 0, '0.00', '0.00', '0.00', '21595.57'),
(26, 23, 'PENDING', '2019-05-25', '1444.75', '215.96', '0.00', 0, '0.00', '0.00', '0.00', '20150.82'),
(26, 24, 'PENDING', '2019-06-25', '1459.20', '201.51', '0.00', 0, '0.00', '0.00', '0.00', '18691.62'),
(26, 25, 'PENDING', '2019-07-25', '1473.79', '186.92', '0.00', 0, '0.00', '0.00', '0.00', '17217.83'),
(26, 26, 'PENDING', '2019-08-25', '1488.53', '172.18', '0.00', 0, '0.00', '0.00', '0.00', '15729.30'),
(26, 27, 'PENDING', '2019-09-25', '1503.42', '157.29', '0.00', 0, '0.00', '0.00', '0.00', '14225.88'),
(26, 28, 'PENDING', '2019-10-25', '1518.45', '142.26', '0.00', 0, '0.00', '0.00', '0.00', '12707.43'),
(26, 29, 'PENDING', '2019-11-25', '1533.64', '127.07', '0.00', 0, '0.00', '0.00', '0.00', '11173.79'),
(26, 30, 'PENDING', '2019-12-25', '1548.97', '111.74', '0.00', 0, '0.00', '0.00', '0.00', '9624.82'),
(26, 31, 'PENDING', '2020-01-25', '1564.46', '96.25', '0.00', 0, '0.00', '0.00', '0.00', '8060.36'),
(26, 32, 'PENDING', '2020-02-25', '1580.11', '80.60', '0.00', 0, '0.00', '0.00', '0.00', '6480.25'),
(26, 33, 'PENDING', '2020-03-25', '1595.91', '64.80', '0.00', 0, '0.00', '0.00', '0.00', '4884.34'),
(26, 34, 'PENDING', '2020-04-25', '1611.87', '48.84', '0.00', 0, '0.00', '0.00', '0.00', '3272.47'),
(26, 35, 'PENDING', '2020-05-25', '1627.99', '32.72', '0.00', 0, '0.00', '0.00', '0.00', '1644.48'),
(26, 36, 'PENDING', '2020-06-25', '1644.48', '16.23', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(27, 1, 'PAYED', '2017-07-14', '3482.14', '1500.00', '0.00', 1, '149.46', '5131.60', '0.00', '146517.86'),
(27, 2, 'PENDING', '2017-08-14', '3516.96', '1465.18', '0.00', 0, '0.00', '0.00', '0.00', '143000.90'),
(27, 3, 'PENDING', '2017-09-14', '3552.13', '1430.01', '0.00', 0, '0.00', '0.00', '0.00', '139448.77'),
(27, 4, 'PENDING', '2017-10-14', '3587.65', '1394.49', '0.00', 0, '0.00', '0.00', '0.00', '135861.12'),
(27, 5, 'PENDING', '2017-11-14', '3623.53', '1358.61', '0.00', 0, '0.00', '0.00', '0.00', '132237.59'),
(27, 6, 'PENDING', '2017-12-14', '3659.76', '1322.38', '0.00', 0, '0.00', '0.00', '0.00', '128577.83'),
(27, 7, 'PENDING', '2018-01-14', '3696.36', '1285.78', '0.00', 0, '0.00', '0.00', '0.00', '124881.47'),
(27, 8, 'PENDING', '2018-02-14', '3733.33', '1248.81', '0.00', 0, '0.00', '0.00', '0.00', '121148.14'),
(27, 9, 'PENDING', '2018-03-14', '3770.66', '1211.48', '0.00', 0, '0.00', '0.00', '0.00', '117377.48'),
(27, 10, 'PENDING', '2018-04-14', '3808.37', '1173.77', '0.00', 0, '0.00', '0.00', '0.00', '113569.11'),
(27, 11, 'PENDING', '2018-05-14', '3846.45', '1135.69', '0.00', 0, '0.00', '0.00', '0.00', '109722.66'),
(27, 12, 'PENDING', '2018-06-14', '3884.91', '1097.23', '0.00', 0, '0.00', '0.00', '0.00', '105837.75'),
(27, 13, 'PENDING', '2018-07-14', '3923.76', '1058.38', '0.00', 0, '0.00', '0.00', '0.00', '101913.99'),
(27, 14, 'PENDING', '2018-08-14', '3963.00', '1019.14', '0.00', 0, '0.00', '0.00', '0.00', '97950.99'),
(27, 15, 'PENDING', '2018-09-14', '4002.63', '979.51', '0.00', 0, '0.00', '0.00', '0.00', '93948.36'),
(27, 16, 'PENDING', '2018-10-14', '4042.66', '939.48', '0.00', 0, '0.00', '0.00', '0.00', '89905.70'),
(27, 17, 'PENDING', '2018-11-14', '4083.08', '899.06', '0.00', 0, '0.00', '0.00', '0.00', '85822.62'),
(27, 18, 'PENDING', '2018-12-14', '4123.91', '858.23', '0.00', 0, '0.00', '0.00', '0.00', '81698.71'),
(27, 19, 'PENDING', '2019-01-14', '4165.15', '816.99', '0.00', 0, '0.00', '0.00', '0.00', '77533.56'),
(27, 20, 'PENDING', '2019-02-14', '4206.80', '775.34', '0.00', 0, '0.00', '0.00', '0.00', '73326.76'),
(27, 21, 'PENDING', '2019-03-14', '4248.87', '733.27', '0.00', 0, '0.00', '0.00', '0.00', '69077.89'),
(27, 22, 'PENDING', '2019-04-14', '4291.36', '690.78', '0.00', 0, '0.00', '0.00', '0.00', '64786.53'),
(27, 23, 'PENDING', '2019-05-14', '4334.27', '647.87', '0.00', 0, '0.00', '0.00', '0.00', '60452.26'),
(27, 24, 'PENDING', '2019-06-14', '4377.62', '604.52', '0.00', 0, '0.00', '0.00', '0.00', '56074.64'),
(27, 25, 'PENDING', '2019-07-14', '4421.39', '560.75', '0.00', 0, '0.00', '0.00', '0.00', '51653.25'),
(27, 26, 'PENDING', '2019-08-14', '4465.61', '516.53', '0.00', 0, '0.00', '0.00', '0.00', '47187.64'),
(27, 27, 'PENDING', '2019-09-14', '4510.26', '471.88', '0.00', 0, '0.00', '0.00', '0.00', '42677.38'),
(27, 28, 'PENDING', '2019-10-14', '4555.37', '426.77', '0.00', 0, '0.00', '0.00', '0.00', '38122.01'),
(27, 29, 'PENDING', '2019-11-14', '4600.92', '381.22', '0.00', 0, '0.00', '0.00', '0.00', '33521.09'),
(27, 30, 'PENDING', '2019-12-14', '4646.93', '335.21', '0.00', 0, '0.00', '0.00', '0.00', '28874.16'),
(27, 31, 'PENDING', '2020-01-14', '4693.40', '288.74', '0.00', 0, '0.00', '0.00', '0.00', '24180.76'),
(27, 32, 'PENDING', '2020-02-14', '4740.33', '241.81', '0.00', 0, '0.00', '0.00', '0.00', '19440.43'),
(27, 33, 'PENDING', '2020-03-14', '4787.74', '194.40', '0.00', 0, '0.00', '0.00', '0.00', '14652.69'),
(27, 34, 'PENDING', '2020-04-14', '4835.61', '146.53', '0.00', 0, '0.00', '0.00', '0.00', '9817.08'),
(27, 35, 'PENDING', '2020-05-14', '4883.97', '98.17', '0.00', 0, '0.00', '0.00', '0.00', '4933.11'),
(27, 36, 'PENDING', '2020-06-14', '4933.11', '49.03', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(28, 1, 'PAYED', '2017-07-13', '3600.55', '1500.00', '0.00', 1, '153.02', '5253.57', '0.00', '146399.45'),
(28, 2, 'PENDING', '2017-08-13', '3636.56', '1463.99', '0.00', 0, '0.00', '0.00', '0.00', '142762.89'),
(28, 3, 'PENDING', '2017-09-13', '3672.92', '1427.63', '0.00', 0, '0.00', '0.00', '0.00', '139089.97'),
(28, 4, 'PENDING', '2017-10-13', '3709.65', '1390.90', '0.00', 0, '0.00', '0.00', '0.00', '135380.32'),
(28, 5, 'PENDING', '2017-11-13', '3746.75', '1353.80', '0.00', 0, '0.00', '0.00', '0.00', '131633.57'),
(28, 6, 'PENDING', '2017-12-13', '3784.21', '1316.34', '0.00', 0, '0.00', '0.00', '0.00', '127849.36'),
(28, 7, 'PENDING', '2018-01-13', '3822.06', '1278.49', '0.00', 0, '0.00', '0.00', '0.00', '124027.30'),
(28, 8, 'PENDING', '2018-02-13', '3860.28', '1240.27', '0.00', 0, '0.00', '0.00', '0.00', '120167.02'),
(28, 9, 'PENDING', '2018-03-13', '3898.88', '1201.67', '0.00', 0, '0.00', '0.00', '0.00', '116268.14'),
(28, 10, 'PENDING', '2018-04-13', '3937.87', '1162.68', '0.00', 0, '0.00', '0.00', '0.00', '112330.27'),
(28, 11, 'PENDING', '2018-05-13', '3977.25', '1123.30', '0.00', 0, '0.00', '0.00', '0.00', '108353.02'),
(28, 12, 'PENDING', '2018-06-13', '4017.02', '1083.53', '0.00', 0, '0.00', '0.00', '0.00', '104336.00'),
(28, 13, 'PENDING', '2018-07-13', '4057.19', '1043.36', '0.00', 0, '0.00', '0.00', '0.00', '100278.81'),
(28, 14, 'PENDING', '2018-08-13', '4097.76', '1002.79', '0.00', 0, '0.00', '0.00', '0.00', '96181.05'),
(28, 15, 'PENDING', '2018-09-13', '4138.74', '961.81', '0.00', 0, '0.00', '0.00', '0.00', '92042.31'),
(28, 16, 'PENDING', '2018-10-13', '4180.13', '920.42', '0.00', 0, '0.00', '0.00', '0.00', '87862.18'),
(28, 17, 'PENDING', '2018-11-13', '4221.93', '878.62', '0.00', 0, '0.00', '0.00', '0.00', '83640.25'),
(28, 18, 'PENDING', '2018-12-13', '4264.15', '836.40', '0.00', 0, '0.00', '0.00', '0.00', '79376.10'),
(28, 19, 'PENDING', '2019-01-13', '4306.79', '793.76', '0.00', 0, '0.00', '0.00', '0.00', '75069.31'),
(28, 20, 'PENDING', '2019-02-13', '4349.86', '750.69', '0.00', 0, '0.00', '0.00', '0.00', '70719.45'),
(28, 21, 'PENDING', '2019-03-13', '4393.36', '707.19', '0.00', 0, '0.00', '0.00', '0.00', '66326.09'),
(28, 22, 'PENDING', '2019-04-13', '4437.29', '663.26', '0.00', 0, '0.00', '0.00', '0.00', '61888.80'),
(28, 23, 'PENDING', '2019-05-13', '4481.66', '618.89', '0.00', 0, '0.00', '0.00', '0.00', '57407.14'),
(28, 24, 'PENDING', '2019-06-13', '4526.48', '574.07', '0.00', 0, '0.00', '0.00', '0.00', '52880.66'),
(28, 25, 'PENDING', '2019-07-13', '4571.74', '528.81', '0.00', 0, '0.00', '0.00', '0.00', '48308.92'),
(28, 26, 'PENDING', '2019-08-13', '4617.46', '483.09', '0.00', 0, '0.00', '0.00', '0.00', '43691.46'),
(28, 27, 'PENDING', '2019-09-13', '4663.64', '436.91', '0.00', 0, '0.00', '0.00', '0.00', '39027.82'),
(28, 28, 'PENDING', '2019-10-13', '4710.27', '390.28', '0.00', 0, '0.00', '0.00', '0.00', '34317.55'),
(28, 29, 'PENDING', '2019-11-13', '4757.37', '343.18', '0.00', 0, '0.00', '0.00', '0.00', '29560.18'),
(28, 30, 'PENDING', '2019-12-13', '4804.95', '295.60', '0.00', 0, '0.00', '0.00', '0.00', '24755.23'),
(28, 31, 'PENDING', '2020-01-13', '4853.00', '247.55', '0.00', 0, '0.00', '0.00', '0.00', '19902.23'),
(28, 32, 'PENDING', '2020-02-13', '4901.53', '199.02', '0.00', 0, '0.00', '0.00', '0.00', '15000.70'),
(28, 33, 'PENDING', '2020-03-13', '4950.54', '150.01', '0.00', 0, '0.00', '0.00', '0.00', '10050.16'),
(28, 34, 'PENDING', '2020-04-13', '5000.05', '100.50', '0.00', 0, '0.00', '0.00', '0.00', '5050.11'),
(28, 35, 'PENDING', '2020-05-13', '5050.11', '50.44', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(29, 1, 'PENDING', '2017-08-30', '3482.14', '1500.00', '0.00', 0, '0.00', '0.00', '0.00', '146517.86'),
(29, 2, 'PENDING', '2017-09-30', '3516.96', '1465.18', '0.00', 0, '0.00', '0.00', '0.00', '143000.90'),
(29, 3, 'PENDING', '2017-10-30', '3552.13', '1430.01', '0.00', 0, '0.00', '0.00', '0.00', '139448.77'),
(29, 4, 'PENDING', '2017-11-30', '3587.65', '1394.49', '0.00', 0, '0.00', '0.00', '0.00', '135861.12'),
(29, 5, 'PENDING', '2017-12-30', '3623.53', '1358.61', '0.00', 0, '0.00', '0.00', '0.00', '132237.59'),
(29, 6, 'PENDING', '2018-01-30', '3659.76', '1322.38', '0.00', 0, '0.00', '0.00', '0.00', '128577.83'),
(29, 7, 'PENDING', '2018-03-02', '3696.36', '1285.78', '0.00', 0, '0.00', '0.00', '0.00', '124881.47'),
(29, 8, 'PENDING', '2018-04-02', '3733.33', '1248.81', '0.00', 0, '0.00', '0.00', '0.00', '121148.14'),
(29, 9, 'PENDING', '2018-05-02', '3770.66', '1211.48', '0.00', 0, '0.00', '0.00', '0.00', '117377.48'),
(29, 10, 'PENDING', '2018-06-02', '3808.37', '1173.77', '0.00', 0, '0.00', '0.00', '0.00', '113569.11'),
(29, 11, 'PENDING', '2018-07-02', '3846.45', '1135.69', '0.00', 0, '0.00', '0.00', '0.00', '109722.66'),
(29, 12, 'PENDING', '2018-08-02', '3884.91', '1097.23', '0.00', 0, '0.00', '0.00', '0.00', '105837.75'),
(29, 13, 'PENDING', '2018-09-02', '3923.76', '1058.38', '0.00', 0, '0.00', '0.00', '0.00', '101913.99'),
(29, 14, 'PENDING', '2018-10-02', '3963.00', '1019.14', '0.00', 0, '0.00', '0.00', '0.00', '97950.99'),
(29, 15, 'PENDING', '2018-11-02', '4002.63', '979.51', '0.00', 0, '0.00', '0.00', '0.00', '93948.36'),
(29, 16, 'PENDING', '2018-12-02', '4042.66', '939.48', '0.00', 0, '0.00', '0.00', '0.00', '89905.70'),
(29, 17, 'PENDING', '2019-01-02', '4083.08', '899.06', '0.00', 0, '0.00', '0.00', '0.00', '85822.62'),
(29, 18, 'PENDING', '2019-02-02', '4123.91', '858.23', '0.00', 0, '0.00', '0.00', '0.00', '81698.71'),
(29, 19, 'PENDING', '2019-03-02', '4165.15', '816.99', '0.00', 0, '0.00', '0.00', '0.00', '77533.56'),
(29, 20, 'PENDING', '2019-04-02', '4206.80', '775.34', '0.00', 0, '0.00', '0.00', '0.00', '73326.76'),
(29, 21, 'PENDING', '2019-05-02', '4248.87', '733.27', '0.00', 0, '0.00', '0.00', '0.00', '69077.89'),
(29, 22, 'PENDING', '2019-06-02', '4291.36', '690.78', '0.00', 0, '0.00', '0.00', '0.00', '64786.53'),
(29, 23, 'PENDING', '2019-07-02', '4334.27', '647.87', '0.00', 0, '0.00', '0.00', '0.00', '60452.26'),
(29, 24, 'PENDING', '2019-08-02', '4377.62', '604.52', '0.00', 0, '0.00', '0.00', '0.00', '56074.64'),
(29, 25, 'PENDING', '2019-09-02', '4421.39', '560.75', '0.00', 0, '0.00', '0.00', '0.00', '51653.25'),
(29, 26, 'PENDING', '2019-10-02', '4465.61', '516.53', '0.00', 0, '0.00', '0.00', '0.00', '47187.64'),
(29, 27, 'PENDING', '2019-11-02', '4510.26', '471.88', '0.00', 0, '0.00', '0.00', '0.00', '42677.38'),
(29, 28, 'PENDING', '2019-12-02', '4555.37', '426.77', '0.00', 0, '0.00', '0.00', '0.00', '38122.01'),
(29, 29, 'PENDING', '2020-01-02', '4600.92', '381.22', '0.00', 0, '0.00', '0.00', '0.00', '33521.09'),
(29, 30, 'PENDING', '2020-02-02', '4646.93', '335.21', '0.00', 0, '0.00', '0.00', '0.00', '28874.16'),
(29, 31, 'PENDING', '2020-03-02', '4693.40', '288.74', '0.00', 0, '0.00', '0.00', '0.00', '24180.76'),
(29, 32, 'PENDING', '2020-04-02', '4740.33', '241.81', '0.00', 0, '0.00', '0.00', '0.00', '19440.43'),
(29, 33, 'PENDING', '2020-05-02', '4787.74', '194.40', '0.00', 0, '0.00', '0.00', '0.00', '14652.69'),
(29, 34, 'PENDING', '2020-06-02', '4835.61', '146.53', '0.00', 0, '0.00', '0.00', '0.00', '9817.08'),
(29, 35, 'PENDING', '2020-07-02', '4883.97', '98.17', '0.00', 0, '0.00', '0.00', '0.00', '4933.11'),
(29, 36, 'PENDING', '2020-08-02', '4933.11', '49.03', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(30, 1, 'PENDING', '2017-09-02', '1160.71', '500.00', '0.00', 0, '0.00', '0.00', '0.00', '48839.29'),
(30, 2, 'PENDING', '2017-10-02', '1172.32', '488.39', '0.00', 0, '0.00', '0.00', '0.00', '47666.97'),
(30, 3, 'PENDING', '2017-11-02', '1184.04', '476.67', '0.00', 0, '0.00', '0.00', '0.00', '46482.93'),
(30, 4, 'PENDING', '2017-12-02', '1195.88', '464.83', '0.00', 0, '0.00', '0.00', '0.00', '45287.05'),
(30, 5, 'PENDING', '2018-01-02', '1207.84', '452.87', '0.00', 0, '0.00', '0.00', '0.00', '44079.21'),
(30, 6, 'PENDING', '2018-02-02', '1219.92', '440.79', '0.00', 0, '0.00', '0.00', '0.00', '42859.29'),
(30, 7, 'PENDING', '2018-03-02', '1232.12', '428.59', '0.00', 0, '0.00', '0.00', '0.00', '41627.17'),
(30, 8, 'PENDING', '2018-04-02', '1244.44', '416.27', '0.00', 0, '0.00', '0.00', '0.00', '40382.73'),
(30, 9, 'PENDING', '2018-05-02', '1256.88', '403.83', '0.00', 0, '0.00', '0.00', '0.00', '39125.85'),
(30, 10, 'PENDING', '2018-06-02', '1269.45', '391.26', '0.00', 0, '0.00', '0.00', '0.00', '37856.40'),
(30, 11, 'PENDING', '2018-07-02', '1282.15', '378.56', '0.00', 0, '0.00', '0.00', '0.00', '36574.25'),
(30, 12, 'PENDING', '2018-08-02', '1294.97', '365.74', '0.00', 0, '0.00', '0.00', '0.00', '35279.28'),
(30, 13, 'PENDING', '2018-09-02', '1307.92', '352.79', '0.00', 0, '0.00', '0.00', '0.00', '33971.36'),
(30, 14, 'PENDING', '2018-10-02', '1321.00', '339.71', '0.00', 0, '0.00', '0.00', '0.00', '32650.36'),
(30, 15, 'PENDING', '2018-11-02', '1334.21', '326.50', '0.00', 0, '0.00', '0.00', '0.00', '31316.15'),
(30, 16, 'PENDING', '2018-12-02', '1347.55', '313.16', '0.00', 0, '0.00', '0.00', '0.00', '29968.60'),
(30, 17, 'PENDING', '2019-01-02', '1361.02', '299.69', '0.00', 0, '0.00', '0.00', '0.00', '28607.58'),
(30, 18, 'PENDING', '2019-02-02', '1374.63', '286.08', '0.00', 0, '0.00', '0.00', '0.00', '27232.95'),
(30, 19, 'PENDING', '2019-03-02', '1388.38', '272.33', '0.00', 0, '0.00', '0.00', '0.00', '25844.57'),
(30, 20, 'PENDING', '2019-04-02', '1402.26', '258.45', '0.00', 0, '0.00', '0.00', '0.00', '24442.31'),
(30, 21, 'PENDING', '2019-05-02', '1416.29', '244.42', '0.00', 0, '0.00', '0.00', '0.00', '23026.02'),
(30, 22, 'PENDING', '2019-06-02', '1430.45', '230.26', '0.00', 0, '0.00', '0.00', '0.00', '21595.57'),
(30, 23, 'PENDING', '2019-07-02', '1444.75', '215.96', '0.00', 0, '0.00', '0.00', '0.00', '20150.82'),
(30, 24, 'PENDING', '2019-08-02', '1459.20', '201.51', '0.00', 0, '0.00', '0.00', '0.00', '18691.62'),
(30, 25, 'PENDING', '2019-09-02', '1473.79', '186.92', '0.00', 0, '0.00', '0.00', '0.00', '17217.83'),
(30, 26, 'PENDING', '2019-10-02', '1488.53', '172.18', '0.00', 0, '0.00', '0.00', '0.00', '15729.30'),
(30, 27, 'PENDING', '2019-11-02', '1503.42', '157.29', '0.00', 0, '0.00', '0.00', '0.00', '14225.88'),
(30, 28, 'PENDING', '2019-12-02', '1518.45', '142.26', '0.00', 0, '0.00', '0.00', '0.00', '12707.43'),
(30, 29, 'PENDING', '2020-01-02', '1533.64', '127.07', '0.00', 0, '0.00', '0.00', '0.00', '11173.79'),
(30, 30, 'PENDING', '2020-02-02', '1548.97', '111.74', '0.00', 0, '0.00', '0.00', '0.00', '9624.82'),
(30, 31, 'PENDING', '2020-03-02', '1564.46', '96.25', '0.00', 0, '0.00', '0.00', '0.00', '8060.36'),
(30, 32, 'PENDING', '2020-04-02', '1580.11', '80.60', '0.00', 0, '0.00', '0.00', '0.00', '6480.25'),
(30, 33, 'PENDING', '2020-05-02', '1595.91', '64.80', '0.00', 0, '0.00', '0.00', '0.00', '4884.34'),
(30, 34, 'PENDING', '2020-06-02', '1611.87', '48.84', '0.00', 0, '0.00', '0.00', '0.00', '3272.47'),
(30, 35, 'PENDING', '2020-07-02', '1627.99', '32.72', '0.00', 0, '0.00', '0.00', '0.00', '1644.48'),
(30, 36, 'PENDING', '2020-08-02', '1644.48', '16.23', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(31, 1, 'PENDING', '2017-09-02', '2321.43', '1000.00', '27.77', 0, '0.00', '0.00', '0.00', '97678.57'),
(31, 2, 'PENDING', '2017-10-02', '2344.64', '976.79', '27.77', 0, '0.00', '0.00', '0.00', '95333.93'),
(31, 3, 'PENDING', '2017-11-02', '2368.09', '953.34', '27.77', 0, '0.00', '0.00', '0.00', '92965.84'),
(31, 4, 'PENDING', '2017-12-02', '2391.77', '929.66', '27.77', 0, '0.00', '0.00', '0.00', '90574.07'),
(31, 5, 'PENDING', '2018-01-02', '2415.69', '905.74', '27.77', 0, '0.00', '0.00', '0.00', '88158.38'),
(31, 6, 'PENDING', '2018-02-02', '2439.85', '881.58', '27.77', 0, '0.00', '0.00', '0.00', '85718.53'),
(31, 7, 'PENDING', '2018-03-02', '2464.24', '857.19', '27.77', 0, '0.00', '0.00', '0.00', '83254.29'),
(31, 8, 'PENDING', '2018-04-02', '2488.89', '832.54', '27.77', 0, '0.00', '0.00', '0.00', '80765.40'),
(31, 9, 'PENDING', '2018-05-02', '2513.78', '807.65', '27.77', 0, '0.00', '0.00', '0.00', '78251.62'),
(31, 10, 'PENDING', '2018-06-02', '2538.91', '782.52', '27.77', 0, '0.00', '0.00', '0.00', '75712.71'),
(31, 11, 'PENDING', '2018-07-02', '2564.30', '757.13', '27.77', 0, '0.00', '0.00', '0.00', '73148.41'),
(31, 12, 'PENDING', '2018-08-02', '2589.95', '731.48', '27.77', 0, '0.00', '0.00', '0.00', '70558.46'),
(31, 13, 'PENDING', '2018-09-02', '2615.85', '705.58', '27.77', 0, '0.00', '0.00', '0.00', '67942.61'),
(31, 14, 'PENDING', '2018-10-02', '2642.00', '679.43', '27.77', 0, '0.00', '0.00', '0.00', '65300.61'),
(31, 15, 'PENDING', '2018-11-02', '2668.42', '653.01', '27.77', 0, '0.00', '0.00', '0.00', '62632.19'),
(31, 16, 'PENDING', '2018-12-02', '2695.11', '626.32', '27.77', 0, '0.00', '0.00', '0.00', '59937.08'),
(31, 17, 'PENDING', '2019-01-02', '2722.06', '599.37', '27.77', 0, '0.00', '0.00', '0.00', '57215.02'),
(31, 18, 'PENDING', '2019-02-02', '2749.28', '572.15', '27.77', 0, '0.00', '0.00', '0.00', '54465.74'),
(31, 19, 'PENDING', '2019-03-02', '2776.77', '544.66', '27.77', 0, '0.00', '0.00', '0.00', '51688.97'),
(31, 20, 'PENDING', '2019-04-02', '2804.54', '516.89', '27.77', 0, '0.00', '0.00', '0.00', '48884.43'),
(31, 21, 'PENDING', '2019-05-02', '2832.59', '488.84', '27.77', 0, '0.00', '0.00', '0.00', '46051.84'),
(31, 22, 'PENDING', '2019-06-02', '2860.91', '460.52', '27.77', 0, '0.00', '0.00', '0.00', '43190.93'),
(31, 23, 'PENDING', '2019-07-02', '2889.52', '431.91', '27.77', 0, '0.00', '0.00', '0.00', '40301.41'),
(31, 24, 'PENDING', '2019-08-02', '2918.42', '403.01', '27.77', 0, '0.00', '0.00', '0.00', '37382.99'),
(31, 25, 'PENDING', '2019-09-02', '2947.60', '373.83', '27.77', 0, '0.00', '0.00', '0.00', '34435.39'),
(31, 26, 'PENDING', '2019-10-02', '2977.08', '344.35', '27.77', 0, '0.00', '0.00', '0.00', '31458.31'),
(31, 27, 'PENDING', '2019-11-02', '3006.85', '314.58', '27.77', 0, '0.00', '0.00', '0.00', '28451.46'),
(31, 28, 'PENDING', '2019-12-02', '3036.92', '284.51', '27.77', 0, '0.00', '0.00', '0.00', '25414.54'),
(31, 29, 'PENDING', '2020-01-02', '3067.28', '254.15', '27.77', 0, '0.00', '0.00', '0.00', '22347.26'),
(31, 30, 'PENDING', '2020-02-02', '3097.96', '223.47', '27.77', 0, '0.00', '0.00', '0.00', '19249.30'),
(31, 31, 'PENDING', '2020-03-02', '3128.94', '192.49', '27.77', 0, '0.00', '0.00', '0.00', '16120.36'),
(31, 32, 'PENDING', '2020-04-02', '3160.23', '161.20', '27.77', 0, '0.00', '0.00', '0.00', '12960.13'),
(31, 33, 'PENDING', '2020-05-02', '3191.83', '129.60', '27.77', 0, '0.00', '0.00', '0.00', '9768.30'),
(31, 34, 'PENDING', '2020-06-02', '3223.75', '97.68', '27.77', 0, '0.00', '0.00', '0.00', '6544.55'),
(31, 35, 'PENDING', '2020-07-02', '3255.98', '65.45', '27.77', 0, '0.00', '0.00', '0.00', '3288.57'),
(31, 36, 'PENDING', '2020-08-02', '3288.57', '32.58', '28.05', 0, '0.00', '0.00', '0.00', '0.00'),
(32, 1, 'PENDING', '2017-09-03', '5561.02', '1500.00', '0.00', 0, '0.00', '0.00', '0.00', '144438.98'),
(32, 2, 'PENDING', '2017-10-03', '5616.63', '1444.39', '0.00', 0, '0.00', '0.00', '0.00', '138822.35'),
(32, 3, 'PENDING', '2017-11-03', '5672.80', '1388.22', '0.00', 0, '0.00', '0.00', '0.00', '133149.55'),
(32, 4, 'PENDING', '2017-12-03', '5729.52', '1331.50', '0.00', 0, '0.00', '0.00', '0.00', '127420.03'),
(32, 5, 'PENDING', '2018-01-03', '5786.82', '1274.20', '0.00', 0, '0.00', '0.00', '0.00', '121633.21'),
(32, 6, 'PENDING', '2018-02-03', '5844.69', '1216.33', '0.00', 0, '0.00', '0.00', '0.00', '115788.52'),
(32, 7, 'PENDING', '2018-03-03', '5903.13', '1157.89', '0.00', 0, '0.00', '0.00', '0.00', '109885.39'),
(32, 8, 'PENDING', '2018-04-03', '5962.17', '1098.85', '0.00', 0, '0.00', '0.00', '0.00', '103923.22'),
(32, 9, 'PENDING', '2018-05-03', '6021.79', '1039.23', '0.00', 0, '0.00', '0.00', '0.00', '97901.43'),
(32, 10, 'PENDING', '2018-06-03', '6082.01', '979.01', '0.00', 0, '0.00', '0.00', '0.00', '91819.42'),
(32, 11, 'PENDING', '2018-07-03', '6142.83', '918.19', '0.00', 0, '0.00', '0.00', '0.00', '85676.59'),
(32, 12, 'PENDING', '2018-08-03', '6204.25', '856.77', '0.00', 0, '0.00', '0.00', '0.00', '79472.34'),
(32, 13, 'PENDING', '2018-09-03', '6266.30', '794.72', '0.00', 0, '0.00', '0.00', '0.00', '73206.04'),
(32, 14, 'PENDING', '2018-10-03', '6328.96', '732.06', '0.00', 0, '0.00', '0.00', '0.00', '66877.08'),
(32, 15, 'PENDING', '2018-11-03', '6392.25', '668.77', '0.00', 0, '0.00', '0.00', '0.00', '60484.83'),
(32, 16, 'PENDING', '2018-12-03', '6456.17', '604.85', '0.00', 0, '0.00', '0.00', '0.00', '54028.66'),
(32, 17, 'PENDING', '2019-01-03', '6520.73', '540.29', '0.00', 0, '0.00', '0.00', '0.00', '47507.93'),
(32, 18, 'PENDING', '2019-02-03', '6585.94', '475.08', '0.00', 0, '0.00', '0.00', '0.00', '40921.99'),
(32, 19, 'PENDING', '2019-03-03', '6651.80', '409.22', '0.00', 0, '0.00', '0.00', '0.00', '34270.19'),
(32, 20, 'PENDING', '2019-04-03', '6718.32', '342.70', '0.00', 0, '0.00', '0.00', '0.00', '27551.87'),
(32, 21, 'PENDING', '2019-05-03', '6785.50', '275.52', '0.00', 0, '0.00', '0.00', '0.00', '20766.37'),
(32, 22, 'PENDING', '2019-06-03', '6853.36', '207.66', '0.00', 0, '0.00', '0.00', '0.00', '13913.01'),
(32, 23, 'PENDING', '2019-07-03', '6921.89', '139.13', '0.00', 0, '0.00', '0.00', '0.00', '6991.12'),
(32, 24, 'PENDING', '2019-08-03', '6991.12', '69.90', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(33, 1, 'PENDING', '2017-07-01', '2321.43', '1000.00', '111.11', 0, '0.00', '0.00', '0.00', '97678.57'),
(33, 2, 'PENDING', '2017-08-01', '2344.64', '976.79', '111.11', 0, '0.00', '0.00', '0.00', '95333.93'),
(33, 3, 'PENDING', '2017-09-01', '2368.09', '953.34', '111.11', 0, '0.00', '0.00', '0.00', '92965.84'),
(33, 4, 'PENDING', '2017-10-01', '2391.77', '929.66', '111.11', 0, '0.00', '0.00', '0.00', '90574.07'),
(33, 5, 'PENDING', '2017-11-01', '2415.69', '905.74', '111.11', 0, '0.00', '0.00', '0.00', '88158.38'),
(33, 6, 'PENDING', '2017-12-01', '2439.85', '881.58', '111.11', 0, '0.00', '0.00', '0.00', '85718.53'),
(33, 7, 'PENDING', '2018-01-01', '2464.24', '857.19', '111.11', 0, '0.00', '0.00', '0.00', '83254.29'),
(33, 8, 'PENDING', '2018-02-01', '2488.89', '832.54', '111.11', 0, '0.00', '0.00', '0.00', '80765.40'),
(33, 9, 'PENDING', '2018-03-01', '2513.78', '807.65', '111.11', 0, '0.00', '0.00', '0.00', '78251.62'),
(33, 10, 'PENDING', '2018-04-01', '2538.91', '782.52', '111.11', 0, '0.00', '0.00', '0.00', '75712.71'),
(33, 11, 'PENDING', '2018-05-01', '2564.30', '757.13', '111.11', 0, '0.00', '0.00', '0.00', '73148.41'),
(33, 12, 'PENDING', '2018-06-01', '2589.95', '731.48', '111.11', 0, '0.00', '0.00', '0.00', '70558.46'),
(33, 13, 'PENDING', '2018-07-01', '2615.85', '705.58', '111.11', 0, '0.00', '0.00', '0.00', '67942.61'),
(33, 14, 'PENDING', '2018-08-01', '2642.00', '679.43', '111.11', 0, '0.00', '0.00', '0.00', '65300.61'),
(33, 15, 'PENDING', '2018-09-01', '2668.42', '653.01', '111.11', 0, '0.00', '0.00', '0.00', '62632.19'),
(33, 16, 'PENDING', '2018-10-01', '2695.11', '626.32', '111.11', 0, '0.00', '0.00', '0.00', '59937.08'),
(33, 17, 'PENDING', '2018-11-01', '2722.06', '599.37', '111.11', 0, '0.00', '0.00', '0.00', '57215.02'),
(33, 18, 'PENDING', '2018-12-01', '2749.28', '572.15', '111.11', 0, '0.00', '0.00', '0.00', '54465.74'),
(33, 19, 'PENDING', '2019-01-01', '2776.77', '544.66', '111.11', 0, '0.00', '0.00', '0.00', '51688.97'),
(33, 20, 'PENDING', '2019-02-01', '2804.54', '516.89', '111.11', 0, '0.00', '0.00', '0.00', '48884.43'),
(33, 21, 'PENDING', '2019-03-01', '2832.59', '488.84', '111.11', 0, '0.00', '0.00', '0.00', '46051.84'),
(33, 22, 'PENDING', '2019-04-01', '2860.91', '460.52', '111.11', 0, '0.00', '0.00', '0.00', '43190.93'),
(33, 23, 'PENDING', '2019-05-01', '2889.52', '431.91', '111.11', 0, '0.00', '0.00', '0.00', '40301.41'),
(33, 24, 'PENDING', '2019-06-01', '2918.42', '403.01', '111.11', 0, '0.00', '0.00', '0.00', '37382.99'),
(33, 25, 'PENDING', '2019-07-01', '2947.60', '373.83', '111.11', 0, '0.00', '0.00', '0.00', '34435.39'),
(33, 26, 'PENDING', '2019-08-01', '2977.08', '344.35', '111.11', 0, '0.00', '0.00', '0.00', '31458.31'),
(33, 27, 'PENDING', '2019-09-01', '3006.85', '314.58', '111.11', 0, '0.00', '0.00', '0.00', '28451.46'),
(33, 28, 'PENDING', '2019-10-01', '3036.92', '284.51', '111.11', 0, '0.00', '0.00', '0.00', '25414.54'),
(33, 29, 'PENDING', '2019-11-01', '3067.28', '254.15', '111.11', 0, '0.00', '0.00', '0.00', '22347.26'),
(33, 30, 'PENDING', '2019-12-01', '3097.96', '223.47', '111.11', 0, '0.00', '0.00', '0.00', '19249.30'),
(33, 31, 'PENDING', '2020-01-01', '3128.94', '192.49', '111.11', 0, '0.00', '0.00', '0.00', '16120.36'),
(33, 32, 'PENDING', '2020-02-01', '3160.23', '161.20', '111.11', 0, '0.00', '0.00', '0.00', '12960.13'),
(33, 33, 'PENDING', '2020-03-01', '3191.83', '129.60', '111.11', 0, '0.00', '0.00', '0.00', '9768.30'),
(33, 34, 'PENDING', '2020-04-01', '3223.75', '97.68', '111.11', 0, '0.00', '0.00', '0.00', '6544.55'),
(33, 35, 'PENDING', '2020-05-01', '3255.98', '65.45', '111.11', 0, '0.00', '0.00', '0.00', '3288.57'),
(33, 36, 'PENDING', '2020-06-01', '3288.57', '32.82', '111.15', 0, '0.00', '0.00', '0.00', '0.00'),
(35, 1, 'PENDING', '2017-09-07', '2321.43', '1000.00', '0.00', 0, '0.00', '0.00', '0.00', '97678.57'),
(35, 2, 'PENDING', '2017-10-07', '2344.64', '976.79', '0.00', 0, '0.00', '0.00', '0.00', '95333.93'),
(35, 3, 'PENDING', '2017-11-07', '2368.09', '953.34', '0.00', 0, '0.00', '0.00', '0.00', '92965.84'),
(35, 4, 'PENDING', '2017-12-07', '2391.77', '929.66', '0.00', 0, '0.00', '0.00', '0.00', '90574.07'),
(35, 5, 'PENDING', '2018-01-07', '2415.69', '905.74', '0.00', 0, '0.00', '0.00', '0.00', '88158.38'),
(35, 6, 'PENDING', '2018-02-07', '2439.85', '881.58', '0.00', 0, '0.00', '0.00', '0.00', '85718.53'),
(35, 7, 'PENDING', '2018-03-07', '2464.24', '857.19', '0.00', 0, '0.00', '0.00', '0.00', '83254.29'),
(35, 8, 'PENDING', '2018-04-07', '2488.89', '832.54', '0.00', 0, '0.00', '0.00', '0.00', '80765.40'),
(35, 9, 'PENDING', '2018-05-07', '2513.78', '807.65', '0.00', 0, '0.00', '0.00', '0.00', '78251.62'),
(35, 10, 'PENDING', '2018-06-07', '2538.91', '782.52', '0.00', 0, '0.00', '0.00', '0.00', '75712.71'),
(35, 11, 'PENDING', '2018-07-07', '2564.30', '757.13', '0.00', 0, '0.00', '0.00', '0.00', '73148.41'),
(35, 12, 'PENDING', '2018-08-07', '2589.95', '731.48', '0.00', 0, '0.00', '0.00', '0.00', '70558.46'),
(35, 13, 'PENDING', '2018-09-07', '2615.85', '705.58', '0.00', 0, '0.00', '0.00', '0.00', '67942.61'),
(35, 14, 'PENDING', '2018-10-07', '2642.00', '679.43', '0.00', 0, '0.00', '0.00', '0.00', '65300.61'),
(35, 15, 'PENDING', '2018-11-07', '2668.42', '653.01', '0.00', 0, '0.00', '0.00', '0.00', '62632.19'),
(35, 16, 'PENDING', '2018-12-07', '2695.11', '626.32', '0.00', 0, '0.00', '0.00', '0.00', '59937.08'),
(35, 17, 'PENDING', '2019-01-07', '2722.06', '599.37', '0.00', 0, '0.00', '0.00', '0.00', '57215.02'),
(35, 18, 'PENDING', '2019-02-07', '2749.28', '572.15', '0.00', 0, '0.00', '0.00', '0.00', '54465.74'),
(35, 19, 'PENDING', '2019-03-07', '2776.77', '544.66', '0.00', 0, '0.00', '0.00', '0.00', '51688.97'),
(35, 20, 'PENDING', '2019-04-07', '2804.54', '516.89', '0.00', 0, '0.00', '0.00', '0.00', '48884.43'),
(35, 21, 'PENDING', '2019-05-07', '2832.59', '488.84', '0.00', 0, '0.00', '0.00', '0.00', '46051.84'),
(35, 22, 'PENDING', '2019-06-07', '2860.91', '460.52', '0.00', 0, '0.00', '0.00', '0.00', '43190.93'),
(35, 23, 'PENDING', '2019-07-07', '2889.52', '431.91', '0.00', 0, '0.00', '0.00', '0.00', '40301.41'),
(35, 24, 'PENDING', '2019-08-07', '2918.42', '403.01', '0.00', 0, '0.00', '0.00', '0.00', '37382.99'),
(35, 25, 'PENDING', '2019-09-07', '2947.60', '373.83', '0.00', 0, '0.00', '0.00', '0.00', '34435.39'),
(35, 26, 'PENDING', '2019-10-07', '2977.08', '344.35', '0.00', 0, '0.00', '0.00', '0.00', '31458.31'),
(35, 27, 'PENDING', '2019-11-07', '3006.85', '314.58', '0.00', 0, '0.00', '0.00', '0.00', '28451.46'),
(35, 28, 'PENDING', '2019-12-07', '3036.92', '284.51', '0.00', 0, '0.00', '0.00', '0.00', '25414.54'),
(35, 29, 'PENDING', '2020-01-07', '3067.28', '254.15', '0.00', 0, '0.00', '0.00', '0.00', '22347.26'),
(35, 30, 'PENDING', '2020-02-07', '3097.96', '223.47', '0.00', 0, '0.00', '0.00', '0.00', '19249.30'),
(35, 31, 'PENDING', '2020-03-07', '3128.94', '192.49', '0.00', 0, '0.00', '0.00', '0.00', '16120.36'),
(35, 32, 'PENDING', '2020-04-07', '3160.23', '161.20', '0.00', 0, '0.00', '0.00', '0.00', '12960.13'),
(35, 33, 'PENDING', '2020-05-07', '3191.83', '129.60', '0.00', 0, '0.00', '0.00', '0.00', '9768.30'),
(35, 34, 'PENDING', '2020-06-07', '3223.75', '97.68', '0.00', 0, '0.00', '0.00', '0.00', '6544.55'),
(35, 35, 'PENDING', '2020-07-07', '3255.98', '65.45', '0.00', 0, '0.00', '0.00', '0.00', '3288.57'),
(35, 36, 'PENDING', '2020-08-07', '3288.57', '32.86', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(36, 1, 'PENDING', '2017-09-07', '23.21', '10.00', '0.00', 0, '0.00', '0.00', '0.00', '976.79'),
(36, 2, 'PENDING', '2017-10-07', '23.44', '9.77', '0.00', 0, '0.00', '0.00', '0.00', '953.35'),
(36, 3, 'PENDING', '2017-11-07', '23.68', '9.53', '0.00', 0, '0.00', '0.00', '0.00', '929.67'),
(36, 4, 'PENDING', '2017-12-07', '23.91', '9.30', '0.00', 0, '0.00', '0.00', '0.00', '905.76'),
(36, 5, 'PENDING', '2018-01-07', '24.15', '9.06', '0.00', 0, '0.00', '0.00', '0.00', '881.61'),
(36, 6, 'PENDING', '2018-02-07', '24.39', '8.82', '0.00', 0, '0.00', '0.00', '0.00', '857.22'),
(36, 7, 'PENDING', '2018-03-07', '24.64', '8.57', '0.00', 0, '0.00', '0.00', '0.00', '832.58'),
(36, 8, 'PENDING', '2018-04-07', '24.88', '8.33', '0.00', 0, '0.00', '0.00', '0.00', '807.70'),
(36, 9, 'PENDING', '2018-05-07', '25.13', '8.08', '0.00', 0, '0.00', '0.00', '0.00', '782.57'),
(36, 10, 'PENDING', '2018-06-07', '25.38', '7.83', '0.00', 0, '0.00', '0.00', '0.00', '757.19'),
(36, 11, 'PENDING', '2018-07-07', '25.64', '7.57', '0.00', 0, '0.00', '0.00', '0.00', '731.55'),
(36, 12, 'PENDING', '2018-08-07', '25.89', '7.32', '0.00', 0, '0.00', '0.00', '0.00', '705.66'),
(36, 13, 'PENDING', '2018-09-07', '26.15', '7.06', '0.00', 0, '0.00', '0.00', '0.00', '679.51'),
(36, 14, 'PENDING', '2018-10-07', '26.41', '6.80', '0.00', 0, '0.00', '0.00', '0.00', '653.10'),
(36, 15, 'PENDING', '2018-11-07', '26.68', '6.53', '0.00', 0, '0.00', '0.00', '0.00', '626.42'),
(36, 16, 'PENDING', '2018-12-07', '26.95', '6.26', '0.00', 0, '0.00', '0.00', '0.00', '599.47'),
(36, 17, 'PENDING', '2019-01-07', '27.22', '5.99', '0.00', 0, '0.00', '0.00', '0.00', '572.25'),
(36, 18, 'PENDING', '2019-02-07', '27.49', '5.72', '0.00', 0, '0.00', '0.00', '0.00', '544.76'),
(36, 19, 'PENDING', '2019-03-07', '27.76', '5.45', '0.00', 0, '0.00', '0.00', '0.00', '517.00'),
(36, 20, 'PENDING', '2019-04-07', '28.04', '5.17', '0.00', 0, '0.00', '0.00', '0.00', '488.96'),
(36, 21, 'PENDING', '2019-05-07', '28.32', '4.89', '0.00', 0, '0.00', '0.00', '0.00', '460.64'),
(36, 22, 'PENDING', '2019-06-07', '28.60', '4.61', '0.00', 0, '0.00', '0.00', '0.00', '432.04'),
(36, 23, 'PENDING', '2019-07-07', '28.89', '4.32', '0.00', 0, '0.00', '0.00', '0.00', '403.15'),
(36, 24, 'PENDING', '2019-08-07', '29.18', '4.03', '0.00', 0, '0.00', '0.00', '0.00', '373.97'),
(36, 25, 'PENDING', '2019-09-07', '29.47', '3.74', '0.00', 0, '0.00', '0.00', '0.00', '344.50'),
(36, 26, 'PENDING', '2019-10-07', '29.76', '3.45', '0.00', 0, '0.00', '0.00', '0.00', '314.74'),
(36, 27, 'PENDING', '2019-11-07', '30.06', '3.15', '0.00', 0, '0.00', '0.00', '0.00', '284.68'),
(36, 28, 'PENDING', '2019-12-07', '30.36', '2.85', '0.00', 0, '0.00', '0.00', '0.00', '254.32'),
(36, 29, 'PENDING', '2020-01-07', '30.67', '2.54', '0.00', 0, '0.00', '0.00', '0.00', '223.65'),
(36, 30, 'PENDING', '2020-02-07', '30.97', '2.24', '0.00', 0, '0.00', '0.00', '0.00', '192.68'),
(36, 31, 'PENDING', '2020-03-07', '31.28', '1.93', '0.00', 0, '0.00', '0.00', '0.00', '161.40'),
(36, 32, 'PENDING', '2020-04-07', '31.60', '1.61', '0.00', 0, '0.00', '0.00', '0.00', '129.80'),
(36, 33, 'PENDING', '2020-05-07', '31.91', '1.30', '0.00', 0, '0.00', '0.00', '0.00', '97.89'),
(36, 34, 'PENDING', '2020-06-07', '32.23', '0.98', '0.00', 0, '0.00', '0.00', '0.00', '65.66'),
(36, 35, 'PENDING', '2020-07-07', '32.55', '0.66', '0.00', 0, '0.00', '0.00', '0.00', '33.11'),
(36, 36, 'PENDING', '2020-08-07', '33.11', '0.10', '0.00', 0, '0.00', '0.00', '0.00', '0.00'),
(37, 1, 'PENDING', '2017-09-07', '2321.43', '1000.00', '83.33', 0, '0.00', '0.00', '0.00', '97678.57'),
(37, 2, 'PENDING', '2017-10-07', '2344.64', '976.79', '83.33', 0, '0.00', '0.00', '0.00', '95333.93'),
(37, 3, 'PENDING', '2017-11-07', '2368.09', '953.34', '83.33', 0, '0.00', '0.00', '0.00', '92965.84'),
(37, 4, 'PENDING', '2017-12-07', '2391.77', '929.66', '83.33', 0, '0.00', '0.00', '0.00', '90574.07'),
(37, 5, 'PENDING', '2018-01-07', '2415.69', '905.74', '83.33', 0, '0.00', '0.00', '0.00', '88158.38'),
(37, 6, 'PENDING', '2018-02-07', '2439.85', '881.58', '83.33', 0, '0.00', '0.00', '0.00', '85718.53'),
(37, 7, 'PENDING', '2018-03-07', '2464.24', '857.19', '83.33', 0, '0.00', '0.00', '0.00', '83254.29'),
(37, 8, 'PENDING', '2018-04-07', '2488.89', '832.54', '83.33', 0, '0.00', '0.00', '0.00', '80765.40'),
(37, 9, 'PENDING', '2018-05-07', '2513.78', '807.65', '83.33', 0, '0.00', '0.00', '0.00', '78251.62'),
(37, 10, 'PENDING', '2018-06-07', '2538.91', '782.52', '83.33', 0, '0.00', '0.00', '0.00', '75712.71'),
(37, 11, 'PENDING', '2018-07-07', '2564.30', '757.13', '83.33', 0, '0.00', '0.00', '0.00', '73148.41'),
(37, 12, 'PENDING', '2018-08-07', '2589.95', '731.48', '83.33', 0, '0.00', '0.00', '0.00', '70558.46'),
(37, 13, 'PENDING', '2018-09-07', '2615.85', '705.58', '83.33', 0, '0.00', '0.00', '0.00', '67942.61'),
(37, 14, 'PENDING', '2018-10-07', '2642.00', '679.43', '83.33', 0, '0.00', '0.00', '0.00', '65300.61'),
(37, 15, 'PENDING', '2018-11-07', '2668.42', '653.01', '83.33', 0, '0.00', '0.00', '0.00', '62632.19'),
(37, 16, 'PENDING', '2018-12-07', '2695.11', '626.32', '83.33', 0, '0.00', '0.00', '0.00', '59937.08'),
(37, 17, 'PENDING', '2019-01-07', '2722.06', '599.37', '83.33', 0, '0.00', '0.00', '0.00', '57215.02'),
(37, 18, 'PENDING', '2019-02-07', '2749.28', '572.15', '83.33', 0, '0.00', '0.00', '0.00', '54465.74'),
(37, 19, 'PENDING', '2019-03-07', '2776.77', '544.66', '83.33', 0, '0.00', '0.00', '0.00', '51688.97'),
(37, 20, 'PENDING', '2019-04-07', '2804.54', '516.89', '83.33', 0, '0.00', '0.00', '0.00', '48884.43'),
(37, 21, 'PENDING', '2019-05-07', '2832.59', '488.84', '83.33', 0, '0.00', '0.00', '0.00', '46051.84'),
(37, 22, 'PENDING', '2019-06-07', '2860.91', '460.52', '83.33', 0, '0.00', '0.00', '0.00', '43190.93'),
(37, 23, 'PENDING', '2019-07-07', '2889.52', '431.91', '83.33', 0, '0.00', '0.00', '0.00', '40301.41'),
(37, 24, 'PENDING', '2019-08-07', '2918.42', '403.01', '83.33', 0, '0.00', '0.00', '0.00', '37382.99'),
(37, 25, 'PENDING', '2019-09-07', '2947.60', '373.83', '83.33', 0, '0.00', '0.00', '0.00', '34435.39'),
(37, 26, 'PENDING', '2019-10-07', '2977.08', '344.35', '83.33', 0, '0.00', '0.00', '0.00', '31458.31'),
(37, 27, 'PENDING', '2019-11-07', '3006.85', '314.58', '83.33', 0, '0.00', '0.00', '0.00', '28451.46'),
(37, 28, 'PENDING', '2019-12-07', '3036.92', '284.51', '83.33', 0, '0.00', '0.00', '0.00', '25414.54'),
(37, 29, 'PENDING', '2020-01-07', '3067.28', '254.15', '83.33', 0, '0.00', '0.00', '0.00', '22347.26'),
(37, 30, 'PENDING', '2020-02-07', '3097.96', '223.47', '83.33', 0, '0.00', '0.00', '0.00', '19249.30'),
(37, 31, 'PENDING', '2020-03-07', '3128.94', '192.49', '83.33', 0, '0.00', '0.00', '0.00', '16120.36'),
(37, 32, 'PENDING', '2020-04-07', '3160.23', '161.20', '83.33', 0, '0.00', '0.00', '0.00', '12960.13'),
(37, 33, 'PENDING', '2020-05-07', '3191.83', '129.60', '83.33', 0, '0.00', '0.00', '0.00', '9768.30'),
(37, 34, 'PENDING', '2020-06-07', '3223.75', '97.68', '83.33', 0, '0.00', '0.00', '0.00', '6544.55'),
(37, 35, 'PENDING', '2020-07-07', '3255.98', '65.45', '83.33', 0, '0.00', '0.00', '0.00', '3288.57'),
(37, 36, 'PENDING', '2020-08-07', '3288.57', '32.74', '83.45', 0, '0.00', '0.00', '0.00', '0.00'),
(38, 1, 'PENDING', '2017-09-07', '2858.21', '1231.23', '37.61', 0, '0.00', '0.00', '0.00', '120264.76'),
(38, 2, 'PENDING', '2017-10-07', '2886.79', '1202.65', '37.61', 0, '0.00', '0.00', '0.00', '117377.97'),
(38, 3, 'PENDING', '2017-11-07', '2915.66', '1173.78', '37.61', 0, '0.00', '0.00', '0.00', '114462.31'),
(38, 4, 'PENDING', '2017-12-07', '2944.82', '1144.62', '37.61', 0, '0.00', '0.00', '0.00', '111517.49'),
(38, 5, 'PENDING', '2018-01-07', '2974.27', '1115.17', '37.61', 0, '0.00', '0.00', '0.00', '108543.22'),
(38, 6, 'PENDING', '2018-02-07', '3004.01', '1085.43', '37.61', 0, '0.00', '0.00', '0.00', '105539.21'),
(38, 7, 'PENDING', '2018-03-07', '3034.05', '1055.39', '37.61', 0, '0.00', '0.00', '0.00', '102505.16'),
(38, 8, 'PENDING', '2018-04-07', '3064.39', '1025.05', '37.61', 0, '0.00', '0.00', '0.00', '99440.77'),
(38, 9, 'PENDING', '2018-05-07', '3095.03', '994.41', '37.61', 0, '0.00', '0.00', '0.00', '96345.74'),
(38, 10, 'PENDING', '2018-06-07', '3125.98', '963.46', '37.61', 0, '0.00', '0.00', '0.00', '93219.76'),
(38, 11, 'PENDING', '2018-07-07', '3157.24', '932.20', '37.61', 0, '0.00', '0.00', '0.00', '90062.52'),
(38, 12, 'PENDING', '2018-08-07', '3188.81', '900.63', '37.61', 0, '0.00', '0.00', '0.00', '86873.71'),
(38, 13, 'PENDING', '2018-09-07', '3220.70', '868.74', '37.61', 0, '0.00', '0.00', '0.00', '83653.01'),
(38, 14, 'PENDING', '2018-10-07', '3252.91', '836.53', '37.61', 0, '0.00', '0.00', '0.00', '80400.10'),
(38, 15, 'PENDING', '2018-11-07', '3285.44', '804.00', '37.61', 0, '0.00', '0.00', '0.00', '77114.66'),
(38, 16, 'PENDING', '2018-12-07', '3318.29', '771.15', '37.61', 0, '0.00', '0.00', '0.00', '73796.37'),
(38, 17, 'PENDING', '2019-01-07', '3351.48', '737.96', '37.61', 0, '0.00', '0.00', '0.00', '70444.89'),
(38, 18, 'PENDING', '2019-02-07', '3384.99', '704.45', '37.61', 0, '0.00', '0.00', '0.00', '67059.90'),
(38, 19, 'PENDING', '2019-03-07', '3418.84', '670.60', '37.61', 0, '0.00', '0.00', '0.00', '63641.06'),
(38, 20, 'PENDING', '2019-04-07', '3453.03', '636.41', '37.61', 0, '0.00', '0.00', '0.00', '60188.03'),
(38, 21, 'PENDING', '2019-05-07', '3487.56', '601.88', '37.61', 0, '0.00', '0.00', '0.00', '56700.47'),
(38, 22, 'PENDING', '2019-06-07', '3522.44', '567.00', '37.61', 0, '0.00', '0.00', '0.00', '53178.03'),
(38, 23, 'PENDING', '2019-07-07', '3557.66', '531.78', '37.61', 0, '0.00', '0.00', '0.00', '49620.37'),
(38, 24, 'PENDING', '2019-08-07', '3593.24', '496.20', '37.61', 0, '0.00', '0.00', '0.00', '46027.13'),
(38, 25, 'PENDING', '2019-09-07', '3629.17', '460.27', '37.61', 0, '0.00', '0.00', '0.00', '42397.96'),
(38, 26, 'PENDING', '2019-10-07', '3665.46', '423.98', '37.61', 0, '0.00', '0.00', '0.00', '38732.50'),
(38, 27, 'PENDING', '2019-11-07', '3702.11', '387.33', '37.61', 0, '0.00', '0.00', '0.00', '35030.39'),
(38, 28, 'PENDING', '2019-12-07', '3739.14', '350.30', '37.61', 0, '0.00', '0.00', '0.00', '31291.25'),
(38, 29, 'PENDING', '2020-01-07', '3776.53', '312.91', '37.61', 0, '0.00', '0.00', '0.00', '27514.72'),
(38, 30, 'PENDING', '2020-02-07', '3814.29', '275.15', '37.61', 0, '0.00', '0.00', '0.00', '23700.43'),
(38, 31, 'PENDING', '2020-03-07', '3852.44', '237.00', '37.61', 0, '0.00', '0.00', '0.00', '19847.99'),
(38, 32, 'PENDING', '2020-04-07', '3890.96', '198.48', '37.61', 0, '0.00', '0.00', '0.00', '15957.03'),
(38, 33, 'PENDING', '2020-05-07', '3929.87', '159.57', '37.61', 0, '0.00', '0.00', '0.00', '12027.16'),
(38, 34, 'PENDING', '2020-06-07', '3969.17', '120.27', '37.61', 0, '0.00', '0.00', '0.00', '8057.99'),
(38, 35, 'PENDING', '2020-07-07', '4008.86', '80.58', '37.61', 0, '0.00', '0.00', '0.00', '4049.13'),
(38, 36, 'PENDING', '2020-08-07', '4049.13', '40.04', '37.88', 0, '0.00', '0.00', '0.00', '0.00'),
(39, 1, 'PENDING', '2017-09-08', '2321.43', '1000.00', '83.33', 0, '0.00', '0.00', '0.00', '97678.57'),
(39, 2, 'PENDING', '2017-10-08', '2344.64', '976.79', '83.33', 0, '0.00', '0.00', '0.00', '95333.93'),
(39, 3, 'PENDING', '2017-11-08', '2368.09', '953.34', '83.33', 0, '0.00', '0.00', '0.00', '92965.84'),
(39, 4, 'PENDING', '2017-12-08', '2391.77', '929.66', '83.33', 0, '0.00', '0.00', '0.00', '90574.07'),
(39, 5, 'PENDING', '2018-01-08', '2415.69', '905.74', '83.33', 0, '0.00', '0.00', '0.00', '88158.38'),
(39, 6, 'PENDING', '2018-02-08', '2439.85', '881.58', '83.33', 0, '0.00', '0.00', '0.00', '85718.53'),
(39, 7, 'PENDING', '2018-03-08', '2464.24', '857.19', '83.33', 0, '0.00', '0.00', '0.00', '83254.29'),
(39, 8, 'PENDING', '2018-04-08', '2488.89', '832.54', '83.33', 0, '0.00', '0.00', '0.00', '80765.40'),
(39, 9, 'PENDING', '2018-05-08', '2513.78', '807.65', '83.33', 0, '0.00', '0.00', '0.00', '78251.62'),
(39, 10, 'PENDING', '2018-06-08', '2538.91', '782.52', '83.33', 0, '0.00', '0.00', '0.00', '75712.71'),
(39, 11, 'PENDING', '2018-07-08', '2564.30', '757.13', '83.33', 0, '0.00', '0.00', '0.00', '73148.41'),
(39, 12, 'PENDING', '2018-08-08', '2589.95', '731.48', '83.33', 0, '0.00', '0.00', '0.00', '70558.46'),
(39, 13, 'PENDING', '2018-09-08', '2615.85', '705.58', '83.33', 0, '0.00', '0.00', '0.00', '67942.61'),
(39, 14, 'PENDING', '2018-10-08', '2642.00', '679.43', '83.33', 0, '0.00', '0.00', '0.00', '65300.61'),
(39, 15, 'PENDING', '2018-11-08', '2668.42', '653.01', '83.33', 0, '0.00', '0.00', '0.00', '62632.19'),
(39, 16, 'PENDING', '2018-12-08', '2695.11', '626.32', '83.33', 0, '0.00', '0.00', '0.00', '59937.08'),
(39, 17, 'PENDING', '2019-01-08', '2722.06', '599.37', '83.33', 0, '0.00', '0.00', '0.00', '57215.02'),
(39, 18, 'PENDING', '2019-02-08', '2749.28', '572.15', '83.33', 0, '0.00', '0.00', '0.00', '54465.74'),
(39, 19, 'PENDING', '2019-03-08', '2776.77', '544.66', '83.33', 0, '0.00', '0.00', '0.00', '51688.97'),
(39, 20, 'PENDING', '2019-04-08', '2804.54', '516.89', '83.33', 0, '0.00', '0.00', '0.00', '48884.43'),
(39, 21, 'PENDING', '2019-05-08', '2832.59', '488.84', '83.33', 0, '0.00', '0.00', '0.00', '46051.84'),
(39, 22, 'PENDING', '2019-06-08', '2860.91', '460.52', '83.33', 0, '0.00', '0.00', '0.00', '43190.93'),
(39, 23, 'PENDING', '2019-07-08', '2889.52', '431.91', '83.33', 0, '0.00', '0.00', '0.00', '40301.41'),
(39, 24, 'PENDING', '2019-08-08', '2918.42', '403.01', '83.33', 0, '0.00', '0.00', '0.00', '37382.99'),
(39, 25, 'PENDING', '2019-09-08', '2947.60', '373.83', '83.33', 0, '0.00', '0.00', '0.00', '34435.39'),
(39, 26, 'PENDING', '2019-10-08', '2977.08', '344.35', '83.33', 0, '0.00', '0.00', '0.00', '31458.31'),
(39, 27, 'PENDING', '2019-11-08', '3006.85', '314.58', '83.33', 0, '0.00', '0.00', '0.00', '28451.46'),
(39, 28, 'PENDING', '2019-12-08', '3036.92', '284.51', '83.33', 0, '0.00', '0.00', '0.00', '25414.54'),
(39, 29, 'PENDING', '2020-01-08', '3067.28', '254.15', '83.33', 0, '0.00', '0.00', '0.00', '22347.26'),
(39, 30, 'PENDING', '2020-02-08', '3097.96', '223.47', '83.33', 0, '0.00', '0.00', '0.00', '19249.30'),
(39, 31, 'PENDING', '2020-03-08', '3128.94', '192.49', '83.33', 0, '0.00', '0.00', '0.00', '16120.36'),
(39, 32, 'PENDING', '2020-04-08', '3160.23', '161.20', '83.33', 0, '0.00', '0.00', '0.00', '12960.13'),
(39, 33, 'PENDING', '2020-05-08', '3191.83', '129.60', '83.33', 0, '0.00', '0.00', '0.00', '9768.30'),
(39, 34, 'PENDING', '2020-06-08', '3223.75', '97.68', '83.33', 0, '0.00', '0.00', '0.00', '6544.55'),
(39, 35, 'PENDING', '2020-07-08', '3255.98', '65.45', '83.33', 0, '0.00', '0.00', '0.00', '3288.57'),
(39, 36, 'PENDING', '2020-08-08', '3288.57', '32.74', '83.45', 0, '0.00', '0.00', '0.00', '0.00');

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
(3, 'Gona', '3000000003', 'ACTIVE', '', 'asd', '+94787672122', '', '', NULL, '', '');

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
  `user` varchar(32) NOT NULL COMMENT 'User',
  `description` varchar(128) NOT NULL COMMENT 'Description'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`txid`, `timestamp`, `cr_account`, `dr_account`, `cr_balance`, `dr_balance`, `amount`, `type`, `payment`, `cheque`, `txlink`, `user`, `description`) VALUES
(187, '2017-07-31 04:19:02', '9000000007', '9000000002', '100000.00', '-100000.00', '100000.00', 'INVESTMENT', 'INTERNAL', NULL, '597eafb60e6c4', '', 'Initial investment'),
(188, '2017-07-31 04:24:12', '9000000002', '8000000001', '-50000.00', '-50000.00', '50000.00', 'INTENAL', 'INTERNAL', NULL, '597eb0ecbfe1d', '', 'Morning'),
(189, '2017-07-31 04:32:40', '9000000005', '2000000026', '50000.00', '-50000.00', '50000.00', 'DISBURSE', 'INTERNAL', NULL, '597eb2e8222e1', '', 'Disbursement of the loan #26'),
(190, '2017-07-31 04:32:40', '9000000001', '9000000005', '50000.00', '0.00', '50000.00', 'DISBURSE', 'INTERNAL', NULL, '597eb2e8222e1', '', 'Disbursement of the loan #26'),
(191, '2017-07-31 04:35:42', '1000000026', '8000000003', '1700.00', '-1700.00', '1700.00', 'RECEIPT', 'CASH', '', '597eb38cd0be5', '', 'Loan receipt #26'),
(192, '2017-07-31 04:35:42', '9000000005', '1000000026', '1660.71', '39.29', '1660.71', 'RECOVERY', 'INTERNAL', NULL, '597eb39ebb90a', '', 'Installment recovery of loan #26 for 2017-07-25'),
(193, '2017-07-31 04:35:42', '2000000026', '9000000005', '-48839.29', '500.00', '1160.71', 'CAPITAL', 'INTERNAL', NULL, '597eb39ebb90a', '', 'Capital recovery of loan #26 for 2017-07-25'),
(194, '2017-07-31 04:35:42', '9000000003', '9000000005', '500.00', '0.00', '500.00', 'INTEREST', 'INTERNAL', NULL, '597eb39ebb90a', '', 'Interest recovery of loan #26 for 2017-07-25'),
(195, '2017-08-01 17:52:53', '9000000005', '2000000027', '150000.00', '-150000.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '5980bff536d49', '', 'Disbursement of the loan #27'),
(196, '2017-08-01 17:52:53', '9000000001', '9000000005', '200000.00', '0.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '5980bff536d49', '', 'Disbursement of the loan #27'),
(197, '2017-08-01 17:53:51', '1000000027', '8000000001', '6000.00', '-56000.00', '6000.00', 'RECEIPT', 'CASH', '', '5980c000dc287', '', 'Loan receipt #27'),
(198, '2017-08-01 17:53:51', '9000000004', '1000000027', '149.46', '5850.54', '149.46', 'PENALTY', 'INTERNAL', NULL, '5980c02fa9567', '', 'Penalty charge for loan #27'),
(200, '2017-08-01 18:00:54', '9000000005', '1000000027', '4982.14', '868.40', '4982.14', 'RECOVERY', 'INTERNAL', NULL, '5980c1cc45a8f', '', 'Installment recovery of loan #27 for 2017-07-14'),
(201, '2017-08-01 18:00:55', '2000000027', '9000000005', '-146517.86', '1500.00', '3482.14', 'CAPITAL', 'INTERNAL', NULL, '5980c1cc45a8f', '', 'Capital recovery of loan #27 for 2017-07-14'),
(202, '2017-08-01 18:00:55', '9000000003', '9000000005', '2000.00', '0.00', '1500.00', 'INTEREST', 'INTERNAL', NULL, '5980c1cc45a8f', '', 'Interest recovery of loan #27 for 2017-07-14'),
(203, '2017-08-01 18:10:13', '9000000005', '2000000028', '150000.00', '-150000.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '5980c40561538', '', 'Disbursement of the loan #28'),
(204, '2017-08-01 18:10:13', '9000000001', '9000000005', '350000.00', '0.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '5980c40561538', '', 'Disbursement of the loan #28'),
(205, '2017-08-01 18:11:02', '1000000028', '8000000001', '6000.00', '-62000.00', '6000.00', 'RECEIPT', 'CASH', '', '5980c425cf4de', '', 'Loan receipt #28'),
(206, '2017-08-01 18:11:03', '9000000004', '1000000028', '302.48', '5846.98', '153.02', 'PENALTY', 'INTERNAL', NULL, '5980c436ec596', '', 'Penalty charge for loan #28'),
(207, '2017-08-01 18:11:08', '9000000005', '1000000028', '5100.55', '746.43', '5100.55', 'RECOVERY', 'INTERNAL', NULL, '5980c436ec596', '', 'Installment recovery of loan #28 for 2017-07-13'),
(208, '2017-08-01 18:11:08', '2000000028', '9000000005', '-146399.45', '1500.00', '3600.55', 'CAPITAL', 'INTERNAL', NULL, '5980c436ec596', '', 'Capital recovery of loan #28 for 2017-07-13'),
(209, '2017-08-01 18:11:08', '9000000003', '9000000005', '3500.00', '0.00', '1500.00', 'INTEREST', 'INTERNAL', NULL, '5980c436ec596', '', 'Interest recovery of loan #28 for 2017-07-13'),
(210, '2017-08-01 18:31:51', '9000000005', '2000000030', '50000.00', '-50000.00', '50000.00', 'DISBURSE', 'INTERNAL', NULL, '5980c917af995', '', 'Disbursement of the loan #30'),
(211, '2017-08-01 18:31:51', '9000000001', '9000000005', '400000.00', '0.00', '50000.00', 'DISBURSE', 'INTERNAL', NULL, '5980c917af995', '', 'Disbursement of the loan #30'),
(212, '2017-08-01 18:32:18', '1000000030', '8000000001', '10000.00', '-72000.00', '10000.00', 'RECEIPT', 'CASH', '', '5980c922dbcb3', '', 'Loan receipt #30'),
(213, '2017-08-01 18:35:07', '9000000005', '2000000029', '150000.00', '-150000.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '5980c9db28cae', '', 'Disbursement of the loan #29'),
(214, '2017-08-01 18:35:07', '9000000001', '9000000005', '550000.00', '0.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '5980c9db28cae', '', 'Disbursement of the loan #29'),
(215, '2017-08-02 03:29:05', '1000000027', '8000000001', '1868.40', '-73000.00', '1000.00', 'RECEIPT', 'CASH', '', '598146f3365ba', 'superadmin', 'Loan receipt #27'),
(218, '2017-08-02 04:02:26', '9000000005', '2000000031', '101000.00', '-101000.00', '101000.00', 'DISBURSE', 'INTERNAL', NULL, '59814ed21fab9', 'superadmin', 'Disbursement of the loan #31'),
(219, '2017-08-02 04:02:26', '3000000003', '9000000005', '100000.00', '1000.00', '100000.00', 'DISBURSE', 'INTERNAL', NULL, '59814ed21fab9', 'superadmin', 'Disbursement of the loan #31'),
(220, '2017-08-02 04:02:26', '3000000003', '9000000005', '101000.00', '0.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '59814ed21fab9', 'superadmin', 'Sales commission of the loan #31'),
(221, '2017-08-03 17:38:15', '9000000005', '2000000032', '150000.00', '-150000.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '59835f872b77f', 'superadmin', 'Disbursement of the loan #32'),
(222, '2017-08-03 17:38:15', '9000000001', '9000000005', '700000.00', '0.00', '150000.00', 'DISBURSE', 'INTERNAL', NULL, '59835f872b77f', 'superadmin', 'Disbursement of the loan #32'),
(223, '2017-08-06 07:18:14', '7000000001', '3000000003', '100000.00', '1000.00', '100000.00', 'PAYMENT', 'CASH', NULL, '5986bc83a8529', 'superadmin', 'Loan payment #31'),
(224, '2017-08-06 07:19:09', '7000000001', '9000000001', '150000.00', '650000.00', '50000.00', 'PAYMENT', 'CASH', NULL, '5986c2c4999b3', 'superadmin', 'Loan payment #30'),
(225, '2017-08-06 07:35:49', '7000000001', '9000000001', '300000.00', '500000.00', '150000.00', 'PAYMENT', 'CASH', NULL, '5986c67315ade', 'superadmin', 'Loan payment #29'),
(226, '2017-08-06 09:27:31', '9000000005', '2000000033', '104000.00', '-104000.00', '104000.00', 'DISBURSE', 'INTERNAL', NULL, '5986e10333325', 'superadmin', 'Disbursement of the loan #33'),
(227, '2017-08-06 09:27:31', '3000000003', '9000000005', '101000.00', '4000.00', '100000.00', 'DISBURSE', 'INTERNAL', NULL, '5986e10333325', 'superadmin', 'Disbursement of the loan #33'),
(228, '2017-08-06 09:27:31', '3000000003', '9000000005', '103000.00', '2000.00', '2000.00', 'DISBURSE', 'INTERNAL', NULL, '5986e10333325', 'superadmin', 'Sales commission of the loan #33'),
(229, '2017-08-06 09:27:31', '4000000002', '9000000005', '1000.00', '1000.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '5986e10333325', 'superadmin', 'Canvassing commission of the loan #33'),
(230, '2017-08-07 04:17:26', '9000000005', '2000000037', '104000.00', '-103000.00', '103000.00', 'DISBURSE', 'INTERNAL', NULL, '5987e9d69cd77', 'superadmin', 'Disbursement of the loan #37'),
(231, '2017-08-07 04:17:26', '3000000003', '9000000005', '203000.00', '4000.00', '100000.00', 'DISBURSE', 'INTERNAL', NULL, '5987e9d69cd77', 'superadmin', 'Disbursement of the loan #37'),
(232, '2017-08-07 04:17:26', '3000000003', '9000000005', '204000.00', '3000.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '5987e9d69cd77', 'superadmin', 'Sales commission of the loan #37'),
(233, '2017-08-07 04:17:26', '4000000002', '9000000005', '2000.00', '2000.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '5987e9d69cd77', 'superadmin', 'Canvassing commission of the loan #37'),
(234, '2017-08-07 04:20:17', '7000000001', '3000000003', '400000.00', '104000.00', '100000.00', 'PAYMENT', 'CASH', NULL, '5987e9e19f387', 'superadmin', 'Loan payment #37'),
(235, '2017-08-07 04:43:16', '1000000029', '8000000001', '1000.00', '-74000.00', '1000.00', 'RECEIPT', 'CASH', '', '5987efdd20192', 'superadmin', 'Loan receipt #29'),
(236, '2017-08-07 05:00:10', '9000000005', '2000000036', '3000.00', '-1000.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '5987f3da4f366', 'superadmin', 'Disbursement of the loan #36'),
(237, '2017-08-07 05:00:10', '9000000001', '9000000005', '501000.00', '2000.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '5987f3da4f366', 'superadmin', 'Disbursement of the loan #36'),
(238, '2017-08-07 05:02:23', '7000000001', '9000000001', '401000.00', '500000.00', '1000.00', 'PAYMENT', 'CASH', NULL, '5987f3e0a7fc6', 'superadmin', 'Loan payment #36'),
(239, '2017-08-07 05:03:34', '9000000005', '2000000035', '102000.00', '-100000.00', '100000.00', 'DISBURSE', 'INTERNAL', NULL, '5987f4a65ced5', 'superadmin', 'Disbursement of the loan #35'),
(240, '2017-08-07 05:03:34', '3000000003', '9000000005', '204000.00', '2000.00', '100000.00', 'DISBURSE', 'INTERNAL', NULL, '5987f4a65ced5', 'superadmin', 'Disbursement of the loan #35'),
(241, '2017-08-07 05:03:44', '7000000001', '3000000003', '501000.00', '104000.00', '100000.00', 'PAYMENT', 'CASH', NULL, '5987f4a6ba70e', 'superadmin', 'Loan payment #35'),
(242, '2017-08-07 05:06:44', '7000000001', '9000000001', '651000.00', '350000.00', '150000.00', 'PAYMENT', 'CASH', NULL, '5987f559d6e79', 'superadmin', 'Loan payment #28'),
(243, '2017-08-07 09:17:05', '9000000005', '2000000038', '126477.20', '-124477.20', '124477.20', 'DISBURSE', 'INTERNAL', NULL, '59883011d196e', 'superadmin', 'Disbursement of the loan #38'),
(244, '2017-08-07 09:17:05', '3000000003', '9000000005', '105231.23', '125245.97', '1231.23', 'DISBURSE', 'INTERNAL', NULL, '59883011d196e', 'superadmin', 'Sales commission of the loan #38'),
(245, '2017-08-07 09:17:06', '9000000001', '9000000005', '473122.97', '2123.00', '123122.97', 'DISBURSE', 'INTERNAL', NULL, '59883011d196e', 'superadmin', 'Disbursement of the loan #38'),
(246, '2017-08-07 09:17:16', '7000000001', '9000000001', '774122.97', '350000.00', '123122.97', 'PAYMENT', 'CASH', NULL, '5988301262dd1', 'superadmin', 'Loan payment #38'),
(247, '2017-08-07 10:49:50', '1000000035', '8000000001', '5820.00', '-79820.00', '5820.00', 'RECEIPT', 'CASH', '', '598845c34e032', 'superadmin', 'Loan receipt #35'),
(248, '2017-08-08 03:38:15', '8000000001', '3000000003', '-74588.77', '100000.00', '5231.23', 'PAYMENT', 'CASH', NULL, '598931dc38bf2', 'superadmin', 'Sales commission payment'),
(249, '2017-08-08 03:40:04', '7000000001', '3000000003', '874122.97', '0.00', '100000.00', 'PAYMENT', 'CASH', NULL, '5989328860ee2', 'superadmin', 'Sales commission payment'),
(250, '2017-08-08 03:48:36', '8000000001', '4000000002', '-73588.77', '1000.00', '1000.00', 'PAYMENT', 'CASH', NULL, '5989344e44350', 'superadmin', 'Canvassing commission payment'),
(251, '2017-08-08 03:49:03', '7000000001', '4000000002', '875122.97', '0.00', '1000.00', 'PAYMENT', 'CASH', NULL, '5989349e25b0b', 'superadmin', 'Canvassing commission payment'),
(252, '2017-08-08 04:17:16', '9000000005', '2000000039', '105123.00', '-103000.00', '103000.00', 'DISBURSE', 'INTERNAL', NULL, '59893b4c93517', 'superadmin', 'Disbursement of the loan #39'),
(253, '2017-08-08 04:17:16', '9000000001', '9000000005', '450000.00', '5123.00', '100000.00', 'DISBURSE', 'INTERNAL', NULL, '59893b4c93517', 'superadmin', 'Disbursement of the loan #39'),
(254, '2017-08-08 04:17:16', '9000000009', '9000000005', '1500.00', '3623.00', '1500.00', 'DISBURSE', 'INTERNAL', NULL, '59893b4c93517', 'superadmin', 'Disbursement other charges of the loan #39'),
(255, '2017-08-08 04:17:16', '3000000003', '9000000005', '1000.00', '2623.00', '1000.00', 'DISBURSE', 'INTERNAL', NULL, '59893b4c93517', 'superadmin', 'Sales commission of the loan #39'),
(256, '2017-08-08 04:17:16', '4000000002', '9000000005', '500.00', '2123.00', '500.00', 'DISBURSE', 'INTERNAL', NULL, '59893b4c93517', 'superadmin', 'Canvassing commission of the loan #39'),
(257, '2017-08-08 04:18:36', '8000000001', '9000000009', '-73088.77', '1000.00', '500.00', 'PAYMENT', 'CASH', NULL, '59893b8bb5097', 'superadmin', 'Charges payment'),
(258, '2017-08-08 04:19:22', '7000000001', '9000000009', '876122.97', '0.00', '1000.00', 'PAYMENT', 'CASH', NULL, '59893bba15ff5', 'superadmin', 'RMV'),
(259, '2017-08-08 04:20:27', '7000000001', '9000000001', '976122.97', '350000.00', '100000.00', 'PAYMENT', 'CASH', NULL, '59893b4d13c41', 'superadmin', 'Loan payment #39');

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
(39, '597eaaf390d0c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 3, 1501473523, 'Chrome', 'Windows'),
(40, '597eab3e465df', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501473598, 'Chrome', 'Windows'),
(41, '597f2f1fc4ede', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501507359, 'Chrome', 'Windows'),
(42, '597f40c40e3f4', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501511876, 'Chrome', 'Windows'),
(43, '597ff7ee8f4b1', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501558766, 'Chrome', 'Windows'),
(44, '5980bce75c546', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501609191, 'Chrome', 'Windows'),
(45, '598146edbdd70', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501644525, 'Chrome', 'Windows'),
(46, '598345e231928', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501775330, 'Chrome', 'Windows'),
(47, '59835b5a9cb25', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501780826, 'Chrome', 'Windows'),
(48, '5985fb5902e51', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501952857, 'Chrome', 'Windows'),
(49, '5985fe108dc20', '192.168.8.100', 'en', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 Mobile/14G60 Safari/602.1', 1, 1501953552, 'iPhone', 'iPhone'),
(50, '5986b1f2f3591', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1501999603, 'Chrome', 'Windows'),
(51, '5986fc27bf559', '192.168.8.100', 'en', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 Mobile/14G60 Safari/602.1', 1, 1502018599, 'iPhone', 'iPhone'),
(52, '598715866de05', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 1, 1502025094, 'Firefox', 'Windows'),
(53, '5987df09befff', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1502076681, 'Chrome', 'Windows'),
(54, '59882fdab1828', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1502097370, 'Chrome', 'Windows'),
(55, '59892fbaa86c7', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1502162874, 'Chrome', 'Windows');

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
(9, 'Bulloc');

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
(3, 'Cart');

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
  ADD KEY `FK_CUSTOMER_AREA` (`area`),
  ADD KEY `full_name` (`full_name`),
  ADD KEY `name` (`name`);

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
  ADD PRIMARY KEY (`txid`),
  ADD KEY `IDX_TRANSACTION_TXLINK` (`txlink`),
  ADD KEY `IDX_TRANSACTION_CR_ACCOUNT` (`cr_account`),
  ADD KEY `IDX_TRANSACTION_DR_ACCOUNT` (`dr_account`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `canvasser`
--
ALTER TABLE `canvasser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `collection_method`
--
ALTER TABLE `collection_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Client ID', AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `general_account`
--
ALTER TABLE `general_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Loan ID', AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `txid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Transaction ID', AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `vehicle_brand`
--
ALTER TABLE `vehicle_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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

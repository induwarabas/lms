-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2017 at 06:36 AM
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
('9000000001', 'GENERAL', '0.00', 'PLUS'),
('9000000002', 'GENERAL', '0.00', 'MINUS'),
('9000000003', 'GENERAL', '0.00', 'PLUS'),
('9000000004', 'GENERAL', '0.00', 'PLUS'),
('9000000005', 'GENERAL', '0.00', 'NONE'),
('9000000006', 'GENERAL', '0.00', 'MINUS'),
('9000000007', 'GENERAL', '0.00', 'PLUS');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_brand`
--

CREATE TABLE `vehicle_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `canvasser`
--
ALTER TABLE `canvasser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `collection_method`
--
ALTER TABLE `collection_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Client ID', AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Loan ID', AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `txid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Transaction ID', AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `vehicle_brand`
--
ALTER TABLE `vehicle_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
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

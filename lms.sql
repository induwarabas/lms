-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2017 at 09:02 PM
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
  `type` enum('SAVING','LOAN','SUPPLIER','CANVASSING','BANK','TELLER','GENERAL') NOT NULL COMMENT 'Type',
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
('2000000001', 'LOAN', '0.00', 'MINUS'),
('2000000002', 'LOAN', '0.00', 'MINUS'),
('2000000003', 'LOAN', '0.00', 'MINUS'),
('2000000004', 'LOAN', '0.00', 'MINUS'),
('2000000005', 'LOAN', '-9506.91', 'MINUS'),
('2000000006', 'LOAN', '-1111.00', 'MINUS'),
('9000000001', 'GENERAL', '3322.00', 'PLUS'),
('9000000002', 'GENERAL', '-1107.25', 'MINUS'),
('9000000003', 'GENERAL', '103.75', 'PLUS'),
('9000000004', 'GENERAL', '82.72', 'PLUS'),
('9000000005', 'GENERAL', '-523.36', 'NONE');

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
('//*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('//controller', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('//crud', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('//extension', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('//form', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('//index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('//model', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('//module', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/asset/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/asset/compress', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/asset/template', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/cache/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/cache/flush', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/cache/flush-all', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/cache/flush-schema', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/cache/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/fixture/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/fixture/load', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/fixture/unload', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/action', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/diff', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/preview', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/gii/default/view', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/hello/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/hello/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/help/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/help/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/help/list', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/help/list-action-options', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/help/usage', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/message/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/message/config', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/message/config-template', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/message/extract', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/create', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/down', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/history', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/mark', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/new', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/redo', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/to', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/migrate/up', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/serve/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/serve/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/*', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/auth/change-own-password', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user-permission/set', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user-permission/set-roles', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/bulk-activate', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/bulk-deactivate', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/bulk-delete', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/change-password', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/create', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/delete', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/grid-page-size', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/index', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/update', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('/user-management/user/view', 3, NULL, NULL, NULL, 1498749424, 1498749424, NULL),
('Admin', 1, 'Admin', NULL, NULL, 1498749424, 1498749424, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1498749424, 1498749424, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('commonPermission', 2, 'Common permission', NULL, NULL, 1498749424, 1498749424, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1498749424, 1498749424, 'userManagement'),
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
('Admin', 'assignRolesToUsers'),
('Admin', 'changeOwnPassword'),
('Admin', 'changeUserPassword'),
('Admin', 'createUsers'),
('Admin', 'deleteUsers'),
('Admin', 'editUsers'),
('Admin', 'viewUsers'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('assignRolesToUsers', 'viewUserRoles'),
('assignRolesToUsers', 'viewUsers'),
('changeOwnPassword', '/user-management/auth/change-own-password'),
('changeUserPassword', '/user-management/user/change-password'),
('changeUserPassword', 'viewUsers'),
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
(1, 'Monthly', 7, 'days', '0.00', 1),
(2, 'Weekly', 3, 'days', '0.00', 1),
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
(1, '198636601586', 'sdfsdfssdf sdf sdf sdf', 'A.S. asdasdas', 'Male', '1987-10-09', 2, 'asdadasd\r\nasdasda', 'asdasdas\r\ndad', '+94777777777', '', '', '', 'qdawe', '', '', '123.00', '123.00', 1),
(2, '85452515', '112', 'sdfsdf', 'Male', '2017-07-17', 1, 'asd', '', '', '', '', '', '', '12321', '', NULL, NULL, NULL),
(3, '876562123V', 'Rasda', 'asdAEss', 'Female', '1987-06-04', 1, 'asd', '', '12312', '', '', '', '', '', '', NULL, NULL, NULL),
(4, '200158512511', 'Wssa Eras Ass', 'W.E. Ass', 'Female', '2001-03-25', 1, 'Ad\r\nasdasd\r\nasd\r\nasd', '', '+94777102212', '+94777145555', 'sasd@as.fg', '', '', '+94777888555', 'asd@as.s', NULL, NULL, 2),
(5, '251451521V', 'EEEEEEEEEE', 'aAAAA', 'Male', '1925-05-24', 2, 'ASDs', '', '+94777848484', '', '', '', '', '', '', NULL, NULL, 2),
(6, '852852012V', 'EEEEEEEYAAAAAAAAAAA', 'asdas', 'Male', '1985-10-11', 1, 'as', '', '+94919922999', '', '', '', '', '', '', NULL, NULL, 2),
(7, '865264124V', 'REEEEEE', 'AS', 'Female', '1986-01-26', 1, 'asd', '', '+94777777777', '', '', '', '', '', '', NULL, NULL, 2),
(8, '852841858V', 'Donkey Monkey', 'D. Monkey', 'Male', '1985-10-10', 1, 'ADAs', '', '+94585454455', '', '', '', '', '', '', NULL, NULL, 9),
(9, '865841252V', 'Monkey Donkey', 'M. Donkey', 'Female', '1986-03-24', 1, 'Sdf', '', '+94777777777', '', '', '', '', '', '', NULL, NULL, NULL),
(10, '852123623V', 'AASDasd', 'asdasasd', 'Male', '1985-07-30', 1, 'sadsa', '', '+94777858585', '', '', '', '', '', '', NULL, NULL, 11),
(11, '896562522V', 'aasdasd', 'asdasdasd', 'Female', '1989-06-04', 1, 'sad', '', '+94777777777', '', '', '', '', '', '', NULL, NULL, 10),
(12, '925452522V', 'sdf sfd sf sd', 'f sdf sdf', 'Female', '1992-02-14', 1, 'sdf sfd', '', '+94222222222', '', '', '', '', '', '', NULL, NULL, NULL);

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
  `total_payment` decimal(10,2) DEFAULT NULL COMMENT 'Total Payment'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `type`, `customer_id`, `saving_account`, `loan_account`, `amount`, `interest`, `penalty`, `charges`, `collection_method`, `period`, `status`, `disbursed_date`, `closed_date`, `installment`, `total_interest`, `total_payment`) VALUES
(1, 1, 1, '1000000001', '2000000001', '1000.00', '0.00', '3.00', '0.00', 1, 12, 'PENDING', '0000-00-00', '0000-00-00', NULL, NULL, NULL),
(2, 1, 1, '1000000002', '2000000002', '2000.00', '0.00', '5.00', '0.00', 2, 36, 'PENDING', '0000-00-00', '0000-00-00', NULL, NULL, NULL),
(3, 1, 1, '1000000003', '2000000003', '1000.00', '0.00', '10.00', '0.00', 1, 12, 'PENDING', '0000-00-00', '0000-00-00', NULL, NULL, NULL),
(4, 1, 1, '1000000004', '2000000004', '1223.00', '12.24', '10.00', '1232.00', 1, 12, 'PENDING', NULL, NULL, NULL, NULL, NULL),
(5, 1, 1, '1000000005', '2000000005', '1000.00', '12.00', '10.00', '100.00', 1, 60, 'ACTIVE', '2017-07-02', NULL, '23.90', '434.40', '1434.40'),
(6, 1, 1, '1000000006', '2000000006', '1111.00', '11.00', '10.00', '11.00', 2, 12, 'ACTIVE', '2017-07-02', NULL, '94.77', '26.32', '1137.32');

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
(6, 12, 'PENDING', '2017-09-24', '91.51', '2.35', '0.91', 0, '0.00', '0.00', '0.00', '1019.49');

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
  `description` varchar(128) NOT NULL COMMENT 'Description'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`txid`, `timestamp`, `cr_account`, `dr_account`, `cr_balance`, `dr_balance`, `amount`, `type`, `description`) VALUES
(2, '2017-06-29 19:22:51', '9000000002', '9000000001', '-1000.00', '1000.00', '1000.00', 'CAPITAL', 'Initial transfer'),
(3, '2017-06-29 19:23:49', '9000000001', '9000000002', '0.00', '0.00', '1000.00', 'CAPITAL', 'Initial transfer'),
(4, '2017-07-02 12:39:48', '2000000006', '9000000001', '-1111.00', '1111.00', '1111.00', 'DISBURSE', 'Disbursement of the loan #6'),
(5, '2017-07-02 12:39:48', '9000000002', '9000000001', '-1111.00', '2222.00', '1111.00', 'CHARGES', 'Disbursement charges of the loan #6'),
(6, '2017-07-02 13:09:11', '2000000005', '9000000001', '-1000.00', '3222.00', '1000.00', 'DISBURSE', 'Disbursement of the loan #5'),
(7, '2017-07-02 13:09:11', '9000000002', '9000000001', '-1211.00', '3322.00', '100.00', 'CHARGES', 'Disbursement charges of the loan #5'),
(8, '2017-07-03 18:36:48', '1000000005', '9000000004', '0.00', '25.00', '25.00', 'PENALTY', 'Penalty charge for loan #5'),
(9, '2017-07-03 18:39:07', '1000000005', '9000000004', '64.23', '60.77', '35.77', 'PENALTY', 'Penalty charge for loan #5'),
(10, '2017-07-03 18:39:13', '1000000005', '9000000005', '40.33', '23.90', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2017-08-02'),
(11, '2017-07-03 18:39:13', '9000000005', '2000000005', '11.66', '-9988.76', '12.24', 'CAPITAL', 'Capital recovery of loan #5 for 2017-08-02'),
(12, '2017-07-03 18:39:13', '9000000005', '9000000003', '1.66', '10.00', '10.00', 'INTEREST', 'Interest recovery of loan #5 for 2017-08-02'),
(13, '2017-07-03 18:39:13', '9000000005', '9000000002', '-8.34', '-1201.00', '10.00', 'CHARGES', 'Charges recovery of loan #5 for 2017-08-02'),
(14, '2017-07-03 18:39:14', '1000000005', '9000000005', '71.71', '-39.72', '-31.38', 'RECOVERY', 'Installment recovery of loan #5 for 2017-07-09'),
(15, '2017-07-03 18:39:14', '9000000005', '2000000005', '-131.23', '-9897.25', '91.51', 'CAPITAL', 'Capital recovery of loan #5 for 2017-07-09'),
(16, '2017-07-03 18:39:14', '9000000005', '9000000003', '-133.58', '12.35', '2.35', 'INTEREST', 'Interest recovery of loan #5 for 2017-07-09'),
(17, '2017-07-03 18:39:14', '9000000005', '9000000002', '-135.93', '-1198.65', '2.35', 'CHARGES', 'Charges recovery of loan #5 for 2017-07-09'),
(18, '2017-07-03 18:39:14', '1000000005', '9000000005', '91.62', '-155.84', '-19.91', 'RECOVERY', 'Installment recovery of loan #5 for 2017-07-16'),
(19, '2017-07-03 18:39:14', '9000000005', '2000000005', '-247.35', '-9805.74', '91.51', 'CAPITAL', 'Capital recovery of loan #5 for 2017-07-16'),
(20, '2017-07-03 18:39:14', '9000000005', '9000000003', '-249.70', '14.70', '2.35', 'INTEREST', 'Interest recovery of loan #5 for 2017-07-16'),
(21, '2017-07-03 18:39:14', '9000000005', '9000000002', '-252.05', '-1196.30', '2.35', 'CHARGES', 'Charges recovery of loan #5 for 2017-07-16'),
(22, '2017-07-03 18:39:14', '1000000005', '9000000005', '101.10', '-261.53', '-9.48', 'RECOVERY', 'Installment recovery of loan #5 for 2017-07-23'),
(23, '2017-07-03 18:39:14', '9000000005', '2000000005', '-353.04', '-9714.23', '91.51', 'CAPITAL', 'Capital recovery of loan #5 for 2017-07-23'),
(24, '2017-07-03 18:39:14', '9000000005', '9000000003', '-355.39', '17.05', '2.35', 'INTEREST', 'Interest recovery of loan #5 for 2017-07-23'),
(25, '2017-07-03 18:39:15', '9000000005', '9000000002', '-357.74', '-1193.95', '2.35', 'CHARGES', 'Charges recovery of loan #5 for 2017-07-23'),
(26, '2017-07-03 18:39:15', '9000000005', '2000000005', '-449.25', '-9622.72', '91.51', 'CAPITAL', 'Capital recovery of loan #5 for 2017-07-30'),
(27, '2017-07-03 18:39:15', '9000000005', '9000000003', '-451.60', '19.40', '2.35', 'INTEREST', 'Interest recovery of loan #5 for 2017-07-30'),
(28, '2017-07-03 18:39:15', '9000000005', '9000000002', '-453.95', '-1191.60', '2.35', 'CHARGES', 'Charges recovery of loan #5 for 2017-07-30'),
(29, '2017-07-05 17:31:07', '1000000005', '9000000004', '17.59', '68.18', '7.41', 'PENALTY', 'Penalty charge for loan #5'),
(30, '2017-07-05 17:32:43', '1000000005', '9000000004', '10.42', '75.35', '7.17', 'PENALTY', 'Penalty charge for loan #5'),
(31, '2017-07-05 17:33:38', '1000000005', '9000000005', '16.10', '-430.05', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2017-09-02'),
(32, '2017-07-05 17:33:38', '9000000005', '2000000005', '-442.41', '-9610.36', '12.36', 'CAPITAL', 'Capital recovery of loan #5 for 2017-09-02'),
(33, '2017-07-05 17:33:38', '9000000005', '9000000003', '-452.29', '29.28', '9.88', 'INTEREST', 'Interest recovery of loan #5 for 2017-09-02'),
(34, '2017-07-05 17:33:38', '9000000005', '9000000002', '-462.17', '-1181.72', '9.88', 'CHARGES', 'Charges recovery of loan #5 for 2017-09-02'),
(35, '2017-07-05 17:34:07', '1000000005', '9000000005', '76.10', '-438.27', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2017-10-02'),
(36, '2017-07-05 17:34:07', '9000000005', '2000000005', '-450.76', '-9597.87', '12.49', 'CAPITAL', 'Capital recovery of loan #5 for 2017-10-02'),
(37, '2017-07-05 17:34:07', '9000000005', '9000000003', '-460.51', '39.03', '9.75', 'INTEREST', 'Interest recovery of loan #5 for 2017-10-02'),
(38, '2017-07-05 17:34:07', '9000000005', '9000000002', '-470.26', '-1171.97', '9.75', 'CHARGES', 'Charges recovery of loan #5 for 2017-10-02'),
(39, '2017-07-05 17:34:07', '1000000005', '9000000005', '52.20', '-446.36', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2017-11-02'),
(40, '2017-07-05 17:34:07', '9000000005', '2000000005', '-458.97', '-9585.26', '12.61', 'CAPITAL', 'Capital recovery of loan #5 for 2017-11-02'),
(41, '2017-07-05 17:34:07', '9000000005', '9000000003', '-468.60', '48.66', '9.63', 'INTEREST', 'Interest recovery of loan #5 for 2017-11-02'),
(42, '2017-07-05 17:34:07', '9000000005', '9000000002', '-478.23', '-1162.34', '9.63', 'CHARGES', 'Charges recovery of loan #5 for 2017-11-02'),
(43, '2017-07-05 17:34:50', '1000000005', '9000000004', '49.81', '77.74', '2.39', 'PENALTY', 'Penalty charge for loan #5'),
(44, '2017-07-05 17:34:50', '1000000005', '9000000005', '25.91', '-454.33', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2017-12-02'),
(45, '2017-07-05 17:34:50', '9000000005', '2000000005', '-467.07', '-9572.52', '12.74', 'CAPITAL', 'Capital recovery of loan #5 for 2017-12-02'),
(46, '2017-07-05 17:34:50', '9000000005', '9000000003', '-476.57', '58.16', '9.50', 'INTEREST', 'Interest recovery of loan #5 for 2017-12-02'),
(47, '2017-07-05 17:34:50', '9000000005', '9000000002', '-486.07', '-1152.84', '9.50', 'CHARGES', 'Charges recovery of loan #5 for 2017-12-02'),
(48, '2017-07-05 17:34:50', '1000000005', '9000000005', '2.01', '-462.17', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2018-01-02'),
(49, '2017-07-05 17:34:50', '9000000005', '2000000005', '-475.03', '-9559.66', '12.86', 'CAPITAL', 'Capital recovery of loan #5 for 2018-01-02'),
(50, '2017-07-05 17:34:50', '9000000005', '9000000003', '-484.41', '67.54', '9.38', 'INTEREST', 'Interest recovery of loan #5 for 2018-01-02'),
(51, '2017-07-05 17:34:50', '9000000005', '9000000002', '-493.79', '-1143.46', '9.38', 'CHARGES', 'Charges recovery of loan #5 for 2018-01-02'),
(52, '2017-07-05 17:37:38', '1000000005', '9000000005', '26.10', '-469.89', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2018-02-02'),
(53, '2017-07-05 17:37:38', '9000000005', '2000000005', '-482.88', '-9546.67', '12.99', 'CAPITAL', 'Capital recovery of loan #5 for 2018-02-02'),
(54, '2017-07-05 17:37:38', '9000000005', '9000000003', '-492.13', '76.79', '9.25', 'INTEREST', 'Interest recovery of loan #5 for 2018-02-02'),
(55, '2017-07-05 17:37:38', '9000000005', '9000000002', '-501.38', '-1134.21', '9.25', 'CHARGES', 'Charges recovery of loan #5 for 2018-02-02'),
(56, '2017-07-05 17:44:54', '1000000005', '9000000004', '23.71', '80.13', '2.39', 'PENALTY', 'Penalty charge for loan #5'),
(57, '2017-07-05 17:45:35', '1000000005', '9000000005', '24.10', '-477.48', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2018-03-02'),
(58, '2017-07-05 17:45:35', '9000000005', '2000000005', '-490.60', '-9533.55', '13.12', 'CAPITAL', 'Capital recovery of loan #5 for 2018-03-02'),
(59, '2017-07-05 17:45:35', '9000000005', '9000000003', '-499.72', '85.91', '9.12', 'INTEREST', 'Interest recovery of loan #5 for 2018-03-02'),
(60, '2017-07-05 17:45:35', '9000000005', '9000000002', '-508.84', '-1125.09', '9.12', 'CHARGES', 'Charges recovery of loan #5 for 2018-03-02'),
(61, '2017-07-05 17:45:35', '1000000005', '9000000005', '0.20', '-484.94', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2018-04-02'),
(62, '2017-07-05 17:45:35', '9000000005', '2000000005', '-498.19', '-9520.30', '13.25', 'CAPITAL', 'Capital recovery of loan #5 for 2018-04-02'),
(63, '2017-07-05 17:45:35', '9000000005', '9000000003', '-507.18', '94.90', '8.99', 'INTEREST', 'Interest recovery of loan #5 for 2018-04-02'),
(64, '2017-07-05 17:45:35', '9000000005', '9000000002', '-516.17', '-1116.10', '8.99', 'CHARGES', 'Charges recovery of loan #5 for 2018-04-02'),
(65, '2017-07-05 17:46:18', '1000000005', '9000000004', '0.00', '80.33', '0.20', 'PENALTY', 'Penalty charge for loan #5'),
(66, '2017-07-05 17:48:56', '1000000005', '9000000004', '47.61', '82.72', '2.39', 'PENALTY', 'Penalty charge for loan #5'),
(67, '2017-07-05 17:48:56', '1000000005', '9000000005', '23.71', '-492.27', '23.90', 'RECOVERY', 'Installment recovery of loan #5 for 2018-05-02'),
(68, '2017-07-05 17:48:56', '9000000005', '2000000005', '-505.66', '-9506.91', '13.39', 'CAPITAL', 'Capital recovery of loan #5 for 2018-05-02'),
(69, '2017-07-05 17:48:56', '9000000005', '9000000003', '-514.51', '103.75', '8.85', 'INTEREST', 'Interest recovery of loan #5 for 2018-05-02'),
(70, '2017-07-05 17:48:56', '9000000005', '9000000002', '-523.36', '-1107.25', '8.85', 'CHARGES', 'Charges recovery of loan #5 for 2018-05-02');

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
(1, 'superadmin', '9dg8QDmu8FWCXm1fS-909fs4II7MACVC', '$2y$13$E8vLRFzFDfSgBnuRPscVxedolcGrPebMunTmLx/AQf691owHcTB0O', NULL, 1, 1, 1498749424, 1498749424, NULL, NULL, NULL, 0);

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
(9, '59625369c086b', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', 1, 1499616105, 'Chrome', 'Windows');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `collection_method`
--
ALTER TABLE `collection_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Client ID', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Loan ID', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `txid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Transaction ID', AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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

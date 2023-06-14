-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 07:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system-03`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `announcement_title`, `announcement_text`, `created_at`, `updated_at`) VALUES
(1, 'Closed Transactions on April 28, 2023', 'This is an important announcement from the Office of the Registrar. Due to necessary maintenance and upgrades, our registration system will be temporarily down for one week, starting Monday, April 10th at 8:00 am and ending Monday, April 17th at 8:00 am.  ', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(2, 'Closed Transactions on April 21, 2023', 'We would like to inform you that our registrar\'s office will be closed on April 21 2023, in observance of Eid al-Fitr, the festival of breaking the fast that marks the end of Ramadan.\r\n            ', '2023-05-26 23:14:43', '2023-05-26 23:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_purpose` text NOT NULL,
  `acad_year` varchar(255) DEFAULT NULL,
  `appointment_date` varchar(255) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `date_approved` timestamp NULL DEFAULT NULL,
  `a_transfer` tinyint(1) NOT NULL,
  `a_transfer_school` varchar(255) DEFAULT NULL,
  `b_transfer` tinyint(1) NOT NULL,
  `b_transfer_school` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `num_copies` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `app_moved` tinyint(1) NOT NULL DEFAULT 0,
  `org_app_date` date DEFAULT NULL,
  `booking_number` varchar(255) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `app_purpose`, `acad_year`, `appointment_date`, `payment_method`, `proof_of_payment`, `reference_number`, `date_approved`, `a_transfer`, `a_transfer_school`, `b_transfer`, `b_transfer_school`, `status`, `num_copies`, `remarks`, `payment_status`, `app_moved`, `org_app_date`, `booking_number`, `user_id`, `form_id`, `created_at`, `updated_at`) VALUES
(1, 'I would like to request a Transcript of Records for employment purposes .', '2022-2023', 'May 30, 2023', 'GCash', 'images/proof-of-payment/1685149170_GCash-09708926661-24042023215957.PNG.jpg', '3009491527649', '2023-05-27 01:05:06', 0, 'null', 0, 'null', 'Pending', 4, NULL, 'Approved', 0, NULL, '2023-0001', 2, 1, '2023-05-27 00:59:30', '2023-05-27 01:05:06'),
(2, 'for job purposes', '2022-2023', 'May 30, 2023', 'GCash', 'images/proof-of-payment/1685198491_343316076_2633899090090848_3018882089072182299_n.jpg', '1898890', '2023-05-27 15:02:15', 0, 'null', 0, 'null', 'Claimed', 1, NULL, 'Approved', 0, NULL, '2023-0002', 9, 1, '2023-05-27 14:41:31', '2023-05-27 15:11:32'),
(3, 'for job', '2023-2023', 'May 30, 2023', 'GCash', 'images/proof-of-payment/1685198886_343316076_2633899090090848_3018882089072182299_n.jpg', '3456789', '2023-05-27 15:16:56', 0, 'null', 0, 'null', 'Claimed', 1, 'Please ensure that you bring the exact amount of 20 PHP for payment.', 'Approved', 0, NULL, '2023-0003', 9, 1, '2023-05-27 14:48:06', '2023-05-27 15:17:30'),
(4, 'for my authentication', '2018-2019', 'May 30, 2023', 'GCash', 'images/proof-of-payment/1685198952_343316076_2633899090090848_3018882089072182299_n.jpg', '98765', NULL, 0, 'null', 0, 'null', 'Pending', 1, NULL, 'Pending', 0, NULL, '2023-0004', 9, 3, '2023-05-27 14:49:12', '2023-05-27 14:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_slots`
--

CREATE TABLE `appointment_slots` (
  `id` int(10) UNSIGNED NOT NULL,
  `slot_date` date NOT NULL,
  `available_slots` int(11) NOT NULL DEFAULT 0,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `appointment_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_slots`
--

INSERT INTO `appointment_slots` (`id`, `slot_date`, `available_slots`, `is_disabled`, `appointment_id`, `created_at`, `updated_at`) VALUES
(1, '2023-05-30', 20, 0, NULL, '2023-05-27 00:48:09', '2023-05-27 00:48:22'),
(2, '2023-05-31', 10, 0, NULL, '2023-05-27 14:51:35', '2023-05-27 14:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `appointment_id` int(10) UNSIGNED NOT NULL,
  `resched` tinyint(1) DEFAULT NULL,
  `or_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `appointment_id`, `resched`, `or_number`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, 'OR-2023-123456', '2023-05-27 00:59:30', '2023-05-27 01:05:06'),
(2, 9, 2, 0, '8765432', '2023-05-27 14:41:31', '2023-05-27 15:02:15'),
(3, 9, 3, 0, '87123912', '2023-05-27 14:48:06', '2023-05-27 15:16:56'),
(4, 9, 4, 0, NULL, '2023-05-27 14:49:12', '2023-05-27 14:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `booking_requirements`
--

CREATE TABLE `booking_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_requirements`
--

INSERT INTO `booking_requirements` (`id`, `file_path`, `file_name`, `booking_id`, `created_at`, `updated_at`) VALUES
(1, 'images/requirements/2_1685149170_received_780839763669725.webp', 'received_780839763669725.webp', 1, '2023-05-27 00:59:30', '2023-05-27 00:59:30'),
(2, 'images/requirements/9_1685198491_346060781_242845301663795_986667203272817188_n.jpg', '346060781_242845301663795_986667203272817188_n.jpg', 2, '2023-05-27 14:41:32', '2023-05-27 14:41:32'),
(3, 'images/requirements/9_1685198886_DSC_7581.JPG', 'DSC_7581.JPG', 3, '2023-05-27 14:48:06', '2023-05-27 14:48:06'),
(4, 'images/requirements/9_1685198952_346071841_793474045424536_2889416771170059313_n.jpg', '346071841_793474045424536_2889416771170059313_n.jpg', 4, '2023-05-27 14:49:12', '2023-05-27 14:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `created_at`, `updated_at`) VALUES
(1, 'Secondary High School', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(2, 'Secondary Senior High School', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(3, 'Bachelor of Science in Computer Science', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(4, 'Bachelor of Technology and Livelihood Education', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(5, 'Bachelor of Technical-Vocational Teacher Education', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(6, 'Bachelor of Science in Hospitality Management', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(7, 'Bachelor of Industrial Technology Major in Drafting', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(8, 'Bachelor of Industrial Technology Major in Garments Fashion and Design', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(9, 'Bachelor of Industrial Technology Major in Mechanical Technology', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(10, 'Bachelor of Industrial  Technology Major in Food and Service Management', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(11, 'Bachelor of Industrial Technology Major in Electrical Technology', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(12, 'Bachelor of Industrial Technology Major in Automotive Technology', '2023-05-26 23:14:43', '2023-05-26 23:14:43');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faqs_title` varchar(255) NOT NULL,
  `faqs_subtext` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faqs_title`, `faqs_subtext`, `created_at`, `updated_at`) VALUES
(1, 'Is my personal information safe when using the online appointment system?', 'Yes, your personal information is safe when using the online appointment system. We use industry-standard security protocols to protect your information and ensure that it is kept confidential.\r\n            ', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(2, 'What services can I book an appointment for using the online appointment system?', 'You can book an appointment for a variety of services, including student registration, transcript requests, and academic advising. Check the online appointment system for a full list of available services.\r\n            ', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(3, 'What should I do if I have a question or concern that is not addressed in the FAQs?', 'If you have a question or concern that is not addressed in the FAQs, please contact the Registrar\'s Office directly for assistance. You can find contact information on our website.\r\n            ', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(4, 'How far in advance should I book an appointment with the Registrar\'s Office?', 'We recommend booking your appointment at least a week in advance to ensure availability. Some services may have specific deadlines, so be sure to check the online appointment system for details.\r\n            ', '2023-05-26 23:14:43', '2023-05-26 23:14:43'),
(5, 'Can I walk in for an appointment without booking in advance?', 'We strongly encourage clients to book their appointments in advance using the online appointment system. However, if you need immediate assistance and cannot book an appointment in advance, you may walk in and speak with a staff member if they are available. Please note that walk-ins may experience longer wait times and may not be able to receive the same level of service as those with appointments. \r\n            ', '2023-05-26 23:14:43', '2023-05-26 23:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `form_requirements` text NOT NULL,
  `form_process` varchar(255) NOT NULL,
  `form_avail` text NOT NULL,
  `form_who_avail` text NOT NULL,
  `form_max_time` text NOT NULL,
  `fee` int(11) NOT NULL,
  `fee_type` text NOT NULL,
  `pages` text NOT NULL,
  `acad_year` tinyint(1) NOT NULL DEFAULT 0,
  `requirements` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `form_requirements`, `form_process`, `form_avail`, `form_who_avail`, `form_max_time`, `fee`, `fee_type`, `pages`, `acad_year`, `requirements`, `created_at`, `updated_at`) VALUES
(1, 'Issuance of Transcript of Records', 'Clearance Form', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Students, Their Parents or Duly Authorized Representative', '15 working days after the request if filed', 50, 'Per Page', '4', 1, 1, '2023-05-26 23:56:15', '2023-05-26 23:56:15'),
(2, 'Issuance of Honorable Dismissal or Transfer Credentials', 'Clearance Form', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Students, Their Parents or Duly Authorized Representative', '3 working days after the request if filed', 50, 'Per Page', '4', 0, 0, '2023-05-26 23:57:50', '2023-05-26 23:57:50'),
(3, 'CAV', 'TOR/ Diploma (Original and Photocopy)', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '3 working days after the request if filed', 50, 'None', '1', 1, 1, '2023-05-27 00:00:46', '2023-05-27 00:00:57'),
(4, 'Issuance of Certification', 'Clearance Form', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '3 working days after the request if filed', 50, 'None', '1', 1, 1, '2023-05-27 00:02:02', '2023-05-27 00:02:02'),
(5, 'Authentication', 'Clearance Form and Documents for Authentication', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '1 working days after the request if filed', 20, 'None', '20', 1, 1, '2023-05-27 00:04:32', '2023-05-27 00:04:32'),
(6, 'Issuance of Form 137 (For Employment)', 'Clearance Form and Request Form issued by the Requesting School', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '5 working days after the request if filed', 50, 'None', '1', 1, 1, '2023-05-27 00:05:43', '2023-05-27 00:05:43'),
(7, 'Issuance of Form 137 (For Transfer Credential)', 'Clearance Form and Request Form issued by the Requesting School', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '5 working days after the request if filed', 0, 'None', '1', 0, 1, '2023-05-27 00:06:47', '2023-05-27 00:06:47'),
(8, 'Issuance of Form 138', 'Clearance Form', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '30 minutes after the request if filed', 0, 'None', '1', 0, 1, '2023-05-27 00:07:58', '2023-05-27 00:07:58'),
(9, 'Issuance of Diploma', 'Clearance Form', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '30 minutes (if diploma is already available) after the request if filed', 50, 'Collected as part of graduation fee', '1', 0, 1, '2023-05-27 00:09:37', '2023-05-27 00:09:37'),
(10, 'Issuance of Yearbook', 'Clearance Form', '30 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '30 minutes (if yearbook is already available) after the request if filed', 0, 'None', '1', 0, 1, '2023-05-27 00:10:49', '2023-05-27 00:10:49'),
(11, 'Re-issuance of Diploma', 'Affidavit of Loss', '15 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Graduates, Their Parents or Duly Authorized Representative', '15 minutes (if yearbook is already available) after the request if filed', 250, 'None', '1', 0, 1, '2023-05-27 00:12:02', '2023-05-27 00:12:02'),
(12, 'Re-issuance of COR', 'Affidavit of Loss', '15 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Students', '15 minutes after the request if filed', 20, 'None', '1', 0, 1, '2023-05-27 00:15:22', '2023-05-27 00:15:22'),
(13, 'Re-issuance of ID Card', 'Affidavit of Loss', '15 minutes', 'Monday to Friday (8:00 AM to 5:00 PM)', 'Students', '15 minutes after the request if filed', 125, 'None', '1', 0, 1, '2023-05-27 00:16:33', '2023-05-27 00:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fullname`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Jeanlou Dongon', 'jeanloudongon13@gmail.com', 'Hello, I would like to inquire if there is an available form for shifting in this appointment system?', '2023-05-27 00:35:07', '2023-05-27 00:35:07'),
(2, 'Olympio Sumbilon Jr', 'olympiosumbilon37@gmail.com', 'I wanted to express my appreciation for the outstanding user experience provided by your appointment system. It is user-friendly, intuitive, and has made scheduling appointments a breeze. The interface is clean and well-organized, and the entire process from booking to confirmation is seamless. Kudos to your team for developing such a fantastic system!\r\n\r\nThank you for making the appointment scheduling process so convenient and efficient. Keep up the excellent work!', '2023-05-27 00:39:31', '2023-05-27 00:39:31'),
(3, 'Marjie Betacura', 'mar.betacura@gmail.com', 'I have been using your appointment system for some time now, and while it has been helpful overall, I wanted to provide some suggestions for improvement. Firstly, it would be beneficial to have an option for rescheduling appointments directly within the system, rather than having to cancel and rebook. Additionally, the ability to receive automated appointment reminders via email or text message would be highly useful. These enhancements would greatly enhance the user experience and streamline the process.\r\n\r\nThank you for considering these suggestions. I believe implementing them would make your already great system even better.', '2023-05-27 00:41:03', '2023-05-27 00:41:03'),
(4, 'Meriflor Gonoy', 'meriflor@gmail.com', 'I recently encountered a technical issue while trying to use your appointment system. After entering my details and selecting the desired time slot, I encountered an error message and was unable to proceed with the booking. I have attempted this multiple times, but the issue persists. I would appreciate it if you could investigate and resolve this matter promptly as it is affecting my ability to schedule appointments through your system.\r\n\r\nThank you for your attention to this matter. I look forward to hearing back from you soon.', '2023-05-27 00:42:22', '2023-05-27 00:42:22'),
(5, 'Bryan Ladion', 'bryan@gmail.com', 'I would like to express my gratitude for the prompt support I received from your team regarding an issue I encountered with the appointment system. When I reached out to report the problem, your support staff responded quickly and guided me through the troubleshooting process. They were patient, knowledgeable, and ultimately helped me resolve the issue, allowing me to successfully book my appointment.\r\n\r\nThank you for your excellent customer support. It is refreshing to experience such efficient assistance. I commend your team for their dedication to ensuring a positive user experience.', '2023-05-27 00:44:13', '2023-05-27 00:44:13');

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
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2019_08_19_000000_create_failed_jobs_table', 1),
(19, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(20, '2023_04_02_023555_create_users_table', 1),
(21, '2023_04_02_215423_add_role_to_users_table', 1),
(22, '2023_04_03_132809_create_forms_table', 1),
(23, '2023_04_08_103243_create_appointments_table', 1),
(24, '2023_04_08_141501_create_bookings_table', 1),
(25, '2023_04_15_124648_create_announcements_table', 1),
(26, '2023_04_15_124801_create_faqs_table', 1),
(27, '2023_04_22_155709_create_appointment_slots_table', 1),
(28, '2023_05_07_030729_create_notifications_table', 1),
(29, '2023_05_07_075304_create_courses_table', 1),
(30, '2023_05_15_235618_create_registrar_staffs_table', 1),
(31, '2023_05_20_133612_create_messages_table', 1),
(32, '2023_05_24_202746_create_booking_requirements_table', 1),
(33, '2023_05_27_152332_create_website_image_content_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('58cf9c43-cc22-4929-ba24-f2b667e56108', 'App\\Notifications\\IncompletePaymentNotif', 'App\\Models\\User', 9, '{\"remarks\":\"\\r\\n            <pre class=\'font-mont p-5\'>\\r\\n                We are pleased to inform you that your payment for the requested document has been successfully approved.<\\/br>\\r\\n                Now that your payment has been approved, we would like to inform you that the next step in the document request process will be handled by the Registrar\'s Office. They will carefully process your request and work towards fulfilling it as soon as possible. Kindly note that further notices and updates regarding your document will be provided by the Registrar\'s Office.<\\/br>\\r\\n                In the meantime, we kindly request your patience and understanding. The Registrar\'s Office will keep you informed about the progress of your document request. Should you have any questions or require any assistance, please feel free to reach out to the Registrar\'s Office.<\\/br>\\r\\n                We appreciate the opportunity to assist you, and we look forward to delivering the requested document to you in a timely manner.\\r\\n            <\\/pre>\\r\\n            \",\"app_id\":\"3\",\"notif_type\":\"Approved Payment\"}', '2023-05-27 15:18:01', '2023-05-27 15:16:56', '2023-05-27 15:18:01'),
('c35c4982-aebb-4bbf-a0ed-34d5d1b97932', 'App\\Notifications\\IncompletePaymentNotif', 'App\\Models\\User', 9, '{\"remarks\":\"\\r\\n            <pre class=\'font-mont p-5\'>\\r\\n                We are pleased to inform you that your payment for the requested document has been successfully approved.<\\/br>\\r\\n                Now that your payment has been approved, we would like to inform you that the next step in the document request process will be handled by the Registrar\'s Office. They will carefully process your request and work towards fulfilling it as soon as possible. Kindly note that further notices and updates regarding your document will be provided by the Registrar\'s Office.<\\/br>\\r\\n                In the meantime, we kindly request your patience and understanding. The Registrar\'s Office will keep you informed about the progress of your document request. Should you have any questions or require any assistance, please feel free to reach out to the Registrar\'s Office.<\\/br>\\r\\n                We appreciate the opportunity to assist you, and we look forward to delivering the requested document to you in a timely manner.\\r\\n            <\\/pre>\\r\\n            \",\"app_id\":\"2\",\"notif_type\":\"Approved Payment\"}', '2023-05-27 15:04:57', '2023-05-27 15:02:20', '2023-05-27 15:04:57'),
('ee876684-8d6b-4b53-82e8-768ba09732b0', 'App\\Notifications\\IncompletePaymentNotif', 'App\\Models\\User', 2, '{\"remarks\":\"\\r\\n            <pre class=\'font-mont p-5\'>\\r\\n                We are pleased to inform you that your payment for the requested document has been successfully approved.<\\/br>\\r\\n                Now that your payment has been approved, we would like to inform you that the next step in the document request process will be handled by the Registrar\'s Office. They will carefully process your request and work towards fulfilling it as soon as possible. Kindly note that further notices and updates regarding your document will be provided by the Registrar\'s Office.<\\/br>\\r\\n                In the meantime, we kindly request your patience and understanding. The Registrar\'s Office will keep you informed about the progress of your document request. Should you have any questions or require any assistance, please feel free to reach out to the Registrar\'s Office.<\\/br>\\r\\n                We appreciate the opportunity to assist you, and we look forward to delivering the requested document to you in a timely manner.\\r\\n            <\\/pre>\\r\\n            \",\"app_id\":\"1\",\"notif_type\":\"Approved Payment\"}', '2023-05-27 01:06:25', '2023-05-27 01:05:08', '2023-05-27 01:06:25'),
('f2129c3a-13ac-4f7b-b07d-e23b7d597fb4', 'App\\Notifications\\AppRemarksUpdate', 'App\\Models\\User', 9, '{\"remarks\":\"Please ensure that you bring the exact amount of 20 PHP for payment.\",\"app_id\":\"3\",\"notif_type\":\"remarks\",\"title\":\"Reminder details:\",\"doc\":\"Issuance of Transcript of Records\",\"resched\":null}', '2023-05-27 15:15:50', '2023-05-27 15:15:15', '2023-05-27 15:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrar_staffs`
--

CREATE TABLE `registrar_staffs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrar_staffs`
--

INSERT INTO `registrar_staffs` (`id`, `full_name`, `position`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'Olympio Sumbilon Jr', 'Window 1', 'images/registrar-staff/1685234601_2x2.jpg', '2023-05-28 00:43:21', '2023-05-28 00:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `school_id` int(11) NOT NULL,
  `cell_no` varchar(255) NOT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `acadYear` varchar(255) DEFAULT NULL,
  `gradYear` varchar(255) DEFAULT NULL,
  `account_status` varchar(255) NOT NULL,
  `account_rejected` timestamp NULL DEFAULT NULL,
  `account_approved` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `middleName`, `suffix`, `address`, `school_id`, `cell_no`, `civil_status`, `email`, `birthdate`, `status`, `gender`, `course`, `password`, `acadYear`, `gradYear`, `account_status`, `account_rejected`, `account_approved`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'Admin', '', '', 'Tubod Lanao del Norte', 100949, '09357257056', 'Single', 'admin@gmail.com', '2000-08-17', 'Admin', 'Male', '', '$2y$10$0N8NDX.9rFbDHAcZG3inb.1nie4mfMEj0mKLYgzUXcrgbIW9DVW4i', '2022-2023', '', 'Pending', NULL, NULL, '2023-05-26 23:14:43', '2023-05-26 23:14:43', 1),
(2, 'Jeanlou', 'Dongon', 'O.', '', 'Tubod Lanao Del Norte', 1009450, '09367102372', 'Single', 'jeanloudongon13@gmail.com', '2001-09-07', 'College Undergraduate', 'Female', 'Bachelor of Science in Hospitality Management', '$2y$10$pIlYEtVj4a3hVZUDvZK5duUnQOxBZl1ZyVWldLRaM.hmqAokDdsGK', '2022-2023', NULL, 'Approved', NULL, '2023-05-27 00:12:51', '2023-05-27 00:10:19', '2023-05-27 00:12:51', 0),
(3, 'Admin', 'Admin', NULL, NULL, 'Admin', 2023090209, 'admin-2023-05-27 09:02:09', NULL, 'cashier@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$PpaYEg4TxuSuktaaTB1eD.V60ywZpSq819/apDW/2T1qe7A.WkS26', NULL, NULL, 'Approved', NULL, NULL, '2023-05-27 01:02:09', '2023-05-27 01:02:09', 3),
(4, 'Admin', 'Admin', NULL, NULL, 'Admin', 2023090228, 'admin-2023-05-27 09:02:28', NULL, 'handler@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$qOHBH5uzhTdH9RoWEdL2ceSe3rVPgwBgltpukKBOtmyjaSLWBFbjm', NULL, NULL, 'Approved', NULL, NULL, '2023-05-27 01:02:28', '2023-05-27 01:02:28', 2),
(9, 'Olympio', 'Sumbilon', NULL, NULL, 'TCES', 109941, '09357258656', 'Single', 'olympiosumbilon17@gmail.com', '2000-08-17', 'College Undergraduate', 'Male', 'Bachelor of Science in Computer Science', '$2y$10$bpN9MJlznQGPOUIP7GIZD.bTXhnUPgVk6ebImxgpRUoyYbrsWLIma', '2017-2018', NULL, 'Approved', NULL, '2023-05-27 14:38:14', '2023-05-27 14:34:10', '2023-05-27 14:38:14', 0),
(10, 'Khent', 'Lopez', 'T.', NULL, 'Maigo Lanao Del Norte', 1009992, '09485599913', 'Single', 'khentacas987@gmail.com', '1999-10-09', 'College Undergraduate', 'Male', 'Bachelor of Science in Computer Science', '$2y$10$JA9ZgkrpXE3rXz7Bme9xhOjlFjNmx8Se8EYKq122uTNfpJAv.8Zwu', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 03:50:39', '2023-05-28 04:19:25', 0),
(11, 'Nhor Jahded', 'Balindong', 'S', NULL, 'River side, Kolambugan Lanao Del Norte', 1009428, '09753214203', 'Single', 'nhor.codaye43@gmail.com', '2000-08-16', 'College Undergraduate', 'Male', 'Bachelor of Science in Computer Science', '$2y$10$dicOHmi97B9nrmmSzmltMeqwbJd2ZxKZMqMfMi/xTK0JMxNEKJMqS', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 03:58:43', '2023-05-28 04:16:23', 0),
(12, 'Rotsen', 'Baroquillo', 'V', NULL, 'River side, Kolambugan Lanao Del Norte', 1009973, '09169160191', 'Single', 'rbaroquillo3@gmail.com', '2001-06-14', 'College Undergraduate', 'Male', 'Bachelor of Science in Computer Science', '$2y$10$LY05HcaSFRfmu/RJNHq8F.muxTx8vpw65CBtKn85lkXDDzpghu0Fu', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 04:01:16', '2023-05-28 04:18:26', 0),
(13, 'Rodinel', 'Bergado', 'I', '', 'Bacolod Lanao del Norte', 1010069, '09518405805', 'Single', 'rodinelbergado3@gmail.com', '2000-05-07', 'College Undergraduate', 'Male', 'Bachelor of Science in Computer Science', '$2y$10$14d.nhABxa2pf6LtvumM7eYxlcybpcYg0DOXgpWqpBjsUOmA1c0xW', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 04:05:10', '2023-05-28 04:05:10', 0),
(14, 'Marjie', 'Betacura', 'C', '', 'Maigo Lanao Del Norte', 1009463, '09389812861', 'Single', 'mar.betacura@gmail.com', '2000-07-12', 'College Undergraduate', 'Female', 'Bachelor of Science in Computer Science', '$2y$10$DpOvuwJVJf3VkEOCKm6xsuWGqwFPvxE4J3l2/5xx7rSGYR8ya/HNa', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 04:10:41', '2023-05-28 04:10:41', 0),
(15, 'Jhon Carlo', 'Cabug', 'G', '', 'Maigo Lanao Del Norte', 1005262, '09361768927', 'Single', 'johncarlocabug.03@gmail.com', '2000-07-02', 'College Undergraduate', 'Male', 'Bachelor of Science in Computer Science', '$2y$10$cbV6NQRq47J35M6HCqJciuLTSg3Sm09o.BX9kro4Vz6avgBUsTo9G', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 04:13:42', '2023-05-28 04:13:42', 0),
(16, 'Meriflor', 'Gonoy', 'N', '', 'Kolambugan Lanao del Norte', 1009974, '09559381788', 'Single', 'mgonoy13@gmail.com', '2000-11-19', 'College Undergraduate', 'Female', 'Bachelor of Science in Computer Science', '$2y$10$eA91qCRZTarHOCVie.kwteBq4M3IwjV2nAUeeLyyj2XnSplZpi9yu', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 04:22:48', '2023-05-28 04:22:48', 0),
(17, 'Bryan', 'Ladion', 'B', '', 'Bacolod Lanao del Norte', 1009932, '09264117628', 'Single', 'ladionbryan19@gmail.com', '2000-12-19', 'College Undergraduate', 'Male', 'Bachelor of Science in Computer Science', '$2y$10$RVH65xQcWH/CsS0kAlJhyeabbO/h3uEkw6gnluenRYsAWKIKsfRFi', '2022-2023', NULL, 'Pending', NULL, NULL, '2023-05-28 04:25:59', '2023-05-28 04:25:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `website_image_content`
--

CREATE TABLE `website_image_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_image_content`
--

INSERT INTO `website_image_content` (`id`, `image_name`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 'Main Page', 'images/websiteImage/1685250397_registrar07.jpg', '2023-05-27 23:54:02', '2023-05-28 05:06:37'),
(2, 'Faqs and Announcement', 'images/websiteImage/1685250436_registrar05.jpg', '2023-05-27 23:56:31', '2023-05-28 05:07:16'),
(3, 'About', 'images/websiteImage/1685250470_registrar06.jpg', '2023-05-27 23:58:29', '2023-05-28 05:07:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointments_booking_number_unique` (`booking_number`),
  ADD KEY `appointments_user_id_foreign` (`user_id`),
  ADD KEY `appointments_form_id_foreign` (`form_id`);

--
-- Indexes for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_slots_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `booking_requirements`
--
ALTER TABLE `booking_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_requirements_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `registrar_staffs`
--
ALTER TABLE `registrar_staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `website_image_content`
--
ALTER TABLE `website_image_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking_requirements`
--
ALTER TABLE `booking_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrar_staffs`
--
ALTER TABLE `registrar_staffs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `website_image_content`
--
ALTER TABLE `website_image_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `appointment_slots`
--
ALTER TABLE `appointment_slots`
  ADD CONSTRAINT `appointment_slots_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `booking_requirements`
--
ALTER TABLE `booking_requirements`
  ADD CONSTRAINT `booking_requirements_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

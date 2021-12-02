-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2021 at 03:18 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic_year`
--

CREATE TABLE `tbl_academic_year` (
  `id` int(11) NOT NULL,
  `ay_year` varchar(50) NOT NULL,
  `enable_exam` int(5) NOT NULL,
  `result_available` int(5) NOT NULL,
  `ay_status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_academic_year`
--

INSERT INTO `tbl_academic_year` (`id`, `ay_year`, `enable_exam`, `result_available`, `ay_status`) VALUES
(1, '2021-2022', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_staff`
--

CREATE TABLE `tbl_account_staff` (
  `id` int(11) NOT NULL,
  `staff_username` varchar(100) NOT NULL,
  `staff_password` varchar(250) NOT NULL,
  `staff_title` varchar(50) NOT NULL,
  `staff_first_name` varchar(50) NOT NULL,
  `staff_middle_name` varchar(50) NOT NULL,
  `staff_last_name` varchar(50) NOT NULL,
  `staff_contact` varchar(11) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_profile_img` varchar(1000) NOT NULL,
  `staff_role` int(11) NOT NULL,
  `staff_unit` int(11) NOT NULL,
  `staff_program` int(11) NOT NULL,
  `login_status` int(5) NOT NULL,
  `session_token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account_staff`
--

INSERT INTO `tbl_account_staff` (`id`, `staff_username`, `staff_password`, `staff_title`, `staff_first_name`, `staff_middle_name`, `staff_last_name`, `staff_contact`, `staff_email`, `staff_profile_img`, `staff_role`, `staff_unit`, `staff_program`, `login_status`, `session_token`) VALUES
(1, 'admission', '$2y$10$RcjyI0I9kh0xXWrucqZopetrVv9IOzY3YI4ZdYCKKGZn9VarATXDi', 'Mr.', 'Wendell', '', 'Yu', '09123456789', 'wendellyu@lnu.edu.ph', 'STAFF_PROFILE_wendell_yu.png', 1, 0, 0, 0, ''),
(2, 'exam', '$2y$10$EDJU7QF1bLSOmhkRjpLxqOqlpQ4Hy9pCPo1ndbWquOgF3GpKUSjCe', 'Prof.', 'Lisa', '', 'Bacierra', '09123456789', 'lisabacierra@lnu.edu.ph', 'STAFF_PROFILE_lisa_bacierra.png', 2, 0, 0, 0, ''),
(3, 'itunit', '$2y$10$jhOJAw5heK2GJ5s1LPF/aO94AqQ4IRzF1WWgqLcjTx4M0Ua3vPfvi', 'Dr.', 'Rommel', 'Ligutan', 'Verecio', '09123456789', 'rommelverecio@lnu.edu.ph', 'STAFF_PROFILE_rommel_verecio.png', 3, 1, 0, 0, ''),
(4, 'interviewer', '$2y$10$rhSZu.gd.aZsSluuUEd1LOpyAHd6wO3iKHa8kV3qbBZNfWdRr529W', 'Prof.', 'Raphy', 'Angco', 'Dalan', '09123456789', 'raphydalan@lnu.edu.ph', 'STAFF_PROFILE_raphy_dalan.png', 4, 1, 1, 0, ''),
(5, 'socsci', '$2y$10$5LMlyzAucorefH5b.5voNOB707AibFUMOw9rjjGkI8nefXjM6ogw.', 'Prof.', 'Ryan', '', 'Destura', '09123456789', 'ryandestura@lnu.edu.ph', 'STAFF_PROFILE_ryan_destura.png', 3, 6, 0, 0, ''),
(6, 'interviewer2', '$2y$10$6x9nTguUg29lenWEYEetIuq/D6k49jNT8F9AmUTO5J5jK2/Rutn5.', 'Prof.', 'John', '', 'Doe', '09123456789', 'johndoe@lnu.edu.ph', 'STAFF_PROFILE_john_doe.png', 4, 6, 17, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `verification_key` varchar(250) NOT NULL,
  `verified` int(5) NOT NULL,
  `staff_role` int(11) NOT NULL,
  `login_status` int(5) NOT NULL,
  `session_token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `name`, `email`, `image`, `verification_key`, `verified`, `staff_role`, `login_status`, `session_token`) VALUES
(1, 'admin', '$2y$10$WirUe7tj/6NV3jCP.ckaF.K.d0UPWYdS6.sEG3uzaGaahKrox9zVm', 'Administrator', 'adminsample@example.com', '', '0', 1, 0, 0, ''),
(10, 'admin2', '$2y$10$x2DQsI213Oeu8qLn09Vfmei3xqP2aJk/HtkdIDIicwdv3Lq/DsiBO', 'Assistant Administrator', '1800638@lnu.edu.ph', 'STAFF_PROFILE_assistant_administrator.png', '4930379180f938b0a1864eeee17c4761', 0, 0, 0, ''),
(11, 'admin3', '$2y$10$m2zM63THUbyavhXxOZ9BhuERvOJ2CKsb3JJNtTmmhhtT4jfmlgPeG', 'Assistant Administrator', 'ricocombinido9@gmail.com', 'STAFF_PROFILE_assistant_administrator.png', '64ecd00ab216899b41fd56a6cf740889', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant`
--

CREATE TABLE `tbl_applicant` (
  `id` int(11) NOT NULL,
  `applicant_account_id` int(11) NOT NULL,
  `applicant_picture` varchar(100) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `entry` varchar(100) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `program_first_choice` varchar(100) NOT NULL,
  `program_second_choice` varchar(100) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `date_birth` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `height_feet` int(11) NOT NULL,
  `height_inches` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `place_birth` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mailing_address` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_citizenship` varchar(100) NOT NULL,
  `father_contact` varchar(100) NOT NULL,
  `father_email` varchar(100) NOT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `father_employer_address` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_citizenship` varchar(100) NOT NULL,
  `mother_contact` varchar(100) NOT NULL,
  `mother_email` varchar(100) NOT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `mother_employer_address` varchar(100) NOT NULL,
  `guardian_name` varchar(100) NOT NULL,
  `guardian_citizenship` varchar(100) NOT NULL,
  `guardian_contact` varchar(100) NOT NULL,
  `guardian_email` varchar(100) NOT NULL,
  `guardian_occupation` varchar(100) NOT NULL,
  `guardian_employer_address` varchar(100) NOT NULL,
  `kinder_name` varchar(100) NOT NULL,
  `kinder_address` varchar(100) NOT NULL,
  `kinder_year_graduated` varchar(100) NOT NULL,
  `kinder_honors` varchar(1000) NOT NULL,
  `elem_name` varchar(100) NOT NULL,
  `elem_address` varchar(100) NOT NULL,
  `elem_year_graduated` varchar(100) NOT NULL,
  `elem_honors` varchar(1000) NOT NULL,
  `jhs_name` varchar(100) NOT NULL,
  `jhs_address` varchar(100) NOT NULL,
  `jhs_year_graduated` varchar(100) NOT NULL,
  `jhs_honors` varchar(1000) NOT NULL,
  `shs_name` varchar(100) NOT NULL,
  `shs_address` varchar(100) NOT NULL,
  `shs_strand` varchar(200) NOT NULL,
  `shs_year_graduated` varchar(100) NOT NULL,
  `shs_honors` varchar(1000) NOT NULL,
  `college_name` varchar(100) NOT NULL,
  `college_address` varchar(100) NOT NULL,
  `college_year_graduated` varchar(100) NOT NULL,
  `college_honors` varchar(1000) NOT NULL,
  `college_name2` varchar(100) NOT NULL,
  `college_address2` varchar(100) NOT NULL,
  `college_year_graduated2` varchar(100) NOT NULL,
  `college_honors2` varchar(1000) NOT NULL,
  `reference_name` varchar(100) NOT NULL,
  `reference_address` varchar(100) NOT NULL,
  `reference_contact` varchar(100) NOT NULL,
  `reference_name2` varchar(100) NOT NULL,
  `reference_address2` varchar(100) NOT NULL,
  `reference_contact2` varchar(100) NOT NULL,
  `previous_application` varchar(50) NOT NULL,
  `previous_academic_year` varchar(50) NOT NULL,
  `hobbies` varchar(50) NOT NULL,
  `club_member` varchar(50) NOT NULL,
  `club_name` varchar(100) NOT NULL,
  `disability` varchar(100) NOT NULL,
  `disability_name` varchar(100) NOT NULL,
  `personal_statement` varchar(1000) NOT NULL,
  `form_status` varchar(50) NOT NULL,
  `fs_timestamp` varchar(50) NOT NULL,
  `exam_status` varchar(50) NOT NULL,
  `es_timestamp` varchar(50) NOT NULL,
  `interview_status_1` varchar(50) NOT NULL,
  `interview_status_2` varchar(50) NOT NULL,
  `is_timestamp_1` varchar(50) NOT NULL,
  `is_timestamp_2` varchar(50) NOT NULL,
  `approved_first_choice` int(5) NOT NULL,
  `approved_second_choice` int(5) NOT NULL,
  `admission_status` varchar(50) NOT NULL,
  `as_timestamp` varchar(50) NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_applicant`
--

INSERT INTO `tbl_applicant` (`id`, `applicant_account_id`, `applicant_picture`, `school_year_id`, `entry`, `semester`, `program_first_choice`, `program_second_choice`, `dept_id`, `first_name`, `middle_name`, `last_name`, `date_birth`, `age`, `gender`, `height_feet`, `height_inches`, `weight`, `civil_status`, `place_birth`, `citizenship`, `address`, `mailing_address`, `religion`, `mobile_number`, `father_name`, `father_citizenship`, `father_contact`, `father_email`, `father_occupation`, `father_employer_address`, `mother_name`, `mother_citizenship`, `mother_contact`, `mother_email`, `mother_occupation`, `mother_employer_address`, `guardian_name`, `guardian_citizenship`, `guardian_contact`, `guardian_email`, `guardian_occupation`, `guardian_employer_address`, `kinder_name`, `kinder_address`, `kinder_year_graduated`, `kinder_honors`, `elem_name`, `elem_address`, `elem_year_graduated`, `elem_honors`, `jhs_name`, `jhs_address`, `jhs_year_graduated`, `jhs_honors`, `shs_name`, `shs_address`, `shs_strand`, `shs_year_graduated`, `shs_honors`, `college_name`, `college_address`, `college_year_graduated`, `college_honors`, `college_name2`, `college_address2`, `college_year_graduated2`, `college_honors2`, `reference_name`, `reference_address`, `reference_contact`, `reference_name2`, `reference_address2`, `reference_contact2`, `previous_application`, `previous_academic_year`, `hobbies`, `club_member`, `club_name`, `disability`, `disability_name`, `personal_statement`, `form_status`, `fs_timestamp`, `exam_status`, `es_timestamp`, `interview_status_1`, `interview_status_2`, `is_timestamp_1`, `is_timestamp_2`, `approved_first_choice`, `approved_second_choice`, `admission_status`, `as_timestamp`, `application_date`, `remarks`) VALUES
(1, 1, 'IMG_APPLICANT2021111056995.jpg', 1, 'Freshmen', 'First Semester', '1', '17', 0, 'Rico', 'Villegas', 'Combinido', '1999-09-04', 22, 'Male', 5, 6, 121, 'Married', 'Pasig City', 'Filipino', 'Brgy. Uyawan, Carigara, Leyte', 'N/A', 'Roman Catholic', '09501532031', 'Rodolfo T. Combinido', 'Filipino', 'N/A', 'N/A', 'N/A', 'N/A', 'Flor V. Combinido', 'Filipino', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Rural Improvement Club Children Center', 'Taguig City', '2006', 'N/A', 'Ricardo P. Cruz Sr. Elementary School', 'Taguig City', '2012', 'N/A', 'Holy Cross College of Carigara', 'Carigara, Leyte', '2016', 'N/A', 'Holy Cross College of Carigara', 'Carigara, Leyte', 'Sports and Arts', '2018', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'John Roger Rapis', 'Eastern Samar', '09123456789', 'Nel Patrick Chiqullo', 'Palo, Leyte', '09123456789', 'No', 'N/A', 'Singing', 'No', 'N/A', 'No', 'N/A', 'This is a sample personal statement.', 'Approved', 'November 13, 2021, 6:08:55 PM', 'Scored', 'November 13, 2021, 8:08:39 PM', 'Qualified', 'Pending', 'November 13, 2021, 9:37:47 PM', 'N/A', 1, 1, 'Evaluated', 'November 11, 2021, 9:06:08 PM', '2021-11-10 05:18:59', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_account`
--

CREATE TABLE `tbl_applicant_account` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verification_key` varchar(100) NOT NULL,
  `verified` int(5) NOT NULL,
  `readmission_verified` int(5) NOT NULL,
  `security_question` varchar(50) NOT NULL,
  `security_answer` varchar(50) NOT NULL,
  `form1_progress` varchar(20) NOT NULL,
  `form2_progress` varchar(20) NOT NULL,
  `fp_timestamp` varchar(50) NOT NULL,
  `examination_progress` varchar(20) NOT NULL,
  `ep_timestamp` varchar(50) NOT NULL,
  `interview_progress` varchar(20) NOT NULL,
  `ip_timestamp` varchar(50) NOT NULL,
  `pursue_enrollment` int(11) NOT NULL,
  `student_number` varchar(15) NOT NULL,
  `login_status` int(5) NOT NULL,
  `session_token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_applicant_account`
--

INSERT INTO `tbl_applicant_account` (`id`, `email`, `password`, `verification_key`, `verified`, `readmission_verified`, `security_question`, `security_answer`, `form1_progress`, `form2_progress`, `fp_timestamp`, `examination_progress`, `ep_timestamp`, `interview_progress`, `ip_timestamp`, `pursue_enrollment`, `student_number`, `login_status`, `session_token`) VALUES
(1, 'ricocombinido9@gmail.com', '$2y$10$L0n2nemMxgdARKbS5xCvr.TkBrS.RjdWa2dTsmkRYW8bd436mqX/e', '7e83343bfdede4f50e5692da09c65f46', 1, 1, 'How old is your oldest sibling?', '21', 'Done', 'Done', 'November 10, 2021, 08:28:36 PM', 'Not Started', 'N/A', 'Pending', 'November 13, 2021, 9:37:47 PM', 1, '1800638', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_card`
--

CREATE TABLE `tbl_applicant_card` (
  `id` int(11) NOT NULL,
  `card_applicant_id` int(11) NOT NULL,
  `card_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_applicant_card`
--

INSERT INTO `tbl_applicant_card` (`id`, `card_applicant_id`, `card_image`) VALUES
(1, 1, 'IMG_CARD163654731634453_Screenshot_2021-10-20-09-57-55-124_com.android.chrome.jpg'),
(2, 1, 'IMG_CARD163654731668218_Screenshot_2021-10-20-09-53-02-349_com.android.chrome.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_medical`
--

CREATE TABLE `tbl_applicant_medical` (
  `id` int(11) NOT NULL,
  `medical_applicant_id` int(11) NOT NULL,
  `medical_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_applicant_medical`
--

INSERT INTO `tbl_applicant_medical` (`id`, `medical_applicant_id`, `medical_image`) VALUES
(1, 1, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_acronym` varchar(50) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `course_quota` int(5) NOT NULL,
  `waitlist_quota` int(5) NOT NULL,
  `interview_passing_score` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_name`, `course_acronym`, `unit_id`, `course_quota`, `waitlist_quota`, `interview_passing_score`) VALUES
(1, 'Bachelor of Science in Information Technology', 'BSIT', 1, 220, 50, 80),
(2, 'Bachelor of Elementary Education', 'BEED', 7, 0, 0, 0),
(3, 'Bachelor of Early Childhood Education', 'BECED', 7, 0, 0, 0),
(4, 'Bachelor of Special Needs Education', 'BSNED', 7, 0, 0, 0),
(5, 'Bachelor of Technology and Livelihood Education', 'BTLED', 4, 0, 0, 0),
(6, 'Bachelor of Physical Education', 'BPED', 3, 0, 0, 0),
(7, 'Bachelor of Secondary Education - Major in English', 'BSED - ENGLISH', 11, 0, 0, 0),
(8, 'Bachelor of Secondary Education - Major in Filipino', 'BSED - FILIPINO', 2, 0, 0, 0),
(9, 'Bachelor of Secondary Education - Major in Math', 'BSED - MATH', 5, 0, 0, 0),
(10, 'Bachelor of Secondary Education - Major in Science', 'BSED - SCIENCE', 8, 0, 0, 0),
(11, 'Bachelor of Secondary Education - Major in Social Studies', 'BSED - SOCIAL STUDIES', 6, 0, 0, 0),
(12, 'Bachelor of Secondary Education - Major in Values Education', 'BSED - VALUES', 7, 0, 0, 0),
(13, 'Bachelor of Arts in Communication', 'BACOMM', 11, 0, 0, 0),
(14, 'Bachelor of Library and Information Science', 'BLIS', 12, 0, 0, 0),
(16, 'Bachelor of Arts in English Language', 'BAEL', 11, 0, 0, 0),
(17, 'Bachelor of Arts in Political Science', 'BAPos', 6, 100, 20, 85),
(18, 'Bachelor of Science in Biology', 'BSBio', 8, 0, 0, 0),
(19, 'Bachelor of Science in Social Work', 'BSSW', 13, 0, 0, 0),
(20, 'Bachelor of Science in Tourism Management', 'BSTM', 9, 0, 0, 0),
(21, 'Bachelor of Science in Hospitality Management', 'BSHM', 10, 0, 0, 0),
(22, 'Bachelor of Science in Entrepreneurship', 'BSEntrep', 10, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_acronym` varchar(50) NOT NULL,
  `dept_dean` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `dept_name`, `dept_acronym`, `dept_dean`) VALUES
(1, 'College of Arts and Sciences', 'CAS', 'Dr. Gil Nicetas Villarino'),
(2, 'College of Education', 'COE', 'Dr. Lina G. Fabian'),
(3, 'College of Management and Entrepreneurship', 'CME', 'Dr. Solomon D. Faller');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `id` int(11) NOT NULL,
  `exam_title` varchar(100) NOT NULL,
  `exam_time_limit` varchar(1000) NOT NULL,
  `exam_quest_limit` int(11) NOT NULL,
  `exam_description` varchar(1000) NOT NULL,
  `exam_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `exam_start_date` varchar(30) NOT NULL,
  `exam_end_date` varchar(30) NOT NULL,
  `exam_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`id`, `exam_title`, `exam_time_limit`, `exam_quest_limit`, `exam_description`, `exam_created`, `exam_start_date`, `exam_end_date`, `exam_status`) VALUES
(9, 'OLSAT Entrance Examination', '50', 100, 'This is the standard examination for LNU Admissions.', '2021-09-24 13:31:22', '2021-10-24 00:00', '2021-10-30 00:29', 'Deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam_questions`
--

CREATE TABLE `tbl_exam_questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `choice_1` varchar(100) NOT NULL,
  `choice_2` varchar(100) NOT NULL,
  `choice_3` varchar(100) NOT NULL,
  `choice_4` varchar(100) NOT NULL,
  `correct_answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam_result`
--

CREATE TABLE `tbl_exam_result` (
  `id` int(11) NOT NULL,
  `exam_applicant_id` int(11) NOT NULL,
  `exam_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_exam_result`
--

INSERT INTO `tbl_exam_result` (`id`, `exam_applicant_id`, `exam_score`) VALUES
(1, 1, 84);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE `tbl_faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faqs`
--

INSERT INTO `tbl_faqs` (`id`, `question`, `answer`) VALUES
(1, 'Will the admissions office allow disapproved applicants to resubmit their application forms again?', 'Yes, but the applicant must resubmit the required/lacking documents within the specified period.'),
(2, 'Are the results going to be released immediately?', 'Yes, when the admission committee is done evaluating all applications. Stay tuned on this page for the results.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry`
--

CREATE TABLE `tbl_inquiry` (
  `id` int(11) NOT NULL,
  `inquiry_applicant_id` int(11) NOT NULL,
  `inquiry_reply_role` int(11) NOT NULL,
  `inquiry_category` varchar(30) NOT NULL,
  `inquiry_subject` varchar(250) NOT NULL,
  `inquiry_message` longtext NOT NULL,
  `inquiry_sent_timestamp` varchar(30) NOT NULL,
  `inquiry_reply` longtext NOT NULL,
  `inquiry_reply_timestamp` varchar(30) NOT NULL,
  `inquiry_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inquiry`
--

INSERT INTO `tbl_inquiry` (`id`, `inquiry_applicant_id`, `inquiry_reply_role`, `inquiry_category`, `inquiry_subject`, `inquiry_message`, `inquiry_sent_timestamp`, `inquiry_reply`, `inquiry_reply_timestamp`, `inquiry_status`) VALUES
(1, 1, 0, 'General Inquiry', 'Sample inquiry for the administrator', 'This is a sample inquiry intended for the administrator ', 'November 10, 2021, 2:45 pm', 'This is already settled by the system administrator.', 'November 10, 2021, 3:33 pm', 'Settled'),
(2, 1, 1, 'General Inquiry', 'Sample inquiry for the admissions office.', 'This is a sample inquiry for the admissions office.', 'November 10, 2021, 3:22 pm', 'This is settled by the admissions office.', 'November 10, 2021, 3:36 pm', 'Settled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interview`
--

CREATE TABLE `tbl_interview` (
  `id` int(11) NOT NULL,
  `interview_applicant_id` int(11) NOT NULL,
  `interview_staff_id_1` int(11) NOT NULL,
  `interview_staff_id_2` int(11) NOT NULL,
  `interview_preferred_method` varchar(30) NOT NULL,
  `interview_method_1` varchar(20) NOT NULL,
  `interview_date_1` varchar(20) NOT NULL,
  `interview_time_1` varchar(20) NOT NULL,
  `interview_venue_or_link_1` varchar(100) NOT NULL,
  `interview_rating_1` int(5) NOT NULL,
  `interview_method_2` varchar(20) NOT NULL,
  `interview_date_2` varchar(20) NOT NULL,
  `interview_time_2` varchar(20) NOT NULL,
  `interview_venue_or_link_2` varchar(100) NOT NULL,
  `interview_rating_2` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_interview`
--

INSERT INTO `tbl_interview` (`id`, `interview_applicant_id`, `interview_staff_id_1`, `interview_staff_id_2`, `interview_preferred_method`, `interview_method_1`, `interview_date_1`, `interview_time_1`, `interview_venue_or_link_1`, `interview_rating_1`, `interview_method_2`, `interview_date_2`, `interview_time_2`, `interview_venue_or_link_2`, `interview_rating_2`) VALUES
(1, 1, 4, 6, 'Video Call', 'Video Call', '11/18/2021', '7:00 AM', 'meet.google,com/xhj-dda-vase', 86, 'Video Call', '11/15/2021', '8:30 AM', 'meet.google.com/bja-zars-rdg', 85);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id` int(11) NOT NULL,
  `log_staff_id` int(11) NOT NULL,
  `log_staff_role` int(11) NOT NULL,
  `log_staff_username` varchar(50) NOT NULL,
  `log_description` varchar(250) NOT NULL,
  `timestamp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `log_staff_id`, `log_staff_role`, `log_staff_username`, `log_description`, `timestamp`) VALUES
(1, 1, 0, 'admin', 'Modified the academic unit Science Unit', '11/13/2021, 6:07:50 PM'),
(2, 1, 1, 'admission', 'Approved application form of Rico Combinido', '11/13/2021, 6:08:55 PM'),
(3, 1, 1, 'admission', 'Added a new FAQ entry', '11/13/2021, 6:17:44 PM'),
(4, 1, 1, 'admission', 'Modified a FAQ entry', '11/13/2021, 6:18:24 PM'),
(5, 1, 1, 'admission', 'Assigned student number to Rico Villegas Combinido', '11/13/2021, 12:38:30 PM'),
(6, 1, 1, 'admission', 'Assigned student number to Rico Villegas Combinido', '11/13/2021, 7:40:28 PM'),
(7, 1, 1, 'admission', 'Added a new admission procedure', '11/13/2021, 7:59:22 PM'),
(8, 1, 1, 'admission', 'Modified an admission requirement', '11/13/2021, 7:59:57 PM'),
(9, 2, 2, 'exam', 'Encoded examination score for Rico Combinido', '11/13/2021, 8:08:39 PM'),
(11, 4, 4, 'interviewer', 'Scheduled interview for Rico Combinido', '11/13/2021, 8:47:13 PM'),
(12, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:12:27 PM'),
(13, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:21:09 PM'),
(14, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:23:35 PM'),
(15, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:26:42 PM'),
(16, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:29:27 PM'),
(17, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:30:35 PM'),
(18, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:33:57 PM'),
(19, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:36:08 PM'),
(20, 4, 4, 'interviewer', 'Encoded interview rating for Rico Combinido', '11/13/2021, 9:37:47 PM'),
(21, 0, 3, 'itunit', 'Added  to program waitlist', '11/13/2021, 10:10:15 PM'),
(22, 0, 3, 'itunit', 'Modified program configurations for Bachelor of Science in Information Technology', '11/13/2021, 10:13:43 PM'),
(23, 3, 3, 'itunit', 'Modified program configurations for Bachelor of Science in Information Technology', '11/13/2021, 10:16:06 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_procedures`
--

CREATE TABLE `tbl_procedures` (
  `id` int(5) NOT NULL,
  `procedure_step_num` int(5) NOT NULL,
  `procedure_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_procedures`
--

INSERT INTO `tbl_procedures` (`id`, `procedure_step_num`, `procedure_desc`) VALUES
(1, 1, 'This is a sample of the first admission procedure for demonstration.'),
(2, 2, 'This is a sample of the second admission procedure for demonstration.'),
(3, 3, 'This is a sample of the third admission procedure for demonstration.'),
(4, 4, 'This is a sample of the fourth admission procedure for demonstration.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requirements`
--

CREATE TABLE `tbl_requirements` (
  `id` int(5) NOT NULL,
  `requirements_num` int(5) NOT NULL,
  `requirements_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_requirements`
--

INSERT INTO `tbl_requirements` (`id`, `requirements_num`, `requirements_desc`) VALUES
(1, 1, 'Duly accomplished Online Admission Application Form'),
(2, 2, 'A scanned copy or a photograph of Grade 12 card showing the grades on all subjects during the first semester, LRN and Strand, or Official Transcript of Records from the school last attended for Transferees.'),
(3, 3, 'A recent (within 6 months) decent solo full-body photo of the applicant with a plain white background and preferrably a square one.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedules`
--

CREATE TABLE `tbl_schedules` (
  `id` int(5) NOT NULL,
  `schedule_date` varchar(50) NOT NULL,
  `schedule_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedules`
--

INSERT INTO `tbl_schedules` (`id`, `schedule_date`, `schedule_desc`) VALUES
(1, 'Tuesday, May 03, 2022', 'Submission of Online Admission Applications Through Portal'),
(2, 'Tuesday, May 24, 2022', 'Conduct of Interview via Phone or Video Call'),
(3, 'Thursday, June 24, 2021', 'Announcement of Admission Qualifiers');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(1000) NOT NULL,
  `unit_desc` varchar(1000) NOT NULL,
  `unit_dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `unit_name`, `unit_desc`, `unit_dept_id`) VALUES
(1, 'IT and Computer Education Unit', 'N/A', 1),
(2, 'Filipino Unit', 'N/A', 2),
(3, 'MAPEH Unit', 'N/A', 2),
(4, 'HAE Unit', 'N/A', 2),
(5, 'Math Unit', 'N/A', 2),
(6, 'Social Science Unit', 'N/A', 1),
(7, 'Professional Education Unit', 'N/A', 2),
(8, 'Science Unit', 'Test', 2),
(9, 'Tourism Unit', 'N/A', 3),
(10, 'Entrepreneurship Unit', 'N/A', 3),
(11, 'Languages and Literature Unit', 'N/A', 2),
(12, 'BLIS Unit', 'N/A', 1),
(13, 'Social Work Unit', 'N/A', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_academic_year`
--
ALTER TABLE `tbl_academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_account_staff`
--
ALTER TABLE `tbl_account_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant`
--
ALTER TABLE `tbl_applicant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant_account`
--
ALTER TABLE `tbl_applicant_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant_card`
--
ALTER TABLE `tbl_applicant_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicant_medical`
--
ALTER TABLE `tbl_applicant_medical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exam_questions`
--
ALTER TABLE `tbl_exam_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exam_result`
--
ALTER TABLE `tbl_exam_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_interview`
--
ALTER TABLE `tbl_interview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_procedures`
--
ALTER TABLE `tbl_procedures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_academic_year`
--
ALTER TABLE `tbl_academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_account_staff`
--
ALTER TABLE `tbl_account_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_applicant`
--
ALTER TABLE `tbl_applicant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_applicant_account`
--
ALTER TABLE `tbl_applicant_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_applicant_card`
--
ALTER TABLE `tbl_applicant_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_applicant_medical`
--
ALTER TABLE `tbl_applicant_medical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_exam_questions`
--
ALTER TABLE `tbl_exam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_exam_result`
--
ALTER TABLE `tbl_exam_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_interview`
--
ALTER TABLE `tbl_interview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_procedures`
--
ALTER TABLE `tbl_procedures`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

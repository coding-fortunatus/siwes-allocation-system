-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2023 at 02:03 PM
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
-- Database: `siwes_allocation`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(100) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `department_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_code`) VALUES
(1, 'Computer Science', 'CS'),
(2, 'Maths/Statistics', 'MS'),
(3, 'Marketing', 'MKT'),
(4, 'Computer Engineering', 'CTE'),
(5, 'General Studies', 'GNS'),
(6, 'Science Laboratory Technology', 'SLT'),
(7, 'Food Science Technology', 'FT'),
(8, 'Nutrition and Dietetics', 'NUD'),
(9, 'Hospitality Management', 'HMT'),
(10, 'Civil Engineering', 'CE'),
(11, 'Accountancy', 'AC'),
(12, 'Mechanical Engineering', 'ME'),
(13, 'Business Administration', 'BA'),
(14, 'Office Technology Management', 'OTM'),
(15, 'Banking and Finance', 'BF'),
(16, 'Library and Information Science', 'LIS'),
(17, 'Taxation', 'TAX'),
(18, 'Agric. Bio-Envr. Engr. Tech ', 'ABE'),
(19, 'Surveying & Geo-informatics', 'SG'),
(20, 'Architectural Technology', 'ARC'),
(21, 'Public Administration', 'PA'),
(22, 'Quantity Surveying', 'QS'),
(23, 'Electrical Electronics Engineering', 'EE'),
(24, 'Mass Communication', 'MSC'),
(25, 'Estate Management & Valuation', 'EMV'),
(26, 'Art & Design', 'ARD'),
(27, 'Mechatronics Engineering Tech', 'MCE'),
(28, 'Innovation Centre', 'INC'),
(29, 'Urban & Regional Planning', 'URP'),
(30, 'Insurance', 'INS'),
(31, 'Transp. Plan. & Mgt.', 'TPM'),
(32, 'Building Technology', 'BT'),
(33, 'Leisure & Tourism', 'LT'),
(34, 'Welding & Fabrication', 'WEC'),
(35, 'Robotics Centre', 'ROB'),
(36, 'Music Technology', 'MT'),
(37, 'Agricultural Technology', 'AGT'),
(38, 'Rectory', 'REC');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(100) NOT NULL,
  `lecturer_name` varchar(100) NOT NULL,
  `lecturer_code` varchar(10) NOT NULL,
  `lec_status` varchar(50) NOT NULL,
  `passwords` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `lecturer_name`, `lecturer_code`, `lec_status`, `passwords`) VALUES
(1, 'MR OLORUNTOBA S.A', 'CS001', 'Chief Lecturer', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(2, 'DR.(MRS) SOYEMI, J.', 'CS002', 'Chief Lecturer', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(3, 'DR. (MRS) ODUNTAN, O.E', 'CS003', 'Chief Lecturer', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(4, 'MR ALAWODE, A.J.', 'CS004', 'Senior Lecturer', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(5, 'MR. OJUAWO, O.O.', 'CS005', 'Lecturer 1', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(6, 'MR AKINODE, J.L.', 'CS006', 'Lecturer 1', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(7, 'MR HAMMED, M.', 'CS007', 'Lecturer 2', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(10, 'MR. BUOYE, P.A.', 'CS008', 'Lecturer 2', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(11, 'MR. ADEGBOYE, O.J.', 'CS009', 'Lecturer 2', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(12, 'MR. OGUNSEYE, J.O.', 'CS010', 'Lecturer 3', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(13, 'MISS ADEBOWALE, O.A.', 'CS011', 'lecturer 3', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(14, 'MR. AYODELE, EMMANUEL', 'CS012', 'Assistant Lecturer', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(15, 'MR. JIBOKU, FOLAHAN J.', 'CS013', 'Assistant Lecturer', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(16, 'MR. SODEINDE, VICTOR O.', 'CS014', 'Assistant Lecturer', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(17, 'MR. AROWOLO, P.', 'CS015', 'Senior Instructor', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(18, 'MRS BELLO, Z.O', 'CS016', 'Technologist 2', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(19, 'MR. ADIO ABIODUN', 'CS017', '', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(20, 'MRS AKINBOLA', 'CS018', '', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(21, 'MR AWOSANYA', 'CS019', '', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(22, 'MRS GANIYU SUKURAT', 'CS020', '', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(23, 'MRS ADEYEMI A.B', 'CS021', '', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(24, 'MISS ADEBOWALE O.A', 'CS022', '', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW'),
(25, 'AROWOLO AHMED', 'CS023', '', '$2y$10$9pnKb/lcz72OcVeXZOQ3TupL19mo22QD4gFA1QxAov3owtn2ivZOW');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_allocation`
--

CREATE TABLE `lecturer_allocation` (
  `id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `students` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_allocation`
--

INSERT INTO `lecturer_allocation` (`id`, `lecturer_id`, `students`) VALUES
(1, 1, 'N/CS/21/3043 N/CS/21/2970 N/CS/21/3040 N/CS/21/2983'),
(2, 2, 'N/CS/21/3007 N/CS/21/3008 N/CS/21/3013 N/CS/21/2981'),
(3, 3, 'N/CS/21/2978 N/CS/21/3001 N/CS/21/2986 N/CS/21/2992'),
(4, 4, 'N/CS/21/2987 N/CS/21/3044 N/CS/21/3025 N/CS/21/3012'),
(5, 5, 'N/CS/21/3039 N/CS/21/3029 N/CS/21/3050 N/CS/21/3009'),
(6, 6, 'N/CS/21/2989 N/CS/21/3026 N/CS/21/2973 N/CS/21/2991'),
(7, 7, 'N/CS/21/3016 N/CS/21/2975 N/CS/21/3032 N/CS/21/2972'),
(8, 10, 'N/CS/21/2997 N/CS/21/3049 N/CS/21/3033 N/CS/21/3021'),
(9, 11, 'N/CS/21/3017 N/CS/21/3011 N/CS/21/3041 N/CS/21/3014'),
(10, 12, 'N/CS/21/3028 N/CS/21/3022 N/CS/21/3000 N/CS/21/2974'),
(11, 13, 'N/CS/21/3030 N/CS/21/2969 N/CS/21/3034 N/CS/21/2999'),
(12, 14, 'N/CS/21/3024 N/CS/21/3047 N/CS/21/3010 N/CS/21/3004'),
(13, 15, 'N/CS/21/3046 N/CS/21/3005 N/CS/21/3037 N/CS/21/2990'),
(14, 16, 'N/CS/21/2979 N/CS/21/3020 N/CS/21/2982'),
(15, 17, 'N/CS/21/3006 N/CS/21/3023 N/CS/21/3003'),
(16, 18, 'N/CS/21/3045 N/CS/21/3048 N/CS/21/2971'),
(17, 19, 'N/CS/21/3019 N/CS/21/3027 N/CS/21/3038'),
(18, 20, 'N/CS/21/2996 N/CS/21/2976 N/CS/21/2985'),
(19, 21, 'N/CS/21/3018 N/CS/21/2995 N/CS/21/2988'),
(20, 22, 'N/CS/21/3002 N/CS/21/2980 N/CS/21/3042'),
(21, 23, 'N/CS/21/2993 N/CS/21/3031 N/CS/21/3015'),
(22, 24, 'N/CS/21/3035 N/CS/21/2984 N/CS/21/3036'),
(23, 25, 'N/CS/21/2994 N/CS/21/2977 N/CS/21/2998');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `matric_number` varchar(100) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `passwords` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `matric_number`, `fullname`, `email`, `passwords`) VALUES
(2, 'N/CS/21/2969', 'IJACHI EMMANUEL', 'tobiijachi@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(3, 'N/CS/21/2970', 'AKINDE SAMUEL', '123samuelakinde@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(4, 'N/CS/21/2971', 'ALUKU FAVOUR', 'alukufavouraniel@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(5, 'N/CS/21/2972', 'OPALEYE TEMINIOLUWA', 'teminioluwaopaleye@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(6, 'N/CS/21/2973', 'ADEKOYA SARAH', 'sarahadekoya083@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(7, 'N/CS/21/2974', 'ABDULWAHAB MALIK', 'abdulwahabmalikfowu@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(8, 'N/CS/21/2975', 'BIOBAKU TESLIM', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(9, 'N/CS/21/2976', 'ADEJOBI TEMITOPE', 'adejobitemiboy@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(10, 'N/CS/21/2977', 'AKINDE IBRAHIM', 'akindeibrahim319@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(11, 'N/CS/21/2978', 'JIDONU BOLUWATIFE', 'jidosboluwatife2002@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(12, 'N/CS/21/2979', 'OLAGUNJU SAMUEL', 'olagunjusamuel47@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(13, 'N/CS/21/2980', 'ANIMASHAUN ABDULBAI', 'animashaunabdulba@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(14, 'N/CS/21/2981', 'ALAYANDE ABDULBASIT', 'alayandeabdulbasit@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(15, 'N/CS/21/2982', 'RICHARD BUSOLAMI', 'tofunmirichard@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(16, 'N/CS/21/2983', 'AKINLOYE AYOMIDE', 'clintonayomide838@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(17, 'N/CS/21/2984', 'LADEGA DANIEL', 'danielladega01@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(18, 'N/CS/21/2985', 'ABDULAZEEZ KHADIJAH', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(19, 'N/CS/21/2986', 'OHIREIMEN CONFIDENCE', 'confidenceohireimen75@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(20, 'N/CS/21/2987', 'OSOKO EXCEL', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(21, 'N/CS/21/2988', 'ADELEKE AYOMIDE', 'ayomideadeleke989@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(22, 'N/CS/21/2989', 'BADEJO OYEBANJI', 'oyebanjir5@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(23, 'N/CS/21/2990', 'OYENEKAN ISRAEL', 'oyenekanisreal2021@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(24, 'N/CS/21/2991', 'AMAHALU UGOCHUKWU', 'ugochukwuamahalu@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(25, 'N/CS/21/2992', 'ADEYEMI EMMANUEL', 'adeyemie125@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(26, 'N/CS/21/2993', 'ISMAILA AZEEZ', 'azeezabiodun012@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(27, 'N/CS/21/2994', 'ONYEACHONAM MERVYN', 'adedayodesmomd@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(28, 'N/CS/21/2995', 'BAKARA MARYAM', 'bakaramaryam@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(29, 'N/CS/21/2996', 'OLALEYE VICTORIA', 'victoriaolaleye8@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(30, 'N/CS/21/2997', 'ADEBAYO MICHAEL', 'adebayomichael2203@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(31, 'N/CS/21/2998', 'ADERIBIGBE OLUWAPELUMI', 'Aderibigbefeyisetan2005@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(32, 'N/CS/21/2999', 'OLAWALE AYOMIDE', 'olawaleayomide970@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(33, 'N/CS/21/3000', 'ADELEKE MOHAMMED', 'adelekemohammed356@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(34, 'N/CS/21/3001', 'JEGEDE SIMEON', 'Adejuwonsimeon73@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(35, 'N/CS/21/3002', 'OLADEJO DOMINION', 'dominionoladejo1@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(36, 'N/CS/21/3003', 'OGUNBIYI RICHARD', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(37, 'N/CS/21/3004', 'OGUNDELE FAVOUR', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(38, 'N/CS/21/3005', 'OMOGOR EMMANUEL', 'omogoremmanuel24@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(39, 'N/CS/21/3006', 'DIBANI VICTORY', 'dibaniprince4@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(40, 'N/CS/21/3007', 'ADARAMOLA SAMUEL', 'samueladaramola31@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(41, 'N/CS/21/3008', 'RASHEED SAUDAH', 'saudahanuoluwapo@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(42, 'N/CS/21/3009', 'KUFORIJI SAMUEL', 'Kuforijisamuel1@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(43, 'N/CS/21/3010', 'FATOKI UDUS', 'olamilekan1811@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(44, 'N/CS/21/3011', 'OLAYINKA SAMUEL', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(45, 'N/CS/21/3012', 'AJALA ABDULBASIT', 'ajala.ba2014@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(46, 'N/CS/21/3013', 'OBAYEJU OMOLOLA', 'lhorlarwhaysapphire@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(47, 'N/CS/21/3014', 'ADEYEMI MUBARAK', 'adeyemiadigun12@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(48, 'N/CS/21/3015', 'OGUNTOLA OLUWADAMILOLA', 'damisco005@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(49, 'N/CS/21/3016', 'ADEDAYO EMMANUEL', 'adedayoemmy2004@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(50, 'N/CS/21/3017', 'ABDULAREEM ABIMBOLA', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(51, 'N/CS/21/3018', 'ISHOLA OLUWATOFUNMI', 'isholaoluwatofunmi97@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(52, 'N/CS/21/3019', 'OLUMIDE PAUL', 'olumidepaul864@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(53, 'N/CS/21/3020', 'AYENI MOYINOLUWA', 'ayenimoyinoluwa2005@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(54, 'N/CS/21/3021', 'KINGSTON ANWARSADAT', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(55, 'N/CS/21/3022', 'SOGUNLE BANJI', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(56, 'N/CS/21/3023', 'OLAYINKA OLATOYE', 'olayinkaq2@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(57, 'N/CS/21/3024', 'ADENLE OLUWATOSIN', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(58, 'N/CS/21/3025', 'OGUNMILUYI BOLUWATIFE', 'ogunmiluyiboluwatife@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(59, 'N/CS/21/3026', 'SAMUEL CALEB', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(60, 'N/CS/21/3027', 'AKANDE BOLUWATIFE', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(61, 'N/CS/21/3028', 'SALAUDEEN RIDWAN', 'horlahmii4250@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(62, 'N/CS/21/3029', 'FOLASHELE OLANREWAJU', 'larryfola@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(63, 'N/CS/21/3030', 'ALATISE RACHAEL', 'rachaeltemitopealatise@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(64, 'N/CS/21/3031', 'ADEBOWALE SAMUEL', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(65, 'N/CS/21/3032', 'OSANYIBI TAOFEE', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(66, 'N/CS/21/3033', 'LAMEED AZEEZAT', 'Lameedazeezat01@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(67, 'N/CS/21/3034', 'POPOOLA EMMANUEL', 'Popoolae90@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(68, 'N/CS/21/3035', 'KUDORO TITILAYO', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(69, 'N/CS/21/3036', 'AYANDELE AYOMIDE', 'ayandeleayomide1@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(70, 'N/CS/21/3037', 'ADEKOYA DAVID', 'adekoyadavidadeboye@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(71, 'N/CS/21/3038', 'KUKOYI ANTHONY', 'anthonydamilola24@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(72, 'N/CS/21/3039', 'AKINOLA SAMUEL', 'akinolasam904@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(73, 'N/CS/21/3040', 'ADESHINA JOHN', 'tblizz2004@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(74, 'N/CS/21/3041', 'ALIU MARY', 'aliumary49@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(75, 'N/CS/21/3042', 'EGBETOKUN', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(76, 'N/CS/21/3043', 'KIMEKU DAVID', 'Isiomadavid239@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(77, 'N/CS/21/3044', 'BAMIDELE OPEYEMI', 'bamideleopeyemi2003@gmailcom', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(78, 'N/CS/21/3045', 'AGBOOLA IBRAHIM', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(79, 'N/CS/21/3046', 'OGNDARE JAMIU', 'ogundaredamilare52@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(80, 'N/CS/21/3047', 'OFINNI JOSHUA', 'ofinnijoshua2021@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(81, 'N/CS/21/3048', '', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(82, 'N/CS/21/3049', 'JIMOR UMAR', 'jimohumar283@gmail.com', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO'),
(83, 'N/CS/21/3050', 'OLASUNKANMI AYOBAMI', '', '$2y$10$2nUMbhAMgW0w57coMC0cTeqyhv15g/ZdgY9CmCVC1YPjG1MA1UhLO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_code` (`department_code`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lecturer_code` (`lecturer_code`);

--
-- Indexes for table `lecturer_allocation`
--
ALTER TABLE `lecturer_allocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matric_number` (`matric_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lecturer_allocation`
--
ALTER TABLE `lecturer_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecturer_allocation`
--
ALTER TABLE `lecturer_allocation`
  ADD CONSTRAINT `lecturer_allocation_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

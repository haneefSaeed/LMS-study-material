-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 03:23 PM
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
-- Database: `kestudy`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `ch_id` int(11) NOT NULL,
  `ch_sub_id` int(11) NOT NULL,
  `ch_title` varchar(222) DEFAULT NULL,
  `ch_no` int(11) NOT NULL,
  `ch_obj` text DEFAULT NULL,
  `ch_out` text DEFAULT NULL,
  `ch_materials` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`ch_id`, `ch_sub_id`, `ch_title`, `ch_no`, `ch_obj`, `ch_out`, `ch_materials`) VALUES
(1, 1, 'Introducing Marketing', 1, '<li>Introduction to Digital Marketing</li><li>Basics of Digital Marketing</li>', '<li>Understand the importance of Digital Marketing</li>                            <li>Differentiate between traditional marketing and Digital Marketing</li>', 'kardan video, slide, supportive video, book, quiz'),
(2, 1, 'MicroEnviornment', 2, '<li>Some Description about Objectives </li>', '<li>Outcomes of Chapter 2</li>', 'video,slide, kvideo'),
(3, 1, 'The Online Macro Environment ', 3, '<li>The need for an integrated digital marketing strategy</li>', '<li>The need for an integrated digital marketing strategy</li>', 'Kardan Video, Video, Slide, Book'),
(4, 1, 'Digital Marketing Strategy', 4, '<li>The need for an integrated digital marketing strategy</li>', '<li>The need for an integrated digital marketing strategy</li>', 'Kardan Video, Video, Slide'),
(5, 1, 'Impact of digital Media and Technology', 5, '<li>The need for an integrated digital marketing strategy</li>', '<li>The need for an integrated digital marketing strategy</li>', 'Kardan Video, Video, Slide, Book');

-- --------------------------------------------------------

--
-- Table structure for table `completed_course`
--

CREATE TABLE `completed_course` (
  `comp_id` int(11) NOT NULL,
  `comp_sub_id` int(11) DEFAULT NULL,
  `comp_chapter_id` int(11) DEFAULT NULL,
  `comp_user_id` int(11) NOT NULL,
  `comp_percentage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_course`
--

INSERT INTO `completed_course` (`comp_id`, `comp_sub_id`, `comp_chapter_id`, `comp_user_id`, `comp_percentage`) VALUES
(8, 1, 1, 1, 100),
(9, 1, 2, 1, 0),
(10, 1, 1, 6, 0),
(11, 1, 4, 1, 0),
(12, 1, 3, 1, 0),
(13, 1, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `exam_subject_id` int(11) DEFAULT NULL,
  `exam_Name` varchar(222) DEFAULT NULL,
  `exam_correct_mark` int(11) DEFAULT NULL,
  `exam_wrong_mark` int(11) DEFAULT NULL,
  `exam_total_questions` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_subject_id`, `exam_Name`, `exam_correct_mark`, `exam_wrong_mark`, `exam_total_questions`) VALUES
(1, 1, 'Digital Marketing Exam', 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `ans_question_id` int(11) DEFAULT NULL,
  `ans_answer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_answers`
--

INSERT INTO `exam_answers` (`ans_question_id`, `ans_answer_id`) VALUES
(1, 4),
(2, 8),
(1, 4),
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `exam_history`
--

CREATE TABLE `exam_history` (
  `his_id` int(11) NOT NULL,
  `his_exam_id` int(11) DEFAULT NULL,
  `his_user_id` int(11) DEFAULT NULL,
  `his_score` int(11) DEFAULT NULL,
  `his_level` int(11) DEFAULT NULL,
  `his_correct` int(11) DEFAULT NULL,
  `his_wrong` int(11) DEFAULT NULL,
  `his_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_history`
--

INSERT INTO `exam_history` (`his_id`, `his_exam_id`, `his_user_id`, `his_score`, `his_level`, `his_correct`, `his_wrong`, `his_date`) VALUES
(38, 1, 1, 4, 2, 1, 1, '2020-01-27 02:35:03'),
(39, 1, 1, 10, 2, 2, 0, '2020-01-27 02:35:55'),
(40, 1, 1, 4, 2, 1, 1, '2020-01-27 07:52:12'),
(41, 1, 1, -2, 2, 0, 2, '2024-04-29 12:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `exam_options`
--

CREATE TABLE `exam_options` (
  `option_id` int(11) NOT NULL,
  `option_quest_id` int(11) DEFAULT NULL,
  `option_option` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_options`
--

INSERT INTO `exam_options` (`option_id`, `option_quest_id`, `option_option`) VALUES
(1, 1, 'is an activity'),
(2, 1, ' set of Institutions'),
(3, 1, 'processes for Creating, communicating, Delivering'),
(4, 1, 'All of the Above'),
(5, 2, 'Interactivity'),
(6, 2, 'Social Networking'),
(7, 2, 'Mass Reach'),
(8, 2, 'All of The Above');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `quest_id` int(11) NOT NULL,
  `quest_exam_id` int(11) DEFAULT NULL,
  `quest_question` text DEFAULT NULL,
  `quest_choices` int(4) DEFAULT NULL,
  `quest_no` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`quest_id`, `quest_exam_id`, `quest_question`, `quest_choices`, `quest_no`) VALUES
(1, 1, 'What is Marketing?', 4, 1),
(2, 1, 'What is Features of Digital Marketing?', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exam_rank`
--

CREATE TABLE `exam_rank` (
  `rank_id` int(11) NOT NULL,
  `rank_user_id` int(11) DEFAULT NULL,
  `rank_score` int(11) DEFAULT NULL,
  `rank_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_rank`
--

INSERT INTO `exam_rank` (`rank_id`, `rank_user_id`, `rank_score`, `rank_time`) VALUES
(4, 1, 90, '2024-04-29 12:52:50'),
(5, 7, 34, '2020-01-23 04:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_id` int(11) NOT NULL,
  `fac_name` varchar(22) DEFAULT NULL,
  `fac_full_name` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_id`, `fac_name`, `fac_full_name`) VALUES
(1, 'BBA', 'Bachelor Business Administration'),
(2, 'BCS', 'Bachelor Computer Science'),
(3, 'BCE', 'Bachelor Civil Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `note_ch_id` int(11) NOT NULL,
  `note_text` text DEFAULT NULL,
  `note_topic` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `note_ch_id`, `note_text`, `note_topic`) VALUES
(1, 1, ' <h4 id=\"t1\">What is marketing?</h4>\r\n                   <p> Marketing is the activity, set of Institutions, and processes for Creating, communicating, Delivering, and exchanging Offerings that have value for Customers, clients, partners, and Society at large.\r\n                   </p>\r\n                    <h4 id=\"t2\">What is digital Marketing?</h4>\r\n                    <p>Digital marketing encompasses all Marketing efforts that use an Electronic device or the Internet. Businesses leverage digital Channels such as search engines, Social media, email, and other Websites to connect with current And prospective customers.\r\n                    </p>\r\n\r\n                    <h4 id=\"t3\">What is digital media?</h4>\r\n                    <p>Digital media is everywhere. You come Across the term all the time. But what really\r\n                        Is digital media? Digital media can be Defined as any audio, video and any other Graphics such as photos and animation That has been encoded in order for a Computer to be able to read it. Encoding is The process of converting and audio or Visual information to a computer readable Format. Once media has been encoded, it Can be modified and distributed by the User as they please.\r\n                    </p>\r\n                    <h4 id=\"t4\">Features of digital media?</h4>\r\n                    <ol type=\"1\">\r\n                    <li>Interactivity:</li>\r\n                    <p>Interactive media normally refers to Products and services On digital computer-based systems Which respond to the user\'s actions by Presenting content such as text, moving Image, animation, video, audio, and Video games.</p>\r\n\r\n                        <li>Social Networking</li>\r\n                        <p>Social networking is the use of Internet-based social media sites to stay Connected with friends, family, colleagues, Customers, or clients. Social networking Can have a social purpose, a business Purpose, or both, through sites such as Facebook, Twitter, LinkedIn, and Instagram, among others. Social Networking has become a significant base For marketers seeking to engage Customers.</p>\r\n\r\n                        <li>Mass Reach</li>\r\n                        <p>Difference between Digital Marketing and Traditional Marketing Traditional Marketing: contains Print Media (newspaper and magazines ads, Newsletters, brochures and other printed Material) Broadcast media(like TV and radio ads) Direct mail (including fliers, postcards, Catalogs) Telemarketing Verified techniques for a higher rate of Success Long-standing projects that the public Already recognizes Analytics for measuring results</p>\r\n                    </ol>\r\n\r\n                    <h4 id=\"t5\">Difference between Digital Marketing and Traditional Marketing</h4>\r\n                    <p>Digital marketing includes marketing Efforts anchored on electronics devices just\r\n                        Like- Websites Social networking sites Content marketing Banner Ads Google Ads Online video marketing. Cost-effective strategies for marketing Remarkable visitors achieve enables primary response from the intended Audience.</p>\r\n\r\n                    <h4 id=\"t6\"> Benefits of Digital Marketing</h4>\r\n                    <ol type=\"1\">\r\n                        <li>Measurable results</li>\r\n                        <p>There is no effective way to measure home many people looked at your Billboard or how many people looked at your flyer instead of recycling it. With Digital marketing, you are provided with Solid, reliable reports that show you the exact results of how many people opened your email or clicked a specific Link.</p>\r\n\r\n                        <li>Low barrier to entry Traditional marketing activities Come with a large price tag.</li>\r\n                        <p>Billboards, TV ads, and radio Commercials are certainly not Cheap. Digital marketing products Come in scalable sizes so that Small, medium, and large Businesses can all utilize these Products to reach their audiences.</p>\r\n\r\n                        <li>Reach larger Audiences</li>\r\n\r\n                        <p>Since digital marketing takes place Online, it is accessible to a larger, Global audience. Whereas with Traditional marketing, you’re Typically limited to a geographic Area, digital marketing allows you to Reach international audiences Through effective means.</p>\r\n\r\n                        <li>Easy to optimize</li>\r\n                        <p>Since digital marketing comes with Reporting, if you see something that Is not performing as well as you’d Like, it’s easy to pinpoint it andChange it. You can even try several Different things, measure which one Worked best, and select that option As the main tactic moving forward.</p>\r\n\r\n                        <li>Digital marketing can make You money</li>\r\n                        <p>This is one of the sweetest benefits of Digital marketing. There is no limit to How much you can earn when you Acquire and master the various digital Marketing skills you need to succeed</p>\r\n\r\n                        <li>You connect with more</li>\r\n                        <p>Customers online Digital marketing basically is an Internet based form of buying and Selling of goods ad services. It is not the usual traditional form. Gone are the days when people scan Through volumes of phone Directories or browse through pages Upon pages of broadsheets to look for Information about a product or Service.</p>\r\n', '<li><a href=\"#t1\" class=\"twhite\" style=\"color:gray;\">What is Marketing?</a></li>\r\n                    <li><a href=\"#t2\" class=\"twhite\" style=\"color:gray;\">What is Digital Marketing?</a></li>\r\n                    <li><a href=\"#t3\" class=\"twhite\" style=\"color:gray;\">What is Digital Media?</a></li>\r\n                    <li><a href=\"#t4\" class=\"twhite\" style=\"color:gray;\">Features of Digital Media</a></li>\r\n                    <li><a href=\"#t5\" class=\"twhite\" style=\"color:gray;\">Digital vs Traditional</a></li>\r\n                    <li><a href=\"#t6\" class=\"twhite\" style=\"color:gray;\">Benefits of Digital Marketing</a></li>');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(11) NOT NULL,
  `rate_user` int(11) DEFAULT NULL,
  `rate_faculty` int(11) DEFAULT NULL,
  `rate_subject` int(11) NOT NULL,
  `rate_feedback` varchar(222) NOT NULL,
  `rate_chapter` int(2) DEFAULT NULL,
  `rate_part` enum('chapter','slide','book','quiz','note','videos','kvideos','articles','cases') DEFAULT NULL,
  `rate_rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `rate_user`, `rate_faculty`, `rate_subject`, `rate_feedback`, `rate_chapter`, `rate_part`, `rate_rating`) VALUES
(107, 1, 1, 1, 'Slides are so Complete!!', 1, 'slide', 5),
(108, 1, 1, 1, 'Notes are not complete!', 1, 'note', 4),
(109, 1, 1, 1, 'Great book', 1, 'book', 4),
(110, 1, 1, 1, 'Good Videos', 1, 'videos', 5),
(111, 1, 1, 1, 'Questions are perfect', 1, 'quiz', 5);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_chapter_id` int(11) DEFAULT NULL,
  `slide_iframe_code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_chapter_id`, `slide_iframe_code`) VALUES
(1, 1, ' <iframe src=\"https://onedrive.live.com/embed?cid=6CA9CBA9ED34202B&amp;resid=6CA9CBA9ED34202B%21793&amp;authkey=ADHcnJSXZe8V51E&amp;em=2&amp;wdAr=1.7777777777777777\" width=\"100%\" height=\"565px\" frameborder=\"0\">This is an embedded <a target=\"_blank\" href=\"https://office.com\">Microsoft Office</a> presentation, powered by <a target=\"_blank\" href=\"https://office.com/webapps\">Office</a>.</iframe>\r\n             ');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(222) DEFAULT NULL,
  `sub_fac` int(11) DEFAULT NULL,
  `sub_detail` text NOT NULL,
  `sub_prof_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `sub_name`, `sub_fac`, `sub_detail`, `sub_prof_detail`) VALUES
(1, 'Digital Marketing', 1, 'Throughout this course, you will be familiar with different principles and concepts of digital marketing and techniques that are used in modern digital marketing world.', 'Mr. Abdul Khaliq Shinwari <br>Specialized in MS Marketing<br> Email: a.khaliq@kardan.edu.af<br> Contact No: 0702729343'),
(2, 'Principles of Marketing', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Student_id` int(15) NOT NULL,
  `Faculty` enum('BBA','BCS','BCE') NOT NULL,
  `Semester` int(1) NOT NULL,
  `Email_address` varchar(200) NOT NULL,
  `Date_of_birth` date NOT NULL,
  `Gender` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `Student_id`, `Faculty`, `Semester`, `Email_address`, `Date_of_birth`, `Gender`) VALUES
(1, 'Haneef', 'admin', 2011809060, 'BBA', 3, 'hanif.sayeedi@gmail.com', '2020-01-10', 'male'),
(6, 'Saeed', 'admin', 20015151, 'BBA', 2, 'king@google.com', '2020-01-15', 'male'),
(7, 'Karim', 'admin', 200151511, 'BBA', 7, 'karim@oo.com', '2020-01-15', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `user_readings`
--

CREATE TABLE `user_readings` (
  `ur_id` int(11) NOT NULL,
  `ur_user_id` int(2) DEFAULT NULL,
  `ur_reading_faculty` int(10) NOT NULL,
  `ur_reading_subject` int(11) NOT NULL,
  `ur_reading_chapter` int(2) NOT NULL,
  `ur_user_read` enum('chapter','slide','book','quiz','note','videos','kvideos','articles','cases') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_readings`
--

INSERT INTO `user_readings` (`ur_id`, `ur_user_id`, `ur_reading_faculty`, `ur_reading_subject`, `ur_reading_chapter`, `ur_user_read`) VALUES
(159, 1, 1, 1, 1, 'cases'),
(160, 1, 1, 1, 1, 'articles'),
(161, 1, 1, 1, 1, 'slide'),
(162, 1, 1, 1, 1, 'note'),
(163, 1, 1, 1, 1, 'book'),
(164, 1, 1, 1, 1, 'kvideos'),
(165, 1, 1, 1, 1, 'videos'),
(166, 1, 1, 1, 1, 'quiz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`ch_id`);

--
-- Indexes for table `completed_course`
--
ALTER TABLE `completed_course`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD KEY `ans_question_id` (`ans_question_id`),
  ADD KEY `ans_answer_id` (`ans_answer_id`);

--
-- Indexes for table `exam_history`
--
ALTER TABLE `exam_history`
  ADD PRIMARY KEY (`his_id`);

--
-- Indexes for table `exam_options`
--
ALTER TABLE `exam_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`quest_id`);

--
-- Indexes for table `exam_rank`
--
ALTER TABLE `exam_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `note_ch_id` (`note_ch_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`),
  ADD KEY `slide_chapter_id` (`slide_chapter_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `sub_fac` (`sub_fac`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Student_id` (`Student_id`);

--
-- Indexes for table `user_readings`
--
ALTER TABLE `user_readings`
  ADD PRIMARY KEY (`ur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `completed_course`
--
ALTER TABLE `completed_course`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_history`
--
ALTER TABLE `exam_history`
  MODIFY `his_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `exam_options`
--
ALTER TABLE `exam_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_rank`
--
ALTER TABLE `exam_rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_readings`
--
ALTER TABLE `user_readings`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD CONSTRAINT `exam_answers_ibfk_1` FOREIGN KEY (`ans_question_id`) REFERENCES `exam_questions` (`quest_id`),
  ADD CONSTRAINT `exam_answers_ibfk_2` FOREIGN KEY (`ans_answer_id`) REFERENCES `exam_options` (`option_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`note_ch_id`) REFERENCES `chapter` (`ch_id`);

--
-- Constraints for table `slides`
--
ALTER TABLE `slides`
  ADD CONSTRAINT `slides_ibfk_1` FOREIGN KEY (`slide_chapter_id`) REFERENCES `chapter` (`ch_id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`sub_fac`) REFERENCES `faculty` (`fac_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

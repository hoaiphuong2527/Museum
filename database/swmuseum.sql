
CREATE DATABASE swmuseum CHARACTER SET UTF8;
USE swmuseum;

--
-- Database: `swmuseum`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_category`
--

DROP TABLE IF EXISTS `m_category`;
CREATE TABLE `m_category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT NULL,
  -- `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name, des',
  `status` tinyint(1) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_flag` int(1) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_category`
--

INSERT INTO `m_category` (`category_id`, `parent_id`, `sort_order`,`status`, `image`, `image_description`, `video`, `deleted_flag`, `created_user`, `created_time`, `updated_user`, `updated_time`) VALUES
(1, 0, 1,1, 'a', 'a', 'a', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44'),
(2, 0, 2,1, 'a', 'a', 'a', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44'),
(3, 0, 3,1, 'a', 'a', 'a', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44'),
(4, 1, 1,1, 'a', 'a', 'a', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44'),
(5, 4, 2,1, 'a', 'a', 'a', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44');
-- --------------------------------------------------------

--
-- Table structure for table `m_cate_translation`
--

DROP TABLE IF EXISTS `m_cate_translation`;
CREATE TABLE `m_cate_translation` (
  `story_tran_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `locale` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '1: Vi 2: En 3:Jp',
  `deleted_flag` int(1) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_cate_translation`
--

INSERT INTO `m_cate_translation` (`story_tran_id`, `category_id`, `name`, `description`, `locale`, `deleted_flag`, `created_user`, `created_time`, `updated_user`, `updated_time`) VALUES
(1, 1, 'Tầng 1', 'mô tả 1', 'vi', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(2, 1, 'Floor 1', 'description 1', 'en', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(3, 1, 'Floor 1', 'description 1', 'jp', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(4, 2, 'Tầng 2', 'mô tả 2', 'vi', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(5, 2, 'Floor 2', 'description 2', 'en', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(6, 2, 'Floor 2', 'description 2', 'jp', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(7, 3, 'Tầng 3', 'mô tả 3', 'vi', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(8, 3, 'Floor 3', 'description 3', 'en', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(9, 3, 'Floor 3', 'description 3', 'jp', 0, 1, '2017-09-09 01:13:34', 1, '2017-09-09 01:13:34'),
(10, 4, 'Phòng 1', 'mô tả 1', 'vi', 0, NULL, '2017-09-09 03:40:31', NULL, '2017-09-09 03:40:31'),
(11, 4, 'Room 1', 'description 1', 'en', 0, NULL, '2017-09-09 03:40:31', NULL, '2017-09-09 03:40:31'),
(12, 4, 'Room 1', 'description 1', 'jp', 0, NULL, '2017-09-09 03:40:31', NULL, '2017-09-09 03:40:31'),
(13, 5, 'câu chuyện 1', 'description 1', 'vn', 0, NULL, '2017-09-09 03:40:31', NULL, '2017-09-09 03:40:31'),
(14, 5, 'story 1', 'description 1', 'en', 0, NULL, '2017-09-09 03:40:31', NULL, '2017-09-09 03:40:31'),
(15, 5, 'câu chuyện 1',  'description 1', 'jp', 0, NULL, '2017-09-09 03:40:31', NULL, '2017-09-09 03:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `m_code`
--

DROP TABLE IF EXISTS `m_code`;
CREATE TABLE `m_code` (
  `code_id` int(11) NOT NULL,
  `code_value` varchar(255) CHARACTER SET utf8 NOT NULL,
  `activated`  datetime ,
  `expried` datetime ,
  `deleted_flag` int(1) DEFAULT NULL COMMENT '0 chưa sử dụng, 1: đã sử dụng',
  `created_user` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
--
-- Table structure for table `m_content`
--



DROP TABLE IF EXISTS `m_item_story`;
CREATE TABLE `m_item_story` (
  `item_story_id` int(11) NOT NULL,
  `category_id` int(11),
  `code` int(11) DEFAULT NULL,
  `url_image` text CHARACTER SET utf8,
  `sound` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  -- `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name, des',
  `status` tinyint(1) DEFAULT NULL,
  `deleted_flag` int(1) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  CONSTRAINT UC_m_item_story_code UNIQUE(code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_item_story_translation`
--

DROP TABLE IF EXISTS `m_item_story_translation`;
CREATE TABLE `m_item_story_translation` (
  `item_story_tran_id` int(11) NOT NULL,
  `item_story_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '1: Vi 2: En 3:Jp',
  `deleted_flag` int(1) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone_num` varchar(50) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `avata` varchar(255) CHARACTER SET utf8,
  `user_role` int(1) DEFAULT '2' COMMENT '1: super admin 2: admin',
  `remember_token` varchar(255),
  `deleted_flag` int(1) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- Indexes for dumped tables
--
CREATE TABLE `m_settings` (
  `setting_id` int(11) NOT NULL COMMENT 'setting_id',
  `s_key` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT 's_key  Setting key',
  `s_value` int(11) NOT NULL COMMENT 's_value  Setting value',
  `s_name` varchar(255) DEFAULT NULL COMMENT 's_name  Setting name',
  `deleted_flag` int(1) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL COMMENT 'created_user',
  `created_time` datetime DEFAULT NULL COMMENT 'created_time',
  `updated_user` int(11) DEFAULT NULL COMMENT 'updated_user',
  `udpated_time` datetime DEFAULT NULL COMMENT 'updated_time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Indexes for table `m_category`
INSERT INTO `m_settings` (`setting_id`, `s_key`, `s_value`, `s_name`, `deleted_flag`, `created_user`, `created_time`, `updated_user`, `udpated_time`) VALUES
(1, 'USED_FLAG', 0, 'Chưa sử dụng', 0, 9999, '2017-07-11 00:00:00', NULL, NULL),
(2, 'USED_FLAG', 1, 'Đã sử dụng', 0, 9999, '2017-07-11 00:00:00', NULL, NULL),
(3, 'USER_ROLE', 0, 'Super Admin', 0, 9999, '2017-07-11 00:00:00', NULL, NULL),
(4, 'USER_ROLE', 1, 'Admin', 0, 9999, '2017-07-11 00:00:00', NULL, NULL),
(5, 'STATUS', 0 , 'Không công khai',0,9999,'2017-07-11 00:00:00', NULL, NULL),
(6, 'STATUS', 1 , 'Công khai', 0, 9999 ,'2017-07-11 00:00:00', NULL, NULL);
--

ALTER TABLE `m_settings`
  ADD PRIMARY KEY (`setting_id`);

ALTER TABLE `m_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `m_cate_translation`
--
ALTER TABLE `m_cate_translation`
  ADD PRIMARY KEY (`story_tran_id`),
  ADD KEY `fr_m_cate_translation` (`category_id`);

--
-- Indexes for table `m_code`
--
ALTER TABLE `m_code`
  ADD PRIMARY KEY (`code_id`);

--

--
-- Indexes for table `m_item_story`
--
ALTER TABLE `m_item_story`
  ADD PRIMARY KEY (`item_story_id`),
  ADD KEY `fr_m_story_m_category` (`category_id`);

--
-- Indexes for table `m_item_story_translation`
--
ALTER TABLE `m_item_story_translation`
  ADD PRIMARY KEY (`item_story_tran_id`),
  ADD KEY `fr_m_story_translation` (`item_story_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UC_Users_Email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_category`
--
ALTER TABLE `m_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `m_cate_translation`
--
ALTER TABLE `m_cate_translation`
  MODIFY `story_tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `m_code`
--
ALTER TABLE `m_code`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT;
--

-- AUTO_INCREMENT for table `m_item_story`
--
ALTER TABLE `m_item_story`
  MODIFY `item_story_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_item_story_translation`
--
ALTER TABLE `m_item_story_translation`
  MODIFY `item_story_tran_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_cate_translation`
--
ALTER TABLE `m_cate_translation`
  ADD CONSTRAINT `fr_m_cate_translation` FOREIGN KEY (`category_id`) REFERENCES `m_category` (`category_id`);

--

--
-- Constraints for table `m_item_story`
--
ALTER TABLE `m_item_story`
  ADD CONSTRAINT `fr_m_item_story` FOREIGN KEY (`category_id`) REFERENCES `m_category` (`category_id`);

--
-- Constraints for table `m_item_story_translation`
--
ALTER TABLE `m_item_story_translation`
  ADD CONSTRAINT `fr_m_item_story_translation` FOREIGN KEY (`item_story_id`) REFERENCES `m_item_story` (`item_story_id`);


INSERT INTO `m_item_story` (`item_story_id`, `category_id`, `code`, `url_image`, `sound`, `status`, `deleted_flag`, `created_user`, `created_time`, `updated_user`, `updated_time`) VALUES
(NULL, 5, 111, '1.02_40_14.jpg', 'a', 1,0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44');
INSERT INTO `m_item_story_translation` (`item_story_tran_id`, `item_story_id`, `title`, `description`, `locale`, `deleted_flag`, `created_user`, `created_time`, `updated_user`, `updated_time`) VALUES
(NULL, 1, 'bối cảnh 1', 'a', 'en', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44'),
(NULL, 1, 'bối cảnh 1', 'a', 'vi', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44'),
(NULL, 1, 'bối cảnh 1', 'a', 'jp', 0, 1, '2017-09-09 01:06:44', 1, '2017-09-09 01:06:44');


INSERT INTO `m_user`(`user_id`,`email`,`phone_num`,`name`,`password`,`avata`,`user_role`,`remember_token`,`deleted_flag`,`created_user`,`created_time`,`updated_user`,`updated_time`)
 VALUES(NULL,'hoaiphuong2527@gmail.com','01682216954','Jenny','$2y$10$Z.GIlqNTKsIdsyWYsVdtu.RLRE82Y9aqS39Z2rYviXEik8AQbgk9a','nulla',0,'aaa',0,1,'2017-07-11 00:00:00',1,'2017-07-11 00:00:00');
--

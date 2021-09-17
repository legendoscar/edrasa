<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_300 extends CI_Migration
{
	public function __construct()
	{
		parent::__construct();
	}

	public function up()
	{
		$this->db->query("ALTER TABLE `staff` ADD `experience_details` varchar(255) DEFAULT NULL AFTER `qualification`;");
		$this->db->query("ALTER TABLE `staff` ADD `total_experience` varchar(255) DEFAULT NULL AFTER `experience_details`;");
		$this->db->query("ALTER TABLE `global_settings` ADD `cms_default_branch` int(11) NOT NULL DEFAULT '1' AFTER `cron_secret_key`;");

		$this->db->query("ALTER TABLE `branch` ADD `stu_generate` tinyint(3) DEFAULT '0' AFTER `address`;");
		$this->db->query("ALTER TABLE `branch` ADD `stu_username_prefix` varchar(255) NOT NULL AFTER `stu_generate`;");
		$this->db->query("ALTER TABLE `branch` ADD `stu_default_password` varchar(255) NOT NULL AFTER `stu_username_prefix`;");
		$this->db->query("ALTER TABLE `branch` ADD `grd_generate` tinyint(3) DEFAULT '0' AFTER `stu_default_password`;");
		$this->db->query("ALTER TABLE `branch` ADD `grd_username_prefix` varchar(255) NOT NULL AFTER `grd_generate`;");
		$this->db->query("ALTER TABLE `branch` ADD `grd_default_password` varchar(255) NOT NULL AFTER `grd_username_prefix`;");

		$this->db->query("ALTER TABLE `event` ADD `image` varchar(255) NOT NULL DEFAULT 'defualt.png' AFTER `end_date`;");
		$this->db->query("ALTER TABLE `event` ADD `show_web` tinyint(3) NOT NULL DEFAULT '1' AFTER `image`;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `certificates_templete` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(255) NOT NULL,
					  `user_type` tinyint(1) NOT NULL,
					  `background` varchar(355) DEFAULT NULL,
					  `logo` varchar(355) DEFAULT NULL,
					  `signature` varchar(255) NOT NULL,
					  `content` text NOT NULL,
					  `page_layout` tinyint(1) NOT NULL,
					  `photo_style` tinyint(1) NOT NULL,
					  `photo_size` varchar(25) NOT NULL,
					  `top_space` varchar(25) NOT NULL,
					  `bottom_space` varchar(25) NOT NULL,
					  `right_space` varchar(25) NOT NULL,
					  `left_space` varchar(25) NOT NULL,
					  `qr_code` varchar(25) NOT NULL,
					  `branch_id` int(11) NOT NULL,
					  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `card_templete` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `card_type` tinyint(1) NOT NULL DEFAULT '0',
					  `name` varchar(255) NOT NULL,
					  `user_type` tinyint(1) NOT NULL,
					  `background` varchar(355) DEFAULT NULL,
					  `logo` varchar(355) DEFAULT NULL,
					  `signature` varchar(255) DEFAULT NULL,
					  `content` text NOT NULL,
					  `layout_width` varchar(11) NOT NULL DEFAULT '54',
					  `layout_height` varchar(11) NOT NULL DEFAULT '86',
					  `photo_style` tinyint(1) NOT NULL,
					  `photo_size` varchar(25) NOT NULL,
					  `top_space` varchar(25) NOT NULL,
					  `bottom_space` varchar(25) NOT NULL,
					  `right_space` varchar(25) NOT NULL,
					  `left_space` varchar(25) NOT NULL,
					  `qr_code` varchar(25) NOT NULL,
					  `branch_id` int(11) NOT NULL,
					  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `online_admission` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `first_name` varchar(255) NOT NULL,
					  `last_name` varchar(255) NOT NULL,
					  `gender` varchar(25) NOT NULL,
					  `birthday` date NOT NULL,
					  `mobile_no` varchar(50) NOT NULL,
					  `email` varchar(255) NOT NULL,
					  `address` varchar(255) NOT NULL,
					  `guardian_name` varchar(255) NOT NULL,
					  `guardian_relation` varchar(50) NOT NULL,
					  `father_name` varchar(255) NOT NULL,
					  `mother_name` varchar(255) NOT NULL,
					  `grd_occupation` varchar(255) NOT NULL,
					  `grd_income` varchar(25) NOT NULL,
					  `grd_education` varchar(255) NOT NULL,
					  `grd_email` varchar(255) NOT NULL,
					  `grd_mobile_no` varchar(50) NOT NULL,
					  `grd_address` varchar(255) NOT NULL,
					  `status` tinyint(3) NOT NULL DEFAULT '1',
					  `branch_id` int(11) NOT NULL,
					  `class_id` int(11) NOT NULL,
					  `section_id` int(11) NOT NULL,
					  `apply_date` datetime NOT NULL,
					  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("CREATE TABLE IF NOT EXISTS front_cms_about (
					  id int(11) NOT NULL AUTO_INCREMENT,
					  title varchar(255) DEFAULT NULL,
					  subtitle varchar(255) DEFAULT NULL,
					  page_title varchar(255) NOT NULL,
					  content text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
					  banner_image varchar(255) DEFAULT NULL,
					  about_image varchar(255) NOT NULL,
					  elements mediumtext NOT NULL,
					  meta_description text NOT NULL,
					  meta_keyword text NOT NULL,
					  branch_id int(11) NOT NULL,
					  PRIMARY KEY (id)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO front_cms_about (id, title, subtitle, page_title, content, banner_image, about_image, elements, meta_description, meta_keyword, branch_id) VALUES
					(1, 'Welcome to School', 'Best Education Mangment Systems', 'About Us', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut volutpat rutrum eros amet sollicitudin interdum. Suspendisse pulvinar, velit nec pharetra interdum, ante tellus ornare mi, et mollis tellus neque vitae elit. Mauris adipiscing mauris fringilla turpis interdum sed pulvinar nisi malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n                        </p>\r\n                        <p>\r\n                            Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula. Mauris sit amet neque nec nunc gravida. \r\n                        </p>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-sm-6 col-12\">\r\n                                <ul class=\"list-unstyled list-style-3\">\r\n                                    <li><a href=\"#\">Cardiothoracic Surgery</a></li>\r\n                                    <li><a href=\"#\">Cardiovascular Diseases</a></li>\r\n                                    <li><a href=\"#\">Ophthalmology</a></li>\r\n                                    <li><a href=\"#\">Dermitology</a></li>\r\n                                </ul>\r\n                            </div>\r\n                            <div class=\"col-sm-6 col-12\">\r\n                                <ul class=\"list-unstyled list-style-3\">\r\n                                    <li><a href=\"#\">Cardiothoracic Surgery</a></li>\r\n                                    <li><a href=\"#\">Cardiovascular Diseases</a></li>\r\n                                    <li><a href=\"#\">Ophthalmology</a></li>\r\n                                </ul>\r\n                            </div>\r\n                        </div>', 'about1.jpg', 'about1.png', '{\"cta_title\":\"Get in touch to join our community\",\"button_text\":\"Contact Our Office\",\"button_url\":\"contact\"}', '', '', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_contact` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `box_title` varchar(255) DEFAULT NULL,
				  `box_description` varchar(500) DEFAULT NULL,
				  `box_image` varchar(255) DEFAULT NULL,
				  `form_title` varchar(355) DEFAULT NULL,
				  `address` varchar(355) DEFAULT NULL,
				  `phone` varchar(355) DEFAULT NULL,
				  `email` varchar(355) DEFAULT NULL,
				  `submit_text` varchar(355) NOT NULL,
				  `map_iframe` text,
				  `page_title` varchar(255) NOT NULL,
				  `banner_image` varchar(255) DEFAULT NULL,
				  `meta_description` text NOT NULL,
				  `meta_keyword` text NOT NULL,
				  `branch_id` int(11) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_contact` (`id`, `box_title`, `box_description`, `box_image`, `form_title`, `address`, `phone`, `email`, `submit_text`, `map_iframe`, `page_title`, `banner_image`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
				(1, 'WE\'D LOVE TO HEAR FROM YOU', 'Fusce convallis diam vitae velit tempus rutrum. Donec nisl nisl, vulputate eu sapien sed, adipiscing vehicula massa. Mauris eget commodo neque, id molestie enim.', 'contact-info-box1.png', 'Get in touch by filling the form below', '4896  Romrog Way, LOS ANGELES,\r\nCalifornia', '123-456-7890, \r\n123-456-7890', 'info@example.com\r\nsupport@example.com', 'Send', NULL, 'Contact Us', 'contact1.jpg', '', '', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_events` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) NOT NULL,
			  `description` text NOT NULL,
			  `page_title` varchar(255) DEFAULT NULL,
			  `banner_image` varchar(255) DEFAULT NULL,
			  `meta_description` text NOT NULL,
			  `meta_keyword` text NOT NULL,
			  `branch_id` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_events` (`id`, `title`, `description`, `page_title`, `banner_image`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
				(1, 'Upcoming Events', '<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p><p>Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.</p>', 'Events', 'events1.jpg', 'Losin - School Management System With CMS', 'Losin Events Page', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_faq` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `title` varchar(255) DEFAULT NULL,
					  `description` text,
					  `page_title` varchar(255) DEFAULT NULL,
					  `banner_image` varchar(255) DEFAULT NULL,
					  `meta_description` text NOT NULL,
					  `meta_keyword` text NOT NULL,
					  `branch_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_faq` (`id`, `title`, `description`, `page_title`, `banner_image`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
					(1, 'Frequently Asked Questions', '<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>\r\n\r\n<p>Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven&#39;t heard of them accusamus labore sustainable VHS.</p>', 'Faq', 'faq1.jpg', '', '', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_faq_list` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `title` varchar(255) DEFAULT NULL,
					  `description` text,
					  `branch_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_faq_list` (`id`, `title`, `description`, `branch_id`) VALUES
					(1, 'Any Information you provide on applications for disability, life or accidental insurance ?', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco quat. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\r\n</p>\r\n<ul>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>\r\n<li>Sed do eiusmod tempor incididunt ut labore et dolore magna aliq.</li>\r\n<li>Ut enim ad minim veniam, quis nostrud exercitation ullamco quat. It is a long established fact.</li>\r\n<li>That a reader will be distracted by the readable content of a page when looking at its layout.</li>\r\n<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>\r\n<li>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</li>\r\n<li>Quis nostrud exercitation ullamco quat. It is a long established fact that a reader will be distracted.</li>\r\n<li>Readable content of a page when looking at its layout.</li>\r\n<li>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</li>\r\n<li>Opposed to using \'Content here, content here\', making it look like readable English.</li>\r\n</ul>', 1),
					(2, 'Readable content of a page when looking at its layout ?', '<p>\r\n                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.\r\n                            </p>\r\n                            <ol>\r\n                                <li>Quis nostrud exercitation ullamco quat. It is a long established fact that a reader will be distracted.</li>\r\n                                <li>Readable content of a page when looking at its layout.</li>\r\n                                <li>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</li>\r\n                                <li>Opposed to using \'Content here, content here\', making it look like readable English.</li>\r\n                            </ol>\r\n                            <p>\r\n                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.\r\n                            </p>', 1),
					(3, 'Opposed to using \'Content here, content here\', making it look like readable English ?', '<p>\r\n                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.\r\n                            </p>\r\n                            <ol>\r\n                                <li>Quis nostrud exercitation ullamco quat. It is a long established fact that a reader will be distracted.</li>\r\n                                <li>Readable content of a page when looking at its layout.</li>\r\n                                <li>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</li>\r\n                                <li>Opposed to using \'Content here, content here\', making it look like readable English.</li>\r\n                            </ol>\r\n                            <p>\r\n                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.\r\n                            </p>', 1),
					(4, 'Readable content of a page when looking at its layout ?', '<p>\r\n                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.\r\n                            </p>\r\n                            <ol>\r\n                                <li>Quis nostrud exercitation ullamco quat. It is a long established fact that a reader will be distracted.</li>\r\n                                <li>Readable content of a page when looking at its layout.</li>\r\n                                <li>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</li>\r\n                                <li>Opposed to using \'Content here, content here\', making it look like readable English.</li>\r\n                            </ol>\r\n                            <p>\r\n                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.\r\n                            </p>', 1),
					(5, 'What types of documents are required to travel?', '<p><strong>Lorem ipsum</strong> dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, at usu eius eligendi singulis. Sea ocurreret principes ne. At nonumy aperiri pri, nam quodsi copiosae intellegebat et, ex deserunt euripidis usu. Per ad ullum lobortis. Duo volutpat imperdiet ut, postea salutatus imperdiet ut per, ad utinam debitis invenire has.</p>\r\n\r\n<ol>\r\n	<li>labores explicari qui</li>\r\n	<li>labores explicari qui</li>\r\n	<li>labores explicari quilabores explicari qui</li>\r\n	<li>labores explicari qui</li>\r\n</ol>', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_home` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `title` varchar(255) DEFAULT NULL,
				  `subtitle` varchar(255) DEFAULT NULL,
				  `item_type` varchar(20) NOT NULL,
				  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				  `elements` mediumtext NOT NULL,
				  `branch_id` int(11) NOT NULL,
				  `active` tinyint(3) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_home` (`id`, `title`, `subtitle`, `item_type`, `description`, `elements`, `branch_id`, `active`) VALUES
				(1, 'Welcome To Education', 'We will give you future', 'wellcome', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using content.\r\n\r\nMaking it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '{\"image\":\"wellcome1.png\"}', 1, 0),
				(2, 'Experience Teachers Team', NULL, 'teachers', 'Making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident.', '{\"teacher_start\":\"0\",\"image\":\"featured-parallax1.jpg\"}', 1, 0),
				(3, 'WHY CHOOSE US', NULL, 'services', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '', 1, 0),
				(4, 'Request for a free Education Class', NULL, 'cta', '', '{\"mobile_no\":\"+1-12345678\",\"button_text\":\"Request Now\",\"button_url\":\"#\"}', 1, 0),
				(5, 'Wellcome To <span>Losin</span>', NULL, 'slider', 'Lorem Ipsum is simply dummy text printer took a galley of type and scrambled it to make a type specimen book.', '{\"position\":\"c-left\",\"button_text1\":\"View Services\",\"button_url1\":\"#\",\"button_text2\":\"Learn More\",\"button_url2\":\"#\",\"image\":\"home-slider-1592582779.jpg\"}', 1, 0),
				(6, 'Online  <span>Live Class</span> Facility', NULL, 'slider', 'Lorem Ipsum is simply dummy text printer took a galley of type and scrambled it to make a type specimen book.', '{\"position\":\"c-left\",\"button_text1\":\"Read More\",\"button_url1\":\"#\",\"button_text2\":\"Get Started\",\"button_url2\":\"#\",\"image\":\"home-slider-1592582805.jpg\"}', 1, 0),
				(8, 'Online Classes', NULL, 'features', 'Nulla metus metus ullamcorper vel tincidunt sed euismod nibh Quisque volutpat condimentum velit class aptent taciti sociosqu.', '{\"button_text\":\"Read More\",\"button_url\":\"#\",\"icon\":\"fas fa-video\"}', 1, 0),
				(9, 'Scholarship', NULL, 'features', 'Nulla metus metus ullamcorper vel tincidunt sed euismod nibh Quisque volutpat condimentum velit class aptent taciti sociosqu.', '{\"button_text\":\"Read More\",\"button_url\":\"#\",\"icon\":\"fas fa-graduation-cap\"}', 1, 0),
				(10, 'Books & Liberary', NULL, 'features', 'Nulla metus metus ullamcorper vel tincidunt sed euismod nibh Quisque volutpat condimentum velit class aptent taciti sociosqu.', '{\"button_text\":\"Read More\",\"button_url\":\"#\",\"icon\":\"fas fa-book-reader\"}', 1, 0),
				(11, 'Trending Courses', NULL, 'features', 'Nulla metus metus ullamcorper vel tincidunt sed euismod nibh Quisque volutpat condimentum velit class aptent taciti sociosqu.', '{\"button_text\":\"Read More\",\"button_url\":\"#\",\"icon\":\"fab fa-discourse\"}', 1, 0),
				(12, 'WHAT PEOPLE SAYS', NULL, 'testimonial', 'Fusce sem dolor, interdum in efficitur at, faucibus nec lorem. Sed nec molestie justo.', '', 1, 0);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_home_seo` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `page_title` varchar(255) NOT NULL,
						  `meta_keyword` text NOT NULL,
						  `meta_description` text NOT NULL,
						  `branch_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_home_seo` (`id`, `page_title`, `meta_keyword`, `meta_description`, `branch_id`) VALUES
					(1, 'Home', 'Losin  Home Page', 'Losin - School Management System With CMS', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_menu` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `title` varchar(100) NOT NULL,
				  `alias` varchar(100) NOT NULL,
				  `ordering` int(11) NOT NULL,
				  `parent_id` int(11) DEFAULT '0',
				  `open_new_tab` int(11) NOT NULL DEFAULT '0',
				  `ext_url` tinyint(3) NOT NULL DEFAULT '0',
				  `ext_url_address` text,
				  `publish` tinyint(3) NOT NULL,
				  `system` tinyint(3) NOT NULL,
				  `branch_id` int(11) NOT NULL,
				  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_menu` (`id`, `title`, `alias`, `ordering`, `parent_id`, `open_new_tab`, `ext_url`, `ext_url_address`, `publish`, `system`, `branch_id`, `created_at`) VALUES
			(1, 'Home', 'index', 1, 0, 0, 0, '', 1, 1, 0, '2019-08-09 12:18:54'),
			(2, 'Events', 'events', 3, 0, 0, 0, '', 1, 1, 0, '2019-08-09 12:18:54'),
			(3, 'Teachers', 'teachers', 2, 0, 0, 0, '', 1, 1, 0, '2019-08-09 12:18:54'),
			(4, 'About Us', 'about', 4, 0, 0, 0, '', 1, 1, 0, '2019-08-09 12:18:54'),
			(5, 'FAQ', 'faq', 5, 0, 0, 0, '', 1, 1, 0, '2019-08-09 12:18:54'),
			(6, 'Online Admission', 'admission', 6, 0, 0, 0, '', 1, 1, 0, '2019-08-09 12:18:54'),
			(7, 'Contact Us', 'contact', 7, 0, 0, 0, '', 1, 1, 0, '2019-08-09 12:18:54');");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_pages` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `page_title` varchar(255) NOT NULL,
					  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
					  `menu_id` int(11) NOT NULL,
					  `banner_image` varchar(255) DEFAULT NULL,
					  `meta_description` text NOT NULL,
					  `meta_keyword` text NOT NULL,
					  `branch_id` int(11) NOT NULL,
					  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_services` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `title` varchar(255) DEFAULT NULL,
					  `subtitle` varchar(255) DEFAULT NULL,
					  `parallax_image` varchar(255) DEFAULT NULL,
					  `branch_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;
					");
		$this->db->query("INSERT INTO `front_cms_services` (`id`, `title`, `subtitle`, `parallax_image`, `branch_id`) VALUES
				(1, 'Get Well Soon', 'Our Best <span>Services</span>', 'service_parallax1.jpg', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_services_list` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `title` varchar(255) DEFAULT NULL,
					  `description` text,
					  `icon` varchar(255) DEFAULT NULL,
					  `branch_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_services_list` (`id`, `title`, `description`, `icon`, `branch_id`) VALUES
				(1, 'Online Course Facilities', 'Making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.', 'fas fa-headphones', 1),
				(2, 'Modern Book Library', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover.', 'fas fa-book-open', 1),
				(3, 'Be Industrial Leader', 'Making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model.', 'fas fa-industry', 1),
				(4, 'Programming Courses', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will.', 'fas fa-code', 1),
				(5, 'Foreign Languages', 'Making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover.', 'fas fa-language', 1),
				(6, 'Alumni Directory', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a for \'lorem ipsum\' will uncover.', 'fas fa-user-graduate', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_setting` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `application_title` varchar(255) NOT NULL,
					  `url_alias` varchar(255) DEFAULT NULL,
					  `cms_active` tinyint(4) NOT NULL DEFAULT '0',
					  `online_admission` tinyint(4) NOT NULL DEFAULT '0',
					  `theme` varchar(255) NOT NULL,
					  `captcha_status` varchar(20) NOT NULL,
					  `recaptcha_site_key` varchar(255) NOT NULL,
					  `recaptcha_secret_key` varchar(255) NOT NULL,
					  `address` varchar(350) NOT NULL,
					  `mobile_no` varchar(60) NOT NULL,
					  `fax` varchar(60) NOT NULL,
					  `receive_contact_email` varchar(255) NOT NULL,
					  `email` varchar(60) NOT NULL,
					  `copyright_text` varchar(255) NOT NULL,
					  `fav_icon` varchar(255) NOT NULL,
					  `logo` varchar(255) NOT NULL,
					  `footer_about_text` varchar(300) NOT NULL,
					  `working_hours` varchar(300) NOT NULL,
					  `facebook_url` varchar(100) NOT NULL,
					  `twitter_url` varchar(100) NOT NULL,
					  `youtube_url` varchar(100) NOT NULL,
					  `google_plus` varchar(100) NOT NULL,
					  `linkedin_url` varchar(100) NOT NULL,
					  `pinterest_url` varchar(100) NOT NULL,
					  `instagram_url` varchar(100) NOT NULL,
					  `branch_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_setting` (`id`, `application_title`, `url_alias`, `cms_active`, `online_admission`, `theme`, `captcha_status`, `recaptcha_site_key`, `recaptcha_secret_key`, `address`, `mobile_no`, `fax`, `receive_contact_email`, `email`, `copyright_text`, `fav_icon`, `logo`, `footer_about_text`, `working_hours`, `facebook_url`, `twitter_url`, `youtube_url`, `google_plus`, `linkedin_url`, `pinterest_url`, `instagram_url`, `branch_id`) VALUES
					(1, 'School Management System With CMS', 'example', 0, 1, 'red', 'disable', '', '', 'Your Address', '+12345678', '12345678', 'info@example.com', 'info@demo.com', 'Copyright © 2020 <span>Losin</span>. All Rights Reserved.', 'fav_icon1.png', 'logo1.png', 'If you are going to use a passage LorIsum, you anythirassing hidden in the middle of text. Lators on the Internet tend to.', '<span>Hours : </span>  Mon To Fri - 10AM - 04PM,  Sunday Closed', 'https://facebook.com', 'https://twitter.com', 'https://youtube.com', 'https://google.com', 'https://linkedin.com', 'https://pinterest.com', 'https://instagram.com', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_teachers` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `page_title` varchar(255) DEFAULT NULL,
					  `banner_image` varchar(255) DEFAULT NULL,
					  `meta_description` text NOT NULL,
					  `meta_keyword` text NOT NULL,
					  `branch_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_teachers` (`id`, `page_title`, `banner_image`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
				(1, 'Teachers', 'teachers1.jpg', 'Losin - School Management System With CMS', '', 1);");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_testimonial` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(255) NOT NULL,
					  `surname` varchar(355) NOT NULL,
					  `image` varchar(255) NOT NULL,
					  `description` text NOT NULL,
					  `rank` int(5) NOT NULL,
					  `branch_id` int(11) NOT NULL,
					  `created_by` int(11) NOT NULL,
					  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_testimonial` (`id`, `name`, `surname`, `image`, `description`, `rank`, `branch_id`, `created_by`, `created_at`) VALUES
				(1, 'Gartrell Wright', 'Los Angeles', 'user-1582830398.jpg', 'Intexure have done an excellent job presenting the analysis & insights. I am confident in saying  have helped encounter  is to be welcomed and every pain avoided”.', 1, 1, 1, '2019-08-23 12:26:42'),
				(2, 'Clifton Hyde', 'Newyork City', 'defualt.png', '“Owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted always holds”.', 4, 1, 1, '2019-08-23 12:26:42'),
				(3, 'Emily Lemus', 'Los Angeles', 'defualt.png', '“Intexure have done an excellent job presenting the analysis & insights. I am confident in saying  have helped encounter  is to be welcomed and every pain avoided”.', 5, 1, 1, '2019-08-23 12:26:42');");
		$this->db->truncate('permission');
		$this->db->query("INSERT INTO `permission` (`id`, `module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES
				(1, 2, 'Student', 'student', 1, 1, 1, 1, '2020-01-22 11:45:47'),
				(2, 2, 'Multiple Import', 'multiple_import', 0, 1, 0, 0, '2020-01-22 11:45:47'),
				(3, 2, 'Student Category', 'student_category', 1, 1, 1, 1, '2020-01-22 11:45:47'),
				(4, 2, 'Student Id Card', 'student_id_card', 1, 0, 0, 0, '2020-01-22 11:45:47'),
				(5, 2, 'Disable Authentication', 'student_disable_authentication', 1, 1, 0, 0, '2020-01-22 11:45:47'),
				(6, 4, 'Employee', 'employee', 1, 1, 1, 1, '2020-01-22 11:55:19'),
				(7, 3, 'Parent', 'parent', 1, 1, 1, 1, '2020-01-22 13:24:05'),
				(8, 3, 'Disable Authentication', 'parent_disable_authentication', 1, 1, 0, 0, '2020-01-22 14:22:21'),
				(9, 4, 'Department', 'department', 1, 1, 1, 1, '2020-01-22 17:41:39'),
				(10, 4, 'Designation', 'designation', 1, 1, 1, 1, '2020-01-22 17:41:39'),
				(11, 4, 'Disable Authentication', 'employee_disable_authentication', 1, 1, 0, 0, '2020-01-22 17:41:39'),
				(12, 5, 'Salary Template', 'salary_template', 1, 1, 1, 1, '2020-01-23 05:13:57'),
				(13, 5, 'Salary Assign', 'salary_assign', 1, 1, 0, 0, '2020-01-23 05:14:05'),
				(14, 5, 'Salary Payment', 'salary_payment', 1, 1, 0, 0, '2020-01-24 06:45:40'),
				(15, 5, 'Salary Summary Report', 'salary_summary_report', 1, 0, 0, 0, '2020-03-14 17:09:17'),
				(16, 5, 'Advance Salary', 'advance_salary', 1, 1, 1, 1, '2020-01-28 18:23:39'),
				(17, 5, 'Advance Salary Manage', 'advance_salary_manage', 1, 1, 1, 1, '2020-01-25 04:57:12'),
				(18, 5, 'Advance Salary Request', 'advance_salary_request', 1, 1, 0, 1, '2020-01-28 17:49:58'),
				(19, 5, 'Leave Category', 'leave_category', 1, 1, 1, 1, '2020-01-29 02:46:23'),
				(20, 5, 'Leave Request', 'leave_request', 1, 1, 1, 1, '2020-01-30 12:06:33'),
				(21, 5, 'Leave Manage', 'leave_manage', 1, 1, 1, 1, '2020-01-29 07:27:15'),
				(22, 5, 'Award', 'award', 1, 1, 1, 1, '2020-01-31 18:49:11'),
				(23, 6, 'Classes', 'classes', 1, 1, 1, 1, '2020-02-01 18:10:00'),
				(24, 6, 'Section', 'section', 1, 1, 1, 1, '2020-02-01 21:06:44'),
				(25, 6, 'Assign Class Teacher', 'assign_class_teacher', 1, 1, 1, 1, '2020-02-02 07:09:22'),
				(26, 6, 'Subject', 'subject', 1, 1, 1, 1, '2020-02-03 04:32:39'),
				(27, 6, 'Subject Class Assign ', 'subject_class_assign', 1, 1, 1, 1, '2020-02-03 17:43:19'),
				(28, 6, 'Subject Teacher Assign', 'subject_teacher_assign', 1, 1, 0, 1, '2020-02-03 19:05:11'),
				(29, 6, 'Class Timetable', 'class_timetable', 1, 1, 1, 1, '2020-02-04 05:50:37'),
				(30, 2, 'Student Promotion', 'student_promotion', 1, 1, 0, 0, '2020-02-05 18:20:30'),
				(31, 8, 'Attachments', 'attachments', 1, 1, 1, 1, '2020-02-06 17:59:43'),
				(32, 7, 'Homework', 'homework', 1, 1, 1, 1, '2020-02-07 05:40:08'),
				(33, 8, 'Attachment Type', 'attachment_type', 1, 1, 1, 1, '2020-02-07 07:16:28'),
				(34, 9, 'Exam', 'exam', 1, 1, 1, 1, '2020-02-07 09:59:29'),
				(35, 9, 'Exam Term', 'exam_term', 1, 1, 1, 1, '2020-02-07 12:09:28'),
				(36, 9, 'Exam Hall', 'exam_hall', 1, 1, 1, 1, '2020-02-07 14:31:04'),
				(37, 9, 'Exam Timetable', 'exam_timetable', 1, 1, 0, 1, '2020-02-08 17:04:31'),
				(38, 9, 'Exam Mark', 'exam_mark', 1, 1, 1, 1, '2020-02-10 12:53:41'),
				(39, 9, 'Exam Grade', 'exam_grade', 1, 1, 1, 1, '2020-02-10 17:29:16'),
				(40, 10, 'Hostel', 'hostel', 1, 1, 1, 1, '2020-02-11 04:41:36'),
				(41, 10, 'Hostel Category', 'hostel_category', 1, 1, 1, 1, '2020-02-11 07:52:31'),
				(42, 10, 'Hostel Room', 'hostel_room', 1, 1, 1, 1, '2020-02-11 11:50:09'),
				(43, 10, 'Hostel Allocation', 'hostel_allocation', 1, 0, 0, 1, '2020-02-11 13:06:15'),
				(44, 11, 'Transport Route', 'transport_route', 1, 1, 1, 1, '2020-02-12 05:26:19'),
				(45, 11, 'Transport Vehicle', 'transport_vehicle', 1, 1, 1, 1, '2020-02-12 05:57:30'),
				(46, 11, 'Transport Stoppage', 'transport_stoppage', 1, 1, 1, 1, '2020-02-12 06:49:20'),
				(47, 11, 'Transport Assign', 'transport_assign', 1, 1, 1, 1, '2020-02-12 09:55:21'),
				(48, 11, 'Transport Allocation', 'transport_allocation', 1, 0, 0, 1, '2020-02-12 19:33:05'),
				(49, 12, 'Student Attendance', 'student_attendance', 0, 1, 0, 0, '2020-02-13 05:25:53'),
				(50, 12, 'Employee Attendance', 'employee_attendance', 0, 1, 0, 0, '2020-02-13 10:04:16'),
				(51, 12, 'Exam Attendance', 'exam_attendance', 0, 1, 0, 0, '2020-02-13 11:08:14'),
				(52, 12, 'Student Attendance Report', 'student_attendance_report', 1, 0, 0, 0, '2020-02-13 19:20:56'),
				(53, 12, 'Employee Attendance Report', 'employee_attendance_report', 1, 0, 0, 0, '2020-02-14 06:08:53'),
				(54, 12, 'Exam Attendance Report', 'exam_attendance_report', 1, 0, 0, 0, '2020-02-14 06:21:40'),
				(55, 13, 'Book', 'book', 1, 1, 1, 1, '2020-02-14 06:40:42'),
				(56, 13, 'Book Category', 'book_category', 1, 1, 1, 1, '2020-02-15 04:11:41'),
				(57, 13, 'Book Manage', 'book_manage', 1, 1, 0, 1, '2020-02-15 11:13:24'),
				(58, 13, 'Book Request', 'book_request', 1, 1, 0, 1, '2020-02-17 06:45:19'),
				(59, 14, 'Event', 'event', 1, 1, 1, 1, '2020-02-17 18:02:15'),
				(60, 14, 'Event Type', 'event_type', 1, 1, 1, 1, '2020-02-18 04:40:33'),
				(61, 15, 'Sendsmsmail', 'sendsmsmail', 1, 1, 0, 1, '2020-02-22 07:19:57'),
				(62, 15, 'Sendsmsmail Template', 'sendsmsmail_template', 1, 1, 1, 1, '2020-02-22 10:14:57'),
				(63, 17, 'Account', 'account', 1, 1, 1, 1, '2020-02-25 09:34:43'),
				(64, 17, 'Deposit', 'deposit', 1, 1, 1, 1, '2020-02-25 12:56:11'),
				(65, 17, 'Expense', 'expense', 1, 1, 1, 1, '2020-02-26 06:35:57'),
				(66, 17, 'All Transactions', 'all_transactions', 1, 0, 0, 0, '2020-02-26 13:35:05'),
				(67, 17, 'Voucher Head', 'voucher_head', 1, 1, 1, 1, '2020-02-25 10:50:56'),
				(68, 17, 'Accounting Reports', 'accounting_reports', 1, 1, 1, 1, '2020-02-25 13:36:24'),
				(69, 16, 'Fees Type', 'fees_type', 1, 1, 1, 1, '2020-02-27 10:11:03'),
				(70, 16, 'Fees Group', 'fees_group', 1, 1, 1, 1, '2020-02-26 05:49:09'),
				(71, 16, 'Fees Fine Setup', 'fees_fine_setup', 1, 1, 1, 1, '2020-03-05 02:59:27'),
				(72, 16, 'Fees Allocation', 'fees_allocation', 1, 1, 1, 1, '2020-03-01 13:47:43'),
				(73, 16, 'Collect Fees', 'collect_fees', 0, 1, 0, 0, '2020-03-15 04:23:58'),
				(74, 16, 'Fees Reminder', 'fees_reminder', 1, 1, 1, 1, '2020-03-15 04:29:58'),
				(75, 16, 'Due Invoice', 'due_invoice', 1, 0, 0, 0, '2020-03-15 04:33:36'),
				(76, 16, 'Invoice', 'invoice', 1, 0, 0, 1, '2020-03-15 04:38:06'),
				(77, 9, 'Mark Distribution', 'mark_distribution', 1, 1, 1, 1, '2020-03-19 13:02:54'),
				(78, 9, 'Report Card', 'report_card', 1, 0, 0, 0, '2020-03-20 12:20:28'),
				(79, 9, 'Tabulation Sheet', 'tabulation_sheet', 1, 0, 0, 0, '2020-03-21 07:12:38'),
				(80, 15, 'Sendsmsmail Reports', 'sendsmsmail_reports', 1, 0, 0, 0, '2020-03-21 17:02:02'),
				(81, 18, 'Global Settings', 'global_settings', 1, 0, 1, 0, '2020-03-22 05:05:41'),
				(82, 18, 'Payment Settings', 'payment_settings', 1, 1, 0, 0, '2020-03-22 05:08:57'),
				(83, 18, 'Sms Settings', 'sms_settings', 1, 1, 1, 1, '2020-03-22 05:08:57'),
				(84, 18, 'Email Settings', 'email_settings', 1, 1, 1, 1, '2020-03-22 05:10:39'),
				(85, 18, 'Translations', 'translations', 1, 1, 1, 1, '2020-03-22 05:18:33'),
				(86, 18, 'Backup', 'backup', 1, 1, 1, 1, '2020-03-22 07:09:33'),
				(87, 18, 'Backup Restore', 'backup_restore', 0, 1, 0, 0, '2020-03-22 07:09:34'),
				(88, 7, 'Homework Evaluate', 'homework_evaluate', 1, 1, 0, 0, '2020-03-28 04:20:29'),
				(89, 7, 'Evaluation Report', 'evaluation_report', 1, 0, 0, 0, '2020-03-28 09:56:04'),
				(90, 18, 'School Settings', 'school_settings', 1, 0, 1, 0, '2020-03-30 17:36:37'),
				(91, 1, 'Monthly Income Vs Expense Pie Chart', 'monthly_income_vs_expense_chart', 1, 0, 0, 0, '2020-03-31 06:15:31'),
				(92, 1, 'Annual Student Fees Summary Chart', 'annual_student_fees_summary_chart', 1, 0, 0, 0, '2020-03-31 06:15:31'),
				(93, 1, 'Employee Count Widget', 'employee_count_widget', 1, 0, 0, 0, '2020-03-31 06:31:56'),
				(94, 1, 'Student Count Widget', 'student_count_widget', 1, 0, 0, 0, '2020-03-31 06:31:56'),
				(95, 1, 'Parent Count Widget', 'parent_count_widget', 1, 0, 0, 0, '2020-03-31 06:31:56'),
				(96, 1, 'Teacher Count Widget', 'teacher_count_widget', 1, 0, 0, 0, '2020-03-31 06:31:56'),
				(97, 1, 'Student Quantity Pie Chart', 'student_quantity_pie_chart', 1, 0, 0, 0, '2020-03-31 07:14:07'),
				(98, 1, 'Weekend Attendance Inspection Chart', 'weekend_attendance_inspection_chart', 1, 0, 0, 0, '2020-03-31 07:14:07'),
				(99, 1, 'Admission Count Widget', 'admission_count_widget', 1, 0, 0, 0, '2020-03-31 07:22:05'),
				(100, 1, 'Voucher Count Widget', 'voucher_count_widget', 1, 0, 0, 0, '2020-03-31 07:22:05'),
				(101, 1, 'Transport Count Widget', 'transport_count_widget', 1, 0, 0, 0, '2020-03-31 07:22:05'),
				(102, 1, 'Hostel Count Widget', 'hostel_count_widget', 1, 0, 0, 0, '2020-03-31 07:22:05'),
				(103, 18, 'Accounting Links', 'accounting_links', 1, 0, 1, 0, '2020-03-31 09:46:30'),
				(104, 16, 'Fees Reports', 'fees_reports', 1, 0, 0, 0, '2020-04-01 15:52:19'),
				(105, 18, 'Cron Job', 'cron_job', 1, 0, 1, 0, '2020-03-31 09:46:30'),
				(106, 18, 'Custom Field', 'custom_field', 1, 1, 1, 1, '2020-03-31 09:46:30'),
				(107, 5, 'Leave Reports', 'leave_reports', 1, 0, 0, 0, '2020-03-31 09:46:30'),
				(108, 18, 'Live Class Config', 'live_class_config', 1, 0, 1, 0, '2020-03-31 09:46:30'),
				(109, 19, 'Live Class', 'live_class', 1, 1, 1, 1, '2020-03-31 09:46:30'),
				(110, 20, 'Certificate Templete', 'certificate_templete', 1, 1, 1, 1, '2020-03-31 09:46:30'),
				(111, 20, 'Generate Student Certificate', 'generate_student_certificate', 1, 0, 0, 0, '2020-03-31 09:46:30'),
				(112, 20, 'Generate Employee Certificate', 'generate_employee_certificate', 1, 0, 0, 0, '2020-03-31 09:46:30'),
				(113, 21, 'ID Card Templete', 'id_card_templete', 1, 1, 1, 1, '2020-03-31 09:46:30'),
				(114, 21, 'Generate Student ID Card', 'generate_student_idcard', 1, 0, 0, 0, '2020-03-31 09:46:30'),
				(115, 21, 'Generate Employee ID Card', 'generate_employee_idcard', 1, 0, 0, 0, '2020-03-31 09:46:30'),
				(116, 21, 'Admit Card Templete', 'admit_card_templete', 1, 1, 1, 1, '2020-03-31 09:46:30'),
				(117, 21, 'Generate Admit card', 'generate_admit_card', 1, 0, 0, 0, '2020-03-31 09:46:30'),
				(118, 22, 'Frontend Setting', 'frontend_setting', 1, 1, 0, 0, '2019-09-11 03:24:07'),
				(119, 22, 'Frontend Menu', 'frontend_menu', 1, 1, 1, 1, '2019-09-11 04:03:39'),
				(120, 22, 'Frontend Section', 'frontend_section', 1, 1, 0, 0, '2019-09-11 04:26:11'),
				(121, 22, 'Manage Page', 'manage_page', 1, 1, 1, 1, '2019-09-11 05:54:08'),
				(122, 22, 'Frontend Slider', 'frontend_slider', 1, 1, 1, 1, '2019-09-11 06:12:31'),
				(123, 22, 'Frontend Features', 'frontend_features', 1, 1, 1, 1, '2019-09-11 06:47:51'),
				(124, 22, 'Frontend Testimonial', 'frontend_testimonial', 1, 1, 1, 1, '2019-09-11 06:54:30'),
				(125, 22, 'Frontend Services', 'frontend_services', 1, 1, 1, 1, '2019-09-11 07:01:44'),
				(126, 22, 'Frontend Faq', 'frontend_faq', 1, 1, 1, 1, '2019-09-11 07:06:16'),
				(127, 2, 'Online Admission', 'online_admission', 1, 1, 0, 1, '2019-09-11 07:06:16'),
				(128, 18, 'System Update', 'system_update', 0, 1, 0, 0, '2019-09-11 07:06:16');");
		$this->db->truncate('permission_modules');
		$this->db->query("INSERT INTO `permission_modules` (`id`, `name`, `prefix`, `system`, `sorted`, `created_at`) VALUES
				(1, 'Dashboard', 'dashboard', 1, 1, '2019-05-26 22:23:00'),
				(2, 'Student', 'student', 1, 3, '2019-05-26 22:23:00'),
				(3, 'Parents', 'parents', 1, 4, '2019-05-26 22:23:00'),
				(4, 'Employee', 'employee', 1, 5, '2019-05-26 22:23:00'),
				(5, 'Human Resource', 'human_resource', 1, 8, '2019-05-26 22:23:00'),
				(6, 'Academic', 'academic', 1, 9, '2019-05-26 22:23:00'),
				(7, 'Homework', 'homework', 1, 12, '2019-05-26 22:23:00'),
				(8, 'Attachments Book', 'attachments_book', 1, 11, '2019-05-26 22:23:00'),
				(9, 'Exam Master', 'exam_master', 1, 13, '2019-05-26 22:23:00'),
				(10, 'Hostel', 'hostel', 1, 14, '2019-05-26 22:23:00'),
				(11, 'Transport', 'transport', 1, 15, '2019-05-26 22:23:00'),
				(12, 'Attendance', 'attendance', 1, 16, '2019-05-26 22:23:00'),
				(13, 'Library', 'library', 1, 17, '2019-05-26 22:23:00'),
				(14, 'Events', 'events', 1, 18, '2019-05-26 22:23:00'),
				(15, 'Bulk Sms And Email', 'bulk_sms_and_email', 1, 19, '2019-05-26 22:23:00'),
				(16, 'Student Accounting', 'student_accounting', 1, 20, '2019-05-26 22:23:00'),
				(17, 'Office Accounting', 'office_accounting', 1, 21, '2019-05-26 22:23:00'),
				(18, 'Settings', 'settings', 1, 22, '2019-05-26 22:23:00'),
				(19, 'Live Class', 'live_class', 1, 10, '2019-05-26 22:23:00'),
				(20, 'Certificate', 'certificate', 1, 7, '2019-05-26 22:23:00'),
				(21, 'Card Management', 'card_management', 1, 6, '2019-05-26 22:23:00'),
				(22, 'Website', 'website', 1, 2, '2019-05-26 22:23:00');");
		$this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_admission` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(255) DEFAULT NULL,
			  `description` text,
			  `page_title` varchar(255) DEFAULT NULL,
			  `banner_image` varchar(255) DEFAULT NULL,
			  `meta_description` text NOT NULL,
			  `meta_keyword` text NOT NULL,
			  `branch_id` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_admission` (`id`, `title`, `description`, `page_title`, `banner_image`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
			(1, 'Make An Admission', '<p>Lorem ipsum dolor sit amet, eum illum dolore concludaturque ex, ius latine adipisci no. Pro at nullam laboramus definitiones. Mandamusconceptam omittantur cu cum. Brute appetere it scriptorem ei eam, ne vim velit novum nominati. Causae volutpat percipitur at sed ne.</p>\r\n', 'Admission', 'admission1.jpg', 'Losin - School Management System With CMS', 'Losin  Admission Page', 1);");
	}
}

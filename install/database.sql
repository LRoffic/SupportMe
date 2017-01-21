CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `published`) VALUES
	(1, 'General', 1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `date_reply` int(11) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) NOT NULL,
  `site_email` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL DEFAULT 'default/',
  `lang` varchar(255) NOT NULL DEFAULT 'fr_FR',
  `register` int(11) NOT NULL DEFAULT '1',
  `connexion_mandatory` int(11) NOT NULL DEFAULT '0',
  `recaptcha_public_key` varchar(255) DEFAULT NULL,
  `recaptcha_private_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `config` DISABLE KEYS */;
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `faq_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `datepost` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `faq_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq_articles` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `faq_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `faq_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq_category` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(2555) NOT NULL,
  `access_admin` int(11) NOT NULL DEFAULT '0',
  `view_all_ticket` int(11) NOT NULL DEFAULT '0',
  `reopen_ticket` int(11) NOT NULL DEFAULT '0',
  `comment_closed_ticket` int(11) NOT NULL DEFAULT '0',
  `lang_gestion` int(11) NOT NULL DEFAULT '0',
  `plugin_gestion` int(11) NOT NULL DEFAULT '0',
  `theme_gestion` int(11) NOT NULL DEFAULT '0',
  `config_gestion` int(11) NOT NULL DEFAULT '0',
  `users_gestion` int(11) NOT NULL DEFAULT '0',
  `perm_gestion` int(11) NOT NULL DEFAULT '0',
  `assign_to_me` int(11) NOT NULL DEFAULT '0',
  `assign_to_other` int(11) NOT NULL DEFAULT '0',
  `change_assign` int(11) NOT NULL DEFAULT '0',
  `category_gestion` int(11) NOT NULL DEFAULT '0',
  `faq_gestion` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `access_admin`, `view_all_ticket`, `reopen_ticket`, `comment_closed_ticket`, `lang_gestion`, `plugin_gestion`, `theme_gestion`, `config_gestion`, `users_gestion`, `perm_gestion`, `assign_to_me`, `assign_to_other`, `change_assign`, `category_gestion`, `faq_gestion`) VALUES
	(1, 'Default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
  (2, 'Moderator', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0),
	(3, 'Admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `plugin_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(255) NOT NULL,
  `option` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `plugin_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `plugin_settings` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(255) NOT NULL,
  `autor_ip` varchar(255) NOT NULL,
  `attribute` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `date_receive` varchar(255) NOT NULL,
  `date_last_action` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `status_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email_password` varchar(255) DEFAULT NULL,
  `rank` int(11) NOT NULL DEFAULT '1',
  `ip` varchar(20) NOT NULL,
  `last_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `categories` (`id`, `nom`, `actif`) VALUES
(1, 'Générale', '1');

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(255) NOT NULL,
  `sitemail` varchar(255) NOT NULL,
  `registration` enum('force','none') NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT 'default/',
  `cookie` enum('0','1') NOT NULL,
  `faq` enum('e','d') NOT NULL,
  `recaptcha` enum('e','d') NOT NULL,
  `recaptcha_key` varchar(255) NOT NULL,
  `recaptcha_privatekey` varchar(255) NOT NULL,
  `htaccess` enum('e','d') NOT NULL DEFAULT 'e',
  `version` varchar(5) NOT NULL,
  `lang` varchar(50) NOT NULL DEFAULT 'fr_FR',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `sendticket` enum('0','1') NOT NULL DEFAULT '1',
  `viewticket` enum('0','1') NOT NULL DEFAULT '1',
  `ViewNotAssigned` enum('0','1') NOT NULL DEFAULT '0',
  `viewNotAssignToMe` enum('0','1') NOT NULL DEFAULT '0',
  `viewfaq` enum('0','1') NOT NULL DEFAULT '1',
  `resolve` enum('0','1') NOT NULL DEFAULT '1',
  `lastresolved` enum('0','1') NOT NULL DEFAULT '1',
  `comment` enum('0','1') NOT NULL DEFAULT '1',
  `reopen` enum('0','1') NOT NULL DEFAULT '1',
  `viewLinkAdmin` enum('0','1') NOT NULL DEFAULT '0',
  `accessAdmin` enum('0','1') NOT NULL DEFAULT '0',
  `viewuser` enum('0','1') NOT NULL DEFAULT '0',
  `deleteticket` enum('0','1') NOT NULL DEFAULT '0',
  `modiftheme` enum('0','1') NOT NULL DEFAULT '0',
  `canAssign` enum('0','1') NOT NULL DEFAULT '0',
  `canUnAssign` enum('0','1') NOT NULL DEFAULT '0',
  `config` enum('0','1') NOT NULL DEFAULT '0',
  `deleteUsers` enum('0','1') NOT NULL DEFAULT '0',
  `modifUsers` enum('0','1') NOT NULL DEFAULT '0',
  `modifUsersPassword` enum('0','1') NOT NULL DEFAULT '0',
  `modifUsersRang` enum('0','1') NOT NULL DEFAULT '0',
  `modifUsersProtect` enum('0','1') NOT NULL DEFAULT '0',
  `modifPerms` enum('0','1') NOT NULL DEFAULT '0',
  `deletePerms` enum('0','1') NOT NULL DEFAULT '0',
  `addNewPerm` enum('0','1') NOT NULL DEFAULT '0',
  `Categories` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `permissions` (`id`, `nom`, `sendticket`, `viewticket`, `ViewNotAssigned`, `viewNotAssignToMe`, `viewfaq`, `resolve`, `lastresolved`, `comment`, `reopen`, `viewLinkAdmin`, `accessAdmin`, `viewuser`, `deleteticket`, `modiftheme`, `canAssign`, `canUnAssign`, `config`, `deleteUsers`, `modifUsers`, `modifUsersPassword`, `modifUsersRang`, `modifUsersProtect`, `modifPerms`, `deletePerms`, `addNewPerm`, `Categories`) VALUES
(1, 'Visiteur', '1', '1', '0', '0', '1', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'Default', '1', '1', '0', '0', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'Moderateur', '1', '1', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'Administrateur', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

CREATE TABLE IF NOT EXISTS `response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `datepost` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `categorie` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `datepost` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `etat` enum('0','1','2') NOT NULL DEFAULT '0',
  `isfaq` enum('0','1') NOT NULL DEFAULT '0',
  `assigned` enum('0','1') NOT NULL DEFAULT '0',
  `assignto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateinsc` varchar(20) NOT NULL,
  `lastview` varchar(20) NOT NULL,
  `permission` int(11) DEFAULT '1',
  `ip` varchar(255) NOT NULL,
  `protected` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
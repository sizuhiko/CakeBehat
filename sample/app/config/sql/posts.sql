SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `posts` VALUES(1, 'The title', 'This is the post body.', '2011-06-22 23:06:44', '2011-06-22 23:06:44');
INSERT INTO `posts` VALUES(2, 'A title once again', 'And the post body follows.', '2011-06-22 23:06:44', '2011-06-22 23:06:44');
INSERT INTO `posts` VALUES(3, 'Title strikes back', 'This is really exciting! Not.', '2011-06-22 23:06:44', '2011-06-22 23:06:44');

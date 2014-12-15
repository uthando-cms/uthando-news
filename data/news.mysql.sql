SET FOREIGN_KEY_CHECKS=0;
--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `newsId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleId` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`newsId`),
  KEY `articleId` (`articleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `article` (`articleId`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
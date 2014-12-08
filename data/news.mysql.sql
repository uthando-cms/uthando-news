
--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `newsId` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned zerofill NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`newsId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
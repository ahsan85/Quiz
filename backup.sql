-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.18 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for quizdatabase
CREATE DATABASE IF NOT EXISTS `quizdatabase` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `quizdatabase`;

-- Dumping structure for table quizdatabase.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) NOT NULL DEFAULT '',
  `question_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table quizdatabase.answers: ~20 rows (approximately)
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`id`, `answer`, `question_id`) VALUES
	(1, 'Java', '1'),
	(2, 'PHP', '1'),
	(3, 'C', '1'),
	(4, 'C#', '1'),
	(5, '1', '2'),
	(6, '2', '2'),
	(7, 'No Limit', '2'),
	(8, 'Depends on Compiler', '2'),
	(9, 'Operator', '3'),
	(10, 'Function', '3'),
	(11, 'Macro', '3'),
	(12, ' None of these', '3'),
	(13, '10', '4'),
	(14, 'Compilation Error', '4'),
	(15, '0', '4'),
	(16, 'Undefined', '4'),
	(17, '20', '5'),
	(18, '0', '5'),
	(19, 'Undefined reference to i', '5'),
	(20, 'Linking Error', '5');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

-- Dumping structure for table quizdatabase.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `questions` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `answer_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table quizdatabase.questions: ~5 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `questions`, `type`, `answer_id`) VALUES
	(1, 'Which programming language is more faster among these?', 'c', 3),
	(2, 'How many main() function we can have in our project?', 'c', 2),
	(3, 'What is sizeof() in C?', 'c', 9),
	(4, 'main()\r\n{\r\n     int x = 10;\r\n	{\r\n	    int x = 0;\r\n	    printf("%d",x);\r\n	}\r\n}', 'c', 15),
	(5, 'int main()\r\n{\r\nextern int i;\r\ni = 20;\r\nprintf("%d", sizeof(i));\r\nreturn 0;\r\n}\r\n', 'c', 19);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

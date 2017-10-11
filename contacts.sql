-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB-0+deb9u1 - Debian 9.1
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table agenda_telefonica.contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table agenda_telefonica.contact: ~11 rows (approximately)
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` (`id`, `name`, `email`, `address`, `phone`) VALUES
	(11, 'luan', 'luan@teste.com', 'dsadasds', '2233'),
	(12, 'carlos', 'carlos@teste.com', 'dsadadas', '3332'),
	(13, 'testador3', 'dasdasdas@dsadas', 'dasdasds', '123'),
	(14, 'testador4', 'dasdasds@dsadasds', 'dasdads', '232132'),
	(15, 'testador5', 'dasdas@dsadsa', 'dasdasda', '12323213'),
	(16, 'testador10', 'dsadaas@dsada', 'dsdas', '123'),
	(17, 'filipe', 'filipe@gmail.com', 'sao paulo', '33442233'),
	(29, 'testador99', 'dsadas@dsda', 'dsadasdas', '1231223'),
	(30, 'antonio', 'antonio@gmail.com', 'dsadsadsadsadas', '23123213'),
	(31, 'antonio', 'antonio@gmail.com', 'dsadsadsadsadas', '23123213'),
	(32, 'joao3', 'dsadasd@dsadasd', 'dasdasdas', '1231231');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

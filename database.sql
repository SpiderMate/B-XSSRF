
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(0, 'admin', 'admin@test.com', '$2y$10$aGf.b9q3VPWDwVAAHDC.pu9/1mzWOCwKwYb9ke.7pAAjOzRBxJvZu', '2019-08-22 11:15:44');



CREATE TABLE `xssrf_logs` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `datex` varchar(255) NOT NULL,
  `timex` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `xssrf_logs`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `xssrf_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

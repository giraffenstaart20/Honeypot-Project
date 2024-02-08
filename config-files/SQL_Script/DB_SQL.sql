CREATE TABLE `userfiles` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `userfiles`
  ADD PRIMARY KEY (`userID`);

ALTER TABLE `userfiles` MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPassword` varchar(500) NOT NULL,
  `plainPassword` varchar(128) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `image` varchar(250) DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` bigint(20) NOT NULL DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users` ADD PRIMARY KEY (`userID`);

ALTER TABLE `users` MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

CREATE TABLE `userfiles` (
  `userID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `userfiles` ADD PRIMARY KEY (`userID`);

ALTER TABLE `userfiles` MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;
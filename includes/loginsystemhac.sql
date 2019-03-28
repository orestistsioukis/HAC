-- FORMAT of `gallery`
CREATE TABLE `gallery` (
  `idGallery` int(11) NOT NULL,
  `titleGallery` longtext NOT NULL,
  `descGallery` longtext NOT NULL,
  `imgFullNameGallery` longtext NOT NULL,
  `orderGallery` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- DATA of table `gallery`
INSERT INTO `gallery` (`idGallery`, `titleGallery`, `descGallery`, `imgFullNameGallery`, `orderGallery`) VALUES
(1, 'Everest Base Camp', 'The road to Everest base camp', 'everest-base-camp.5c9bee8be385f6.92217937.jpg', '1'),
(2, 'Prayer Flags ', 'Flags', 'prayerflags.5c9bf3124a3b07.39764929.jpg', '2'),
(3, 'Climber', 'Climber made it to the top', 'climber-top.5c9bf3e5d67829.37258338.jpg', '3'),
(4, 'Top of the world', 'Welcome to the summit', 'topoftheworld.5c9bf4497f42a8.61171894.jpg', '4'),
(5, 'South side', 'South mountain climbing root', 'everest-south-side.5c9bf4d446a976.90499061.jpg', '5'),
(6, 'Uphill we go', 'The way to the summit', 'everest-xlarge.5c9c11de263929.42817229.jpg', '6'),
(7, 'Hillary Step', 'Most technical climbing', 'hillary-step.5c9c123b051063.33992778.jpg', '7'),
(8, 'North root', 'North way to summit', 'north-side.5c9c126e7a0714.31523874.jpg', '8');
-- FORMAT of `users`
CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- DATA of table `users`
INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`) VALUES
(1, 'Dani', 'dani@mail.net', '$2y$10$UVEfRWi8GBIM.M0/gTPqMuZzF5OZeIcvJRlj3Mv98n9VDkmCCHnX.'),
(2, 'Jane', 'jane@gmail.com', '$2y$10$ov7UWSAwaiAiiLfBXgvZl.dSEPP92z1HkikxrOv7GFGbwmoupQHga'),
(3, 'Tom', 'tom@gmail.gr', '$2y$10$yXj4.wDFpGPQor8oS7aG2.z6ZkBqPlCZDP6aeafoZvdgofYLoQ1x2');
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
CREATE DATABASE IF NOT EXISTS `clipclop2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clipclop2`;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_body` varchar(650) NOT NULL,
  `comment_author` varchar(100) NOT NULL,
  `comment_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comments` (`id`, `post_id`, `comment_body`, `comment_author`, `comment_created`) VALUES
(35, 10, 'kokoko', 'Justin', 2024);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(650) NOT NULL,
  `created` date NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `title`, `content`, `created`, `author`) VALUES
(1, 'Ponycon was a blast fsfdsfdsfds', 'Donec nisi augue, sagittis et vestibulum quis, tincidunt quis augue. Duis mauris enim, vestibulum mollis tristique bibendum, scelerisque nec sem. In tortor arcu, rhoncus sed purus et, bibendum facilisis ante. Integer ut laoreet sem. Etiam efficitur ipsum erat. Fusce purus velit, dapibus quis leo sed, commodo fermentum nibh. Etiam ligula neque, accumsan vel tortor a, vulputate vulputate ligula. In nec lacinia arcu, sed mollis justo. Vivamus a sodales lacus. Curabitur in enim nulla. Nam eget dui molestie, mattis leo in, porta sem. Sed convallis neque est, eu lobortis tortor bibendum eget. Donec vestibulum ipsum a semper tristique.', '2024-06-18', 'Justin'),
(2, 'Justice for Fluttershy editfsfdsfds', 'Morbi gravida est orci, a hendrerit quam dignissim quis. Maecenas et orci ornare, volutpat nibh non, pretium sapien. Duis ac arcu nunc. Integer sed neque consequat, pulvinar ligula eu, faucibus sem. Proin euismod metus mi, in pulvinar tellus maximus in. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque pretium dolor id neque pulvinar, in commodo leo sodales. fdsfsdfdsf sfsfdsfesfds', '2024-06-18', 'Justin'),
(6, 'I <3 Rainbow Dash EDIT EDIT', 'Aenean aliquet, nisi sit amet eleifend finibus, lectus urna pulvinar tellus, quis facilisis ante felis non felis. In sit amet eros sit amet leo iaculis luctus. Morbi volutpat tempus libero in egestas. Etiam id elit sapien. Nunc non feugiat urna. Aenean porta lorem ut urna convallis finibus. Fusce fermentum pulvinar porttito EDIT EDIT EDTI', '2024-06-20', 'Justin'),
(10, 'ju', 'lol', '2024-06-24', 'Justin');


ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
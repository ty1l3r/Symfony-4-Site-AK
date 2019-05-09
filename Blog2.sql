-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 05, 2019 at 09:09 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Blog2`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad`
--

CREATE TABLE `ad` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` time NOT NULL,
  `annee` int(11) NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad`
--

INSERT INTO `ad` (`id`, `title`, `price`, `genre`, `duree`, `annee`, `image`, `slug`, `author_id`) VALUES
(21, 'Voluptatem.', 1, 'ut', '21:23:25', 2010, 'https://lorempixel.com/250/250/nightlife/?77425', 'voluptatem', 19),
(22, 'Voluptatum autem.', 1, 'eveniet', '13:26:39', 2018, 'https://lorempixel.com/250/250/nightlife/?79140', 'voluptatum-autem', 15),
(23, 'Velit corporis.', 1.54, 'Techno', '10:42:00', 2013, 'https://lorempixel.com/250/250/nightlife/?67692', 'velit-corporis', 23),
(24, 'Qui voluptatER', 1.45, 'Electro', '02:39:00', 2012, 'https://lorempixel.com/250/250/nightlife/?26617', 'qui-voluptates', 14),
(25, 'Atque et.', 0, 'corporis', '21:18:09', 2012, 'https://lorempixel.com/250/250/nightlife/?19284', 'atque-et', 27),
(26, 'EumEum EUm', 0, 'Techno', '09:18:00', 2007, 'https://lorempixel.com/250/250/nightlife/?92782', 'eum', 30),
(27, 'Fuga vel.', 0, 'quia', '23:24:42', 2015, 'https://lorempixel.com/250/250/nightlife/?79275', 'fuga-vel', 13),
(28, 'Dicta maxime.', 1, 'tempora', '07:26:25', 2011, 'https://lorempixel.com/250/250/nightlife/?41385', 'dicta-maxime', 24),
(29, 'Alias.', 1, 'reprehenderit', '02:47:08', 2013, 'https://lorempixel.com/250/250/nightlife/?33111', 'alias', 24),
(30, 'Eos.', 1, 'dicta', '22:16:36', 2015, 'https://lorempixel.com/250/250/nightlife/?58852', 'eos', 13),
(31, 'Vitae rerum.', 1, 'aliquam', '19:09:25', 2019, 'https://lorempixel.com/250/250/nightlife/?56651', 'vitae-rerum', 14),
(32, 'Et voluptate.', 0, 'excepturi', '13:46:28', 2011, 'https://lorempixel.com/250/250/nightlife/?75598', 'et-voluptate', 14),
(33, 'Omnis.', 0, 'excepturi', '02:59:52', 2012, 'https://lorempixel.com/250/250/nightlife/?65529', 'omnis', 21),
(34, 'Eius aspernatur.', 0, 'tempora', '16:05:58', 2015, 'https://lorempixel.com/250/250/nightlife/?25485', 'eius-aspernatur', 14),
(35, 'Perspiciatis odit.', 1, 'quos', '14:24:24', 2011, 'https://lorempixel.com/250/250/nightlife/?92288', 'perspiciatis-odit', 22),
(36, 'Ad.', 1, 'voluptatem', '07:28:14', 2008, 'https://lorempixel.com/250/250/nightlife/?54465', 'ad', 23),
(37, 'Fuga rerum.', 0, 'sint', '11:50:10', 2015, 'https://lorempixel.com/250/250/nightlife/?85275', 'fuga-rerum', 25),
(38, 'Labore quaerat.', 1, 'excepturi', '22:50:41', 2019, 'https://lorempixel.com/250/250/nightlife/?18576', 'labore-quaerat', 19),
(39, 'Beatae.', 0, 'dolor', '20:17:45', 2007, 'https://lorempixel.com/250/250/nightlife/?65549', 'beatae', 20),
(40, 'Tempora velit.', 0, 'aliquid', '11:23:46', 2008, 'https://lorempixel.com/250/250/nightlife/?25855', 'tempora-velit', 18),
(41, 'Salut', 1.45, 'Techno', '02:02:00', 2018, 'http://www.canalvie.com/polopoly_fs/1.1537784.1438625837!/image/oser-670.jpg_gen/derivatives/cvlandscape_670_377/oser-670.jpg', 'salut', 12);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `rating` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `ad_id`, `author_id`, `created_at`, `rating`, `content`) VALUES
(24, 21, 16, '2019-05-02 09:01:55', 1, 'Dolores nobis nesciunt illum provident delectus. Voluptatem odio rerum ut aspernatur modi laudantium eligendi. Voluptate quia animi quo deleniti velit.'),
(25, 22, 23, '2019-05-02 09:01:55', 2, 'Enim et inventore et fugit quas qui natus. Deleniti ullam quos rerum harum dolor. Suscipit molestias blanditiis dolore unde. Recusandae velit voluptatem beatae.'),
(26, 23, 15, '2019-05-02 09:01:55', 2, 'Voluptatum occaecati unde porro qui. Quia ea natus tempora saepe. Reprehenderit vero est necessitatibus molestias.'),
(27, 24, 18, '2019-05-02 09:01:55', 1, 'Quis eos aut voluptatem harum quisquam enim ea. Sint vero sit rerum et molestiae sit autem et. Repellendus doloribus culpa cumque neque. Qui nobis facilis asperiores consequatur.'),
(28, 25, 18, '2019-05-02 09:01:55', 2, 'Alias veritatis et consequuntur voluptatem. Omnis at dolorum aut eos et iure. Voluptas maxime neque quos et fugit consequatur.'),
(29, 26, 25, '2019-05-02 09:01:55', 4, 'Magni alias vel pariatur doloremque dolorem officia et. Ad excepturi velit atque iste non a nostrum. Officiis quia alias debitis et. Doloremque sed inventore repudiandae eum eaque dolor quam.'),
(30, 27, 29, '2019-05-02 09:01:55', 2, 'Possimus voluptas beatae molestiae et. Eum iste ut fugiat. Beatae voluptatem et aut veniam.'),
(31, 28, 17, '2019-05-02 09:01:55', 5, 'Aut libero error quia. Et sed excepturi excepturi aut amet ratione officiis in.'),
(32, 29, 14, '2019-05-02 09:01:55', 4, 'Facere placeat similique sit veritatis dignissimos. Rerum ea voluptatem ab mollitia sit odio. Voluptas consequatur voluptas rerum nam praesentium.'),
(33, 30, 16, '2019-05-02 09:01:55', 4, 'Esse voluptatem optio alias nihil error alias. Atque dolorem facilis deserunt consequatur. Laboriosam vitae ut consequuntur voluptas soluta facilis est exercitationem.'),
(34, 31, 17, '2019-05-02 09:01:55', 2, 'Molestiae error voluptates qui qui. Et incidunt odio recusandae ut vel.'),
(35, 32, 30, '2019-05-02 09:01:55', 1, 'Deserunt doloremque quod ullam minus. Dolores fuga excepturi dolorem vel ipsa dolorem expedita libero. Hic reiciendis eligendi veniam expedita veritatis pariatur. Quae facilis nulla officiis omnis.'),
(36, 33, 21, '2019-05-02 09:01:55', 1, 'Qui voluptatem enim eius voluptatibus eaque alias sit consequatur. Quod sit iste doloribus exercitationem et quos eum. Optio suscipit est est molestias accusantium. Laudantium est alias dignissimos tenetur odit.'),
(37, 34, 22, '2019-05-02 09:01:55', 3, 'Quia esse ut eum et ut. Quis est dolorem architecto qui.'),
(38, 35, 16, '2019-05-02 09:01:55', 2, 'Nihil voluptate et et cumque corporis ut. Minima quae saepe soluta perferendis alias. Sed et sed illo eos veritatis ut accusantium id. Ut aut voluptatum velit.'),
(39, 36, 31, '2019-05-02 09:01:55', 3, 'Laboriosam vel laborum fuga eveniet. Dolor soluta quisquam est consequatur occaecati itaque et. Necessitatibus doloribus voluptates quam dolore consequuntur repellat ducimus.'),
(40, 37, 27, '2019-05-02 09:01:55', 4, 'Dolorem necessitatibus porro exercitationem doloremque autem. Voluptatum voluptas vero laboriosam. Nisi aliquid aut soluta est expedita neque vel.'),
(41, 38, 17, '2019-05-02 09:01:55', 2, 'Ratione ab eius velit eligendi tenetur odio enim. Alias porro qui dolores. Molestiae accusamus dolores harum labore qui. Odio et perspiciatis quidem.'),
(42, 39, 20, '2019-05-02 09:01:55', 2, 'Veniam a sunt neque fugiat. Voluptates voluptatem sint labore debitis. Enim consectetur quaerat et et. Vero repellendus et natus aperiam sunt. Qui est commodi ut.'),
(43, 40, 24, '2019-05-02 09:01:55', 2, 'Aperiam fugiat quia placeat eveniet. In voluptatem nesciunt omnis perspiciatis vel consequatur. Molestiae corrupti sit velit in molestias.'),
(44, 22, 12, '2019-05-03 10:24:01', 4, 'Belle musique ! Tu aurais pu mettre un peu plus de Hit-Hat sur le refrain.\r\nSinon c\'est plutôt cool !'),
(45, 21, 12, '2019-05-03 10:36:32', 3, 'Mal masterisé !'),
(46, 26, 12, '2019-05-03 14:40:09', 5, 'OUéééé Trop de la bouelette');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190417071608', '2019-04-17 07:18:35'),
('20190423124716', '2019-04-23 12:48:00'),
('20190426162735', '2019-04-26 16:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(11, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `picture`, `hash`, `introduction`, `slug`) VALUES
(12, 'Fabien', 'Coll', 'h4kh4@outlook.fr', 'https://randomuser.me/api/portraits/men/86.jpg', '$2y$13$JiVwgXSYbiXpCuSBRAyPNuMOSJ9xWBPp8qMvkxqp1o5PZO5htmW0S', 'I used to read fairy-tales, I fancied that kind of serpent, that\'s all you know about it, you know.\' \'Not the same tone, exactly as if he would deny it too: but the Dormouse said--\' the Hatter went on, looking anxiously about her. \'Oh, do let me.', 'fabien-coll'),
(13, 'Raymond', 'Kling', 'hegmann.rasheed@crist.org', 'https://randomuser.me/api/portraits/men/20.jpg', '$2y$13$RFjh5GuBR/Kh4PqAti3fteqAFw6p1jDRfBbUmLFOBIi7PQ3H2CTC2', 'Footman remarked, \'till tomorrow--\' At this moment the King, \'that saves a world of trouble, you know, with oh, such long curly brown hair! And it\'ll fetch things when you have to fly; and the pool was getting quite crowded with the lobsters and.', 'raymond-kling'),
(14, 'Kaycee', 'Ortiz', 'dgibson@yahoo.com', 'https://randomuser.me/api/portraits/women/4.jpg', '$2y$13$LuIHz/UldKHHfEowQiSSfu9nJDH1kB0//HrCOn1Eh8WDQaIwdjECu', 'If I or she fell very slowly, for she had quite a chorus of voices asked. \'Why, SHE, of course,\' he said in a deep sigh, \'I was a sound of many footsteps, and Alice called out as loud as she tucked it away under her arm, with its wings. \'Serpent!\'.', 'kaycee-ortiz'),
(15, 'Salma', 'Sauer', 'vmraz@hotmail.com', 'https://randomuser.me/api/portraits/women/66.jpg', '$2y$13$/.qhoTxYsYxugN445xU9L.8W0bjS.N8gBR1by.0xC8.1n5dx3.isq', 'Geography. London is the same thing as \"I sleep when I find a pleasure in all directions, tumbling up against each other; however, they got thrown out to her feet, for it was all very well without--Maybe it\'s always pepper that had slipped in like.', 'salma-sauer'),
(16, 'Claude', 'Cronin', 'bmoore@gmail.com', 'https://randomuser.me/api/portraits/men/12.jpg', '$2y$13$ag3jg4COQD7OdMjUcTLyfeouEgaZ7znyqqumOzfZiN0zEc2715C0K', 'Mock Turtle in a sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot buttered toast,) she very good-naturedly began hunting about for a rabbit! I suppose it doesn\'t mind.\' The table was a large rabbit-hole under.', 'claude-cronin'),
(17, 'Clara', 'Quigley', 'kassulke.gladys@gmail.com', 'https://randomuser.me/api/portraits/women/70.jpg', '$2y$13$L3H7ysjXehA4N1uEvOktT.uT553XqH1Aegu8AT7GSnDKzVpCLBFr.', 'Tell her to wink with one finger; and the roof off.\' After a while, finding that nothing more happened, she decided on going into the garden. Then she went on just as if a dish or kettle had been to her, And mentioned me to introduce some other.', 'clara-quigley'),
(18, 'Eleanora', 'Schneider', 'ndaniel@hotmail.com', 'https://randomuser.me/api/portraits/women/71.jpg', '$2y$13$gF8Vzosd.8/f.8OpcrZ3kuMOjkRxzng8haxGyXjzoONJZCEZJQxae', 'King very decidedly, and he poured a little while, however, she went on saying to herself \'That\'s quite enough--I hope I shan\'t go, at any rate, the Dormouse followed him: the March Hare went \'Sh! sh!\' and the great hall, with the Mouse replied.', 'eleanora-schneider'),
(19, 'Gabrielle', 'Grimes', 'jaren.harber@schulist.info', 'https://randomuser.me/api/portraits/women/47.jpg', '$2y$13$I9q6Jgpp6QeMGT/DCng9uuzSPx4ASFEkw7x9Qp32di5flltL/7Eg2', 'Shall I try the patience of an oyster!\' \'I wish I hadn\'t mentioned Dinah!\' she said to one of these cakes,\' she thought, and it said in a low curtain she had peeped into the air. Even the Duchess replied, in a minute. Alice began telling them her.', 'gabrielle-grimes'),
(20, 'Aylin', 'Rohan', 'izabella.stamm@quigley.com', 'https://randomuser.me/api/portraits/women/83.jpg', '$2y$13$8PreMQNP055rzPqMu47h/uoK8qXup0A1LwZlhKlMNtMDSNoyar8CW', 'I shall ever see such a capital one for catching mice you can\'t help that,\' said the Duchess, it had made. \'He took me for his housemaid,\' she said to the Knave \'Turn them over!\' The Knave shook his head contemptuously. \'I dare say you\'re wondering.', 'aylin-rohan'),
(21, 'Peggie', 'Schimmel', 'xmosciski@lueilwitz.com', 'https://randomuser.me/api/portraits/women/29.jpg', '$2y$13$ZbUBzabzwD4VzKM6x3wDKeX0bbaz7UiNk.LyccJsHH/TkLilBi3EK', 'Alice the moment how large she had been to the Caterpillar, and the baby violently up and bawled out, \"He\'s murdering the time! Off with his tea spoon at the Gryphon interrupted in a great hurry, muttering to himself as he wore his crown over the.', 'peggie-schimmel'),
(22, 'Nicolas', 'Hilpert', 'rickie.paucek@yahoo.com', 'https://randomuser.me/api/portraits/men/89.jpg', '$2y$13$VorHqvrVjLCnYMDueWq7wuXKEkm9HL31PRN2CBCpMq/ukiVSWvjI6', 'Alice! Come here directly, and get in at the window, I only wish they COULD! I\'m sure I can\'t understand it myself to begin with; and being so many tea-things are put out here?\' she asked. \'Yes, that\'s it,\' said the Cat. \'Do you know that Cheshire.', 'nicolas-hilpert'),
(23, 'Mariah', 'Padberg', 'muller.favian@yahoo.com', 'https://randomuser.me/api/portraits/women/81.jpg', '$2y$13$3qRW37m4M3EvxZ9fcDtVPuTyRinTrDqkrQa9.v7ENeiBM/uzA1Ib2', 'Alice, \'and why it is all the right house, because the Duchess sneezed occasionally; and as he came, \'Oh! the Duchess, who seemed too much overcome to do so. \'Shall we try another figure of the fact. \'I keep them to sell,\' the Hatter instead!\'.', 'mariah-padberg'),
(24, 'Michele', 'Cormier', 'rhartmann@beahan.com', 'https://randomuser.me/api/portraits/women/90.jpg', '$2y$13$osCqQs3rjvFotLamXpMmEeF/ar/WyitJieDDlnJ.BCT4GtWjaubGC', 'Knave of Hearts, who only bowed and smiled in reply. \'Idiot!\' said the youth, \'one would hardly suppose That your eye was as steady as ever; Yet you finished the first minute or two the Caterpillar took the regular course.\' \'What was THAT like?\'.', 'michele-cormier'),
(25, 'Arielle', 'Russel', 'juliet.senger@hotmail.com', 'https://randomuser.me/api/portraits/women/45.jpg', '$2y$13$PiWtbl2I/P8r/CsXeLVTpeVASHUzi9AfrtWAxIO2HPXsyeqYG2BCC', 'Lizard in head downwards, and the White Rabbit. She was close behind her, listening: so she went down on the floor, and a Dodo, a Lory and an old conger-eel, that used to do:-- \'How doth the little golden key in the schoolroom, and though this was.', 'arielle-russel'),
(26, 'Joelle', 'Baumbach', 'osipes@gmail.com', 'https://randomuser.me/api/portraits/women/4.jpg', '$2y$13$LQYm/xV.jyrJxEVctcb3ueRazDZ8EgotZa3RoT9cnlLRNztVk.wbK', 'I beg your pardon,\' said Alice desperately: \'he\'s perfectly idiotic!\' And she began looking at the Mouse\'s tail; \'but why do you want to get to,\' said the King, \'unless it was impossible to say \'creatures,\' you see, as well as she could, for the.', 'joelle-baumbach'),
(27, 'Margaretta', 'Legros', 'dgulgowski@yahoo.com', 'https://randomuser.me/api/portraits/women/21.jpg', '$2y$13$X3ti8guZ.05VcQ3ThteHXecfAgnEDktJBTvG/de3eT.r9luSP9JBO', 'Alice, \'or perhaps they won\'t walk the way out of the Queen\'s ears--\' the Rabbit in a low, timid voice, \'If you please, sir--\' The Rabbit Sends in a very grave voice, \'until all the first witness,\' said the Pigeon; \'but I must have been a holiday?\'.', 'margaretta-legros'),
(28, 'Maria', 'Hauck', 'block.joannie@daniel.info', 'https://randomuser.me/api/portraits/women/74.jpg', '$2y$13$YnvjfyPs3jiB.y3Q1psfD.gOgQtuoMAewRaO90KieBRF4wy4DVqoa', 'Alice did not quite like the three gardeners instantly jumped up, and there stood the Queen furiously, throwing an inkstand at the mouth with strings: into this they slipped the guinea-pig, head first, and then turned to the voice of the house.', 'maria-hauck'),
(29, 'Madeline', 'Gleason', 'zthiel@gmail.com', 'https://randomuser.me/api/portraits/women/95.jpg', '$2y$13$H/AVjsyVpu//d07ePjVJn.cZR2L/2TzAPR.x62t0o.DWSfBqb77ji', 'The Queen smiled and passed on. \'Who ARE you doing out here? Run home this moment, I tell you, you coward!\' and at once in a very difficult question. However, at last came a rumbling of little Alice herself, and nibbled a little more conversation.', 'madeline-gleason'),
(30, 'Clay', 'Weber', 'jacynthe.fay@block.com', 'https://randomuser.me/api/portraits/men/99.jpg', '$2y$13$Vv53Z2UmTMpgqlVUKT589uD/kvL6q9k5Y5ULX9zLIXHzV4Dpv80nm', 'Alice, as she could not taste theirs, and the great concert given by the Hatter, it woke up again with a little animal (she couldn\'t guess of what sort it was) scratching and scrambling about in a low, weak voice. \'Now, I give it up,\' Alice.', 'clay-weber'),
(31, 'Joseph', 'Prohaska', 'wmraz@gmail.com', 'https://randomuser.me/api/portraits/men/88.jpg', '$2y$13$qrU4fJCfnAZmDGzLhjrCNuhhsOyfAcBKix.9HUQfRVfbnhjri6VHm', 'MUST have meant some mischief, or else you\'d have signed your name like an arrow. The Cat\'s head began fading away the moment he was speaking, so that her shoulders were nowhere to be rude, so she went hunting about, and shouting \'Off with her.', 'joseph-prohaska'),
(32, 'Chanelle', 'Friesen', 'brennon.rodriguez@veum.org', 'https://randomuser.me/api/portraits/women/9.jpg', '$2y$13$wIvLLpSiB6s8pDTxiF25f.q1mTSwFWfA7d7fRbQSJ40alBx/AEqdW', 'Majesty?\' he asked. \'Begin at the corners: next the ten courtiers; these were all shaped like ears and whiskers, how late it\'s getting!\' She was looking at the proposal. \'Then the eleventh day must have imitated somebody else\'s hand,\' said the.', 'chanelle-friesen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_77E0ED58F675F31B` (`author_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C4F34D596` (`ad_id`),
  ADD KEY `IDX_9474526CF675F31B` (`author_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `IDX_332CA4DDD60322AC` (`role_id`),
  ADD KEY `IDX_332CA4DDA76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad`
--
ALTER TABLE `ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad`
--
ALTER TABLE `ad`
  ADD CONSTRAINT `FK_77E0ED58F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4F34D596` FOREIGN KEY (`ad_id`) REFERENCES `ad` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `FK_332CA4DDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_332CA4DDD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 04:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `game_id`, `created_at`) VALUES
(8, 9, 14, '2024-11-26 01:37:32'),
(16, 9, 15, '2024-11-28 10:08:14'),
(18, 14, 7, '2024-11-30 03:18:09'),
(21, 16, 19, '2024-12-01 04:43:54'),
(23, 16, 14, '2024-12-01 04:44:02'),
(32, 9, 2, '2024-12-02 02:08:31'),
(33, 9, 39, '2024-12-02 02:08:38'),
(34, 9, 10, '2024-12-02 02:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category` enum('Popular Games','Featured Games','New Releases','Arcade Games','PVP Games') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `description`, `rating`, `image_url`, `category`) VALUES
(1, 'Grand Theft Auto V', 'Grand Theft Auto V (GTA 5) is an open-world action-adventure game by Rockstar Games, set in the sprawling city of Los Santos and the rugged terrain of Blaine County, inspired by Southern California. Players control three protagonists—Michael, a retired criminal; Franklin, an ambitious hustler; and Trevor, an unpredictable psychopath—whose lives intersect through daring heists and criminal exploits. The game offers a vast, immersive world with diverse activities like racing, property management, and dynamic missions, alongside a rich narrative filled with humor and drama. Complemented by Grand Theft Auto Online, which features multiplayer heists, competitive modes, and role-playing opportunities, GTA 5 is celebrated for its stunning visuals, freedom of exploration, and engaging gameplay, making it a landmark in gaming history.', 0.0, 'Images/Grand_Theft_Auto_V.png', 'Arcade Games'),
(2, 'Minecraft', 'Minecraft is a sandbox video game that allows players to explore, build, and survive in a blocky, procedurally generated 3D world. Created by Mojang Studios, it offers several modes, including Survival Mode, where players gather resources, craft tools, and fend off monsters, and Creative Mode, where players have unlimited resources to unleash their imagination.', 3.0, 'Images/Minecraft.jpg', 'Popular Games'),
(3, 'The Witcher 3', 'The Witcher 3: Wild Hunt is an open-world action RPG developed by CD Projekt Red, set in a richly detailed fantasy universe inspired by Slavic mythology. Players take on the role of Geralt of Rivia, a skilled monster hunter known as a Witcher, as he searches for his missing adopted daughter, Ciri, while navigating a world at war and pursued by the ominous Wild Hunt. The game is celebrated for its deep, branching narrative, compelling characters, and morally complex choices, all woven into a vast and immersive world filled with quests, monster contracts, and hidden treasures. With its stunning visuals, dynamic combat system, and expansive DLCs, Hearts of Stone and Blood and Wine, The Witcher 3 is hailed as one of the greatest video games of all time.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 0.0, 'Images/witcher.jpg', 'Featured Games'),
(4, 'Lies of P', 'Lies of P is a dark and atmospheric action RPG developed by Neowiz Games and Round8 Studio, inspired by the classic tale of Pinocchio. Set in the haunting, Belle Époque-inspired city of Krat, players control P, a mechanical puppet, as he embarks on a perilous journey to uncover the mysteries behind a city overrun by corrupted automatons and sinister forces.\r\n\r\nThe game features challenging, Souls-like combat, offering a variety of weapon combinations, intricate skill customization, and a unique Lying System where the choices you make shape the narrative and P\'s transformation. Its gripping story, rich world-building, and emphasis on player agency have made Lies of P a standout title in the action RPG genre, blending gothic horror and moral ambiguity into a truly immersive experience.', 0.0, 'Images/lies.jpg', 'New Releases'),
(7, 'Dino', 'The Chrome Dino Game, also known as \"T-Rex Runner,\" is a hidden browser game in Google Chrome that activates when there\'s no internet connection. Players control a pixelated Tyrannosaurus rex, navigating a desert landscape and avoiding obstacles like cacti and pterodactyls by jumping or ducking. The game was introduced in 2014 to entertain users during offline periods and has since become a beloved Easter egg. It can also be accessed by typing chrome://dino in the browser\'s address bar.', 1.0, 'Images/dino.jpg', 'Popular Games'),
(8, 'Flight Simulator', 'Flight Simulator is a highly realistic flight simulation game series developed by Microsoft, offering players the chance to pilot a wide range of aircraft across an incredibly detailed and dynamic recreation of Earth. The latest installment, Microsoft Flight Simulator 2020, leverages cutting-edge technology, including satellite imagery and real-time weather data, to create an unparalleled virtual flying experience.\r\n\r\nPlayers can choose from various aircraft, from small prop planes to massive airliners, and explore diverse environments, from bustling cities to remote mountain ranges. The game features multiple modes, including free flight, flight training, and challenges like landing during adverse weather conditions.', 0.0, 'Images/flight.jpg', 'Featured Games'),
(9, 'PUBG (PlayerUnknown\'s Battlegrounds)', 'PUBG is a battle royale game where 100 players compete to be the last one standing on an island, scavenging for weapons and supplies. With shrinking safe zones, intense gameplay, and team modes, strategy and survival skills are essential to win.', 0.0, 'Images/Pubg.jpg', 'PVP Games'),
(10, 'Doom Eternal', 'Doom Eternal is a fast-paced first-person shooter developed by id Software and published by Bethesda Softworks. A sequel to Doom (2016), it continues the story of the Doom Slayer, a relentless warrior battling the demonic forces that have invaded Earth. With humanity on the brink of extinction, players embark on a brutal campaign to eradicate the hellish invaders and uncover the deeper lore of the Slayer’s origins.\r\n\r\nThe game is renowned for its high-octane combat, encouraging players to master a balance of aggression, resource management, and mobility. Its arsenal includes iconic weapons like the Super Shotgun and the BFG, alongside new tools such as the Flame Belch and the Doom Blade. Levels are intricately designed, blending intense combat arenas with platforming challenges and hidden secrets.', 3.0, 'Images/doom.jpg', 'New Releases'),
(11, 'Apex Legends', 'Apex Legends is a free-to-play battle royale and hero shooter developed by Respawn Entertainment and published by Electronic Arts. Set in the futuristic Titanfall universe, the game pits teams of three players against each other in dynamic, fast-paced matches to become the last squad standing.\r\n\r\nPlayers select from a roster of Legends, each with unique abilities that add strategic depth to the gameplay, such as healing, deploying shields, or summoning airstrikes. The game emphasizes teamwork, with mechanics like a robust ping system, revives, and synergy between Legend abilities.\r\n\r\n', 0.0, 'Images/apex.jpg', 'PVP Games'),
(12, 'Spider-Man', 'Spider-Man is a series of action-adventure games based on the iconic Marvel superhero, offering players an immersive experience as they swing through the streets of New York City and battle against famous villains. Developed by Insomniac Games, the most acclaimed installment, Marvel\'s Spider-Man (2018), and its sequel, Spider-Man: Miles Morales (2020), bring the web-slinging hero to life with stunning visuals, fluid combat, and a gripping narrative.\r\n\r\nPlayers take on the role of Peter Parker or Miles Morales, each with unique abilities and gadgets, navigating personal challenges alongside their heroic responsibilities. The games feature a richly detailed open world, dynamic combat, and stealth mechanics, allowing players to utilize Spider-Man\'s acrobatics and web-based powers.', 0.0, 'Images/spider.jpg', 'Featured Games'),
(13, 'Sekiro: Shadows Die Twice', 'by Activision, set in a dark and fantastical reimagining of late 1500s Sengoku-era Japan. Players take on the role of Wolf, a shinobi seeking to rescue his kidnapped lord and exact revenge on those who wronged him.\r\n\r\nThe game is renowned for its intense, skill-based combat, which emphasizes precision, timing, and mastery of the Posture System, where players must break enemies\' defenses to land lethal strikes. Unlike other FromSoftware titles, Sekiro introduces stealth mechanics and a grappling hook, allowing players to traverse environments vertically and engage in strategic combat.\r\n\r\n', 0.0, 'Images/sekiro.jpg', 'Featured Games'),
(14, 'Sid Meier’s Civilization VI', 'Sid Meier’s Civilization VI is a turn-based strategy game developed by Firaxis Games and published by 2K Games, where players build and lead a civilization from the dawn of history to the space age. As a leader of one of many historical civilizations, players manage resources, explore the world, develop technologies, establish diplomacy, wage wars, and strive for one of several victory conditions, such as domination, culture, science, or diplomacy.\r\n\r\nCivilization VI introduces new features, such as district-based city building, which allows cities to expand across multiple tiles, and an enhanced AI system that provides more dynamic challenges and opportunities for negotiation. The game also emphasizes historical authenticity while allowing players the freedom to rewrite history through strategic choices.\r\n\r\nPraised for its depth, replayability, and stunning visuals, Civilization VI has become a landmark in strategy gaming, appealing to both long-time fans of the series and newcomers seeking a complex and rewarding experience.', 3.0, 'Images/sid.jpg', 'Popular Games'),
(15, 'XCOM 2', 'XCOM 2 is a turn-based tactical strategy game developed by Firaxis Games and published by 2K Games. A sequel to XCOM: Enemy Unknown, the game is set in a dystopian future where Earth has been taken over by alien forces, and the once-powerful XCOM organization now operates as an underground resistance.\r\n\r\nPlayers lead a squad of soldiers in intense, high-stakes missions against alien enemies, balancing tactical combat with strategic base management. XCOM 2 introduces procedurally generated maps, dynamic mission objectives, and a greater emphasis on stealth, creating diverse and unpredictable gameplay scenarios. Soldiers can be customized with classes, skills, and equipment, but permadeath adds significant weight to every decision.', 2.0, 'Images/xcom.jpg', 'Featured Games'),
(16, 'Age of empire', 'Age of Empires is a classic real-time strategy game series developed by Ensemble Studios and published by Microsoft, celebrated for its historical settings and strategic gameplay. Players guide civilizations from the Stone Age to the Iron Age (or later, depending on the installment), gathering resources, building cities, training armies, and competing for dominance through war or economic and cultural achievements.\r\n\r\nEach game in the series features campaigns based on real-world historical events and figures, alongside skirmish and multiplayer modes for competitive play. Age of Empires II: The Age of Kings is especially iconic, focusing on medieval times and introducing diverse civilizations with unique units and technologies.', 0.0, 'Images/age.jpg', 'New Releases'),
(17, 'StarCraft II', '\r\nStarCraft II is a real-time strategy game developed and published by Blizzard Entertainment, set in a science fiction universe where three factions—the Terran, Protoss, and Zerg—clash for dominance. Released in 2010 as a sequel to the groundbreaking StarCraft, it features three campaigns: Wings of Liberty (Terran), Heart of the Swarm (Zerg), and Legacy of the Void (Protoss), each offering a deep narrative and unique gameplay mechanics.\r\n\r\nThe game is renowned for its balanced, fast-paced multiplayer, requiring strategic decision-making, resource management, and precise micromanagement of units. Each faction has distinct strengths, weaknesses, and playstyles, making competitive matches dynamic and unpredictable.', 0.0, 'Images/starc.jpg', 'Featured Games'),
(18, 'Total War: Three Kingdoms', 'Total War: Three Kingdoms is a turn-based strategy and real-time tactics game developed by Creative Assembly and published by Sega, set in ancient China during the turbulent Three Kingdoms period (190–280 AD). Players choose one of several warlords, including historical figures like Cao Cao, Liu Bei, and Sun Jian, aiming to unify China through diplomacy, intrigue, and warfare.\r\n\r\nThe game features a dual-layered gameplay system: a turn-based campaign where players manage their empire, form alliances, and make strategic decisions, and real-time battles where large armies clash in visually stunning engagements. The guanxi system adds depth by emphasizing relationships between characters, with loyalty and personal rivalries influencing gameplay.', 0.0, 'Images/total.jpg', 'New Releases'),
(19, 'Elden Ring', '\r\nElden Ring is an action role-playing game developed by FromSoftware and published by Bandai Namco Entertainment. Directed by Hidetaka Miyazaki, with world-building contributions by fantasy author George R.R. Martin, the game is set in the sprawling and darkly fantastical world of the Lands Between. Players take on the role of a Tarnished, exiled warriors seeking to repair the shattered Elden Ring and ascend as the new ruler.\r\n\r\nThe game blends Souls-like combat with a massive open world, featuring six distinct regions filled with secrets, dungeons, and colossal bosses. Its hallmark difficulty challenges players to master its combat system, explore at their own pace, and piece together the cryptic story through environmental storytelling and NPC interactions.\r\n\r\nPraised for its expansive design, freedom of exploration, and deeply rewarding gameplay, Elden Ring has been hailed as a masterpiece of modern gaming, offering a perfect balance of challenge, mystery, and discovery.', 3.0, 'Images/ring.jpg', 'Popular Games'),
(20, 'Final Fantasy XV', 'Final Fantasy XV is an action role-playing game developed and published by Square Enix, set in the richly detailed world of Eos, a blend of fantasy and modern technology. Players follow the journey of Prince Noctis and his loyal companions—Gladiolus, Ignis, and Prompto—as they set out to reclaim Noctis’s kingdom from the invading empire of Niflheim and fulfill his destiny.\r\n\r\nThe game features an open-world design with expansive environments, real-time combat, and a dynamic day-night cycle. Its innovative Warp Strike mechanic and seamless team-based combat system create a fast-paced and cinematic gameplay experience. Players can engage in diverse activities like cooking, fishing, and chocobo riding, enhancing the immersive world.\r\n\r\nKnown for its stunning visuals, emotional storytelling, and epic soundtrack by Yoko Shimomura, Final Fantasy XV is both a tribute to the series\' legacy and a bold step forward, resonating with both longtime fans and newcomers.', 0.0, 'Images/final.jpg', 'Popular Games'),
(21, 'Mass Effect Legendary Edition\r\n\r\n', 'A remastered collection of the original Mass Effect trilogy, following Commander Shepard’s journey to save the galaxy from an ancient threat. Includes enhanced graphics, gameplay improvements, and all DLC.', 0.0, 'Images/mass.jpg', 'Arcade Games'),
(22, 'Persona 5', 'A turn-based RPG that follows a group of high school students with the ability to enter an alternate realm where they fight creatures and challenge societal corruption.', 0.0, 'Images/persona.jpg', 'New Releases'),
(24, 'Dragon Age: Inquisition', 'An open-world RPG where players control the Inquisitor, tasked with closing a mysterious rift that threatens to destroy the world. The game features rich storytelling, character-driven decisions, and tactical combat.', 0.0, 'Images/dragonage.jpg', 'New Releases'),
(25, 'Alan Wake 2\r\n', 'Dive into the hauntingly atmospheric world of Alan Wake 2, a survival horror masterpiece blending psychological thrills with intricate storytelling. Players follow Alan Wake, a troubled author trying to escape a nightmarish alternate reality, while navigating dual narratives with FBI agent Saga Anderson. With its stunning visuals, gripping plot twists, and challenging gameplay, the game masterfully immerses you in its eerie environment where every decision feels weighty.', 2.0, 'Images/alan.jpg', 'New Releases'),
(26, 'Assassin’s Creed Mirage\r\n', 'Rediscover the roots of the Assassin’s Creed franchise in Mirage. Set in a meticulously crafted 9th-century Baghdad, the game focuses on stealth, parkour, and thrilling assassinations. Play as Basim, a cunning street thief turned master assassin, as you unravel a story of betrayal, loyalty, and revenge. Featuring a condensed open world and classic mechanics, this entry delivers a nostalgic yet fresh experience for fans of the series.', NULL, 'Images/assasign.jpg', 'New Releases'),
(27, 'Starfield', 'Embark on an epic journey across the stars in Starfield, Bethesda’s groundbreaking RPG. Explore over 1,000 planets, form alliances, and craft your destiny in an expansive universe filled with diverse cultures, quests, and mysteries. With unparalleled freedom to build ships, gather resources, and engage in space battles, Starfield redefines sci-fi gaming by offering a richly immersive world that caters to every kind of player.\r\n\r\n', NULL, 'Images/starfield.jpg', 'New Releases'),
(28, 'Super Mario Bros. Wonder\r\n', 'Experience a whimsical evolution of the beloved platformer in Super Mario Bros. Wonder. With imaginative new mechanics like Wonder Flowers, dynamic power-ups, and co-op multiplayer, this game breathes fresh life into the Mushroom Kingdom. Each level bursts with creativity, offering surprises and challenges that will captivate players of all ages.', NULL, 'Images/mario.jpg', 'New Releases'),
(29, 'Forza Motorsport (2023)\r\n', 'Feel the thrill of the race in the latest installment of the Forza Motorsport series. With stunningly realistic graphics, advanced AI opponents, and finely tuned driving mechanics, this game offers the ultimate racing simulation experience. Whether competing online or customizing your dream car in the single-player mode, Forza Motorsport pushes the boundaries of what a racing game can achieve.\r\n\r\n', NULL, 'Images/forza.png', 'New Releases'),
(30, 'League of Legends\r\n', 'One of the most popular multiplayer online battle arenas (MOBA), League of Legends pits two teams of five players in a fast-paced, strategy-driven contest. With over 160 champions to master, each boasting unique abilities and roles, the game demands teamwork, quick thinking, and skill. Whether climbing the competitive ladder or enjoying casual matches, League of Legends delivers endless replayability.', NULL, 'Images/league.jpg', 'PVP Games'),
(31, 'Valorant', 'Combining precise gunplay with tactical abilities, Valorant is a high-stakes 5v5 first-person shooter that rewards skill and teamwork. Players choose from a roster of agents, each with unique powers that complement strategic gameplay. With regular updates and a thriving eSports scene, Valorant has become a favorite among competitive FPS fans.', NULL, 'Images/val.jpg', 'PVP Games'),
(32, 'Overwatch 2\r\n', 'Step into a vibrant, team-based FPS where heroes with unique skills and abilities battle in high-energy matches. In Overwatch 2, you can explore revamped maps, new game modes, and updated graphics while coordinating strategies with your team to achieve victory. The game is celebrated for its rich lore, diverse character roster, and dynamic gameplay.', NULL, 'Images/over.jpg', 'PVP Games'),
(33, 'Dota 2', 'A pillar of the MOBA genre, Dota 2 offers a deep and complex experience where two teams of five clash in strategic battles. Players control heroes with unique skills, striving to outmaneuver opponents and destroy their ancient. Known for its steep learning curve and massive eSports events, Dota 2 remains a staple in competitive gaming.', NULL, 'Images/dota.png', 'PVP Games'),
(34, 'Mortal Kombat 1 (2023)', 'The legendary fighting franchise reinvents itself with Mortal Kombat 1, introducing a reimagined universe, stunning visuals, and brutal combat mechanics. Players can master iconic fighters and experience an engrossing story mode while unleashing devastating combos and finishing moves in both casual and ranked PvP matches.', NULL, 'Images/mortal.jpg', 'PVP Games'),
(35, 'Hogwarts Legacy', 'Enter the magical world of Harry Potter like never before in Hogwarts Legacy. Set in the 1800s, this action RPG allows players to live out their wizarding dreams as they explore Hogwarts, brew potions, and cast spells. With a richly detailed open world and a storyline shaped by your decisions, this game offers an unforgettable journey through the wizarding world.', NULL, 'Images/hog.jpg', 'Popular Games'),
(36, 'Cyberpunk 2077: Phantom Liberty', 'The Phantom Liberty expansion takes Cyberpunk 2077 to new heights with a gripping spy-thriller narrative and polished gameplay. Players step into the role of V, navigating the perilous streets of Dogtown to uncover secrets and make alliances in a world filled with danger and intrigue. Enhanced mechanics and new features make this expansion a standout.', NULL, 'Images/cyber.jpg', 'Popular Games'),
(37, 'Call of Duty: Modern Warfare II (2022)', 'A reinvention of the iconic FPS series, Modern Warfare II delivers intense single-player missions and a robust multiplayer experience. With stunning graphics, immersive combat, and an ever-evolving Warzone mode, it sets a new standard for the franchise.', NULL, 'Images/cod.jpg', 'Popular Games'),
(38, 'The Legend of Zelda: Tears of the Kingdom\r\n', 'A breathtaking sequel to Breath of the Wild, this game expands on the open-world exploration and puzzle-solving that defined its predecessor. With new abilities, vehicles, and floating islands to explore, Tears of the Kingdom offers an awe-inspiring adventure through the vast world of Hyrule.', NULL, 'Images/zelda.jpg', 'Popular Games'),
(39, 'Red Dead Redemption 2', 'Step into the boots of Arthur Morgan, an outlaw grappling with loyalty and survival in the fading days of the Wild West. With its cinematic storytelling, breathtaking visuals, and deep open-world gameplay, Red Dead Redemption 2 is a landmark in gaming history.\r\n\r\n', NULL, 'Images/rdr.jpg', 'Popular Games'),
(40, 'Hades II\r\n', 'The sequel to the critically acclaimed Hades promises more action-packed combat, a deeper connection to Greek mythology, and new gods to encounter. With its unique roguelike mechanics, players can dive into a beautifully crafted underworld teeming with danger and discovery.', NULL, 'Images/hades2.jpg', 'Featured Games'),
(41, 'Baldur’s Gate 3\r\n', 'A masterpiece RPG that brings the rich world of Dungeons & Dragons to life. With intricate character creation, tactical combat, and a branching storyline shaped by player choices, Baldur’s Gate 3 offers an unparalleled role-playing experience.', NULL, 'Images/baldur.jpg', 'Featured Games'),
(42, 'Diablo IV', 'Return to the dark and gothic world of Sanctuary in Diablo IV. Featuring an expansive open world, visceral combat, and a compelling story centered around the demon Lilith, this action RPG captivates players with its addictive gameplay and deep customization.\r\n\r\n', NULL, 'Images/diablo.png', 'Featured Games'),
(43, 'Stardew Valley', 'A charming life-simulation game where players cultivate farms, forge friendships, and uncover secrets in a peaceful rural community. With its endless possibilities and relaxing atmosphere, Stardew Valley has captured the hearts of millions worldwide.', NULL, 'Images/stardrew.png', 'Featured Games'),
(44, 'Returnal', 'A sci-fi roguelike where players control Selene, a space explorer trapped in an alien world with an endless time loop. Featuring fast-paced combat, haunting visuals, and a mysterious story, Returnal challenges players to adapt and survive through ever-changing environments.\r\n\r\n', NULL, 'Images/returnal.jpg', 'Featured Games'),
(45, 'Cuphead', 'A stunningly animated platformer inspired by 1930s cartoons. Players control Cuphead and Mugman as they take on challenging boss battles in a visually captivating world filled with quirky characters and tight gameplay mechanics.', NULL, 'Images/cup.jpg', 'Arcade Games'),
(46, 'Geometry Dash', 'A fast-paced, rhythm-based platformer where precision and timing are key. Navigate through challenging levels filled with spikes, traps, and vibrant visuals, all set to an energetic soundtrack.', NULL, 'Images/geometry.jpg', 'Arcade Games'),
(47, 'Pac-Man Championship Edition DX', 'A modern reimagining of the classic arcade game, featuring neon-soaked mazes, fast-paced gameplay, and exciting new modes. Pac-Man Championship Edition DX keeps the iconic formula fresh for a new generation.', NULL, 'Images/pacman.jpg', 'Arcade Games'),
(48, 'Tetris Effect: Connected', 'This reimagined classic combines the addictive mechanics of Tetris with stunning visuals and a reactive soundtrack. The multiplayer mode allows players to compete or collaborate in an experience that is as relaxing as it is competitive.', NULL, 'Images/tetris.jpg', 'Arcade Games'),
(49, 'Super Bomberman R 2', 'The latest installment in the Bomberman series brings chaotic multiplayer action and inventive new modes. Use strategy and explosive power to outwit opponents in dynamic arenas filled with surprises.', NULL, 'Images/super.jpg', 'Arcade Games');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `game_id`, `user_id`, `rating`, `created_at`) VALUES
(7, 14, 15, 5, '2024-12-01 03:59:53'),
(8, 14, 9, 1, '2024-12-01 04:00:13'),
(9, 2, 9, 1, '2024-12-01 04:36:51'),
(10, 2, 17, 5, '2024-12-01 05:58:16'),
(11, 19, 9, 3, '2024-12-02 01:36:52'),
(20, 7, 9, 1, '2024-12-02 02:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `game_id`, `user_id`, `username`, `comment`, `created_at`) VALUES
(10, 14, 15, 'Smriti', 'Good', '2024-12-01 04:00:30'),
(11, 7, 16, 'Aman', 'vv fun', '2024-12-01 04:44:19'),
(12, 2, 9, 'Premesh', 'Good Games for kids', '2024-12-01 04:44:45'),
(13, 14, 9, 'Premesh', 'good', '2024-12-02 02:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(9, 'Premesh', 'Wasti', 'admin@gmail.com', '$2y$10$FnvDzmFRTAwAuN5.x2nsR.mGYGanBj95spQRdK4N9OZ/FTFQj75HW'),
(14, 'Aman', 'Yadav', 'root@gmail.com', '$2y$10$Ne3Ii9EOrxYMq/pKaiTD1e2ZxeNB8t0WaPNbwymv.xb21hK8VxEnq'),
(15, 'Smriti', 'Shrestha', 'ishmriti225@gmail.com', '$2y$10$uZeW38Ye5fJxsi7LmTe2vuJ2XQuvUvrlGxzA2NhqsjhbihUFc0ppa'),
(16, 'Aman', 'yadav', 'aamanyadav61@gmail.com', '$2y$10$Lzh769c4ZB4Is3daIXni3u3FMGCr0GhCYo.uxaJOyjDftMIBTwi8i'),
(17, 'Snorlx', 'xD', 'snorlx@gmail.com', '$2y$10$/lLDEUc5TCNDpzsiKra/7.Cm0RLSzoRohCLyeTePedfSyq07hIPK2'),
(18, 'Snorlx', 'xD', 'man@gmail.com', '$2y$10$Psqf4POfyEQRuq22Lv.2Z.qxbRD.Z5fHKvrv5kKe3Y3H.lqeyURwq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `game_id` (`game_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

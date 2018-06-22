-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 22 Cze 2018, 13:36
-- Wersja serwera: 5.7.22-0ubuntu0.16.04.1
-- Wersja PHP: 7.2.6-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `testy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `article`
--

INSERT INTO `article` (`id`, `title`, `body`, `user_id`) VALUES
(3, 'Super artykuł', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar egestas augue, nec faucibus urna cursus sit amet. Nunc suscipit nulla nunc, sit amet luctus quam vulputate nec. Suspendisse pellentesque nulla id tortor ullamcorper, eget egestas nulla accumsan. Praesent sodales, nisl a sagittis condimentum, urna purus viverra elit, et tempus lectus metus aliquam felis. Quisque ex ante, pulvinar non enim a, mollis mattis nunc. Proin ac libero fringilla, vestibulum eros vitae, dictum neque. Phasellus elementum ex dui, ut vulputate ante volutpat dictum. Nullam dapibus, nibh fringilla sagittis scelerisque, libero tellus finibus dolor, ac tincidunt leo nunc nec ante. Phasellus aliquam congue condimentum. Vivamus vel molestie lorem. Sed mollis, augue nec eleifend luctus, quam enim eleifend velit, vitae euismod felis libero eleifend dui. Sed luctus in elit ac aliquet. Morbi congue bibendum libero pharetra aliquam.\r\n\r\nAenean imperdiet molestie commodo. Fusce efficitur pharetra sem, vitae condimentum massa. Curabitur at est rutrum, dignissim nulla et, lacinia quam. Quisque nulla leo, facilisis id ante nec, cursus laoreet erat. Maecenas pulvinar, orci eget laoreet vulputate, lacus justo accumsan libero, condimentum viverra est elit rutrum neque. Etiam id massa lacinia, hendrerit ipsum et, gravida mi. Praesent nec massa accumsan urna porttitor interdum non vitae felis. Nam pellentesque diam at aliquet accumsan. Maecenas tempor odio at bibendum tincidunt. Fusce imperdiet nulla quis sem commodo dapibus. Suspendisse bibendum, augue sit amet facilisis tempus, nisi nunc lacinia nulla, nec facilisis ex nibh sed ipsum. Nulla mollis bibendum vehicula. Mauris eleifend rhoncus fringilla. Mauris tellus leo, vulputate a pretium sit amet, sollicitudin sit amet nulla. Vivamus sit amet elit vel diam placerat tempus.\r\n\r\nProin eleifend metus sed felis rhoncus fermentum. Sed porta, turpis ultricies vulputate tempor, elit erat elementum risus, id elementum eros ex vel tellus. Vivamus consequat, ipsum sed fermentum cursus, metus neque tempus leo, et pharetra justo orci in enim. Donec ullamcorper, ante sed semper pulvinar, tellus purus interdum nisl, sed facilisis elit velit sit amet nunc. Sed eget lorem dapibus, venenatis turpis quis, varius massa. Sed sapien dui, convallis vel sem eu, vulputate dictum mauris. Ut tincidunt enim sed ex congue convallis. Aliquam at ex at mi dapibus condimentum posuere eget ex. Cras vestibulum felis eget massa scelerisque faucibus ut id sapien. Curabitur a sodales libero.', 1),
(4, 'To jest inny artykuł admina', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar egestas augue, nec faucibus urna cursus sit amet. Nunc suscipit nulla nunc, sit amet luctus quam vulputate nec. Suspendisse pellentesque nulla id tortor ullamcorper, eget egestas nulla accumsan. Praesent sodales, nisl a sagittis condimentum, urna purus viverra elit, et tempus lectus metus aliquam felis. Quisque ex ante, pulvinar non enim a, mollis mattis nunc. Proin ac libero fringilla, vestibulum eros vitae, dictum neque. Phasellus elementum ex dui, ut vulputate ante volutpat dictum. Nullam dapibus, nibh fringilla sagittis scelerisque, libero tellus finibus dolor, ac tincidunt leo nunc nec ante. Phasellus aliquam congue condimentum. Vivamus vel molestie lorem. Sed mollis, augue nec eleifend luctus, quam enim eleifend velit, vitae euismod felis libero eleifend dui. Sed luctus in elit ac aliquet. Morbi congue bibendum libero pharetra aliquam.\r\n\r\nAenean imperdiet molestie commodo. Fusce efficitur pharetra sem, vitae condimentum massa. Curabitur at est rutrum, dignissim nulla et, lacinia quam. Quisque nulla leo, facilisis id ante nec, cursus laoreet erat. Maecenas pulvinar, orci eget laoreet vulputate, lacus justo accumsan libero, condimentum viverra est elit rutrum neque. Etiam id massa lacinia, hendrerit ipsum et, gravida mi. Praesent nec massa accumsan urna porttitor interdum non vitae felis. Nam pellentesque diam at aliquet accumsan. Maecenas tempor odio at bibendum tincidunt. Fusce imperdiet nulla quis sem commodo dapibus. Suspendisse bibendum, augue sit amet facilisis tempus, nisi nunc lacinia nulla, nec facilisis ex nibh sed ipsum. Nulla mollis bibendum vehicula. Mauris eleifend rhoncus fringilla. Mauris tellus leo, vulputate a pretium sit amet, sollicitudin sit amet nulla. Vivamus sit amet elit vel diam placerat tempus.\r\n\r\nProin eleifend metus sed felis rhoncus fermentum. Sed porta, turpis ultricies vulputate tempor, elit erat elementum risus, id elementum eros ex vel tellus. Vivamus consequat, ipsum sed fermentum cursus, metus neque tempus leo, et pharetra justo orci in enim. Donec ullamcorper, ante sed semper pulvinar, tellus purus interdum nisl, sed facilisis elit velit sit amet nunc. Sed eget lorem dapibus, venenatis turpis quis, varius massa. Sed sapien dui, convallis vel sem eu, vulputate dictum mauris. Ut tincidunt enim sed ex congue convallis. Aliquam at ex at mi dapibus condimentum posuere eget ex. Cras vestibulum felis eget massa scelerisque faucibus ut id sapien. Curabitur a sodales libero.', 1),
(8, 'Artykuł użytkownika', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar egestas augue, nec faucibus urna cursus sit amet. Nunc suscipit nulla nunc, sit amet luctus quam vulputate nec. Suspendisse pellentesque nulla id tortor ullamcorper, eget egestas nulla accumsan. Praesent sodales, nisl a sagittis condimentum, urna purus viverra elit, et tempus lectus metus aliquam felis. Quisque ex ante, pulvinar non enim a, mollis mattis nunc. Proin ac libero fringilla, vestibulum eros vitae, dictum neque. Phasellus elementum ex dui, ut vulputate ante volutpat dictum. Nullam dapibus, nibh fringilla sagittis scelerisque, libero tellus finibus dolor, ac tincidunt leo nunc nec ante. Phasellus aliquam congue condimentum. Vivamus vel molestie lorem. Sed mollis, augue nec eleifend luctus, quam enim eleifend velit, vitae euismod felis libero eleifend dui. Sed luctus in elit ac aliquet. Morbi congue bibendum libero pharetra aliquam.\r\n\r\nAenean imperdiet molestie commodo. Fusce efficitur pharetra sem, vitae condimentum massa. Curabitur at est rutrum, dignissim nulla et, lacinia quam. Quisque nulla leo, facilisis id ante nec, cursus laoreet erat. Maecenas pulvinar, orci eget laoreet vulputate, lacus justo accumsan libero, condimentum viverra est elit rutrum neque. Etiam id massa lacinia, hendrerit ipsum et, gravida mi. Praesent nec massa accumsan urna porttitor interdum non vitae felis. Nam pellentesque diam at aliquet accumsan. Maecenas tempor odio at bibendum tincidunt. Fusce imperdiet nulla quis sem commodo dapibus. Suspendisse bibendum, augue sit amet facilisis tempus, nisi nunc lacinia nulla, nec facilisis ex nibh sed ipsum. Nulla mollis bibendum vehicula. Mauris eleifend rhoncus fringilla. Mauris tellus leo, vulputate a pretium sit amet, sollicitudin sit amet nulla. Vivamus sit amet elit vel diam placerat tempus.\r\n\r\nProin eleifend metus sed felis rhoncus fermentum. Sed porta, turpis ultricies vulputate tempor, elit erat elementum risus, id elementum eros ex vel tellus. Vivamus consequat, ipsum sed fermentum cursus, metus neque tempus leo, et pharetra justo orci in enim. Donec ullamcorper, ante sed semper pulvinar, tellus purus interdum nisl, sed facilisis elit velit sit amet nunc. Sed eget lorem dapibus, venenatis turpis quis, varius massa. Sed sapien dui, convallis vel sem eu, vulputate dictum mauris. Ut tincidunt enim sed ex congue convallis. Aliquam at ex at mi dapibus condimentum posuere eget ex. Cras vestibulum felis eget massa scelerisque faucibus ut id sapien. Curabitur a sodales libero.', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `roles`) VALUES
(1, 'admin', 'admin', 'a:2:{i:0;s:5:"admin";i:1;s:4:"user";}'),
(2, 'user', 'user', 'a:1:{i:0;s:4:"user";}');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E66A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

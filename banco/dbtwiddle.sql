-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 23/04/2024 às 16:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbtwiddle`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblikes`
--

CREATE TABLE `tblikes` (
  `id` int(11) NOT NULL,
  `codPost` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tblikes`
--

INSERT INTO `tblikes` (`id`, `codPost`, `username`) VALUES
(15, 98, 'Jessé Barbosa'),
(16, 98, 'Lauane Dioly');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbposts`
--

CREATE TABLE `tbposts` (
  `codPost` int(11) NOT NULL,
  `textPost` text DEFAULT NULL,
  `autor` varchar(255) NOT NULL,
  `dataPost` timestamp NOT NULL DEFAULT current_timestamp(),
  `likePost` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tbposts`
--

INSERT INTO `tbposts` (`codPost`, `textPost`, `autor`, `dataPost`, `likePost`) VALUES
(98, 'Bom dia!!', 'Jessé Barbosa', '2024-04-23 14:41:08', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusers`
--

CREATE TABLE `tbusers` (
  `codUser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tbusers`
--

INSERT INTO `tbusers` (`codUser`, `username`, `password`, `bio`) VALUES
(1, 'Jessé Barbosa', '1234', 'Opa, seja bem vindo!\r\nTenho 15 anos e atualmente vivo no Brasil.\r\nEstudante de programação Web no Senac MG'),
(5, 'Lauane Dioly', '1234', 'Olá!');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tblikes`
--
ALTER TABLE `tblikes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`codPost`,`username`),
  ADD KEY `username` (`username`);

--
-- Índices de tabela `tbposts`
--
ALTER TABLE `tbposts`
  ADD PRIMARY KEY (`codPost`);

--
-- Índices de tabela `tbusers`
--
ALTER TABLE `tbusers`
  ADD PRIMARY KEY (`codUser`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tblikes`
--
ALTER TABLE `tblikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tbposts`
--
ALTER TABLE `tbposts`
  MODIFY `codPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de tabela `tbusers`
--
ALTER TABLE `tbusers`
  MODIFY `codUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tblikes`
--
ALTER TABLE `tblikes`
  ADD CONSTRAINT `tblikes_ibfk_1` FOREIGN KEY (`codPost`) REFERENCES `tbposts` (`codPost`),
  ADD CONSTRAINT `tblikes_ibfk_2` FOREIGN KEY (`username`) REFERENCES `tbusers` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Jun-2020 às 03:06
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sara`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ambiente`
--

CREATE TABLE `ambiente` (
  `ambiente_id` char(13) NOT NULL,
  `ambiente_nome` varchar(50) NOT NULL,
  `ambiente_numero` varchar(4) NOT NULL,
  `tipo_ambiente_id` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hierarquia`
--

CREATE TABLE `hierarquia` (
  `hierarquia_nome` varchar(20) NOT NULL,
  `hierarquia_descricao` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `reserva_id` char(13) NOT NULL,
  `ambiente_id` char(13) NOT NULL,
  `usuario_id` char(13) NOT NULL,
  `reserva_inicio` datetime NOT NULL,
  `reserva_fim` datetime NOT NULL,
  `reserva_cor` varchar(10) NOT NULL,
  `reserva_repeticoes` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_ambiente`
--

CREATE TABLE `tipo_ambiente` (
  `tipo` char(13) NOT NULL,
  `tipo_ambiente_nome` varchar(50) NOT NULL,
  `tipo_ambiente_descricao` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` char(13) NOT NULL,
  `usuario_nome` varchar(50) NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `usuario_senha` char(32) NOT NULL,
  `hierarquia_nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`ambiente_id`),
  ADD KEY `tipo_ambi_fk` (`tipo_ambiente_id`);

--
-- Índices para tabela `hierarquia`
--
ALTER TABLE `hierarquia`
  ADD PRIMARY KEY (`hierarquia_nome`);

--
-- Índices para tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`reserva_id`),
  ADD KEY `ambiente_fk` (`ambiente_id`),
  ADD KEY `usuario_fk` (`usuario_id`);

--
-- Índices para tabela `tipo_ambiente`
--
ALTER TABLE `tipo_ambiente`
  ADD PRIMARY KEY (`tipo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `hierarquia_fk` (`hierarquia_nome`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ambiente`
--
ALTER TABLE `ambiente`
  ADD CONSTRAINT `tipo_ambi_fk` FOREIGN KEY (`tipo_ambiente_id`) REFERENCES `tipo_ambiente` (`tipo`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `ambiente_fk` FOREIGN KEY (`ambiente_id`) REFERENCES `ambiente` (`ambiente_id`),
  ADD CONSTRAINT `usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `hierarquia_fk` FOREIGN KEY (`hierarquia_nome`) REFERENCES `hierarquia` (`hierarquia_nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jul-2020 às 13:08
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
  `ambiente_ativo` char(3) NOT NULL DEFAULT 'sim',
  `tipo_ambiente_id` char(13) NOT NULL,
  `predio_id` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ambiente`
--

INSERT INTO `ambiente` (`ambiente_id`, `ambiente_nome`, `ambiente_numero`, `ambiente_ativo`, `tipo_ambiente_id`, `predio_id`) VALUES
('5ee11b4721c7c', 'Sala 201', '201', 'não', '123456789123', '123456789123'),
('5ee3bf799398b', 'Mini auditório', '101', 'não', '123456789124', '123456789123'),
('5ee3bf9c20e64', 'Salão social', '000', 'sim', '123456789124', '45645645645'),
('5ee3bfbab41a0', 'Lab 201', '201', 'sim', '123456789125', '123456789123'),
('5ee3bfcd1f61c', 'Sala 302', '302', 'sim', '123456789123', '123456789123'),
('5ee3bfdebfc8f', 'Lab 204', '204', 'sim', '123456789125', '123456789123'),
('5ee3bfef77898', 'Lab de Biologia', '000', 'sim', '123456789126', '45645645645'),
('5ee3c00b15815', 'Lab de hardware', '202', 'sim', '123456789125', '123456789123'),
('5ee3c0150a196', 'Lab de redes', '301', 'sim', '123456789125', '123456789123'),
('5f11d21b088a8', 'Sala 302', '302', 'sim', '123456789123', '123456789123'),
('5f11d2b708760', 'Sala 104', '104', 'sim', '123456789123', '123456789123'),
('5f18857c3a881', 'sala teste mudnaça', '1312', 'não', '123456789124', '45645645645'),
('5f1e15ef87f65', 'Sala 104', '104', 'sim', '123456789123', '5f1e15de3d844');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hierarquia`
--

CREATE TABLE `hierarquia` (
  `hierarquia_nome` varchar(20) NOT NULL,
  `hierarquia_descricao` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `hierarquia`
--

INSERT INTO `hierarquia` (`hierarquia_nome`, `hierarquia_descricao`) VALUES
('admin', 'administrador do sistema'),
('agente', 'Agente de portaria'),
('professor', 'Professor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `predio`
--

CREATE TABLE `predio` (
  `predio_id` char(13) NOT NULL,
  `predio_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `predio`
--

INSERT INTO `predio` (`predio_id`, `predio_nome`) VALUES
('123456789123', 'Prédio da TI'),
('45645645645', 'Prédio Central'),
('5f1e15de3d844', 'Prédio da Veterinária');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `reserva_id` char(13) NOT NULL,
  `ambiente_id` char(13) NOT NULL,
  `reservista_id` char(13) NOT NULL,
  `agente_id` char(13) NOT NULL,
  `reserva_inicio` datetime NOT NULL,
  `reserva_fim` datetime NOT NULL,
  `reserva_cor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`reserva_id`, `ambiente_id`, `reservista_id`, `agente_id`, `reserva_inicio`, `reserva_fim`, `reserva_cor`) VALUES
('1234567891234', '5ee3bf9c20e64', '5ee378e59e95d', 'gfed34567123', '2020-06-24 15:51:51', '2020-06-24 18:50:19', '#0373fc'),
('5efd0e98b4698', '5ee11b4721c7c', '5ee378e59e95d', '5ee37ae176a04', '2020-07-01 14:29:00', '2020-07-01 16:29:00', '#40E0D0'),
('5efd0f31eaafd', '5ee3bfdebfc8f', '5ef161491fa97', '5ee37ae176a04', '2020-07-01 13:33:00', '2020-07-01 13:33:00', '#0071c5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_ambiente`
--

CREATE TABLE `tipo_ambiente` (
  `tipo` char(13) NOT NULL,
  `tipo_ambiente_nome` varchar(50) NOT NULL,
  `tipo_ambiente_descricao` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_ambiente`
--

INSERT INTO `tipo_ambiente` (`tipo`, `tipo_ambiente_nome`, `tipo_ambiente_descricao`) VALUES
('123456789123', 'Sala de aula', 'sala de aula comum'),
('123456789124', 'Auditório', 'auditórios para apresentações ou reuniões'),
('123456789125', 'Laboratório de Informática', 'laboratório para uso de computadores'),
('123456789126', 'Laboratório', 'Laboratórios de ciências em geral');

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
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nome`, `usuario_email`, `usuario_senha`, `hierarquia_nome`) VALUES
('5ee378e59e95d', 'Bruno Batista Boniati', 'bruno@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'professor'),
('5ee3795321ace', 'Maria de Lourdes', 'maria@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'agente'),
('5ee3798ed3251', 'Jonas Tadeu', 'jonas@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
('5ee37ae176a04', 'Ana Maria Braga', 'ana@globo.com', 'e10adc3949ba59abbe56e057f20f883e', 'agente'),
('5ef161491fa97', 'Mateus Henrique Dalforno', 'mateus.dalforno@iffarroupilha.edu.br', 'e10adc3949ba59abbe56e057f20f883e', 'professor'),
('5f10eb46813c8', 'Rodrigo Poglia', 'rodrigo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'professor'),
('gfed34567123', 'João Danilo Zucolotto', 'jddiedrich@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`ambiente_id`),
  ADD KEY `tipo_ambi_fk` (`tipo_ambiente_id`),
  ADD KEY `predio_fk` (`predio_id`);

--
-- Índices para tabela `hierarquia`
--
ALTER TABLE `hierarquia`
  ADD PRIMARY KEY (`hierarquia_nome`);

--
-- Índices para tabela `predio`
--
ALTER TABLE `predio`
  ADD PRIMARY KEY (`predio_id`);

--
-- Índices para tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`reserva_id`),
  ADD KEY `ambiente_fk` (`ambiente_id`),
  ADD KEY `reservista_fk` (`reservista_id`),
  ADD KEY `agente_fk` (`agente_id`);

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
  ADD CONSTRAINT `predio_fk` FOREIGN KEY (`predio_id`) REFERENCES `predio` (`predio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `agente_fk` FOREIGN KEY (`agente_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `ambiente_fk` FOREIGN KEY (`ambiente_id`) REFERENCES `ambiente` (`ambiente_id`),
  ADD CONSTRAINT `reservista_fk` FOREIGN KEY (`reservista_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `hierarquia_fk` FOREIGN KEY (`hierarquia_nome`) REFERENCES `hierarquia` (`hierarquia_nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

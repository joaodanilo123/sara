-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Jun-2020 às 00:58
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
-- Erro ao ler a estrutura para a tabela sara.ambiente: #1932 - Table 'sara.ambiente' doesn't exist in engine
-- Erro ao ler dados para tabela sara.ambiente: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `sara`.`ambiente`' na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `hierarquia`
--
-- Erro ao ler a estrutura para a tabela sara.hierarquia: #1932 - Table 'sara.hierarquia' doesn't exist in engine
-- Erro ao ler dados para tabela sara.hierarquia: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `sara`.`hierarquia`' na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--
-- Erro ao ler a estrutura para a tabela sara.reserva: #1932 - Table 'sara.reserva' doesn't exist in engine
-- Erro ao ler dados para tabela sara.reserva: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `sara`.`reserva`' na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_ambiente`
--

CREATE TABLE `tipo_ambiente` (
  `tipo_ambiente_id` char(13) NOT NULL,
  `tipo_ambiente_nome` varchar(50) NOT NULL,
  `tipo_ambiente_descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_ambiente`
--

INSERT INTO `tipo_ambiente` (`tipo_ambiente_id`, `tipo_ambiente_nome`, `tipo_ambiente_descricao`) VALUES
('tipoambient', 'Sala de aula', 'Sala de aula porque sim'),
('98765432100', 'Laboratório de Informática', 'Sala com computadores para uso em atividades acadêmicas ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--
-- Erro ao ler a estrutura para a tabela sara.usuario: #1932 - Table 'sara.usuario' doesn't exist in engine
-- Erro ao ler dados para tabela sara.usuario: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `sara`.`usuario`' na linha 1
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

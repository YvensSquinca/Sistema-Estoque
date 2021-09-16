-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Ago-2021 às 18:46
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemaestoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `quantidade`) VALUES
(1, 'Teclado USB', 91),
(2, 'Mouse USB', 55),
(3, 'HeadSet USB', 12),
(4, 'HeadSet RJ11', 23),
(5, 'Fonte ATX', 57),
(6, 'Fonte HP', 0),
(7, 'Fonte Positivo (All in One)', 7),
(8, 'Fonte Dell', 30),
(9, 'Fonte Samsung', 0),
(10, 'HD 2.5 500Gb', 9),
(11, 'HD 3.5 320Gb', 1),
(12, 'HD 3.5 500Gb', 25),
(13, 'Memoria DDR3', 0),
(14, 'Memoria DDR3L', 0),
(15, 'Monitor', 17),
(16, 'Lacre', 100),
(17, 'Cabo de Rede UTP 3M', 25),
(18, 'Cabo de Rede UTP 10M', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio`
--

CREATE TABLE `relatorio` (
  `id` int(11) NOT NULL,
  `item` varchar(80) DEFAULT NULL,
  `motivo` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `chamado` int(11) DEFAULT NULL,
  `local` varchar(20) DEFAULT NULL,
  `solicitante` varchar(100) DEFAULT NULL,
  `tecnico` varchar(20) DEFAULT NULL,
  `dataregistro` datetime DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `relatorio`
--

INSERT INTO `relatorio` (`id`, `item`, `motivo`, `chamado`, `local`, `solicitante`, `tecnico`, `dataregistro`, `quantidade`) VALUES
(1, 'Mouse USB', 'Defeito', 123456789, 'Predio 1', 'Beatriz', 'Tecnico 3', '2021-08-17 13:24:53', 2),
(2, 'Teclado USB', 'Extravio', 963852741, 'Predio 4', 'Bianca', 'Tecnico 6', '2021-08-17 13:28:37', 5),
(3, 'Cabo de Rede UTP 3M', 'Instalação de Novo Item', 752358963, 'Predio 2', 'Gabriel', 'Tecnico 3', '2021-08-17 13:30:51', 8),
(4, 'HeadSet RJ11', 'Quebrado', 951741852, 'Predio 3', 'Maria', 'Tecnico 4', '2021-08-17 13:32:05', 3),
(5, 'HeadSet USB', 'Instalação de Novo Item', 852741963, 'Predio 5', 'Vanessa', 'Tecnico 6', '2021-08-17 13:33:09', 6),
(6, 'Monitor', 'Instalação de Novo Item', 852741963, 'Predio 6', 'Vanessa', 'Tecnico 1', '2021-08-17 13:38:48', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorioentrada`
--

CREATE TABLE `relatorioentrada` (
  `id` int(11) NOT NULL,
  `item` varchar(80) DEFAULT NULL,
  `motivo` varchar(80) DEFAULT NULL,
  `tecnico` varchar(20) DEFAULT NULL,
  `dataregistro` datetime DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `relatorioentrada`
--

INSERT INTO `relatorioentrada` (`id`, `item`, `motivo`, `tecnico`, `dataregistro`, `quantidade`) VALUES
(1, 'Mouse USB', 'Item Novo', 'Tecnico 2', '2021-08-17 13:42:21', 10),
(2, 'Teclado USB', 'Recuperado', 'Tecnico 4', '2021-08-17 13:42:46', 15);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `relatorioentrada`
--
ALTER TABLE `relatorioentrada`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `relatorioentrada`
--
ALTER TABLE `relatorioentrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

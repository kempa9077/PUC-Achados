-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/10/2024 às 21:46
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
-- Banco de dados: `puc_achados`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_objeto`
--

CREATE TABLE `categoria_objeto` (
  `id_tipo` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categoria_objeto`
--

INSERT INTO `categoria_objeto` (`id_tipo`, `categoria`) VALUES
(1, 'Eletrônico'),
(2, 'Carteira');

-- --------------------------------------------------------

--
-- Estrutura para tabela `local`
--

CREATE TABLE `local` (
  `id_local` int(11) NOT NULL,
  `bloco` int(11) NOT NULL,
  `sala` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `local`
--

INSERT INTO `local` (`id_local`, `bloco`, `sala`) VALUES
(1, 1, 'Secretaria Bloco 1'),
(2, 2, 'Secretaria Bloco 2'),
(3, 3, 'Secretaria Bloco 3'),
(4, 4, 'Secretaria Bloco 4'),
(5, 5, 'Secretaria Bloco 5'),
(6, 1, '103'),
(7, 2, '206'),
(8, 3, '107'),
(9, 4, 'Banheiro 1'),
(10, 5, 'Gordon More'),
(11, 1, '317'),
(12, 2, '119'),
(13, 3, '330'),
(14, 4, '101'),
(15, 5, 'Banheiro 3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_encontro`
--

CREATE TABLE `log_encontro` (
  `id_objeto` int(11) NOT NULL,
  `funcionario` varchar(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `objeto`
--

CREATE TABLE `objeto` (
  `id_objeto` int(11) NOT NULL,
  `secretaria` int(11) DEFAULT NULL,
  `categoria_objeto` int(11) NOT NULL,
  `encontrado` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `objeto`
--

INSERT INTO `objeto` (`id_objeto`, `secretaria`, `categoria_objeto`, `encontrado`, `nome`, `data_registro`) VALUES
(1, 5, 1, 1, 'Notebook', '2024-10-09 14:25:52'),
(2, 4, 2, 2, 'Carteira', '2024-10-09 14:25:52'),
(3, 6, 2, 0, 'Mochila', '2024-10-09 14:25:52'),
(137, 13, 2, 0, 'Teste_97@', '2024-10-09 14:25:52'),
(158, NULL, 2, 0, 'Teste 8001', '2024-10-09 14:25:52'),
(159, 13, 2, 0, 'Teste com data', '2024-10-09 14:27:11'),
(160, 13, 2, 0, 'Teste com data', '2024-10-09 14:27:33'),
(161, NULL, 1, 0, 'Teste novo', '2024-10-09 14:28:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `cpf` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `matricula` varchar(45) DEFAULT NULL,
  `registro_puc` varchar(45) DEFAULT NULL,
  `acesso_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`cpf`, `email`, `senha`, `nome`, `matricula`, `registro_puc`, `acesso_nivel`) VALUES
('12345678910', 'adm@adm.com', '$2b$12$nQ9IDi2hvsZIPc8XnFfjXeoVnDkAATGw7Yh35xQ52zesIbOZQI4em', 'adm_nome', NULL, NULL, 2),
('12345678913', '2@gmail.com', '$2y$10$S7J2/pIF4BNITNvLH8q5vO8a9b5YHG5IeH0KD1qBhJ8g.zpwVEyAW', 'tete1234', '', NULL, 0),
('12345678915', 'tester@gmail.com', '$2y$10$YZ7sENRgwDeiMO//ZZ0KAuJo7TvSBgKyqsYW.kO0jhc4Dp3pPtTei', 'Tester', '', NULL, 0),
('12345678921', 'a@gmail.com', '$2y$10$Vt1HeSc20DJ1I2WbfGIKU.Cg0UJ2NXj/qsNtTAY.RQSBAJ6gInK7S', 'saaaaaaaa', '', NULL, 0),
('321', 'fun', '$2b$12$G/RXIjXkgI38FLUU3zL/s.yIY2ArbbI/LNo4rp7ubfh.ANy9X.2OS', 'fun_nome', NULL, NULL, 1),
('456', 'alu', '$2b$12$s13iS28In4KivWDhvM2EhOAFjUQ5C/c2lmbI2DwWhmbpvpNVKrUM6', 'alu_nome', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `protocolo`
--

CREATE TABLE `protocolo` (
  `idprotocolo` int(11) NOT NULL,
  `situacao` int(11) NOT NULL,
  `data_abertura` datetime NOT NULL,
  `data_fechamento` datetime DEFAULT NULL,
  `data_perda` datetime DEFAULT NULL,
  `pessoa_abertura` char(11) DEFAULT NULL,
  `pessoa_fechado` char(11) DEFAULT NULL,
  `local_perda` int(11) DEFAULT NULL,
  `objeto` int(11) NOT NULL,
  `descricao` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `protocolo`
--

INSERT INTO `protocolo` (`idprotocolo`, `situacao`, `data_abertura`, `data_fechamento`, `data_perda`, `pessoa_abertura`, `pessoa_fechado`, `local_perda`, `objeto`, `descricao`) VALUES
(1, 0, '2024-09-19 11:30:00', NULL, '2024-09-19 11:12:50', '456', NULL, 10, 1, 'Adesivos com meu nome atras'),
(2, 1, '2024-09-18 12:00:50', '2024-09-19 12:30:50', '2024-09-18 10:00:50', '456', '321', 9, 2, 'azul com veltro'),
(22, 0, '2024-10-09 14:34:46', NULL, '2024-10-08 09:34:46', '12345678915', NULL, NULL, 137, 'Deus é bom'),
(23, 0, '2024-10-25 10:10:56', NULL, '2024-10-20 10:10:56', '12345678910', NULL, 10, 1, 'Deus e bom'),
(24, 0, '2024-10-25 10:10:56', NULL, '2024-10-20 10:10:56', '12345678910', NULL, 10, 1, 'Deus e bom'),
(25, 0, '2024-10-25 10:10:56', NULL, '2024-10-20 10:10:56', '12345678910', NULL, 10, 1, 'Deus e bom e o davi é burro'),
(27, 0, '2024-10-09 14:13:54', NULL, '2024-10-07 00:00:00', '12345678910', NULL, 14, 158, 'Se for isso socorro Deus'),
(28, 0, '2024-10-09 14:28:17', NULL, '2024-10-15 00:00:00', '12345678910', NULL, 6, 161, 'Calopsita');

-- --------------------------------------------------------

--
-- Estrutura para tabela `retirada`
--

CREATE TABLE `retirada` (
  `id_retirada` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `pessoa_retirante` char(11) NOT NULL,
  `funcionario` char(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria_objeto`
--
ALTER TABLE `categoria_objeto`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices de tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id_local`);

--
-- Índices de tabela `log_encontro`
--
ALTER TABLE `log_encontro`
  ADD PRIMARY KEY (`id_objeto`),
  ADD KEY `funcionario` (`funcionario`);

--
-- Índices de tabela `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id_objeto`),
  ADD KEY `fk_objeto_local1_idx` (`secretaria`),
  ADD KEY `fk_objeto_tipo_item1_idx` (`categoria_objeto`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`cpf`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `protocolo`
--
ALTER TABLE `protocolo`
  ADD PRIMARY KEY (`idprotocolo`),
  ADD KEY `fk_protocolo_pessoa_idx` (`pessoa_abertura`),
  ADD KEY `fk_protocolo_pessoa1_idx` (`pessoa_fechado`),
  ADD KEY `fk_protocolo_local1_idx` (`local_perda`),
  ADD KEY `fk_protocolo_objeto1_idx` (`objeto`);

--
-- Índices de tabela `retirada`
--
ALTER TABLE `retirada`
  ADD PRIMARY KEY (`id_retirada`),
  ADD KEY `id_objeto` (`id_objeto`),
  ADD KEY `pessoa_retirante` (`pessoa_retirante`),
  ADD KEY `funcionario` (`funcionario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria_objeto`
--
ALTER TABLE `categoria_objeto`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `local`
--
ALTER TABLE `local`
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id_objeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT de tabela `protocolo`
--
ALTER TABLE `protocolo`
  MODIFY `idprotocolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `retirada`
--
ALTER TABLE `retirada`
  MODIFY `id_retirada` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `log_encontro`
--
ALTER TABLE `log_encontro`
  ADD CONSTRAINT `log_encontro_ibfk_1` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id_objeto`),
  ADD CONSTRAINT `log_encontro_ibfk_2` FOREIGN KEY (`funcionario`) REFERENCES `pessoa` (`cpf`);

--
-- Restrições para tabelas `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `fk_objeto_local1` FOREIGN KEY (`secretaria`) REFERENCES `local` (`id_local`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_objeto_tipo_item1` FOREIGN KEY (`categoria_objeto`) REFERENCES `categoria_objeto` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `protocolo`
--
ALTER TABLE `protocolo`
  ADD CONSTRAINT `fk_protocolo_local1` FOREIGN KEY (`local_perda`) REFERENCES `local` (`id_local`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_protocolo_objeto1` FOREIGN KEY (`objeto`) REFERENCES `objeto` (`id_objeto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_protocolo_pessoa` FOREIGN KEY (`pessoa_abertura`) REFERENCES `pessoa` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_protocolo_pessoa1` FOREIGN KEY (`pessoa_fechado`) REFERENCES `pessoa` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `retirada`
--
ALTER TABLE `retirada`
  ADD CONSTRAINT `retirada_ibfk_1` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id_objeto`),
  ADD CONSTRAINT `retirada_ibfk_2` FOREIGN KEY (`pessoa_retirante`) REFERENCES `pessoa` (`cpf`),
  ADD CONSTRAINT `retirada_ibfk_3` FOREIGN KEY (`funcionario`) REFERENCES `pessoa` (`cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

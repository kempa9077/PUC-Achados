-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/09/2024 às 15:10
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
-- Estrutura para tabela `objeto`
--

CREATE TABLE `objeto` (
  `id_objeto` int(11) NOT NULL,
  `secretaria` int(11) DEFAULT NULL,
  `categoria_objeto` int(11) NOT NULL,
  `encontrado` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `objeto`
--

INSERT INTO `objeto` (`id_objeto`, `secretaria`, `categoria_objeto`, `encontrado`, `nome`) VALUES
(1, 5, 1, 0, 'Notebook'),
(2, 4, 2, 1, 'Carteira');

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
('123', 'adm', '$2b$12$nQ9IDi2hvsZIPc8XnFfjXeoVnDkAATGw7Yh35xQ52zesIbOZQI4em', 'adm_nome', NULL, NULL, 2),
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
  `pessoa_abertura` char(11) NOT NULL,
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
(2, 1, '2024-09-18 12:00:50', '2024-09-19 12:30:50', '2024-09-18 10:00:50', '456', '321', 9, 2, 'azul com veltro');

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
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id_objeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `protocolo`
--
ALTER TABLE `protocolo`
  MODIFY `idprotocolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

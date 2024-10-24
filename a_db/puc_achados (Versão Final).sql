-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/10/2024 às 13:18
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
(2, 'Documento'),
(3, 'Carteirinha PUC'),
(4, 'Roupa'),
(6, 'Guarda Chuva'),
(7, 'Material Escolar'),
(8, 'Chaves'),
(9, 'Cartão Bancario'),
(10, 'Outros');

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
(0, 0, '-'),
(1, 1, 'Secretaria Bloco 1'),
(2, 2, 'Secretaria Bloco 2'),
(3, 3, 'Secretaria Bloco 3'),
(4, 4, 'Secretaria Bloco 4'),
(5, 5, 'Secretaria Bloco 5'),
(6, 6, 'Secretaria Bloco 6'),
(7, 7, 'Secretaria Bloco 7'),
(8, 8, 'Secretaria Bloco 8'),
(9, 9, 'Secretaria Bloco 9'),
(10, 10, 'Secretaria Bloco 10'),
(11, 1, 'Auditorio Cristão de Ataíde'),
(12, 1, 'Sala A7'),
(13, 1, 'Auditório Thomas Morus '),
(14, 1, 'Sala B8'),
(15, 1, 'Banheiro 3'),
(16, 2, 'Alan Turing'),
(17, 2, 'Teatro Tuca'),
(18, 2, 'Laboratorio 11'),
(19, 2, 'Steve Jobs'),
(22, 2, 'Banheiro 1'),
(23, 3, 'Auditório Carlos Costa'),
(24, 3, 'Auditório Gregor Mendeu'),
(25, 3, 'Sala 20'),
(26, 3, 'Cozinha 2'),
(27, 3, 'Banheiro 3'),
(28, 4, 'Sala NEP'),
(29, 4, 'Sala 113'),
(30, 4, 'Centro Acadêmico de Marketing'),
(31, 4, 'Sala 307'),
(32, 4, 'Banheiro 8'),
(33, 5, 'Morgon More'),
(34, 5, 'Araça 303'),
(35, 5, 'Sala 117'),
(36, 5, 'Juizado Especial'),
(37, 5, 'Banheiro 22'),
(38, 6, 'Sala ALGAR'),
(39, 6, 'Sala Gequitiba 007'),
(40, 6, 'Sala 27A'),
(41, 6, 'Arena 002'),
(42, 6, 'Banheiro 1'),
(43, 8, 'Engenharia de Reabilitação'),
(44, 8, 'Sala Ada LoveLace'),
(45, 8, 'Sala 04'),
(46, 8, 'Laboratório de Redes de Computadores'),
(47, 8, 'Banheiro 15'),
(48, 9, 'Laboratório de Metrologia'),
(49, 9, 'Laboratório Oficina'),
(50, 9, 'Sala Nikola Tesla'),
(51, 9, 'Sala MultiMatematica'),
(52, 9, 'Banheiro 23'),
(53, 7, 'Laboratório Operações Unitárias '),
(54, 7, 'Laboratório Química 10'),
(55, 7, 'Lapiagro'),
(56, 7, 'Laboratório de Fermentações'),
(57, 7, 'Banheiro 4');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_encontro`
--

CREATE TABLE `log_encontro` (
  `id_log` int(11) NOT NULL,
  `id_objeto` int(11) DEFAULT NULL,
  `funcionario` varchar(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `valor_antigo` int(11) DEFAULT NULL,
  `valor_novo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `log_encontro`
--

INSERT INTO `log_encontro` (`id_log`, `id_objeto`, `funcionario`, `data`, `valor_antigo`, `valor_novo`) VALUES
(12, 204, '12345678910', '2024-10-23 16:29:32', 0, 1),
(13, 204, '12345678910', '2024-10-23 16:30:29', 1, 2),
(14, 199, '12345678911', '2024-10-23 16:33:49', 1, 2),
(15, 201, '12345678911', '2024-10-23 16:34:57', 1, 2),
(16, 200, '12345678911', '2024-10-23 16:36:20', 1, 2),
(17, 203, '12345678911', '2024-10-23 16:36:32', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_pessoa`
--

CREATE TABLE `log_pessoa` (
  `id_log` int(11) NOT NULL,
  `cpf_modificador` varchar(11) NOT NULL,
  `cpf_alterado` varchar(11) NOT NULL,
  `data` datetime NOT NULL,
  `email_velho` varchar(100) DEFAULT NULL,
  `email_novo` varchar(100) DEFAULT NULL,
  `nome_velho` varchar(100) DEFAULT NULL,
  `nome_novo` varchar(100) DEFAULT NULL,
  `acesso_nivel_velho` int(11) DEFAULT NULL,
  `acesso_nivel_novo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `log_pessoa`
--

INSERT INTO `log_pessoa` (`id_log`, `cpf_modificador`, `cpf_alterado`, `data`, `email_velho`, `email_novo`, `nome_velho`, `nome_novo`, `acesso_nivel_velho`, `acesso_nivel_novo`) VALUES
(11, '12345678910', '12345678913', '2024-10-23 16:24:53', 'renato@pucpr.br', 'renato@pucpr.br', 'Renato Silva', 'Renato Silva', 1, 2),
(12, '12345678910', '12345678915', '2024-10-23 16:26:41', 'moura@pucpr.br', 'moura@pucpr.br', 'Vinicius Moura', 'Vinicius Moura', 1, 2),
(13, '12345678910', '12345678915', '2024-10-23 16:28:26', 'moura@pucpr.br', 'moura@pucpr.br', 'Vinicius Moura', 'Vinicius Moura', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `objeto`
--

CREATE TABLE `objeto` (
  `id_objeto` int(11) NOT NULL,
  `id_local` int(11) DEFAULT NULL,
  `categoria_objeto` int(11) NOT NULL,
  `encontrado` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `objeto`
--

INSERT INTO `objeto` (`id_objeto`, `id_local`, `categoria_objeto`, `encontrado`, `nome`, `data_registro`) VALUES
(195, 3, 3, 1, 'Carteirinha - Adilson Jurandir', '2024-10-23 09:40:13'),
(196, 9, 1, 1, 'Carregador Iphone', '2024-10-23 09:40:37'),
(197, 4, 6, 1, 'Guarda Chuva Preto', '2024-10-23 09:41:43'),
(198, 4, 9, 1, 'Cartão visa internacional', '2024-10-23 09:42:01'),
(199, 8, 4, 2, 'Moletão Rosa', '2024-10-23 09:42:16'),
(200, 9, 8, 2, 'Chave de Carro Renault', '2024-10-23 15:49:03'),
(201, 9, 1, 2, 'Notebook Positivo', '2024-10-23 15:50:01'),
(202, 1, 7, 1, 'Estojo ', '2024-10-23 15:50:29'),
(203, 2, 9, 2, 'Cartão Visa ', '2024-10-23 15:50:47'),
(204, 6, 1, 2, 'MacBook', '2024-10-23 15:58:16'),
(205, 22, 8, 0, 'Chave de casa', '2024-10-23 15:58:50'),
(206, 11, 3, 0, 'Carteirinha', '2024-10-23 16:00:56'),
(207, 30, 10, 0, 'Copo Stalei', '2024-10-23 16:02:16'),
(208, 11, 2, 0, 'Carteira de Motorista', '2024-10-23 16:06:21');

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
('12345678910', 'adm@adm.com', '$2b$12$nQ9IDi2hvsZIPc8XnFfjXeoVnDkAATGw7Yh35xQ52zesIbOZQI4em', 'adm_nome', NULL, ' 15nu51o9', 2),
('12345678911', 'funcionario@pucpr.br', '$2y$10$OBeMIK.KW0GgRGPLaMUsqelRw6KlQ3vl2d3dKTCXw/vTczKREN0s.', 'Funcionário Generico ', NULL, '4iin59n8n', 1),
('12345678912', 'aluno@pucpr.edu.br', '$2y$10$fC9i4DAvOvTk/plyEvN4POEMwApWvplNzvvI0gROqtOXt/5QWbPpi', 'Aluno Generico', '1985569091', NULL, 0),
('12345678913', 'renato@pucpr.br', '$2y$10$9tdG1dTZNObNp6Q0A/aeEeOHr/DL3PPG.dUFJSHiSwA088f7JNzIq', 'Renato Silva', NULL, '185ngfu50n', 2),
('12345678915', 'moura@pucpr.br', '$2y$10$H9rOKa0DXwewqzP47pThYusBXB08/Td9cWq3/tHqxG41RFwOxhwEa', 'Vinicius Moura', NULL, '55niv21n93', 1),
('12345678921', 'vetri@gmail.com', '$2y$10$ArY1yecqPWLeyB/vpvtzlOYmC1zeBpK0v7gk.PobYJfftBsPfeOLu', 'Paulo Vetri', '134569483', NULL, 0),
('12345678923', 'neves@yoahoo.com', '$2y$10$qXhGnMIvd.0D6mAk9CCP0uNfFezFAzS/Du1rb2a4ZGLFojnrfEwXq', 'Felipe Neves', '123456472', NULL, 0),
('12345678924', 'enzo@pucpr.edu.br', '$2y$10$VzhsfBTr3e0QQe1eTnUDke1y.vzR.eWxuED1JAODa2i/.8jIMiUGm', 'Enzo Miguel', '12426421', NULL, 0),
('12345678926', 'carla@gmail.com', '$2y$10$JGrboxIuz/WVOTHwuS0e6unT4nLiwAYPwpQV6Fvmohv9qFt4DuEqa', 'Carla Silva', '', NULL, 0),
('12345678927', 'adilson@gmail.com', '$2y$10$913H2oMlsbAgjJ1ctGozauNPGHvEuz6i7mHPWlukeveMGiLtWFCIW', 'Adilson Jurandir', '81826', NULL, 0);

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
(44, 1, '2024-10-23 15:58:16', '2024-10-23 16:30:29', '2024-10-22 00:00:00', '12345678921', '12345678910', 41, 204, 'Modelo x '),
(45, 0, '2024-10-23 15:58:50', NULL, '2024-10-23 00:00:00', '12345678921', NULL, 22, 205, 'Em um chaveiro de elefante'),
(46, 0, '2024-10-23 16:00:56', NULL, '2024-10-17 00:00:00', '12345678923', NULL, 11, 206, 'A minha'),
(47, 0, '2024-10-23 16:02:16', NULL, '2024-10-18 00:00:00', '12345678923', NULL, 30, 207, 'Cor azul'),
(48, 0, '2024-10-23 16:06:21', NULL, '2024-10-23 00:00:00', '12345678924', NULL, 11, 208, '');

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
-- Despejando dados para a tabela `retirada`
--

INSERT INTO `retirada` (`id_retirada`, `id_objeto`, `pessoa_retirante`, `funcionario`, `data`) VALUES
(17, 204, '12345678921', '12345678910', '2024-10-23 16:30:29'),
(18, 199, '12345678926', '12345678911', '2024-10-23 16:33:49'),
(19, 201, '12345678926', '12345678911', '2024-10-23 16:34:57'),
(20, 200, '12345678927', '12345678911', '2024-10-23 16:36:20'),
(21, 203, '12345678927', '12345678911', '2024-10-23 16:36:32');

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
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_objeto` (`id_objeto`),
  ADD KEY `funcionario` (`funcionario`);

--
-- Índices de tabela `log_pessoa`
--
ALTER TABLE `log_pessoa`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `cpf_modificador` (`cpf_modificador`),
  ADD KEY `cpf_alterado` (`cpf_alterado`);

--
-- Índices de tabela `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id_objeto`),
  ADD KEY `fk_objeto_local1_idx` (`id_local`),
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
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `local`
--
ALTER TABLE `local`
  MODIFY `id_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `log_encontro`
--
ALTER TABLE `log_encontro`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `log_pessoa`
--
ALTER TABLE `log_pessoa`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id_objeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT de tabela `protocolo`
--
ALTER TABLE `protocolo`
  MODIFY `idprotocolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `retirada`
--
ALTER TABLE `retirada`
  MODIFY `id_retirada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `log_encontro`
--
ALTER TABLE `log_encontro`
  ADD CONSTRAINT `log_encontro_ibfk_1` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id_objeto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_encontro_ibfk_2` FOREIGN KEY (`funcionario`) REFERENCES `pessoa` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `log_pessoa`
--
ALTER TABLE `log_pessoa`
  ADD CONSTRAINT `log_pessoa_ibfk_1` FOREIGN KEY (`cpf_modificador`) REFERENCES `pessoa` (`cpf`),
  ADD CONSTRAINT `log_pessoa_ibfk_2` FOREIGN KEY (`cpf_alterado`) REFERENCES `pessoa` (`cpf`);

--
-- Restrições para tabelas `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `fk_objeto_local1` FOREIGN KEY (`id_local`) REFERENCES `local` (`id_local`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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

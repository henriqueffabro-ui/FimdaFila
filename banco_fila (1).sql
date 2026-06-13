-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/06/2026 às 02:32
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
-- Banco de dados: `banco_fila`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `turma` varchar(20) DEFAULT NULL,
  `turno` varchar(50) DEFAULT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `email`, `turma`, `turno`, `cargo`, `senha`) VALUES
(1, '', '', '', '', '', ''),
(9, 'Henrique F', 'henrique.fabro@escola.pr.gov.br', '2M', 'Tarde', 'Estudante', '$2y$10$RQJNrvLtWWhotQRykGt2bOwPLTJEOTJdbtVhStol2wv8joOK6tAZ6'),
(12, 'Admin', 'cmine1964@gmail.com', '', 'Todos', 'Admin', '$2y$10$XXQAJ528gtYOdz/95FoBVun7Iuh.nbjKQvTtIE7Ydj2GAxG0R8A1S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lanches`
--

CREATE TABLE `lanches` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lanches`
--

INSERT INTO `lanches` (`id`, `nome`, `preco`, `qtd`) VALUES
(1, 'Mini Pizza de Calabresa', 8, 94),
(2, 'Mini Pizza de Presunto e Queijo', 8, 100),
(3, 'Mini Pizza de Chocolate Preto', 8, 98),
(4, 'Mini Pizza de Frango Catupiry', 8, 96),
(5, 'Hamburguer de Forno', 8, 100),
(6, 'Salgado Assado de Pizza', 8, 100),
(7, 'Salgado Assado de Frango', 8, 100),
(8, 'Salgado Assado de Frango', 8, 100);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome_lanche` varchar(100) NOT NULL,
  `id_lanche` int(11) NOT NULL,
  `preco_lanche` decimal(10,0) NOT NULL,
  `turma` varchar(30) NOT NULL,
  `turno` varchar(30) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `qtd` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'pendente',
  `data_retirada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id`, `nome_cliente`, `id_cliente`, `nome_lanche`, `id_lanche`, `preco_lanche`, `turma`, `turno`, `cargo`, `qtd`, `status`, `data_retirada`) VALUES
(1, 'Henrique F', 9, 'Mini Pizza de Chocolate Preto', 3, 8, '2M', 'Tarde', 'Estudante', 1, 'pendente', NULL),
(2, 'Henrique F', 9, 'Mini Pizza de Chocolate Preto', 3, 8, '2M', 'Tarde', 'Estudante', 1, 'pendente', NULL),
(3, 'Henrique F', 9, 'Mini Pizza de Calabresa', 1, 8, '2M', 'Tarde', 'Estudante', 2, 'pendente', NULL),
(4, 'Henrique F', 9, 'Mini Pizza de Calabresa', 1, 16, '2M', 'Tarde', 'Estudante', 2, 'pago', NULL),
(5, 'Henrique F', 9, 'Mini Pizza de Chocolate Preto', 3, 8, '2M', 'Tarde', 'Estudante', 1, 'pago', NULL),
(6, 'Henrique F', 9, 'Mini Pizza de Frango Catupiry', 4, 16, '2M', 'Tarde', 'Estudante', 2, 'pago', NULL),
(7, 'Henrique F', 9, 'Mini Pizza de Frango Catupiry', 4, 16, '2M', 'Tarde', 'Estudante', 2, 'entregue', NULL),
(8, 'Henrique F', 9, 'Hamburguer de Forno', 5, 8, '2M', 'Tarde', 'Estudante', 1, 'pendente', '2026-06-15'),
(9, 'Henrique F', 9, 'Mini Pizza de Calabresa', 1, 8, '2M', 'Tarde', 'Estudante', 1, 'pendente', '2026-06-15'),
(10, 'Henrique F', 9, 'Mini Pizza de Calabresa', 1, 8, '2M', 'Tarde', 'Estudante', 1, 'pendente', '2026-06-15'),
(11, 'Admin', 12, 'Salgado Assado de Frango', 7, 8, '', 'Todos', 'Admin', 1, 'pendente', '2026-06-15'),
(12, 'Admin', 12, 'Salgado Assado de Frango', 7, 8, '', 'Todos', 'Admin', 1, 'pendente', '2026-06-15'),
(13, 'Admin', 12, 'Salgado Assado de Frango', 7, 8, '', 'Todos', 'Admin', 1, 'pendente', '2026-06-15');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `lanches`
--
ALTER TABLE `lanches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_lanche` (`id_lanche`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `lanches`
--
ALTER TABLE `lanches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_lanche`) REFERENCES `lanches` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

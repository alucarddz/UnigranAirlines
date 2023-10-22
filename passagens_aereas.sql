-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Out-2023 às 00:33
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `passagens_aereas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `cod_ibge` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`cod_ibge`, `nome`) VALUES
(4106902, 'Curitiba'),
(5003702, 'Dourados');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `classe`
--

INSERT INTO `classe` (`id`, `nome`) VALUES
(1, 'Primeira Classe / First Class'),
(2, 'Classe Econômica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `idade`, `cpf`) VALUES
(1, 'Juliano Pistori', 20, '08483384990'),
(2, 'Marisa Pistori', 63, '02173986856'),
(3, 'Guilherme Andi', 27, '79143305772'),
(4, 'André Joia', 20, '11572107910');

-- --------------------------------------------------------

--
-- Estrutura da tabela `passagem`
--

CREATE TABLE `passagem` (
  `id` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL COMMENT 'ID referente a tabela Classes.',
  `data_voo` date NOT NULL,
  `portao` varchar(3) NOT NULL,
  `assento` varchar(3) NOT NULL,
  `horario_embarque` time NOT NULL,
  `origem` int(11) NOT NULL COMMENT 'ID referente ao cod_ibge da tabela cidades.',
  `destino` int(11) NOT NULL COMMENT 'ID referente ao cod_ibge da tabela cidades.',
  `cpf_cliente` varchar(11) NOT NULL COMMENT 'CPF relacionado a tabela cliente.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `passagem`
--

INSERT INTO `passagem` (`id`, `id_classe`, `data_voo`, `portao`, `assento`, `horario_embarque`, `origem`, `destino`, `cpf_cliente`) VALUES
(1, 1, '2023-10-20', 'A23', 'C11', '17:00:00', 4106902, 5003702, '08483384990'),
(8, 1, '2023-11-11', 'B03', 'B10', '18:00:00', 4106902, 5003702, '08483384990'),
(11, 1, '2023-10-27', 'A05', 'B12', '23:00:00', 4106902, 5003702, '08483384990'),
(12, 2, '2023-10-02', 'B01', 'A01', '15:00:00', 5003702, 4106902, '08483384990'),
(18, 1, '2022-10-10', 'B09', 'A14', '15:00:00', 4106902, 5003702, '02173986856'),
(19, 2, '2022-10-10', 'A09', 'A21', '18:00:00', 5003702, 4106902, '08483384990'),
(20, 1, '2023-10-22', 'B03', 'A24', '10:00:00', 5003702, 4106902, '79143305772'),
(21, 2, '2023-10-21', 'C03', 'A10', '18:00:00', 4106902, 5003702, '11572107910');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`cod_ibge`);

--
-- Índices para tabela `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpf` (`cpf`);

--
-- Índices para tabela `passagem`
--
ALTER TABLE `passagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `cpf_cliente` (`cpf_cliente`),
  ADD KEY `origem` (`origem`),
  ADD KEY `destino` (`destino`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `passagem`
--
ALTER TABLE `passagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `passagem`
--
ALTER TABLE `passagem`
  ADD CONSTRAINT `passagem_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `passagem_ibfk_2` FOREIGN KEY (`cpf_cliente`) REFERENCES `cliente` (`cpf`),
  ADD CONSTRAINT `passagem_ibfk_3` FOREIGN KEY (`origem`) REFERENCES `cidade` (`cod_ibge`),
  ADD CONSTRAINT `passagem_ibfk_4` FOREIGN KEY (`destino`) REFERENCES `cidade` (`cod_ibge`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

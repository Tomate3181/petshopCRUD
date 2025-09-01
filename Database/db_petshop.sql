-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Set-2025 às 12:55
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_petshop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `agendamento_code` int(11) NOT NULL,
  `agendamento_procedimento` varchar(50) NOT NULL,
  `agendamento_data` date NOT NULL,
  `fk_cliente_cpf` varchar(11) DEFAULT NULL,
  `fk_animal_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agendamento`
--

INSERT INTO `agendamento` (`agendamento_code`, `agendamento_procedimento`, `agendamento_data`, `fk_cliente_cpf`, `fk_animal_code`) VALUES
(1, 'TOSA', '2023-09-22', '22222222222', 1),
(2, 'BANHO', '2023-09-29', '44444444444', 3),
(3, 'CONSULTA', '2023-10-10', '11111111111', 4),
(4, 'CIRURGIA', '2023-10-12', '22222222222', 1),
(5, 'TOSA', '2023-10-16', '77777777777', 7),
(6, 'TOSA', '2023-12-23', '81818155555', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `animal_cod` int(11) NOT NULL,
  `animal_tipo` varchar(50) NOT NULL,
  `animal_nome` varchar(50) NOT NULL,
  `animal_raca` varchar(50) NOT NULL,
  `fk_cliente_cpf` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`animal_cod`, `animal_tipo`, `animal_nome`, `animal_raca`, `fk_cliente_cpf`) VALUES
(1, 'Cão', 'Patricio', 'Pinscher', '22222222222'),
(2, 'Gato', 'Beethoven', 'Rottweiller', '88888888888'),
(3, 'Gato', 'Mia', 'Siamês', '44444444444'),
(4, 'Cão', 'Linguiça', 'Shih Tzu', '11111111111'),
(5, 'Tartaruga', 'Raio', 'Jabuti', '81818155555'),
(6, 'Cão', 'Messi', 'Salsicha', '81818155555'),
(7, 'Pássaro', 'Naruto', 'Calopsita', '77777777777'),
(8, 'Gato', 'Anitta', 'Siamês', '88888888888');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cliente_cpf` varchar(11) NOT NULL,
  `cliente_nome` varchar(100) NOT NULL,
  `cliente_endereco` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cliente_cpf`, `cliente_nome`, `cliente_endereco`) VALUES
('11111111111', 'Cristian RonaldoS', 'Rua Joao Pedro III, sn'),
('22222222222', 'Zuleide Silva', 'Rua Ipe, numero 88'),
('44444444444', 'Durval Junio', 'Rua sem saida, numero 0'),
('77777777777', 'Neymar Santos', 'Alameda das Perebas, n30'),
('81818155555', 'Isabella Pedrita', 'Avenida das Flores, n7'),
('88888888888', 'Cleiton Marciano', 'Avenida Presidenta Ana, n2');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`agendamento_code`),
  ADD KEY `fk_agendamento_cliente` (`fk_cliente_cpf`),
  ADD KEY `fk_agendamento_animal` (`fk_animal_code`);

--
-- Índices para tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_cod`),
  ADD KEY `fk_animal_cliente` (`fk_cliente_cpf`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_cpf`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `agendamento_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `fk_agendamento_animal` FOREIGN KEY (`fk_animal_code`) REFERENCES `animal` (`animal_cod`),
  ADD CONSTRAINT `fk_agendamento_cliente` FOREIGN KEY (`fk_cliente_cpf`) REFERENCES `cliente` (`cliente_cpf`);

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `fk_animal_cliente` FOREIGN KEY (`fk_cliente_cpf`) REFERENCES `cliente` (`cliente_cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

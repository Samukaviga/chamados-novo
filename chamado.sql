-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/07/2024 às 16:48
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `chamado`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamado`
--

CREATE TABLE `chamado` (
  `id_chamado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `titulo` varchar(90) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `prioridade` int(11) DEFAULT NULL,
  `id_departamento` int(255) DEFAULT NULL,
  `prazo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `chamado`
--

INSERT INTO `chamado` (`id_chamado`, `id_usuario`, `data`, `hora`, `titulo`, `mensagem`, `status`, `prioridade`, `id_departamento`, `prazo`) VALUES
(105, 3, '2023-11-07', '16:52:00', 'Sistema', 'Desenvolvimento do sistema', 2, 1, 2, '09-11'),
(107, 12, '2023-11-08', '13:04:00', 'Convites Liceu Brasil e Liceu da Beleza', 'Convite formatura segundo semestre de 2023', 2, 1, 2, '07/11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nome`) VALUES
(1, 'TI'),
(2, 'MARKETING'),
(3, 'RH'),
(4, 'FINANCEIRO'),
(5, 'COBRANÇA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem_chamado`
--

CREATE TABLE `mensagem_chamado` (
  `id_mensagem_chamado` int(11) NOT NULL,
  `id_chamado` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `texto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `resposta_chamado`
--

CREATE TABLE `resposta_chamado` (
  `id_resposta_chamado` int(11) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `id_mensagem_chamado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `id_setor` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `nome_setor` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `setor`
--

INSERT INTO `setor` (`id_setor`, `id_unidade`, `nome_setor`) VALUES
(1, 1, 'Combrança'),
(2, 1, 'Marketing'),
(3, 3, 'Diretoria'),
(5, 3, 'Financeiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidade`
--

CREATE TABLE `unidade` (
  `id_unidade` int(11) NOT NULL,
  `nome_unidade` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `unidade`
--

INSERT INTO `unidade` (`id_unidade`, `nome_unidade`) VALUES
(1, 'Liceu da Beleza'),
(2, 'Liceu Brasil'),
(3, 'Grupo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(90) NOT NULL,
  `sobrenome` varchar(90) NOT NULL,
  `telefone` int(20) NOT NULL,
  `email` varchar(90) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_setor` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `tipo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `sobrenome`, `telefone`, `email`, `senha`, `id_setor`, `id_unidade`, `status`, `tipo`) VALUES
(2, 'Rafael', 'Silva', 96521145, 'rafa@gmail.com', '$2y$10$aTSwNP/WFKPU7.RezTAMdOOVC0RMt5oZwYXwujl8DwxtOgNvuiYyS', 3, 1, 1, 0),
(3, 'Samuel', 'Gomes', 965125, 'samuel@gmail.com', '$2y$10$.gwV.XyB5uBCzNcUQOiUzum/QOChK45DmPWohPLw7ASTlcNPxhvxS', 2, 1, 1, 0),
(5, 'Dirceu', 'Silva', 11965412, 'admin@gmail.com', '$2y$10$D/LuK3nzIxw3585U3EDp.eSxDFuyIgJ1rnojs.e.KQKSIssZwIJ/y', 2, 1, 1, 1),
(6, 'Denise', 'Marques', 985606628, 'denise@grupoliceu.com.br', '$2y$10$iKhu/sZoBkCycGmyP/17CuTCSHsx7Va4OggViLQwkDSrutINPTB6i', 3, 3, 1, 9),
(7, 'Lucas', 'Demetris', 985606628, 'lucas@gmail.com', '$2y$10$Iw8inRzcm3melARNUruil.NrHyGU4LaT0rDdaPqJ.b.O8h7xvjlMm', 1, 3, 1, 2),
(8, 'Juliana', 'Silva', 119651154, 'juliana@gmail.com', '$2y$10$fUhcCie0gJaxYrp786/Kmu1gciy30HyAoK.EHgAb3HTIlgJ.y95FG', 3, 3, 1, 4),
(9, 'Andreza', 'Regiane', 119655412, 'andreza@gmail.com', '$2y$10$D/LuK3nzIxw3585U3EDp.eSxDFuyIgJ1rnojs.e.KQKSIssZwIJ/y', 2, 3, 1, 1),
(10, 'Natan ', 'Gabriel', 1196512544, 'natan@gmail.com', '$2y$10$D/LuK3nzIxw3585U3EDp.eSxDFuyIgJ1rnojs.e.KQKSIssZwIJ/y', 2, 3, 1, 0),
(11, 'Giovanna', 'Soares', 1165115447, 'giovanna@gmail.com', '$2y$10$D/LuK3nzIxw3585U3EDp.eSxDFuyIgJ1rnojs.e.KQKSIssZwIJ/y', 2, 3, 1, 0),
(12, 'Andreza', 'normal', 1168984, 'andreza2@gmail.com', '$2y$10$D/LuK3nzIxw3585U3EDp.eSxDFuyIgJ1rnojs.e.KQKSIssZwIJ/y', 2, 3, 1, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`id_chamado`),
  ADD KEY `chamado_usuario` (`id_usuario`),
  ADD KEY `fk_chamado_departamento` (`id_departamento`);

--
-- Índices de tabela `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Índices de tabela `mensagem_chamado`
--
ALTER TABLE `mensagem_chamado`
  ADD PRIMARY KEY (`id_mensagem_chamado`),
  ADD KEY `mensagemChamado_chamado` (`id_chamado`),
  ADD KEY `fk_mensagem_chamado_usuario` (`id_usuario`);

--
-- Índices de tabela `resposta_chamado`
--
ALTER TABLE `resposta_chamado`
  ADD PRIMARY KEY (`id_resposta_chamado`),
  ADD KEY `FK_resposta_mensagem_chamado` (`id_mensagem_chamado`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_setor`),
  ADD KEY `setor_unidade` (`id_unidade`);

--
-- Índices de tabela `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`id_unidade`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `usuario_setor` (`id_setor`),
  ADD KEY `usuario_unidade` (`id_unidade`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamado`
--
ALTER TABLE `chamado`
  MODIFY `id_chamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de tabela `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mensagem_chamado`
--
ALTER TABLE `mensagem_chamado`
  MODIFY `id_mensagem_chamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `resposta_chamado`
--
ALTER TABLE `resposta_chamado`
  MODIFY `id_resposta_chamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `unidade`
--
ALTER TABLE `unidade`
  MODIFY `id_unidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `chamado`
--
ALTER TABLE `chamado`
  ADD CONSTRAINT `chamado_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_chamado_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Restrições para tabelas `mensagem_chamado`
--
ALTER TABLE `mensagem_chamado`
  ADD CONSTRAINT `fk_mensagem_chamado_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `mensagemChamado_chamado` FOREIGN KEY (`id_chamado`) REFERENCES `chamado` (`id_chamado`);

--
-- Restrições para tabelas `resposta_chamado`
--
ALTER TABLE `resposta_chamado`
  ADD CONSTRAINT `FK_resposta_mensagem_chamado` FOREIGN KEY (`id_mensagem_chamado`) REFERENCES `mensagem_chamado` (`id_mensagem_chamado`);

--
-- Restrições para tabelas `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `setor_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `unidade` (`id_unidade`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_setor` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id_setor`),
  ADD CONSTRAINT `usuario_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `unidade` (`id_unidade`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jun 14, 2010 as 05:45 PM
-- Versão do Servidor: 5.1.37
-- Versão do PHP: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `leual27_senapa`
--
DELETE FROM `mysql`.`user` WHERE `User`='leual27_senapa';

INSERT INTO `mysql`.`user` (`Host`, `User`, `Password`, `Select_priv`, `Insert_priv`, `Update_priv`, `Delete_priv`, `Create_priv`, `Drop_priv`, `Reload_priv`, `Shutdown_priv`, `Process_priv`, `File_priv`, `Grant_priv`, `References_priv`, `Index_priv`, `Alter_priv`, `Show_db_priv`, `Super_priv`, `Create_tmp_table_priv`, `Lock_tables_priv`, `Execute_priv`, `Repl_slave_priv`, `Repl_client_priv`, `Create_view_priv`, `Show_view_priv`, `Create_routine_priv`, `Alter_routine_priv`, `Create_user_priv`, `Event_priv`, `Trigger_priv`, `ssl_type`, `ssl_cipher`, `x509_issuer`, `x509_subject`, `max_questions`, `max_updates`, `max_connections`, `max_user_connections`) VALUES
('localhost', 'leual27_senapa', PASSWORD('SeNaPa1234'), 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', '', '', '', 0, 0, 0, 0);

DROP DATABASE IF EXISTS `leual27_senapa`;
CREATE DATABASE `leual27_senapa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `leual27_senapa`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `pessoa_escola_pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `pessoa_escola_matricula` varchar(10) NOT NULL,
  `area_interece` varchar(250) NOT NULL,
  PRIMARY KEY (`pessoa_escola_pessoa_fisica_pessoa_id`,`pessoa_escola_matricula`),
  KEY `aluno_FKIndex1` (`pessoa_escola_matricula`,`pessoa_escola_pessoa_fisica_pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`, `area_interece`) VALUES
(12, 'A123456', 'Informática');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_resolve_questao`
--

CREATE TABLE IF NOT EXISTS `aluno_resolve_questao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questao_alternativa_id` int(10) unsigned DEFAULT NULL,
  `questao_id` int(10) unsigned NOT NULL,
  `disciplina_id` int(10) unsigned NOT NULL,
  `avaliacao_id` int(10) unsigned NOT NULL,
  `pessoa_id` int(10) unsigned NOT NULL,
  `inicio` datetime NOT NULL,
  `fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aluno_resolve_questao_FKIndex1` (`pessoa_id`),
  KEY `aluno_resolve_questao_FKIndex2` (`avaliacao_id`),
  KEY `aluno_resolve_questao_FKIndex3` (`disciplina_id`),
  KEY `aluno_resolve_questao_FKIndex4` (`questao_id`),
  KEY `aluno_resolve_questao_FKIndex5` (`questao_alternativa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `aluno_resolve_questao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

CREATE TABLE IF NOT EXISTS `assunto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `assunto`
--

INSERT INTO `assunto` (`id`, `nome`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 'Geometria Analítica', '2010-05-23 19:20:37', '2010-05-24 01:32:16', NULL),
(2, 'Geometria Espacial', '2010-05-23 19:21:36', '2010-05-26 22:52:08', NULL),
(3, 'Água', '2010-06-07 22:06:46', NULL, NULL),
(4, 'Interpretação', '2010-06-08 23:06:42', NULL, NULL),
(5, 'Lógica', '2010-06-08 23:32:04', NULL, NULL),
(6, 'Energia', '2010-06-09 19:49:02', NULL, NULL),
(7, 'Petróleo', '2010-06-09 19:54:08', NULL, NULL),
(8, 'Escravidão', '2010-06-09 23:07:40', NULL, NULL),
(9, 'Antiguidade', '2010-06-09 23:13:41', NULL, NULL),
(10, 'Indicadores (Ex.: natalidade, mortalidade)', '2010-06-09 23:21:35', NULL, NULL),
(11, 'Colonização', '2010-06-09 23:30:19', NULL, NULL),
(12, 'Segunda Guerra Mundial', '2010-06-09 23:43:05', NULL, NULL),
(13, 'História Brasileira', '2010-06-09 23:46:17', NULL, NULL),
(14, 'História Geral', '2010-06-09 23:52:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto_questao`
--

CREATE TABLE IF NOT EXISTS `assunto_questao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questao_id` int(10) unsigned NOT NULL,
  `assunto_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assunto_questao_FKIndex1` (`assunto_id`),
  KEY `assunto_questao_FKIndex2` (`questao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `assunto_questao`
--

INSERT INTO `assunto_questao` (`id`, `questao_id`, `assunto_id`) VALUES
(1, 2, 1),
(2, 1, 1),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4),
(6, 6, 5),
(7, 7, 5),
(8, 8, 3),
(9, 9, 3),
(10, 10, 6),
(11, 11, 7),
(12, 12, 7),
(13, 13, 7),
(14, 14, 6),
(15, 15, 8),
(16, 16, 9),
(17, 17, 5),
(18, 18, 11),
(19, 19, 11),
(20, 20, 12),
(21, 21, 13),
(22, 22, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao_situacao_id` int(10) unsigned NOT NULL,
  `nome` varchar(200) NOT NULL,
  `data_inicio` date NOT NULL,
  `hora_iniccio` time NOT NULL,
  `data_fim` date NOT NULL,
  `hora_fim` time NOT NULL,
  `tempo_minimo_prova` time NOT NULL,
  `tempo_maximo_prova` time NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacao_FKIndex1` (`avaliacao_situacao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `avaliacao_situacao_id`, `nome`, `data_inicio`, `hora_iniccio`, `data_fim`, `hora_fim`, `tempo_minimo_prova`, `tempo_maximo_prova`, `status`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 3, '1ª Avaliação', '2010-06-08', '09:00:00', '2010-06-10', '23:59:00', '01:00:00', '03:00:00', 1, '2010-06-07 21:31:42', '2010-06-10 01:38:40', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_aluno`
--

CREATE TABLE IF NOT EXISTS `avaliacao_aluno` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aluno_pessoa_escola_matricula` varchar(10) NOT NULL,
  `aluno_pessoa_escola_pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `avaliacao_id` int(10) unsigned NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacao_aluno_FKIndex1` (`avaliacao_id`),
  KEY `avaliacao_aluno_FKIndex2` (`aluno_pessoa_escola_pessoa_fisica_pessoa_id`,`aluno_pessoa_escola_matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `avaliacao_aluno`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_nivel`
--

CREATE TABLE IF NOT EXISTS `avaliacao_nivel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao_id` int(10) unsigned NOT NULL,
  `nivel` int(10) unsigned NOT NULL,
  `data_nivelamento` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacao_nivel_FKIndex1` (`avaliacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `avaliacao_nivel`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_questao`
--

CREATE TABLE IF NOT EXISTS `avaliacao_questao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questao_id` int(10) unsigned NOT NULL,
  `avaliacao_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacao_questao_FKIndex1` (`avaliacao_id`),
  KEY `avaliacao_questao_FKIndex2` (`questao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `avaliacao_questao`
--

INSERT INTO `avaliacao_questao` (`id`, `questao_id`, `avaliacao_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_situacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao_situacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `avaliacao_situacao`
--

INSERT INTO `avaliacao_situacao` (`id`, `nome`, `status`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 'Válida', 1, '2010-05-18 23:57:51', NULL, NULL),
(2, 'Inválida', 1, '2010-05-18 23:58:03', NULL, '2010-05-19 00:05:11'),
(3, 'Em andamento', 1, '2010-05-18 23:59:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(8) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `codigo`, `nome`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 'S 20', 'Matemática', '2010-05-19 00:03:28', NULL, NULL),
(2, 'A 202', 'Português', '2010-05-19 00:04:45', '2010-05-19 00:04:59', NULL),
(3, 'C001', 'Ciências', '2010-06-07 22:01:46', NULL, NULL),
(4, 'Q 0001', 'Química', '2010-06-09 19:39:13', NULL, NULL),
(5, 'F001', 'Física', '2010-06-09 19:48:25', NULL, NULL),
(6, 'H001', 'História', '2010-06-09 23:07:07', NULL, NULL),
(7, 'G001', 'Geografia', '2010-06-09 23:20:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_assunto`
--

CREATE TABLE IF NOT EXISTS `disciplina_assunto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `disciplina_id` int(10) unsigned NOT NULL,
  `assunto_id` int(10) unsigned NOT NULL,
  `data_atribuicao` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `disciplina_assunto_FKIndex1` (`assunto_id`),
  KEY `disciplina_assunto_FKIndex2` (`disciplina_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `disciplina_assunto`
--

INSERT INTO `disciplina_assunto` (`id`, `disciplina_id`, `assunto_id`, `data_atribuicao`) VALUES
(1, 1, 1, '2010-05-24'),
(2, 1, 2, '2010-05-26'),
(3, 3, 3, '2010-06-07'),
(4, 2, 4, '2010-06-08'),
(5, 1, 5, '2010-06-08'),
(6, 5, 6, '2010-06-09'),
(7, 3, 6, '2010-06-09'),
(8, 4, 7, '2010-06-09'),
(9, 6, 8, '2010-06-09'),
(10, 6, 9, '2010-06-09'),
(11, 7, 10, '2010-06-09'),
(12, 6, 11, '2010-06-09'),
(13, 6, 12, '2010-06-09'),
(14, 6, 13, '2010-06-09'),
(15, 6, 14, '2010-06-09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `feedback_avaliacao_alternativa`
--

CREATE TABLE IF NOT EXISTS `feedback_avaliacao_alternativa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feedbackAvaliacao_id` int(10) unsigned NOT NULL,
  `descricao` mediumtext NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feedback_avaliacao_alternativa_FKIndex1` (`feedbackAvaliacao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `feedback_avaliacao_alternativa`
--

INSERT INTO `feedback_avaliacao_alternativa` (`id`, `feedbackAvaliacao_id`, `descricao`, `status`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 1, 'Muito Fácil', 1, '2010-06-10 15:43:12', NULL, NULL),
(2, 1, 'Fácil', 1, '2010-06-10 15:43:14', NULL, NULL),
(3, 1, 'Difícil', 1, '2010-06-10 15:43:16', NULL, NULL),
(4, 1, 'Muito Difícil', 1, '2010-06-10 15:43:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `feedback_avaliacao_aluno`
--

CREATE TABLE IF NOT EXISTS `feedback_avaliacao_aluno` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao_aluno_id` int(10) unsigned NOT NULL,
  `feedback_avaliacao_alternativa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Table_29_FKIndex1` (`feedback_avaliacao_alternativa_id`),
  KEY `Table_29_FKIndex2` (`avaliacao_aluno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `feedback_avaliacao_aluno`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `feedbackavaliacao`
--

CREATE TABLE IF NOT EXISTS `feedbackavaliacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` mediumtext NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `feedbackavaliacao`
--

INSERT INTO `feedbackavaliacao` (`id`, `descricao`, `date_create`, `date_update`, `date_delete`) VALUES
(1, '<p>\n	O que voc&ecirc; <strong>achou </strong>da prova?</p>\n', '2010-06-10 15:43:08', '2010-06-10 15:47:53', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_avaliacao`
--

CREATE TABLE IF NOT EXISTS `nivel_avaliacao` (
  `nivel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `professor_avaliacao_id` int(10) unsigned NOT NULL,
  `data_nivelamento` datetime NOT NULL,
  PRIMARY KEY (`nivel`),
  KEY `nivel_avaliacao_FKIndex1` (`professor_avaliacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `nivel_avaliacao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_questao`
--

CREATE TABLE IF NOT EXISTS `nivel_questao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questao_id` int(10) unsigned NOT NULL,
  `nivel` int(10) unsigned NOT NULL,
  `data_nivelamento` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nivel_questao_FKIndex1` (`questao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `nivel_questao`
--

INSERT INTO `nivel_questao` (`id`, `questao_id`, `nivel`, `data_nivelamento`) VALUES
(1, 2, 5, '2010-05-24 00:00:00'),
(5, 1, 5, '2010-05-26 02:31:38'),
(6, 1, 6, '2010-05-26 02:33:24'),
(7, 1, 5, '2010-05-26 02:34:12'),
(8, 1, 6, '2010-05-26 02:48:49'),
(9, 3, 5, '2010-06-08 23:10:43'),
(10, 4, 7, '2010-06-08 23:21:59'),
(11, 5, 6, '2010-06-08 23:30:02'),
(12, 6, 4, '2010-06-08 23:34:28'),
(13, 7, 8, '2010-06-08 23:36:51'),
(14, 8, 9, '2010-06-09 19:42:57'),
(15, 10, 7, '2010-06-09 19:51:10'),
(16, 11, 9, '2010-06-09 19:55:47'),
(17, 12, 10, '2010-06-09 19:58:35'),
(18, 13, 6, '2010-06-09 20:00:46'),
(19, 14, 5, '2010-06-09 23:04:52'),
(20, 15, 4, '2010-06-09 23:11:13'),
(21, 16, 2, '2010-06-09 23:15:48'),
(22, 17, 7, '2010-06-09 23:28:29'),
(23, 18, 3, '2010-06-09 23:33:57'),
(24, 19, 2, '2010-06-09 23:37:24'),
(25, 20, 4, '2010-06-09 23:44:47'),
(26, 21, 9, '2010-06-09 23:48:57'),
(27, 22, 6, '2010-06-09 23:53:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel`
--

CREATE TABLE IF NOT EXISTS `papel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `papel`
--

INSERT INTO `papel` (`id`, `nome`, `status`) VALUES
(1, 'Super Administrador', NULL),
(2, 'Administrador', NULL),
(3, 'Professor', NULL),
(4, 'Aluno', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `site` varchar(250) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `email`, `site`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 'Super Administrador', 'leual27@gmail.com', 'leopopik.com.br', '2010-05-18 23:11:37', NULL, NULL),
(11, 'Leonardo Popik Bastos', 'leual27@gmail.com', NULL, '2010-05-19 01:17:48', NULL, NULL),
(12, 'Leonardo Popik Bastos', 'leual27@hotmail.com', 'leopopik.com.br', '2010-05-21 00:42:31', '2010-05-24 01:34:01', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_escola`
--

CREATE TABLE IF NOT EXISTS `pessoa_escola` (
  `matricula` varchar(10) NOT NULL,
  `pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `senha` varchar(150) NOT NULL,
  PRIMARY KEY (`matricula`,`pessoa_fisica_pessoa_id`),
  KEY `pessoa_escola_FKIndex1` (`pessoa_fisica_pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa_escola`
--

INSERT INTO `pessoa_escola` (`matricula`, `pessoa_fisica_pessoa_id`, `senha`) VALUES
('A123456', 12, 'TO8NzkUA8t5xFkY9LJJz0JlppCBLz5zJputcXIs4024TRkgrd1/EcTeJ+GseXisUOcDhF816QFuU1JFbZu4wB1sVKvVbpbRjBFtRuyiTuAE='),
('P0510387', 11, '8MU1HgbJKk0D7KGRcA70d3UObKuQOChEaSxFXBKMKRbCNAcJlyJExj5bGyseGUOBPSg/AY6bxwesGBKa/ryR6lw+q+6bbdeDrtTgGEr7xYE='),
('S123456', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_escola_disciplina`
--

CREATE TABLE IF NOT EXISTS `pessoa_escola_disciplina` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_escola_pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `pessoa_escola_matricula` varchar(10) NOT NULL,
  `disciplina_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pessoa_escola_disciplina_FKIndex1` (`disciplina_id`),
  KEY `pessoa_escola_disciplina_FKIndex2` (`pessoa_escola_matricula`,`pessoa_escola_pessoa_fisica_pessoa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `pessoa_escola_disciplina`
--

INSERT INTO `pessoa_escola_disciplina` (`id`, `pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`, `disciplina_id`) VALUES
(10, 12, 'A123456', 1),
(11, 11, 'P0510387', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_fisica`
--

CREATE TABLE IF NOT EXISTS `pessoa_fisica` (
  `pessoa_id` int(10) unsigned NOT NULL,
  `papel_id` int(10) unsigned NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  PRIMARY KEY (`pessoa_id`),
  KEY `pessoa_fisica_FKIndex1` (`pessoa_id`),
  KEY `pessoa_fisica_FKIndex2` (`papel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa_fisica`
--

INSERT INTO `pessoa_fisica` (`pessoa_id`, `papel_id`, `cpf`, `data_nascimento`) VALUES
(1, 1, NULL, '2010-06-08'),
(11, 3, '108.674.547-76', '1984-09-27'),
(12, 4, '108.674.547-76', '1984-09-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_juridica`
--

CREATE TABLE IF NOT EXISTS `pessoa_juridica` (
  `pessoa_id` int(10) unsigned NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `nome_fantasia` varchar(250) DEFAULT NULL,
  `inscricao_estadual` varchar(100) DEFAULT NULL,
  `inscricao_municipal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pessoa_id`),
  KEY `pessoa_juridica_FKIndex1` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa_juridica`
--

INSERT INTO `pessoa_juridica` (`pessoa_id`, `cnpj`, `nome_fantasia`, `inscricao_estadual`, `inscricao_municipal`) VALUES
(1, '45.677.473/0001-66', 'Léo Popik Sistemas', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `pessoa_escola_pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `pessoa_escola_matricula` varchar(10) NOT NULL,
  `formacao` varchar(250) NOT NULL,
  `area_atuacao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`pessoa_escola_pessoa_fisica_pessoa_id`,`pessoa_escola_matricula`),
  KEY `professor_FKIndex1` (`pessoa_escola_matricula`,`pessoa_escola_pessoa_fisica_pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`, `formacao`, `area_atuacao`) VALUES
(11, 'P0510387', 'Ciência da Computação', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_avaliacao`
--

CREATE TABLE IF NOT EXISTS `professor_avaliacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao_id` int(10) unsigned NOT NULL,
  `professor_pessoa_escola_matricula` varchar(10) NOT NULL,
  `professor_pessoa_escola_pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `professor_avaliacao_FKIndex1` (`professor_pessoa_escola_pessoa_fisica_pessoa_id`,`professor_pessoa_escola_matricula`),
  KEY `professor_avaliacao_FKIndex2` (`avaliacao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `professor_avaliacao`
--

INSERT INTO `professor_avaliacao` (`id`, `avaliacao_id`, `professor_pessoa_escola_matricula`, `professor_pessoa_escola_pessoa_fisica_pessoa_id`, `data_cadastro`, `date_create`, `date_update`, `date_delete`) VALUES
(3, 1, 'P0510387', 11, '0000-00-00 00:00:00', '2010-06-08 14:57:49', NULL, NULL),
(4, 1, 'P0510387', 11, '0000-00-00 00:00:00', '2010-06-10 01:37:55', NULL, NULL),
(5, 1, 'P0510387', 11, '0000-00-00 00:00:00', '2010-06-10 01:38:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE IF NOT EXISTS `questao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` mediumtext NOT NULL,
  `resposta` int(10) unsigned NOT NULL,
  `descricao_resposta` mediumtext NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`id`, `descricao`, `resposta`, `descricao_resposta`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 'Quem é o melhor amigo do homem', 0, 'O melhor amigo do homem é o cachorro', '2010-05-23 19:48:52', NULL, '2010-06-10 01:36:39'),
(2, 'Quem', 2, 'Uma explica de quem', '2010-05-24 22:47:10', NULL, '2010-06-10 01:36:41'),
(3, '<p>\n	O surgimento da figura da Ema no c&eacute;u, ao leste, no anoitecer, na segunda quinzena de junho, indica o in&iacute;cio do inverno para os &iacute;ndios do sul do Brasil e o come&ccedil;o da esta&ccedil;&atilde;o seca para os do norte. &Eacute; limitada pelas constela&ccedil;&otilde;es de Escorpi&atilde;o e do Cruzeiro do Sul, ou Cut&#39;uxu. Segundo o mito guarani, o Cut?uxu segura a cabe&ccedil;a da ave para garantir a vida na Terra, porque, se ela se soltar, beber&aacute; toda a &aacute;gua do nosso planeta. Os tupisguaranis utilizam o Cut&#39;uxu para se orientar e determinar a dura&ccedil;&atilde;o das noites e as esta&ccedil;&otilde;es do ano. Assinale a op&ccedil;&atilde;o correta a respeito da linguagem empregada no texto acima.</p>\n', 61, '<p>\n	N&atilde;o poderia ser a letra A, j&aacute; que o texto diz que a express&atilde;o Cut?uxu &eacute; pertencente &agrave;s tribos ind&iacute;genas e n&atilde;o &agrave;s popula&ccedil;&otilde;es pr&oacute;ximas, como falado na referida proposi&ccedil;&atilde;o. Tamb&eacute;m n&atilde;o poderia ser a letra C, pois n&atilde;o h&aacute; repeti&ccedil;&atilde;o da palavra ?Ema?. Seria redund&acirc;ncia e n&atilde;o h&aacute; necessidade, ao contr&aacute;rio do que &eacute; afirmado na alternativa. A palavra Cut?uxu n&atilde;o se trata de um voc&aacute;bulo coloquial, mas sim de uma palavra da l&iacute;ngua ind&iacute;gena, e est&aacute; em destaque para indicar uma denomina&ccedil;&atilde;o que n&atilde;o &eacute; da l&iacute;ngua portuguesa, logo, a op&ccedil;&atilde;o D est&aacute; descartada. A linguagem empregada segue a norma culta e expressa linguagem formal, portanto, desconsidera-se a op&ccedil;&atilde;o E e considera-se a B</p>\n', '2010-06-08 23:10:43', '2010-06-10 16:12:59', NULL),
(4, 'Calcula-se que 78% do desmatamento na\nAmazônia tenha sido motivado pela pecuária ? cerca de\n35% do rebanho nacional está na região ? e que pelo\nmenos 50 milhões de hectares de pastos são pouco\nprodutivos. Enquanto o custo médio para aumentar a\nprodutividade de 1 hectare de pastagem é de 2 mil reais, o\ncusto para derrubar igual área de floresta é estimado em\n800 reais, o que estimula novos desmatamentos.\nAdicionalmente, madeireiras retiram as árvores de valor\ncomercial que foram abatidas para a criação de pastagens.\nOs pecuaristas sabem que problemas ambientais como\nesses podem provocar restrições à pecuária nessas áreas,\na exemplo do que ocorreu em 2006 com o plantio da soja,\no qual, posteriormente, foi proibido em áreas de floresta.\nA partir da situação-problema descrita, conclui-se que:', 0, 'A recuperação de áreas degradadas e a utilização de insumos para elevação da produtividade das pastagens impedem que haja uma expansão das fronteiras agropecuárias, resultando automaticamente na diminuição dos níveis de desmatamento.', '2010-06-08 23:21:59', '2010-06-09 20:51:46', NULL),
(5, 'Um jornal de circulação nacional publicou a seguinte\nnotícia:\nChoveu torrencialmente na madrugada de ontem\nem Roraima, horas depois de os pajés caiapós Mantii e\nKucrit, levados de Mato Grosso pela Funai, terem\nparticipado do ritual da dança da chuva, em Boa Vista.\nA chuva durou três horas em todo o estado e as previsões\nindicam que continuará pelo menos até amanhã. Com isso,\nserá possível acabar de vez com o incêndio que ontem\ncompletou 63 dias e devastou parte das florestas do\nestado.\nJornal do Brasil, abr./1998 (com adaptações).\nConsiderando a situação descrita, avalie as afirmativas\nseguintes.\nI No ritual indígena, a dança da chuva, mais que\nconstituir uma manifestação artística, tem a função de\nintervir no ciclo da água.\nII A existência da dança da chuva em algumas culturas\nestá relacionada à importância do ciclo da água para a\nvida.\nIII Uma das informações do texto pode ser expressa em\nlinguagem científica da seguinte forma: a dança da\nchuva seria efetiva se provocasse a precipitação das\ngotículas de água das nuvens.\nÉ correto o que se afirma em:', 18, 'O item III está incorreto pois o termo linguagem refere-se a um vocabulário técnico, e não a princípios científicos', '2010-06-08 23:30:02', NULL, NULL),
(6, 'As florestas tropicais estão entre os maiores, mais\ndiversos e complexos biomas do planeta. Novos estudos\nsugerem que elas sejam potentes reguladores do clima, ao\nprovocarem um fluxo de umidade para o interior dos\ncontinentes, fazendo com que essas áreas de floresta não\nsofram variações extremas de temperatura e tenham\numidade suficiente para promover a vida. Um fluxo\npuramente físico de umidade do oceano para o continente,\nem locais onde não há florestas, alcança poucas centenas\nde quilômetros. Verifica-se, porém, que as chuvas sobre\nflorestas nativas não dependem da proximidade do\noceano. Esta evidência aponta para a existência de uma\npoderosa ?bomba biótica de umidade? em lugares como,\npor exemplo, a bacia amazônica. Devido à grande e densa\nárea de folhas, as quais são evaporadores otimizados,\nessa ?bomba? consegue devolver rapidamente a água para\no ar, mantendo ciclos de evaporação e condensação que\nfazem a umidade chegar a milhares de quilômetros no\ninterior do continente.\nAs florestas crescem onde chove, ou chove onde crescem\nas florestas? De acordo com o texto,', 23, 'O desenvolvimento de uma vegetação necessita de condições ambientais (aspectos físicos) favoráveis. Neste caso, a colaboração da umidade provinda tanto dos oceanos, quanto a emissão de umidade despendida pelos vegetais de uma floresta tropical, propiciam no mesmo local ou em um outro local mais distante, o estabelecimento, crescimento e manutenção da vida. Segundo o texto: fazendo com que essas áreas de floresta não sofram variações extremas de temperatura e tenham umidade suficiente para promover a vida', '2010-06-08 23:34:28', NULL, NULL),
(7, 'Um estudo recente feito no Pantanal dá uma\nboa idéia de como o equilíbrio entre as espécies,\nna natureza, é um verdadeiro quebra-cabeça. As peças\ndo quebra-cabeça são o tucano-toco, a arara-azul e o\nmanduvi. O tucano-toco é o único pássaro que consegue\nabrir o fruto e engolir a semente do manduvi, sendo, assim,\no principal dispersor de suas sementes. O manduvi, por\nsua vez, é uma das poucas árvores onde as araras-azuis\nfazem seus ninhos.\nAté aqui, tudo parece bem encaixado, mas... é\njustamente o tucano-toco o maior predador de ovos de\narara-azul ? mais da metade dos ovos das araras são\npredados pelos tucanos. Então, ficamos na seguinte\nencruzilhada: se não há tucanos-toco, os manduvis se\nextinguem, pois não há dispersão de suas sementes e não\nsurgem novos manduvinhos, e isso afeta as araras-azuis,\nque não têm onde fazer seus ninhos. Se, por outro lado, há\nmuitos tucanos-toco, eles dispersam as sementes dos\nmanduvis, e as araras-azuis têm muito lugar para fazer\nseus ninhos, mas seus ovos são muito predados.\nDe acordo com a situação descrita,', 0, 'Como a nidificação da arara-azul ocorre principalmente no manduvi, as aves desta espécie necessitam da dispersão deste vegetal, que depende do hábito nutricional dos tucanos-toco. Logo, a conservação das araras-azuis está condicionada a existência dos tucanos-toco, mesmo sendo esta espécie de tucano, predadora dos ovos das araras-azuis.', '2010-06-08 23:36:51', '2010-06-09 19:35:15', NULL),
(8, 'A China comprometeu-se a indenizar a Rússia\npelo derramamento de benzeno de uma indústria\npetroquímica chinesa no rio Songhua, um afluente do rio\nAmur, que faz parte da fronteira entre os dois países.\nO presidente da Agência Federal de Recursos de Água da\nRússia garantiu que o benzeno não chegará aos dutos de\nágua potável, mas pediu à população que fervesse a água\ncorrente e evitasse a pesca no rio Amur e seus afluentes.\nAs autoridades locais estão armazenando centenas de\ntoneladas de carvão, já que o mineral é considerado eficaz\nabsorvente de benzeno.\nLevando-se em conta as medidas adotadas para a\nminimização dos danos ao ambiente e à população, é\ncorreto afirmar que', 33, 'A volatilidade do benzeno permite que ele seja eliminado da água, que possui ponto de ebulição maior que ele', '2010-06-09 19:42:57', NULL, NULL),
(9, 'Usada para dar estabilidade aos navios, a água de\nlastro acarreta grave problema ambiental: ela introduz\nindevidamente, no país, espécies indesejáveis do ponto de\nvista ecológico e sanitário, a exemplo do mexilhão\ndourado, molusco originário da China. Trazido para o Brasil\npelos navios mercantes, o mexilhão dourado foi\nencontrado na bacia Paraná-Paraguai em 1991.\nA disseminação desse molusco e a ausência de\npredadores para conter o crescimento da população de\nmoluscos causaram vários problemas, como o que ocorreu\nna hidrelétrica de Itaipu, onde o mexilhão alterou a rotina\nde manutenção das turbinas, acarretando prejuízo de\nUS$ 1 milhão por dia, devido à paralisação do sistema.\nUma das estratégias utilizadas para diminuir o problema é\nacrescentar gás cloro à água, o que reduz em cerca de\n50% a taxa de reprodução da espécie.\nDe acordo com as informações acima, o despejo da água\nde lastro', 38, 'Esta alternativa esta de acordo com o texto, pois afirma que para conter a proliferação de mexilhões, foi utilizado um agente químico, reduzindo a taxa reprodutiva destes animais (controle populacional), reduzindo os prejuízos da usina', '2010-06-09 19:46:29', NULL, NULL),
(10, 'A energia geotérmica tem sua origem no núcleo\nderretido da Terra, onde as temperaturas atingem\n4.000 ºC. Essa energia é primeiramente produzida pela\ndecomposição de materiais radiativos dentro do planeta.\nEm fontes geotérmicas, a água, aprisionada em um\nreservatório subterrâneo, é aquecida pelas rochas ao redor\ne fica submetida a altas pressões, podendo atingir\ntemperaturas de até 370 ºC sem entrar em ebulição. Ao\nser liberada na superfície, à pressão ambiente, ela se\nvaporiza e se resfria, formando fontes ou gêiseres. O vapor\nde poços geotérmicos é separado da água e é utilizado no\nfuncionamento de turbinas para gerar eletricidade. A água\nquente pode ser utilizada para aquecimento direto ou em\nusinas de dessalinização.\nDepreende-se das informações acima que as usinas\ngeotérmicas', 43, 'A energia geotérmica se assemelha às usinas nucleares no que diz respeito à conversão da energia. Ambas convertem energia térmica em cinética e, depois, em elétrica', '2010-06-09 19:51:10', NULL, NULL),
(11, 'Um dos insumos energéticos que volta a ser\nconsiderado como opção para o fornecimento de petróleo\né o aproveitamento das reservas de folhelhos\npirobetuminosos, mais conhecidos como xistos\npirobetuminosos. As ações iniciais para a exploração de\nxistos pirobetuminosos são anteriores à exploração de\npetróleo, porém as dificuldades inerentes aos diversos\nprocessos, notadamente os altos custos de mineração e de\nrecuperação de solos minerados, contribuíram para\nimpedir que essa atividade se expandisse.\nO Brasil detém a segunda maior reserva mundial\nde xisto. O xisto é mais leve que os óleos derivados de\npetróleo, seu uso não implica investimento na troca de\nequipamentos e ainda reduz a emissão de particulados\npesados, que causam fumaça e fuligem. Por ser fluido em\ntemperatura ambiente, é mais facilmente manuseado e\narmazenado.\nA substituição de alguns óleos derivados de petróleo pelo\nóleo derivado do xisto pode ser conveniente por motivos', 48, 'Com o aumento do preço do petróleo, o xisto é uma ótima opção de combustível, resta apenas ser explorada. Com novas fontes o preço do petróleo deve cair devido à concorrência', '2010-06-09 19:55:47', NULL, NULL),
(12, 'O potencial brasileiro para gerar energia a partir da\nbiomassa não se limita a uma ampliação do Pró-álcool.\nO país pode substituir o óleo diesel de petróleo por grande\nvariedade de óleos vegetais e explorar a alta produtividade\ndas florestas tropicais plantadas. Além da produção de\ncelulose, a utilização da biomassa permite a geração de\nenergia elétrica por meio de termelétricas a lenha, carvão\nvegetal ou gás de madeira, com elevado rendimento e\nbaixo custo.\nCerca de 30% do território brasileiro é constituído\npor terras impróprias para a agricultura, mas aptas à\nexploração florestal. A utilização de metade dessa área, ou\nseja, de 120 milhões de hectares, para a formação de\nflorestas energéticas, permitiria produção sustentada do\nequivalente a cerca de 5 bilhões de barris de petróleo por\nano, mais que o dobro do que produz a Arábia Saudita\natualmente.\nPara o Brasil, as vantagens da produção de energia a\npartir da biomassa incluem', 53, 'Favorável, uma vez que áreas impróprias ao desenvolvimento para agricultura poderiam ser utilizadas para o plantio de florestas destinadas à produção de energia que, de acordo com o texto, pode alcançar uma elevada produção de combustível que deve ultrapassar o da Arábia Saudita', '2010-06-09 19:58:35', NULL, NULL),
(13, 'A Lei Federal n.º 11.097/2005 dispõe sobre a\nintrodução do biodiesel na matriz energética brasileira e\nfixa em 5%, em volume, o percentual mínimo obrigatório a\nser adicionado ao óleo diesel vendido ao consumidor.\nDe acordo com essa lei, biocombustível é ?derivado de\nbiomassa renovável para uso em motores a combustão\ninterna com ignição por compressão ou, conforme\nregulamento, para geração de outro tipo de energia, que\npossa substituir parcial ou totalmente combustíveis de\norigem fóssil?.\nA introdução de biocombustíveis na matriz energética\nbrasileira', 0, 'A principal função dos biocombustíveis é reduzir os impactos ambientais, a poluição', '2010-06-09 20:00:46', '2010-06-09 20:04:28', NULL),
(14, 'Uma fonte de energia que não agride o ambiente,\né totalmente segura e usa um tipo de matéria-prima infinita\né a energia eólica, que gera eletricidade a partir da força\ndos ventos. O Brasil é um país privilegiado por ter o tipo de\nventilação necessária para produzi-la. Todavia, ela é a\nmenos usada na matriz energética brasileira. O Ministério\nde Minas e Energia estima que as turbinas eólicas\nproduzam apenas 0,25% da energia consumida no país.\nIsso ocorre porque ela compete com uma usina mais\nbarata e eficiente: a hidrelétrica, que responde por 80% da\nenergia do Brasil. O investimento para se construir uma\nhidrelétrica é de aproximadamente US$ 100 por quilowatt.\nOs parques eólicos exigem investimento de cerca de\nUS$ 2 mil por quilowatt e a construção de uma usina\nnuclear, de aproximadamente US$ 6 mil por quilowatt.\nInstalados os parques, a energia dos ventos é bastante\ncompetitiva, custando R$ 200,00 por megawatt-hora frente\na R$ 150,00 por megawatt-hora das hidrelétricas e a\nR$ 600,00 por megawatt-hora das termelétricas.\nDe acordo com o texto, entre as razões que contribuem\npara a menor participação da energia eólica na matriz\nenergética brasileira, inclui-se o fato de', 70, 'Um dos fatores que contribuem para que a energia eólica tenha menor participação na matriz energética brasileira é o fato da construção de parques eólicos ser da ordem de US$ 2000,00, o que corresponde a 20 vezes o valor necessário para se construir uma hidrelétrica', '2010-06-09 23:04:52', NULL, NULL),
(15, 'umo dos fatores que levaram à abolição da escravatura com as seguintes palavras: ?Cinco ações ou concursos diferentes cooperaram para o resultado final: 1.º) o espírito daqueles que criavam a opinião pela idéia, pela palavra, pelo sentimento, e que a faziam valer por meio do Parlamento, dos meetings [reuniões públicas], da imprensa, do ensino superior, do púlpito, dos tribunais; 2.º) a ação coercitiva dos que se propunham a destruir materialmente o formidável aparelho da escravidão, arrebatando os escravos ao poder dos senhores; 3.º) a ação\ncomplementar dos próprios proprietários, que, à medida que o movimento se precipitava, iam libertando em massa as suas ?fábricas?; 4.º) a ação política dos estadistas, representando as concessões do governo; 5.º) a ação da família imperial.?\nNesse texto, Joaquim Nabuco afirma que a abolição da escravatura foi o resultado de uma luta ', 74, 'Verdadeira. Exigindo uma minuciosa análise das idéias do autor, a questão exige do aluno perceber qual a alternativa melhor consegue sintetizar os motivos, apontados pelo estadista Joaquim Nabuco, para o fim da escravidão. Nesta afirmativa podemos assinalar de maneira bastante equilibrada o resumo das idéias do autor sem colocar outros argumentos que, mesmo sendo coerentes, não integram a compreensão tecida por Joaquim Nabuco.', '2010-06-09 23:11:13', NULL, NULL),
(16, 'Existe uma regra religiosa, aceita pelos praticantes do\njudaísmo e do islamismo, que proíbe o consumo de carne\nde porco. Estabelecida na Antiguidade, quando os judeus\nviviam em regiões áridas, foi adotada, séculos depois, por\nárabes islamizados, que também eram povos do deserto.\nEssa regra pode ser entendida como', 83, 'Verdadeira. Tendo como pressuposto histórico o intenso contato que as diversas culturas do Oriente Próximo e do Oriente Médio estabeleceram durante sua trajetória, a afirmativa utiliza de um ?simples? hábito alimentar para assim assinalar a troca de saberes, costumes e crenças ocorridos ? ao longo séculos ? entre os povos da Antiguidade Oriental', '2010-06-09 23:15:48', NULL, NULL),
(17, 'Em cada parada ou pouso, para jantar ou dormir,\nos bois são contados, tanto na chegada quanto na saída.\nNesses lugares, há sempre um potreiro, ou seja,\ndeterminada área de pasto cercada de arame, ou\nmangueira, quando a cerca é de madeira. Na porteira de\nentrada do potreiro, rente à cerca, os peões formam a\nseringa ou funil, para afinar a fila, e então os bois vão\nentrando aos poucos na área cercada. Do lado interno, o\ncondutor vai contando; em frente a ele, está o marcador,\npeão que marca as reses. O condutor conta 50 cabeças e\ngrita: ? Talha! O marcador, com o auxílio dos dedos das\nmãos, vai marcando as talhas. Cada dedo da mão direita\ncorresponde a 1 talha, e da mão esquerda, a 5 talhas.\nQuando entra o último boi, o marcador diz: ? Vinte e cinco\ntalhas! E o condutor completa: ? E dezoito cabeças. Isso\nsignifica 1.268 bois.\nPara contar os 1.268 bois de acordo com o processo descrito acima, o marcador utilizou ', 88, 'Verdadeiro. Todos os dedos da mão esquerda contados uma única vez é igual a 1250 bois. Para 1268 faltam 18 bois que é uma quantidade que não será contadas nem na mão esquerda e nem na direita será apenas anunciada pelo condutor', '2010-06-09 23:28:29', NULL, NULL),
(18, 'A velha Totonha de quando em vez batia no engenho.\nE era um acontecimento para a meninada... Que talento ela\npossuía para contar as suas histórias, com um jeito admirável\nde falar em nome de todos os personagens, sem nenhum dente\nna boca, e com uma voz que dava todos os tons às palavras!\nHavia sempre rei e rainha, nos seus contos, e forca e\nadivinhações. E muito da vida, com as suas maldades e as suas\ngrandezas, a gente encontrava naqueles heróis e naqueles\nintrigantes, que eram sempre castigados com mortes horríveis!\nO que fazia a velha Totonha mais curiosa era a cor local que ela\npunha nos seus descritivos. Quando ela queria pintar um reino\nera como se estivesse falando dum engenho fabuloso. Os rios e\nflorestas por onde andavam os seus personagens se pareciam\nmuito com a Paraíba e a Mata do Rolo. O seu Barba-Azul era\num senhor de engenho de Pernambuco.\nNa construção da personagem ?velha Totonha?, é possível\nidentificar traços que revelam marcas do processo de\ncolonização e de civilização do país. Considerando o texto\nacima, infere-se que a velha Totonha', 93, 'Verdadeira. Totonha representa um dado híbrido da constituição identitária e cultural do nosso país ao pretender amealhar personagens, valores e cenários europeus e regionais', '2010-06-09 23:33:57', NULL, NULL),
(19, 'Na América inglesa, não houve nenhum processo\nsistemático de catequese e de conversão dos índios ao\ncristianismo, apesar de algumas iniciativas nesse sentido.\nBrancos e índios confrontaram-se muitas vezes e mantiveramse\nseparados. Na América portuguesa, a catequese dos índios\ncomeçou com o próprio processo de colonização, e a\nmestiçagem teve dimensões significativas. Tanto na América\ninglesa quanto na portuguesa, as populações indígenas foram\nmuito sacrificadas. Os índios não tinham defesas contra as\ndoenças trazidas pelos brancos, foram derrotados pelas armas\nde fogo destes últimos e, muitas vezes, escravizados.\nNo processo de colonização das Américas, as populações\nindígenas da América portuguesa', 94, 'Verdadeira. Sendo um país com fortes tradições religiosas vinculadas ao catolicismo, Portugal contou com uma marcante participação de membros da Igreja na justificação e na ordenação do ambiente colonial lusitano. Além disso, o projeto de expansão religiosa pregado com a criação da ordem jesuítica contribuiu significativamente para que o processo de conversão religiosa se desse de maneira sistemática no ambiente colonial português', '2010-06-09 23:37:24', NULL, NULL),
(20, 'Em discurso proferido em 17 de março de 1939, o\nprimeiro-ministro inglês à época, Neville Chamberlain,\nsustentou sua posição política: ?Não necessito defender\nminhas visitas à Alemanha no outono passado, que\nalternativa existia? Nada do que pudéssemos ter feito,\nnada do que a França pudesse ter feito, ou mesmo a\nRússia, teria salvado a Tchecoslováquia da destruição.\nMas eu também tinha outro propósito ao ir até Munique.\nEra o de prosseguir com a política por vezes chamada de\n?apaziguamento europeu?, e Hitler repetiu o que já havia\ndito, ou seja, que os Sudetos, região de população alemã\nna Tchecoslováquia, eram a sua última ambição territorial\nna Europa, e que não queria incluir na Alemanha outros\npovos que não os alemães.?\nSabendo-se que o compromisso assumido por Hitler em\n1938, mencionado no texto acima, foi rompido pelo líder\nalemão em 1939, infere-se que', 99, 'Verdadeira. Mesmo assumindo os compromissos assinalados na Conferência de Munique, Hitler se negou a cumprir os acordos as pressionar politicamente a Polônia para incorporar a região de Dantzig e criar uma ferrovia que dava acesso ao ?corredor polonês?. Além disso, reafirmando seu pretensioso projeto expansionista, Hitler incorporou integralmente os territórios da Tchecoslováquia, no início de 1939', '2010-06-09 23:44:47', NULL, NULL),
(21, 'O ano de 1954 foi decisivo para Carlos Lacerda.\nOs que conviveram com ele em 1954, 1955, 1957 (um dos\nseus momentos intelectuais mais altos, quando o governo\nJuscelino tentou cassar o seu mandato de deputado),\n1961 e 1964 tinham consciência de que Carlos Lacerda,\nem uma batalha política ou jornalística, era um trator em\nação, era um vendaval desencadeado não se sabe como,\nmas que era impossível parar fosse pelo método que\nfosse. Com base nas informações do texto acima e em aspectos\nrelevantes da história brasileira entre 1954, quando\nocorreu o suicídio de Vargas (em grande medida, devido à\npressão política exercida pelo próprio Lacerda), e 1964,\nquando um golpe de Estado interrompe a trajetória\ndemocrática do país, conclui-se que', 108, 'Verdadeira. JK sabia da articulada capacidade que Carlos Lacerda tinha em criticar as autoridades, suas articulações com setores militares golpistas e seu acesso aos meios de comunicação da época, Lacerda foi impedido pelo presidente de ter acesso à proeminente mídia televisiva da época.', '2010-06-09 23:48:57', NULL, NULL),
(22, 'Na América do Sul, as Forças Armadas\nRevolucionárias da Colômbia (Farc) lutam, há décadas,\npara impor um regime de inspiração marxista no país.\nHoje, são acusadas de envolvimento com o narcotráfico, o\nqual supostamente financia suas ações, que incluem\nataques diversos, assassinatos e seqüestros.\nNa Ásia, a Al Qaeda, criada por Osama bin Laden,\ndefende o fundamentalismo islâmico e vê nos Estados\nUnidos da América (EUA) e em Israel inimigos poderosos,\nos quais deve combater sem trégua. A mais conhecida de\nsuas ações terroristas ocorreu em 2001, quando foram\natingidos o Pentágono e as torres do World Trade Center.\nA partir das informações acima, conclui-se que', 111, 'Verdadeira. Os atentados de 11 de setembro promoveram uma grande revisão nas políticas de proteção territorial dos EUA. A destruição do World Trade Center, um dos maiores pontos de transação econômica norte-americano, expôs a inimaginável fragilidade a qual a nação americana estava exposta', '2010-06-09 23:53:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao_alternativa`
--

CREATE TABLE IF NOT EXISTS `questao_alternativa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `questao_id` int(10) unsigned NOT NULL,
  `descricao` mediumtext NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questao_alternativa_FKIndex1` (`questao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Extraindo dados da tabela `questao_alternativa`
--

INSERT INTO `questao_alternativa` (`id`, `questao_id`, `descricao`, `date_create`, `date_update`, `date_delete`) VALUES
(1, 2, 'Leo Popik', '2010-05-25 21:59:21', NULL, NULL),
(2, 2, 'Popik', '2010-05-25 21:59:21', NULL, NULL),
(3, 2, 'Nos', '2010-05-25 21:59:21', NULL, NULL),
(14, 5, 'I, apenas', '2010-06-08 23:30:02', NULL, NULL),
(15, 5, 'III, apenas', '2010-06-08 23:30:02', NULL, NULL),
(16, 5, 'I e II, apenas', '2010-06-08 23:30:02', NULL, NULL),
(17, 5, 'II e III, apenas', '2010-06-08 23:30:02', NULL, NULL),
(18, 5, 'I, II e III', '2010-06-08 23:30:03', NULL, NULL),
(19, 6, 'onde chove, há floresta', '2010-06-08 23:34:28', NULL, NULL),
(20, 6, 'onde a floresta cresce, chove', '2010-06-08 23:34:29', NULL, NULL),
(21, 6, 'onde há oceano, há floresta', '2010-06-08 23:34:29', NULL, NULL),
(22, 6, 'apesar da chuva, a floresta cresce', '2010-06-08 23:34:29', NULL, NULL),
(23, 6, 'no interior do continente, só chove onde há floresta', '2010-06-08 23:34:29', NULL, NULL),
(24, 7, 'o manduvi depende diretamente tanto do tucano-toco\r\ncomo da arara-azul para sua sobrevivência', '2010-06-09 19:35:15', NULL, NULL),
(25, 7, 'o tucano-toco, depois de engolir sementes de\r\nmanduvi, digere-as e torna-as inviáveis', '2010-06-09 19:35:16', NULL, NULL),
(26, 7, 'a conservação da arara-azul exige a redução da\r\npopulação de manduvis e o aumento da população de\r\ntucanos-toco', '2010-06-09 19:35:16', NULL, NULL),
(27, 7, 'a conservação das araras-azuis depende também da\r\nconservação dos tucanos-toco, apesar de estes serem\r\npredadores daquelas', '2010-06-09 19:35:16', NULL, NULL),
(28, 7, 'derrubada de manduvis em decorrência do\r\ndesmatamento diminui a disponibilidade de locais para\r\nos tucanos fazerem seus ninhos', '2010-06-09 19:35:16', NULL, NULL),
(29, 8, 'o carvão mineral, ao ser colocado na água, reage com\r\no benzeno, eliminando-o', '2010-06-09 19:42:57', NULL, NULL),
(30, 8, 'o benzeno é mais volátil que a água e, por isso, é\r\nnecessário que esta seja fervida', '2010-06-09 19:42:57', NULL, NULL),
(31, 8, 'a orientação para se evitar a pesca deve-se à\r\nnecessidade de preservação dos peixes', '2010-06-09 19:42:57', NULL, NULL),
(32, 8, 'o benzeno não contaminaria os dutos de água potável,\r\nporque seria decantado naturalmente no fundo do rio', '2010-06-09 19:42:57', NULL, NULL),
(33, 8, 'a poluição causada pelo derramamento de benzeno da\r\nindústria chinesa ficaria restrita ao rio Songhua', '2010-06-09 19:42:58', NULL, NULL),
(34, 9, 'é ambientalmente benéfico por contribuir para a\r\nseleção natural das espécies e, conseqüentemente,\r\npara a evolução delas', '2010-06-09 19:46:29', NULL, NULL),
(35, 9, 'trouxe da China um molusco, que passou a compor a\r\nflora aquática nativa do lago da hidrelétrica de Itaipu', '2010-06-09 19:46:29', NULL, NULL),
(36, 9, 'causou, na usina de Itaipu, por meio do microrganismo\r\ninvasor, uma redução do suprimento de água para as\r\nturbinas', '2010-06-09 19:46:29', NULL, NULL),
(37, 9, 'introduziu uma espécie exógena na bacia Paraná-\r\nParaguai, que se disseminou até ser controlada por\r\nseus predadores naturais', '2010-06-09 19:46:29', NULL, NULL),
(38, 9, 'motivou a utilização de um agente químico na água\r\ncomo uma das estratégias para diminuir a reprodução\r\ndo mexilhão dourado', '2010-06-09 19:46:30', NULL, NULL),
(39, 10, 'utilizam a mesma fonte primária de energia que as\nusinas nucleares, sendo, portanto, semelhantes os\nriscos decorrentes de ambas', '2010-06-09 19:51:10', NULL, NULL),
(40, 10, 'funcionam com base na conversão de energia\npotencial gravitacional em energia térmica', '2010-06-09 19:51:10', NULL, NULL),
(41, 10, 'podem aproveitar a energia química transformada em\ntérmica no processo de dessalinização', '2010-06-09 19:51:10', NULL, NULL),
(42, 10, 'assemelham-se às usinas nucleares no que diz\nrespeito à conversão de energia térmica em cinética e,\ndepois, em elétrica', '2010-06-09 19:51:10', NULL, NULL),
(43, 10, 'transformam inicialmente a energia solar em energia\ncinética e, depois, em energia térmica', '2010-06-09 19:51:10', NULL, NULL),
(44, 11, 'ambientais: a exploração do xisto ocasiona pouca\ninterferência no solo e no subsolo', '2010-06-09 19:55:47', NULL, NULL),
(45, 11, 'técnicos: a fluidez do xisto facilita o processo de produção\nde óleo, embora seu uso demande troca de equipamentos', '2010-06-09 19:55:47', NULL, NULL),
(46, 11, 'econômicos: é baixo o custo da mineração e da\nprodução de xisto', '2010-06-09 19:55:47', NULL, NULL),
(47, 11, 'políticos: a importação de xisto, para atender o\nmercado interno, ampliará alianças com outros países', '2010-06-09 19:55:47', NULL, NULL),
(48, 11, 'estratégicos: a entrada do xisto no mercado é\noportuna diante da possibilidade de aumento dos\npreços do petróleo', '2010-06-09 19:55:47', NULL, NULL),
(49, 12, 'implantação de florestas energéticas em todas as\nregiões brasileiras com igual custo ambiental e\neconômico', '2010-06-09 19:58:35', NULL, NULL),
(50, 12, 'substituição integral, por biodiesel, de todos os\ncombustíveis fósseis derivados do petróleo', '2010-06-09 19:58:35', NULL, NULL),
(51, 12, 'formação de florestas energéticas em terras impróprias\npara a agricultura', '2010-06-09 19:58:35', NULL, NULL),
(52, 12, 'importação de biodiesel de países tropicais, em que a\nprodutividade das florestas seja mais alta', '2010-06-09 19:58:35', NULL, NULL),
(53, 12, 'regeneração das florestas nativas em biomas\nmodificados pelo homem, como o Cerrado e a Mata\nAtlântica', '2010-06-09 19:58:35', NULL, NULL),
(54, 13, 'colabora na redução dos efeitos da degradação\nambiental global produzida pelo uso de combustíveis\nfósseis, como os derivados do petróleo', '2010-06-09 20:04:28', NULL, NULL),
(55, 13, 'provoca uma redução de 5% na quantidade de\ncarbono emitido pelos veículos automotores e\ncolabora no controle do desmatamento', '2010-06-09 20:04:28', NULL, NULL),
(56, 13, 'incentiva o setor econômico brasileiro a se adaptar ao\nuso de uma fonte de energia derivada de uma\nbiomassa inesgotável', '2010-06-09 20:04:28', NULL, NULL),
(57, 13, 'aponta para pequena possibilidade de expansão do\nuso de biocombustíveis, fixado, por lei, em 5% do\nconsumo de derivados do petróleo', '2010-06-09 20:04:28', NULL, NULL),
(58, 13, 'diversifica o uso de fontes alternativas de energia que\nreduzem os impactos da produção do etanol por meio\nda monocultura da cana-de-açucar', '2010-06-09 20:04:28', NULL, NULL),
(59, 3, 'A palavra Cut’uxu é um regionalismo utilizado pelas\r\npopulações próximas às aldeias indígenas', '2010-06-09 20:20:55', NULL, NULL),
(60, 3, 'O autor se expressa em linguagem formal em todos os\r\nperíodos do texto', '2010-06-09 20:20:55', NULL, NULL),
(61, 3, 'A ausência da palavra Ema no início do período\r\n“É limitada (...)” caracteriza registro oral', '2010-06-09 20:20:55', NULL, NULL),
(62, 3, 'A palavra Cut’uxu está destacada em itálico porque\r\nintegra o vocabulário da linguagem informal', '2010-06-09 20:20:55', NULL, NULL),
(63, 3, 'No texto, predomina a linguagem coloquial porque ele\r\nconsta de um almanaque', '2010-06-09 20:20:55', NULL, NULL),
(64, 4, 'o desmatamento na Amazônia decorre principalmente\r\nda exploração ilegal de árvores de valor comercial', '2010-06-09 20:51:46', NULL, NULL),
(65, 4, 'um dos problemas que os pecuaristas vêm\r\nenfrentando na Amazônia é a proibição do plantio de\r\nsoja', '2010-06-09 20:51:46', NULL, NULL),
(66, 4, 'a mobilização de máquinas e de força humana torna o\r\ndesmatamento mais caro que o aumento da\r\nprodutividade de pastagens', '2010-06-09 20:51:47', NULL, NULL),
(67, 4, 'o superavit comercial decorrente da exportação de\r\ncarne produzida na Amazônia compensa a possível\r\ndegradação ambiental', '2010-06-09 20:51:47', NULL, NULL),
(68, 4, 'a recuperação de áreas desmatadas e o aumento de\r\nprodutividade das pastagens podem contribuir para a\r\nredução do desmatamento na Amazônia', '2010-06-09 20:51:47', NULL, NULL),
(69, 14, 'haver, no país, baixa disponibilidade de ventos que podem gerar energia elétrica', '2010-06-09 23:04:52', NULL, NULL),
(70, 14, 'o investimento por quilowatt exigido para a construção de parques eólicos ser de aproximadamente 20 vezes o necessário para a construção de hidrelétricas', '2010-06-09 23:04:52', NULL, NULL),
(71, 14, 'o investimento por quilowatt exigido para a construção de parques eólicos ser igual a 1/3 do necessário para a construção de usinas nucleares', '2010-06-09 23:04:52', NULL, NULL),
(72, 14, 'o custo médio por megawatt-hora de energia obtida após instalação de parques eólicos ser igual a 1,2 multiplicado pelo custo médio do megawatt-hora obtido das hidrelétricas', '2010-06-09 23:04:52', NULL, NULL),
(73, 14, 'o custo médio por megawatt-hora de energia obtida após instalação de parques eólicos ser igual a 1/3 do custo médio do megawatt-hora obtido das termelétricas', '2010-06-09 23:04:52', NULL, NULL),
(74, 15, 'de idéias, associada a ações contra a organização escravista, com o auxílio de proprietários que libertavam seus escravos, de estadistas e da ação da família imperial', '2010-06-09 23:11:13', NULL, NULL),
(75, 15, 'de classes, associada a ações contra a organização escravista, que foi seguida pela ajuda de proprietários que substituíam os escravos por assalariados, o que provocou a adesão de estadistas e, posteriormente, ações republicanas', '2010-06-09 23:11:13', NULL, NULL),
(76, 15, 'partidária, associada a ações contra a organização escravista, com o auxílio de proprietários que mudavam seu foco de investimento e da ação da família imperia', '2010-06-09 23:11:13', NULL, NULL),
(77, 15, 'política, associada a ações contra a organização escravista, sabotada por proprietários que buscavam manter o escravismo, por estadistas e pela ação republicana contra a realeza', '2010-06-09 23:11:13', NULL, NULL),
(78, 15, 'religiosa, associada a ações contra a organização escravista, que fora apoiada por proprietários que haviam substituído os seus escravos por imigrantes, o que resultou na adesão de estadistas republicanos na luta contra a realeza', '2010-06-09 23:11:13', NULL, NULL),
(79, 16, 'uma demonstração de que o islamismo é um ramo do judaísmo tradicional', '2010-06-09 23:15:48', NULL, NULL),
(80, 16, 'um indício de que a carne de porco era rejeitada em toda a Ásia', '2010-06-09 23:15:48', NULL, NULL),
(81, 16, 'uma certeza de que do judaísmo surgiu o islamismo', '2010-06-09 23:15:48', NULL, NULL),
(82, 16, 'uma prova de que a carne do porco era largamente consumida fora das regiões áridas', '2010-06-09 23:15:48', NULL, NULL),
(83, 16, 'uma crença antiga de que o porco é um animal impuro', '2010-06-09 23:15:48', NULL, NULL),
(84, 17, '20 vezes todos os dedos da mão esquerda', '2010-06-09 23:28:29', NULL, NULL),
(85, 17, '20 vezes todos os dedos da mão direita', '2010-06-09 23:28:30', NULL, NULL),
(86, 17, 'todos os dedos da mão direita apenas uma vez', '2010-06-09 23:28:30', NULL, NULL),
(87, 17, 'todos os dedos da mão esquerda apenas uma vez', '2010-06-09 23:28:30', NULL, NULL),
(88, 17, '5 vezes todos os dedos da mão esquerda e 5 vezes todos os dedos da mão direita', '2010-06-09 23:28:30', NULL, NULL),
(89, 18, 'tira o seu sustento da produção da literatura, apesar de suas condições de vida e de trabalho, que denotam que ela enfrenta situação econômica muito adversa.', '2010-06-09 23:33:57', NULL, NULL),
(90, 18, 'compõe, em suas histórias, narrativas épicas e realistas da história do país colonizado, livres da influência de temas e modelos não representativos da realidade nacional', '2010-06-09 23:33:57', NULL, NULL),
(91, 18, 'retrata, na constituição do espaço dos contos, a civilização urbana européia em concomitância com a representação literária de engenhos, rios e florestas do Brasil', '2010-06-09 23:33:57', NULL, NULL),
(92, 18, 'aproxima-se, ao incluir elementos fabulosos nos contos, do próprio romancista, o qual pretende retratar a realidade brasileira de forma tão grandiosa quanto a européia', '2010-06-09 23:33:57', NULL, NULL),
(93, 18, 'imprime marcas da realidade local a suas narrativas, que têm como modelo e origem as fontes da literatura e da cultura européia universalizada', '2010-06-09 23:33:57', NULL, NULL),
(94, 19, 'foram submetidas a um processo de doutrinação religiosa que não ocorreu com os indígenas da América inglesa', '2010-06-09 23:37:24', NULL, NULL),
(95, 19, 'mantiveram sua cultura tão intacta quanto a dos indígenas da América inglesa', '2010-06-09 23:37:24', NULL, NULL),
(96, 19, 'passaram pelo processo de mestiçagem, que ocorreu amplamente com os indígenas da América inglesa', '2010-06-09 23:37:24', NULL, NULL),
(97, 19, 'diferenciaram-se dos indígenas da América inglesa por terem suas terras devolvidas', '2010-06-09 23:37:24', NULL, NULL),
(98, 19, 'resistiram, como os indígenas da América inglesa, às doenças trazidas pelos brancos', '2010-06-09 23:37:24', NULL, NULL),
(99, 20, 'Hitler ambicionava o controle de mais territórios na\nEuropa além da região dos Sudetos', '2010-06-09 23:44:47', NULL, NULL),
(100, 20, 'a aliança entre a Inglaterra, a França e a Rússia poderia ter salvado a Tchecoslováquia', '2010-06-09 23:44:47', NULL, NULL),
(101, 20, 'o rompimento desse compromisso inspirou a política de apaziguamento europeu', '2010-06-09 23:44:47', NULL, NULL),
(102, 20, 'a política de Chamberlain de apaziguar o líder alemão era contrária à posição assumida pelas potências aliadas', '2010-06-09 23:44:47', NULL, NULL),
(103, 20, 'a forma que Chamberlain escolheu para lidar com o problema dos Sudetos deu origem à destruição da Tchecoslováquia', '2010-06-09 23:44:47', NULL, NULL),
(104, 21, 'a cassação do mandato parlamentar de Lacerda antecedeu a crise que levou Vargas à morte', '2010-06-09 23:48:57', NULL, NULL),
(105, 21, 'Lacerda e adeptos do getulismo, aparentemente opositores, expressavam a mesma posição políticoideológica', '2010-06-09 23:48:57', NULL, NULL),
(106, 21, 'a implantação do regime militar, em 1964, decorreu da crise surgida com a contestação à posse de Juscelino Kubitschek como presidente da República', '2010-06-09 23:48:57', NULL, NULL),
(107, 21, 'Carlos Lacerda atingiu o apogeu de sua carreira, tanto no jornalismo quanto na política, com a instauração do regime militar', '2010-06-09 23:48:57', NULL, NULL),
(108, 21, 'Juscelino Kubitschek, na presidência da República, sofreu vigorosa oposição de Carlos Lacerda, contra quem procurou reagir', '2010-06-09 23:48:57', NULL, NULL),
(109, 22, 'as ações guerrilheiras e terroristas no mundo contemporâneo usam métodos idênticos para alcançar os mesmos propósitos', '2010-06-09 23:53:58', NULL, NULL),
(110, 22, 'o apoio internacional recebido pelas Farc decorre do desconhecimento, pela maioria das nações, das práticas violentas dessa organização', '2010-06-09 23:53:58', NULL, NULL),
(111, 22, 'os EUA, mesmo sendo a maior potência do planeta, foram surpreendidos com ataques terroristas que atingiram alvos de grande importância simbólica', '2010-06-09 23:53:58', NULL, NULL),
(112, 22, 'as organizações mencionadas identificam-se quanto aos princípios religiosos que defendem', '2010-06-09 23:53:58', NULL, NULL),
(113, 22, 'tanto as Farc quanto a Al Qaeda restringem sua atuação à área geográfica em que se localizam, respectivamente, América do Sul e Ásia', '2010-06-09 23:53:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao_aluno`
--

CREATE TABLE IF NOT EXISTS `questao_aluno` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao_questao_id` int(10) unsigned NOT NULL,
  `aluno_pessoa_escola_matricula` varchar(10) NOT NULL,
  `aluno_pessoa_escola_pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `inicio` datetime NOT NULL,
  `tempo_resolucao` time DEFAULT NULL,
  `resposta` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questao_aluno_FKIndex2` (`aluno_pessoa_escola_pessoa_fisica_pessoa_id`,`aluno_pessoa_escola_matricula`),
  KEY `questao_aluno_FKIndex3` (`avaliacao_questao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `questao_aluno`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `usabilidade_questao`
--

CREATE TABLE IF NOT EXISTS `usabilidade_questao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao_id` int(10) unsigned NOT NULL,
  `professor_pessoa_escola_matricula` varchar(10) NOT NULL,
  `professor_pessoa_escola_pessoa_fisica_pessoa_id` int(10) unsigned NOT NULL,
  `questao_alternativa_id` int(10) unsigned NOT NULL,
  `data_escolha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usabilidade_questao_FKIndex1` (`questao_alternativa_id`),
  KEY `usabilidade_questao_FKIndex2` (`professor_pessoa_escola_pessoa_fisica_pessoa_id`,`professor_pessoa_escola_matricula`),
  KEY `usabilidade_questao_FKIndex3` (`avaliacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `usabilidade_questao`
--


--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`pessoa_escola_matricula`, `pessoa_escola_pessoa_fisica_pessoa_id`) REFERENCES `pessoa_escola` (`matricula`, `pessoa_fisica_pessoa_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `aluno_resolve_questao`
--
ALTER TABLE `aluno_resolve_questao`
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_2` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_3` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_4` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_5` FOREIGN KEY (`questao_alternativa_id`) REFERENCES `questao_alternativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `assunto_questao`
--
ALTER TABLE `assunto_questao`
  ADD CONSTRAINT `assunto_questao_ibfk_1` FOREIGN KEY (`assunto_id`) REFERENCES `assunto` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `assunto_questao_ibfk_2` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`avaliacao_situacao_id`) REFERENCES `avaliacao_situacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `avaliacao_aluno`
--
ALTER TABLE `avaliacao_aluno`
  ADD CONSTRAINT `avaliacao_aluno_ibfk_1` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `avaliacao_aluno_ibfk_2` FOREIGN KEY (`aluno_pessoa_escola_pessoa_fisica_pessoa_id`, `aluno_pessoa_escola_matricula`) REFERENCES `aluno` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `avaliacao_nivel`
--
ALTER TABLE `avaliacao_nivel`
  ADD CONSTRAINT `avaliacao_nivel_ibfk_1` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `avaliacao_questao`
--
ALTER TABLE `avaliacao_questao`
  ADD CONSTRAINT `avaliacao_questao_ibfk_1` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `avaliacao_questao_ibfk_2` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `disciplina_assunto`
--
ALTER TABLE `disciplina_assunto`
  ADD CONSTRAINT `disciplina_assunto_ibfk_1` FOREIGN KEY (`assunto_id`) REFERENCES `assunto` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `disciplina_assunto_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `feedback_avaliacao_alternativa`
--
ALTER TABLE `feedback_avaliacao_alternativa`
  ADD CONSTRAINT `feedback_avaliacao_alternativa_ibfk_1` FOREIGN KEY (`feedbackAvaliacao_id`) REFERENCES `feedbackavaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `feedback_avaliacao_aluno`
--
ALTER TABLE `feedback_avaliacao_aluno`
  ADD CONSTRAINT `feedback_avaliacao_aluno_ibfk_1` FOREIGN KEY (`feedback_avaliacao_alternativa_id`) REFERENCES `feedback_avaliacao_alternativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `feedback_avaliacao_aluno_ibfk_2` FOREIGN KEY (`avaliacao_aluno_id`) REFERENCES `avaliacao_aluno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `nivel_avaliacao`
--
ALTER TABLE `nivel_avaliacao`
  ADD CONSTRAINT `nivel_avaliacao_ibfk_1` FOREIGN KEY (`professor_avaliacao_id`) REFERENCES `professor_avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `nivel_questao`
--
ALTER TABLE `nivel_questao`
  ADD CONSTRAINT `nivel_questao_ibfk_1` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `pessoa_escola`
--
ALTER TABLE `pessoa_escola`
  ADD CONSTRAINT `pessoa_escola_ibfk_1` FOREIGN KEY (`pessoa_fisica_pessoa_id`) REFERENCES `pessoa_fisica` (`pessoa_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `pessoa_escola_disciplina`
--
ALTER TABLE `pessoa_escola_disciplina`
  ADD CONSTRAINT `pessoa_escola_disciplina_ibfk_1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pessoa_escola_disciplina_ibfk_2` FOREIGN KEY (`pessoa_escola_matricula`, `pessoa_escola_pessoa_fisica_pessoa_id`) REFERENCES `pessoa_escola` (`matricula`, `pessoa_fisica_pessoa_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `pessoa_fisica`
--
ALTER TABLE `pessoa_fisica`
  ADD CONSTRAINT `pessoa_fisica_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `pessoa_juridica`
--
ALTER TABLE `pessoa_juridica`
  ADD CONSTRAINT `pessoa_juridica_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`pessoa_escola_matricula`, `pessoa_escola_pessoa_fisica_pessoa_id`) REFERENCES `pessoa_escola` (`matricula`, `pessoa_fisica_pessoa_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `professor_avaliacao`
--
ALTER TABLE `professor_avaliacao`
  ADD CONSTRAINT `professor_avaliacao_ibfk_1` FOREIGN KEY (`professor_pessoa_escola_pessoa_fisica_pessoa_id`, `professor_pessoa_escola_matricula`) REFERENCES `professor` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `professor_avaliacao_ibfk_2` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `questao_alternativa`
--
ALTER TABLE `questao_alternativa`
  ADD CONSTRAINT `questao_alternativa_ibfk_1` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restrições para a tabela `questao_aluno`
--
ALTER TABLE `questao_aluno`
  ADD CONSTRAINT `questao_aluno_ibfk_1` FOREIGN KEY (`aluno_pessoa_escola_pessoa_fisica_pessoa_id`, `aluno_pessoa_escola_matricula`) REFERENCES `aluno` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `questao_aluno_ibfk_2` FOREIGN KEY (`avaliacao_questao_id`) REFERENCES `avaliacao_questao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `usabilidade_questao`
--
ALTER TABLE `usabilidade_questao`
  ADD CONSTRAINT `usabilidade_questao_ibfk_1` FOREIGN KEY (`questao_alternativa_id`) REFERENCES `questao_alternativa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usabilidade_questao_ibfk_2` FOREIGN KEY (`professor_pessoa_escola_pessoa_fisica_pessoa_id`, `professor_pessoa_escola_matricula`) REFERENCES `professor` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usabilidade_questao_ibfk_3` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

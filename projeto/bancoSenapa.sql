-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Gera��o: Jun 14, 2010 as 05:45 PM
-- Vers�o do Servidor: 5.1.37
-- Vers�o do PHP: 5.2.10

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
(12, 'A123456', 'Inform�tica');

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
(1, 'Geometria Anal�tica', '2010-05-23 19:20:37', '2010-05-24 01:32:16', NULL),
(2, 'Geometria Espacial', '2010-05-23 19:21:36', '2010-05-26 22:52:08', NULL),
(3, '�gua', '2010-06-07 22:06:46', NULL, NULL),
(4, 'Interpreta��o', '2010-06-08 23:06:42', NULL, NULL),
(5, 'L�gica', '2010-06-08 23:32:04', NULL, NULL),
(6, 'Energia', '2010-06-09 19:49:02', NULL, NULL),
(7, 'Petr�leo', '2010-06-09 19:54:08', NULL, NULL),
(8, 'Escravid�o', '2010-06-09 23:07:40', NULL, NULL),
(9, 'Antiguidade', '2010-06-09 23:13:41', NULL, NULL),
(10, 'Indicadores (Ex.: natalidade, mortalidade)', '2010-06-09 23:21:35', NULL, NULL),
(11, 'Coloniza��o', '2010-06-09 23:30:19', NULL, NULL),
(12, 'Segunda Guerra Mundial', '2010-06-09 23:43:05', NULL, NULL),
(13, 'Hist�ria Brasileira', '2010-06-09 23:46:17', NULL, NULL),
(14, 'Hist�ria Geral', '2010-06-09 23:52:24', NULL, NULL);

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
(1, 3, '1� Avalia��o', '2010-06-08', '09:00:00', '2010-06-10', '23:59:00', '01:00:00', '03:00:00', 1, '2010-06-07 21:31:42', '2010-06-10 01:38:40', NULL);

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
(1, 'V�lida', 1, '2010-05-18 23:57:51', NULL, NULL),
(2, 'Inv�lida', 1, '2010-05-18 23:58:03', NULL, '2010-05-19 00:05:11'),
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
(1, 'S 20', 'Matem�tica', '2010-05-19 00:03:28', NULL, NULL),
(2, 'A 202', 'Portugu�s', '2010-05-19 00:04:45', '2010-05-19 00:04:59', NULL),
(3, 'C001', 'Ci�ncias', '2010-06-07 22:01:46', NULL, NULL),
(4, 'Q 0001', 'Qu�mica', '2010-06-09 19:39:13', NULL, NULL),
(5, 'F001', 'F�sica', '2010-06-09 19:48:25', NULL, NULL),
(6, 'H001', 'Hist�ria', '2010-06-09 23:07:07', NULL, NULL),
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
(1, 1, 'Muito F�cil', 1, '2010-06-10 15:43:12', NULL, NULL),
(2, 1, 'F�cil', 1, '2010-06-10 15:43:14', NULL, NULL),
(3, 1, 'Dif�cil', 1, '2010-06-10 15:43:16', NULL, NULL),
(4, 1, 'Muito Dif�cil', 1, '2010-06-10 15:43:17', NULL, NULL);

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
(1, '45.677.473/0001-66', 'L�o Popik Sistemas', NULL, NULL);

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
(11, 'P0510387', 'Ci�ncia da Computa��o', NULL);

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
(1, 'Quem � o melhor amigo do homem', 0, 'O melhor amigo do homem � o cachorro', '2010-05-23 19:48:52', NULL, '2010-06-10 01:36:39'),
(2, 'Quem', 2, 'Uma explica de quem', '2010-05-24 22:47:10', NULL, '2010-06-10 01:36:41'),
(3, '<p>\n	O surgimento da figura da Ema no c&eacute;u, ao leste, no anoitecer, na segunda quinzena de junho, indica o in&iacute;cio do inverno para os &iacute;ndios do sul do Brasil e o come&ccedil;o da esta&ccedil;&atilde;o seca para os do norte. &Eacute; limitada pelas constela&ccedil;&otilde;es de Escorpi&atilde;o e do Cruzeiro do Sul, ou Cut&#39;uxu. Segundo o mito guarani, o Cut?uxu segura a cabe&ccedil;a da ave para garantir a vida na Terra, porque, se ela se soltar, beber&aacute; toda a &aacute;gua do nosso planeta. Os tupisguaranis utilizam o Cut&#39;uxu para se orientar e determinar a dura&ccedil;&atilde;o das noites e as esta&ccedil;&otilde;es do ano. Assinale a op&ccedil;&atilde;o correta a respeito da linguagem empregada no texto acima.</p>\n', 61, '<p>\n	N&atilde;o poderia ser a letra A, j&aacute; que o texto diz que a express&atilde;o Cut?uxu &eacute; pertencente &agrave;s tribos ind&iacute;genas e n&atilde;o &agrave;s popula&ccedil;&otilde;es pr&oacute;ximas, como falado na referida proposi&ccedil;&atilde;o. Tamb&eacute;m n&atilde;o poderia ser a letra C, pois n&atilde;o h&aacute; repeti&ccedil;&atilde;o da palavra ?Ema?. Seria redund&acirc;ncia e n&atilde;o h&aacute; necessidade, ao contr&aacute;rio do que &eacute; afirmado na alternativa. A palavra Cut?uxu n&atilde;o se trata de um voc&aacute;bulo coloquial, mas sim de uma palavra da l&iacute;ngua ind&iacute;gena, e est&aacute; em destaque para indicar uma denomina&ccedil;&atilde;o que n&atilde;o &eacute; da l&iacute;ngua portuguesa, logo, a op&ccedil;&atilde;o D est&aacute; descartada. A linguagem empregada segue a norma culta e expressa linguagem formal, portanto, desconsidera-se a op&ccedil;&atilde;o E e considera-se a B</p>\n', '2010-06-08 23:10:43', '2010-06-10 16:12:59', NULL),
(4, 'Calcula-se que 78% do desmatamento na\nAmaz�nia tenha sido motivado pela pecu�ria ? cerca de\n35% do rebanho nacional est� na regi�o ? e que pelo\nmenos 50 milh�es de hectares de pastos s�o pouco\nprodutivos. Enquanto o custo m�dio para aumentar a\nprodutividade de 1 hectare de pastagem � de 2 mil reais, o\ncusto para derrubar igual �rea de floresta � estimado em\n800 reais, o que estimula novos desmatamentos.\nAdicionalmente, madeireiras retiram as �rvores de valor\ncomercial que foram abatidas para a cria��o de pastagens.\nOs pecuaristas sabem que problemas ambientais como\nesses podem provocar restri��es � pecu�ria nessas �reas,\na exemplo do que ocorreu em 2006 com o plantio da soja,\no qual, posteriormente, foi proibido em �reas de floresta.\nA partir da situa��o-problema descrita, conclui-se que:', 0, 'A recupera��o de �reas degradadas e a utiliza��o de insumos para eleva��o da produtividade das pastagens impedem que haja uma expans�o das fronteiras agropecu�rias, resultando automaticamente na diminui��o dos n�veis de desmatamento.', '2010-06-08 23:21:59', '2010-06-09 20:51:46', NULL),
(5, 'Um jornal de circula��o nacional publicou a seguinte\nnot�cia:\nChoveu torrencialmente na madrugada de ontem\nem Roraima, horas depois de os paj�s caiap�s Mantii e\nKucrit, levados de Mato Grosso pela Funai, terem\nparticipado do ritual da dan�a da chuva, em Boa Vista.\nA chuva durou tr�s horas em todo o estado e as previs�es\nindicam que continuar� pelo menos at� amanh�. Com isso,\nser� poss�vel acabar de vez com o inc�ndio que ontem\ncompletou 63 dias e devastou parte das florestas do\nestado.\nJornal do Brasil, abr./1998 (com adapta��es).\nConsiderando a situa��o descrita, avalie as afirmativas\nseguintes.\nI No ritual ind�gena, a dan�a da chuva, mais que\nconstituir uma manifesta��o art�stica, tem a fun��o de\nintervir no ciclo da �gua.\nII A exist�ncia da dan�a da chuva em algumas culturas\nest� relacionada � import�ncia do ciclo da �gua para a\nvida.\nIII Uma das informa��es do texto pode ser expressa em\nlinguagem cient�fica da seguinte forma: a dan�a da\nchuva seria efetiva se provocasse a precipita��o das\ngot�culas de �gua das nuvens.\n� correto o que se afirma em:', 18, 'O item III est� incorreto pois o termo linguagem refere-se a um vocabul�rio t�cnico, e n�o a princ�pios cient�ficos', '2010-06-08 23:30:02', NULL, NULL),
(6, 'As florestas tropicais est�o entre os maiores, mais\ndiversos e complexos biomas do planeta. Novos estudos\nsugerem que elas sejam potentes reguladores do clima, ao\nprovocarem um fluxo de umidade para o interior dos\ncontinentes, fazendo com que essas �reas de floresta n�o\nsofram varia��es extremas de temperatura e tenham\numidade suficiente para promover a vida. Um fluxo\npuramente f�sico de umidade do oceano para o continente,\nem locais onde n�o h� florestas, alcan�a poucas centenas\nde quil�metros. Verifica-se, por�m, que as chuvas sobre\nflorestas nativas n�o dependem da proximidade do\noceano. Esta evid�ncia aponta para a exist�ncia de uma\npoderosa ?bomba bi�tica de umidade? em lugares como,\npor exemplo, a bacia amaz�nica. Devido � grande e densa\n�rea de folhas, as quais s�o evaporadores otimizados,\nessa ?bomba? consegue devolver rapidamente a �gua para\no ar, mantendo ciclos de evapora��o e condensa��o que\nfazem a umidade chegar a milhares de quil�metros no\ninterior do continente.\nAs florestas crescem onde chove, ou chove onde crescem\nas florestas? De acordo com o texto,', 23, 'O desenvolvimento de uma vegeta��o necessita de condi��es ambientais (aspectos f�sicos) favor�veis. Neste caso, a colabora��o da umidade provinda tanto dos oceanos, quanto a emiss�o de umidade despendida pelos vegetais de uma floresta tropical, propiciam no mesmo local ou em um outro local mais distante, o estabelecimento, crescimento e manuten��o da vida. Segundo o texto: fazendo com que essas �reas de floresta n�o sofram varia��es extremas de temperatura e tenham umidade suficiente para promover a vida', '2010-06-08 23:34:28', NULL, NULL),
(7, 'Um estudo recente feito no Pantanal d� uma\nboa id�ia de como o equil�brio entre as esp�cies,\nna natureza, � um verdadeiro quebra-cabe�a. As pe�as\ndo quebra-cabe�a s�o o tucano-toco, a arara-azul e o\nmanduvi. O tucano-toco � o �nico p�ssaro que consegue\nabrir o fruto e engolir a semente do manduvi, sendo, assim,\no principal dispersor de suas sementes. O manduvi, por\nsua vez, � uma das poucas �rvores onde as araras-azuis\nfazem seus ninhos.\nAt� aqui, tudo parece bem encaixado, mas... �\njustamente o tucano-toco o maior predador de ovos de\narara-azul ? mais da metade dos ovos das araras s�o\npredados pelos tucanos. Ent�o, ficamos na seguinte\nencruzilhada: se n�o h� tucanos-toco, os manduvis se\nextinguem, pois n�o h� dispers�o de suas sementes e n�o\nsurgem novos manduvinhos, e isso afeta as araras-azuis,\nque n�o t�m onde fazer seus ninhos. Se, por outro lado, h�\nmuitos tucanos-toco, eles dispersam as sementes dos\nmanduvis, e as araras-azuis t�m muito lugar para fazer\nseus ninhos, mas seus ovos s�o muito predados.\nDe acordo com a situa��o descrita,', 0, 'Como a nidifica��o da arara-azul ocorre principalmente no manduvi, as aves desta esp�cie necessitam da dispers�o deste vegetal, que depende do h�bito nutricional dos tucanos-toco. Logo, a conserva��o das araras-azuis est� condicionada a exist�ncia dos tucanos-toco, mesmo sendo esta esp�cie de tucano, predadora dos ovos das araras-azuis.', '2010-06-08 23:36:51', '2010-06-09 19:35:15', NULL),
(8, 'A China comprometeu-se a indenizar a R�ssia\npelo derramamento de benzeno de uma ind�stria\npetroqu�mica chinesa no rio Songhua, um afluente do rio\nAmur, que faz parte da fronteira entre os dois pa�ses.\nO presidente da Ag�ncia Federal de Recursos de �gua da\nR�ssia garantiu que o benzeno n�o chegar� aos dutos de\n�gua pot�vel, mas pediu � popula��o que fervesse a �gua\ncorrente e evitasse a pesca no rio Amur e seus afluentes.\nAs autoridades locais est�o armazenando centenas de\ntoneladas de carv�o, j� que o mineral � considerado eficaz\nabsorvente de benzeno.\nLevando-se em conta as medidas adotadas para a\nminimiza��o dos danos ao ambiente e � popula��o, �\ncorreto afirmar que', 33, 'A volatilidade do benzeno permite que ele seja eliminado da �gua, que possui ponto de ebuli��o maior que ele', '2010-06-09 19:42:57', NULL, NULL),
(9, 'Usada para dar estabilidade aos navios, a �gua de\nlastro acarreta grave problema ambiental: ela introduz\nindevidamente, no pa�s, esp�cies indesej�veis do ponto de\nvista ecol�gico e sanit�rio, a exemplo do mexilh�o\ndourado, molusco origin�rio da China. Trazido para o Brasil\npelos navios mercantes, o mexilh�o dourado foi\nencontrado na bacia Paran�-Paraguai em 1991.\nA dissemina��o desse molusco e a aus�ncia de\npredadores para conter o crescimento da popula��o de\nmoluscos causaram v�rios problemas, como o que ocorreu\nna hidrel�trica de Itaipu, onde o mexilh�o alterou a rotina\nde manuten��o das turbinas, acarretando preju�zo de\nUS$ 1 milh�o por dia, devido � paralisa��o do sistema.\nUma das estrat�gias utilizadas para diminuir o problema �\nacrescentar g�s cloro � �gua, o que reduz em cerca de\n50% a taxa de reprodu��o da esp�cie.\nDe acordo com as informa��es acima, o despejo da �gua\nde lastro', 38, 'Esta alternativa esta de acordo com o texto, pois afirma que para conter a prolifera��o de mexilh�es, foi utilizado um agente qu�mico, reduzindo a taxa reprodutiva destes animais (controle populacional), reduzindo os preju�zos da usina', '2010-06-09 19:46:29', NULL, NULL),
(10, 'A energia geot�rmica tem sua origem no n�cleo\nderretido da Terra, onde as temperaturas atingem\n4.000 �C. Essa energia � primeiramente produzida pela\ndecomposi��o de materiais radiativos dentro do planeta.\nEm fontes geot�rmicas, a �gua, aprisionada em um\nreservat�rio subterr�neo, � aquecida pelas rochas ao redor\ne fica submetida a altas press�es, podendo atingir\ntemperaturas de at� 370 �C sem entrar em ebuli��o. Ao\nser liberada na superf�cie, � press�o ambiente, ela se\nvaporiza e se resfria, formando fontes ou g�iseres. O vapor\nde po�os geot�rmicos � separado da �gua e � utilizado no\nfuncionamento de turbinas para gerar eletricidade. A �gua\nquente pode ser utilizada para aquecimento direto ou em\nusinas de dessaliniza��o.\nDepreende-se das informa��es acima que as usinas\ngeot�rmicas', 43, 'A energia geot�rmica se assemelha �s usinas nucleares no que diz respeito � convers�o da energia. Ambas convertem energia t�rmica em cin�tica e, depois, em el�trica', '2010-06-09 19:51:10', NULL, NULL),
(11, 'Um dos insumos energ�ticos que volta a ser\nconsiderado como op��o para o fornecimento de petr�leo\n� o aproveitamento das reservas de folhelhos\npirobetuminosos, mais conhecidos como xistos\npirobetuminosos. As a��es iniciais para a explora��o de\nxistos pirobetuminosos s�o anteriores � explora��o de\npetr�leo, por�m as dificuldades inerentes aos diversos\nprocessos, notadamente os altos custos de minera��o e de\nrecupera��o de solos minerados, contribu�ram para\nimpedir que essa atividade se expandisse.\nO Brasil det�m a segunda maior reserva mundial\nde xisto. O xisto � mais leve que os �leos derivados de\npetr�leo, seu uso n�o implica investimento na troca de\nequipamentos e ainda reduz a emiss�o de particulados\npesados, que causam fuma�a e fuligem. Por ser fluido em\ntemperatura ambiente, � mais facilmente manuseado e\narmazenado.\nA substitui��o de alguns �leos derivados de petr�leo pelo\n�leo derivado do xisto pode ser conveniente por motivos', 48, 'Com o aumento do pre�o do petr�leo, o xisto � uma �tima op��o de combust�vel, resta apenas ser explorada. Com novas fontes o pre�o do petr�leo deve cair devido � concorr�ncia', '2010-06-09 19:55:47', NULL, NULL),
(12, 'O potencial brasileiro para gerar energia a partir da\nbiomassa n�o se limita a uma amplia��o do Pr�-�lcool.\nO pa�s pode substituir o �leo diesel de petr�leo por grande\nvariedade de �leos vegetais e explorar a alta produtividade\ndas florestas tropicais plantadas. Al�m da produ��o de\ncelulose, a utiliza��o da biomassa permite a gera��o de\nenergia el�trica por meio de termel�tricas a lenha, carv�o\nvegetal ou g�s de madeira, com elevado rendimento e\nbaixo custo.\nCerca de 30% do territ�rio brasileiro � constitu�do\npor terras impr�prias para a agricultura, mas aptas �\nexplora��o florestal. A utiliza��o de metade dessa �rea, ou\nseja, de 120 milh�es de hectares, para a forma��o de\nflorestas energ�ticas, permitiria produ��o sustentada do\nequivalente a cerca de 5 bilh�es de barris de petr�leo por\nano, mais que o dobro do que produz a Ar�bia Saudita\natualmente.\nPara o Brasil, as vantagens da produ��o de energia a\npartir da biomassa incluem', 53, 'Favor�vel, uma vez que �reas impr�prias ao desenvolvimento para agricultura poderiam ser utilizadas para o plantio de florestas destinadas � produ��o de energia que, de acordo com o texto, pode alcan�ar uma elevada produ��o de combust�vel que deve ultrapassar o da Ar�bia Saudita', '2010-06-09 19:58:35', NULL, NULL),
(13, 'A Lei Federal n.� 11.097/2005 disp�e sobre a\nintrodu��o do biodiesel na matriz energ�tica brasileira e\nfixa em 5%, em volume, o percentual m�nimo obrigat�rio a\nser adicionado ao �leo diesel vendido ao consumidor.\nDe acordo com essa lei, biocombust�vel � ?derivado de\nbiomassa renov�vel para uso em motores a combust�o\ninterna com igni��o por compress�o ou, conforme\nregulamento, para gera��o de outro tipo de energia, que\npossa substituir parcial ou totalmente combust�veis de\norigem f�ssil?.\nA introdu��o de biocombust�veis na matriz energ�tica\nbrasileira', 0, 'A principal fun��o dos biocombust�veis � reduzir os impactos ambientais, a polui��o', '2010-06-09 20:00:46', '2010-06-09 20:04:28', NULL),
(14, 'Uma fonte de energia que n�o agride o ambiente,\n� totalmente segura e usa um tipo de mat�ria-prima infinita\n� a energia e�lica, que gera eletricidade a partir da for�a\ndos ventos. O Brasil � um pa�s privilegiado por ter o tipo de\nventila��o necess�ria para produzi-la. Todavia, ela � a\nmenos usada na matriz energ�tica brasileira. O Minist�rio\nde Minas e Energia estima que as turbinas e�licas\nproduzam apenas 0,25% da energia consumida no pa�s.\nIsso ocorre porque ela compete com uma usina mais\nbarata e eficiente: a hidrel�trica, que responde por 80% da\nenergia do Brasil. O investimento para se construir uma\nhidrel�trica � de aproximadamente US$ 100 por quilowatt.\nOs parques e�licos exigem investimento de cerca de\nUS$ 2 mil por quilowatt e a constru��o de uma usina\nnuclear, de aproximadamente US$ 6 mil por quilowatt.\nInstalados os parques, a energia dos ventos � bastante\ncompetitiva, custando R$ 200,00 por megawatt-hora frente\na R$ 150,00 por megawatt-hora das hidrel�tricas e a\nR$ 600,00 por megawatt-hora das termel�tricas.\nDe acordo com o texto, entre as raz�es que contribuem\npara a menor participa��o da energia e�lica na matriz\nenerg�tica brasileira, inclui-se o fato de', 70, 'Um dos fatores que contribuem para que a energia e�lica tenha menor participa��o na matriz energ�tica brasileira � o fato da constru��o de parques e�licos ser da ordem de US$ 2000,00, o que corresponde a 20 vezes o valor necess�rio para se construir uma hidrel�trica', '2010-06-09 23:04:52', NULL, NULL),
(15, 'umo dos fatores que levaram � aboli��o da escravatura com as seguintes palavras: ?Cinco a��es ou concursos diferentes cooperaram para o resultado final: 1.�) o esp�rito daqueles que criavam a opini�o pela id�ia, pela palavra, pelo sentimento, e que a faziam valer por meio do Parlamento, dos meetings [reuni�es p�blicas], da imprensa, do ensino superior, do p�lpito, dos tribunais; 2.�) a a��o coercitiva dos que se propunham a destruir materialmente o formid�vel aparelho da escravid�o, arrebatando os escravos ao poder dos senhores; 3.�) a a��o\ncomplementar dos pr�prios propriet�rios, que, � medida que o movimento se precipitava, iam libertando em massa as suas ?f�bricas?; 4.�) a a��o pol�tica dos estadistas, representando as concess�es do governo; 5.�) a a��o da fam�lia imperial.?\nNesse texto, Joaquim Nabuco afirma que a aboli��o da escravatura foi o resultado de uma luta ', 74, 'Verdadeira. Exigindo uma minuciosa an�lise das id�ias do autor, a quest�o exige do aluno perceber qual a alternativa melhor consegue sintetizar os motivos, apontados pelo estadista Joaquim Nabuco, para o fim da escravid�o. Nesta afirmativa podemos assinalar de maneira bastante equilibrada o resumo das id�ias do autor sem colocar outros argumentos que, mesmo sendo coerentes, n�o integram a compreens�o tecida por Joaquim Nabuco.', '2010-06-09 23:11:13', NULL, NULL),
(16, 'Existe uma regra religiosa, aceita pelos praticantes do\njuda�smo e do islamismo, que pro�be o consumo de carne\nde porco. Estabelecida na Antiguidade, quando os judeus\nviviam em regi�es �ridas, foi adotada, s�culos depois, por\n�rabes islamizados, que tamb�m eram povos do deserto.\nEssa regra pode ser entendida como', 83, 'Verdadeira. Tendo como pressuposto hist�rico o intenso contato que as diversas culturas do Oriente Pr�ximo e do Oriente M�dio estabeleceram durante sua trajet�ria, a afirmativa utiliza de um ?simples? h�bito alimentar para assim assinalar a troca de saberes, costumes e cren�as ocorridos ? ao longo s�culos ? entre os povos da Antiguidade Oriental', '2010-06-09 23:15:48', NULL, NULL),
(17, 'Em cada parada ou pouso, para jantar ou dormir,\nos bois s�o contados, tanto na chegada quanto na sa�da.\nNesses lugares, h� sempre um potreiro, ou seja,\ndeterminada �rea de pasto cercada de arame, ou\nmangueira, quando a cerca � de madeira. Na porteira de\nentrada do potreiro, rente � cerca, os pe�es formam a\nseringa ou funil, para afinar a fila, e ent�o os bois v�o\nentrando aos poucos na �rea cercada. Do lado interno, o\ncondutor vai contando; em frente a ele, est� o marcador,\npe�o que marca as reses. O condutor conta 50 cabe�as e\ngrita: ? Talha! O marcador, com o aux�lio dos dedos das\nm�os, vai marcando as talhas. Cada dedo da m�o direita\ncorresponde a 1 talha, e da m�o esquerda, a 5 talhas.\nQuando entra o �ltimo boi, o marcador diz: ? Vinte e cinco\ntalhas! E o condutor completa: ? E dezoito cabe�as. Isso\nsignifica 1.268 bois.\nPara contar os 1.268 bois de acordo com o processo descrito acima, o marcador utilizou ', 88, 'Verdadeiro. Todos os dedos da m�o esquerda contados uma �nica vez � igual a 1250 bois. Para 1268 faltam 18 bois que � uma quantidade que n�o ser� contadas nem na m�o esquerda e nem na direita ser� apenas anunciada pelo condutor', '2010-06-09 23:28:29', NULL, NULL),
(18, 'A velha Totonha de quando em vez batia no engenho.\nE era um acontecimento para a meninada... Que talento ela\npossu�a para contar as suas hist�rias, com um jeito admir�vel\nde falar em nome de todos os personagens, sem nenhum dente\nna boca, e com uma voz que dava todos os tons �s palavras!\nHavia sempre rei e rainha, nos seus contos, e forca e\nadivinha��es. E muito da vida, com as suas maldades e as suas\ngrandezas, a gente encontrava naqueles her�is e naqueles\nintrigantes, que eram sempre castigados com mortes horr�veis!\nO que fazia a velha Totonha mais curiosa era a cor local que ela\npunha nos seus descritivos. Quando ela queria pintar um reino\nera como se estivesse falando dum engenho fabuloso. Os rios e\nflorestas por onde andavam os seus personagens se pareciam\nmuito com a Para�ba e a Mata do Rolo. O seu Barba-Azul era\num senhor de engenho de Pernambuco.\nNa constru��o da personagem ?velha Totonha?, � poss�vel\nidentificar tra�os que revelam marcas do processo de\ncoloniza��o e de civiliza��o do pa�s. Considerando o texto\nacima, infere-se que a velha Totonha', 93, 'Verdadeira. Totonha representa um dado h�brido da constitui��o identit�ria e cultural do nosso pa�s ao pretender amealhar personagens, valores e cen�rios europeus e regionais', '2010-06-09 23:33:57', NULL, NULL),
(19, 'Na Am�rica inglesa, n�o houve nenhum processo\nsistem�tico de catequese e de convers�o dos �ndios ao\ncristianismo, apesar de algumas iniciativas nesse sentido.\nBrancos e �ndios confrontaram-se muitas vezes e mantiveramse\nseparados. Na Am�rica portuguesa, a catequese dos �ndios\ncome�ou com o pr�prio processo de coloniza��o, e a\nmesti�agem teve dimens�es significativas. Tanto na Am�rica\ninglesa quanto na portuguesa, as popula��es ind�genas foram\nmuito sacrificadas. Os �ndios n�o tinham defesas contra as\ndoen�as trazidas pelos brancos, foram derrotados pelas armas\nde fogo destes �ltimos e, muitas vezes, escravizados.\nNo processo de coloniza��o das Am�ricas, as popula��es\nind�genas da Am�rica portuguesa', 94, 'Verdadeira. Sendo um pa�s com fortes tradi��es religiosas vinculadas ao catolicismo, Portugal contou com uma marcante participa��o de membros da Igreja na justifica��o e na ordena��o do ambiente colonial lusitano. Al�m disso, o projeto de expans�o religiosa pregado com a cria��o da ordem jesu�tica contribuiu significativamente para que o processo de convers�o religiosa se desse de maneira sistem�tica no ambiente colonial portugu�s', '2010-06-09 23:37:24', NULL, NULL),
(20, 'Em discurso proferido em 17 de mar�o de 1939, o\nprimeiro-ministro ingl�s � �poca, Neville Chamberlain,\nsustentou sua posi��o pol�tica: ?N�o necessito defender\nminhas visitas � Alemanha no outono passado, que\nalternativa existia? Nada do que pud�ssemos ter feito,\nnada do que a Fran�a pudesse ter feito, ou mesmo a\nR�ssia, teria salvado a Tchecoslov�quia da destrui��o.\nMas eu tamb�m tinha outro prop�sito ao ir at� Munique.\nEra o de prosseguir com a pol�tica por vezes chamada de\n?apaziguamento europeu?, e Hitler repetiu o que j� havia\ndito, ou seja, que os Sudetos, regi�o de popula��o alem�\nna Tchecoslov�quia, eram a sua �ltima ambi��o territorial\nna Europa, e que n�o queria incluir na Alemanha outros\npovos que n�o os alem�es.?\nSabendo-se que o compromisso assumido por Hitler em\n1938, mencionado no texto acima, foi rompido pelo l�der\nalem�o em 1939, infere-se que', 99, 'Verdadeira. Mesmo assumindo os compromissos assinalados na Confer�ncia de Munique, Hitler se negou a cumprir os acordos as pressionar politicamente a Pol�nia para incorporar a regi�o de Dantzig e criar uma ferrovia que dava acesso ao ?corredor polon�s?. Al�m disso, reafirmando seu pretensioso projeto expansionista, Hitler incorporou integralmente os territ�rios da Tchecoslov�quia, no in�cio de 1939', '2010-06-09 23:44:47', NULL, NULL),
(21, 'O ano de 1954 foi decisivo para Carlos Lacerda.\nOs que conviveram com ele em 1954, 1955, 1957 (um dos\nseus momentos intelectuais mais altos, quando o governo\nJuscelino tentou cassar o seu mandato de deputado),\n1961 e 1964 tinham consci�ncia de que Carlos Lacerda,\nem uma batalha pol�tica ou jornal�stica, era um trator em\na��o, era um vendaval desencadeado n�o se sabe como,\nmas que era imposs�vel parar fosse pelo m�todo que\nfosse. Com base nas informa��es do texto acima e em aspectos\nrelevantes da hist�ria brasileira entre 1954, quando\nocorreu o suic�dio de Vargas (em grande medida, devido �\npress�o pol�tica exercida pelo pr�prio Lacerda), e 1964,\nquando um golpe de Estado interrompe a trajet�ria\ndemocr�tica do pa�s, conclui-se que', 108, 'Verdadeira. JK sabia da articulada capacidade que Carlos Lacerda tinha em criticar as autoridades, suas articula��es com setores militares golpistas e seu acesso aos meios de comunica��o da �poca, Lacerda foi impedido pelo presidente de ter acesso � proeminente m�dia televisiva da �poca.', '2010-06-09 23:48:57', NULL, NULL),
(22, 'Na Am�rica do Sul, as For�as Armadas\nRevolucion�rias da Col�mbia (Farc) lutam, h� d�cadas,\npara impor um regime de inspira��o marxista no pa�s.\nHoje, s�o acusadas de envolvimento com o narcotr�fico, o\nqual supostamente financia suas a��es, que incluem\nataques diversos, assassinatos e seq�estros.\nNa �sia, a Al Qaeda, criada por Osama bin Laden,\ndefende o fundamentalismo isl�mico e v� nos Estados\nUnidos da Am�rica (EUA) e em Israel inimigos poderosos,\nos quais deve combater sem tr�gua. A mais conhecida de\nsuas a��es terroristas ocorreu em 2001, quando foram\natingidos o Pent�gono e as torres do World Trade Center.\nA partir das informa��es acima, conclui-se que', 111, 'Verdadeira. Os atentados de 11 de setembro promoveram uma grande revis�o nas pol�ticas de prote��o territorial dos EUA. A destrui��o do World Trade Center, um dos maiores pontos de transa��o econ�mica norte-americano, exp�s a inimagin�vel fragilidade a qual a na��o americana estava exposta', '2010-06-09 23:53:58', NULL, NULL);

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
(19, 6, 'onde chove, h� floresta', '2010-06-08 23:34:28', NULL, NULL),
(20, 6, 'onde a floresta cresce, chove', '2010-06-08 23:34:29', NULL, NULL),
(21, 6, 'onde h� oceano, h� floresta', '2010-06-08 23:34:29', NULL, NULL),
(22, 6, 'apesar da chuva, a floresta cresce', '2010-06-08 23:34:29', NULL, NULL),
(23, 6, 'no interior do continente, s� chove onde h� floresta', '2010-06-08 23:34:29', NULL, NULL),
(24, 7, 'o manduvi depende diretamente tanto do tucano-toco\r\ncomo da arara-azul para sua sobreviv�ncia', '2010-06-09 19:35:15', NULL, NULL),
(25, 7, 'o tucano-toco, depois de engolir sementes de\r\nmanduvi, digere-as e torna-as invi�veis', '2010-06-09 19:35:16', NULL, NULL),
(26, 7, 'a conserva��o da arara-azul exige a redu��o da\r\npopula��o de manduvis e o aumento da popula��o de\r\ntucanos-toco', '2010-06-09 19:35:16', NULL, NULL),
(27, 7, 'a conserva��o das araras-azuis depende tamb�m da\r\nconserva��o dos tucanos-toco, apesar de estes serem\r\npredadores daquelas', '2010-06-09 19:35:16', NULL, NULL),
(28, 7, 'derrubada de manduvis em decorr�ncia do\r\ndesmatamento diminui a disponibilidade de locais para\r\nos tucanos fazerem seus ninhos', '2010-06-09 19:35:16', NULL, NULL),
(29, 8, 'o carv�o mineral, ao ser colocado na �gua, reage com\r\no benzeno, eliminando-o', '2010-06-09 19:42:57', NULL, NULL),
(30, 8, 'o benzeno � mais vol�til que a �gua e, por isso, �\r\nnecess�rio que esta seja fervida', '2010-06-09 19:42:57', NULL, NULL),
(31, 8, 'a orienta��o para se evitar a pesca deve-se �\r\nnecessidade de preserva��o dos peixes', '2010-06-09 19:42:57', NULL, NULL),
(32, 8, 'o benzeno n�o contaminaria os dutos de �gua pot�vel,\r\nporque seria decantado naturalmente no fundo do rio', '2010-06-09 19:42:57', NULL, NULL),
(33, 8, 'a polui��o causada pelo derramamento de benzeno da\r\nind�stria chinesa ficaria restrita ao rio Songhua', '2010-06-09 19:42:58', NULL, NULL),
(34, 9, '� ambientalmente ben�fico por contribuir para a\r\nsele��o natural das esp�cies e, conseq�entemente,\r\npara a evolu��o delas', '2010-06-09 19:46:29', NULL, NULL),
(35, 9, 'trouxe da China um molusco, que passou a compor a\r\nflora aqu�tica nativa do lago da hidrel�trica de Itaipu', '2010-06-09 19:46:29', NULL, NULL),
(36, 9, 'causou, na usina de Itaipu, por meio do microrganismo\r\ninvasor, uma redu��o do suprimento de �gua para as\r\nturbinas', '2010-06-09 19:46:29', NULL, NULL),
(37, 9, 'introduziu uma esp�cie ex�gena na bacia Paran�-\r\nParaguai, que se disseminou at� ser controlada por\r\nseus predadores naturais', '2010-06-09 19:46:29', NULL, NULL),
(38, 9, 'motivou a utiliza��o de um agente qu�mico na �gua\r\ncomo uma das estrat�gias para diminuir a reprodu��o\r\ndo mexilh�o dourado', '2010-06-09 19:46:30', NULL, NULL),
(39, 10, 'utilizam a mesma fonte prim�ria de energia que as\nusinas nucleares, sendo, portanto, semelhantes os\nriscos decorrentes de ambas', '2010-06-09 19:51:10', NULL, NULL),
(40, 10, 'funcionam com base na convers�o de energia\npotencial gravitacional em energia t�rmica', '2010-06-09 19:51:10', NULL, NULL),
(41, 10, 'podem aproveitar a energia qu�mica transformada em\nt�rmica no processo de dessaliniza��o', '2010-06-09 19:51:10', NULL, NULL),
(42, 10, 'assemelham-se �s usinas nucleares no que diz\nrespeito � convers�o de energia t�rmica em cin�tica e,\ndepois, em el�trica', '2010-06-09 19:51:10', NULL, NULL),
(43, 10, 'transformam inicialmente a energia solar em energia\ncin�tica e, depois, em energia t�rmica', '2010-06-09 19:51:10', NULL, NULL),
(44, 11, 'ambientais: a explora��o do xisto ocasiona pouca\ninterfer�ncia no solo e no subsolo', '2010-06-09 19:55:47', NULL, NULL),
(45, 11, 't�cnicos: a fluidez do xisto facilita o processo de produ��o\nde �leo, embora seu uso demande troca de equipamentos', '2010-06-09 19:55:47', NULL, NULL),
(46, 11, 'econ�micos: � baixo o custo da minera��o e da\nprodu��o de xisto', '2010-06-09 19:55:47', NULL, NULL),
(47, 11, 'pol�ticos: a importa��o de xisto, para atender o\nmercado interno, ampliar� alian�as com outros pa�ses', '2010-06-09 19:55:47', NULL, NULL),
(48, 11, 'estrat�gicos: a entrada do xisto no mercado �\noportuna diante da possibilidade de aumento dos\npre�os do petr�leo', '2010-06-09 19:55:47', NULL, NULL),
(49, 12, 'implanta��o de florestas energ�ticas em todas as\nregi�es brasileiras com igual custo ambiental e\necon�mico', '2010-06-09 19:58:35', NULL, NULL),
(50, 12, 'substitui��o integral, por biodiesel, de todos os\ncombust�veis f�sseis derivados do petr�leo', '2010-06-09 19:58:35', NULL, NULL),
(51, 12, 'forma��o de florestas energ�ticas em terras impr�prias\npara a agricultura', '2010-06-09 19:58:35', NULL, NULL),
(52, 12, 'importa��o de biodiesel de pa�ses tropicais, em que a\nprodutividade das florestas seja mais alta', '2010-06-09 19:58:35', NULL, NULL),
(53, 12, 'regenera��o das florestas nativas em biomas\nmodificados pelo homem, como o Cerrado e a Mata\nAtl�ntica', '2010-06-09 19:58:35', NULL, NULL),
(54, 13, 'colabora na redu��o dos efeitos da degrada��o\nambiental global produzida pelo uso de combust�veis\nf�sseis, como os derivados do petr�leo', '2010-06-09 20:04:28', NULL, NULL),
(55, 13, 'provoca uma redu��o de 5% na quantidade de\ncarbono emitido pelos ve�culos automotores e\ncolabora no controle do desmatamento', '2010-06-09 20:04:28', NULL, NULL),
(56, 13, 'incentiva o setor econ�mico brasileiro a se adaptar ao\nuso de uma fonte de energia derivada de uma\nbiomassa inesgot�vel', '2010-06-09 20:04:28', NULL, NULL),
(57, 13, 'aponta para pequena possibilidade de expans�o do\nuso de biocombust�veis, fixado, por lei, em 5% do\nconsumo de derivados do petr�leo', '2010-06-09 20:04:28', NULL, NULL),
(58, 13, 'diversifica o uso de fontes alternativas de energia que\nreduzem os impactos da produ��o do etanol por meio\nda monocultura da cana-de-a�ucar', '2010-06-09 20:04:28', NULL, NULL),
(59, 3, 'A palavra Cut�uxu � um regionalismo utilizado pelas\r\npopula��es pr�ximas �s aldeias ind�genas', '2010-06-09 20:20:55', NULL, NULL),
(60, 3, 'O autor se expressa em linguagem formal em todos os\r\nper�odos do texto', '2010-06-09 20:20:55', NULL, NULL),
(61, 3, 'A aus�ncia da palavra Ema no in�cio do per�odo\r\n�� limitada (...)� caracteriza registro oral', '2010-06-09 20:20:55', NULL, NULL),
(62, 3, 'A palavra Cut�uxu est� destacada em it�lico porque\r\nintegra o vocabul�rio da linguagem informal', '2010-06-09 20:20:55', NULL, NULL),
(63, 3, 'No texto, predomina a linguagem coloquial porque ele\r\nconsta de um almanaque', '2010-06-09 20:20:55', NULL, NULL),
(64, 4, 'o desmatamento na Amaz�nia decorre principalmente\r\nda explora��o ilegal de �rvores de valor comercial', '2010-06-09 20:51:46', NULL, NULL),
(65, 4, 'um dos problemas que os pecuaristas v�m\r\nenfrentando na Amaz�nia � a proibi��o do plantio de\r\nsoja', '2010-06-09 20:51:46', NULL, NULL),
(66, 4, 'a mobiliza��o de m�quinas e de for�a humana torna o\r\ndesmatamento mais caro que o aumento da\r\nprodutividade de pastagens', '2010-06-09 20:51:47', NULL, NULL),
(67, 4, 'o superavit comercial decorrente da exporta��o de\r\ncarne produzida na Amaz�nia compensa a poss�vel\r\ndegrada��o ambiental', '2010-06-09 20:51:47', NULL, NULL),
(68, 4, 'a recupera��o de �reas desmatadas e o aumento de\r\nprodutividade das pastagens podem contribuir para a\r\nredu��o do desmatamento na Amaz�nia', '2010-06-09 20:51:47', NULL, NULL),
(69, 14, 'haver, no pa�s, baixa disponibilidade de ventos que podem gerar energia el�trica', '2010-06-09 23:04:52', NULL, NULL),
(70, 14, 'o investimento por quilowatt exigido para a constru��o de parques e�licos ser de aproximadamente 20 vezes o necess�rio para a constru��o de hidrel�tricas', '2010-06-09 23:04:52', NULL, NULL),
(71, 14, 'o investimento por quilowatt exigido para a constru��o de parques e�licos ser igual a 1/3 do necess�rio para a constru��o de usinas nucleares', '2010-06-09 23:04:52', NULL, NULL),
(72, 14, 'o custo m�dio por megawatt-hora de energia obtida ap�s instala��o de parques e�licos ser igual a 1,2 multiplicado pelo custo m�dio do megawatt-hora obtido das hidrel�tricas', '2010-06-09 23:04:52', NULL, NULL),
(73, 14, 'o custo m�dio por megawatt-hora de energia obtida ap�s instala��o de parques e�licos ser igual a 1/3 do custo m�dio do megawatt-hora obtido das termel�tricas', '2010-06-09 23:04:52', NULL, NULL),
(74, 15, 'de id�ias, associada a a��es contra a organiza��o escravista, com o aux�lio de propriet�rios que libertavam seus escravos, de estadistas e da a��o da fam�lia imperial', '2010-06-09 23:11:13', NULL, NULL),
(75, 15, 'de classes, associada a a��es contra a organiza��o escravista, que foi seguida pela ajuda de propriet�rios que substitu�am os escravos por assalariados, o que provocou a ades�o de estadistas e, posteriormente, a��es republicanas', '2010-06-09 23:11:13', NULL, NULL),
(76, 15, 'partid�ria, associada a a��es contra a organiza��o escravista, com o aux�lio de propriet�rios que mudavam seu foco de investimento e da a��o da fam�lia imperia', '2010-06-09 23:11:13', NULL, NULL),
(77, 15, 'pol�tica, associada a a��es contra a organiza��o escravista, sabotada por propriet�rios que buscavam manter o escravismo, por estadistas e pela a��o republicana contra a realeza', '2010-06-09 23:11:13', NULL, NULL),
(78, 15, 'religiosa, associada a a��es contra a organiza��o escravista, que fora apoiada por propriet�rios que haviam substitu�do os seus escravos por imigrantes, o que resultou na ades�o de estadistas republicanos na luta contra a realeza', '2010-06-09 23:11:13', NULL, NULL),
(79, 16, 'uma demonstra��o de que o islamismo � um ramo do juda�smo tradicional', '2010-06-09 23:15:48', NULL, NULL),
(80, 16, 'um ind�cio de que a carne de porco era rejeitada em toda a �sia', '2010-06-09 23:15:48', NULL, NULL),
(81, 16, 'uma certeza de que do juda�smo surgiu o islamismo', '2010-06-09 23:15:48', NULL, NULL),
(82, 16, 'uma prova de que a carne do porco era largamente consumida fora das regi�es �ridas', '2010-06-09 23:15:48', NULL, NULL),
(83, 16, 'uma cren�a antiga de que o porco � um animal impuro', '2010-06-09 23:15:48', NULL, NULL),
(84, 17, '20 vezes todos os dedos da m�o esquerda', '2010-06-09 23:28:29', NULL, NULL),
(85, 17, '20 vezes todos os dedos da m�o direita', '2010-06-09 23:28:30', NULL, NULL),
(86, 17, 'todos os dedos da m�o direita apenas uma vez', '2010-06-09 23:28:30', NULL, NULL),
(87, 17, 'todos os dedos da m�o esquerda apenas uma vez', '2010-06-09 23:28:30', NULL, NULL),
(88, 17, '5 vezes todos os dedos da m�o esquerda e 5 vezes todos os dedos da m�o direita', '2010-06-09 23:28:30', NULL, NULL),
(89, 18, 'tira o seu sustento da produ��o da literatura, apesar de suas condi��es de vida e de trabalho, que denotam que ela enfrenta situa��o econ�mica muito adversa.', '2010-06-09 23:33:57', NULL, NULL),
(90, 18, 'comp�e, em suas hist�rias, narrativas �picas e realistas da hist�ria do pa�s colonizado, livres da influ�ncia de temas e modelos n�o representativos da realidade nacional', '2010-06-09 23:33:57', NULL, NULL),
(91, 18, 'retrata, na constitui��o do espa�o dos contos, a civiliza��o urbana europ�ia em concomit�ncia com a representa��o liter�ria de engenhos, rios e florestas do Brasil', '2010-06-09 23:33:57', NULL, NULL),
(92, 18, 'aproxima-se, ao incluir elementos fabulosos nos contos, do pr�prio romancista, o qual pretende retratar a realidade brasileira de forma t�o grandiosa quanto a europ�ia', '2010-06-09 23:33:57', NULL, NULL),
(93, 18, 'imprime marcas da realidade local a suas narrativas, que t�m como modelo e origem as fontes da literatura e da cultura europ�ia universalizada', '2010-06-09 23:33:57', NULL, NULL),
(94, 19, 'foram submetidas a um processo de doutrina��o religiosa que n�o ocorreu com os ind�genas da Am�rica inglesa', '2010-06-09 23:37:24', NULL, NULL),
(95, 19, 'mantiveram sua cultura t�o intacta quanto a dos ind�genas da Am�rica inglesa', '2010-06-09 23:37:24', NULL, NULL),
(96, 19, 'passaram pelo processo de mesti�agem, que ocorreu amplamente com os ind�genas da Am�rica inglesa', '2010-06-09 23:37:24', NULL, NULL),
(97, 19, 'diferenciaram-se dos ind�genas da Am�rica inglesa por terem suas terras devolvidas', '2010-06-09 23:37:24', NULL, NULL),
(98, 19, 'resistiram, como os ind�genas da Am�rica inglesa, �s doen�as trazidas pelos brancos', '2010-06-09 23:37:24', NULL, NULL),
(99, 20, 'Hitler ambicionava o controle de mais territ�rios na\nEuropa al�m da regi�o dos Sudetos', '2010-06-09 23:44:47', NULL, NULL),
(100, 20, 'a alian�a entre a Inglaterra, a Fran�a e a R�ssia poderia ter salvado a Tchecoslov�quia', '2010-06-09 23:44:47', NULL, NULL),
(101, 20, 'o rompimento desse compromisso inspirou a pol�tica de apaziguamento europeu', '2010-06-09 23:44:47', NULL, NULL),
(102, 20, 'a pol�tica de Chamberlain de apaziguar o l�der alem�o era contr�ria � posi��o assumida pelas pot�ncias aliadas', '2010-06-09 23:44:47', NULL, NULL),
(103, 20, 'a forma que Chamberlain escolheu para lidar com o problema dos Sudetos deu origem � destrui��o da Tchecoslov�quia', '2010-06-09 23:44:47', NULL, NULL),
(104, 21, 'a cassa��o do mandato parlamentar de Lacerda antecedeu a crise que levou Vargas � morte', '2010-06-09 23:48:57', NULL, NULL),
(105, 21, 'Lacerda e adeptos do getulismo, aparentemente opositores, expressavam a mesma posi��o pol�ticoideol�gica', '2010-06-09 23:48:57', NULL, NULL),
(106, 21, 'a implanta��o do regime militar, em 1964, decorreu da crise surgida com a contesta��o � posse de Juscelino Kubitschek como presidente da Rep�blica', '2010-06-09 23:48:57', NULL, NULL),
(107, 21, 'Carlos Lacerda atingiu o apogeu de sua carreira, tanto no jornalismo quanto na pol�tica, com a instaura��o do regime militar', '2010-06-09 23:48:57', NULL, NULL),
(108, 21, 'Juscelino Kubitschek, na presid�ncia da Rep�blica, sofreu vigorosa oposi��o de Carlos Lacerda, contra quem procurou reagir', '2010-06-09 23:48:57', NULL, NULL),
(109, 22, 'as a��es guerrilheiras e terroristas no mundo contempor�neo usam m�todos id�nticos para alcan�ar os mesmos prop�sitos', '2010-06-09 23:53:58', NULL, NULL),
(110, 22, 'o apoio internacional recebido pelas Farc decorre do desconhecimento, pela maioria das na��es, das pr�ticas violentas dessa organiza��o', '2010-06-09 23:53:58', NULL, NULL),
(111, 22, 'os EUA, mesmo sendo a maior pot�ncia do planeta, foram surpreendidos com ataques terroristas que atingiram alvos de grande import�ncia simb�lica', '2010-06-09 23:53:58', NULL, NULL),
(112, 22, 'as organiza��es mencionadas identificam-se quanto aos princ�pios religiosos que defendem', '2010-06-09 23:53:58', NULL, NULL),
(113, 22, 'tanto as Farc quanto a Al Qaeda restringem sua atua��o � �rea geogr�fica em que se localizam, respectivamente, Am�rica do Sul e �sia', '2010-06-09 23:53:58', NULL, NULL);

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
-- Restri��es para as tabelas dumpadas
--

--
-- Restri��es para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`pessoa_escola_matricula`, `pessoa_escola_pessoa_fisica_pessoa_id`) REFERENCES `pessoa_escola` (`matricula`, `pessoa_fisica_pessoa_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `aluno_resolve_questao`
--
ALTER TABLE `aluno_resolve_questao`
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_2` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_3` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_4` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aluno_resolve_questao_ibfk_5` FOREIGN KEY (`questao_alternativa_id`) REFERENCES `questao_alternativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restri��es para a tabela `assunto_questao`
--
ALTER TABLE `assunto_questao`
  ADD CONSTRAINT `assunto_questao_ibfk_1` FOREIGN KEY (`assunto_id`) REFERENCES `assunto` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `assunto_questao_ibfk_2` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`avaliacao_situacao_id`) REFERENCES `avaliacao_situacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `avaliacao_aluno`
--
ALTER TABLE `avaliacao_aluno`
  ADD CONSTRAINT `avaliacao_aluno_ibfk_1` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `avaliacao_aluno_ibfk_2` FOREIGN KEY (`aluno_pessoa_escola_pessoa_fisica_pessoa_id`, `aluno_pessoa_escola_matricula`) REFERENCES `aluno` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `avaliacao_nivel`
--
ALTER TABLE `avaliacao_nivel`
  ADD CONSTRAINT `avaliacao_nivel_ibfk_1` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `avaliacao_questao`
--
ALTER TABLE `avaliacao_questao`
  ADD CONSTRAINT `avaliacao_questao_ibfk_1` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `avaliacao_questao_ibfk_2` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `disciplina_assunto`
--
ALTER TABLE `disciplina_assunto`
  ADD CONSTRAINT `disciplina_assunto_ibfk_1` FOREIGN KEY (`assunto_id`) REFERENCES `assunto` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `disciplina_assunto_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `feedback_avaliacao_alternativa`
--
ALTER TABLE `feedback_avaliacao_alternativa`
  ADD CONSTRAINT `feedback_avaliacao_alternativa_ibfk_1` FOREIGN KEY (`feedbackAvaliacao_id`) REFERENCES `feedbackavaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `feedback_avaliacao_aluno`
--
ALTER TABLE `feedback_avaliacao_aluno`
  ADD CONSTRAINT `feedback_avaliacao_aluno_ibfk_1` FOREIGN KEY (`feedback_avaliacao_alternativa_id`) REFERENCES `feedback_avaliacao_alternativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `feedback_avaliacao_aluno_ibfk_2` FOREIGN KEY (`avaliacao_aluno_id`) REFERENCES `avaliacao_aluno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restri��es para a tabela `nivel_avaliacao`
--
ALTER TABLE `nivel_avaliacao`
  ADD CONSTRAINT `nivel_avaliacao_ibfk_1` FOREIGN KEY (`professor_avaliacao_id`) REFERENCES `professor_avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `nivel_questao`
--
ALTER TABLE `nivel_questao`
  ADD CONSTRAINT `nivel_questao_ibfk_1` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `pessoa_escola`
--
ALTER TABLE `pessoa_escola`
  ADD CONSTRAINT `pessoa_escola_ibfk_1` FOREIGN KEY (`pessoa_fisica_pessoa_id`) REFERENCES `pessoa_fisica` (`pessoa_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `pessoa_escola_disciplina`
--
ALTER TABLE `pessoa_escola_disciplina`
  ADD CONSTRAINT `pessoa_escola_disciplina_ibfk_1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pessoa_escola_disciplina_ibfk_2` FOREIGN KEY (`pessoa_escola_matricula`, `pessoa_escola_pessoa_fisica_pessoa_id`) REFERENCES `pessoa_escola` (`matricula`, `pessoa_fisica_pessoa_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restri��es para a tabela `pessoa_fisica`
--
ALTER TABLE `pessoa_fisica`
  ADD CONSTRAINT `pessoa_fisica_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `pessoa_juridica`
--
ALTER TABLE `pessoa_juridica`
  ADD CONSTRAINT `pessoa_juridica_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`pessoa_escola_matricula`, `pessoa_escola_pessoa_fisica_pessoa_id`) REFERENCES `pessoa_escola` (`matricula`, `pessoa_fisica_pessoa_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `professor_avaliacao`
--
ALTER TABLE `professor_avaliacao`
  ADD CONSTRAINT `professor_avaliacao_ibfk_1` FOREIGN KEY (`professor_pessoa_escola_pessoa_fisica_pessoa_id`, `professor_pessoa_escola_matricula`) REFERENCES `professor` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `professor_avaliacao_ibfk_2` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `questao_alternativa`
--
ALTER TABLE `questao_alternativa`
  ADD CONSTRAINT `questao_alternativa_ibfk_1` FOREIGN KEY (`questao_id`) REFERENCES `questao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restri��es para a tabela `questao_aluno`
--
ALTER TABLE `questao_aluno`
  ADD CONSTRAINT `questao_aluno_ibfk_1` FOREIGN KEY (`aluno_pessoa_escola_pessoa_fisica_pessoa_id`, `aluno_pessoa_escola_matricula`) REFERENCES `aluno` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `questao_aluno_ibfk_2` FOREIGN KEY (`avaliacao_questao_id`) REFERENCES `avaliacao_questao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restri��es para a tabela `usabilidade_questao`
--
ALTER TABLE `usabilidade_questao`
  ADD CONSTRAINT `usabilidade_questao_ibfk_1` FOREIGN KEY (`questao_alternativa_id`) REFERENCES `questao_alternativa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usabilidade_questao_ibfk_2` FOREIGN KEY (`professor_pessoa_escola_pessoa_fisica_pessoa_id`, `professor_pessoa_escola_matricula`) REFERENCES `professor` (`pessoa_escola_pessoa_fisica_pessoa_id`, `pessoa_escola_matricula`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usabilidade_questao_ibfk_3` FOREIGN KEY (`avaliacao_id`) REFERENCES `avaliacao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

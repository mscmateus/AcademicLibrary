DROP TABLE IF EXISTS `#__al_docentes`;
DROP TABLE IF EXISTS `#__al_discentes`;
DROP TABLE IF EXISTS `#__al_trabalhos`;
DROP TABLE IF EXISTS `#__al_banca`;
DROP TABLE IF EXISTS `#__al_autoria`;
DROP TABLE IF EXISTS `#__al_orientacao`;

CREATE TABLE `#__al_docentes` (
	`doc_id` INT(10) NOT NULL AUTO_INCREMENT,
	`doc_nome` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`doc_id`)
)
ENGINE =MyISAM
AUTO_INCREMENT =0;

CREATE TABLE `#__al_discentes` (
	`dis_id` INT(10) NOT NULL AUTO_INCREMENT,
	`dis_matricula` BIGINT(11) NOT NULL,
	`dis_nome` VARCHAR(255) NOT NULL, 
	PRIMARY KEY (`dis_id`)
)
ENGINE =MyISAM
AUTO_INCREMENT =0;

CREATE TABLE `#__al_trabalhos` (
	`tra_id` INT(10) NOT NULL AUTO_INCREMENT,

	`tra_tema` VARCHAR(255) NOT NULL,
	`tra_titulo` VARCHAR(255) NOT NULL,
	`tra_ano` INT(5) NOT NULL,
	`tra_cat` INT(1) NOT NULL,
	`tra_nota` DOUBLE(10,0) NOT NULL,
	`tra_palavras_chaves` TEXT(65535) NOT NULL,
	`tra_resumo` TEXT(65535) NOT NULL,
	`tra_defesa_data` DATE NOT NULL,

	`tra_endereco_projeto` VARCHAR(255) NOT NULL,
	`tra_endereco_trabalho` VARCHAR(255) NOT NULL,

	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`tra_id`)
) ENGINE =MyISAM 
AUTO_INCREMENT =0 
DEFAULT CHARSET =utf8;

CREATE TABLE `#__al_banca` (
	`ban_tra_id` INT(10) NOT NULL,
	`ban_doc_id` INT(10) NOT NULL
)
ENGINE =MyISAM;

CREATE TABLE `#__al_autoria` (
	`aut_tra_id` INT(10) NOT NULL,
	`aut_dis_id` INT(10) NOT NULL
)
ENGINE =MyISAM;

CREATE TABLE `#__al_orientacao` (
	`ori_tra_id` INT(10) NOT NULL,
	`ori_doc_id` INT(10) NOT NULL
)
ENGINE =MyISAM;


ALTER TABLE `#__al_banca`
	ADD CONSTRAINT ban_tra_id FOREIGN KEY(`ban_tra_id`) REFERENCES  `#__al_trabalhos`(`tra_id`),
   ADD CONSTRAINT ban_doc_id FOREIGN KEY(`ban_doc_id`) REFERENCES `#__al_docentes`(`doc_id`);

ALTER TABLE `#__al_autoria`
	ADD CONSTRAINT aut_tra_id FOREIGN KEY(`aut_tra_id`) REFERENCES  `#__al_trabalhos`(`tra_id`),
   ADD CONSTRAINT aut_dis_id FOREIGN KEY(`aut_dis_id`) REFERENCES `#__al_discentes`(`dis_id`);

ALTER TABLE `#__al_orientacao`
	ADD CONSTRAINT ori_tra_id FOREIGN KEY(`ori_tra_id`) REFERENCES  `#__al_trabalhos`(`tra_id`),
   ADD CONSTRAINT ori_doc_id FOREIGN KEY(`ori_doc_id`) REFERENCES `#__al_docentes`(`doc_id`);

INSERT INTO `#__al_docentes` (`doc_id`,`doc_nome`)
VALUES (1, 'Manoel Limeira');
INSERT INTO `#__al_docentes` (`doc_id`,`doc_nome`)
VALUES (2, 'Macilon Araújo');
INSERT INTO `#__al_docentes` (`doc_id`,`doc_nome`)
VALUES (3, 'Catarina Costa');
INSERT INTO `#__al_discentes` (`dis_id`, `dis_matricula`, `dis_nome`)
VALUES (1, 20160300010, 'Mateus Costa');
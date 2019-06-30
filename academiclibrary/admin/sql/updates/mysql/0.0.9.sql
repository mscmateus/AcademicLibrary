DROP TABLE IF EXISTS `#__al_docentes`;
DROP TABLE IF EXISTS `#__al_discentes`;
DROP TABLE IF EXISTS `#__al_banca`;
DROP TABLE IF EXISTS `#__al_autoria`;
DROP TABLE IF EXISTS `#__al_trabalhos`;

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

CREATE TABLE `#__al_banca` (
	`ban_tra_id` INT(10) NOT NULL,
	`ban_doc_id` INT(10) NOT NULL
)
ENGINE =MyISAM 
AUTO_INCREMENT =0;

CREATE TABLE `#__al_autoria` (
	`aut_tra_id` INT(10) NOT NULL,
	`aut_dis_id` INT(10) NOT NULL
)
ENGINE =MyISAM 
AUTO_INCREMENT =0;

CREATE TABLE `#__al_trabalhos` (
	`tra_id` INT(10) NOT NULL AUTO_INCREMENT,

	`tra_tema` VARCHAR(255) NOT NULL,
	`tra_titulo` VARCHAR(255) NOT NULL,
	`tra_ano` INT(4) NOT NULL,
	`tra_cat` INT(1) NOT NULL,
	`tra_nota` DOUBLE(2,2) NOT NULL,
	`tra_palavras_chaves` TEXT(65535) NOT NULL,
	`tra_resumo` TEXT(65535) NOT NULL,


	`tra_autor` INT(10) NOT NULL,
	`tra_orientador` INT(10) NOT NULL,
	
	`tra_defesa_data` DATE NOT NULL,

	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`tra_id`)
) ENGINE =MyISAM 
AUTO_INCREMENT =0 
DEFAULT CHARSET =utf8;

ALTER TABLE `#__al_banca`
	ADD CONSTRAINT dobdoc_id FOREIGN KEY(`ban_tra_id`) REFERENCES  `#__al_trabalhos`(`tra_id`),
   ADD CONSTRAINT dobban_id FOREIGN KEY(`ban_doc_id`) REFERENCES `#__al_docentes`(`doc_id`);

ALTER TABLE `#__al_autoria`
	ADD CONSTRAINT dobdoc_id FOREIGN KEY(`aut_tra_id`) REFERENCES  `#__al_trabalhos`(`tra_id`),
   ADD CONSTRAINT dobban_id FOREIGN KEY(`aut_dis_id`) REFERENCES `#__al_discentes`(`dis_id`);

ALTER TABLE `#__al_trabalhos`
	ADD CONSTRAINT tradoc_orientador FOREIGN KEY(`tra_orientador`) REFERENCES  `#__al_docentes`(`doc_id`),
	ADD CONSTRAINT tradis_autor FOREIGN KEY(`tra_autor`) REFERENCES  `#__al_discentes`(`dis_id`);

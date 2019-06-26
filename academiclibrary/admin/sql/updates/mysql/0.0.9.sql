DROP TABLE IF EXISTS `#__al_docentes_bancas`;
DROP TABLE IF EXISTS `#__al_trabalhos`;
DROP TABLE IF EXISTS `#__al_relatorios_estagios`;
DROP TABLE IF EXISTS `#__al_docentes`;
DROP TABLE IF EXISTS `#__al_bancas`;
DROP TABLE IF EXISTS `#__al_discentes`;
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
CREATE TABLE `#__al_docentes_bancas` (
	`dob_doc_id` INT(10) NOT NULL,
	`dob_ban_id` INT(10) NOT NULL
)
ENGINE =MyISAM 
AUTO_INCREMENT =0;
CREATE TABLE `#__al_bancas` (
	`ban_id` INT(10) NOT NULL AUTO_INCREMENT,
	`ban_data` DATE NOT NULL,
	PRIMARY KEY (`ban_id`)
) ENGINE =MyISAM 
AUTO_INCREMENT =0;
CREATE TABLE `#__al_trabalhos` (
	`tra_id` INT(10) NOT NULL AUTO_INCREMENT,

	`tra_tema` VARCHAR(255) NOT NULL,
	`tra_titulo` VARCHAR(255) NOT NULL,
	`tra_ano` INT(4) NOT NULL,
	`tra_cat` INT(4) NOT NULL,
	`tra_nota` DOUBLE(2,2) NOT NULL,
	`tra_palavras_chaves` TEXT(65535) NOT NULL,
	`tra_resumo` TEXT(65535) NOT NULL,


	`tra_autor` INT(10) NOT NULL,
	`tra_orientador` INT(10) NOT NULL,
	
	`tra_ban_id` INT(10) NOT NULL,

	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`tra_id`)
) ENGINE =MyISAM 
AUTO_INCREMENT =0 
DEFAULT CHARSET =utf8;
ALTER TABLE `#__al_docentes_bancas`
	ADD CONSTRAINT dobdoc_id FOREIGN KEY(`dob_doc_id`) REFERENCES  `#__al_docentes`(`doc_id`),
   ADD CONSTRAINT dobban_id FOREIGN KEY(`dob_ban_id`) REFERENCES `#__al_bancas`(`ban_id`);

ALTER TABLE `#__al_trabalhos`
	ADD CONSTRAINT tradoc_orientador FOREIGN KEY(`tra_orientador`) REFERENCES  `#__al_docentes`(`doc_id`),
	ADD CONSTRAINT tradis_autor FOREIGN KEY(`tra_autor`) REFERENCES  `#__al_discentes`(`dis_id`),
   ADD CONSTRAINT traban_id FOREIGN KEY(`tra_ban_id`) REFERENCES `#__al_bancas`(`ban_id`);

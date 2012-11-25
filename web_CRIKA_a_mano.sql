SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `web_CRIKA` ;
CREATE SCHEMA IF NOT EXISTS `web_CRIKA` ;
USE `web_CRIKA` ;

-- -----------------------------------------------------
-- Table `web_CRIKA`.`news`         Para usar ejemplos en libro ZendFramework in action
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`news`;
CREATE TABLE IF NOT EXISTS `web_CRIKA`.`news` (
`id` INT NOT NULL AUTO_INCREMENT ,
`date_created` DATETIME NULL,
`date_updated` DATETIME NULL ,
`title` VARCHAR(100) NULL ,
`body` MEDIUMTEXT NOT NULL,
 PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;
INSERT INTO `web_CRIKA`.`news` (`title`,`body`) VALUES ('titulo', 'body body body');
INSERT INTO `web_CRIKA`.`news` (`title`,`body`) VALUES ('tit22o', 'body bod2222dy');

-- -----------------------------------------------------
-- Table `web_CRIKA`.`ARTISTAS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`ARTISTAS` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`ARTISTAS` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NULL DEFAULT NULL ,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `foto` LONGBLOB NULL DEFAULT NULL COMMENT 'probando a meter en binario fotos en BBDD' ,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL ,
  `genero` VARCHAR(100) NULL DEFAULT NULL COMMENT 'no se si poner lo de genero' ,
  `publicado` VARCHAR(10) NULL DEFAULT 0 ,
  `posicion` VARCHAR(100) NULL DEFAULT NULL COMMENT 'en principio se ordenan alfabeticamente',
  `path_foto` VARCHAR(100) NULL DEFAULT NULL ,
  `path_logo` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `web_CRIKA`.`EVENTOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`EVENTOS` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`EVENTOS` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `fecha` TIMESTAMP NULL DEFAULT NULL ,
  `path_foto` VARCHAR(100) NULL DEFAULT NULL ,
  `foto` LONGBLOB NULL DEFAULT NULL ,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL ,
  `publicado` VARCHAR(10) NULL DEFAULT 0 ,
  `posicion` VARCHAR(100) NULL DEFAULT NULL ,
  `lugar` VARCHAR(45) NULL ,
  `hora` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `web_CRIKA`.`GALERIA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`GALERIA` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`GALERIA` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `path_foto` VARCHAR(100) NULL DEFAULT NULL ,
  `foto` LONGBLOB NULL DEFAULT NULL ,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `web_CRIKA`.`MAILING_LIST`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`MAILING_LIST` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`MAILING_LIST` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `email` VARCHAR(100) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `web_CRIKA`.`MAILING_LIST_HISTORIAL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`MAILING_LIST_HISTORIAL` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`MAILING_LIST_HISTORIAL` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `contenido` VARCHAR(100) NULL DEFAULT NULL ,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `FK_MAILING_LIST` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `web_CRIKA`.`ARTISTASenEVENTOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`ARTISTASenEVENTOS` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`ARTISTASenEVENTOS` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `ARTISTASid` INT NULL ,
  `EVENTOSid` INT NULL ,
  `nivelImportancia` SMALLINT NULL COMMENT 'cuanto mas cercano a 1 mayor sera la importancia del grupo en el evento\n' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
COMMENT = 'Aqui se podran lincar muchos artistas a un unico evento';



-- -----------------------------------------------------
-- Table `web_CRIKA`.`MAILINGList2HISTORIAL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`MAILINGList2HISTORIAL` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`MAILINGList2HISTORIAL` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` INT NULL ,
  `FKhistorial` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `web_CRIKA`.`LUGARES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`LUGARES` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`LUGARES` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `web` VARCHAR(45) NULL ,
  `maps` VARCHAR(45) NULL ,
  `direccion` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `web_CRIKA`.`ARTISTAS_has_EVENTOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`ARTISTAS_has_EVENTOS` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`ARTISTAS_has_EVENTOS` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `ARTISTAS_id` INT(11) NOT NULL ,
  `EVENTOS_id` INT(11) NOT NULL ,
  PRIMARY KEY (id) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `web_CRIKA`.`REDES_SOCIALES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`REDES_SOCIALES` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`REDES_SOCIALES` (
  `TABLA_REFERENCIA` INT NOT NULL COMMENT ' aqui sabes a que tabla hace referencia' ,
  `id_TABLA_REFERENCIA` INT NOT NULL COMMENT ' aqui sabes a que campo concreto' ,
  `correo1` VARCHAR(100) NULL ,
  `correo2` VARCHAR(100) NULL ,
  `correo3` VARCHAR(100) NULL ,
  `web1` VARCHAR(100) NULL ,
  `web2` VARCHAR(100) NULL ,
  `web3` VARCHAR(100) NULL ,
  `bandcamp` VARCHAR(100) NULL ,
  `myspace` VARCHAR(100) NULL ,
  `facebook` VARCHAR(100) NULL ,
  `wikipedia` VARCHAR(100) NULL ,
  `youtube` VARCHAR(100) NULL ,
  `twitter` VARCHAR(100) NULL ,
  PRIMARY KEY (`TABLA_REFERENCIA`, `id_TABLA_REFERENCIA`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

INSERT INTO `web_CRIKA`.`REDES_SOCIALES` (`TABLA_REFERENCIA`,`id_TABLA_REFERENCIA`,`wikipedia`,`web1`,`twitter`,`myspace`,`youtube`) VALUES (1, 1,'http://ca.wikipedia.org/wiki/New_York_Ska-Jazz_Ensemble','http://newyorkskajazzensemble.com/','https://twitter.com/nyskajazz','http://www.myspace.com/nysje','http://www.youtube.com/nyskajazz1');
-- -----------------------------------------------------
-- Table `web_CRIKA`.`TABLA_REFERENCIA_2_REDES_SOCIALES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `web_CRIKA`.`TABLA_REFERENCIA_2_REDES_SOCIALES` ;

CREATE  TABLE IF NOT EXISTS `web_CRIKA`.`TABLA_REFERENCIA_2_REDES_SOCIALES` (
  `TABLA_REFERENCIA` VARCHAR(100) NOT NULL COMMENT ' aqui sabes a que tabla hace referencia' ,
  `REDES_SOCIALES` INT NOT NULL COMMENT ' Esto servira de FK en REDES_SOCIALES para saber cual TABLA guarda datos' ,
  PRIMARY KEY (`TABLA_REFERENCIA`, `REDES_SOCIALES`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

INSERT INTO `web_CRIKA`.`TABLA_REFERENCIA_2_REDES_SOCIALES` (`REDES_SOCIALES`,`TABLA_REFERENCIA`) VALUES (1, 'ARTISTAS');
INSERT INTO `web_CRIKA`.`TABLA_REFERENCIA_2_REDES_SOCIALES` (`REDES_SOCIALES`,`TABLA_REFERENCIA`) VALUES (2, 'LUGARES');
INSERT INTO `web_CRIKA`.`TABLA_REFERENCIA_2_REDES_SOCIALES` (`REDES_SOCIALES`,`TABLA_REFERENCIA`) VALUES (3, 'MAILING_LIST');

-- -----------------------------------------------------
-- Data for table `web_CRIKA`.`ARTISTAS`
-- -----------------------------------------------------
START TRANSACTION;
USE `web_CRIKA`;
INSERT INTO `web_CRIKA`.`ARTISTAS` (`id`, `nombre`, `fecha`, `path_foto`, `foto`, `descripcion`, `genero`, `path_logo`) VALUES (NULL, 'New York Ska ensemble', NULL, 'path/foto.jpg', NULL, 'grupo_chachi_piruli', NULL, 'path/logo.jpg');
INSERT INTO `web_CRIKA`.`ARTISTAS` (`id`, `nombre`, `fecha`, `path_foto`, `foto`, `descripcion`, `genero`, `path_logo`) VALUES (NULL, 'artist2', NULL, 'path/foto1.jpg', NULL, 'sdf asd asd asd', NULL, 'path/logo.jpg');
INSERT INTO `web_CRIKA`.`ARTISTAS` (`id`, `nombre`, `fecha`, `path_foto`, `foto`, `descripcion`, `genero`, `path_logo`) VALUES (NULL, 'nombre GRUPO', NULL, NULL, NULL, 'grupo 3', NULL, NULL);

COMMIT;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema BD_FSW
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BD_FSW
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BD_FSW` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE `BD_FSW` ;

-- -----------------------------------------------------
-- Table `BD_FSW`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FSW`.`Curso` (
  `idCurso` INT(11) NOT NULL AUTO_INCREMENT,
  `curso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BD_FSW`.`disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FSW`.`Disciplina` (
  `idDisciplina` INT(11) NOT NULL AUTO_INCREMENT,
  `disciplina` VARCHAR(80) NOT NULL,
  `status` CHAR(1) NOT NULL,
  `Curso_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idDisciplina`, `Curso_idCurso`),
  INDEX `fk_Disciplina_Curso1_idx` (`Curso_idCurso` ASC),
  CONSTRAINT `fk_Disciplina_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `BD_FSW`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BD_FSW`.`semestre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FSW`.`Semestre` (
  `idSemestre` INT(11) NOT NULL AUTO_INCREMENT,
  `semestre` INT(11) NOT NULL,
  `ano` INT(11) NOT NULL,
  `Disciplina_idDisciplina` INT(11) NOT NULL,
  PRIMARY KEY (`idSemestre`, `Disciplina_idDisciplina`),
  INDEX `fk_Semestre_Disciplina1_idx` (`Disciplina_idDisciplina` ASC),
  CONSTRAINT `fk_Semestre_Disciplina1`
    FOREIGN KEY (`Disciplina_idDisciplina`)
    REFERENCES `BD_FSW`.`Disciplina` (`idDisciplina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BD_FSW`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FSW`.`Usuario` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(16) NOT NULL,
  `senha` VARCHAR(60) NOT NULL,
  `permissao` CHAR(1) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `matricula_UNIQUE` (`login` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BD_FSW`.`arquivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_FSW`.`Arquivo` (
  `idArquivo` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(80) NOT NULL,
  `aluno` VARCHAR(50) NOT NULL,
  `orientador` VARCHAR(50) NOT NULL,
  `hora` DATETIME NOT NULL,
  `palavra_chave` TEXT NULL DEFAULT NULL,
  `caminho_arq` VARCHAR(100) NOT NULL,
  `Semestre_idSemestre` INT(11) NOT NULL,
  `Usuario_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idArquivo`, `Semestre_idSemestre`, `Usuario_idUsuario`),
  INDEX `fk_Arquivo_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Arquivo_Semestre1_idx` (`Semestre_idSemestre` ASC),
  CONSTRAINT `fk_Arquivo_Semestre1`
    FOREIGN KEY (`Semestre_idSemestre`)
    REFERENCES `BD_FSW`.`Semestre` (`idSemestre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Arquivo_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `BD_FSW`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `usuario` VALUES (DEFAULT,'admin','$2a$08$ODY4Njg1OTU3NThmMjgzYeBjNIB0lBlWDymF749wCMtdi5JfzUCqe','0','A');
INSERT INTO `usuario` VALUES (DEFAULT,'user','$2a$08$ODY4Njg1OTU3NThmMjgzYeBjNIB0lBlWDymF749wCMtdi5JfzUCqe','1','A');


INSERT INTO `Curso` VALUES (DEFAULT, 'Administracao');
INSERT INTO `Curso` VALUES (DEFAULT, 'Analista de Sistema');
INSERT INTO `Curso` VALUES (DEFAULT, 'Direito');
INSERT INTO `Curso` VALUES (DEFAULT, 'Redes de Computadores');
INSERT INTO `Curso` VALUES (DEFAULT, 'Sistema de Informacao');

INSERT INTO `Disciplina` VALUES (DEFAULT, 'Projeto', 'A', 1);
INSERT INTO `Disciplina` VALUES (DEFAULT, 'TCC', 'A', 1);
INSERT INTO `Disciplina` VALUES (DEFAULT, 'Projeto', 'A', 2);
INSERT INTO `Disciplina` VALUES (DEFAULT, 'TCC', 'A', 2);

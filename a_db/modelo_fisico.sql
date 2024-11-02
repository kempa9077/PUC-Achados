-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema PUC_Achados
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema PUC_Achados
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PUC_Achados` DEFAULT CHARACTER SET utf8 ;
USE `PUC_Achados` ;

-- -----------------------------------------------------
-- Table `PUC_Achados`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`pessoa` (
  `cpf` CHAR(11) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `matricula` VARCHAR(45) NULL,
  `registro_puc` VARCHAR(45) NULL,
  `acesso_nivel` INT NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PUC_Achados`.`local`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`local` (
  `id_local` INT NOT NULL AUTO_INCREMENT,
  `bloco` INT NOT NULL,
  `sala` VARCHAR(45) NULL,
  PRIMARY KEY (`id_local`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PUC_Achados`.`categoria_objeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`categoria_objeto` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PUC_Achados`.`objeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`objeto` (
  `id_objeto` INT NOT NULL AUTO_INCREMENT,
  `id_local` INT NULL,
  `categoria_objeto` INT NOT NULL,
  `encontrado` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `data_entrada` DATETIME NULL,
  PRIMARY KEY (`id_objeto`),
  INDEX `fk_objeto_local1_idx` (`id_local` ASC) VISIBLE,
  INDEX `fk_objeto_tipo_item1_idx` (`categoria_objeto` ASC) VISIBLE,
  CONSTRAINT `fk_objeto_local1`
    FOREIGN KEY (`id_local`)
    REFERENCES `PUC_Achados`.`local` (`id_local`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_objeto_tipo_item1`
    FOREIGN KEY (`categoria_objeto`)
    REFERENCES `PUC_Achados`.`categoria_objeto` (`id_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PUC_Achados`.`protocolo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`protocolo` (
  `idprotocolo` INT NOT NULL AUTO_INCREMENT,
  `situacao` INT NOT NULL,
  `data_abertura` DATETIME NOT NULL,
  `data_fechamento` DATETIME NULL,
  `data_perda` DATE NULL,
  `pessoa_abertura` CHAR(11) NOT NULL,
  `pessoa_fechado` CHAR(11) NULL,
  `local_perda` INT NULL,
  `objeto` INT NOT NULL,
  `descricao` VARCHAR(300) NULL,
  PRIMARY KEY (`idprotocolo`),
  INDEX `fk_protocolo_pessoa_idx` (`pessoa_abertura` ASC) VISIBLE,
  INDEX `fk_protocolo_pessoa1_idx` (`pessoa_fechado` ASC) VISIBLE,
  INDEX `fk_protocolo_local1_idx` (`local_perda` ASC) VISIBLE,
  INDEX `fk_protocolo_objeto1_idx` (`objeto` ASC) VISIBLE,
  CONSTRAINT `fk_protocolo_pessoa`
    FOREIGN KEY (`pessoa_abertura`)
    REFERENCES `PUC_Achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_protocolo_pessoa1`
    FOREIGN KEY (`pessoa_fechado`)
    REFERENCES `PUC_Achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_protocolo_local1`
    FOREIGN KEY (`local_perda`)
    REFERENCES `PUC_Achados`.`local` (`id_local`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_protocolo_objeto1`
    FOREIGN KEY (`objeto`)
    REFERENCES `PUC_Achados`.`objeto` (`id_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PUC_Achados`.`retirada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`retirada` (
  `id_retirada` INT NOT NULL AUTO_INCREMENT,
  `id_objeto` INT NOT NULL,
  `funcionario` CHAR(11) NOT NULL,
  `pessoa_retirante` CHAR(11) NOT NULL,
  `data` DATETIME NOT NULL,
  PRIMARY KEY (`id_retirada`),
  INDEX `fk_retirada_objeto1_idx` (`id_objeto` ASC) VISIBLE,
  INDEX `fk_retirada_pessoa1_idx` (`pessoa_retirante` ASC) VISIBLE,
  INDEX `fk_retirada_pessoa2_idx` (`funcionario` ASC) VISIBLE,
  CONSTRAINT `fk_retirada_objeto1`
    FOREIGN KEY (`id_objeto`)
    REFERENCES `PUC_Achados`.`objeto` (`id_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_retirada_pessoa1`
    FOREIGN KEY (`pessoa_retirante`)
    REFERENCES `PUC_Achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_retirada_pessoa2`
    FOREIGN KEY (`funcionario`)
    REFERENCES `PUC_Achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PUC_Achados`.`log_encontro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`log_encontro` (
  `id_log` INT NOT NULL AUTO_INCREMENT,
  `id_objeto` INT NOT NULL,
  `funcionario` CHAR(11) NOT NULL,
  `data` DATETIME NOT NULL,
  `valor_antigo` INT NOT NULL,
  `valor_novo` INT NOT NULL,
  INDEX `fk_log_encontro_pessoa1_idx` (`funcionario` ASC) VISIBLE,
  INDEX `fk_log_encontro_objeto1_idx` (`id_objeto` ASC) VISIBLE,
  PRIMARY KEY (`id_log`),
  CONSTRAINT `fk_log_encontro_pessoa1`
    FOREIGN KEY (`funcionario`)
    REFERENCES `PUC_Achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_encontro_objeto1`
    FOREIGN KEY (`id_objeto`)
    REFERENCES `PUC_Achados`.`objeto` (`id_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PUC_Achados`.`log_pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PUC_Achados`.`log_pessoa` (
  `id_log` INT NOT NULL AUTO_INCREMENT,
  `cpf_modificador` CHAR(11) NOT NULL,
  `cpf_alterado` CHAR(11) NOT NULL,
  `data` DATETIME NOT NULL,
  `email_velho` VARCHAR(100) NULL,
  `email_novo` VARCHAR(100) NULL,
  `nome_velho` VARCHAR(100) NULL,
  `nome_novo` VARCHAR(100) NULL,
  `acesso_nivel_velho` INT NULL,
  `acesso_nivel_novo` INT NULL,
  PRIMARY KEY (`id_log`),
  INDEX `fk_log_pessoa_pessoa1_idx` (`cpf_modificador` ASC) VISIBLE,
  INDEX `fk_log_pessoa_pessoa2_idx` (`cpf_alterado` ASC) VISIBLE,
  CONSTRAINT `fk_log_pessoa_pessoa1`
    FOREIGN KEY (`cpf_modificador`)
    REFERENCES `PUC_Achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_pessoa_pessoa2`
    FOREIGN KEY (`cpf_alterado`)
    REFERENCES `PUC_Achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

CREATE SCHEMA IF NOT EXISTS `puc_achados` DEFAULT CHARACTER SET utf8 ;
USE `puc_achados` ;

-- -----------------------------------------------------
-- Table `PUC_Achados`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puc_achados`.`pessoa` (
  `cpf` CHAR(11) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `matricula` VARCHAR(45) NULL,
  `registro_puc` VARCHAR(45) NULL,
  `acesso_nivel` INT NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE);

-- -----------------------------------------------------
-- Table `PUC_Achados`.`bloco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puc_achados`.`bloco` (
  `id_bloco` INT NOT NULL,
  PRIMARY KEY (`id_bloco`));

-- -----------------------------------------------------
-- Table `PUC_Achados`.`categoria_objeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puc_achados`.`categoria_objeto` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_tipo`));


-- -----------------------------------------------------
-- Table `PUC_Achados`.`objeto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puc_achados`.`objeto` (
  `id_objeto` INT NOT NULL AUTO_INCREMENT,
  `local_bloco` INT NOT NULL,
  `categoria_objeto` INT NOT NULL,
  `encontrado_nao_encontrado` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_objeto`),
  INDEX `fk_objeto_local1_idx` (`local_bloco` ASC) VISIBLE,
  INDEX `fk_objeto_tipo_item1_idx` (`categoria_objeto` ASC) VISIBLE,
  CONSTRAINT `fk_objeto_local1`
    FOREIGN KEY (`local_bloco`)
    REFERENCES `puc_achados`.`bloco` (`id_bloco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_objeto_tipo_item1`
    FOREIGN KEY (`categoria_objeto`)
    REFERENCES `puc_achados`.`categoria_objeto` (`id_tipo`));


-- -----------------------------------------------------
-- Table `PUC_Achados`.`protocolo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puc_achados`.`protocolo` (
  `idprotocolo` INT NOT NULL AUTO_INCREMENT,
  `aberto_fechado` INT NOT NULL,
  `data_abertura` DATETIME NOT NULL,
  `data_fechamento` DATETIME NOT NULL,
  `data_perda` DATETIME NULL,
  `pessoa_abertura` CHAR(11) NOT NULL,
  `pessoa_fechado` CHAR(11) NOT NULL,
  `local_bloco` INT NOT NULL,
  `objeto` INT NOT NULL,
  `descricao` VARCHAR(300) NULL,
  PRIMARY KEY (`idprotocolo`),
  INDEX `fk_protocolo_pessoa_idx` (`pessoa_abertura` ASC) VISIBLE,
  INDEX `fk_protocolo_pessoa1_idx` (`pessoa_fechado` ASC) VISIBLE,
  INDEX `fk_protocolo_local1_idx` (`local_bloco` ASC) VISIBLE,
  INDEX `fk_protocolo_objeto1_idx` (`objeto` ASC) VISIBLE,
  CONSTRAINT `fk_protocolo_pessoa`
    FOREIGN KEY (`pessoa_abertura`)
    REFERENCES `puc_achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_protocolo_pessoa1`
    FOREIGN KEY (`pessoa_fechado`)
    REFERENCES `puc_achados`.`pessoa` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_protocolo_local1`
    FOREIGN KEY (`local_bloco`)
    REFERENCES `puc_achados`.`bloco` (`id_bloco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_protocolo_objeto1`
    FOREIGN KEY (`objeto`)
    REFERENCES `puc_achados`.`objeto` (`id_objeto`));


-- -----------------------------------------------------
-- Table `PUC_Achados`.`sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puc_achados`.`sala` (
  `id_bloco` INT NOT NULL,
  `sala` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_bloco`),
  CONSTRAINT `fk_sala_local1`
    FOREIGN KEY (`id_bloco`)
    REFERENCES `puc_achados`.`bloco` (`id_bloco`));
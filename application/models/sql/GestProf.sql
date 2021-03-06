-- MySQL Script generated by MySQL Workbench
-- 12/15/14 00:41:57
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema gestprof
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestprof
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestprof` DEFAULT CHARACTER SET latin1 ;
USE `gestprof` ;

-- -----------------------------------------------------
-- Table `gestprof`.`formas_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`formas_pago` (
  `idFormaPago` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idFormaPago`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`cajas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`cajas` (
  `idCaja` INT NOT NULL AUTO_INCREMENT,
  `idforma` INT NOT NULL,
  `fecha` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idCaja`, `idforma`),
  INDEX `CAJ_FOP_FK_idx` (`idforma` ASC),
  UNIQUE INDEX `idCaja_UNIQUE` (`idCaja` ASC),
  CONSTRAINT `CAJ_IDF_FK`
    FOREIGN KEY (`idforma`)
    REFERENCES `gestprof`.`formas_pago` (`idFormaPago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`personas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nif` VARCHAR(9) NULL,
  `nombre` VARCHAR(20) NULL DEFAULT NULL,
  `apellidos` VARCHAR(20) NULL DEFAULT NULL,
  `telefono` VARCHAR(9) NULL DEFAULT NULL,
  `direccion` VARCHAR(30) NULL DEFAULT NULL,
  `fax` VARCHAR(9) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`clientes` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `idpersona` INT NOT NULL,
  `contacto` VARCHAR(20) NULL DEFAULT NULL,
  UNIQUE INDEX `nif_UNIQUE` (`idpersona` ASC),
  PRIMARY KEY (`idcliente`, `idpersona`),
  UNIQUE INDEX `idcliente_UNIQUE` (`idcliente` ASC),
  CONSTRAINT `CLI_IDP_FK`
    FOREIGN KEY (`idpersona`)
    REFERENCES `gestprof`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`delegaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`delegaciones` (
  `idDelegacion` INT(5) NOT NULL,
  `Poblacion` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`idDelegacion`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`iva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`iva` (
  `idIva` INT NOT NULL AUTO_INCREMENT,
  `tipo` SMALLINT(6) NULL DEFAULT NULL,
  `descripcion` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`idIva`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`proveedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`proveedores` (
  `idproveedores` INT NOT NULL AUTO_INCREMENT,
  `idpersona` INT NOT NULL,
  `contacto` VARCHAR(20) NULL DEFAULT NULL,
  UNIQUE INDEX `nif_UNIQUE` (`idpersona` ASC),
  UNIQUE INDEX `idproveedores_UNIQUE` (`idproveedores` ASC),
  CONSTRAINT `PRV_IDP_FK`
    FOREIGN KEY (`idpersona`)
    REFERENCES `gestprof`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `salt` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `activation_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_time` INT(11) UNSIGNED NULL DEFAULT NULL,
  `remember_code` VARCHAR(40) NULL DEFAULT NULL,
  `created_on` INT(11) UNSIGNED NOT NULL,
  `last_login` INT(11) UNSIGNED NULL DEFAULT NULL,
  `active` TINYINT(1) UNSIGNED NULL DEFAULT NULL,
  `first_name` VARCHAR(50) NULL DEFAULT NULL,
  `last_name` VARCHAR(50) NULL DEFAULT NULL,
  `company` VARCHAR(100) NULL DEFAULT NULL,
  `phone` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`profesional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`profesional` (
  `idprofesional` INT NOT NULL AUTO_INCREMENT,
  `idpersonas` INT NOT NULL,
  `login` INT(11) UNSIGNED NOT NULL,
  `actividad` VARCHAR(45) NOT NULL,
  `nccc` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idprofesional`, `idpersonas`, `login`),
  INDEX `TU_ID_FK_idx` (`login` ASC),
  INDEX `DN_PE_FK_idx` (`idpersonas` ASC),
  UNIQUE INDEX `idprofesional_UNIQUE` (`idprofesional` ASC),
  CONSTRAINT `PRO_LOG_FK`
    FOREIGN KEY (`login`)
    REFERENCES `gestprof`.`users` (`id`),
  CONSTRAINT `PRO_IDP_FK`
    FOREIGN KEY (`idpersonas`)
    REFERENCES `gestprof`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`facturas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`facturas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(20) NOT NULL,
  `idcaja` INT NOT NULL,
  `idprofesional` INT NOT NULL,
  `idcliente` INT NOT NULL,
  `idproveedores` INT NOT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  `baseImponible` FLOAT NULL DEFAULT NULL,
  `iva` FLOAT NULL DEFAULT NULL,
  `irpf` INT(11) NULL DEFAULT NULL,
  `total` FLOAT NULL DEFAULT NULL,
  `rutaPdf` VARCHAR(45) NULL DEFAULT NULL,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`, `idcaja`, `idprofesional`, `idcliente`, `idproveedores`, `numero`),
  INDEX `FAC_NIP_FK_idx` (`idcliente` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `FAC_IDP_FK_idx` (`idproveedores` ASC),
  INDEX `FAC_IDP_FK_idx1` (`idprofesional` ASC),
  CONSTRAINT `FAC_IDP_FK`
    FOREIGN KEY (`idproveedores`)
    REFERENCES `gestprof`.`proveedores` (`idproveedores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FAC_NIC_FK`
    FOREIGN KEY (`idcliente`)
    REFERENCES `gestprof`.`clientes` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FAC_IPR_FK`
    FOREIGN KEY (`idprofesional`)
    REFERENCES `gestprof`.`profesional` (`idprofesional`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FAC_IDC_FK`
    FOREIGN KEY (`idcaja`)
    REFERENCES `gestprof`.`cajas` (`idCaja`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`detalles_factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`detalles_factura` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idfactura` INT NOT NULL,
  `idiva` INT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `cantidad` VARCHAR(45) NULL DEFAULT NULL,
  `descuento` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `idfactura`),
  INDEX `DF_F_ID_FK_idx` (`idfactura` ASC),
  INDEX `DFA_IVA_FK_idx` (`idiva` ASC),
  CONSTRAINT `DFA_IVA_FK`
    FOREIGN KEY (`idiva`)
    REFERENCES `gestprof`.`iva` (`idIva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `DFA_IDF_FK`
    FOREIGN KEY (`idfactura`)
    REFERENCES `gestprof`.`facturas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`tipos_gasto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`tipos_gasto` (
  `idTipoGasto` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoGasto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`gastos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`gastos` (
  `idgastos` INT NOT NULL AUTO_INCREMENT,
  `idCaja` INT NOT NULL,
  `idTipoGasto` INT NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idgastos`, `idCaja`, `idTipoGasto`),
  INDEX `G_TG_IG_FK_idx` (`idTipoGasto` ASC),
  INDEX `G_C_IC_FK_idx` (`idCaja` ASC),
  UNIQUE INDEX `idgastos_UNIQUE` (`idgastos` ASC),
  CONSTRAINT `GAS_IDC_FK`
    FOREIGN KEY (`idCaja`)
    REFERENCES `gestprof`.`cajas` (`idCaja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `GAS_IDG_FK`
    FOREIGN KEY (`idTipoGasto`)
    REFERENCES `gestprof`.`tipos_gasto` (`idTipoGasto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`groups` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`tipos_ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`tipos_ingreso` (
  `idTipoIngreso` INT(11) NOT NULL,
  `Descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTipoIngreso`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`ingresos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`ingresos` (
  `idingresos` INT NOT NULL AUTO_INCREMENT,
  `idCaja` INT(11) NOT NULL,
  `idTipoIngreso` INT(11) NOT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idingresos`, `idCaja`, `idTipoIngreso`),
  INDEX `INGI_IDC_FK_idx` (`idCaja` ASC),
  INDEX `ING_IDI_FK_idx` (`idTipoIngreso` ASC),
  UNIQUE INDEX `idingresos_UNIQUE` (`idingresos` ASC),
  CONSTRAINT `ING_IDC_FK`
    FOREIGN KEY (`idCaja`)
    REFERENCES `gestprof`.`cajas` (`idCaja`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ING_IDI_FK`
    FOREIGN KEY (`idTipoIngreso`)
    REFERENCES `gestprof`.`tipos_ingreso` (`idTipoIngreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`login_attempts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`login_attempts` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15) NOT NULL,
  `login` VARCHAR(100) NOT NULL,
  `time` INT(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`provincia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`provincia` (
  `idProvincia` INT(2) NOT NULL,
  `provincia` VARCHAR(30) NULL DEFAULT NULL,
  PRIMARY KEY (`idProvincia`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gestprof`.`users_groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestprof`.`users_groups` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `group_id` MEDIUMINT(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uc_users_groups` (`user_id` ASC, `group_id` ASC),
  INDEX `fk_users_groups_users1_idx` (`user_id` ASC),
  INDEX `fk_users_groups_groups1_idx` (`group_id` ASC),
  CONSTRAINT `fk_users_groups_groups1`
    FOREIGN KEY (`group_id`)
    REFERENCES `gestprof`.`groups` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `gestprof`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema project
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema project
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 ;
USE `project` ;

-- -----------------------------------------------------
-- Table `project`.`room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`room` (
  `roomid` INT NOT NULL AUTO_INCREMENT,
  `number` VARCHAR(25) NOT NULL,
  `description` VARCHAR(100) NULL,
  PRIMARY KEY (`roomid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`objectdescription`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`objectdescription` (
  `objectdescriptionid` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`objectdescriptionid`),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`object`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`object` (
  `objectid` INT NOT NULL AUTO_INCREMENT,
  `objectdescriptionid` INT NOT NULL,
  `roomid` INT NOT NULL,
  PRIMARY KEY (`objectid`),
  INDEX `fk_object_room_idx` (`roomid` ASC),
  INDEX `fk_object_objectdescription1_idx` (`objectdescriptionid` ASC),
  CONSTRAINT `fk_object_room`
    FOREIGN KEY (`roomid`)
    REFERENCES `project`.`room` (`roomid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_object_objectdescription1`
    FOREIGN KEY (`objectdescriptionid`)
    REFERENCES `project`.`objectdescription` (`objectdescriptionid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`componentvalue`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`componentvalue` (
  `componentvalueid` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`componentvalueid`),
  UNIQUE INDEX `value_UNIQUE` (`value` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`componentdescription`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`componentdescription` (
  `componentdescriptionid` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`componentdescriptionid`),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`component`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`component` (
  `componentid` INT NOT NULL AUTO_INCREMENT,
  `componentdescriptionid` INT NOT NULL,
  `componentvalueid` INT NOT NULL,
  PRIMARY KEY (`componentid`),
  INDEX `fk_component_componentvalue1_idx` (`componentvalueid` ASC),
  INDEX `fk_component_componentdescription1_idx` (`componentdescriptionid` ASC),
  CONSTRAINT `fk_component_componentvalue1`
    FOREIGN KEY (`componentvalueid`)
    REFERENCES `project`.`componentvalue` (`componentvalueid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_component_componentdescription1`
    FOREIGN KEY (`componentdescriptionid`)
    REFERENCES `project`.`componentdescription` (`componentdescriptionid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`objectcomponentassign`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`objectcomponentassign` (
  `objectid` INT NOT NULL,
  `componentid` INT NOT NULL,
  INDEX `fk_objectcomponentassign_object1_idx` (`objectid` ASC),
  INDEX `fk_objectcomponentassign_component1_idx` (`componentid` ASC),
  PRIMARY KEY (`objectid`, `componentid`),
  CONSTRAINT `fk_objectcomponentassign_object1`
    FOREIGN KEY (`objectid`)
    REFERENCES `project`.`object` (`objectid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_objectcomponentassign_component1`
    FOREIGN KEY (`componentid`)
    REFERENCES `project`.`component` (`componentid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`user` (
  `userid` INT NOT NULL,
  `name` VARCHAR(50) NULL,
  `firstname` VARCHAR(50) NULL,
  `email` VARCHAR(65) NULL,
  `password` VARCHAR(255) NULL,
  PRIMARY KEY (`userid`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

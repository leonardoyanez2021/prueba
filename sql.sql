--crea BD
CREATE DATABASE `bd_prueba` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

--crea tablas
CREATE TABLE `bd_prueba`.`region` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
  
  CREATE TABLE `bd_prueba`.`comuna` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `id_region` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `region_comuna`
    FOREIGN KEY (`id_region`)
    REFERENCES `bd_prueba`.`region` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
	
CREATE TABLE `bd_prueba`.`votacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `alias` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `rut` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  `id_candidato` int(11) DEFAULT NULL,
  `entero` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `bd_prueba`.`candidato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  PRIMARY KEY (`id`));
  
  ALTER TABLE `bd_prueba`.`votacion` 
ADD CONSTRAINT `vota_region`
  FOREIGN KEY (`id_region`)
  REFERENCES `bd_prueba`.`region` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `vota_comuna`
  FOREIGN KEY (`id_comuna`)
  REFERENCES `bd_prueba`.`comuna` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `vota_candidato`
  FOREIGN KEY (`id_candidato`)
  REFERENCES `bd_prueba`.`candidato` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
--datos mínimos
INSERT INTO `bd_prueba`.`region` (`nombre`) VALUES ('region 1');
INSERT INTO `bd_prueba`.`region` (`nombre`) VALUES ('region 2');


INSERT INTO `bd_prueba`.`comuna` (`nombre`, `id_region`) VALUES ('comuna 1', '1');
INSERT INTO `bd_prueba`.`comuna` (`nombre`, `id_region`) VALUES ('comuna 2', '1');
INSERT INTO `bd_prueba`.`comuna` (`nombre`, `id_region`) VALUES ('comuna 3', '2');
INSERT INTO `bd_prueba`.`comuna` (`nombre`, `id_region`) VALUES ('comuna 4', '2');
  
  
  
INSERT INTO `bd_prueba`.`candidato` (`nombre`) VALUES ('candidato 1');
INSERT INTO `bd_prueba`.`candidato` (`nombre`) VALUES ('candidato 2');
INSERT INTO `bd_prueba`.`candidato` (`nombre`) VALUES ('candidato 3');




  
  

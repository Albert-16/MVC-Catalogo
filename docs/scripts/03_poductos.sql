-- Active: 1643657430298@@127.0.0.1@3306@nw202202
CREATE TABLE `productos` (
  `invPrdId` bigint NOT NULL AUTO_INCREMENT,
  `invPrdBrCod` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `invPrdCodInt` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `invPrdDsc` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `invPrdTip` char(3) COLLATE utf8_bin DEFAULT NULL,
  `invPrdEst` char(3) COLLATE utf8_bin DEFAULT NULL,
  `invPrdPadre` bigint DEFAULT NULL,
  `invPrdFactor` int DEFAULT NULL,
  `invPrdVnd` char(3) COLLATE utf8_bin DEFAULT NULL,
  `invPrdPrecioVenta` decimal(9,2) DEFAULT NULL,
  `invPrdPrecioCompra` decimal(9,2) DEFAULT NULL,
  `invPrdStock` int DEFAULT NULL,
  PRIMARY KEY (`invPrdId`),
  UNIQUE KEY `invPrdBrCod_UNIQUE` (`invPrdBrCod`),
  UNIQUE KEY `invPrdCodIng_UNIQUE` (`invPrdCodInt`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*
CREATE TABLE `productos` (
  `invPrdId` bigint(13) NOT NULL AUTO_INCREMENT,
  `invPrdBrCod` varchar(128) DEFAULT NULL,
  `invPrdCodInt` varchar(128) DEFAULT NULL,
  `invPrdDsc` varchar(128) DEFAULT NULL,
  `invPrdTip` char(3) DEFAULT NULL,
  `invPrdEst` char(3) DEFAULT NULL,
  `invPrdPadre` bigint(13) DEFAULT NULL,
  `invPrdFactor` int(11) DEFAULT NULL,
  `invPrdVnd` char(3) DEFAULT NULL,
  PRIMARY KEY (`invPrdId`),
  UNIQUE KEY `invPrdBrCod_UNIQUE` (`invPrdBrCod`),
  UNIQUE KEY `invPrdCodIng_UNIQUE` (`invPrdCodInt`)
) ENGINE=InnoDB;
*/
/*
`invPrdId` bigint(13) NOT NULL AUTO_INCREMENT, Codigo autonumerico
  `invPrdBrCod` varchar(128) DEFAULT NULL,  Codigo de Barras
  `invPrdCodInt` varchar(128) DEFAULT NULL, Codigo interno institucional
  `invPrdDsc` varchar(128) DEFAULT NULL, Nombre
  `invPrdTip` char(3) DEFAULT NULL, Tipo de Producto
  `invPrdEst` char(3) DEFAULT NULL, Estado del Producto
  `invPrdPadre` bigint(13) DEFAULT NULL,  Codigo invPrdID del padre
  `invPrdFactor` int(11) DEFAULT NULL,
  `invPrdVnd` char(3) DEFAULT NULL,

  Caja de 24 Cajas de 100 Unds  1 null 0  NO   1   FRACCION 24 2
  Caja de 100 Unds 2    1  24             SI   24 0  24 23  1 FRACCION 100
  Unidad           3    2  100            SI   2400  100  99


*/

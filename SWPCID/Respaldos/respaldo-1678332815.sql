DROP TABLE IF EXISTS datos_usuarios;

CREATE TABLE `datos_usuarios` (
  `iddatos_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apellidoP` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apellidoM` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `telefono` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `firma_dato` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correo_electronico` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `estatus_dato` int(11) NOT NULL,
  `fecha_dato` date NOT NULL,
  `idtipos_usuarios` int(11) NOT NULL,
  `iddepartamentos_usuario` int(11) NOT NULL,
  PRIMARY KEY (`iddatos_usuario`,`iddepartamentos_usuario`,`idtipos_usuarios`),
  KEY `FK-Roles_idx` (`idtipos_usuarios`),
  KEY `FK-Departamento_idx` (`iddepartamentos_usuario`),
  CONSTRAINT `FK-Departamento` FOREIGN KEY (`iddepartamentos_usuario`) REFERENCES `departamentos_usuarios` (`iddepartamentos_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK-Roles` FOREIGN KEY (`idtipos_usuarios`) REFERENCES `tipos_usuarios` (`idtipos_usuarios_t`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

INSERT INTO datos_usuarios VALUES("1","Juan","Lopez","Benitez","7351234569","JLBCoordinador1","juan@gmail.com","Admin","Admin123","1","2023-01-17","1","1"),
("2","Rodolfo","Zavaleta","GarcÃ­a","7351847520","RZGCoordinador2","rodolfozavaleta19@gmail.com","RZGCoordinador2","RZGCoordinador2","1","2023-03-07","2","2"),
("3","Cristina","Zavaleta ","GarcÃ­a","7351894562","CZGEncargado3","cristina1h99@gmail.com","CZGEncargado3","CZGEncargado3","1","2023-03-07","3","3"),
("4","Cristian Alexander ","Barba","RodrÃ­guez","7351894524","CBRCoordinador4","crisalexbarba@gmail.com","CBRCoordinador4","CBRCoordinador4","1","2023-03-07","2","4"),
("5","Enrique Alexander","LeÃ³n ","Olivares","7358964125","ELOEncargado5","alexducky1@gmail.com","ELOEncargado5","ELOEncargado5","1","2023-03-07","3","5");



DROP TABLE IF EXISTS departamentos_usuarios;

CREATE TABLE `departamentos_usuarios` (
  `iddepartamentos_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_departamento_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `estatus_departamento` int(11) NOT NULL,
  `fecha_departamento` date NOT NULL,
  PRIMARY KEY (`iddepartamentos_usuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci ROW_FORMAT=COMPACT;

INSERT INTO departamentos_usuarios VALUES("1","Departamento de InformÃ¡tica ","1","2023-01-17"),
("2","Departamento de recursos humanos ","1","2023-01-17"),
("3","Departamento de marketing","1","2023-01-17"),
("4","Departamento de compras","1","2023-03-07"),
("5","Departamento de logÃ­stica y operaciones","1","2023-03-07"),
("7","Departamento de recursos humanos y reportes","1","2023-03-07");



DROP TABLE IF EXISTS documentos_entrada;

CREATE TABLE `documentos_entrada` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_recibido` date NOT NULL,
  `fecha_documento` date NOT NULL,
  `numero_documento` varchar(45) NOT NULL,
  `remitente_documento` varchar(45) NOT NULL,
  `asunto_documento` text NOT NULL,
  `destinatario_documento` varchar(45) NOT NULL,
  `introduccion_documento` text DEFAULT NULL,
  `recibido_documento` varchar(45) DEFAULT NULL,
  `prioridad_documento` varchar(45) NOT NULL,
  `estatus_doc` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL,
  `num_oficio` int(11) NOT NULL,
  PRIMARY KEY (`folio`,`tipo_doc`,`num_oficio`),
  KEY `FK-tiposDocumentos_idx` (`tipo_doc`),
  KEY `FK-numoficio_idx` (`num_oficio`),
  CONSTRAINT `FK-numoficio` FOREIGN KEY (`num_oficio`) REFERENCES `solicitudes_folio` (`idsolicitudes_folio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK-tiposDocumentos` FOREIGN KEY (`tipo_doc`) REFERENCES `tipos_documentos` (`idtipos_documentos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO documentos_entrada VALUES("1","2023-03-07","2023-02-17","OFICIO No. RJE 00.01","3","Apartar folio","Coordinador Rodolfo","Ingreso de documento","RZGCoordinador2","Urgente","1","1","1"),
("2","2023-03-07","2023-02-18","OFICIO No. RJE 00.02","3","Nuevo ingreso de anexo","Coordinador Rodolfo","Ingreso de documento","RZGCoordinador2","Urgente","1","5","2"),
("3","2023-03-07","2023-02-19","OFICIO No. RJE 00.03","5","Nuevo ingreso de carta de aceptaciÃ³n","Coordinador Cristian","Ingreso de documento","CBRCoordinador4","Media","1","1","3"),
("4","2023-03-07","2023-01-19","OFICIO No. RJE 00.04","5","Nuevo ingreso de oficio","Coordinador Cristian","Ingreso de documento","CBRCoordinador4","Baja","1","4","4"),
("5","2023-03-07","2023-01-21","OFICIO No. RJE 00.05","5","Apartar folio","Coordinador Cristian","Ingreso de documento","CBRCoordinador4","Media","1","5","5");



DROP TABLE IF EXISTS estatus_documento;

CREATE TABLE `estatus_documento` (
  `idestatus_docmento` int(11) NOT NULL AUTO_INCREMENT,
  `estatus_documento` varchar(100) NOT NULL,
  PRIMARY KEY (`idestatus_docmento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO estatus_documento VALUES("1","Pendiente"),
("2","Archivado"),
("3","Cancelado"),
("4","Entregado");



DROP TABLE IF EXISTS estatus_solicitudes_folio;

CREATE TABLE `estatus_solicitudes_folio` (
  `idestatus_solicitudes_folio` int(11) NOT NULL AUTO_INCREMENT,
  `estatus_solicitud` varchar(45) NOT NULL,
  `inidicador_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`idestatus_solicitudes_folio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO estatus_solicitudes_folio VALUES("1","Pendiente","1"),
("2","Archivado","1"),
("3","Cancelado","1"),
("4","Entregado","1");



DROP TABLE IF EXISTS notificaciones;

CREATE TABLE `notificaciones` (
  `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `dirigido` varchar(100) NOT NULL,
  `remitenten_notificacion` varchar(100) NOT NULL,
  `fecha_notificacion` date NOT NULL,
  `asunto_notificacion` text NOT NULL,
  `mensaje_notificacion` text NOT NULL,
  `usuarios_idUsuarios` int(11) NOT NULL,
  PRIMARY KEY (`idnotificaciones`,`usuarios_idUsuarios`),
  KEY `fk_notificaciones_usuarios1_idx` (`usuarios_idUsuarios`),
  CONSTRAINT `fk_notificaciones_usuarios1` FOREIGN KEY (`usuarios_idUsuarios`) REFERENCES `datos_usuarios` (`iddatos_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO notificaciones VALUES("1","cristina1h99@gmail.com","Rodolfo Zavaleta GarcÃ­a","2023-03-07","Entrega de documentos de asignaciÃ³n","Numero de folio asignado, por favor revisar el modulo de \"Seguimiento de asignaciÃ³n de numero de folio\" en el apartado de observaciones","2"),
("2","cristina1h99@gmail.com","Rodolfo Zavaleta GarcÃ­a","2023-03-07","Entrega de documentos de urgencia","Necesitamos el documento marcado con prioridad \"Urgente\" sea entregado en el departamento de coordinaciÃ³n","2"),
("3","cristina1h99@gmail.com","Rodolfo Zavaleta GarcÃ­a","2023-03-07","Entrega de documentos de urgencia","Necesitamos el documento marcado con prioridad \"Urgente\" sea entregado en el departamento de coordinaciÃ³n","2"),
("4","alexducky1@gmail.com","Cristian Alexander  Barba RodrÃ­guez","2023-03-07","Entrega de documentos de asignaciÃ³n","Numero de folio asignado, por favor revisar el modulo de \"Seguimiento de asignaciÃ³n de numero de folio\" en el apartado de observaciones","4"),
("5","alexducky1@gmail.com","Cristian Alexander  Barba RodrÃ­guez","2023-03-07","Entrega de documentos de asignaciÃ³n","Numero de folio asignado, por favor revisar el modulo de \"Seguimiento de asignaciÃ³n de numero de folio\" en el apartado de observaciones","4");



DROP TABLE IF EXISTS plantillas_documentos;

CREATE TABLE `plantillas_documentos` (
  `idplantillas_documentos` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_plantillas` text NOT NULL,
  `ruta_plantilla` varchar(250) NOT NULL,
  `fecha_plantilla` date NOT NULL,
  `estatus_plantilla` int(11) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  PRIMARY KEY (`idplantillas_documentos`,`tipo_documento`),
  KEY `FK-TipoDocumento_idx` (`tipo_documento`),
  CONSTRAINT `FK-TipoDocumento` FOREIGN KEY (`tipo_documento`) REFERENCES `tipos_documentos` (`idtipos_documentos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO plantillas_documentos VALUES("1","Plantilla de carta de aceptaciÃ³n sin sello","C:/xampp/htdocs/SWPCID_Cristina/SWPCID/Plantillas/Carta de aceptaciÃ³n.docx","2023-03-07","1","1"),
("2","Plantilla de carta de aceptaciÃ³n con sello","C:/xampp/htdocs/SWPCID_Cristina/SWPCID/Plantillas/FormatoPrueba.docx","2023-03-07","1","1"),
("3","Anexo sin firmas","C:/xampp/htdocs/SWPCID_Cristina/SWPCID/Plantillas/zavaletagarcia-elizabeth-M1AI6 (4).docx","2023-03-07","1","5"),
("4","Anexo con firmas","C:/xampp/htdocs/SWPCID_Cristina/SWPCID/Plantillas/Fecha (4).docx","2023-03-07","1","5"),
("5","Carta de renuncia completa","C:/xampp/htdocs/SWPCID_Cristina/SWPCID/Plantillas/FormatoPrueba.docx","2023-03-07","1","2");



DROP TABLE IF EXISTS recuperarcontra;

CREATE TABLE `recuperarcontra` (
  `idrecuperarContra` int(11) NOT NULL AUTO_INCREMENT,
  `passwordR` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `fecha_contra` date NOT NULL,
  `usuarios_idUsuarios` int(11) NOT NULL,
  `tipo_recupera` varchar(45) NOT NULL,
  PRIMARY KEY (`idrecuperarContra`,`usuarios_idUsuarios`),
  KEY `FK-User_idx` (`usuarios_idUsuarios`),
  CONSTRAINT `FK-User` FOREIGN KEY (`usuarios_idUsuarios`) REFERENCES `datos_usuarios` (`iddatos_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO recuperarcontra VALUES("1","0","0","gaFM9NE50U2A","2023-03-07","3","Usuario"),
("2","0","0","jrINOx5W92cZ","2023-03-07","3","ContraseÃ±a");



DROP TABLE IF EXISTS seguimiento_documento;

CREATE TABLE `seguimiento_documento` (
  `idseguimiento_documento` int(11) NOT NULL AUTO_INCREMENT,
  `indicador_seguimiento` int(11) NOT NULL,
  `fecha_seguimiento` date NOT NULL,
  `firma_seguimiento` varchar(45) NOT NULL,
  `acuse_segimiento` varchar(100) DEFAULT NULL,
  `observaciones_seguimiento` varchar(150) DEFAULT NULL,
  `id_estatus_Doc` int(11) NOT NULL,
  `usuarios_idUsuarios` int(11) NOT NULL,
  `documentos_entrada_Folio` int(11) NOT NULL,
  PRIMARY KEY (`idseguimiento_documento`,`documentos_entrada_Folio`,`usuarios_idUsuarios`,`id_estatus_Doc`),
  KEY `FK-Estatus_idx` (`id_estatus_Doc`),
  KEY `fk_seguimiento_documento_documentos_entrada1_idx` (`documentos_entrada_Folio`),
  KEY `FK-Usuarios_idx` (`usuarios_idUsuarios`),
  CONSTRAINT `FK-Estatus` FOREIGN KEY (`id_estatus_Doc`) REFERENCES `estatus_documento` (`idestatus_docmento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK-Usuarios` FOREIGN KEY (`usuarios_idUsuarios`) REFERENCES `datos_usuarios` (`iddatos_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguimiento_documento_documentos_entrada1` FOREIGN KEY (`documentos_entrada_Folio`) REFERENCES `documentos_entrada` (`folio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO seguimiento_documento VALUES("1","0","2023-03-07","RZGCoordinador2","","","1","3","1"),
("2","0","2023-03-07","RZGCoordinador2","","","1","3","2"),
("3","1","2023-03-07","CBRCoordinador4","","","1","5","3"),
("4","1","2023-03-07","CBRCoordinador4","","","1","5","4"),
("5","1","2023-03-07","CBRCoordinador4","","","1","5","5"),
("6","1","2023-03-07","RZGCoordinador2","","Documento entregado","4","3","1"),
("7","1","2023-03-07","RZGCoordinador2","","Folio cancelado","3","3","2");



DROP TABLE IF EXISTS seguimiento_folios;

CREATE TABLE `seguimiento_folios` (
  `idseguimiento_estatus` int(11) NOT NULL AUTO_INCREMENT,
  `idsolicitud_folio` int(11) NOT NULL,
  `idestatus_folios` int(11) NOT NULL,
  `indicador_seguimiento` int(11) NOT NULL,
  `fecha_seguimiento` date NOT NULL,
  `observaciones_seguimientoFolio` text DEFAULT NULL,
  PRIMARY KEY (`idseguimiento_estatus`,`idsolicitud_folio`,`idestatus_folios`),
  KEY `FK-SolicitudFolio_idx` (`idsolicitud_folio`),
  KEY `FK-EstatusFolio_idx` (`idestatus_folios`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO seguimiento_folios VALUES("1","11","1","1","2023-03-03",""),
("2","1","1","1","2023-03-07",""),
("3","2","1","1","2023-03-07",""),
("4","3","1","1","2023-03-07",""),
("5","4","1","0","2023-03-07",""),
("6","3","1","1","2023-03-07",""),
("7","4","1","1","2023-03-07",""),
("8","5","1","1","2023-03-07",""),
("9","4","1","1","2023-03-07","El numero de folio solicitado es el 1");



DROP TABLE IF EXISTS solicitudes_folio;

CREATE TABLE `solicitudes_folio` (
  `idsolicitudes_folio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_solicitud` date NOT NULL,
  `Asunto_solicitud` varchar(100) NOT NULL,
  `destinado_solicitud` varchar(45) NOT NULL,
  `prioridad_solicitud` varchar(45) NOT NULL,
  `estatus_solicitudFolio` int(11) NOT NULL,
  `indicador_folios` int(11) NOT NULL,
  `usuarios_idUsuarios` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL,
  PRIMARY KEY (`idsolicitudes_folio`,`usuarios_idUsuarios`,`tipo_doc`),
  KEY `fk_solicitudes_folio_usuarios1_idx` (`usuarios_idUsuarios`),
  KEY `fk_tipo_documentos_idx` (`tipo_doc`),
  CONSTRAINT `fk_solicitudes_folio_usuarios1` FOREIGN KEY (`usuarios_idUsuarios`) REFERENCES `datos_usuarios` (`iddatos_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_documentos` FOREIGN KEY (`tipo_doc`) REFERENCES `tipos_documentos` (`idtipos_documentos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO solicitudes_folio VALUES("1","2023-03-07","Apartar folio","RZGCoordinador2","Urgente","1","0","3","1"),
("2","2023-03-07","Nuevo ingreso de anexo","RZGCoordinador2","Urgente","1","0","3","5"),
("3","2023-03-07","Nuevo ingreso de carta de aceptaciÃ³n","CBRCoordinador4","Media","1","0","5","1"),
("4","2023-03-07","Nuevo ingreso de oficio","CBRCoordinador4","Baja","1","0","5","4"),
("5","2023-03-07","Apartar folio","CBRCoordinador4","Media","1","0","5","5");



DROP TABLE IF EXISTS tipos_documentos;

CREATE TABLE `tipos_documentos` (
  `idtipos_documentos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipoDoc` varchar(45) NOT NULL,
  `estatus_tipoDoc` int(11) NOT NULL,
  `fecha_tipoDoc` date NOT NULL,
  PRIMARY KEY (`idtipos_documentos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO tipos_documentos VALUES("1","Carta de aceptaciÃ³n","1","2023-01-25"),
("2","Carta de renuncia","1","2023-01-25"),
("3","Acuse de recibido","1","2023-01-25"),
("4","Oficio","1","2023-01-25"),
("5","Anexo","1","2023-01-25"),
("6","Carta de recomendaciÃ³n","1","2023-01-25");



DROP TABLE IF EXISTS tipos_usuarios;

CREATE TABLE `tipos_usuarios` (
  `idtipos_usuarios_t` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `estatus_tipo` int(45) NOT NULL,
  PRIMARY KEY (`idtipos_usuarios_t`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

INSERT INTO tipos_usuarios VALUES("1","Administrador","1"),
("2","Coordinador","1"),
("3","Encargado","1");




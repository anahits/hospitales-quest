-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sumawebd_cuestionario
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `caracterist_enfermedad`
--

DROP TABLE IF EXISTS `caracterist_enfermedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracterist_enfermedad` (
  `idcaracter_enfermedad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `canti_exacerb` int(11) NOT NULL,
  `prurito` varchar(2) NOT NULL,
  `depresion` varchar(2) NOT NULL,
  `dias_consult_perdidos` int(11) NOT NULL,
  `dias_escol_perdidos` int(11) NOT NULL,
  `dias_acomp_perdidos` int(11) NOT NULL,
  `dias_urgenc_perdidos` int(11) NOT NULL,
  `dias_incap_perdidos` int(11) NOT NULL,
  PRIMARY KEY (`idcaracter_enfermedad`),
  UNIQUE KEY `idcaracter_enfermedad_UNIQUE` (`idcaracter_enfermedad`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracterist_enfermedad`
--

LOCK TABLES `caracterist_enfermedad` WRITE;
/*!40000 ALTER TABLE `caracterist_enfermedad` DISABLE KEYS */;
INSERT INTO `caracterist_enfermedad` VALUES (1,1,10,'SI','NO',1,3,54,1,23),(2,2,0,'NO','NO',2,3,54,0,23),(3,3,10,'SI','NO',0,3,54,0,23),(4,4,0,'NO','NO',0,0,0,0,0),(5,5,5,'NO','SI',0,1,2,0,3),(6,6,0,'NO','NO',0,1,2,0,3),(8,8,0,'NO','NO',0,0,0,0,0),(9,9,0,'NO','NO',0,1,2,0,3),(10,10,0,'NO','NO',0,0,0,0,0),(11,11,0,'NO','NO',0,0,0,0,0);
/*!40000 ALTER TABLE `caracterist_enfermedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clasificacion_enfermedad`
--

DROP TABLE IF EXISTS `clasificacion_enfermedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clasificacion_enfermedad` (
  `idenfermedad_clasificacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `anios_evolucion` varchar(15) NOT NULL,
  `tipo_da` varchar(45) NOT NULL,
  `scorad_calculo` float NOT NULL,
  `bsa_calculo` float NOT NULL,
  `easi_calculo` float NOT NULL,
  `iga_calculo` float NOT NULL,
  `iga_modificado_calculo` float NOT NULL,
  PRIMARY KEY (`idenfermedad_clasificacion`),
  UNIQUE KEY `idenfermedad_clasificacion_UNIQUE` (`idenfermedad_clasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificacion_enfermedad`
--

LOCK TABLES `clasificacion_enfermedad` WRITE;
/*!40000 ALTER TABLE `clasificacion_enfermedad` DISABLE KEYS */;
INSERT INTO `clasificacion_enfermedad` VALUES (1,2,'5 años','Grave',49,0,0,0,5),(2,3,'5 años','Grave',49,0,3,0,5),(3,5,'4.1 años','Grave',52,62,72,82,91.9),(4,6,'4 años','Moderada',5,6,7,8,9),(5,7,'4 años','Moderada',5,6,7,8,9),(6,10,'4 años','Moderada',5,6,7,8,9),(7,10,'4 años','Moderada',5,6,7,8,9),(8,10,'4 años','Moderada',5,6,7,8,9),(9,10,'4 años','Moderada',5,6,7,8,9),(10,5,'4.1 años','Grave',52,62,72,82,91.9),(11,5,'4.1 años','Grave',52,62,72,82,91.9),(12,5,'4.1 años','Grave',52,62,72,82,91.9);
/*!40000 ALTER TABLE `clasificacion_enfermedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `idconsultas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `num_consulta` int(11) NOT NULL,
  `tipo_consulta` varchar(16) NOT NULL,
  `fecha` date NOT NULL,
  `especialidad` varchar(45) NOT NULL,
  `medicamento` varchar(100) NOT NULL,
  `tipo_medicamento` varchar(45) NOT NULL,
  `cantidad_medicamento` int(11) NOT NULL,
  `medida_medicamento` varchar(11) NOT NULL,
  `cada_horas` int(11) NOT NULL,
  `durante_dias` int(11) NOT NULL,
  `causa_urgencia` varchar(100) NOT NULL,
  `num_horas_urgencias` int(11) NOT NULL,
  `hospitaliza_urgencias` varchar(2) NOT NULL,
  `dias_hospital_urgen` int(11) NOT NULL,
  PRIMARY KEY (`idconsultas`),
  UNIQUE KEY `idconsultas_UNIQUE` (`idconsultas`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (43,2,3,'Interconsulta','0000-00-00','Gastroenterología','Amoxicilina','Antibiótico Sistémico',2,'gotas',2,2,'gastritis',0,'',0),(44,2,4,'Consulta General','0000-00-00','Dermatología','Aciclovir','Antiviral',0,'gotas',0,0,'',0,'',0);
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_pacientes`
--

DROP TABLE IF EXISTS `datos_pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos_pacientes` (
  `iddatos_pacientes` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hospital_paciente` varchar(100) NOT NULL,
  `rfc_paciente` varchar(13) NOT NULL,
  `iniciales_paciente` varchar(10) NOT NULL,
  `genero_paciente` varchar(14) NOT NULL,
  `edad_paciente` varchar(14) NOT NULL,
  `paciente_ocupacion` varchar(45) NOT NULL,
  `escolaridad_paciente` varchar(45) NOT NULL,
  `lugar_residencia_paciente` varchar(7) NOT NULL,
  `estado_pais_paciente` varchar(45) NOT NULL,
  `inicio_consultas` date NOT NULL,
  `fin_consultas` date NOT NULL,
  PRIMARY KEY (`iddatos_pacientes`),
  UNIQUE KEY `iddatos_pacientes_UNIQUE` (`iddatos_pacientes`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_pacientes`
--

LOCK TABLES `datos_pacientes` WRITE;
/*!40000 ALTER TABLE `datos_pacientes` DISABLE KEYS */;
INSERT INTO `datos_pacientes` VALUES (1,'Hospital Chiapas 3er nivel','LETU983028P9I','LETU','Mujer','12.3 años','Secretaria','Maestría','Foraneo','Nayarit','2019-02-05','2019-02-06'),(2,'Hospital Regional Lic. Adolfo López Mateos (CDMX) 3er nivel','LETU983028P9I','LETU','Mujer','12.3 años','Secretaria','Maestría','Foraneo','Nayarit','2019-02-05','2019-02-06'),(3,'Hospital Chiapas 3er nivel','OTRO983028P9I','OTRO','Hombre','20 años','Hogar','Primaria','Foraneo','Hidalgo','2019-02-04','2019-02-12'),(4,'Hospital Regional Lic. Adolfo López Mateos (CDMX) 3er nivel','POLA983028P9I','POLA','Mujer','58 años','Hogar','Secundaria','Foraneo','Nuevo León','2019-02-06','2019-02-20'),(5,'CMN 20 de Noviembre (CDMX) 3er nivel','YOYA983028P9I','YOYO','Hombre','23.5 años','Hogar','Preparatoria y/o carrrera técnica','Foraneo','Campeche','2019-02-12','2019-02-27'),(6,'Hospital Darío Fernandez (CDMX) 2er nivel','VUYA983028P9I','VUYA','Hombre','23.5 años','Hogar','Preparatoria y/o carrrera técnica','Foraneo','Morelos','2019-02-12','2019-02-27'),(8,'Hospital Darío Fernandez (CDMX) 2er nivel','VUYA983028P9I','VUYA','Hombre','23.5 años','Hogar','Doctorado','Foraneo','Morelos','2019-02-12','2019-02-27'),(9,'Hospital Darío Fernandez (CDMX) 2er nivel','VUYA983028P9I','VUYA','Hombre','23.5 años','Hogar','Doctorado','Foraneo','Morelos','2019-02-12','2019-02-27'),(10,'CMN 20 de Noviembre (CDMX) 3er nivel','LOPE983028P9I','LOPE','Mujer','55 años','Nini','Secundaria','Foraneo','Chihuahua','2018-01-09','2018-02-15'),(11,'Hospital Regional Lic. Adolfo López Mateos (CDMX) 3er nivel','','TRES','Hombre','','Empleado del gobierno','Doctorado','Local','','0000-00-00','0000-00-00'),(12,'Hospital Darío Fernandez (CDMX) 2er nivel','VUYA983028P9I','VUYA','Hombre','23.5 años','Hogar','Preparatoria y/o carrrera técnica','Foraneo','Morelos','2019-02-12','2019-02-27'),(13,'Hospital Darío Fernandez (CDMX) 2er nivel','VUYA983028P9I','VUYA','Hombre','23.5 años','Hogar','Preparatoria y/o carrrera técnica','Foraneo','Morelos','2019-02-12','2019-02-27'),(14,'CMN 20 de Noviembre (CDMX) 3er nivel','YOYA983028P9I','YOYO','Hombre','23.5 años','Hogar','Preparatoria y/o carrrera técnica','Foraneo','Campeche','2019-02-12','2019-02-27');
/*!40000 ALTER TABLE `datos_pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escolaridad`
--

DROP TABLE IF EXISTS `escolaridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escolaridad` (
  `idescolaridad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `escolaridad_nivel` varchar(45) NOT NULL,
  PRIMARY KEY (`idescolaridad`),
  UNIQUE KEY `idescolaridad_UNIQUE` (`idescolaridad`),
  UNIQUE KEY `escolaridad_nivel_UNIQUE` (`escolaridad_nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escolaridad`
--

LOCK TABLES `escolaridad` WRITE;
/*!40000 ALTER TABLE `escolaridad` DISABLE KEYS */;
INSERT INTO `escolaridad` VALUES (15,'Doctorado'),(5,'Licenciatura'),(12,'MaestrÃ­a'),(6,'Maestría'),(1,'Preescolar'),(14,'Preparatoria y/o carrrera tÃ©cnica'),(4,'Preparatoria y/o carrrera técnica'),(2,'Primaria'),(3,'Secundaria'),(13,'Sin escolaridad');
/*!40000 ALTER TABLE `escolaridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad_tipo`
--

DROP TABLE IF EXISTS `especialidad_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidad_tipo` (
  `idespecialidad_tipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_especialidad` varchar(45) NOT NULL,
  `tipo_consulta` varchar(45) NOT NULL,
  PRIMARY KEY (`idespecialidad_tipo`),
  UNIQUE KEY `idespecialidad_tipo_UNIQUE` (`idespecialidad_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad_tipo`
--

LOCK TABLES `especialidad_tipo` WRITE;
/*!40000 ALTER TABLE `especialidad_tipo` DISABLE KEYS */;
INSERT INTO `especialidad_tipo` VALUES (1,'Dermatología','Consulta General'),(2,'Medicina Interna','Interconsulta'),(3,'Alergia','Interconsulta'),(4,'Infectología','Interconsulta'),(5,'Oftanmología','Interconsulta'),(6,'Psicología','Interconsulta'),(7,'Psiquieatría','Interconsulta'),(8,'Gastroenterología','Interconsulta');
/*!40000 ALTER TABLE `especialidad_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudios_gabinete`
--

DROP TABLE IF EXISTS `estudios_gabinete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudios_gabinete` (
  `idestudios_gabinete` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `estudios_gabinete` varchar(45) NOT NULL,
  `num_estudios_gab` int(11) NOT NULL,
  `tipo_consulta` varchar(45) NOT NULL,
  PRIMARY KEY (`idestudios_gabinete`),
  UNIQUE KEY `idestudios_gabinete_UNIQUE` (`idestudios_gabinete`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudios_gabinete`
--

LOCK TABLES `estudios_gabinete` WRITE;
/*!40000 ALTER TABLE `estudios_gabinete` DISABLE KEYS */;
INSERT INTO `estudios_gabinete` VALUES (12,2,'otro estudio gabinete urgencia',5,'Urgencias');
/*!40000 ALTER TABLE `estudios_gabinete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudios_gabinete_tipos`
--

DROP TABLE IF EXISTS `estudios_gabinete_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudios_gabinete_tipos` (
  `idtipo_estudio_gabinete` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_estudio_gabinete` varchar(100) NOT NULL,
  PRIMARY KEY (`idtipo_estudio_gabinete`),
  UNIQUE KEY `idtipo_estudio_gabinete_UNIQUE` (`idtipo_estudio_gabinete`),
  UNIQUE KEY `tipo_estudio_gabinete_UNIQUE` (`tipo_estudio_gabinete`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudios_gabinete_tipos`
--

LOCK TABLES `estudios_gabinete_tipos` WRITE;
/*!40000 ALTER TABLE `estudios_gabinete_tipos` DISABLE KEYS */;
INSERT INTO `estudios_gabinete_tipos` VALUES (5,'Electrocardiograma'),(1,'Espirometría'),(4,'Lateral de Toráx'),(15,'otro estudio gabinete interconsulta'),(16,'otro estudio gabinete urgencia'),(2,'Radiografías de senos paranasales'),(3,'Telerradiografía de Tórax'),(6,'Tomografía (sitio)');
/*!40000 ALTER TABLE `estudios_gabinete_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudios_laboratorio`
--

DROP TABLE IF EXISTS `estudios_laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudios_laboratorio` (
  `idestudios_laboratorio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `estudios_laboratorio` varchar(100) NOT NULL,
  `num_estudios_lab` int(11) NOT NULL,
  `tipo_consulta` varchar(45) NOT NULL,
  PRIMARY KEY (`idestudios_laboratorio`),
  UNIQUE KEY `idestudios_laboratorio_UNIQUE` (`idestudios_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudios_laboratorio`
--

LOCK TABLES `estudios_laboratorio` WRITE;
/*!40000 ALTER TABLE `estudios_laboratorio` DISABLE KEYS */;
INSERT INTO `estudios_laboratorio` VALUES (1,1,'otro estudio laboratorio',2,'Consulta General'),(2,1,'Biometría Hemática Completa Plaquetas',3,'Consulta General'),(3,1,'Biometría Hemática Completa Plaquetas',3,'Interconsulta'),(4,1,'Biometría Hemática Completa Plaquetas',3,'Urgencias'),(5,1,'Perfil Lípidico Colesterol HDL',3,'Hospitalización'),(6,1,'Química Sanguínea BUN',3,'Hospitalización'),(7,1,'otro estudio de laboratorio hospitalización ',3,'Hospitalización'),(16,3,'Pruebas de función hepática Relación A/G',4,'Consulta General'),(17,3,'Perfil Lípidico Colesterol total',3,'Urgencias'),(20,6,'Biometría Hemática Completa Diferencial',2,'Interconsulta'),(21,6,'Biometría Hemática Completa FB',3,'Urgencias'),(178,10,'DHL',1,'Consulta General'),(179,10,'IgE total',2,'Consulta General'),(193,2,'Química Sanguínea BUN',3,'Hospitalización'),(210,5,'PCR',2,'Consulta General');
/*!40000 ALTER TABLE `estudios_laboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudios_laboratorio_tipos`
--

DROP TABLE IF EXISTS `estudios_laboratorio_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudios_laboratorio_tipos` (
  `idestudios_laboratorio_tipos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_estudio_laboratorio` varchar(100) NOT NULL,
  PRIMARY KEY (`idestudios_laboratorio_tipos`),
  UNIQUE KEY `idestudios_laboratorio_tipos_UNIQUE` (`idestudios_laboratorio_tipos`),
  UNIQUE KEY `tipo_estudio_laboratorio_UNIQUE` (`tipo_estudio_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudios_laboratorio_tipos`
--

LOCK TABLES `estudios_laboratorio_tipos` WRITE;
/*!40000 ALTER TABLE `estudios_laboratorio_tipos` DISABLE KEYS */;
INSERT INTO `estudios_laboratorio_tipos` VALUES (36,'Antiestreptolisinas'),(3,'Biometría Hemática Completa Diferencial'),(2,'Biometría Hemática Completa FB'),(1,'Biometría Hemática Completa FR'),(45,'Biometría Hemática Completa Plaquetas'),(42,'Copros'),(34,'Cultivo cutáneo'),(41,'DHL'),(35,'EGO'),(10,'Estudio histopatológico'),(31,'Exudado faríngeo Cultivo de exudado faríngeo'),(32,'Exudado vaginal Cultivo de exudado vaginal'),(40,'Factor Reumatoide'),(43,'IgA'),(9,'IgE específica'),(8,'IgE total'),(44,'IgM'),(74,'Inmunoglobulinas'),(87,'otro estudio de laboratorio consulta general'),(86,'otro estudio de laboratorio hospitalización '),(75,'otro estudio laboratorio'),(192,'OTRORTORTO'),(38,'PCR'),(52,'Perfil Lípidico Colesterol HDL'),(51,'Perfil Lípidico Colesterol LDL'),(50,'Perfil Lípidico Colesterol total'),(53,'Perfil Lípidico Colesterol VLDL'),(54,'Perfil Lípidico Triglicéridos'),(193,'Pruebas de alergia Epicutáneas'),(19,'Pruebas de función hepática Albúmina'),(26,'Pruebas de función hepática ALT (Alanina transaminasa)'),(27,'Pruebas de función hepática AST ó TGO (Transaminasa glutámica-oxaloacética)'),(47,'Pruebas de función hepática Bilirrubina Directa (BD)'),(48,'Pruebas de función hepática Bilirrubina Indirecta (BI)'),(46,'Pruebas de función hepática Bilirrubina Total (BT)'),(28,'Pruebas de función hepática DHL'),(30,'Pruebas de función hepática Fosfatasa alcalina'),(29,'Pruebas de función hepática GGT (Gamma Glutamil Transpeptidasa)'),(20,'Pruebas de función hepática Globulina'),(21,'Pruebas de función hepática Relación A/G'),(49,'Pruebas de función hepática TGP (Transaminasa G. Piruvica)'),(11,'Pruebas de función renal especial (Glomerular/Tubular) '),(13,'Pruebas de función renal especial Depuración de CR de 24 horas'),(16,'Pruebas de función renal especial Electrolitos Séricos Cl'),(15,'Pruebas de función renal especial Electrolitos Séricos K'),(18,'Pruebas de función renal especial Electrolitos Séricos Mg (Magnesio)'),(14,'Pruebas de función renal especial Electrolitos Séricos Na'),(17,'Pruebas de función renal especial Electrolitos Séricos P (Fósforo)'),(12,'Pruebas de función renal especial FeNa'),(7,'Química Sanguínea BUN'),(6,'Química Sanguínea Creatinina'),(4,'Química Sanguínea Glucosa'),(5,'Química Sanguínea Urea'),(33,'Urocultivo'),(39,'VSG');
/*!40000 ALTER TABLE `estudios_laboratorio_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitales`
--

DROP TABLE IF EXISTS `hospitales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hospitales` (
  `idhospitales` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hospital_nombre` text NOT NULL,
  PRIMARY KEY (`idhospitales`),
  UNIQUE KEY `idhospitales_UNIQUE` (`idhospitales`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitales`
--

LOCK TABLES `hospitales` WRITE;
/*!40000 ALTER TABLE `hospitales` DISABLE KEYS */;
INSERT INTO `hospitales` VALUES (1,'Hospital Regional Lic. Adolfo López Mateos (CDMX) 3er nivel'),(2,'Hospital Regional Dr. Valentín Gomez Farías (Guadalajara) 3er nivel'),(3,'Hospital Regional de Méxicali (Mexicali) 3er nivel'),(4,'CMN 20 de Noviembre (CDMX) 3er nivel'),(5,'Hospital de Alta Especialidad Bicentenario (Cuernavaca) 3er nivel'),(6,'Hospital Regional de Toluca 3er nivel'),(7,'Hospital Regional de Morelia (León) 3er nivel'),(8,'Hospital Regional de Monterrey (MTY) 3er nivel'),(9,'Hospital Chiapas 3er nivel'),(10,'Hospital Zaragoza (Edo Mex) 2er nivel'),(11,'Hospital Darío Fernandez (CDMX) 2er nivel'),(12,'Hospital 1ro de Octubre (CDMX) 2do nivel');
/*!40000 ALTER TABLE `hospitales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos_tipo`
--

DROP TABLE IF EXISTS `medicamentos_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamentos_tipo` (
  `idmedicamentos_tipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medicamento` varchar(45) NOT NULL,
  `tipo_medicamento` varchar(45) NOT NULL,
  PRIMARY KEY (`idmedicamentos_tipo`),
  UNIQUE KEY `idmedicamentos_tipo_UNIQUE` (`idmedicamentos_tipo`),
  UNIQUE KEY `medic_tipo_indx` (`medicamento`,`tipo_medicamento`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos_tipo`
--

LOCK TABLES `medicamentos_tipo` WRITE;
/*!40000 ALTER TABLE `medicamentos_tipo` DISABLE KEYS */;
INSERT INTO `medicamentos_tipo` VALUES (1,'Loratadina','Antihistamínico'),(2,'Clorafenamina','Antihistamínico'),(3,'Levocetirizina','Antihistamínico'),(4,'Fexofenadina','Antihistamínico'),(5,'Difenhidramina','Antihistamínico'),(6,'Hidroxizina','Antihistamínico'),(7,'Hidrocortisona','Esteroide tópico'),(8,'Acetónido de fluocinolona','Esteroide tópico'),(9,'Prednisona','Esteroide oral'),(10,'Deflazacort','Esteroide oral'),(11,'Metilprednisolona','Esteroide oral'),(12,'Hidrocortisona','Esteroide oral'),(13,'Dexametasona','Esteroide oral'),(14,'Prednisolona','Esteroide oral'),(15,'Motelukast','Esteroide oral'),(16,'Pimecrolimus 1%','Inhibidor de calcineurina tópico'),(17,'Tacrolimus 0.03%','Inhibidor de calcineurina tópico'),(18,'Tacrolimus 0.1%','Inhibidor de calcineurina tópico'),(19,'Ciclosporina A','Inhibidor de calcineurina sistémico'),(20,'Tacrolimus','Inhibidor de calcineurina sistémico'),(21,'Metorexato','Inmunomodulador'),(22,'Azatioprina','Inmunomodulador'),(23,'Micofenolato de mofetilo','Inmunomodulador'),(24,'Talidomida','Inmunomodulador'),(25,'Sertralina','Psicotrópico'),(26,'Amitriptilina','Psicotrópico'),(27,'Venlafaxina','Psicotrópico'),(28,'Paroxetina','Psicotrópico'),(29,'Fluoxetina','Psicotrópico'),(30,'Citalopram','Psicotrópico'),(31,'Escitalopram','Psicotrópico'),(32,'Imipramina','Psicotrópico'),(33,'Atomoxetina','Psicotrópico'),(34,'Metilfedinato','Psicotrópico'),(35,'Doxepina','Psicotrópico'),(36,'Clonazepam','Benzodiacepina'),(37,'Alprazolam','Benzodiacepina'),(38,'Diazepam','Benzodiacepina'),(39,'Bromazepam','Benzodiacepina'),(40,'Dicloxacilina','Antibiótico Sistémico'),(41,'Clindamicina','Antibiótico Sistémico'),(42,'Amoxicilina','Antibiótico Sistémico'),(43,'Amoxicilina/ácido clavulánico','Antibiótico Sistémico'),(44,'Ceftriaxona','Antibiótico Sistémico'),(45,'Eritromicina','Antibiótico Sistémico'),(46,'Trimetoprim/Sulfametoxazol','Antibiótico Sistémico'),(47,'Pencilina G benzatínica','Antibiótico Sistémico'),(48,'Ciprofloxacino','Antibiótico Sistémico'),(49,'Cefalexina','Antibiótico Sistémico'),(50,'Cefepime','Antibiótico Sistémico'),(51,'Ceftazidima','Antibiótico Sistémico'),(52,'Mupirocina','Antibiótico Tópico'),(53,'Ácido fusídico','Antibiótico Tópico'),(54,'Clioquinol (Diyodohidroxiquinoleina)','Antibiótico Tópico'),(55,'Gentamicina','Antibiótico Tópico'),(56,'Terbinafina','Antimicótico Sistémico'),(57,'Fluconazol','Antimicótico Sistémico'),(58,'Itraconzaol','Antimicótico Sistémico'),(59,'Miconazol','Antimicótico Tópico'),(60,'Isoconazol','Antimicótico Tópico'),(61,'Clotrimazol','Antimicótico Tópico'),(62,'Aciclovir','Antiviral'),(63,'Rivabirina','Antiviral'),(64,'Isoprinosina','Antiviral'),(65,'Sustituto de jabón','Jabón especial'),(66,'Jabón Bebé Johnson','Jabón especial'),(67,'Dove','Jabón especial'),(68,'Eucerin aceite de baño','Jabón especial'),(69,'Lipikar','Jabón especial'),(70,'Syndet','Jabón especial'),(71,'Atoderm','Jabón especial'),(72,'Trixera','Jabón especial'),(73,'Cetaphil','Jabón especial'),(74,'Omalizumab','Biológico'),(75,'Infliximab','Biológico'),(76,'Adalimumab','Biológico'),(77,'PUVA','Fototerapia'),(78,'UVB','Fototerapia'),(79,'Inmunoglobulina G IV','Inmunoglobulina G IV'),(80,'Salbutamol','Aerosol'),(81,'Salbutamol + ipatropio','Aerosol'),(82,'Beclometasona','Aerosol'),(83,'Salmeterol','Aerosol'),(84,'Salmeterol + fluticasona','Aerosol'),(85,'Farmoterol','Aerosol'),(86,'Farmoterol + fluticasona','Aerosol'),(87,'Mometasona','Spray Nasal'),(88,'Fenilefrina','Spray Nasal'),(89,'Beclometasona','Spray Nasal'),(90,'Cromoglicato de sodio','Oftálmico'),(91,'Dexametasona','Oftálmico'),(92,'Tobramicina/Dexametasona','Oftálmico'),(93,'Hipromelosa','Oftálmico'),(94,'Metilcelulosa','Oftálmico'),(95,'Vacuna','Inmunoterapia'),(108,'Shampoo Johnson & Johnson','Jabón liquido'),(107,'Nivea de tarro','Emolientes'),(106,'Desonide','Emolientes'),(109,'Mometasona crema','Emolientes'),(110,'Shampoo Jhonson & Johnson','Jabón liquido'),(111,'Crema Nivea de tarro','Emolientes');
/*!40000 ALTER TABLE `medicamentos_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocupaciones`
--

DROP TABLE IF EXISTS `ocupaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocupaciones` (
  `idocupaciones` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ocupacion_tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idocupaciones`),
  UNIQUE KEY `idocupaciones_UNIQUE` (`idocupaciones`),
  UNIQUE KEY `ocupacion_tipo_UNIQUE` (`ocupacion_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocupaciones`
--

LOCK TABLES `ocupaciones` WRITE;
/*!40000 ALTER TABLE `ocupaciones` DISABLE KEYS */;
INSERT INTO `ocupaciones` VALUES (1,'Empleado del gobierno'),(5,'Estudiante'),(4,'Hogar'),(9,'Lactante'),(2,'Maestro'),(10,'Nini'),(3,'Secretaria');
/*!40000 ALTER TABLE `ocupaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedimientos`
--

DROP TABLE IF EXISTS `procedimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procedimientos` (
  `idprocedimientos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `procedimiento` varchar(45) NOT NULL,
  `num_proced` int(11) NOT NULL,
  `tipo_consulta` varchar(45) NOT NULL,
  PRIMARY KEY (`idprocedimientos`),
  UNIQUE KEY `idprocedimientos_UNIQUE` (`idprocedimientos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedimientos`
--

LOCK TABLES `procedimientos` WRITE;
/*!40000 ALTER TABLE `procedimientos` DISABLE KEYS */;
INSERT INTO `procedimientos` VALUES (6,2,'Ultrasonido',4,'Hospitalización');
/*!40000 ALTER TABLE `procedimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedimientos_tipos`
--

DROP TABLE IF EXISTS `procedimientos_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procedimientos_tipos` (
  `idprocedimientos_tipos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_procedimiento` varchar(100) NOT NULL,
  PRIMARY KEY (`idprocedimientos_tipos`),
  UNIQUE KEY `idprocedimientos_tipos_UNIQUE` (`idprocedimientos_tipos`),
  UNIQUE KEY `tipo_procedimiento_UNIQUE` (`tipo_procedimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedimientos_tipos`
--

LOCK TABLES `procedimientos_tipos` WRITE;
/*!40000 ALTER TABLE `procedimientos_tipos` DISABLE KEYS */;
INSERT INTO `procedimientos_tipos` VALUES (1,'Biopsia'),(7,'otro procedimiento consulta general'),(8,'otro procedimiento interconsulta'),(3,'Ultrasonido');
/*!40000 ALTER TABLE `procedimientos_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pruebas_alergia`
--

DROP TABLE IF EXISTS `pruebas_alergia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pruebas_alergia` (
  `idprocedimientos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `pruebas_alergia` varchar(45) NOT NULL,
  `num_prueba_alerg` int(11) NOT NULL,
  `tipo_consulta` varchar(45) NOT NULL,
  PRIMARY KEY (`idprocedimientos`),
  UNIQUE KEY `idprocedimientos_UNIQUE` (`idprocedimientos`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pruebas_alergia`
--

LOCK TABLES `pruebas_alergia` WRITE;
/*!40000 ALTER TABLE `pruebas_alergia` DISABLE KEYS */;
INSERT INTO `pruebas_alergia` VALUES (11,2,'Pruebas de alergia PRICK',4,'Urgencias');
/*!40000 ALTER TABLE `pruebas_alergia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pruebas_alergia_tipos`
--

DROP TABLE IF EXISTS `pruebas_alergia_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pruebas_alergia_tipos` (
  `idpruebas_alergia_tipos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_prueba_alergia` varchar(100) NOT NULL,
  PRIMARY KEY (`idpruebas_alergia_tipos`),
  UNIQUE KEY `idpruebas_alergia_tipos_UNIQUE` (`idpruebas_alergia_tipos`),
  UNIQUE KEY `tipo_prueba_alergia_UNIQUE` (`tipo_prueba_alergia`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pruebas_alergia_tipos`
--

LOCK TABLES `pruebas_alergia_tipos` WRITE;
/*!40000 ALTER TABLE `pruebas_alergia_tipos` DISABLE KEYS */;
INSERT INTO `pruebas_alergia_tipos` VALUES (11,'otro estudio prueba de alergia hospitalización'),(10,'otro estudio prueba de alergia interconsulta'),(2,'Pruebas de alergia Epicutáneas'),(4,'Pruebas de alergia InmunoCap'),(3,'Pruebas de alergia PRICK'),(1,'Pruebas de parche');
/*!40000 ALTER TABLE `pruebas_alergia_tipos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-05 13:49:33

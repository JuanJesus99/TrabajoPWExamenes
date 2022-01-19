-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-01-2022 a las 15:48:10
-- Versión del servidor: 8.0.22
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examenes_online2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_grado` smallint NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `id_grado`, `nombre`) VALUES
('21714015', 1725, 'Diseño de algoritmos'),
('21714020', 1725, 'Programación concurrente y de tiempo real'),
('21714032', 1725, 'Arquitecturas de computadores paralelos y distribuidos'),
('21714056', 1725, 'Administración de servidores'),
('21714063', 1725, 'Programación web'),
('21716028', 1716, 'Mecánica de vuelo (aeronaves)'),
('21716031', 1716, 'Aeronaves');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_asignaturas`
--

CREATE TABLE `estudiantes_asignaturas` (
  `id_asignatura` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_estudiante` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estudiantes_asignaturas`
--

INSERT INTO `estudiantes_asignaturas` (`id_asignatura`, `id_estudiante`) VALUES
('21716031', 8),
('21714020', 9),
('21714020', 10),
('21714032', 9),
('21714015', 10),
('21714032', 8),
('21714032', 10),
('21714032', 11),
('21714032', 12),
('21714032', 14),
('21714032', 15),
('21714032', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `id_examen` smallint NOT NULL,
  `id_asignatura` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id_examen`, `id_asignatura`, `fecha_inicio`) VALUES
(1, '21714032', '2021-04-05'),
(2, '21714020', '2021-04-23'),
(3, '21714032', '2021-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_calificacion`
--

CREATE TABLE `examen_calificacion` (
  `id_examen` smallint NOT NULL,
  `id_estudiante` smallint NOT NULL,
  `nota` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examen_calificacion`
--

INSERT INTO `examen_calificacion` (`id_examen`, `id_estudiante`, `nota`) VALUES
(1, 9, 10),
(1, 16, 7.33333),
(1, 15, 7.33333),
(1, 14, 3.33333),
(1, 10, 6),
(3, 16, 3.33333);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_pregunta`
--

CREATE TABLE `examen_pregunta` (
  `id_examen` smallint NOT NULL,
  `id_pregunta` smallint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examen_pregunta`
--

INSERT INTO `examen_pregunta` (`id_examen`, `id_pregunta`) VALUES
(1, 5),
(1, 18),
(1, 15),
(1, 4),
(1, 9),
(1, 27),
(1, 33),
(1, 12),
(1, 17),
(1, 3),
(2, 1),
(3, 29),
(3, 20),
(3, 8),
(3, 3),
(3, 27),
(3, 28),
(3, 9),
(3, 18),
(3, 16),
(3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_respuesta`
--

CREATE TABLE `examen_respuesta` (
  `id_examen` smallint NOT NULL,
  `id_estudiante` smallint NOT NULL,
  `id_pregunta` smallint DEFAULT NULL,
  `respuesta_alumno` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examen_respuesta`
--

INSERT INTO `examen_respuesta` (`id_examen`, `id_estudiante`, `id_pregunta`, `respuesta_alumno`) VALUES
(1, 9, 5, '3'),
(1, 9, 18, '3'),
(1, 9, 15, '1'),
(1, 9, 4, '4'),
(1, 9, 9, '4'),
(1, 9, 27, '2'),
(1, 9, 33, '4'),
(1, 9, 12, '2'),
(1, 9, 17, '2'),
(1, 9, 3, '1'),
(1, 16, 5, '3'),
(1, 16, 18, '3'),
(1, 16, 15, '1'),
(1, 16, 4, '4'),
(1, 16, 9, '4'),
(1, 16, 27, '2'),
(1, 16, 33, '4'),
(1, 16, 12, '2'),
(1, 16, 17, '3'),
(1, 16, 3, '3'),
(1, 15, 5, '3'),
(1, 15, 18, '3'),
(1, 15, 15, '1'),
(1, 15, 4, '4'),
(1, 15, 9, '1'),
(1, 15, 27, '2'),
(1, 15, 33, '3'),
(1, 15, 12, '2'),
(1, 15, 17, '2'),
(1, 15, 3, '1'),
(1, 14, 5, '2'),
(1, 14, 18, '1'),
(1, 14, 15, '4'),
(1, 14, 4, '1'),
(1, 14, 9, '1'),
(1, 14, 27, '2'),
(1, 14, 33, '4'),
(1, 14, 12, '2'),
(1, 14, 17, '2'),
(1, 14, 3, '1'),
(1, 10, 5, '3'),
(1, 10, 18, '3'),
(1, 10, 15, '1'),
(1, 10, 4, '4'),
(1, 10, 9, '4'),
(1, 10, 27, '2'),
(1, 10, 33, '4'),
(1, 10, 12, '3'),
(1, 10, 17, '3'),
(1, 10, 3, '3'),
(3, 16, 29, '2'),
(3, 16, 20, '1'),
(3, 16, 8, '2'),
(3, 16, 3, '2'),
(3, 16, 27, '2'),
(3, 16, 28, '2'),
(3, 16, 9, '2'),
(3, 16, 18, '3'),
(3, 16, 16, '3'),
(3, 16, 4, '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` smallint NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `centro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `nombre`, `centro`) VALUES
(103, 'Medicina', 'Facultad de Medicina'),
(1716, 'Ingeniería Aeroespacial', 'Escuela Superior de Ingeniería'),
(1718, 'Ingeniería Eléctrica', 'Escuela Superior de Ingeniería'),
(1720, 'Ingeniería Mecánica', 'Escuela Superior de Ingeniería'),
(1725, 'Ingeniería Informática', 'Escuela Superior de Ingeniería'),
(2003, 'Enfermería', 'Facultad de Enfermería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` smallint NOT NULL,
  `id_tema` smallint NOT NULL DEFAULT '0',
  `id_asignatura` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `enunciado` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `opA` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `opB` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `opC` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `opD` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `correcta` smallint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `id_tema`, `id_asignatura`, `enunciado`, `opA`, `opB`, `opC`, `opD`, `correcta`) VALUES
(1, 9, '21714020', '¿Funciona bien el paralelismo en c++?', 'si', 'no', 'Depende de la versión', 'No responde', 1),
(2, 15, '21714032', 'Indica cual no es una limitación física de la computación paralela', 'Acotación del grado', 'Organización lógica del circuito', 'Velocidad de la luz', 'Espacio ocupado', 4),
(3, 15, '21714032', '¿Que técnica de Multithread usaría ante un fallo de cache?', 'Multithreading de grano grueso', 'Multithreading de grano fino', 'Simultaneous multithreading (SMT)', 'Chip Multi Processor(CMP)', 1),
(4, 15, '21714032', 'Cual de estos tipos de Procesadores Escalares es falso', 'Segmentados', 'Supersegmentados', 'Superescalar', 'Semisegmentados', 4),
(5, 15, '21714032', 'Cual no es una ventaja de usar Very Long Instruction Word (VLIW)', 'Menor consumo', 'Mejora la paralización', 'Disminuye la velocidad de reloj', 'El compilador planifica la ejecución', 3),
(6, 15, '21714032', 'Indique el orden de manera descendente de los distintos niveles de paralelismo', 'Hardware, software básico, software medio, software, aplicaciones', 'Aplicaciones, software básico, software medio, software, hardware', 'Aplicaciones, software, software medio, software básico, hardware', 'Hardware, software, software medio, software básico, aplicaciones', 3),
(7, 15, '21714032', 'Indica cuál de las siguientes expresiones NO es una correcta sobre VLIW (Very Long Instruction Word)', 'Difícil mantener la compatibilidad', 'Genera arquitecturas mas complejas con más lógica de control', 'La simplicidad permite incrementar la velocidad del reloj', 'Mejora la paralización', 2),
(8, 15, '21714032', '¿Qué forma básica del paralelismo corresponde con los sistemas MIMD?', 'ILP (Instruction Level Paralelism)', 'PLP (Process Level Paralelism)', 'TLP (Tread Level Paralelism)', 'DLP (Data Level Paralelism)', 2),
(9, 15, '21714032', '¿Cuál de las siguientes expresiones NO es correcta sobre la técnica multithread?', 'Los recursos que necesitan los distintos threads han de ser diferentes', 'Motivado para evitar los tiempos de espera al usar recursos mas lentos', 'Se mantienen ocupados los recursos del procesador aun con fallos de cache o de predicción de salto', 'Intenta generar varios procesadores físicos con un procesador lógico', 4),
(10, 15, '21714032', 'Queremos sumar dos enteros de 32 bit y nuestro procesador es de 16 bit, por lo tanto, la operación suma se realizaría en dos instrucciones, si queremos que se haga en una sola instrucción deberíamos utilizar:', 'Paralalismo a nivel de Instrucción', 'Paralalismo a nivel de Datos', 'Paralalismo a nivel de Bit', 'Paralalismo a nivel de Tarea', 3),
(11, 15, '21714032', 'Cuando utilizamos paralelismo a nivel de instrucción las instrucciones pueden agruparse', 'Siempre', 'Solo si no hay dependencia de datos entre ellas', 'Nunca', 'Solo si hay dependencia de datos entre ellas', 2),
(12, 15, '21714032', 'Si tenemos un procesador vectorial. ¿Qué técnica de paralelismo deberíamos utilizar?', 'Paralalismo a nivel de Instrucción.', 'Paralalismo a nivel de Datos.', 'Paralalismo a nivel de Bit.', 'Paralalismo a nivel de Tarea.', 2),
(13, 15, '21714032', 'Si tenemos un procesador multinúcleo y un sistema multiprocesador. ¿Qué técnica de paralelismo deberíamos utilizar?', 'Paralalismo a nivel de Instrucción.', 'Paralalismo a nivel de Datos.', 'Paralalismo a nivel de Bit.', 'Paralalismo a nivel de Procesos.', 4),
(14, 15, '21714032', 'El objetivo principal de la segmentación y réplica es:', 'Conseguir que un proceso se ejecute en varios procesadores para reducir su tiempo de ejecución.', 'Conseguir que un conjunto de procesos se ejecuten en paralelo en varios procesadores.', 'Conseguir que un conjunto de procesos se ejecuten en paralelo en un único procesador.', 'Conseguir que cada proceso tenga asignado un único procesador para evitar problemas de acceso a memoria.', 3),
(15, 15, '21714032', 'Dentro de las formas de paralelismo, un procesador superescalar se correspondería con:', 'ILP (Paralelismo a nivel de instrucción).', 'TLP (Paralelismo a nivel de tarea)', 'DLP (Paralelismo a nivel de datos).', 'PLP (Paralelismo a nivel de procesos)', 1),
(16, 15, '21714032', 'Indica cuál de las siguientes opciones no se corresponde con un nivel de paralelismo:', 'Nivel de Hardware.', 'Nivel de Software medio.', 'Nivel de Software alto.', 'Nivel de Aplicaciones.', 3),
(17, 15, '21714032', 'Indica cuál de las siguientes opciones no se corresponde con una limitación física de la computación paralela:', 'Acotación del grado.', 'Integración de más condensadores: miniaturización.', 'Velocidad de la luz.', 'Organización lógica del circuito.', 2),
(18, 19, '21714032', '¿Cuál no es un registro?', 'XMM', 'YMM', 'VMM', 'ZMM', 3),
(19, 19, '21714032', '¿Qué hace la instrucción ADDPS?', 'Suma dos valores escalares.', 'Suma dos vectores.', 'Resta 4 operandos de 64 bits.', 'Suma 4 operandos de 64 bits.', 2),
(20, 19, '21714032', '¿Cuál una característica de AVX2?', 'Implementa Gather y implementa Scatter.', 'Implementa Gather pero no implementa Scatter.', 'Implementa Scatter pero no implementa Gather.', 'No implementa Gather ni implementa Scatter.', 2),
(21, 19, '21714032', 'Las instrucciones AVX  ¿Qué fueron implementadas por Intel y/o AMD?', 'Intel.', 'Ninguna.', 'AMD.', 'Ambas.', 4),
(22, 19, '21714032', 'Indique cual de las siguientes afirmaciones es falsa sobre MMX', 'Permite hasta 4 operaciones simultaneas.', 'Orientado al uso de programas multimedia.', 'FPU y MMX comparten registros.', 'Solo trabaja con números enteros.', 3),
(23, 19, '21714032', 'Indique cual de las siguientes afirmaciones es falsa sobre 3DNow!', 'Inserta 57 instrucciones que permiten cálculos en coma flotante de precisión simple.', 'Orientado al procesamiento de vectores y juegos 3D.', 'Se declaró obsoleta en 2010.', 'La escasez de registros obliga a usar demasiado la memoria principal para pasos intermedios.', 1),
(24, 19, '21714032', 'Indique cual de las siguientes afirmaciones es falsa sobre AVX', 'Mejora la gestión de multi-hilos y multi-nucleos.', 'Introduce instrucciones destructivas.', 'Implementado por Intel y AMD.', 'La optimización la realizan los compiladores en vez de los programadores.', 2),
(25, 19, '21714032', '¿Que se incluyó con AVX2?', 'Implementa Gather pero no implementa Scatter.', 'Amplió el conjunto de instrucciones.', 'Hace que todas las instrucciones SSEse puedan ejecutar en AVX.', 'Añade el VL (Vector Length) y sus operaciones para tratar con él.', 4),
(26, 19, '21714032', '¿Cuál es la última actualización de instrucciones SSE?', 'La 4.', 'No hay actualizaciones de estas instrucciones.', 'La actualización 2020.', 'La actualización SSE-Reconocimiento_de_VoZ.', 1),
(27, 19, '21714032', '¿Cuál de estas es cierta respecto a las instrucciones AVX respecto a SSE?', 'No hay retrocompatibilidad, las SSE no se pueden ejecutar en AVX.', 'Amplía el conjunto de instrucciones.', 'Se reduce el conjunto de instrucciones.', 'AVX y SSE no tienen ninguna relación.', 2),
(28, 19, '21714032', '¿Cuál de estas es una instrucción AVX?', 'ADDSS.', 'ADDPS.', 'AVX_ADDPS_AVX.', 'VADDPD.', 4),
(29, 19, '21714032', '¿Cómo se usan en C/C++ las instrucciones SIMD?', 'No se pueden usar en esos lenguajes.', 'No hay que incluir nada, se incluyen de por sí en una librería built-in.', 'Añadiendo la librería immintrin.h.', 'Debes incluir la librería C_SIMD_Instructions.h.', 3),
(30, 19, '21714032', '¿Cual de estas afirmacioens es cierta sobre MMX?', 'FPU y MMX utilizan registros diferentes por lo que ambos se pueden usar a la vez.', 'MMX sustituye por completo a la FPU, ya que es una versión mejorada.', 'MMX trabaja tanto con números enteros como números de coma flotante.', 'Es necesario programar una versión para procesadores con MMX y otra para los que no lo tienen.', 4),
(31, 19, '21714032', '¿Hasta cuántas operaciones simultaneas puede llegar a hacer MMX?', '2.', '4.', '8.', '16.', 2),
(32, 19, '21714032', '¿Cual de los siguientes no es un tipo de datos SSE3?', 'Integer vector.', 'Integer scalar.', 'Floating point vector.', 'Floating point scalar.', 2),
(33, 19, '21714032', 'En que tipo de registros se basa 3DNow! ?', 'Registros FPU de 64 bits.', 'Registros FPU de 128 bits.', 'Registros SSE de 128 bits.', 'Registros MMX de 64 bits.', 4),
(36, 12, '21714020', 'Muy bien', 'Si', 'Solo con procesos', 'Solo con tareas', 'Siempre', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_asignatura`
--

CREATE TABLE `profesor_asignatura` (
  `id_asignatura` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_profesor` smallint NOT NULL,
  `coordinador` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesor_asignatura`
--

INSERT INTO `profesor_asignatura` (`id_asignatura`, `id_profesor`, `coordinador`) VALUES
('21716031', 1, 'SI'),
('21714020', 2, 'NO'),
('21714020', 3, 'SI'),
('21714032', 3, 'SI'),
('21714015', 3, 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id_tema` smallint NOT NULL,
  `id_asignatura` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id_tema`, `id_asignatura`, `nombre`) VALUES
(1, '21716028', 'Análisis de trayectorias (actuaciones)'),
(2, '21716028', 'Estabilidad estática y control'),
(3, '21716031', 'Diseño inicial'),
(4, '21716031', 'Diseño intermedio'),
(5, '21716031', 'Diseño final'),
(6, '21714063', 'Introducción'),
(7, '21714063', 'Frameworks para PHP'),
(8, '21714063', 'Frameworks de gestión de contenido'),
(9, '21714020', 'Principios elementales de la concurrencia'),
(10, '21714020', 'Creación y control de threads en java'),
(11, '21714020', 'Modelos teóricos de control de la concurrencia'),
(12, '21714020', 'Control de la concurrencia en java con api estándar'),
(13, '21714020', 'Control de la concurrencia en java con api de alto nivel'),
(14, '21714020', 'Creación y control de threads en java'),
(15, '21714032', 'Generalidades sobre Arquitecturas paralelas y distribuidas Parte 1'),
(16, '21714032', 'Generalidades sobre Arquitecturas paralelas y distribuidas Parte 2'),
(17, '21714032', 'Generalidades sobre Arquitecturas paralelas y distribuidas Parte 3'),
(18, '21714032', 'Paralelismo de datos. Procesadores Vectoriales'),
(19, '21714032', 'Paralelismo de datos. Extensiones Multimedia'),
(20, '21714032', 'Paralelismo de datos. GPUs'),
(21, '21714032', 'Coherencia'),
(22, '21714032', 'Sincronismo y consistencia'),
(23, '21714015', 'Algoritmos devoradores'),
(24, '21714015', 'Programación dinámica'),
(25, '21714015', 'Divide y Vencerás'),
(26, '21714015', 'Exploración en grafos'),
(27, '21714056', 'Administración básica de servidores'),
(28, '21714056', 'Redes'),
(29, '21714056', 'Servidores Web'),
(30, '21714056', 'Frameworks de administración y monitorización'),
(31, '21714056', 'Servicios adicionales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` smallint NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nombre_usuario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` blob,
  `rol` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `nombre_usuario`, `password`, `rol`) VALUES
(1, 'Antonio Pérez', 'u741258639', 0x31323334, 'profesor'),
(2, 'Pedro Ruíz', 'u793462856', 0x31323334, 'profesor'),
(3, 'Luis Corrales', 'u699784734', 0x31323334, 'profesor'),
(4, 'Sergio Gutiérrez', 'u756849321', 0x31323334, 'profesor'),
(5, 'María Ortega', 'u754968351', 0x31323334, 'profesor'),
(6, 'Ana Santos', 'u493569552', 0x31323334, 'profesor'),
(7, 'Dulce Acosta', 'u321564789', 0x31323334, 'profesor'),
(8, 'Javier García', 'u456987159', 0x31323334, 'estudiante'),
(9, 'Rafael Martínez', 'u357456963', 0x31323334, 'estudiante'),
(10, 'Laura Butrón', 'u124365852', 0x31323334, 'estudiante'),
(11, 'Natalia García', 'u478569365', 0x31323334, 'estudiante'),
(12, 'Pedro Segura', 'u124547741', 0x31323334, 'estudiante'),
(13, 'Pablo Pérez', 'u123369987', 0x31323334, 'estudiante'),
(14, 'Jesus Butrón', 'u485589985', 0x31323334, 'estudiante'),
(15, 'María Guerra', 'u654987412', 0x31323334, 'estudiante'),
(16, 'Julio Parra', 'u478569874', 0x31323334, 'estudiante'),
(17, 'Alberto Pérez', 'u123652367', 0x31323334, 'estudiante'),
(18, 'Martín Gómez', 'admin', 0x31323334, 'administrador'),
(19, 'Juan Jesus Zamorano butron', 'u45654562', 0x31323334, 'estudiante');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `estudiantes_asignaturas`
--
ALTER TABLE `estudiantes_asignaturas`
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id_examen`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `examen_calificacion`
--
ALTER TABLE `examen_calificacion`
  ADD KEY `id_examen` (`id_examen`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `examen_pregunta`
--
ALTER TABLE `examen_pregunta`
  ADD KEY `id_examen` (`id_examen`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `examen_respuesta`
--
ALTER TABLE `examen_respuesta`
  ADD KEY `id_examen` (`id_examen`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `profesor_asignatura`
--
ALTER TABLE `profesor_asignatura`
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `id_examen` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`);

--
-- Filtros para la tabla `estudiantes_asignaturas`
--
ALTER TABLE `estudiantes_asignaturas`
  ADD CONSTRAINT `estudiantes_asignaturas_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `estudiantes_asignaturas_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD CONSTRAINT `examenes_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);

--
-- Filtros para la tabla `examen_calificacion`
--
ALTER TABLE `examen_calificacion`
  ADD CONSTRAINT `examen_calificacion_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examenes` (`id_examen`),
  ADD CONSTRAINT `examen_calificacion_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes_asignaturas` (`id_estudiante`);

--
-- Filtros para la tabla `examen_pregunta`
--
ALTER TABLE `examen_pregunta`
  ADD CONSTRAINT `examen_pregunta_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examenes` (`id_examen`),
  ADD CONSTRAINT `examen_pregunta_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`);

--
-- Filtros para la tabla `examen_respuesta`
--
ALTER TABLE `examen_respuesta`
  ADD CONSTRAINT `examen_respuesta_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examenes` (`id_examen`),
  ADD CONSTRAINT `examen_respuesta_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes_asignaturas` (`id_estudiante`),
  ADD CONSTRAINT `examen_respuesta_ibfk_3` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `preguntas_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id_tema`);

--
-- Filtros para la tabla `profesor_asignatura`
--
ALTER TABLE `profesor_asignatura`
  ADD CONSTRAINT `profesor_asignatura_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `profesor_asignatura_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

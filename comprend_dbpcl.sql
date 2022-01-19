-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-01-2022 a las 20:56:13
-- Versión del servidor: 10.3.32-MariaDB-cll-lve
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comprend_dbpcl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `p_soles` decimal(5,2) NOT NULL,
  `p_dolares` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `p_soles`, `p_dolares`) VALUES
(1, 9.00, 2.31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `palabra_id` int(11) NOT NULL,
  `aprendida` enum('leida','conocida') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `usuario_id`, `palabra_id`, `aprendida`) VALUES
(1, 3, 21, 'conocida'),
(2, 3, 56, 'conocida'),
(3, 3, 57, 'conocida'),
(4, 3, 108, 'conocida'),
(5, 3, 101, 'conocida'),
(6, 3, 165, 'conocida'),
(7, 3, 99, 'conocida'),
(8, 3, 144, 'conocida'),
(9, 3, 158, 'conocida'),
(10, 3, 161, 'conocida'),
(11, 3, 79, 'conocida'),
(12, 3, 88, 'conocida'),
(13, 3, 157, 'conocida'),
(14, 3, 184, 'conocida'),
(15, 3, 16, 'conocida'),
(16, 3, 34, 'conocida'),
(17, 3, 87, 'conocida'),
(18, 3, 98, 'conocida'),
(19, 3, 123, 'conocida'),
(20, 3, 135, 'conocida'),
(21, 3, 139, 'conocida'),
(22, 3, 141, 'conocida'),
(23, 3, 162, 'conocida'),
(24, 3, 168, 'conocida'),
(25, 3, 189, 'conocida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabra`
--

CREATE TABLE `palabra` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `significado` longtext NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `palabra`
--

INSERT INTO `palabra` (`id`, `nombre`, `significado`, `estado`) VALUES
(1, 'a', 'Primera letra del abecedario español. Vocal fuerte o abierta. Preposición.', 1),
(2, 'a-', 'part. insep. que denota Privación o negación: acromático, ateismo.', 1),
(3, 'abad, abadesa.', 'm y f. El que dirige una abadía o monasterio.', 1),
(4, 'abajo.', 'adv. En lugar o Parte inferior.', 1),
(5, 'abalanzar.', 'tr. Pesar en la balanza. , Impulsar, inclinar hacia', 1),
(6, 'adelante.', 'Como pronominal: Lanzarse. arrojarse en dirección de algo.', 1),
(7, 'abalorio.', 'm. Piedrecillas de vidrio con que se hacen adornos.', 1),
(8, 'abanderado, da.', 'm. y f. El que lleva la bandera.', 1),
(9, 'Abandonar', 'tr. Dejar, desamparar a una persona o cosa. Dejar un trebejo emprendido.', 1),
(10, 'abanico.', 'm. Utensilio para hacer o hacerse aire.', 1),
(11, 'abaratar.', 'tr. Bajar el precio de algo.', 1),
(12, 'abarcar.', 'Ir. Rodear con los brazos o las manos. Rodear, Alcanzar con la vista. Tomar o hacer varias cosas al mismo tiempo. Amer. Acaparar.', 1),
(13, 'abarrotar.', 'tr Fortalecer con barrotes una cosa. Llenar de personas o cosas un espacio. Cargar mucho un buque. Abastecer.', 1),
(14, 'abasto.', 'm. Provisión de lo necesario, especialmente víveres.', 1),
(15, 'abatatarse.', 'Amer. Avergonzarse, confundirse.', 1),
(16, 'abati.', 'm. Voz de origen guaraní. Maíz. Aguardiente de maíz.', 1),
(17, 'abatimiento.', 'm. Postración física o moral de una Persona.', 1),
(18, 'abatir.', 'tr Derribar. Echar por tierra. Perder el ánimo.', 1),
(19, 'abdicar.', 'tr. Renunciar al gobierno de un pueblo. Renunciar a un Cargo.', 1),
(20, 'abdomen.', 'm Vientre, cavidad del Cuerpo que Contiene diversos órganos.', 1),
(21, 'abecé.', 'm Abecedario..Serie de letras que forman el alfabeto. Lista en orden alfabético. fig. Rudimentos o principios de un conocimiento.', 1),
(22, 'abeja.', 'f. insecto himenóptero que vive en colmenas y produce miel y cera. fig. Persona muy trabajadora, laboriosa.', 1),
(23, 'abejorro.', 'm Insecto himenóptero de dos o tres centímetros de largo, con la trompa casi del mismo tamaño que el cuerpo. Zumba mucho al volar. Vive en enjambres.', 1),
(24, 'aberración.', 'f.. Extravío. Error muy grande. Biol. Desviación del tipo normal de un ser vivo.', 1),
(25, 'abertura.', 'f. Acción de abrir o abrirse. Roca. grieta, agujero.', 1),
(26, 'abicharse.', 'prnl. Agusanarse.', 1),
(27, 'abierto, ta.', 'participio pasado irreg. de abrir. adj. Liso. Llano. fig. Franco, dadivoso. Sincero.', 1),
(28, 'abigarrado, da.', 'P. P. de abigarrar. adj. De varios colores mal combinados. Dícese de cosas reunidas sin buen orden.', 1),
(29, 'abisagrar.', 'tr. Colocar bisagras.', 1),
(30, 'abismar.', 'tr. Hundir en un abismo. ú. t. c. prnl. Confundir.', 1),
(31, 'abatir.', 'Entregarse a la contemplación', 1),
(32, 'abismo.', 'm. Precipicio, algo muy profundo. Infierno. Cosa inmensa e incomprensible.', 1),
(33, 'abjurar.', 'tr Renunciar a una opinión o creencia. Desdecirse con juramento.', 1),
(34, 'ablación.', 'f. En cirugía cortar o sacar una parte del cuerpo.', 1),
(35, 'ablandamiento.', 'm. Acción y efecto de ablandar o ablandarse.', 1),
(36, 'ablandar.', 'tr. Poner blanda una cosa. ú. t. c. prnl. Aflojar, suavizar. fig. Mitigar el enojo de alguno.', 1),
(37, 'ablución.', 'f. Lavatorio. Acto de purificarse por medio del agua. Ceremonia de purificar el cáliz y lavarse las manos el sacerdote en la misa después de consumir el cuerpo (hostia) y la sangre (vino) de Jesús.', 1),
(38, 'abnegación.', 'f. Sacrificio voluntario en servicio de Dios o en bien del prójimo.', 1),
(39, 'abocar.', 'tr. Asir con la boca. Sumarse varias personas en encarar un negocio o tarea.', 1),
(40, 'abochornar.', 'tr. Causar molestias por excesivo calor. fig. Sonrojarse.', 1),
(41, 'abofetear.', 'tr. Dar bofetadas.', 1),
(42, 'abogacía.', 'Profesión y ejercicio del abogado.', 1),
(43, 'abogado-da.', 'm. y f. Persona legalmente autorizada para defender en Juicio los derechos e interesas de los litigantes. Intercesor.', 1),
(44, 'abogar.', 'intr. Defender en juicio. Hablar en favor de otro.', 1),
(45, 'abolengo.', 'm .Ascendencia de abuelos u antepasados.', 1),
(46, 'abolicionista.', 'Adj. Se dice del que quiere dejar sin efecto un precepto o costumbre. Aplícase especialmente a los partidarios de la abolición de la esclavitud.', 1),
(47, 'abolir.', 'tr.(Verbo defectivo) Suprimir. derogar, dejar sin vigor una costumbre.', 1),
(48, 'abollar.', 'Ir Hacer una depresión con un golpe. Adornar con bollos o relieves.', 1),
(49, 'abombar.', 'tr Dar forma convexa. Aturdir, Amér del Sur y Méx. Abombarse significa empezar a corromperse algo.', 1),
(50, 'abominable.', 'adj. Algo muy malo.', 1),
(51, 'abominar.', 'tr. Condenar personas o cosas por ser muy malas. Tener odio. Aborrecer.', 1),
(52, 'abonado, da.', 'p. p. de abonar. m. y f. Persona suscripta para recibir un servicio.', 1),
(53, 'abonar.', 'tr. Pagar. Echar abonos en la tierra. Dar por buena. Hacer buena alguna cosa.', 1),
(54, 'abono.', 'm Acción y efecto de abonar o abonarse. Fianza, garantía. Sustancia con que se abona la tierra. Derecho que se adquiere.', 1),
(55, 'abordar.', 'tr llevar una embarcación con otra. Atracar una nave a un muelle. Acercarse a alguien para tratar un asunto. Emprender algo.', 1),
(56, 'aborigen.', 'adj. y sust. Originario del país donde vive.', 1),
(57, 'aborrascarse.', 'prnl. Ponerse el tiempo borrascoso.', 1),
(58, 'aborrecer.', 'tr. Odiar.', 1),
(59, 'aborrecible.', 'adj. Digno de ser aborrecido.', 1),
(60, 'abortar .', 'Parir antes de tiempo en que el feto pueda vivir. Fracasar.', 1),
(61, 'abotagarse.', 'Prnl. Hincharse el cuerpo o parle del cuerpo por enfermedad.', 1),
(62, 'abotinado, da.', 'adj. Hecho en forma de botín.', 1),
(63, 'abotonador', 'm Instrumento de metal usado para introducir el botón en el ojal.', 1),
(64, 'abovedado, da.', 'p. p. de abovedar. adj. Corvo.', 1),
(65, 'abra.', 'Bahía no muy extensa. Abertura ancha entre dos montañas. Amér Espacio desmontado, claro en un bosque.', 1),
(66, 'abracadabra.', 'm Palabra usada en magia. a la que se atribuía el poder de Curar.', 1),
(67, 'abrasar.', 'tr. Reducir a brasas. Quemar. Destruir, consumir, avergonzar. Sentir vivamente amor, ira, ambición.', 1),
(68, 'abrasivo, va.', 'Producto que sirve para desgastar.', 1),
(69, 'abrazadera.', 'f. Pieza que sirve para asegurar alguna cosa.', 1),
(70, 'abrazar.', 'tr. Ceñir con los brazos. Estrechar entre los brazos en señal de cariño. . Comprender, contener. Aceptar una idea.', 1),
(71, 'abrazo.', 'm. Acción y efecto de estrechar entre los brazos.', 1),
(72, 'abrevadero.', 'm Bebedero para el ganado.', 1),
(73, 'abrevar.', 'Ir. Dar de beber al ganado.', 1),
(74, 'abreviar.', 'tr. Reducir, disminuir. acortar. Acelerar apresurar.', 1),
(75, 'abreviatura.', 'Representación de las palabras con una o varias de sus letras. Compendio o resumen.', 1),
(76, 'abriboca.', 'adj. Arg. Distraído.', 1),
(77, 'abridor, ra.', 'adl. Que abre. Instrumento para destapar botellas.', 1),
(78, 'abrigar', 'tr. Defender del frío. Auxiliar amparar.', 1),
(79, 'abrigo.', 'm. Lo que resguarda del frío. Prenda de vestir de invierno. Sitio que protege de los vientos.', 1),
(80, 'abril.', 'm. Cuarto mes del año.', 1),
(81, 'abrillantar.', 'fr. Dar brillo. Dar más valor.', 1),
(82, 'abrir.', 'tr Descubrir lo que está cerrado. Separar del marco la hoja de una puerta. Rasgar, dividir.', 1),
(83, 'abrochar.', 'fr Cerrar. unir con broches.', 1),
(84, 'abrogar', 'tr. Abolir una Ley.', 1),
(85, 'abrojo.', 'm. Planta y Fruto esférico armado de púas. Es de tallos largos y rastreros y perjudicial para los sembrados.', 1),
(86, 'abroquelar.', 'tr. Escudar. resguardar, defender.', 1),
(87, 'abrumar', 'tr Agobiar con un grave peso. Causar gran molestia. Causar empacho por exceso de atenciones, halagos, burlas.', 1),
(88, 'abrupto, ta.', 'adj. Escarpado, que tiene gran pendiente.', 1),
(89, 'absceso.', 'm. Acumulación de pus en los tejidos.', 1),
(90, 'ábside.', 'amb. Parte del templo donde está el altar.', 1),
(91, 'absolución.', 'f. Perdón. Acción de absolver. Terminación del pleito a favor del demandado.', 1),
(92, 'absoluto, ta.', 'adj. Sin limite. Sin ninguna relación. Independiente. sin restricción alguna.', 1),
(93, 'absolutorio, ria.', 'adj. Dícese del fallo o sentencia que absuelve.', 1),
(94, 'absolver.', 'tr. Perdonar.', 1),
(95, 'absorber.', 'tr. Embeber. Retener un cuerpo las moléculas de líquido o gas con que se encuentra en contacto. Consumir del todo.', 1),
(96, 'absorto, ta.', 'p. p. de absorber. adj. Admirado. preocupado.', 1),
(97, 'abstemio, a.', 'adi. Que no bebe vino ni licores.', 1),
(98, 'abstener.', 'tr. Contener. apartar. int. prnl. Privarse de algo.', 1),
(99, 'abstinencia.', 'f Acción da abstenerse. ; Privarse de algo voluntariamente.', 1),
(100, 'abstracción.', 't. Acción y efecto de abstraerse', 1),
(101, 'abstracta.', 'adj. Que significa alguna cualidad con exclusión del sujeto.', 1),
(102, 'abstraer.', 'tr. Considerar algo separado del objeto. Ensimismarse.', 1),
(103, 'absuelto, ta.', 'p. p. irreg. de absolver. Perdonado.', 1),
(104, 'absurdo, da.', 'adj.. opuesto a la razón.', 1),
(105, 'abuchear', 'tr Silbar, desaprobar con murmullos y ruidos.', 1),
(106, 'abuela.', 'f. Respecto de una persona, madre de su Padre o', 1),
(107, 'madre.', 'fig. Mujer anciana.', 1),
(108, 'abuelazón.', 'f. Pan. Condición anímica de los abuelos que chochean por su nieto.', 1),
(109, 'abuelo.', 'm. Respecto de una persona. el padre de su madre o de su Padre Ascendiente. Antepasado. Hombre anciano.', 1),
(110, 'abulencia.', 'f. R. Dom. Falsedad, invención, especulación.', 1),
(111, 'abulia.', 'f. Falla de voluntad o disminución de la energía.', 1),
(112, 'abultar.', 'tr Aumentar el bulto de alguna cosa., Aumentar la cantidad, intensidad, grado de alguna cosa.', 1),
(113, 'abundancia.', 'f. Gran cantidad.', 1),
(114, 'abundar', 'intr. Tener en abundancia. Hablando de una idea, seguir dando muchos detalles de ella.', 1),
(115, 'aburguesarse.', 'Adquirir cualidades de burgués.', 1),
(116, 'aburrrimiento.', 'm. Cansancio, fastidio, tedio originados generalmente por disgustos o molestias.', 1),
(117, 'aburrir.', 'Ir. Molestar, cansar, fastidiar. Prnl. Cansarse de alguna cosa.', 1),
(118, 'abusar.', 'intr Usar mal. excesiva, injusta, impropia o indebidamente de algo o de alguien. Tratar deshonestamente a una persona de menor experiencia, fuerza y poder.', 1),
(119, 'abyección.', 'f. Bajeza, envilecimiento. Humillación.', 1),
(120, 'abyecto.', 'adj. Malo, vil. Humillado.', 1),
(121, 'acá.', 'adv. indica un lugar menos determinado que aquí. Admite ciertos grados de comparación, que no puede usarse con el adverbio aquí:', 1),
(122, 'acabado, da.', 'participio de acabar adj. Terminado, consumado.', 1),
(123, 'acabar', 'tr Terminar algo. Concluir. , Apurar, consumir. Matar. Finalizar', 1),
(124, 'acacia.', 'f. Árbol o arbusto de la familia de las mimosáceas de madera bastante dura, hojas compuestas, flores olorosas, en racimo, y fruto en legumbre. De algunas especies fluye la goma arábiga.', 1),
(125, 'academia.', 'f. Sociedad científica. literaria o artística integrada por personas de saber.', 1),
(126, 'académico, ca.', 'adj. Perteneciente o relativo a las academias. Característico de ellas.', 1),
(127, 'acaecer.', 'intr. Suceder algo. Efectuarse un hecho.', 1),
(128, 'acalamhrarse.', 'pml. Contraerse los músculos por un calambre.', 1),
(129, 'acalorar.', 'tr. Dar calor Encender. Fatigar. Enardecerse en la conversación.', 1),
(130, 'acallar.', 'tr Hacer callar. Aplacar. Sosegar.', 1),
(131, 'acampanar .', 'tr. Dar a una cosa forma de campana.', 1),
(132, 'acampar.', 'intr. Instalarse en un lugar descampado, valiéndose o no de carpa.', 1),
(133, 'acanalar.', 'tr. Hacer canales. Dar a una cosa forma de canal.', 1),
(134, 'acantilado.', 'm. Costa cortada verticalmente. Se dice del fondo del mar cuando forma escalones', 1),
(135, 'acantonar.', 'tr Distribuir y alojar tropas en diversos poblados.', 1),
(136, 'acaparar.', 'tr. Adquirir y retener la mayor cantidad posible de cosas.', 1),
(137, 'acaracolado, da.', 'adj. De figura de caracol.', 1),
(138, 'acaramelar', 'tr. Bañar con azúcar en punto de caramelo. fig. muy dulce, obsequioso y galante.', 1),
(139, 'acariciar', 'tr Hacer caricias. Tocar suavemente una cosa. Complacerse en pensar algo esperando conseguirlo.', 1),
(140, 'acarrear.', 'Ir. Transportar en carro, y también por otros medios. Ocasionar daños. Producir desgracias.', 1),
(141, 'acartonarse.', 'prnl. Ponerse como cartón.', 1),
(142, 'acaso.', 'rn. Casualidad, suceso imprevisto.', 1),
(143, 'acaudillar.', 'tr Mandar como caudillo.', 1),
(144, 'acceder.', 'tr. Consentir en lo que se pide.', 1),
(145, 'accésit.', 'm. Recompensa inferior inmediata al premio.', 1),
(146, 'acceso.', 'm. Acción de llegar o acercarse. Entrada o paso. Arrebato o exaltación.', 1),
(147, 'accesorio, a.', 'adj. Secundario, que depende de lo principal.', 1),
(148, 'accidentado, da.', 'p. p. de accidentar. adj. Turbado. Agitado. Terreno escabroso.', 1),
(149, 'accidental.', 'adj. No esencial. Casual.', 1),
(150, 'accidente.', 'm Suceso inesperado. Irregularidad que aparece en una cosa sin que sea parte de ella. Suceso o acción de la que resulta daño para una persona. En Geografía, irregularidad del terreno con elevaciones o depresiones bruscas. En Gram. modificación que sufre el nombre, articulo, adjetivo y ciertos pronombres para :indicar género y ninguno, y los verbos para denotar tiempos, modos, números y personas.', 1),
(151, 'acción.', 'Electo de hacer. Postura, ademán.', 1),
(152, 'accionar.', 'tr. Poner en funcionamiento un mecanismo dar movimiento. Hacer movimientos al hablar.', 1),
(153, 'accionista.', 'El que posee acciones de una compañía.', 1),
(154, 'acechanza.', 'f. Espionaje. Persecución cautelosa.', 1),
(155, 'acechar.', 'tr. Observar cautelosamente.', 1),
(156, 'acéfalo, a.', 'adj. Falto de cabeza.', 1),
(157, 'aceite.', 'm. Grasa líquida que se obtiene del olivo y otras semillas, frutos o animales.', 1),
(158, 'aceituna.', 'f. Fruto del olivo.,del que se extrae aceite comestible.', 1),
(159, 'acelerador', 'm. Mecanismo que permite dar más velocidad al motor.', 1),
(160, 'Acelerar', 'tr Dar celeridad. Dar mayor velocidad, aumentarla.', 1),
(161, 'acelga.', 'f. Hortaliza de hojas comestibles.', 1),
(162, 'acendrado, da.', 'adj. Puro, sin mancha.', 1),
(163, 'acendrar ', 'tr. Depurar. Purificar.', 1),
(164, 'acento.', 'm. Mayor intensidad al pronunciar una sílaba. Modulación dc la voz.', 1),
(165, 'acentuar.', 'tr Poner acento. Realzar.', 1),
(166, 'aceptar.', 'tr. Recibir voluntariamente lo que se da. Aprobar.', 1),
(167, 'acequia.', 'f. Zanja por donde van las aguas.', 1),
(168, 'acera.', 'f. Parte de la calle destinada al tránsito de peatones.', 1),
(169, 'acerado, da.', 'adj. De acero. Fuerte. Penetrante.', 1),
(170, 'acerbo, ba.', 'adj. Áspero al gusto.', 1),
(171, 'acerca.', 'adv. Cerca. Modo adv. Acerca de: Sobre lo que se trata.', 1),
(172, 'acercar.', 'tr. Poner cerca o a menor distancia o tiempo.', 1),
(173, 'acero.', 'm Hierro aleado con otros elementos químicos a altas temperaturas. Arma blanca, espada. fig. Animo, brío.', 1),
(174, 'acérrimo, ma.', 'ad:. superlativo de acre. Muy agrio. Vigoroso. Tenaz.', 1),
(175, 'acertar.', 'tr Dar en el punto deseado. Adivinar. Encontrar.', 1),
(176, 'acertijo.', 'm Enigma, para entretenerse en acertar. Cosa o afirmación problemática.', 1),
(177, 'acervo.', 'm. Montón de cosas menudas. Haber que pertenece a varias personas. Conjunto de cosas morales o materiales', 1),
(178, 'acumulados.', 'Tradición o herencia.', 1),
(179, 'acético, ca.', 'adj. Perteneciente al vinagre.', 1),
(180, 'acetileno.', 'm. Gas usado para el alumbrado, soldaduras, etc.', 1),
(181, 'acetona.', 'f. Liquido empleado como disolvente de grasas, resinas, etc', 1),
(182, 'aciago, ga.', 'adj. infausto, infeliz.', 1),
(183, 'acíbar.', 'm. Aloe, planta y su jugo. fig. Amargura, disgusto.', 1),
(184, 'acicalar', 'tr. Limpiar. Alisar. Pulir. Adornar.', 1),
(185, 'acicate.', 'm Espuela.', 1),
(186, 'ácido, da.', 'adj. Que tiene sabor agrio. Áspero. En Química cualquiera de las sustancias que pueden formar sales al combinarse con óxido. Suelen tener sabor agrio y enrojecer la tintura de tornasol.', 1),
(187, 'acierto.', 'm. Acción de acertar. . Habilidad. Cordura.', 1),
(188, 'acimut.', 'm Azimut Astronomía, ángulo que con el meridiano forma el círculo vertical que pasa por un punto de la esfera terrestre o del globo terráqueo.', 1),
(189, 'aclamar.', 'tr Dar voces la multitud en honor de alguien.', 1),
(190, 'aclarar.', 'tr. Disipar, volver claro. Aumentar el espacio entre alguna cosa. Esclarecer. Amanecer.', 1),
(191, 'aclimatar.', 'tr. Acostumbrar un ser a otro clima.', 1),
(192, 'acné.', 'f. Enfermedad de la piel caracterizada por inflamación de las glándulas sebáceas, especialmente en la cara.', 1),
(193, 'acobardar.', 'tr. Amedrentar. Causar miedo.', 1),
(194, 'acodar.', 'tr. Apoyar el codo.', 1),
(195, 'acoger.', 'tr. Admitir. Aceptar.', 1),
(196, 'acogida.', 'f. Recibimiento. Hospitalidad.', 1),
(197, 'acogotar.', 'tr. Matar con herida en el cogote. Descogotar.', 1),
(198, 'acolchar.', 'tr. Coser dos telas poniendo entre ellas algodón, lana. guata, plumas u otro material.', 1),
(199, 'acólito.', 'm. Ministro de la iglesia que sirve en el altar. Monaguillo. Satélite, persona o cosa que depende de otra.', 1),
(200, 'acollarar.', 'tr. Poner collar a un animal.', 1),
(201, 'acometer.', 'tr. Embestir con ímpetu. Emprender. Intentar.', 1),
(202, 'acomodado.', 'adj. Conveniente, oportuno. Rico. Moderado en el precio.', 1),
(203, 'acomodar', 'tr. Colocar una cosa de modo que se ajuste a otra.', 1),
(204, 'acomodo.', 'm. Empleo, ocupación o conveniencia.', 1),
(205, 'acompañamiento.', 'm. Séquito. Música que acompaña la voz o melodía.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellido_paterno` varchar(30) NOT NULL,
  `apellido_materno` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` enum('masculino','femenino','otro') NOT NULL DEFAULT 'otro',
  `pais` varchar(80) DEFAULT NULL,
  `numero_documento` char(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `celular` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombres`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `genero`, `pais`, `numero_documento`, `direccion`, `email`, `celular`) VALUES
(1, 'Eduardo Salvador', 'Correa', 'Rojas', '1996-05-01', 'masculino', NULL, NULL, NULL, 'edsacor@yahoo.com', '961969312'),
(2, 'Anthony', 'Mosquera', 'Sandoval', '1996-05-01', 'otro', NULL, NULL, NULL, 'anthonysandoval1596@gmail.com', '924172500'),
(3, 'ALEJANDRO PEDRO JOSÉ', 'BOCANEGRA', 'ALZA', '1983-09-28', 'otro', NULL, NULL, NULL, 'alejandrobocanegraalza@gmail.com', '984293404'),
(4, 'Eduardo Salvador', 'Correa', 'Rojas', '1961-06-25', 'otro', NULL, NULL, NULL, 'edsacor@hotmail.com', '961969312');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Usuario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `sesion` int(11) NOT NULL,
  `linea` int(11) NOT NULL,
  `letra` int(1) NOT NULL,
  `terminado` tinyint(1) NOT NULL DEFAULT 0,
  `asignado` tinyint(1) NOT NULL DEFAULT 0,
  `parte` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `usuario_id`, `sesion`, `linea`, `letra`, `terminado`, `asignado`, `parte`) VALUES
(1, 1, 1, 1, 1, 0, 1, 1),
(2, 2, 1, 1, 1, 0, 1, 1),
(3, 3, 1, 6, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE `temporal` (
  `sesion_id` int(11) NOT NULL,
  `palabra_id` int(11) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `temporal`
--

INSERT INTO `temporal` (`sesion_id`, `palabra_id`, `checked`) VALUES
(1, 6, 0),
(1, 11, 0),
(1, 23, 0),
(1, 43, 0),
(1, 46, 0),
(1, 47, 0),
(1, 49, 0),
(1, 54, 0),
(1, 56, 0),
(1, 60, 0),
(1, 68, 0),
(1, 70, 0),
(1, 81, 0),
(1, 94, 0),
(1, 99, 0),
(1, 104, 0),
(1, 106, 0),
(1, 110, 0),
(1, 118, 0),
(1, 119, 0),
(1, 120, 0),
(1, 128, 0),
(1, 129, 0),
(1, 130, 0),
(1, 131, 0),
(1, 133, 0),
(1, 136, 0),
(1, 138, 0),
(1, 139, 0),
(1, 143, 0),
(1, 145, 0),
(1, 155, 0),
(1, 160, 0),
(1, 161, 0),
(1, 171, 0),
(1, 172, 0),
(1, 174, 0),
(1, 193, 0),
(1, 195, 0),
(2, 3, 0),
(2, 21, 0),
(2, 30, 0),
(2, 32, 0),
(2, 37, 0),
(2, 44, 0),
(2, 58, 0),
(2, 61, 0),
(2, 66, 0),
(2, 67, 0),
(2, 80, 0),
(2, 113, 0),
(2, 120, 0),
(2, 140, 0),
(2, 145, 0),
(2, 151, 0),
(2, 158, 0),
(2, 179, 0),
(2, 180, 0),
(2, 181, 0),
(3, 27, 0),
(3, 32, 0),
(3, 44, 0),
(3, 46, 0),
(3, 52, 0),
(3, 63, 0),
(3, 67, 0),
(3, 69, 0),
(3, 75, 0),
(3, 78, 0),
(3, 90, 0),
(3, 103, 0),
(3, 112, 0),
(3, 133, 0),
(3, 143, 0),
(3, 155, 0),
(3, 173, 0),
(3, 192, 0),
(3, 193, 0),
(3, 202, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'avatar.png',
  `persona_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL DEFAULT 2,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `avatar`, `persona_id`, `rol_id`, `estado`, `created`) VALUES
(1, 'admin', '$2y$10$.LIGIkbWbXEbwIRa4ffOq.lGIgto8vWHeiBjdcDKkgFKfVoOnAZSi', 'avatar.png', 1, 1, 1, '2021-06-20'),
(2, 'amosqueras', '$2y$10$.LIGIkbWbXEbwIRa4ffOq.lGIgto8vWHeiBjdcDKkgFKfVoOnAZSi', 'avatar.png', 2, 2, 1, '2021-07-17'),
(3, 'abocanegraa', '$2y$10$Rwi4pf53C18xMt6P0PRYpuOst3gXPRVye./oDrRyX/6n/WZc.7S46', 'avatar.png', 3, 2, 1, '2021-08-07'),
(4, 'ecorrear', '$2a$12$AGFEAzuu8SgFetjHe51JfuuBJoIO.Ot9HIvsQFQKRLmuERKIOjamu', 'avatar.png', 4, 2, 1, '2021-10-02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`palabra_id`) USING BTREE,
  ADD KEY `palabra_id` (`palabra_id`);

--
-- Indices de la tabla `palabra`
--
ALTER TABLE `palabra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD UNIQUE KEY `sesion_id` (`sesion_id`,`palabra_id`),
  ADD KEY `palabra_id` (`palabra_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `persona_id` (`persona_id`,`rol_id`) USING BTREE,
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `palabra`
--
ALTER TABLE `palabra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`palabra_id`) REFERENCES `palabra` (`id`);

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `sesion_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD CONSTRAINT `temporal_ibfk_1` FOREIGN KEY (`palabra_id`) REFERENCES `palabra` (`id`),
  ADD CONSTRAINT `temporal_ibfk_2` FOREIGN KEY (`sesion_id`) REFERENCES `sesion` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

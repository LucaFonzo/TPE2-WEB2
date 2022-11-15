-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 12:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id_gender` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id_gender`, `name`, `stars`) VALUES
(1, 'editado', 0),
(3, 'Ficcion', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `premiere_date` varchar(50) NOT NULL,
  `id_gender_fk` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `description`, `author`, `premiere_date`, `id_gender_fk`, `image`) VALUES
(10, 'editada', 'editadoDevuelta', 'Joseph Kosinski', '05/26/2022', 1, ''),
(12, 'Spider-Man: Sin camino a casa', '    \r\n    Peter Parker es desenmascarado y ya no puede separar su vida normal de los altos riesgos de ser un súper héroe. Cuando pide ayuda al Doctor Strange para recuperar su secreto, el hechizo crea un agujero en su mundo, liberando a los villanos más poderosos que han luchado con cualquier Spider-Man, en cualquier universo. Ahora Peter debe de superar su reto más grande, que no solo alterara su propio futuro pero el del multiverso, forzándolo a descubrir lo que realmente significa ser Spider-Man.', 'Jon Watts', '15/12/2021', 1, ''),
(13, 'Avengers: Infinity War', '    \r\n    Los Vengadores y sus aliados deben estar dispuestos a sacrificarlo todo para intentar derrotar al poderoso Thanos antes de que su ataque de devastación y ruina ponga fin al universo.', 'Anthony Russo', '27/04/2018', 1, ''),
(14, 'La Liga de la Justicia de Zack Snyder ', '    Decidido a asegurarse de que el sacrificio final de Superman no fue en vano, Bruce Wayne alinea fuerzas con Diana Prince con planes para reclutar un equipo de metahumanos para proteger al mundo de una amenaza de proporciones catastróficas que se aproxima.\r\n    ', 'Zack Snyder', '18/03/2021', 1, ''),
(15, 'Avengers: Endgame ', '    Después de los devastadores eventos de los Vengadores: Infinity War (2018), el universo está en ruinas. Con la ayuda de los aliados restantes, los Vengadores se reúnen una vez más para revertir las acciones de Thanos y restaurar el equilibrio del universo.\r\n    ', 'Anthony Russo', '26/04/2019', 1, ''),
(16, 'Batman: El caballero de la noche ', '    \r\n    Cuando la amenaza conocida como el Joker causa estragos y caos en la gente de Ciudad Gótica, Batman debe aceptar una de las mayores pruebas psicológicas y físicas de su capacidad para luchar contra la injusticia.', 'Christopher Nolan', '18/07/2008', 1, ''),
(17, 'Caracortada', '    \r\n    Tony Montana es un emigrante cubano frío e implacable que se instala en Miami con el propósito de convertirse en un gángster importante, y poder así ganar dinero y posición. Con la colaboración de su amigo Manny Rivera inicia una fulgurante carrera delictiva, como traficante de cocaína, con el objetivo de acceder a la cúpula de una organización de narcos.', 'Brian De Palma', '09/12/1983 ', 1, ''),
(18, 'Bastardos sin gloria', '    \r\n    Segunda Guerra Mundial (1939-1945). En la Francia ocupada por los alemanes, Shosanna Dreyfus (Mélanie Laurent) presencia la ejecución de su familia por orden del coronel Hans Landa (Christoph Waltz). Después de huir a París, adopta una nueva identidad como propietaria de un cine. En otro lugar de Europa, el teniente Aldo Raine (Brad Pitt) adiestra a un grupo de soldados judíos (“The Basterds”) para atacar objetivos concretos. Los hombres de Raine y una actriz alemana (Diane Kruger), que trabaja para los aliados, deben llevar a cabo una misión para hacer caer a los jefes del Tercer Reich. El destino quiere que todos se encuentren bajo la marquesina de un cine donde Shosanna espera para vengarse.', 'Quentin Tarantino', '21/08/2009', 1, ''),
(19, 'Interestelar ', '    \r\n    Narra las aventuras de un grupo de exploradores que hacen uso de un agujero de gusano recientemente descubierto para superar las limitaciones de los viajes espaciales tripulados y vencer las inmensas distancias que tiene un viaje interestelar.', 'Christopher Nolan', '06/11/2014', 3, ''),
(20, 'Terminator 2: Juicio Final ', '    \r\n    Sarah Connor, la madre soltera del rebelde John Connor, está ingresada en un psiquiátrico. Algunos años antes, un viajero del tiempo le había revelado que su hijo sería el salvador de la humanidad en un futuro dominado por las máquinas. Se convirtió entonces en una especie de guerrera y educó a su hijo John en tácticas de supervivencia. Esta es la razón por la que está recluida en un manicomio. Cuando un nuevo androide mejorado, un T-1000, llega del futuro para asesinar a John, un viejo modelo T-800 será enviado para protegerle.', 'James Cameron', '03/07/1991', 3, ''),
(21, 'Matrix', '    \r\n    Un hacker informático aprende de misteriosos rebeldes la verdadera naturaleza de su realidad y su papel en la guerra contra sus controladores.', 'Lana Wachowski', '21/05/1999 ', 3, ''),
(22, 'La guerra de las galaxias ', '    \r\n    La Princesa Leia Organa ha sido capturada por Darth Vader por tener los planos de la Estrella de la muerte, la temida estación espacial del imperio. Dos androides escapan al planeta Tatooine, ambos son comprados por Luke Skywalker, un joven granjero, este se entera de un mensaje que ella, uno de ellos y busca a Obi Wan Kenobi, un antiguo caballero Jedi que lo lleva a conocer sobre la fuerza y como utilizarla. Contratan a Han Solo, un foragido espacial que tiene al Halcón Milenario, una gran nave capaz de recorrer a la velocidad de la luz con la intención de rescatar a la princesa y luego organizar una batalla para destruir a la Estrella de la muerte.', 'George Lucas', '23/12/1977 ', 3, ''),
(23, 'Volver al Futuro', '    El adolescente Marty McFly es amigo de Doc, un científico al que todos toman por loco. Cuando Doc crea una máquina para viajar en el tiempo, un error fortuito hace que Marty llegue a 1955, año en el que sus futuros padres aún no se habían conocido. Después de impedir su primer encuentro, deberá conseguir que se conozcan y se casen; de lo contrario, su existencia no sería posible.\r\n    ', 'Robert Zemeckis', '25/12/1985 ', 3, ''),
(24, 'El Imperio contraataca ', '    \r\n    Tras un ataque sorpresa de las tropas imperiales a las bases camufladas de la alianza rebelde, Luke Skywalker, en compañía de R2D2, parte hacia el planeta Dagobah en busca de Yoda, el último maestro Jedi, para que le enseñe los secretos de la Fuerza. Mientras, Han Solo, la princesa Leia, Chewbacca, y C3PO esquivan a las fuerzas imperiales y piden refugio al antiguo propietario del Halcón Milenario, Lando Calrissian, en la ciudad minera de Bespin, donde les prepara una trampa urdida por Darth Vader.', 'Irvin Kershner', '25/12/1980 ', 3, ''),
(25, 'Godzilla vs Kong', '    \r\n    En un momento en que los monstruos caminan por la Tierra, la lucha de la humanidad por su futuro coloca a Godzilla y Kong en un curso de colisión que verá a las dos fuerzas más poderosas de la naturaleza en el planeta enfrentarse en una batalla espectacular para las edades. Mientras Monarch se embarca en una peligrosa misión en un terreno inexplorado y descubre pistas sobre los orígenes de los Titanes, una conspiración humana amenaza con borrar a las criaturas, tanto buenas como malas, de la faz de la tierra para siempre.', 'Adam Wingard', ' 25/03/2021 ', 3, ''),
(26, 'Duna', '    \r\n          \r\n    Paul Atreides, un joven brillante y talentoso nacido en un gran destino más allá de su entendimiento, debe viajar al planeta más peligroso del universo para asegurar el futuro de su familia y de su pueblo.Editado\r\n    \r\n    ', 'Denis Villeneuve', '21/10/2021', 3, ''),
(40, 'Top Gun: Maverick', '    \r\n    Después de más de 30 años de servicio como uno de los mejores aviadores de la Armada, Pete \"Maverick\" Mitchell se encuentra dónde siempre quiso estar, empujando los límites como un valiente piloto de prueba y esquivando el alcance en su rango, que no le dejaría volar emplazándolo en tierra. Cuando se encuentra entrenando a un destacamento de graduados de Top Gun para una misión especializada, Maverick se encuentra allí con el teniente Bradley Bradshaw, el hijo de su difunto amigo \"Goose\".', 'Joseph Kosinski', '05/26/2022', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `review` text NOT NULL,
  `id_movie_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id_review`, `review`, `id_movie_fk`) VALUES
(6, 'muy buena peli editado', 10),
(7, 'Excelente pelicula', 10),
(8, 'dadaddad', 18),
(9, 'dadadadad', 15),
(11, 'dadadadada', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`) VALUES
(5, '123@123.com', '$2y$10$NCwy.cO5JOah8LliyL916eKhK1l9ztaBLQpiDXygS/jlgqL741AvG'),
(6, 'admin@admin.com', '$2y$10$.yqY.9Tx6PR4vZ/Qh7mfSeuH0KYLmNOTkyCgIxmbhNRcdji9Xy1ay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`),
  ADD KEY `id_genero_fk` (`id_gender_fk`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_movie` (`id_movie_fk`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`id_gender_fk`) REFERENCES `genders` (`id_gender`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_movie_fk`) REFERENCES `movies` (`id_movie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

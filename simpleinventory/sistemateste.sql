-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jan-2016 às 15:03
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistemateste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `quantity` float NOT NULL,
  `position` varchar(50) NOT NULL,
  `obs` text NOT NULL,
  `quantitymin` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `description`, `quantity`, `position`, `obs`, `quantitymin`) VALUES
(3, 'Resistor de Carbono 1/4W 1K DIP', 965, 'A91', '                ', 1000),
(6, 'Resistor de Carbono 1/4W 3K3 DIP', 105, '', '', 0),
(7, 'Resistor de Carbono 1/4W 6K8 DIP', 1000, '', '                                ', 0),
(8, 'Resistor de Carbono 1/4W 100K DIP', 1078, '', '                                ', 100),
(9, 'Microcontrolador PIC 18F4550 I/P ', 91, 'B5', '                                                ', 50),
(10, 'Resistor de Carbono 1/4W 2K2 DIP', 0, '', '                ', 0),
(11, 'Transistor BC337 DIP', 5010, '', '                                ', 20),
(12, 'Resistor de Carbono 1/4W 10K DIP', 7000, '', '                ', 0),
(13, 'Resistor de Carbono 1/4W 10K SMD 1206', 2568, '', '                                                ', 3000),
(14, 'Resistor de Carbono 1/4W 1K SMD 1206', 50, '', '                                ', 0),
(15, 'Resistor de Carbono 1/4W 2K2 SMD 1206', 0, '', '                                ', 0),
(16, 'Resistor de Carbono 1/4W 6K8 SMD 1206', 3500, '', '                                ', 5000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prosup`
--

CREATE TABLE IF NOT EXISTS `prosup` (
`id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `suppliers_id` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `obs` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `prosup`
--

INSERT INTO `prosup` (`id`, `products_id`, `suppliers_id`, `price`, `obs`) VALUES
(1, 3, 1, 0.01, NULL),
(2, 7, 1, 0.02, NULL),
(6, 7, 3, 5, NULL),
(7, 8, 1, 0.02, NULL),
(8, 6, 3, 0.04, NULL),
(9, 6, 1, 0.05, NULL),
(10, 9, 1, 49.8, NULL),
(11, 9, 4, 10, NULL),
(12, 11, 5, 0.75, NULL),
(13, 16, 5, 0.05, NULL),
(14, 13, 1, 0.03, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
`id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(500) NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `obs` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `contact`, `address`, `obs`) VALUES
(1, 'Supplier 1', 'supplier@supplier.com', '                                ', 'Blumenal                           ', '                                '),
(3, 'ACP', '', '', '', ''),
(4, 'Supplier 2', '', 'China', '', ''),
(5, 'Supplier 3', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uprofiles`
--

CREATE TABLE IF NOT EXISTS `uprofiles` (
`id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `permissions` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `uprofiles`
--

INSERT INTO `uprofiles` (`id`, `name`, `permissions`, `description`) VALUES
(1, 'Administrator', '*', 'Perfil administrador'),
(2, 'Usuario', '[products.index],[products.create],[products.addsupplier],[products.search],[products.askremovesupplier],[products.stockio]', 'Perfil de usuario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(50) NOT NULL,
  `realname` varchar(500) NOT NULL,
  `obs` text NOT NULL,
  `uprofiles_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `obs`, `uprofiles_id`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Administrador do sistema.', 1),
(3, 'leandro', '3f3ce8d94f88d42322e7204f702c138f', 'Leandro Pinto', 'Alterando', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prosup`
--
ALTER TABLE `prosup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uprofiles`
--
ALTER TABLE `uprofiles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `prosup`
--
ALTER TABLE `prosup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `uprofiles`
--
ALTER TABLE `uprofiles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

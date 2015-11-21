CREATE TABLE IF NOT EXISTS `akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipe` enum('dosen','mahasiswa') NOT NULL DEFAULT 'mahasiswa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `akun` (`id`, `nama`, `kelas`, `telp`, `email`, `password`, `tipe`) VALUES
(1, 'Dosen Fasilkom', '3C', '081234567890', 'dosen@staff.unsika.ac.id', '827ccb0eea8a706c4c34a16891f84e7b', 'dosen');



CREATE TABLE IF NOT EXISTS `berita` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `isi` text NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `berita` (`bid`, `isi`) VALUES
(1, 'Besok adalah praktikum untuk pemrograman web. Jangan telat!');



CREATE TABLE IF NOT EXISTS `berkas` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `fnama` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `ftipe` varchar(30) NOT NULL,
  `ftanggal` varchar(20) NOT NULL,
  `ukuran` int(11) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

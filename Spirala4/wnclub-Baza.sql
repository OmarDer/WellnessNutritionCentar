-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2016 at 12:28 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wnclub_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `autori`
--

CREATE TABLE IF NOT EXISTS `autori` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `autori`
--

INSERT INTO `autori` (`ID`, `Username`, `Password`) VALUES
(1, 'administrator', 'f2ec5fdcc58bcb002270a11f6bb2a9b3');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KomentarTxt` text COLLATE utf8_slovenian_ci NOT NULL,
  `Vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IDAutor` int(11) DEFAULT NULL,
  `IDNovost` int(11) NOT NULL,
  `IDKomentar` int(11) DEFAULT NULL,
  `Pogledan` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDAutor` (`IDAutor`),
  KEY `IDKomentar` (`IDKomentar`),
  KEY `IDNovost` (`IDNovost`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=85 ;

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `NovostID` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(200) COLLATE utf8_slovenian_ci NOT NULL,
  `NovostiTxt` text COLLATE utf8_slovenian_ci NOT NULL,
  `Vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Slika` text COLLATE utf8_slovenian_ci NOT NULL,
  `AutorID` int(11) NOT NULL,
  `Otvoren` varchar(2) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`NovostID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`NovostID`, `Naslov`, `NovostiTxt`, `Vrijeme`, `Slika`, `AutorID`, `Otvoren`) VALUES
(14, 'Važnost doručka za zdravlje', 'Ishrana ili prehrana je jedna od potreba svakoga čovjeka na Zemlji&#44; to je proces u kome čovjek unosi u organizam hranu&#44; dok se nastavak procesa u kojem se onda u probavnom traktu hrana prerađuje u energiju (ili skladi&scaron;ti) naziva probava. Danas su popularni pojmovi: vegetarijanska ishrana makrobiotička ishrana No jedino stvarno bitno u cijeloj priči o prehrani jest: dnevno unijeti u organizam dovoljne količine svih hranjivih tvari tako da se tijelo (organizam) zadrži u zdravom stanju. Suprotnost jest pothranjenost&#44; koja slabi imuni sistem čovjeka i time ga čini lakim plijenom bolesti&#44; od prehlada&#44; upala pluća do TBC-a. Obično se govori da prehrana treba biti raznolika. Treba sadržavati: Vitamine Ugljikohidrate Bjelančevine Masti Minerale', '2016-06-05 10:20:16', 'protein-foods.jpg', 1, 'DA'),
(15, 'Sve o ishrani 2', 'Ishrana ili prehrana je jedna od potreba svakoga čovjeka na Zemlji&#44; to je proces u kome čovjek unosi u organizam hranu&#44; dok se nastavak procesa u kojem se onda u probavnom traktu hrana prerađuje u energiju (ili skladi&scaron;ti) naziva probava. Danas su popularni pojmovi: vegetarijanska ishrana makrobiotička ishrana No jedino stvarno bitno u cijeloj priči o prehrani jest: dnevno unijeti u organizam dovoljne količine svih hranjivih tvari tako da se tijelo (organizam) zadrži u zdravom stanju. Suprotnost jest pothranjenost&#44; koja slabi imuni sistem čovjeka i time ga čini lakim plijenom bolesti&#44; od prehlada&#44; upala pluća do TBC-a. Obično se govori da prehrana treba biti raznolika. Treba sadržavati: Vitamine Ugljikohidrate Bjelančevine Masti Minerale', '2016-06-05 10:20:56', 'vlakna-za-mrsavljenje-tekst2.jpg', 1, 'DA'),
(16, 'Sve o ishrani', 'Ishrana ili prehrana je jedna od potreba svakoga čovjeka na Zemlji&#44; to je proces u kome čovjek unosi u organizam hranu&#44; dok se nastavak procesa u kojem se onda u probavnom traktu hrana prerađuje u energiju (ili skladi&scaron;ti) naziva probava. Danas su popularni pojmovi: vegetarijanska ishrana makrobiotička ishrana No jedino stvarno bitno u cijeloj priči o prehrani jest: dnevno unijeti u organizam dovoljne količine svih hranjivih tvari tako da se tijelo (organizam) zadrži u zdravom stanju. Suprotnost jest pothranjenost&#44; koja slabi imuni sistem čovjeka i time ga čini lakim plijenom bolesti&#44; od prehlada&#44; upala pluća do TBC-a. Obično se govori da prehrana treba biti raznolika. Treba sadržavati: Vitamine Ugljikohidrate Bjelančevine Masti Minerale', '2016-06-05 10:21:26', 'vlakna-za-mrsavljenje-tekst2.jpg', 1, 'DA'),
(17, 'Sta znate o proteinima?', 'Proteini u ljudskom organizmu imaju gradivnu ulogu. Čine ih dugački lanci aminokiselina. Postoji dvadesetak aminokiselina u organizmu&#44; ali samo izvestan broj njih može da proizvede ljudski organizamhTo su neesencijalne aminokiseline. Ostale aminokiseline organizam nije u mogućnosti da sinteti&scaron;e&#44; pa se stoga moraju unositi putem hrane. Te aminokiseline nazivamo bitnim ili esencijalnim. Deset je takvih aminokiselina: izoleucin&#44; leucin&#44; lizin&#44; metionin&#44; fenilalanin&#44; treonin&#44; triptofan&#44; valin&#44; histidin i arginin. Obično se kaže da su namirnice životinjskig porekla (animalne) kompletne &scaron;to se tiče proteinskog sastava. Time se misli na sadržaj svih deset esencijalnih aminokiselina. U digestivnom traktu dolazi do raskidanja dugačkih lanaca proteina pri čemu se oslobađaju 4 cal&#44; a tako nastale slobodne aminokiseline se sada mogu konfigurisati na nov način u zavisnosti od potreba organizma. Ovo je samo jedan način utro&scaron;ka aminokiselina u organizmu. Uneti proteini&#44; ukoliko u organizmu postoji deficit ugljenih hidrata&#44; mogu da se pretvore u glukozu i time organizmu obezbede neophodnu energiju&#44; pa na taj način&#44; pored svoje osnovne gradivne uloge&#44; imaju i energetsku. Da proteini ne bi izgubili svoju osnovnu gradivnu funkciju&#44; potrebno je unositi dovoljno energetskog materijala&#44; pa se zato i kaže da ugljeni hidrati &scaron;tite proteine. Proteini&#44; takodje&#44; mogu da budu konvertovani u masne kiseline i iskori&scaron;ćeni kao osnov za stvaranje masti. I konačno&#44; aminokiseline koje nisu u&scaron;le ni u jedan proces pretvaraju se u ureu i izlučuju iz organizma.Preporuke su da svakodnevno treba unositi 0.8 g proteina po kg telesne težine&#44; za zdrave osobe sa normalnom fizičkom aktivno&scaron;ću. Mnogi naučnici smatraju da je ova količina proteina premala za osobe sa povećanom dnevnom fizičkom aktivno&scaron;ću&#44; npr. sportisti jer je kod njih metabolizam (sinteza i razgradnja) proteina povećan. Jo&scaron; uvek nisu precizno utvrđene potrebe za proteinima za sportiste&#44; ali se zna da su ipak individualne i da količina od 1 do 2 g proteina na kg telesne mase zadovoljava dnevne potrebe kod svih kategorija aktivnih sportista. Povećana fizička aktivnost i samo takmičenje&#44; angažujući u većoj meri mi&scaron;ićne ćelije&#44; izazivaju nagomilavanje kiselih metabolita&#44; koje mogu neutralisati belančevine vr&scaron;eći svoju ulogu pufera. Prekomeran unos proteina može da dovede do prekomerne težine&#44; dehidratacije i gubitka kalcijuma u organizmu.', '2016-06-05 10:22:08', 'protein-foods.jpg', 1, 'DA'),
(18, 'Sta znate o proteinima?', 'Proteini u ljudskom organizmu imaju gradivnu ulogu. Čine ih dugački lanci aminokiselina. Postoji dvadesetak aminokiselina u organizmu&#44; ali samo izvestan broj njih može da proizvede ljudski organizamhTo su neesencijalne aminokiseline. Ostale aminokiseline organizam nije u mogućnosti da sinteti&scaron;e&#44; pa se stoga moraju unositi putem hrane. Te aminokiseline nazivamo bitnim ili esencijalnim. Deset je takvih aminokiselina: izoleucin&#44; leucin&#44; lizin&#44; metionin&#44; fenilalanin&#44; treonin&#44; triptofan&#44; valin&#44; histidin i arginin. Obično se kaže da su namirnice životinjskig porekla (animalne) kompletne &scaron;to se tiče proteinskog sastava. Time se misli na sadržaj svih deset esencijalnih aminokiselina. U digestivnom traktu dolazi do raskidanja dugačkih lanaca proteina pri čemu se oslobađaju 4 cal&#44; a tako nastale slobodne aminokiseline se sada mogu konfigurisati na nov način u zavisnosti od potreba organizma. Ovo je samo jedan način utro&scaron;ka aminokiselina u organizmu. Uneti proteini&#44; ukoliko u organizmu postoji deficit ugljenih hidrata&#44; mogu da se pretvore u glukozu i time organizmu obezbede neophodnu energiju&#44; pa na taj način&#44; pored svoje osnovne gradivne uloge&#44; imaju i energetsku. Da proteini ne bi izgubili svoju osnovnu gradivnu funkciju&#44; potrebno je unositi dovoljno energetskog materijala&#44; pa se zato i kaže da ugljeni hidrati &scaron;tite proteine. Proteini&#44; takodje&#44; mogu da budu konvertovani u masne kiseline i iskori&scaron;ćeni kao osnov za stvaranje masti. I konačno&#44; aminokiseline koje nisu u&scaron;le ni u jedan proces pretvaraju se u ureu i izlučuju iz organizma.Preporuke su da svakodnevno treba unositi 0.8 g proteina po kg telesne težine&#44; za zdrave osobe sa normalnom fizičkom aktivno&scaron;ću. Mnogi naučnici smatraju da je ova količina proteina premala za osobe sa povećanom dnevnom fizičkom aktivno&scaron;ću&#44; npr. sportisti jer je kod njih metabolizam (sinteza i razgradnja) proteina povećan. Jo&scaron; uvek nisu precizno utvrđene potrebe za proteinima za sportiste&#44; ali se zna da su ipak individualne i da količina od 1 do 2 g proteina na kg telesne mase zadovoljava dnevne potrebe kod svih kategorija aktivnih sportista. Povećana fizička aktivnost i samo takmičenje&#44; angažujući u većoj meri mi&scaron;ićne ćelije&#44; izazivaju nagomilavanje kiselih metabolita&#44; koje mogu neutralisati belančevine vr&scaron;eći svoju ulogu pufera. Prekomeran unos proteina može da dovede do prekomerne težine&#44; dehidratacije i gubitka kalcijuma u organizmu.', '2016-06-05 10:25:15', 'protein-foods.jpg', 1, 'DA'),
(19, 'Moderna prehrana= previ&scaron;e &scaron;ećera', 'Dana&scaron;nja prehrana je pomalo zeznuta. Proizvođači hrane su primijetili da nas slatko privlači. Zato su počeli dodavati &scaron;ećere u razne proizvode. Na primjer&#44; kukuruzne pahuljice koje doručkujemo su obično toliko obrađene i za&scaron;ećerene da ih slobodno možemo proglasiti &scaron;ećerom. Hrana poput kukuruznih pahuljica je toliko obrađena (rafinirana) da je izgubila svu hranjivu vrijednost- vitamine&#44; minerale i vlakna. Jedino &scaron;to ostaje je &scaron;ećer. Jednostavni &scaron;ećeri koje unosimo brzinski dižu razinu &scaron;ećera u krvi. Na&scaron;e tijelo nije spremno za tako nagle skokove razine &scaron;ećera u krvi. Ljudska vrsta se razvijala kroz stotine tisuća godina i većinu vremena je unosila jednostavne ugljikohidrate samo s voćem i povrćem. Danas je situacija drugačija i jednostavni &scaron;ećeri su svuda oko nas&#44; u umaku za salatu i konzerviranom grahu&#44; jelima za koja ne bismo očekivali da imaju dodane &scaron;ećere&#44; ali često imaju. Posljedica prehrane s puno jednostavnih ugljikohidrata&#44; npr. rafiniranog bijelog kuhinjskog &scaron;ećera&#44; može biti pogubna za na&scaron;e zdravlje. Dijabetes (&scaron;ećerna bolest)&#44; pretilost i karijes neke su od če&scaron;ćih bolesti koje su uzrokovane unosom velike količina &scaron;ećera. Kada netko kaže da je ovisan o &scaron;ećeru ili o čokoladi vjerojatno ne preuveličava. Naime&#44; nagli rast &scaron;ećera u krvi može izazvati dobar osjećaj&#44; čak i blagu euforiju. No nakon naglog rasta slijedi nagli pad razine &scaron;ećera. On će uzrokovat osjećaj gladi&#44; umor&#44; u ekstremnom slučaju razdražljivost i lo&scaron;e raspoloženje.', '2016-06-05 10:25:42', 'Sugar-science-Fructose-more-toxic-than-sucrose-suggests-mouse-study.jpg', 1, 'DA'),
(20, 'Moderna prehrana= previ&scaron;e &scaron;ećera', 'Jedete ga svaki dan&#44; ali možda niste svjesni koliko je &scaron;tetan i u kojim se namirnicama nalazi. Riječ je o &scaron;ećeru kojeg sve vi&scaron;e nutricionista&#44; liječnika i znanstvenika naziva tihim ubojicom i biooružjem 21. stoljeća. Da je situacija i vi&scaron;e nego ozbiljna&#44; svjedoči činjenica da je od 2011. godine&#44; prema izvje&scaron;ću Crvenog križa&#44; na svijetu vi&scaron;e pretilih nego pothranjenih osoba. Riječ je o pravoj epidemiji pretilosti&#44; zabilježenoj po prvi put u povijesti čovječanstva. Na alarmantnu situaciju upozorava i Svjetska zdravstvena organizacija (WHO). Upozorava da unos &scaron;ećera ne smije prelaziti 5% od ukupne dnevne energije koju dobivamo hranom. Za žene&#44; to oko 25 grama i oko 35 grama za mu&scaron;karce. No studije prehrambenih navika pokazuju da dnevno unosimo i do 10 puta vi&scaron;e &scaron;ećera. To je opterećenje koje na&scaron; organizam sve teže podnosi.', '2016-06-05 10:26:19', 'Sugar-science-Fructose-more-toxic-than-sucrose-suggests-mouse-study.jpg', 1, 'DA'),
(21, 'Sto razloga za prehranu bogatu vlaknima1', 'Stalno čujemo da su vlakna nužna za dobru probavu&#44; vitku liniju i kompletno zdravlje organizma. No&#44; na pitanje &scaron;to su prehrambena vlakna i gdje se nalaze&#44; malo će tko znati točan odgovor. Vlakna nisu nikakav misterij. Ona se nalaze u namirnicama koje svakodnevno konzumiramo. Dio su ugljikohidrata iz biljaka koji se u na&scaron;em želucu ne razgrađuje&#44; nego samo prolazi kroz probavni sustav. Da biste potpuno razumjeli ulogu vlakana&#44; trebate znati da postoje dvije vrste prehrambenih vlakana &ndash; topiva i netopiva. Topiva se vlakna u dodiru s vodom razgrađuju&#44; dok netopiva nabubre i ne razgrađuju se. O tome jesu li vlakna topiva ili ne ovisi i njihova uloga u na&scaron;em organizmu.', '2016-06-05 10:27:12', 'vlakna-za-mrsavljenje-tekst2.jpg', 1, 'DA'),
(22, 'Sto razloga za prehranu bogatu vlaknima2', 'Stalno čujemo da su vlakna nužna za dobru probavu&#44; vitku liniju i kompletno zdravlje organizma. No&#44; na pitanje &scaron;to su prehrambena vlakna i gdje se nalaze&#44; malo će tko znati točan odgovor. Vlakna nisu nikakav misterij. Ona se nalaze u namirnicama koje svakodnevno konzumiramo. Dio su ugljikohidrata iz biljaka koji se u na&scaron;em želucu ne razgrađuje&#44; nego samo prolazi kroz probavni sustav. Da biste potpuno razumjeli ulogu vlakana&#44; trebate znati da postoje dvije vrste prehrambenih vlakana &ndash; topiva i netopiva. Topiva se vlakna u dodiru s vodom razgrađuju&#44; dok netopiva nabubre i ne razgrađuju se. O tome jesu li vlakna topiva ili ne ovisi i njihova uloga u na&scaron;em organizmu.', '2016-06-05 10:27:33', 'vlakna-za-mrsavljenje-tekst2.jpg', 1, 'DA'),
(23, 'Sto razloga za prehranu bogatu vlaknima4', 'Stalno čujemo da su vlakna nužna za dobru probavu&#44; vitku liniju i kompletno zdravlje organizma. No&#44; na pitanje &scaron;to su prehrambena vlakna i gdje se nalaze&#44; malo će tko znati točan odgovor. Vlakna nisu nikakav misterij. Ona se nalaze u namirnicama koje svakodnevno konzumiramo. Dio su ugljikohidrata iz biljaka koji se u na&scaron;em želucu ne razgrađuje&#44; nego samo prolazi kroz probavni sustav. Da biste potpuno razumjeli ulogu vlakana&#44; trebate znati da postoje dvije vrste prehrambenih vlakana &ndash; topiva i netopiva. Topiva se vlakna u dodiru s vodom razgrađuju&#44; dok netopiva nabubre i ne razgrađuju se. O tome jesu li vlakna topiva ili ne ovisi i njihova uloga u na&scaron;em organizmu.', '2016-06-05 10:27:48', 'vlakna-za-mrsavljenje-tekst2.jpg', 1, 'DA'),
(24, 'Sto razloga za prehranu bogatu vlaknima5', 'Stalno čujemo da su vlakna nužna za dobru probavu&#44; vitku liniju i kompletno zdravlje organizma. No&#44; na pitanje &scaron;to su prehrambena vlakna i gdje se nalaze&#44; malo će tko znati točan odgovor. Vlakna nisu nikakav misterij. Ona se nalaze u namirnicama koje svakodnevno konzumiramo. Dio su ugljikohidrata iz biljaka koji se u na&scaron;em želucu ne razgrađuje&#44; nego samo prolazi kroz probavni sustav. Da biste potpuno razumjeli ulogu vlakana&#44; trebate znati da postoje dvije vrste prehrambenih vlakana &ndash; topiva i netopiva. Topiva se vlakna u dodiru s vodom razgrađuju&#44; dok netopiva nabubre i ne razgrađuju se. O tome jesu li vlakna topiva ili ne ovisi i njihova uloga u na&scaron;em organizmu.', '2016-06-05 10:28:11', 'vlakna-za-mrsavljenje-tekst2.jpg', 1, 'DA');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `Komentar_ibfk_1` FOREIGN KEY (`IDAutor`) REFERENCES `autori` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Komentar_ibfk_2` FOREIGN KEY (`IDNovost`) REFERENCES `novosti` (`NovostID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Komentar_ibfk_3` FOREIGN KEY (`IDKomentar`) REFERENCES `komentar` (`ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

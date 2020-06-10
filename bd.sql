
CREATE TABLE `Origoclientes` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contato` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `cidade` varchar(35) NOT NULL,
  `nascimento` DATETIME NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

ALTER TABLE bvzfdagnfqepipz70gyw.Origoclientes ADD planos varchar(255) NOT NULL;
ALTER TABLE bvzfdagnfqepipz70gyw.Origoclientes MODIFY COLUMN planos varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 1 NOT NULL;

CREATE UNIQUE INDEX Origoclientes_email_IDX USING BTREE ON bvzfdagnfqepipz70gyw.Origoclientes (email);


INSERT INTO bvzfdagnfqepipz70gyw.Origoclientes(nome, email, contato, estado, cidade, nascimento)
VALUES('Claudianus Boast', 'cboast0@fastcompany.com', '(19) 957645371', 'São Paulo', 'Araraquara', '1993-06-07'),
('Loni Jennions', 'ljennions1@va.gov', '(19) 905613161', 'São Paulo', 'Limeira', '1985-05-09'),
('Margi Gilhouley', 'mgilhouley2@telegraph.co.uk', '(19) 966290104', 'São Paulo', 'Araraquara', '1984-09-13'),
('Lexy Sprulls', 'lsprulls3@moonfruit.com', '(19) 976121601', 'São Paulo', 'Rio Claro', '1999-10-19'),
('Marie Shatliff', 'mshatliff4@cbslocal.com', '(19) 991376354', 'São Paulo', 'Rio Claro', '1990-07-20'),
('Graig Mouncey', 'gmouncey5@so-net.ne.jp', '(19) 941806149', 'São Paulo', 'Araraquara', '1990-03-27'),
('Laurice Liger', 'lliger0@php.net', '(35) 971740954', 'Minas Gerais', 'Areado', '1992-10-25'),
('Kendrick Sooper', 'ksooper1@slate.com', '(31) 944324086', 'Minas Gerais', 'Belo Horizonte', '1981-06-02'),
('Gordon Levington', 'glevington2@hpost.com', '(31) 922405868', 'Minas Gerais', 'Belo Horizonte', '1993-11-25'),
('Noam Scolland', 'nscolland3@mozilla.org', '(35) 996817669', 'Minas Gerais', 'Areado', '1999-12-31'),
('Lindon Skehens', 'lskehens4@npr.org', '(35) 967671104', 'Minas Gerais', 'Areado', '1985-01-10'),
('Kimbra Rase', 'krase5@topsy.com', '(35) 999428030', 'Minas Gerais', 'Areado', '1999-05-05'),
('Lorenzo Fisk', 'lfisk6@businessweek.com', '(31) 912695467', 'Minas Gerais', 'Belo Horizonte', '1985-12-22'),
('Bourke Flavelle', 'bflavelle7@fc2.com', '(35) 959386145', 'Minas Gerais', 'Itapeva', '1984-04-10'),
('Curran McSharry', 'cmcsharry8@webeden.co.uk', '(35) 902916131', 'Minas Gerais', 'Itapeva', '1983-01-15'),
('Aveline Dowtry', 'adowtry9@miibeian.gov.cn', '(31) 945227500', 'Minas Gerais', 'Belo Horizonte', '1994-12-23'),
('John Sebastian', 'jsebastiana@cbslocal.com', '(31) 907366740', 'Minas Gerais', 'Belo Horizonte', '1998-04-06'),
('Reynolds Greenan', 'rgreenanb@bloomberg.com', '(35) 923551410', 'Minas Gerais', 'Itapeva', '1985-07-19');


CREATE TABLE `Origoplanos` (
  `idplano` int(11) NOT NULL AUTO_INCREMENT,
  `plano` varchar(255) NOT NULL,
  `mensalidade` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`idplano`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8


INSERT INTO bvzfdagnfqepipz70gyw.Origoplanos
(idplano, plano, mensalidade)
VALUES(1, 'Free', 0.00),
(2, 'Basic', 100.00),
(3, 'Plus', 187.00);

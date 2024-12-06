CREATE TABLE utilisateur(
    idUtilisateur INT AUTO_INCREMENT NOT NULL,
    emailUtilisateur VARCHAR(500) NOT NULL UNIQUE,
    motDePasseUtilisateur VARCHAR(500) NOT NULL,
    nomUtilisateur VARCHAR(500) NOT NULL,
    prenomUtilisateur VARCHAR(500) NOT NULL,
    secretA2FUtilisateur VARCHAR(500) NULL,
    tentativesEchoueesUtilisateur INT NOT NULL DEFAULT 0,
    estDesactiveUtilisateur INT NOT NULL DEFAULT 0,
    PRIMARY KEY(idUtilisateur)
)ENGINE=InnoDB;

CREATE TABLE log(
    idLog INT AUTO_INCREMENT NOT NULL,
    typeActionLog VARCHAR(500) NOT NULL,
    dateHeureLog DATETIME NOT NULL DEFAULT NOW(),
    adresseIPLog VARCHAR(15) NOT NULL,
    idUtilisateur INT NOT NULL,
    PRIMARY KEY(idLog)
)ENGINE=InnoDB;

ALTER TABLE log ADD FOREIGN KEY (idUtilisateur) REFERENCES utilisateur(idUtilisateur);
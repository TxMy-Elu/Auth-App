-- Création de la table utilisateur
CREATE TABLE utilisateur (
                             idUtilisateur INT AUTO_INCREMENT NOT NULL,
                             emailUtilisateur VARCHAR(500) NOT NULL UNIQUE,
                             motDePasseUtilisateur VARCHAR(500) NOT NULL,
                             nomUtilisateur VARCHAR(500) NOT NULL,
                             prenomUtilisateur VARCHAR(500) NOT NULL,
                             secretA2FUtilisateur VARCHAR(500) NULL,
                             tentativesEchoueesUtilisateur INT NOT NULL DEFAULT 0,
                             estDesactiveUtilisateur INT NOT NULL DEFAULT 0,
                             PRIMARY KEY (idUtilisateur)
) ENGINE=InnoDB;

-- Création de la table log
CREATE TABLE log (
                     idLog INT AUTO_INCREMENT NOT NULL,
                     typeActionLog VARCHAR(500) NOT NULL,
                     dateHeureLog DATETIME NOT NULL DEFAULT NOW(),
                     adresseIPLog VARCHAR(15) NOT NULL,
                     idUtilisateur INT NOT NULL,
                     PRIMARY KEY (idLog),
                     FOREIGN KEY (idUtilisateur) REFERENCES utilisateur(idUtilisateur)
) ENGINE=InnoDB;

-- Création de la table reset_password
CREATE TABLE reset_password (
                                idResetPassword INT AUTO_INCREMENT NOT NULL,
                                codeResetPassword VARCHAR(32) NOT NULL,
                                idUtilisateur INT NOT NULL,
                                dateHeureExpirationResetPassword DATETIME DEFAULT (CURRENT_TIMESTAMP + INTERVAL 1 DAY),
                                PRIMARY KEY (idResetPassword),
                                KEY (idUtilisateur),
                                FOREIGN KEY (idUtilisateur) REFERENCES utilisateur(idUtilisateur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

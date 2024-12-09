# Auth-App

## Description

Auth-App est une application web conçue pour gérer l'authentification des utilisateurs et la sécurité des comptes. Elle
inclut des fonctionnalités telles que l'enregistrement des utilisateurs, la connexion, l'authentification à deux
facteurs (2FA) et la réactivation des comptes.

## Schéma de la Base de Données

Le schéma de la base de données inclut les tables suivantes :

- `utilisateur`: Stocke les informations des utilisateurs.
- `log`: Enregistre les actions des utilisateurs et les journaux.
- `reactivation`: Gère les liens de réactivation des comptes.

## Fonctionnalités Clés

1. **Enregistrement et Connexion des Utilisateurs**: Permet aux utilisateurs de s'enregistrer et de se connecter à l'
   application.
2. **Authentification à Deux Facteurs (2FA)**: Améliore la sécurité en nécessitant une deuxième forme
   d'authentification.
3. **Réactivation des Comptes**: Fournit la fonctionnalité de gérer les comptes désactivés et d'envoyer des liens de
   réactivation.

## Exemple de Schéma SQL

```sql
-- Création de la table utilisateur
CREATE TABLE utilisateur
(
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
CREATE TABLE log
(
   idLog INT AUTO_INCREMENT NOT NULL,
   typeActionLog VARCHAR(500) NOT NULL,
   dateHeureLog DATETIME NOT NULL DEFAULT NOW(),
   adresseIPLog VARCHAR(15) NOT NULL,
   idUtilisateur INT NOT NULL,
   PRIMARY KEY (idLog),
   FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur)
) ENGINE=InnoDB;

-- Création de la table reactivation
CREATE TABLE reactivation
(
   idReactivation INT AUTO_INCREMENT NOT NULL,
   codeReactivation VARCHAR(32) NOT NULL,
   dateHeureExpirationReactivation DATETIME NOT NULL DEFAULT (NOW() + INTERVAL 1 DAY),
   idUtilisateur INT NOT NULL,
   PRIMARY KEY (idReactivation),
   FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur)
) ENGINE=InnoDB;

-- Création de la table recuperation
CREATE TABLE recuperation
(
   idRecuperation INT AUTO_INCREMENT NOT NULL,
   codeRecuperation VARCHAR(32) NOT NULL,
   idUtilisateur INT NOT NULL,
   dateHeureExpirationRecuperation DATETIME DEFAULT (CURRENT_TIMESTAMP + INTERVAL 1 DAY),
   PRIMARY KEY (idRecuperation),
   KEY (idUtilisateur),
   FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

```

## Questions

### 1. Rappelez en quoi consiste une attaque par force brute.

Une attaque par force brute consiste à essayer toutes les combinaisons possibles de mots de passe ou de clés de
chiffrement jusqu'à trouver la bonne. Cette méthode est souvent utilisée pour craquer des mots de passe en essayant
systématiquement toutes les combinaisons possibles de caractères jusqu'à ce que le bon mot de passe soit trouvé. Les
attaques par force brute peuvent être très efficaces contre des mots de passe courts ou simples, mais elles peuvent être
contrées par des mesures de sécurité telles que la limitation du nombre de tentatives de connexion et l'utilisation de
mots de passe complexes.

### 2. Proposer une modification de la base de données existante afin de permettre la gestion des comptes désactivés et des liens de réactivation des comptes.

```sql
CREATE TABLE `reactivation`
(
    `idReactivation` int(11) NOT NULL,
    `codeReactivation` varchar(32) NOT NULL,
    `idUtilisateur` int(11) NOT NULL,
    `dateHeureExpirationReactivation` datetime DEFAULT (current_timestamp() + interval 1 day)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

ALTER TABLE `reactivation`
    ADD PRIMARY KEY (`idReactivation`),
ADD KEY `idUtilisateur` (`idUtilisateur`);
```

### 3. Qu'est-ce qu'un cookie et à quoi sert-il dans le cas d'une connexion pour un utilisateur ?

Un cookie est un petit fichier texte stocké par le navigateur web sur l'ordinateur de l'utilisateur. Il
contient des informations envoyées par le serveur web et peut être utilisé pour diverses raisons,
telles que la gestion des sessions utilisateur, le suivi des préférences, et la personnalisation du
contenu. Dans le cas d'une connexion utilisateur, un cookie peut être utilisé pour stocker un jeton
d'authentification (comme un JWT) qui permet au serveur de reconnaître l'utilisateur lors de ses
futures requêtes sans avoir à se reconnecter

## Installation

1. Clonez le dépôt.
2. Installez les dépendances en utilisant Composer et npm.
3. Configurez la base de données en utilisant le schéma SQL fourni.
4. Configurez les paramètres de l'application.

## Utilisation

1. Enregistrez un nouveau compte utilisateur.
2. Connectez-vous avec le compte enregistré.
3. Activez l'authentification à deux facteurs pour une sécurité accrue.
4. Gérez la réactivation des comptes via les liens fournis.

Ce projet vise à fournir un système d'authentification sécurisé et efficace pour les applications web.
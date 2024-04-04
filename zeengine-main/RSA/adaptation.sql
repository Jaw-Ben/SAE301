DROP TABLE IF EXISTS Client CASCADE;
DROP TABLE IF EXISTS Personne CASCADE;
DROP TABLE IF EXISTS TypeVoie CASCADE;
DROP TABLE IF EXISTS Localite CASCADE;
DROP TABLE IF EXISTS TYPE CASCADE;
DROP TABLE IF EXISTS COMMERCIAL CASCADE;
DROP TABLE IF EXISTS INTERLOCUTEUR CASCADE;
DROP TABLE IF EXISTS GESTIONNAIRE CASCADE;
DROP TABLE IF EXISTS PRESTATAIRE CASCADE;
DROP TABLE IF EXISTS Adresse CASCADE;
DROP TABLE IF EXISTS Composante CASCADE;
DROP TABLE IF EXISTS BDL CASCADE;
DROP TABLE IF EXISTS Periode CASCADE;
DROP TABLE IF EXISTS Journee CASCADE;
DROP TABLE IF EXISTS DEMIJOURNEE CASCADE;
DROP TABLE IF EXISTS CRENEAU CASCADE;
DROP TABLE IF EXISTS AFFECTE CASCADE;
DROP TABLE IF EXISTS REPRESENTE CASCADE;

CREATE TABLE Client(
   id_client SERIAL,
   nomClient VARCHAR(255)  NOT NULL,
   telClient VARCHAR(10) NOT NULL,
   PRIMARY KEY(id_client)
);

CREATE TABLE Personne(
   id_personne SERIAL,
   nom VARCHAR(255)  NOT NULL,
   prenom VARCHAR(50)  NOT NULL,
   mail VARCHAR(255)  NOT NULL,
   motDePasse BYTEA  NOT NULL,
   telephone VARCHAR(10) NOT NULL,
   PRIMARY KEY(id_personne)
);

CREATE TABLE TypeVoie(
   id SERIAL,
   libelle VARCHAR(255)  NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE Localite(
   idLocalite SERIAL,
   cp INTEGER NOT NULL,
   ville VARCHAR(255)  NOT NULL,
   PRIMARY KEY(idLocalite)
);

CREATE TABLE TYPE(
   idType SERIAL,
   libelle VARCHAR(255)  NOT NULL,
   PRIMARY KEY(idType)
);

CREATE TABLE COMMERCIAL(
   id_personne INTEGER,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE INTERLOCUTEUR(
   id_personne INTEGER,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE GESTIONNAIRE(
   id_personne INTEGER,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE PRESTATAIRE(
   id_personne INTEGER,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE Adresse(
   id_adresse SERIAL,
   numero INTEGER NOT NULL,
   nomVoie VARCHAR(255)  NOT NULL,
   idLocalite INTEGER NOT NULL,
   id INTEGER NOT NULL,
   PRIMARY KEY(id_adresse),
   FOREIGN KEY(idLocalite) REFERENCES Localite(idLocalite),
   FOREIGN KEY(id) REFERENCES TypeVoie(id)
);

CREATE TABLE Composante(
   id_composante SERIAL,
   nomComposante VARCHAR(255)  NOT NULL,
   id_adresse INTEGER NOT NULL,
   id_client INTEGER NOT NULL,
   PRIMARY KEY(id_composante),
   FOREIGN KEY(id_adresse) REFERENCES Adresse(id_adresse),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE BDL(
   id_composante INTEGER,
   id_personne_1 INTEGER,
   annee INTEGER,
   mois VARCHAR(255) ,
   signatureInterlocuteur VARCHAR(255)  NOT NULL,
   signaturePrestataire VARCHAR(255)  NOT NULL,
   commentaire VARCHAR(255)  NOT NULL,
   id_personne INTEGER,
   id_personne_2 INTEGER NOT NULL,
   PRIMARY KEY(id_composante, id_personne_1, annee, mois),
   FOREIGN KEY(id_composante) REFERENCES Composante(id_composante),
   FOREIGN KEY(id_personne_1) REFERENCES PRESTATAIRE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES GESTIONNAIRE(id_personne),
   FOREIGN KEY(id_personne_2) REFERENCES INTERLOCUTEUR(id_personne)
);

CREATE TABLE Periode(
   id_composante INTEGER,
   id_personne INTEGER,
   annee INTEGER,
   mois VARCHAR(255) ,
   jourDuMois INTEGER,
   PRIMARY KEY(id_composante, id_personne, annee, mois, jourDuMois),
   FOREIGN KEY(id_composante, id_personne, annee, mois) REFERENCES BDL(id_composante, id_personne_1, annee, mois)
);

CREATE TABLE Journee(
   id_composante INTEGER,
   id_personne INTEGER,
   annee INTEGER,
   mois VARCHAR(255) ,
   jourDuMois INTEGER,
   PRIMARY KEY(id_composante, id_personne, annee, mois, jourDuMois),
   FOREIGN KEY(id_composante, id_personne, annee, mois, jourDuMois) REFERENCES Periode(id_composante, id_personne, annee, mois, jourDuMois)
);

CREATE TABLE DEMIJOURNEE(
   idType_1 INTEGER,
   idType SERIAL,
   matin BOOLEAN NOT NULL,
   id_composante INTEGER NOT NULL,
   id_personne INTEGER NOT NULL,
   annee INTEGER NOT NULL,
   mois VARCHAR(255)  NOT NULL,
   jourDuMois INTEGER NOT NULL,
   PRIMARY KEY(idType_1, idType),
   UNIQUE(jourDuMois),
   FOREIGN KEY(idType_1) REFERENCES TYPE(idType),
   FOREIGN KEY(id_composante, id_personne, annee, mois, jourDuMois) REFERENCES Periode(id_composante, id_personne, annee, mois, jourDuMois)
);

CREATE TABLE CRENEAU(
   Numero SERIAL,
   heure_arrivee TIME NOT NULL,
   heure_depart TIME NOT NULL,
   id_composante INTEGER NOT NULL,
   id_personne INTEGER NOT NULL,
   annee INTEGER NOT NULL,
   mois VARCHAR(255)  NOT NULL,
   jourDuMois INTEGER NOT NULL,
   PRIMARY KEY(Numero),
   UNIQUE(jourDuMois),
   FOREIGN KEY(id_composante, id_personne, annee, mois, jourDuMois) REFERENCES Periode(id_composante, id_personne, annee, mois, jourDuMois)
);

CREATE TABLE AFFECTE(
   id_composante INTEGER,
   id_personne INTEGER,
   PRIMARY KEY(id_composante, id_personne),
   FOREIGN KEY(id_composante) REFERENCES Composante(id_composante),
   FOREIGN KEY(id_personne) REFERENCES COMMERCIAL(id_personne)
);

CREATE TABLE REPRESENTE(
   id_composante INTEGER,
   id_personne INTEGER,
   PRIMARY KEY(id_composante, id_personne),
   FOREIGN KEY(id_composante) REFERENCES Composante(id_composante),
   FOREIGN KEY(id_personne) REFERENCES INTERLOCUTEUR(id_personne)
);

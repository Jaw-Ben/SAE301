INSERT INTO personne(nom, prenom, mail, motdepasse, telephone) VALUES ('rahmani', 'mohamed', 'm.rahmani@sasperformvision.fr', 'gestionnaire', '0612345678');
INSERT INTO personne(nom, prenom, mail, motdepasse, telephone) VALUES ('akirthan', 'nagulendran', 'a.nagulendran@sasperformvision.fr', 'prestataire', '0611223344');
INSERT INTO personne(nom, prenom, mail, motdepasse, telephone) VALUES ('jawed', 'bensaih', 'j.bensaih@sasperformvision.fr', 'interlocuteur', '0644332211');
INSERT INTO personne(nom, prenom, mail, motdepasse, telephone) VALUES ('chemsedine', 'benhaddou', 'c.benhaddou@sasperformvision.fr', 'commercial', '0622334455');
INSERT INTO personne(nom, prenom, mail, motdepasse, telephone) VALUES ('abdel-ghani', 'ghlamallah', 'a.ghlamallah@sasperformvision.fr', 'interlocuteur', '0655443322');
INSERT INTO personne(nom, prenom, mail, motdepasse, telephone) VALUES ('ryan', 'ramassamy', 'r.ramassamy@sasperformvision.fr', 'prestataire', '0633445566');

INSERT INTO gestionnaire VALUES (1);
INSERT INTO commercial VALUES (1);
INSERT INTO gestionnaire VALUES (2);
INSERT INTO prestataire VALUES (3);
INSERT INTO interlocuteur VALUES (4);
INSERT INTO commercial VALUES (5);
INSERT INTO interlocuteur VALUES (6);
INSERT INTO prestataire VALUES (7);
INSERT INTO Localite (cp, ville) VALUES
(75001, 'Paris'),
(69001, 'Lyon'),
(31000, 'Toulouse'),
(44000, 'Nantes'),
(13001, 'Marseille');
INSERT INTO TypeVoie (libelle) VALUES
('Rue'),
('Avenue'),
('Boulevard'),
('Place'),
('Impasse');
INSERT INTO Client (nomClient, telClient) VALUES
('Dupont', 123456789),
('Martin', 987654321),
('Lefevre', 555111333),
('Durand', 888777999),
('Bernard', 444222666);
INSERT INTO Adresse (numero, nomVoie, idLocalite, id) VALUES
(10, 'Rue de la Paix', 1, 1),
(25, 'Avenue des Fleurs', 2, 2),
(5, 'Boulevard Jean Jaurès', 3, 3),
(15, 'Place de la République', 4, 4),
(8, 'Impasse du Château', 5, 5);
INSERT INTO Composante (nomComposante, id_adresse, id_client) VALUES
('Tech Innovations Corp.', 1, 1),
('Global Solutions Ltd.', 2, 2),
('EcoVentures International', 3, 3),
('Precision Manufacturing Co.', 4, 4),
('Alpha Logistics Group', 5, 5);
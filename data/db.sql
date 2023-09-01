/**
 * Bases de données du projet, voir le schéma UML fourni dans le rapport pour plus une lecture plus facile
 */

DROP TABLE module CASCADE;
DROP TABLE ue CASCADE;
DROP TABLE personne CASCADE;
DROP TABLE groupe CASCADE;
DROP TABLE caracteristiques CASCADE;
DROP TABLE professeur CASCADE;
DROP TABLE eleve CASCADE;
DROP TABLE compte CASCADE;
DROP TABLE etage CASCADE;
DROP TABLE salle CASCADE;
DROP TABLE intervention CASCADE;
DROP TABLE association CASCADE;
DROP TABLE note CASCADE;
DROP TABLE reservation CASCADE;
DROP TABLE cours CASCADE;



CREATE TABLE "module" (
	id_module VARCHAR(10),
	libelle VARCHAR(256),
	CONSTRAINT pk_module PRIMARY KEY (id_module)
);

CREATE TABLE "ue" (
	id_ue VARCHAR(10),
	id_module VARCHAR(10) CONSTRAINT nn_id_module NOT NULL,
	description VARCHAR(256),
	CONSTRAINT pk_ue PRIMARY KEY (id_ue,id_module),
	CONSTRAINT fk_module_ue FOREIGN KEY (id_module) REFERENCES module(id_module)
);

CREATE TABLE "personne" (
	id_personne VARCHAR(10),
	nom VARCHAR(256),
	prenom VARCHAR(256),
	CONSTRAINT pk_personne PRIMARY KEY (id_personne)
);

CREATE TABLE "groupe" (
	id_groupe VARCHAR(3),
	CONSTRAINT pk_groupe PRIMARY KEY (id_groupe)
);

CREATE TABLE "caracteristiques" (
	id_carac VARCHAR(10),
	nb_places INTEGER,
	CONSTRAINT pk_caracteristiques PRIMARY KEY (id_carac)
);


CREATE TABLE "professeur" (
	id_professeur VARCHAR(10),
	CONSTRAINT pk_professeur PRIMARY KEY (id_professeur),
	CONSTRAINT fk_personne_prof FOREIGN KEY (id_professeur) REFERENCES personne(id_personne)
);

CREATE TABLE "eleve" (
	id_eleve VARCHAR(10),
	pseudo VARCHAR(256),
	id_groupe VARCHAR(3) CONSTRAINT nn_id_groupe NOT NULL,
	CONSTRAINT pk_eleve PRIMARY KEY (id_eleve),
	CONSTRAINT fk_personne_elev FOREIGN KEY (id_eleve) REFERENCES personne(id_personne),
	CONSTRAINT fk_groupe_elev FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe)
);

CREATE VIEW v_prof(id_professeur) AS
SELECT id_personne,nom,prenom
FROM personne,professeur
WHERE personne.id_personne = professeur.id_professeur;

CREATE VIEW v_eleve(id_eleve,pseudo) AS
SELECT id_personne,pseudo,nom,prenom
FROM personne,eleve
WHERE personne.id_personne = eleve.id_eleve;


CREATE TABLE "compte" (
	login VARCHAR(256),
	mdp VARCHAR(256),
	id_personne VARCHAR(10),
	CONSTRAINT pk_compte PRIMARY KEY (login),
	CONSTRAINT fk_personne_com FOREIGN KEY (id_personne) REFERENCES personne(id_personne)
);

CREATE TABLE "etage" (
	num_etage INTEGER,
	CONSTRAINT pk_etage PRIMARY KEY (num_etage)
);

CREATE TABLE "salle" (
	id_salle INTEGER,
	num_etage INTEGER CONSTRAINT nn_num_etage NOT NULL,
	salle VARCHAR(20) CHECK(salle IN ('TP','TD','WC','AMPHI','LOCAL')),
	id_carac VARCHAR(10) CONSTRAINT nn_id_carac NOT NULL,

	CONSTRAINT pk_salle PRIMARY KEY (id_salle),
	CONSTRAINT fk_etage_sal FOREIGN KEY (num_etage) REFERENCES etage(num_etage),
	CONSTRAINT fk_caracteristiques_sal FOREIGN KEY (id_carac) REFERENCES caracteristiques(id_carac)
);

CREATE TABLE "intervention" (
	id_inter SERIAL PRIMARY KEY,
	date_inter TIMESTAMP,
	type VARCHAR(10) CHECK(type IN ('TP','TD','COURS')),
	id_professeur VARCHAR(10) CONSTRAINT nn_id_professeur NOT NULL,
	id_module VARCHAR(10) CONSTRAINT nn_id_module NOT NULL,
	id_salle INTEGER,
	CONSTRAINT fk_professeur_inter FOREIGN KEY (id_professeur) REFERENCES professeur(id_professeur),
	CONSTRAINT fk_module_inter FOREIGN KEY (id_module) REFERENCES module(id_module),
	CONSTRAINT fk_salle_inter FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);

CREATE TABLE "association" (
	nom_assoc VARCHAR,
	id_prez VARCHAR(10) CONSTRAINT nn_id_prez NOT NULL,
	id_salle INTEGER,
	image VARCHAR(50),
	CONSTRAINT pk_association PRIMARY KEY (nom_assoc),
	CONSTRAINT fk_personne_president_assoc FOREIGN KEY (id_prez) REFERENCES eleve(id_eleve),
	CONSTRAINT fk_salle_assoc FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);

CREATE TABLE "note" (
	date_not TIMESTAMP ,
	id_personne VARCHAR(10) CONSTRAINT nn_id_personne NOT NULL,
	id_salle INTEGER CONSTRAINT nn_id_salle NOT NULL,
	note_sur_5 INTEGER,
	luminosite INTEGER,
	acces_hand INTEGER,
	proprete INTEGER,
	CONSTRAINT pk_note PRIMARY KEY (date_not,id_personne,id_salle),
	CONSTRAINT fk_personne_note FOREIGN KEY (id_personne) REFERENCES personne(id_personne),
	CONSTRAINT fk_salle_note FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);

CREATE TABLE "reservation" (
	date_hist_res TIMESTAMP,
	id_personne VARCHAR(10) CONSTRAINT nn_id_personne NOT NULL,
	id_salle INTEGER CONSTRAINT nn_id_salle NOT NULL,
	date_reservation TIMESTAMP,
	description VARCHAR(256),
	statut VARCHAR(6) CHECK(statut IN ('PRIVÉ','PUBLIC')),
	CONSTRAINT pk_reservation PRIMARY KEY (date_hist_res,id_personne,id_salle,date_reservation),
	CONSTRAINT fk_personne_res FOREIGN KEY (id_personne) REFERENCES personne(id_personne),
	CONSTRAINT fk_salle_res FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);

CREATE TABLE "cours" (
	id_groupe VARCHAR(3),
	id_inter INTEGER,
	CONSTRAINT pk_cours PRIMARY KEY (id_groupe,id_inter),
	CONSTRAINT fk_cours_groupe FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe),
	CONSTRAINT fk_cours_intervention FOREIGN KEY (id_inter) REFERENCES intervention(id_inter)
);


DELETE FROM module;
DELETE FROM ue;
DELETE FROM personne;
DELETE FROM groupe;
DELETE FROM caracteristiques;
DELETE FROM professeur;
DELETE FROM eleve;
DELETE FROM intervention;
DELETE FROM compte;
DELETE FROM etage;
DELETE FROM salle;
DELETE FROM association;
DELETE FROM note;
DELETE FROM reservation;
DELETE FROM cours;


\copy module FROM 'data/fill_module.csv' WITH DELIMITER AS ','
\copy ue FROM 'data/fill_ue.csv' WITH DELIMITER AS ','
\copy personne FROM 'data/fill_personne.csv' WITH DELIMITER AS ','
\copy groupe FROM 'data/fill_groupe.csv' WITH DELIMITER AS ','
\copy caracteristiques FROM 'data/fill_caracteristiques.csv' WITH DELIMITER AS ','
\copy professeur FROM 'data/fill_professeur.csv' WITH DELIMITER AS ','
\copy eleve FROM 'data/fill_eleve.csv' WITH DELIMITER AS ','
\copy compte FROM 'data/fill_compte.csv' WITH DELIMITER AS ','
\copy etage FROM 'data/fill_etage.csv' WITH DELIMITER AS ','
\copy salle FROM 'data/fill_salle.csv' WITH DELIMITER AS ','
\copy intervention FROM 'data/fill_intervention.csv' WITH DELIMITER AS ','
\copy association FROM 'data/fill_association.csv' WITH DELIMITER AS ','
\copy note FROM 'data/fill_note.csv' WITH DELIMITER AS ','
\copy reservation FROM 'data/fill_reservation.csv' WITH DELIMITER AS ','
\copy cours FROM 'data/fill_cours.csv' WITH DELIMITER AS ','




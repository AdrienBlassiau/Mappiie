DROP TABLE module CASCADE;
DROP TABLE semestre CASCADE;
DROP TABLE ue CASCADE;
DROP TABLE personne CASCADE;
DROP TABLE groupe CASCADE;
DROP TABLE caracteristiques CASCADE;
DROP TABLE professeur CASCADE;
DROP TABLE eleve CASCADE;
DROP TABLE intervention CASCADE;
DROP TABLE compte CASCADE;
DROP TABLE etage CASCADE;
DROP TABLE salle CASCADE;
DROP TABLE association CASCADE;
DROP TABLE tableau CASCADE;
DROP TABLE note CASCADE;
DROP TABLE reservation CASCADE;
DROP TABLE chemin CASCADE;
DROP TABLE cours CASCADE;



CREATE TABLE "module" (
	id_module VARCHAR(10),
	libelle VARCHAR(256),
	CONSTRAINT pk_module PRIMARY KEY (id_module)
);

CREATE TABLE "semestre" (
	id_sem INTEGER,
	CONSTRAINT pk_semestre PRIMARY KEY (id_sem)
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
	luminosite INTEGER,
	nb_fenetres INTEGER,
	acces_hand INTEGER,
	nb_places INTEGER,
	proprete INTEGER,
	id_personne VARCHAR(10),
	CONSTRAINT pk_caracteristiques PRIMARY KEY (id_carac),
	CONSTRAINT fk_personne_carac FOREIGN KEY (id_personne) REFERENCES personne(id_personne)
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


CREATE TABLE "intervention" (
	id_inter VARCHAR(10),
	date_inter TIMESTAMP,
	duree INTEGER,
	type VARCHAR(10) CHECK(type IN ('TP','TD','COURS')),
	id_professeur VARCHAR(10) CONSTRAINT nn_id_professeur NOT NULL,
	id_sem INTEGER CONSTRAINT nn_id_sem NOT NULL,
	id_module VARCHAR(10) CONSTRAINT nn_id_module NOT NULL,
	CONSTRAINT pk_intervention PRIMARY KEY (id_inter),
	CONSTRAINT fk_professeur_inter FOREIGN KEY (id_professeur) REFERENCES professeur(id_professeur),
	CONSTRAINT fk_semestre_inter FOREIGN KEY (id_sem) REFERENCES semestre(id_sem),
	CONSTRAINT fk_module_inter FOREIGN KEY (id_module) REFERENCES module(id_module)
);

CREATE TABLE "compte" (
	login VARCHAR(256),
	mdp VARCHAR,
	id_personne VARCHAR(10),
	CONSTRAINT pk_compte PRIMARY KEY (login),
	CONSTRAINT fk_personne_com FOREIGN KEY (id_personne) REFERENCES personne(id_personne)
);

CREATE TABLE "etage" (
	num_etage INTEGER,
	CONSTRAINT pk_etage PRIMARY KEY (num_etage)
);

CREATE TABLE "salle" (
	id_salle VARCHAR(10),
	num_etage INTEGER CONSTRAINT nn_num_etage NOT NULL,
	salle VARCHAR(20) CHECK(salle IN ('TP','TD','WC','AMPHI','LOCAL')),
	id_carac VARCHAR(10) CONSTRAINT nn_id_carac NOT NULL,

	CONSTRAINT pk_salle PRIMARY KEY (id_salle),
	CONSTRAINT fk_etage_sal FOREIGN KEY (num_etage) REFERENCES etage(num_etage),
	CONSTRAINT fk_caracteristiques_sal FOREIGN KEY (id_carac) REFERENCES caracteristiques(id_carac)
);

CREATE TABLE "association" (
	nom_assoc VARCHAR,
	id_prez VARCHAR(10) CONSTRAINT nn_id_prez NOT NULL,
	id_salle VARCHAR(10),
	CONSTRAINT pk_association PRIMARY KEY (nom_assoc),
	CONSTRAINT fk_personne_president_assoc FOREIGN KEY (id_prez) REFERENCES eleve(id_eleve),
	CONSTRAINT fk_salle_assoc FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);


CREATE TABLE "tableau" (
	type_tab VARCHAR(10) CHECK(type_tab IN ('SIMPLE','DOUBLE')),
	type_ecriture VARCHAR(10) CHECK(type_ecriture IN ('CRAIE','FEUTRE')),
	id_carac VARCHAR(10),
	CONSTRAINT pk_tableau PRIMARY KEY (type_tab,type_ecriture,id_carac),
	CONSTRAINT fk_caracteristiques_tab FOREIGN KEY (id_carac) REFERENCES caracteristiques(id_carac)
);

CREATE TABLE "note" (
	date_not TIMESTAMP ,
	id_personne VARCHAR(10) CONSTRAINT nn_id_personne NOT NULL,
	id_salle VARCHAR(10) CONSTRAINT nn_id_salle NOT NULL,
	note_sur_10 INTEGER,
	CONSTRAINT pk_note PRIMARY KEY (date_not,id_personne,id_salle),
	CONSTRAINT fk_personne_note FOREIGN KEY (id_personne) REFERENCES personne(id_personne),
	CONSTRAINT fk_salle_note FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);

CREATE TABLE "reservation" (
	date_res TIMESTAMP,
	duree INTEGER,
	id_personne VARCHAR(10) CONSTRAINT nn_id_personne NOT NULL,
	id_salle VARCHAR(10) CONSTRAINT nn_id_salle NOT NULL,

	CONSTRAINT pk_reservation PRIMARY KEY (date_res,duree,id_personne,id_salle),
	CONSTRAINT fk_personne_res FOREIGN KEY (id_personne) REFERENCES personne(id_personne),
	CONSTRAINT fk_salle_res FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);

CREATE TABLE "chemin" (
	date_che TIMESTAMP,
	id_personne VARCHAR(10) CONSTRAINT nn_id_personne NOT NULL,
	id_salle VARCHAR(10) CONSTRAINT nn_id_salle NOT NULL,
	info_chemin VARCHAR(10),

	CONSTRAINT pk_chemin PRIMARY KEY (date_che,id_personne,id_salle),
	CONSTRAINT fk_personne_chem FOREIGN KEY (id_personne) REFERENCES personne(id_personne),
	CONSTRAINT fk_salle_chem FOREIGN KEY (id_salle) REFERENCES salle(id_salle)
);

CREATE TABLE "cours" (
	id_groupe VARCHAR(3),
	id_inter VARCHAR(10),
	CONSTRAINT pk_cours PRIMARY KEY (id_groupe,id_inter),
	CONSTRAINT fk_cours_groupe FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe),
	CONSTRAINT fk_cours_intervention FOREIGN KEY (id_inter) REFERENCES intervention(id_inter)
);


DELETE FROM module;
DELETE FROM semestre;
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
DELETE FROM tableau;
DELETE FROM note;
DELETE FROM reservation;
DELETE FROM chemin;
DELETE FROM cours;


\copy module FROM 'fill_module.csv' WITH DELIMITER AS ','
\copy semestre FROM 'fill_semestre.csv' WITH DELIMITER AS ','
\copy ue FROM 'fill_ue.csv' WITH DELIMITER AS ','
\copy personne FROM 'fill_personne.csv' WITH DELIMITER AS ','
\copy groupe FROM 'fill_groupe.csv' WITH DELIMITER AS ','
\copy caracteristiques FROM 'fill_caracteristiques.csv' WITH DELIMITER AS ','
\copy professeur FROM 'fill_professeur.csv' WITH DELIMITER AS ','
\copy eleve FROM 'fill_eleve.csv' WITH DELIMITER AS ','
\copy intervention FROM 'fill_intervention.csv' WITH DELIMITER AS ','
\copy compte FROM 'fill_compte.csv' WITH DELIMITER AS ','
\copy etage FROM 'fill_etage.csv' WITH DELIMITER AS ','
\copy salle FROM 'fill_salle.csv' WITH DELIMITER AS ','
\copy association FROM 'fill_association.csv' WITH DELIMITER AS ','
\copy tableau FROM 'fill_tableau.csv' WITH DELIMITER AS ','
\copy note FROM 'fill_note.csv' WITH DELIMITER AS ','
\copy reservation FROM 'fill_reservation.csv' WITH DELIMITER AS ','
\copy chemin FROM 'fill_chemin.csv' WITH DELIMITER AS ','
\copy cours FROM 'fill_cours.csv' WITH DELIMITER AS ','




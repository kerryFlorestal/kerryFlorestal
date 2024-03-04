
Drop database if exists medical;
Create database medical;
use medical;


CREATE TABLE Patient(
        idpatient Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        prenom    Varchar (50) NOT NULL ,
        adresse   Varchar (50) NOT NULL ,
        telephone Varchar (50) NOT NULL ,
        email     Varchar (50) NOT NULL ,
	PRIMARY KEY (idpatient)
	);




CREATE TABLE Medecin(
        idMedecin Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        prenom    Varchar (50) NOT NULL ,
        telephone Varchar (50) NOT NULL ,
        email     Varchar (50) NOT NULL,
	PRIMARY KEY (idMedecin)
	);



CREATE TABLE RDV(
        idRDV       Int  Auto_increment  NOT NULL ,
        dateRDV     Date NOT NULL ,
        description Varchar (50) NOT NULL ,
        heureRDV    Varchar (50) NOT NULL ,
        statut      Varchar (50) NOT NULL ,
        idpatient   Int NOT NULL ,
        idMedecin   Int NOT NULL,
	PRIMARY KEY (idRDV),

	FOREIGN KEY (idpatient) REFERENCES Patient(idpatient),
	FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin)
	);



CREATE TABLE Ordonance(
        idordonance   Int  Auto_increment  NOT NULL ,
        dateOrdonance Date NOT NULL ,
        description   Varchar (50) NOT NULL ,
        idMedecin     Int NOT NULL,
	PRIMARY KEY (idordonance),

	FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin)
	);

CREATE TABLE medicament(
        idmedicament Int  Auto_increment  NOT NULL ,
        nom          Varchar (50) NOT NULL ,
        description  Varchar (50) NOT NULL ,
        utilisation  Varchar (50) NOT NULL ,
        idordonance  Int NOT NULL,
	PRIMARY KEY (idmedicament),

	FOREIGN KEY (idordonance) REFERENCES Ordonance(idordonance)
	);



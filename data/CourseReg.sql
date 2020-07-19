DROP DATABASE IF EXISTS Registrar;
CREATE DATABASE Registrar;
USE Registrar;

-- create table STUDENTS
create table STUDENTS (
	StudentID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	FName CHAR(20) NOT NULL,
    Sex CHAR(1) NOT NULL,
    PhoneNumber INT NOT NULL,
    Email VARCHAR (35) NOT NULL,
    StudentType CHAR(2) NULL

) Engine=InnoDB;

insert into STUDENTS (FacilityName, description) values ('Meeting Room', 'A small room with access to internet and power outlet. Maximum occupation is 10 persons');
insert into STUDENTS (FacilityName, description) values ('Classroom', 'A normal classroom with access to internet, power outlet, presenter desktop and projector. Maximum occupation is 50 persons');
insert into STUDENTS (FacilityName, description) values ('High-Tech Room', 'A high tech classroom with access to separate wireless hub, smart power outlet, smart light, audio, high resolution projector, air purifier and security. Maximum occupation is 25 persons');
insert into STUDENTS (FacilityName, description) values ('Auditorium', 'A big room for seminar with wide screen for presentation, AV recording, and multiple entrance/access. Maximum occupation is 150 persons');
insert into STUDENTS (FacilityName, description) values ('Party Room', 'A room with a few kitchen utensils, a small fridge and dish sink. Maximum occupation is 50 persons');

-- create table COURSES
create table COURSES (
	CRN SMALLINT(5) AUTO_INCREMENT PRIMARY KEY,
	Credits Int(1),
	Subject VARCHAR(35),
	Title CHAR(25),
	InstructorID INT,
    -- CHANGED PREREQUISITES TO PREREQ (Joel)
	Prereq BIT NOT NULL DEFAULT 0,
    -- WHAT ARE SESSION NOTES? (Joel)
    --CHANGED TAKING TIME TO COURSE DURATION (Joel)
	CourseDuration TIME NOT NULL,
	FOREIGN KEY (InstructorID) REFERENCES INSTRUCTOR (InstructorID) ON DELETE NO ACTION ON UPDATE CASCADE
) Engine=InnoDB;

-- STOPPED CODING HERE (Joel)

-- insert into reservation table
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (1, 'Collete Brownlee', 'cbrownlee0@mit.edu', 3, '2020-11-07', 7, 'Class Discussion');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (2, 'Obediah Dupree', 'odupree1@addtoany.com', 3, '2020-09-25', 5, 'Midterm Study');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (3, 'Joane Gouldstraw', 'jgouldstraw2@apache.org', 1, '2020-12-13', 7, 'Class Discussion');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (4, 'Chickie Trueman', 'ctrueman3@berkeley.edu', 2, '2020-10-15', 2, 'Midterm Study');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (5, 'Juliann Goslin', 'jgoslin4@mayoclinic.com', 1, '2020-11-13', 5, 'Tutorial');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (6, 'Conchita Flowith', 'cflowith5@github.com', 4, '2020-09-20', 4, 'Project presentation');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (7, 'Nora Teaser', 'nteaser6@ifeng.com', 5, '2020-10-11', 3, 'Midterm Study');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (8, 'Adena Gonnin', 'agonnin7@shareasale.com', 4, '2020-08-09', 1, 'Tutorial');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (9, 'Hyacinthe Fisby', 'hfisby8@istockphoto.com', 1, '2020-11-02', 3, 'Project presentation');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (10, 'Emili Middle', 'emiddle9@europa.eu', 1, '2020-12-03', 3, 'Project presentation');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (11, 'Goldarina Hark', 'gharka@jigsy.com', 5, '2020-09-06', 5, 'Project Meeting');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (12, 'Evy Hawthorn', 'ehawthornb@yahoo.co.jp', 4, '2020-08-23', 2, 'Graduation Party');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (13, 'Lurleen Standering', 'lstanderingc@vimeo.com', 4, '2020-10-24', 7, 'Project Meeting');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (14, 'Maxie Allgood', 'mallgoodd@i2i.jp', 2, '2020-12-14', 1, 'Project presentation');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (15, 'Meaghan Dufour', 'mdufoure@miibeian.gov.cn', 3, '2020-09-20', 5, 'Tutorial');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (16, 'Marwin Whitman', 'mwhitmanf@posterous.com', 5, '2020-07-14', 3, 'Tutorial');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (17, 'Luther Grogona', 'lgrogonag@chicagotribune.com', 5, '2020-10-20', 1, 'Class Discussion');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (18, 'Ruben McCoid', 'rmccoidh@illinois.edu', 1, '2020-10-13', 1, 'Graduation Party');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (19, 'Amy Simmell', 'asimmelli@cloudflare.com', 4, '2020-12-17', 2, 'Project presentation');
insert into reservation (ReservationID, name, email, FacilityID, ReservationDate , Length, Venue) values (20, 'Darcee Garbutt', 'dgarbuttj@usgs.gov', 3, '2020-09-12', 5, 'Midterm Study');

DESC facility; 
SELECT COUNT(*) FROM facility; -- 5
SELECT * FROM facility;

DESC reservation;
SELECT COUNT(*) FROM reservation; -- 20
SELECT * FROM reservation;


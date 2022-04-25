CREATE TABLE Coordinator(
Username CHAR(20),
Password CHAR(20), 
PRIMARY KEY (Username));

CREATE TABLE TrainingManager(
Username CHAR(20),
Password CHAR(20),
PRIMARY KEY (Username));

CREATE TABLE JobTraining(
ID CHAR(20),
Topic CHAR(40),
Dates CHAR(20),
PRIMARY KEY (ID));

CREATE TABLE TProvideJ(
TUsername CHAR(20),
JobTrainingID CHAR(20),
PRIMARY KEY (TUsername, JobTrainingID),
FOREIGN KEY (TUsername) REFERENCES TrainingManager,
FOREIGN KEY (JobTrainingID) REFERENCES JobTraining);

CREATE TABLE JobSeeker1(
SIN CHAR(20),
Name CHAR(20),
PRIMARY KEY (SIN));

CREATE TABLE JobSeeker2(
SIN CHAR(20),
Address CHAR(40),
ID CHAR(20),
PRIMARY KEY (ID),
FOREIGN KEY (SIN) REFERENCES JobSeeker1(SIN) ON DELETE CASCADE,
UNIQUE (SIN));

CREATE TABLE JTargetJ(
JobTrainingID CHAR(20),
JobSeekerID CHAR(20),
PRIMARY KEY (JobTrainingID, JobSeekerID),
FOREIGN KEY (JobTrainingID) REFERENCES JobTraining,
FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker2);

CREATE TABLE CManageJ(
CoordinatorUsername CHAR(20),
JobSeekerID CHAR(20),
PRIMARY KEY (CoordinatorUsername, JobSeekerID),
FOREIGN KEY (CoordinatorUsername) REFERENCES Coordinator,
FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker2);

CREATE TABLE Job(
ID CHAR(20),
Name CHAR(20),
Requirement CHAR(40),
TimeLength INT,
PRIMARY KEY (ID));

CREATE TABLE ApplicationSubTar(
ApplicationID CHAR(20),
Dates CHAR(20),
JobID CHAR(20) NOT NULL,
JobSeekerID CHAR(20) NOT NULL,
PRIMARY KEY (ApplicationID),
FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker2,
FOREIGN KEY (JobID) REFERENCES Job);

CREATE TABLE Interview1(
Interviewer CHAR(20) ,
Time CHAR(20),
PRIMARY KEY(Interviewer, time));

CREATE TABLE Interview2(
Interviewer CHAR(20) ,
time CHAR(20),
InterviewID CHAR(20),
PRIMARY KEY(InterviewID),
FOREIGN KEY(Interviewer, time) REFERENCES Interview1(Interviewer, time));

CREATE TABLE Employer(
ID CHAR(20),
Name CHAR(20),
Address CHAR(40),
PRIMARY KEY (ID));

CREATE TABLE EProvideJ(
InterviewID CHAR(20),
EmployerID CHAR(20),
PRIMARY KEY (InterviewID, EmployerID),
FOREIGN KEY (InterviewID) REFERENCES Interview2,
FOREIGN KEY (EmployerID) REFERENCES Employer(ID) ON DELETE CASCADE);

CREATE TABLE Post(
EmployerID CHAR(20),
JobID CHAR(20),
Dates CHAR(20),
PRIMARY KEY (EmployerID, JobID),
FOREIGN KEY (EmployerID) REFERENCES Employer(ID) ON DELETE CASCADE,
FOREIGN KEY (JobID) REFERENCES Job);

CREATE TABLE ResearchInstitute(
EmployerID CHAR(20),
StudyField CHAR(20),
PRIMARY KEY (EmployerID),
FOREIGN KEY (EmployerID) REFERENCES Employer(ID) ON DELETE CASCADE);

CREATE TABLE Enterprise(
EmployerID CHAR(20),
IndustryType CHAR(20),
PRIMARY KEY (EmployerID),
FOREIGN KEY (EmployerID) REFERENCES Employer(ID) ON DELETE CASCADE);

CREATE TABLE IInviteJ(
JobSeekerID CHAR(20),
InterviewID CHAR(20),
PRIMARY KEY (JobSeekerID, InterviewID),
FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker2,
FOREIGN KEY (InterviewID) REFERENCES Interview2);

CREATE TABLE ITargetJ(
InterviewID CHAR(20),
JobID CHAR(20),
PRIMARY KEY (InterviewID, JobID),
FOREIGN KEY (InterviewID) REFERENCES Interview2,
FOREIGN KEY (JobID) REFERENCES Job);

CREATE TABLE Review(
EmployerID CHAR(20),
ApplicationID CHAR(20),
PRIMARY KEY (EmployerID, ApplicationID),
FOREIGN KEY (EmployerID) REFERENCES Employer(ID) ON DELETE CASCADE,
FOREIGN KEY (ApplicationID) REFERENCES ApplicationSubTar);

INSERT INTO Coordinator VALUES ('co01', '1105a');
INSERT INTO Coordinator VALUES ('co02', '2206b');
INSERT INTO Coordinator VALUES ('co03', '3307c');
INSERT INTO Coordinator VALUES ('co04', '4408d');
INSERT INTO Coordinator VALUES ('co05', '5509e');

INSERT INTO TrainingManager VALUES ('tm01', '2205a');
INSERT INTO TrainingManager VALUES ('tm02', '3306b');
INSERT INTO TrainingManager VALUES ('tm03', '4407c');
INSERT INTO TrainingManager VALUES ('tm04', '5508d');
INSERT INTO TrainingManager VALUES ('tm05', '6609e');

INSERT INTO JobTraining VALUES ('JT01', 'Resume', '2021-9-10');
INSERT INTO JobTraining VALUES ('JT02', 'Coverletter', '2021-9-20');
INSERT INTO JobTraining VALUES ('JT03', 'Build up Relationship', '2021-10-5');
INSERT INTO JobTraining VALUES ('JT04', 'Interview', '2021-10-20');
INSERT INTO JobTraining VALUES ('JT05', 'Nogotiate Offer', '2021-11-5');

INSERT INTO TProvideJ VALUES ('tm01', 'JT01');
INSERT INTO TProvideJ VALUES ('tm02', 'JT02');
INSERT INTO TProvideJ VALUES ('tm03', 'JT03');
INSERT INTO TProvideJ VALUES ('tm04', 'JT04');
INSERT INTO TProvideJ VALUES ('tm05', 'JT05');

INSERT INTO JobSeeker1 VALUES ('121998', 'Rick');
INSERT INTO JobSeeker1 VALUES ('82597', 'Kris');
INSERT INTO JobSeeker1 VALUES ('72899', 'Doris');
INSERT INTO JobSeeker1 VALUES ('110700', 'Helena');
INSERT INTO JobSeeker1 VALUES ('42598', 'Danica');
INSERT INTO JobSeeker1 VALUES ('999999', 'Jack Ofalltrade');

INSERT INTO JobSeeker2 VALUES ('121998', 'Vancouver, Canada', 'a1101');
INSERT INTO JobSeeker2 VALUES ('82597', 'Toronto, Canada', 'a1102');
INSERT INTO JobSeeker2 VALUES ('72899', 'Vancouver, Canada', 'a1103');
INSERT INTO JobSeeker2 VALUES ('110700', 'Pennsylvania, United States', 'a1104');
INSERT INTO JobSeeker2 VALUES ('42598', 'Vancouver, Canada', 'a1105');
INSERT INTO JobSeeker2 VALUES ('999999', 'Vancouver, Canada', 'a1106');

INSERT INTO JTargetJ VALUES ('JT01', 'a1101');
INSERT INTO JTargetJ VALUES ('JT02', 'a1102');
INSERT INTO JTargetJ VALUES ('JT03', 'a1103');
INSERT INTO JTargetJ VALUES ('JT04', 'a1104');
INSERT INTO JTargetJ VALUES ('JT05', 'a1105');
INSERT INTO JTargetJ VALUES ('JT01', 'a1106');
INSERT INTO JTargetJ VALUES ('JT02', 'a1106');
INSERT INTO JTargetJ VALUES ('JT03', 'a1106');
INSERT INTO JTargetJ VALUES ('JT04', 'a1106');
INSERT INTO JTargetJ VALUES ('JT05', 'a1106');

INSERT INTO CManageJ VALUES ('co01', 'a1101');
INSERT INTO CManageJ VALUES ('co02', 'a1102');
INSERT INTO CManageJ VALUES ('co03', 'a1103');
INSERT INTO CManageJ VALUES ('co04', 'a1104');
INSERT INTO CManageJ VALUES ('co05', 'a1105');

INSERT INTO Job VALUES ('J01', 'Teaching Assistant', 'Patient', 6);
INSERT INTO Job VALUES ('J02', 'Research Assistant', 'Machine Learning skill', 4);
INSERT INTO Job VALUES ('J03', 'Software Engineer', 'Proficient skill in C++ and C', 4);
INSERT INTO Job VALUES ('J04', 'Data Analysis', 'Strong SQL background', 8);
INSERT INTO Job VALUES ('J05', 'Project Manager', 'Fluent in English communication', 4);
INSERT INTO Job VALUES ('J06', 'Project Manager', 'Fluent in English communication', 10);
INSERT INTO Job VALUES ('J07', 'Data Analysis', 'Strong SQL background', 11);

INSERT INTO ApplicationSubTar VALUES ('ap01', '2021-10-1', 'J01', 'a1101');
INSERT INTO ApplicationSubTar VALUES ('ap02', '2021-10-2', 'J02', 'a1102');
INSERT INTO ApplicationSubTar VALUES ('ap03', '2021-10-3', 'J03', 'a1103');
INSERT INTO ApplicationSubTar VALUES ('ap04', '2021-10-4', 'J04', 'a1104');
INSERT INTO ApplicationSubTar VALUES ('ap05', '2021-10-5', 'J05', 'a1105');

INSERT INTO Interview1 VALUES ('Geoage', '2021-10-15-12:00');
INSERT INTO Interview1 VALUES ('Zhili Chen', '2021-10-16-12:01');
INSERT INTO Interview1 VALUES ('Elena', '2021-10-17-12:02');
INSERT INTO Interview1 VALUES ('Harry', '2021-10-18-12:03');
INSERT INTO Interview1 VALUES ('William', '2021-10-19-12:04');

INSERT INTO Interview2 VALUES ('Geoage', '2021-10-15-12:00', 'in01');
INSERT INTO Interview2 VALUES ('Zhili Chen', '2021-10-16-12:01', 'in02');
INSERT INTO Interview2 VALUES ('Elena', '2021-10-17-12:02', 'in03');
INSERT INTO Interview2 VALUES ('Harry', '2021-10-18-12:03', 'in04');
INSERT INTO Interview2 VALUES ('William', '2021-10-19-12:04', 'in05');

INSERT INTO Employer VALUES ('E00001', 'USBC', 'Vancouver, Canada');
INSERT INTO Employer VALUES ('E00002', 'SFIT', 'Vancouver, Canada');
INSERT INTO Employer VALUES ('E00003', 'RVMP', 'Vancouver, Canada');
INSERT INTO Employer VALUES ('E00004', 'Epsilon', 'LosSanto, United States');
INSERT INTO Employer VALUES ('E00005', 'MoonLife', 'Toronto, Canada');
INSERT INTO Employer VALUES ('E00006', 'Escape Treasure', 'Hangzhou, China');
INSERT INTO Employer VALUES ('E00007', 'EHub', 'California, United States');
INSERT INTO Employer VALUES ('E00008', 'MoonRise Farm', 'Surrey, Canada');
INSERT INTO Employer VALUES ('E00009', 'Autolife', 'Toronto, Canada');
INSERT INTO Employer VALUES ('E00010', 'ExcellentStore', 'Brampton, Canada');

INSERT INTO EProvideJ VALUES ('in01', 'E00001');
INSERT INTO EProvideJ VALUES ('in02', 'E00005');
INSERT INTO EProvideJ VALUES ('in03', 'E00006');
INSERT INTO EProvideJ VALUES ('in04', 'E00008');
INSERT INTO EProvideJ VALUES ('in05', 'E00010');

INSERT INTO Post VALUES ('E00001', 'J01', '2021-9-10');
INSERT INTO Post VALUES ('E00005', 'J02', '2021-9-10');
INSERT INTO Post VALUES ('E00006', 'J03', '2021-9-11');
INSERT INTO Post VALUES ('E00008', 'J04', '2021-9-9');
INSERT INTO Post VALUES ('E00010', 'J05', '2021-9-10');

INSERT INTO ResearchInstitute VALUES ('E00001', 'SQL Database');
INSERT INTO ResearchInstitute VALUES ('E00002', 'Psychology');
INSERT INTO ResearchInstitute VALUES ('E00003', 'Criminology');
INSERT INTO ResearchInstitute VALUES ('E00004', 'Theology');
INSERT INTO ResearchInstitute VALUES ('E00005', 'Actuarial Science');

INSERT INTO Enterprise VALUES ('E00006', 'E-Business');
INSERT INTO Enterprise VALUES ('E00007', 'E-Business');
INSERT INTO Enterprise VALUES ('E00008', 'Agriculture');
INSERT INTO Enterprise VALUES ('E00009', 'Insurance');
INSERT INTO Enterprise VALUES ('E00010', 'Retail');

INSERT INTO IInviteJ VALUES ('a1101', 'in01');
INSERT INTO IInviteJ VALUES ('a1102', 'in02');
INSERT INTO IInviteJ VALUES ('a1103', 'in03');
INSERT INTO IInviteJ VALUES ('a1104', 'in04');
INSERT INTO IInviteJ VALUES ('a1105', 'in05');

INSERT INTO ITargetJ VALUES ('in01', 'J01');
INSERT INTO ITargetJ VALUES ('in02', 'J02');
INSERT INTO ITargetJ VALUES ('in03', 'J03');
INSERT INTO ITargetJ VALUES ('in04', 'J04');
INSERT INTO ITargetJ VALUES ('in05', 'J05');

INSERT INTO Review VALUES ('E00001', 'ap01');
INSERT INTO Review VALUES ('E00005', 'ap02');
INSERT INTO Review VALUES ('E00006', 'ap03');
INSERT INTO Review VALUES ('E00008', 'ap04');
INSERT INTO Review VALUES ('E00010', 'ap05');
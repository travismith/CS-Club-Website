CREATE DATABASE MSUCSClub;

CREATE TABLE `People`
(
	Username varchar(30) NOT NULL,
	EMail varchar(50) NOT NULL,
	
	FirstName varchar(30) NOT NULL,
	LastName varchar(30) NOT NULL,

	CSClubID int NOT NULL AUTO_INCREMENT,
	AccountType int NOT NULL,

	/*
		Account Type
		0 - Guest
		10 - Guest Account
		20 - User
		30 - Tutor
		40 - Officer
		50 - Advisor
		60 - Developer
		70 - President
	*/

	
	PasswordHash varchar(255) NOT NULL,
	JoinedOn datetime NOT NULL,

	PRIMARY KEY (CSClubID),

	/* Optional */

	Phone varchar(15),
	Birthday date,

	StudentAthlete BOOL,
	Sport varchar(50),
	Semester int,

	Major varchar(100)
);

CREATE TABLE `Notification`
(
	NotificationID int NOT NULL AUTO_INCREMENT,
	Receiver_CSClubID int NOT NULL,

	NotificationType varchar(50) NOT NULL,
	NotificationName varchar(50) NOT NULL,
	NotificationDate datetime NOT NULL,
	NotificationContent varchar(255) NOT NULL,

	PRIMARY KEY (ID),
	FOREIGN KEY (Receiver_CSClubID) REFERENCES People (CSClubID)
);

CREATE TABLE `Posts`
(
	PostID int NOT NULL AUTO_INCREMENT,
	Poster_CSClubID int NOT NULL,

	PostTitle varchar(50) NOT NULL,
	PostContent varchar NOT NULL,

	PostData_ID int NOT NULL,

	PRIMARY KEY (PostID),

	FOREIGN KEY (Poster_CSClubID) REFERENCES `PEOPLE` (CSClubID),
	FOREIGN KEY (PostData_ID) REFERENCES `PostData`
);

CREATE TABLE PostData
(
	PostData_ID int NOT NULL,
	Post_ID int NOT NULL,

	PRIMARY KEY (PostData_ID),
	
	FOREIGN KEY (Post_ID) REFERENCES Posts (PostData_ID)
);

CREATE TABLE `Events`
(
	EventID int NOT NULL AUTO_INCREMENT,
	DirectorClubID int NOT NULL,

	`Name` varchar(100) NOT NULL,
	`Location` varchar(50) NOT NULL,
	`Description` varchar NOT NULL,

	/*
		Recurring
		0 - One time
		1 - Daily
		2 - Weekly
		3 - Monthly 
	*/

	RecurringCode int NOT NULL,
	StartDate date NOT NULL,
	EndDate date,

	StartTime Time,
	Start_AM_PM varchar(2),
	
	EndTime Time,
	End_AM_PM varchar(2),

	/* Event Interests */
	3DPrinting boolean,
	Robotics boolean,
	VideoGameDev boolean,
	AI boolean,
	MobileAppDev boolean,
	WebDev boolean,
	OtherInterest varchar(50),

	PRIMARY KEY (EventID),
	FOREIGN KEY (DirectorClubID) REFERENCES People (CSClubID)
);

/* New 
CREATE TABLE `Project`
{
	DirectorClubID int NOT NULL,
}

CREATE TABLE CSTopic
{
	TopicName varchar(50) NOT NULL,
	DirectorID int NOT NULL,
	FOREIGN KEY (DirectorID) REFERENCES People (CSClubID),
}
*/

/* 1 */
INSERT INTO `Events`
(
	DirectorClubID,
	
	`Name`,
	`Location`,
	`Description`,
	
	RecurringCode,
	
	`StartDate`,
	`EndDate`,

	`StartTime`,
	`Start_AM_PM`,

	`EndTime`,
	`End_AM_PM`,

	3DPrinting,
	Robotics,
	VideoGameDev,
	AI,
	MobileAppDev,
	WebDev,
	OtherInterest
)
VALUES
(
	1,
	
	'Web Development Team',
	'Model 113',
	'Web development Team works in a variety of web development languages. All projects are based
	with HTML, CSS, and Javascript for front-end development. Back end is tough in PHP, but
	will we will eventually teach NodeJS as well.',

	2,
	
	'2023-1-5',
	NULL,

	'10:00:00',
	'AM',
	'12:00:00',
	'PM',


	FALSE,
	FALSE,
	FALSE,
	FALSE,
	FALSE,
	TRUE,
	NULL
);

/* 2 */
INSERT INTO `Events`
(
	DirectorClubID,
	
	`Name`,
	`Location`,
	`Description`,
	
	RecurringCode,
	
	`StartDate`,
	`EndDate`,

	`StartTime`,
	`Start_AM_PM`,

	`EndTime`,
	`End_AM_PM`,

	3DPrinting,
	Robotics,
	VideoGameDev,
	AI,
	MobileAppDev,
	WebDev,
	OtherInterest
)
VALUES
(
	1,
	
	'Weekly Meeting',

	'Model 113',
	'The CS Club weekly meeting is a place to meet up with other
	club memebers and discuss the weeks progress on Club projects
	and other club events.',

	2,
	
	'2023-1-5',
	NULL,

	'12:00:00',
	'PM',
	'2:00:00',
	'PM',


	FALSE,
	FALSE,
	FALSE,
	FALSE,
	FALSE,
	TRUE,
	NULL
);

/* Template */
INSERT INTO `Events`
(
	DirectorClubID,
	
	`Name`,
	`Location`,
	`Description`,
	
	RecurringCode,
	
	`StartDate`,
	`EndDate`,

	`StartTime`,
	`Start_AM_PM`,

	`EndTime`,
	`End_AM_PM`,

	3DPrinting,
	Robotics,
	VideoGameDev,
	AI,
	MobileAppDev,
	WebDev,
	OtherInterest
)
VALUES
(
	1,
	
	'EventName',

	'Location',
	'Descripti0n',

	2,
	
	'2023-1-5',
	NULL,

	'00:00:00 StartTime',
	'PM StartAMPM',
	'00:00:00 EndTime',
	'PM StartAMPM',


	FALSE,
	FALSE,
	FALSE,
	FALSE,
	FALSE,
	FALSE,
	NULL
);

/* zeus */
INSERT INTO `Events`
(
	DirectorClubID,
	
	`Name`,
	`Location`,
	`Description`,
	
	RecurringCode,
	
	`StartDate`,
	`EndDate`,

	`StartTime`,
	`Start_AM_PM`,

	`EndTime`,
	`End_AM_PM`,

	3DPrinting,
	Robotics,
	VideoGameDev,
	AI,
	MobileAppDev,
	WebDev,
	OtherInterest
)
VALUES
(
	1,
	
	"Zeus' Entrepreneurship Presentation",

	'The Crib',
	'Zeus is going to explain how big businesses make money',

	0,
	
	'2023-1-5',
	NULL,

	'00:00:00 StartTime',
	'PM StartAMPM',
	'00:00:00 EndTime',
	'PM StartAMPM',


	FALSE,
	FALSE,
	FALSE,
	FALSE,
	FALSE,
	FALSE,
	NULL
);
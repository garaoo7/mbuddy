15/12/2016
query => "CREATE TABLE `mbuddy`.`singer` ( `ID` INT(11) NOT NULL AUTO_INCREMENT , `SingerID` INT(11) NOT NULL , `SingerName` VARCHAR(100) NOT NULL , `Status` ENUM('live','disabled','draft','delete') NOT NULL DEFAULT 'live', PRIMARY KEY (`ID`), UNIQUE (`SingerID`))"

query => "CREATE TABLE `mbuddy`.`listing_singer_relation` ( `ID` INT(11) NOT NULL AUTO_INCREMENT , `SingerID` INT(11) NOT NULL , `ListingID` INT(11) NOT NULL , `Status` ENUM('live','disabled','draft','delete') NOT NULL DEFAULT 'live' , PRIMARY KEY (`ID`), INDEX (`SingerID`), INDEX (`ListingID`))"

query=> "ALTER TABLE listing_singer_relation ADD FOREIGN KEY (SingerID) REFERENCES singer(SingerID)"

query=> "ALTER TABLE listing_singer_relation ADD FOREIGN KEY (ListingID) REFERENCES listing(ListingID)"

query=> "RENAME TABLE `section_listing_relation` TO `listing_section_relation`"

query=> "CREATE TABLE `mbuddy`.`tickets_artist` ( `ID` BIGINT(20) NOT NULL AUTO_INCREMENT , `Temp` CHAR(1) NOT NULL , PRIMARY KEY (`ID`));
	 CREATE TABLE `mbuddy`.`tickets_composer` ( `ID` BIGINT(20) NOT NULL AUTO_INCREMENT , `Temp` CHAR(1) NOT NULL , PRIMARY KEY (`ID`));
	 CREATE TABLE `mbuddy`.`tickets_producer` ( `ID` BIGINT(20) NOT NULL AUTO_INCREMENT , `Temp` CHAR(1) NOT NULL , PRIMARY KEY (`ID`));
	 CREATE TABLE `mbuddy`.`tickets_section` ( `ID` BIGINT(20) NOT NULL AUTO_INCREMENT , `Temp` CHAR(1) NOT NULL , PRIMARY KEY (`ID`));
	 CREATE TABLE `mbuddy`.`tickets_writer` ( `ID` BIGINT(20) NOT NULL AUTO_INCREMENT , `Temp` CHAR(1) NOT NULL , PRIMARY KEY (`ID`));
	 CREATE TABLE `mbuddy`.`tickets_singer` ( `ID` BIGINT(20) NOT NULL AUTO_INCREMENT , `Temp` CHAR(1) NOT NULL , PRIMARY KEY (`ID`));"

query=> "RENAME TABLE `sections` TO `section`"

query=> (Change 'sourceid' coloumn in 'listing' table from 'NULL' to default '1', and insert a entry with sourceID '1' and source as 'youtube' in 'source_of_listing' table)

query=> "(Make default value of 'status' coloumn of table 'listing" equal to 'draft')"

query=> ""

query=> ""

query=> ""

query=> ""

query=> ""

query=> ""

query=> ""

query=> ""

query=> ""

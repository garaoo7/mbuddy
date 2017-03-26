RENAME TABLE `instruments` TO `instrument`

ALTER TABLE `instrument` CHANGE `InstrumentsID` `InstrumentID` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 

ALTER TABLE `instrument` CHANGE `InstrumentsName` `InstrumentName` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 

ALTER TABLE `temporary_listing_data` CHANGE `InstrumentsName` `InstrumentName` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

CREATE TABLE `mbuddy`.`listing_instrument_relation` ( `ID` INT(11) NOT NULL AUTO_INCREMENT , `InstrumentID` INT(11) NOT NULL , `ListingID` INT(11) NOT NULL , `Status` ENUM('live','disabled','draft','delete') NOT NULL DEFAULT 'live' , PRIMARY KEY (`ID`), INDEX (`InstrumentID`), INDEX (`ListingID`));

ALTER TABLE listing_instrument_relation ADD FOREIGN KEY (InstrumentID) REFERENCES instrument(InstrumentID);

ALTER TABLE listing_instrument_relation ADD FOREIGN KEY (ListingID) REFERENCES listing(ListingID);

ALTER TABLE `temporary_listing_data` ADD `TagName` VARCHAR(100) NULL DEFAULT NULL AFTER `ProducerName`;


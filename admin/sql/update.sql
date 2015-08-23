UPDATE config SET version = "2.3";
ALTER TABLE `config` ADD COLUMN `lang` VARCHAR(50) NOT NULL DEFAULT 'fr_FR' AFTER `version`;
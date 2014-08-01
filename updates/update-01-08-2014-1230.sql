ALTER TABLE `cities` CHANGE `country_id` `province_id` INT(11) UNSIGNED NULL DEFAULT NULL;

CREATE TABLE `areas` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `city_id` int(11) DEFAULT NULL,
 `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `provincies` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `country_id` int(11) DEFAULT NULL,
 `title` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
 PRIMARY KEY (`id`)
);

ALTER TABLE `articles` ADD `area_id` INT NULL DEFAULT NULL ;
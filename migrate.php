<?php

$db_info = [
	'hostname' => 'localhost',
	'database' => 'midterm',
	'username' => 'homestead',
	'password' => 'secret',
];


$connection = new \PDO(
	'mysql:host='.$db_info['hostname'].';dbname='.$db_info['database'],
	$db_info['username'],
	$db_info['password'],
	[\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
);
$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

$connection->query('
DROP TABLE IF EXISTS `books`;
');

$connection->query('
CREATE TABLE `books` (
	`id` INT(32) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
);
');

$connection->query('
DROP TABLE IF EXISTS `users`;
');

$connection->query('
CREATE TABLE `users` (
	`id` INT(32) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE (`email`)
);
');

$connection->query('
DROP TABLE IF EXISTS `book_records`;
');

$connection->query('
CREATE TABLE `book_records` (
	`id` INT(32) UNSIGNED NOT NULL AUTO_INCREMENT,
	`book_id` INT(32) UNSIGNED NOT NULL,
	`user_id` INT(32) UNSIGNED NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`book_id`) REFERENCES `books`(`id`),
	FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
');

for ($i = 0; $i < 20; $i ++) {
	$connection->query("
	INSERT INTO `books` (`name`)
	VALUES ('book-".($i)."');
	");
}

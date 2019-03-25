<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1553277281.
 * Generated on 2019-03-22 18:54:41 by dam2t02
 */
class PropelMigration_1553277281
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `created` DATETIME,
    `deleted` DATETIME,
    `code` VARCHAR(255),
    `username` VARCHAR(255),
    `email` VARCHAR(255),
    `premium` TINYINT(1),
    `image` VARCHAR(255),
    `description` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `room`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(255),
    `name` VARCHAR(255),
    `premium` TINYINT(1),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `game`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `created` DATETIME,
    `deleted` DATETIME,
    `code` VARCHAR(255),
    `hints_used` INTEGER,
    `time` INTEGER,
    `user_id` INTEGER,
    `room_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `game_fi_29554a` (`user_id`),
    INDEX `game_fi_0c6ff5` (`room_id`),
    CONSTRAINT `game_fk_29554a`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`),
    CONSTRAINT `game_fk_0c6ff5`
        FOREIGN KEY (`room_id`)
        REFERENCES `room` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `item`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` INTEGER,
    `name` VARCHAR(255),
    `qr_code` VARCHAR(255),
    `room_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `item_fi_0c6ff5` (`room_id`),
    CONSTRAINT `item_fk_0c6ff5`
        FOREIGN KEY (`room_id`)
        REFERENCES `room` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `hint`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `hint` VARCHAR(255),
    `item_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `hint_fi_5cf635` (`item_id`),
    CONSTRAINT `hint_fk_5cf635`
        FOREIGN KEY (`item_id`)
        REFERENCES `item` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `user`;

DROP TABLE IF EXISTS `room`;

DROP TABLE IF EXISTS `game`;

DROP TABLE IF EXISTS `item`;

DROP TABLE IF EXISTS `hint`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
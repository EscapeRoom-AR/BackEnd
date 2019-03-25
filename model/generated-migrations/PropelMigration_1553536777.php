<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1553536777.
 * Generated on 2019-03-25 18:59:37 by dam2t02
 */
class PropelMigration_1553536777
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
    `created` DATETIME,
    `deleted` DATETIME,
    `code` VARCHAR(255) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255),
    `email` VARCHAR(255),
    `premium` TINYINT(1),
    `image` VARCHAR(255),
    `description` VARCHAR(255),
    PRIMARY KEY (`code`),
    UNIQUE INDEX `user_u_f82479` (`username`, `email`)
) ENGINE=InnoDB;

CREATE TABLE `room`
(
    `code` VARCHAR(255) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `premium` TINYINT(1),
    PRIMARY KEY (`code`)
) ENGINE=InnoDB;

CREATE TABLE `game`
(
    `created` DATETIME,
    `deleted` DATETIME,
    `code` VARCHAR(255) NOT NULL AUTO_INCREMENT,
    `hints_used` INTEGER,
    `time` INTEGER,
    `user_code` INTEGER,
    `room_code` INTEGER,
    PRIMARY KEY (`code`),
    INDEX `game_fi_4d86cb` (`user_code`),
    INDEX `game_fi_5db400` (`room_code`),
    CONSTRAINT `game_fk_4d86cb`
        FOREIGN KEY (`user_code`)
        REFERENCES `user` (`code`),
    CONSTRAINT `game_fk_5db400`
        FOREIGN KEY (`room_code`)
        REFERENCES `room` (`code`)
) ENGINE=InnoDB;

CREATE TABLE `item`
(
    `code` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `qr_code` VARCHAR(255),
    `room_code` INTEGER,
    PRIMARY KEY (`code`),
    INDEX `item_fi_5db400` (`room_code`),
    CONSTRAINT `item_fk_5db400`
        FOREIGN KEY (`room_code`)
        REFERENCES `room` (`code`)
) ENGINE=InnoDB;

CREATE TABLE `hint`
(
    `hint` VARCHAR(255),
    `item_code` INTEGER,
    INDEX `hint_fi_a5ad50` (`item_code`),
    CONSTRAINT `hint_fk_a5ad50`
        FOREIGN KEY (`item_code`)
        REFERENCES `item` (`code`)
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
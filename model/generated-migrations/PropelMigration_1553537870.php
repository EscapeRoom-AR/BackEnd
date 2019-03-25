<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1553537870.
 * Generated on 2019-03-25 19:17:50 by dam2t02
 */
class PropelMigration_1553537870
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

ALTER TABLE `game`

  CHANGE `created` `created` DATETIME NOT NULL,

  CHANGE `hints_used` `hints_used` INTEGER DEFAULT 0 NOT NULL,

  CHANGE `time` `time` INTEGER NOT NULL,

  CHANGE `user_code` `user_code` INTEGER NOT NULL,

  CHANGE `room_code` `room_code` INTEGER NOT NULL;

ALTER TABLE `hint`

  CHANGE `hint` `hint` VARCHAR(255) NOT NULL,

  CHANGE `item_code` `item_code` INTEGER NOT NULL;

ALTER TABLE `item`

  CHANGE `name` `name` VARCHAR(255) NOT NULL,

  CHANGE `room_code` `room_code` INTEGER NOT NULL;

ALTER TABLE `room`

  CHANGE `name` `name` VARCHAR(255) NOT NULL,

  CHANGE `premium` `premium` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `user`

  CHANGE `created` `created` DATETIME NOT NULL,

  CHANGE `username` `username` VARCHAR(255) NOT NULL,

  CHANGE `email` `email` VARCHAR(255) NOT NULL,

  CHANGE `premium` `premium` TINYINT(1) DEFAULT 0 NOT NULL,

  CHANGE `description` `description` VARCHAR(255) DEFAULT \'Hi there! I\\\'m playing Scape Room AR!\';

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

ALTER TABLE `game`

  CHANGE `created` `created` DATETIME,

  CHANGE `hints_used` `hints_used` INTEGER,

  CHANGE `time` `time` INTEGER,

  CHANGE `user_code` `user_code` INTEGER,

  CHANGE `room_code` `room_code` INTEGER;

ALTER TABLE `hint`

  CHANGE `hint` `hint` VARCHAR(255),

  CHANGE `item_code` `item_code` INTEGER;

ALTER TABLE `item`

  CHANGE `name` `name` VARCHAR(255),

  CHANGE `room_code` `room_code` INTEGER;

ALTER TABLE `room`

  CHANGE `name` `name` VARCHAR(255),

  CHANGE `premium` `premium` TINYINT(1);

ALTER TABLE `user`

  CHANGE `created` `created` DATETIME,

  CHANGE `username` `username` VARCHAR(255),

  CHANGE `email` `email` VARCHAR(255),

  CHANGE `premium` `premium` TINYINT(1),

  CHANGE `description` `description` VARCHAR(255);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
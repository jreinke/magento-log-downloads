<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.0.0
 * @copyright   Copyright (c) 2013 BubbleCode (http://shop.bubblecode.net)
 */
/**
 * @var $this Mage_Eav_Model_Entity_Setup
 */
$installer = $this;
$installer->startSetup();

$tableDownloadLog = $installer->getTable('bubble_download_log');

$installer->run("
    DROP TABLE IF EXISTS `{$tableDownloadLog}`;
    CREATE TABLE `{$tableDownloadLog}` (
        `log_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `file` VARCHAR(255) NOT NULL,
        `product_id` INT(10) UNSIGNED DEFAULT NULL,
        `customer_id` INT(10) UNSIGNED DEFAULT NULL,
        `http_user_agent` VARCHAR(255) DEFAULT NULL,
        `remote_addr` VARCHAR(60) DEFAULT NULL,
        `country` VARCHAR(255) DEFAULT NULL,
        `region` VARCHAR(255) DEFAULT NULL,
        `city` VARCHAR(255) DEFAULT NULL,
        `created_at` DATETIME NOT NULL default '0000-00-00 00:00:00'
    ) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT='Product downloads log';
");

$installer->endSetup();

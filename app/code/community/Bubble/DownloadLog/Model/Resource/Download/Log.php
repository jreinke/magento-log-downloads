<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.0.0
 * @copyright   Copyright (c) 2013 BubbleCode (http://shop.bubblecode.net)
 */
class Bubble_DownloadLog_Model_Resource_Download_Log extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('bubble_downloadlog/download_log', 'log_id');
    }

    protected function _prepareDataForSave(Mage_Core_Model_Abstract $object)
    {
        $currentTime = Varien_Date::now();
        if ((!$object->getId() || $object->isObjectNew()) && !$object->getCreatedAt()) {
            $object->setCreatedAt($currentTime);
        }
        $data = parent::_prepareDataForSave($object);

        return $data;
    }
}
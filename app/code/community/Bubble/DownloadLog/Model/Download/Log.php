<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.0.0
 * @copyright   Copyright (c) 2013 BubbleCode (http://shop.bubblecode.net)
 */
class Bubble_DownloadLog_Model_Download_Log extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('bubble_downloadlog/download_log');
    }
}
<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.0.0
 * @copyright   Copyright (c) 2013 BubbleCode (http://shop.bubblecode.net)
 */
class Bubble_DownloadLog_Model_Resource_Download_Log_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('bubble_downloadlog/download_log');
    }

    public function joinProduct()
    {
        $this->getSelect()->joinLeft(
            array('product' => $this->getTable('catalog/product')),
            'main_table.product_id = product.entity_id',
            array('sku' => 'product.sku')
        );

        return $this;
    }
}
<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.0.0
 * @copyright   Copyright (c) 2013 BubbleCode (http://shop.bubblecode.net)
 */
class Bubble_DownloadLog_Adminhtml_Product_DownloadController extends Mage_Adminhtml_Controller_Action
{
    public function listAction()
    {
        $this->_title($this->__('Catalog'))
            ->_title(Mage::helper('bubble_downloadlog')->__('Product Downloads'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('bubble_downloadlog/adminhtml_download_log'));
        $this->_setActiveMenu('catalog/product_downloads');
        $this->renderLayout();
    }
}
<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.1.0
 * @copyright   Copyright (c) 2016 BubbleShop (https://www.bubbleshop.net)
 */
class Bubble_DownloadLog_Block_Adminhtml_Download_Log extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'bubble_downloadlog';
        $this->_controller = 'adminhtml_download_log';
        $this->_headerText = Mage::helper('bubble_downloadlog')->__('Product Downloads');
        $this->_removeButton('add');
    }

    protected function _prepareLayout()
    {
        $this->setChild('grid', $this->getLayout()->createBlock(
            'bubble_downloadlog/adminhtml_download_log_grid',
            'product_downloads.grid'
        ));

        return parent::_prepareLayout();
    }

    public function getHeaderCssClass()
    {
        return '';
    }
}
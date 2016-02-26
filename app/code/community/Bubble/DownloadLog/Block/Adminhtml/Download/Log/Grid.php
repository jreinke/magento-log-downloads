<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.1.0
 * @copyright   Copyright (c) 2016 BubbleShop (https://www.bubbleshop.net)
 */
class Bubble_DownloadLog_Block_Adminhtml_Download_Log_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Initialization
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('downloadLogGrid');
        $this->setDefaultSort('log_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setVarNameFilter('download_log_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('bubble_downloadlog/download_log')
            ->getCollection()
            ->joinCustomer()
            ->joinProduct();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn('log_id', array(
            'header'         => $this->__('Log Id'),
            'index'          => 'log_id',
            'type'           => 'number',
        ));

        $this->addColumn('title', array(
            'header'         => $this->__('Title'),
            'index'          => 'title',
        ));

        $this->addColumn('file', array(
            'header'         => $this->__('File'),
            'index'          => 'file',
            'frame_callback' => array($this, 'decorateFile'),
        ));

        $this->addColumn('sku', array(
            'header'         => $this->__('SKU'),
            'index'          => 'sku',
            'filter_index'   => 'product.sku',
            'frame_callback' => array($this, 'decorateSku'),
        ));
        
        $this->addColumn('customer_id', array(
            'header'                    => $this->__('Customer'),
            'index'                     => 'customer_id',
            'filter_index'              => 'customer_fullname',
            'frame_callback'            => array($this, 'decorateCustomer'),
            'filter_condition_callback' => array($this, 'filterCustomer'),
        ));

        $this->addColumn('http_user_agent', array(
            'header'         => $this->__('User Agent'),
            'index'          => 'http_user_agent',
        ));

        $this->addColumn('remote_addr', array(
            'header'         => $this->__('IP'),
            'index'          => 'remote_addr',
            'width'          => '80px',
        ));

        $this->addColumn('country', array(
            'header'         => $this->__('Country'),
            'index'          => 'country',
        ));

        $this->addColumn('region', array(
            'header'         => $this->__('Region'),
            'index'          => 'region',
        ));

        $this->addColumn('city', array(
            'header'         => $this->__('City'),
            'index'          => 'city',
        ));

        $this->addColumn('created_at', array(
            'header'         => $this->__('Date'),
            'align'          => 'right',
            'index'          => 'created_at',
            'type'           => 'datetime',
            'width'          => '180px',
        ));

        return parent::_prepareColumns();
    }

    /**
     * @param string $value
     * @param Bubble_DownloadLog_Model_Download_Log $row
     * @return string
     */
    public function decorateCustomer($value, $row)
    {
        $html = '';
        if ($value) {
            $html = sprintf(
                '<a href="%s" title="%s">%s</a>',
                $this->getUrl('adminhtml/customer/edit', array('id' => $value)),
                $this->__('Edit Customer'),
                $row->getCustomerFullname() ? $row->getCustomerFullname() : $value
            );
        }

        return $html;
    }

    /**
     * @param string $value
     * @return string
     */
    public function decorateFile($value)
    {
        return basename($value);
    }

    /**
     * @param string $value
     * @param Bubble_DownloadLog_Model_Download_Log $row
     * @return string
     */
    public function decorateSku($value, $row)
    {
        $html = sprintf(
            '<a href="%s" title="%s">%s</a>',
            $this->getUrl('adminhtml/catalog_product/edit', array('id' => $row->getProductId())),
            $this->__('Edit Product'),
            $value
        );

        return $html;
    }

    /**
     * @param Bubble_DownloadLog_Model_Resource_Download_Log_Collection $collection
     * @param $column
     */
    public function filterCustomer($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $collection->addCustomerFilter($value);
    }
}
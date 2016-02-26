<?php
/**
 * @category    Bubble
 * @package     Bubble_DownloadLog
 * @version     1.1.0
 * @copyright   Copyright (c) 2016 BubbleShop (https://www.bubbleshop.net)
 */
class Bubble_DownloadLog_Model_Resource_Download_Log_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * @var bool
     */
    protected $_joinedCustomer = false;

    /**
     * Initialization
     */
    public function _construct()
    {
        $this->_init('bubble_downloadlog/download_log');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function addCustomerFilter($value)
    {
        $this->joinCustomer();
        if (strlen($value)) {
            $customerFullname = $this->getConnection()->getConcatSql(array(
                'table_customer_firstname.value',
                'table_customer_middlename.value',
                'table_customer_lastname.value'
            ), ' ');
            $this->getSelect()
                ->where($customerFullname . ' LIKE ?', "%{$value}%");
        }

        return $this;
    }

    /**
     * @return $this
     * @throws Mage_Core_Exception
     */
    public function joinCustomer()
    {
        if ($this->_joinedCustomer) {
            return $this;
        }

        /**
         * Allow to use analytic function to result select
         */
        $this->_useAnalyticFunction = true;

        /** @var $adapter Varien_Db_Adapter_Interface */
        $adapter        = $this->getConnection();
        /** @var $customer Mage_Customer_Model_Resource_Customer */
        $customer       = Mage::getResourceSingleton('customer/customer');
        /** @var $firstnameAttr Mage_Eav_Model_Entity_Attribute */
        $firstnameAttr  = $customer->getAttribute('firstname');
        /** @var $middlenameAttr Mage_Eav_Model_Entity_Attribute */
        $middlenameAttr = $customer->getAttribute('middlename');
        /** @var $lastnameAttr Mage_Eav_Model_Entity_Attribute */
        $lastnameAttr   = $customer->getAttribute('lastname');

        $firstnameCondition = array('table_customer_firstname.entity_id = main_table.customer_id');

        if ($firstnameAttr->getBackend()->isStatic()) {
            $firstnameField = 'firstname';
        } else {
            $firstnameField = 'value';
            $firstnameCondition[] = $adapter->quoteInto(
                'table_customer_firstname.attribute_id = ?',
                (int) $firstnameAttr->getAttributeId()
            );
        }

        $this->getSelect()->joinLeft(
            array('table_customer_firstname' => $firstnameAttr->getBackend()->getTable()),
            implode(' AND ', $firstnameCondition),
            array()
        );

        $middlenameCondition = array('table_customer_middlename.entity_id = main_table.customer_id');

        if ($middlenameAttr->getBackend()->isStatic()) {
            $middlenameField = 'middlename';
        } else {
            $middlenameField = 'value';
            $middlenameCondition[] = $adapter->quoteInto(
                'table_customer_middlename.attribute_id = ?',
                (int) $middlenameAttr->getAttributeId()
            );
        }

        $this->getSelect()->joinLeft(
            array('table_customer_middlename' => $middlenameAttr->getBackend()->getTable()),
            implode(' AND ', $middlenameCondition),
            array()
        );

        $lastnameCondition  = array('table_customer_lastname.entity_id = main_table.customer_id');
        if ($lastnameAttr->getBackend()->isStatic()) {
            $lastnameField = 'lastname';
        } else {
            $lastnameField = 'value';
            $lastnameCondition[] = $adapter->quoteInto(
                'table_customer_lastname.attribute_id = ?',
                (int) $lastnameAttr->getAttributeId()
            );
        }

        // Prepare fullname field result
        $customerFullname = $adapter->getConcatSql(array(
            "table_customer_firstname.{$firstnameField}",
            "table_customer_middlename.{$middlenameField}",
            "table_customer_lastname.{$lastnameField}"
        ), ' ');
        $this->getSelect()
            ->joinLeft(
                array('table_customer_lastname' => $lastnameAttr->getBackend()->getTable()),
                implode(' AND ', $lastnameCondition),
                array('customer_fullname' => $customerFullname)
            );

        $this->_joinedCustomer = true;

        return $this;
    }

    /**
     * @return $this
     */
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
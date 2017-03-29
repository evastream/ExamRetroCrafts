<?php
/**
 * Fieldthemes
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Fieldthemes.com license that is
 * available through the world-wide-web at this URL:
 * http://www.fieldthemes.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Fieldthemes
 * @package    Field_Megamenu
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\Megamenu\Model\ResourceModel\Menu;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'menu_id';

	/**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\DB\Adapter\AdapterInterface|null $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb|null $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
        ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }

	/**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Field\Megamenu\Model\Menu', 'Field\Megamenu\Model\ResourceModel\Menu');
        $this->_map['fields']['menu_id'] = 'main_table.menu_id';
        $this->_map['fields']['store'] = 'store_table.store_id';
    }

    /**
     * Perform operations after collection load
     *
     * @param string $tableName
     * @param string $columnName
     * @return void
     */
    protected function performAfterLoad($tableName, $columnName)
    {
        $items = $this->getColumnValues($columnName);
        if (count($items)) {
            $connection = $this->getConnection();
            $select = $connection->select()->from(['field_megamenu_menu_store' => $this->getTable($tableName)])
            ->where('field_megamenu_menu_store.' . $columnName . ' IN (?)', $items);
            $result = $connection->fetchPairs($select);

            foreach ($this as $item) {
                $entityId = $item->getData($columnName);
                $result_store_id = 0;
                if ($result) {
                    if (isset($result[$entityId]) && $result[$entityId] == 0) {
                        $stores = $this->storeManager->getStores(false, true);
                        $storeId = current($stores)->getId();
                        $storeCode = key($stores);
                        $result_store_id = $result[$entityId];
                    } elseif(isset($result[$item->getData($columnName)])) {
                        $storeId = $result[$item->getData($columnName)];
                        $storeCode = $this->storeManager->getStore($storeId)->getCode();
                        $result_store_id = $result[$entityId];
                    }
                }
                if(!isset($storeId)) {
                    $stores = $this->storeManager->getStores(false, true);
                    $storeId = current($stores)->getId();
                    $storeCode = key($stores);
                }
                
                $item->setData('_first_store_id', $storeId);
                $item->setData('store_code', $storeCode);
                $item->setData('store_id', [$result_store_id]);
            }
        }
    }
    
    
    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $this->performAfterLoad('field_megamenu_menu_store', 'menu_id');
        return parent::_afterLoad();
    }

    /**
     * Perform operations before rendering filters
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        $this->joinStoreRelationTable('cms_page_store', 'page_id');
    }

    /**
     * Join store relation table if there is store filter
     *
     * @param string $tableName
     * @param string $columnName
     * @return void
     */
    protected function joinStoreRelationTable($tableName, $columnName)
    {
        if ($this->getFilter('store')) {
            $this->getSelect()->join(
                ['store_table' => $this->getTable($tableName)],
                'main_table.' . $columnName . ' = store_table.' . $columnName,
                []
            )->group(
                'main_table.' . $columnName
            );
        }
        parent::_renderFiltersBefore();
    }
}
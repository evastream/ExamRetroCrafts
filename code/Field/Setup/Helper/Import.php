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
 * @package    Field_Setup
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\Setup\Helper;
use Magento\Framework\App\Filesystem\DirectoryList;
use \Magento\Framework\Module\Dir;

class Import extends \Magento\Framework\App\Helper\AbstractHelper
{
	/**
	 * @var \Field\Setup\Helper\Data
	 */
	protected $_fieldData;

	/**
	 * @param \Magento\Framework\App\Helper\Context     $context  
	 * @param \Magento\Framework\App\ResourceConnection $resource 
	 * @param \Field\Setup\Helper\Data                    $fieldData  
	 */
	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		\Magento\Framework\App\ResourceConnection $resource,
		\Field\Setup\Helper\Data $fieldData
		) {
		parent::__construct($context);
		$this->_resource = $resource;
		$this->_fielddata = $fieldData;
	}

	public function buildQueryImport($data = array(), $table_name = "", $override = true, $store_id = 0, $where = '') {
		$query = false;
		$binds = array();
		if($data) {
			$table_name = $this->_resource->getTableName($table_name);
			if($override) {
				$query = "REPLACE INTO `".$table_name."` ";
			} else {
				$query = "INSERT IGNORE INTO `".$table_name."` ";
			}
			$stores = $this->_fielddata->getAllStores();
			$fields = $values = array();
			foreach($data as $key=>$val) {
				if($val) {
					if($key == "store_id" && !in_array($val, $stores)){
						$val = $store_id;
					}
					$fields[] = "`".$key."`";
					$values[] = ":".strtolower($key);
					$binds[strtolower($key)] = $val;
				}
			}
			$query .= " (".implode(",", $fields).") VALUES (".implode(",", $values).")";
		}
		return array($query, $binds);
	}
}
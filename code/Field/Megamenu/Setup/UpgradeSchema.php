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
namespace Field\Megamenu\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableItems = $installer->getTable('field_megamenu_item');

        $installer->getConnection()->addColumn(
            $tableItems,
            'dropdown_bgcolor',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Dropdown Background Color'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableItems,
            'dropdown_bgimage',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Dropdown Bakground Image'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableItems,
            'dropdown_bgimage',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Dropdown Bakground Image'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableItems,
            'dropdown_bgimagerepeat',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Dropdown Bakground Image Repeat'
            ]
        );

        $installer->getConnection()->addColumn(
            $tableItems,
            'dropdown_bgpositionx',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Dropdown Background Position X'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableItems,
            'dropdown_bgpositiony',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Dropdown Background Position Y'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableItems,
            'dropdown_inlinecss',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Dropdown Inline CSS'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableItems,
            'parentcat',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Parent Category'
            ]
        );

        $tableMenu = $installer->getTable('field_megamenu_menu');
        $installer->getConnection()->addColumn(
            $tableMenu,
            'desktop_template',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Desktop Template'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableMenu,
            'event',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Event'
            ]
        );
        $installer->getConnection()->addColumn(
            $tableMenu,
            'classes',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Classes'
            ]
        );

        $installer->getConnection()->modifyColumn(
                $installer->getTable('field_megamenu_item'),
                'id',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_BIGINT,
                    'auto_increment' => true,
                    'primary' => true,
                    'nullable' => false
                ]
            );
        
        $installer->endSetup();
    }
}

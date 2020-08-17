<?php
namespace Qianrui\Slider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface {

	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$setup->startSetup();

		$table = $setup->getConnection()->newTable($setup->getTable('qr_slider'))
			->addColumn(
				'id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				[
					'identity' => true, 
					'unsigned' => true, 
					'nullable' => false, 
					'primary' => true
				],
				'Id'
			)->addColumn(
				'title',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				[
					'nullable' => false,
                    'default'  => ''
				],
				'Title'
			)->addColumn(
				'desc',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				[
                    'nullable' => false,
                    'default'  => ''
				],
				'Description'
			)->addColumn(
                'image',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false,
                    'default'  => ''
                ],
                'Image'
            )->addColumn(
                'url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false,
                    'default'  => ''
                ],
                'Url'
            )->addColumn(
                'sort',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                1,
                [
                    'nullable' => false,
                    'default' => 0
                ],
                'Sort'
            )->addColumn(
				'active',
				\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
				1,
				[
					'nullable' => false,
					'default' => 1
				],
				'Active'
			)->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ]
            )->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE
                ]
            )->setComment(
				'Slider Table'
			);
		$setup->getConnection()->createTable($table);

		$setup->endSetup();
	}
}
<?php
namespace SMP\Grid\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface {

	public function install( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;
        $installer->startSetup();

		if (!$installer->tableExists('smpmarketplace_category')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('smpmarketplace_category')
            )
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ],
                'ID'
            )
            ->addColumn(
                'pid',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'unsigned' => true,
                    'default' => 0
                ],
                'PID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Name'
            )
            ->addColumn(
                'name_in_ar',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Name in Arabic'
            )
            ->addColumn(
                'image',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Image'
            );
        }

        $installer->getConnection()->createTable($table);

		$installer->endSetup();
    }
    
}
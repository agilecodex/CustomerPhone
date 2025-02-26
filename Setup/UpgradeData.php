<?php
namespace Acx\CustomerPhone\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) { // Adjust version as needed
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            // Update the attribute to remove "required" validation
            $eavSetup->updateAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'acx_phone_num',
                'is_required',
                false
            );
        }

        $setup->endSetup();
    }
}

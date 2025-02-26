<?php
namespace Acx\CustomerPhone\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

class InstallData implements InstallDataInterface
{

    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY, 'acx_phone_num', [
            'type' => 'varchar',
            'label' => 'Phone Number',
            'input' => 'text',
            'source' => '',
            'required' => false,
            'visible' => true,
            'unique' => true,
            'position' => 100,
            'system' => false,
            'backend' => ''
        ]);


        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'acx_phone_num')
            ->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit'
            ]]);
        $attribute->save();
    }
}

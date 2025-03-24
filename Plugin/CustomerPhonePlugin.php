<?php
namespace Acx\CustomerPhone\Plugin;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CustomerPhonePlugin
{
    public function beforeSave(CustomerRepositoryInterface $subject, CustomerInterface $customer)
    {
        $phoneNumber = $customer->getCustomAttribute('acx_phone_num');

        if ($phoneNumber) {
            $customer->setCustomAttribute('acx_phone_num', $phoneNumber->getValue());
        }

        return [$customer];
    }
}

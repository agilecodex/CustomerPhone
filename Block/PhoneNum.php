<?php

namespace Acx\CustomerPhone\Block;


use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;

class PhoneNum extends Template
{
    protected $customerSession;

    public function __construct(
        Template\Context $context,
        Session $customerSession,
        array $data = []
    )
    {
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getPhoneNum() {
        return $this->customerSession->getCustomer()->getPhoneNum();
    }
}

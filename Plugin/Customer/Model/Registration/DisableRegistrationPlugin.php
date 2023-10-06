<?php
/**
 * Copyright (c) 2016 Salvatore Guarino. All rights reserved.
 * Copyright © Lucid Modules. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace LucidModules\DisableCustomerRegistration\Plugin\Customer\Model\Registration;

use Magento\Customer\Model\Registration;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class DisableRegistrationPlugin
{
    private const XML_PATH_DISABLE_CUSTOMER_REGISTRATION = 'customer/create_account/disable_customer_registration';

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {
    }

    /**
     * If Registration is not allowed by the plugin - returns false, otherwise returns original value.
     *
     * @param Registration $subject
     * @param bool $result
     * @return bool
     */
    public function afterIsAllowed(Registration $subject, $result)
    {
        $isBlocked = $this->scopeConfig->isSetFlag(
            self::XML_PATH_DISABLE_CUSTOMER_REGISTRATION,
            ScopeInterface::SCOPE_STORE
        );
        if ($isBlocked) {
            return false;
        }

        return $result;
    }
}

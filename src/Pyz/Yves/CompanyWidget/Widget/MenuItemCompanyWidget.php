<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyWidget\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\CompanyWidget\CompanyWidgetFactory getFactory()
 */
class MenuItemCompanyWidget extends AbstractWidget
{
    public function __construct()
    {
        $this->addParameter('isVisible', $this->isVisible())
            ->addParameter('companyName', $this->getCompanyName())
            ->addParameter('hasCompanyAccess', $this->hasCompanyAccess());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'MenuItemCompanyWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@CompanyWidget/views/shop-ui/menu-item-company-widget.twig';
    }

    /**
     * @return string
     */
    protected function getCompanyName(): string
    {
        $customer = $this->getFactory()->getCustomerClient()->getCustomer();

        if (
            $customer !== null
            && $customer->getCompanyUserTransfer() !== null
            && $customer->getCompanyUserTransfer()->getCompanyBusinessUnit() !== null
            && $customer->getCompanyUserTransfer()->getCompanyBusinessUnit()->getCompany() !== null
        ) {
            return $customer->getCompanyUserTransfer()->getCompanyBusinessUnit()->getCompany()->getName();
        }

        return '';
    }

    /**
     * @return bool
     */
    protected function isVisible(): bool
    {
        $customer = $this->getFactory()->getCustomerClient()->getCustomer();

        if ($customer !== null && $customer->getCompanyUserTransfer() !== null) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function hasCompanyAccess(): bool
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

        return $customerTransfer && ($customerTransfer->getCompanyUserTransfer() || $customerTransfer->getIsOnBehalf());
    }
}

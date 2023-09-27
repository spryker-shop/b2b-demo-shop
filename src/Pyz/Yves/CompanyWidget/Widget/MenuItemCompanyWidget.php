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
    /**
     * @var string
     */
    protected const PARAMETER_IS_VISIBLE = 'isVisible';

    /**
     * @var string
     */
    protected const PARAMETER_COMPANY_NAME = 'companyName';

    /**
     * @var string
     */
    protected const PARAMETER_HAS_COMPANY_ACCESS = 'hasCompanyAccess';

    public function __construct()
    {
        $this->addIsVisibleParameter();
        $this->addCompanyNameParameter();
        $this->addHasCompanyAccessParameter();
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
     * @return void
     */
    protected function addIsVisibleParameter(): void
    {
        $customer = $this->getFactory()->getCustomerClient()->getCustomer();
        $isVisible = ($customer !== null && $customer->getCompanyUserTransfer() !== null);

        $this->addParameter(static::PARAMETER_IS_VISIBLE, $isVisible);
    }

    /**
     * @return void
     */
    protected function addCompanyNameParameter(): void
    {
        $this->addParameter(static::PARAMETER_COMPANY_NAME, $this->getCompanyName());
    }

    /**
     * @return void
     */
    protected function addHasCompanyAccessParameter(): void
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();
        $hasCompanyAccess = $customerTransfer && ($customerTransfer->getCompanyUserTransfer() || $customerTransfer->getIsOnBehalf());

        $this->addParameter(static::PARAMETER_HAS_COMPANY_ACCESS, $hasCompanyAccess);
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
}

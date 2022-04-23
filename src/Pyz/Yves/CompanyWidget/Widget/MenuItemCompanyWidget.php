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
    protected const PYZ_PARAMETER_IS_VISIBLE = 'isVisible';

    /**
     * @var string
     */
    protected const PYZ_PARAMETER_COMPANY_NAME = 'companyName';

    /**
     * @var string
     */
    protected const PYZ_PARAMETER_HAS_COMPANY_ACCESS = 'hasCompanyAccess';

    public function __construct()
    {
        $this->addPyzIsVisibleParameter();
        $this->addPyzCompanyNameParameter();
        $this->addPyzHasCompanyAccessParameter();
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
    protected function addPyzIsVisibleParameter(): void
    {
        $customer = $this->getFactory()->getCustomerClient()->getCustomer();
        $isVisible = ($customer !== null && $customer->getCompanyUserTransfer() !== null);

        $this->addParameter(static::PYZ_PARAMETER_IS_VISIBLE, $isVisible);
    }

    /**
     * @return void
     */
    protected function addPyzCompanyNameParameter(): void
    {
        $this->addParameter(static::PYZ_PARAMETER_COMPANY_NAME, $this->getPyzCompanyName());
    }

    /**
     * @return void
     */
    protected function addPyzHasCompanyAccessParameter(): void
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();
        $hasPyzCompanyAccess = $customerTransfer && ($customerTransfer->getCompanyUserTransfer() || $customerTransfer->getIsOnBehalf());

        $this->addParameter(static::PYZ_PARAMETER_HAS_COMPANY_ACCESS, $hasPyzCompanyAccess);
    }

    /**
     * @return string
     */
    protected function getPyzCompanyName(): string
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

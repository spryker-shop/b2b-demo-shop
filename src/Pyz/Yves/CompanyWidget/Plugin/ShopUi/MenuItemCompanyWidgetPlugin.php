<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyWidget\Plugin\ShopUi;

use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;
use SprykerShop\Yves\ShopUi\Dependency\Plugin\CompanyWidget\MenuItemCompanyWidgetPluginInterface;

/**
 * @method \SprykerShop\Yves\CompanyWidget\CompanyWidgetFactory getFactory()
 */
class MenuItemCompanyWidgetPlugin extends AbstractWidgetPlugin implements MenuItemCompanyWidgetPluginInterface
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        $this
            ->addParameter('isVisible', $this->isVisible())
            ->addParameter('companyName', $this->getCompanyName());
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return string
     */
    public static function getName(): string
    {
        return static::NAME;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
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

        if ($customer !== null
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
}

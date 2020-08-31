<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CheckoutRestApi;

use Pyz\Zed\CheckoutRestApi\Communication\Plugin\PointOfContactQuoteMapperPlugin;
use Spryker\Zed\CheckoutRestApi\CheckoutRestApiDependencyProvider as SprykerCheckoutRestApiDependencyProvider;
use Spryker\Zed\Country\Communication\Plugin\CheckoutRestApi\CountryCheckoutDataValidatorPlugin;
use Spryker\Zed\CustomersRestApi\Communication\Plugin\CheckoutRestApi\AddressQuoteMapperPlugin;
use Spryker\Zed\CustomersRestApi\Communication\Plugin\CheckoutRestApi\CustomerQuoteMapperPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\PaymentsRestApi\Communication\Plugin\CheckoutRestApi\PaymentsQuoteMapperPlugin;
use Spryker\Zed\ShipmentsRestApi\Communication\Plugin\CheckoutRestApi\ShipmentMethodCheckoutDataValidatorPlugin;
use Spryker\Zed\ShipmentsRestApi\Communication\Plugin\CheckoutRestApi\ShipmentQuoteMapperPlugin;

class CheckoutRestApiDependencyProvider extends SprykerCheckoutRestApiDependencyProvider
{
    public const FACADE_QUOTE_BASE = 'FACADE_QUOTE_BASE';
    public const FACADE_QUOTE_APPROVAL = 'FACADE_QUOTE_APPROVAL';
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addBaseQuoteFacade($container);
        $container = $this->addQuoteApprovalFacade($container);
        $container = $this->addCompanyUserFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBaseQuoteFacade(Container $container): Container
    {
        $container->set(static::FACADE_QUOTE_BASE, function (Container $container) {
            return $container->getLocator()->quote()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteApprovalFacade(Container $container): Container
    {
        $container->set(static::FACADE_QUOTE_APPROVAL, function (Container $container) {
            return $container->getLocator()->quoteApproval()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserFacade(Container $container): Container
    {
        $container->set(static::FACADE_COMPANY_USER, function (Container $container) {
            return $container->getLocator()->companyUser()->facade();
        });

        return $container;
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApiExtension\Dependency\Plugin\QuoteMapperPluginInterface[]
     */
    protected function getQuoteMapperPlugins(): array
    {
        return [
            new CustomerQuoteMapperPlugin(),
            new AddressQuoteMapperPlugin(),
            new PaymentsQuoteMapperPlugin(),
            new ShipmentQuoteMapperPlugin(),
            new PointOfContactQuoteMapperPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApiExtension\Dependency\Plugin\CheckoutDataValidatorPluginInterface[]
     */
    protected function getCheckoutDataValidatorPlugins(): array
    {
        return [
            new CountryCheckoutDataValidatorPlugin(),
            new ShipmentMethodCheckoutDataValidatorPlugin(),
        ];
    }
}

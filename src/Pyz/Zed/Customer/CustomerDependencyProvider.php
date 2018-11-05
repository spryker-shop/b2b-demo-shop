<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Customer;

use Pyz\Zed\CompanyUser\Communication\Plugin\Customer\IsEnabledCustomerCompanyUserPluginTransferExpanderPlugin;
use Spryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Zed\BusinessOnBehalf\Communication\Plugin\Customer\DefaultCompanyUserCustomerTransferExpanderPlugin;
use Spryker\Zed\BusinessOnBehalf\Communication\Plugin\Customer\IsOnBehalfCustomerTransferExpanderPlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\PermissionCustomerExpanderPlugin;
use Spryker\Zed\CompanyUser\Communication\Plugin\Customer\CustomerTransferCompanyUserExpanderPlugin;
use Spryker\Zed\CompanyUserGui\Communication\Plugin\Customer\CompanyUserCustomerTableActionExpanderPlugin;
use Spryker\Zed\CompanyUserInvitation\Communication\Plugin\CompanyUserInvitationPostCustomerRegistrationPlugin;
use Spryker\Zed\Customer\CustomerDependencyProvider as SprykerCustomerDependencyProvider;
use Spryker\Zed\CustomerGroup\Communication\Plugin\CustomerAnonymizer\RemoveCustomerFromGroupPlugin;
use Spryker\Zed\CustomerUserConnector\Communication\Plugin\CustomerTransferUsernameExpanderPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\MerchantRelationshipProductList\Communication\Plugin\Customer\ProductListCustomerTransferExpanderPlugin;
use Spryker\Zed\Newsletter\Communication\Plugin\CustomerAnonymizer\CustomerUnsubscribePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\QuotePermissionCustomerExpanderPlugin;
use Spryker\Zed\ShoppingList\Communication\Plugin\ShoppingListPermissionCustomerExpanderPlugin;

class CustomerDependencyProvider extends SprykerCustomerDependencyProvider
{
    public const SALES_FACADE = 'sales facade';
    public const NEWSLETTER_FACADE = 'newsletter facade';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container[self::SALES_FACADE] = function (Container $container) {
            return $container->getLocator()->sales()->facade();
        };

        $container[self::NEWSLETTER_FACADE] = function (Container $container) {
            return $container->getLocator()->newsletter()->facade();
        };

        return $container;
    }

    /**
     * @return \Spryker\Zed\Customer\Dependency\Plugin\CustomerAnonymizerPluginInterface[]
     */
    protected function getCustomerAnonymizerPlugins(): array
    {
        return [
            new CustomerUnsubscribePlugin([
                NewsletterConstants::DEFAULT_NEWSLETTER_TYPE,
            ]),
            new RemoveCustomerFromGroupPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\Customer\Dependency\Plugin\CustomerTransferExpanderPluginInterface[]
     */
    protected function getCustomerTransferExpanderPlugins(): array
    {
        return [
            new CustomerTransferUsernameExpanderPlugin(),
            new CustomerTransferCompanyUserExpanderPlugin(),
            new IsEnabledCustomerCompanyUserPluginTransferExpanderPlugin(),
            new PermissionCustomerExpanderPlugin(),
            new QuotePermissionCustomerExpanderPlugin(), #SharedCartFeature
            new ShoppingListPermissionCustomerExpanderPlugin(),
            new IsOnBehalfCustomerTransferExpanderPlugin(), #BusinessOnBefalfFeature
            new DefaultCompanyUserCustomerTransferExpanderPlugin(), #BusinessOnBefalfFeature
            new ProductListCustomerTransferExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\CustomerExtension\Dependency\Plugin\PostCustomerRegistrationPluginInterface[]
     */
    protected function getPostCustomerRegistrationPlugins(): array
    {
        return [
            new CompanyUserInvitationPostCustomerRegistrationPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\CustomerExtension\Dependency\Plugin\CustomerTableActionExpanderPluginInterface[]
     */
    protected function getCustomerTableActionExpanderPlugins(): array
    {
        return [
           new CompanyUserCustomerTableActionExpanderPlugin(),
        ];
    }
}

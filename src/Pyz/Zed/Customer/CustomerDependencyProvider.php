<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Customer;

use Spryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Customer\AvailabilityNotificationSubscriptionCustomerTransferExpanderPlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\CustomerAnonymizer\AvailabilityNotificationAnonymizerPlugin;
use Spryker\Zed\BusinessOnBehalf\Communication\Plugin\Customer\DefaultCompanyUserCustomerTransferExpanderPlugin;
use Spryker\Zed\BusinessOnBehalf\Communication\Plugin\Customer\IsOnBehalfCustomerTransferExpanderPlugin;
use Spryker\Zed\BusinessOnBehalfGui\Communication\Plugin\Customer\BusinessOnBehalfGuiAttachToCompanyButtonCustomerTableActionExpanderPlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\PermissionCustomerExpanderPlugin;
use Spryker\Zed\CompanyUser\Communication\Plugin\Customer\CompanyUserReloadCustomerTransferExpanderPlugin;
use Spryker\Zed\CompanyUser\Communication\Plugin\Customer\CustomerTransferCompanyUserExpanderPlugin;
use Spryker\Zed\CompanyUser\Communication\Plugin\Customer\IsActiveCompanyUserExistsCustomerTransferExpanderPlugin;
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
    /**
     * @var string
     */
    public const FACADE_SALES = 'sales facade';

    /**
     * @var string
     */
    public const FACADE_NEWSLETTER = 'newsletter facade';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addFacadeSales($container);
        $container = $this->addFacadeNewsletter($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeSales(Container $container): Container
    {
        $container->set(static::FACADE_SALES, function (Container $container) {
            return $container->getLocator()->sales()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeNewsletter(Container $container): Container
    {
        $container->set(static::FACADE_NEWSLETTER, function (Container $container) {
            return $container->getLocator()->newsletter()->facade();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Zed\Customer\Dependency\Plugin\CustomerAnonymizerPluginInterface>
     */
    protected function getCustomerAnonymizerPlugins(): array
    {
        return [
            new CustomerUnsubscribePlugin([
                NewsletterConstants::DEFAULT_NEWSLETTER_TYPE,
            ]),
            new RemoveCustomerFromGroupPlugin(),
            new AvailabilityNotificationAnonymizerPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\Customer\Dependency\Plugin\CustomerTransferExpanderPluginInterface>
     */
    protected function getCustomerTransferExpanderPlugins(): array
    {
        return [
            new CustomerTransferUsernameExpanderPlugin(),
            new CompanyUserReloadCustomerTransferExpanderPlugin(),
            new CustomerTransferCompanyUserExpanderPlugin(),
            new IsActiveCompanyUserExistsCustomerTransferExpanderPlugin(),
            new PermissionCustomerExpanderPlugin(),
            new QuotePermissionCustomerExpanderPlugin(), #SharedCartFeature
            new ShoppingListPermissionCustomerExpanderPlugin(),
            new IsOnBehalfCustomerTransferExpanderPlugin(), #BusinessOnBefalfFeature
            new DefaultCompanyUserCustomerTransferExpanderPlugin(), #BusinessOnBefalfFeature
            new ProductListCustomerTransferExpanderPlugin(),
            new AvailabilityNotificationSubscriptionCustomerTransferExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CustomerExtension\Dependency\Plugin\PostCustomerRegistrationPluginInterface>
     */
    protected function getPostCustomerRegistrationPlugins(): array
    {
        return [
            new CompanyUserInvitationPostCustomerRegistrationPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CustomerExtension\Dependency\Plugin\CustomerTableActionExpanderPluginInterface>
     */
    protected function getCustomerTableActionExpanderPlugins(): array
    {
        return [
            new CompanyUserCustomerTableActionExpanderPlugin(),
            new BusinessOnBehalfGuiAttachToCompanyButtonCustomerTableActionExpanderPlugin(),
        ];
    }
}

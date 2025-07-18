<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CustomerPage;

use Spryker\Yves\Kernel\Container;
use Spryker\Yves\MultiFactorAuth\Plugin\AuthenticationHandler\Customer\CustomerMultiFactorAuthenticationHandlerPlugin;
use SprykerFeature\Yves\SelfServicePortal\Plugin\CustomerPage\SingleAddressPerShipmentTypeCheckoutMultiShippingAddressesFormExpanderPlugin;
use SprykerShop\Yves\AgentPage\Plugin\FixAgentTokenAfterCustomerAuthenticationSuccessPlugin;
use SprykerShop\Yves\AgentPage\Plugin\Security\UpdateAgentTokenAfterCustomerAuthenticationSuccessPlugin;
use SprykerShop\Yves\ClickAndCollectPageExample\Plugin\CustomerPage\ClickAndCollectServiceTypeCheckoutAddressCollectionFormExpanderPlugin;
use SprykerShop\Yves\ClickAndCollectPageExample\Plugin\CustomerPage\ClickAndCollectServiceTypeCheckoutMultiShippingAddressesFormExpanderPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\BusinessOnBehalfCompanyUserRedirectAfterLoginStrategyPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\CompanyBusinessUnitOrderSearchFormExpanderPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\CompanyBusinessUnitOrderSearchFormHandlerPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\CompanyUserPreAuthUserCheckPlugin;
use SprykerShop\Yves\CompanyUserInvitationPage\Plugin\CompanyUserInvitationPreRegistrationCustomerTransferExpanderPlugin;
use SprykerShop\Yves\CustomerPage\CustomerPageDependencyProvider as SprykerShopCustomerPageDependencyProvider;
use SprykerShop\Yves\CustomerPage\Plugin\CustomerPage\RedirectUriCustomerRedirectStrategyPlugin;
use SprykerShop\Yves\CustomerReorderWidget\Plugin\CustomerPage\CustomerReorderWidgetPlugin;
use SprykerShop\Yves\ServicePointWidget\Plugin\CustomerPage\ServicePointAddressCheckoutAddressCollectionFormExpanderPlugin;
use SprykerShop\Yves\ServicePointWidget\Plugin\CustomerPage\ServicePointCheckoutAddressCollectionFormExpanderPlugin;
use SprykerShop\Yves\ServicePointWidget\Plugin\CustomerPage\ServicePointCheckoutMultiShippingAddressesFormExpanderPlugin;
use SprykerShop\Yves\SessionAgentValidation\Plugin\CustomerPage\UpdateAgentSessionAfterCustomerAuthenticationSuccessPlugin;
use SprykerShop\Yves\ShipmentTypeWidget\Plugin\CustomerPage\ShipmentTypeCheckoutAddressCollectionFormExpanderPlugin;
use SprykerShop\Yves\ShipmentTypeWidget\Plugin\CustomerPage\ShipmentTypeCheckoutAddressStepPreGroupItemsByShipmentPlugin;
use SprykerShop\Yves\ShipmentTypeWidget\Plugin\CustomerPage\ShipmentTypeCheckoutMultiShippingAddressesFormExpanderPlugin;

class CustomerPageDependencyProvider extends SprykerShopCustomerPageDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_PYZ_SESSION = 'CLIENT_PYZ_SESSION';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addPyzSessionClient($container);

        return $container;
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\PreRegistrationCustomerTransferExpanderPluginInterface>
     */
    protected function getPreRegistrationCustomerTransferExpanderPlugins(): array
    {
        return [
            new CompanyUserInvitationPreRegistrationCustomerTransferExpanderPlugin(), #BulkImportCompanyUserInvitationsFeature
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\CustomerRedirectStrategyPluginInterface>
     */
    protected function getAfterLoginCustomerRedirectPlugins(): array
    {
        return [
            new BusinessOnBehalfCompanyUserRedirectAfterLoginStrategyPlugin(), #BusinessOnBehalfFeature
            new RedirectUriCustomerRedirectStrategyPlugin(),
        ];
    }

    /**
     * @return list<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\AfterCustomerAuthenticationSuccessPluginInterface>
     */
    protected function getAfterCustomerAuthenticationSuccessPlugins(): array
    {
        return [
            new FixAgentTokenAfterCustomerAuthenticationSuccessPlugin(),
            new UpdateAgentTokenAfterCustomerAuthenticationSuccessPlugin(),
            new UpdateAgentSessionAfterCustomerAuthenticationSuccessPlugin(),
        ];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addPyzSessionClient(Container $container): Container
    {
        $container->set(static::CLIENT_PYZ_SESSION, function (Container $container) {
            return $container->getLocator()->session()->client();
        });

        return $container;
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\OrderSearchFormExpanderPluginInterface>
     */
    protected function getOrderSearchFormExpanderPlugins(): array
    {
        return [
            new CompanyBusinessUnitOrderSearchFormExpanderPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\OrderSearchFormHandlerPluginInterface>
     */
    protected function getOrderSearchFormHandlerPlugins(): array
    {
        return [
            new CompanyBusinessUnitOrderSearchFormHandlerPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\PreAuthUserCheckPluginInterface>
     */
    protected function getPreAuthUserCheckPlugins(): array
    {
        return [
            new CompanyUserPreAuthUserCheckPlugin(),
        ];
    }

    /**
     * @return list<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\CheckoutAddressCollectionFormExpanderPluginInterface>
     */
    protected function getCheckoutAddressCollectionFormExpanderPlugins(): array
    {
        return [
            new ShipmentTypeCheckoutAddressCollectionFormExpanderPlugin(),
            new ServicePointCheckoutAddressCollectionFormExpanderPlugin(),
            new ServicePointAddressCheckoutAddressCollectionFormExpanderPlugin(),
            new ClickAndCollectServiceTypeCheckoutAddressCollectionFormExpanderPlugin(),
        ];
    }

    /**
     * @return list<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\CheckoutMultiShippingAddressesFormExpanderPluginInterface>
     */
    protected function getCheckoutMultiShippingAddressesFormExpanderPlugins(): array
    {
        return [
            new ShipmentTypeCheckoutMultiShippingAddressesFormExpanderPlugin(),
            new ServicePointCheckoutMultiShippingAddressesFormExpanderPlugin(),
            new ClickAndCollectServiceTypeCheckoutMultiShippingAddressesFormExpanderPlugin(),
            new SingleAddressPerShipmentTypeCheckoutMultiShippingAddressesFormExpanderPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\CheckoutAddressStepPreGroupItemsByShipmentPluginInterface>
     */
    protected function getCheckoutAddressStepPreGroupItemsByShipmentPlugins(): array
    {
        return [
            new ShipmentTypeCheckoutAddressStepPreGroupItemsByShipmentPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerPageExtension\Dependency\Plugin\AuthenticationHandlerPluginInterface>
     */
    protected function getCustomerAuthenticationHandlerPlugins(): array
    {
        return [
            new CustomerMultiFactorAuthenticationHandlerPlugin(),
        ];
    }
}

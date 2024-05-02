<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\AgentPage\Plugin\FixAgentTokenAfterCustomerAuthenticationSuccessPlugin;
use SprykerShop\Yves\AgentPage\Plugin\Security\UpdateAgentTokenAfterCustomerAuthenticationSuccessPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\BusinessOnBehalfCompanyUserRedirectAfterLoginStrategyPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\CompanyBusinessUnitOrderSearchFormExpanderPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\CompanyBusinessUnitOrderSearchFormHandlerPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\CustomerPage\CompanyUserPreAuthUserCheckPlugin;
use SprykerShop\Yves\CompanyUserInvitationPage\Plugin\CompanyUserInvitationPreRegistrationCustomerTransferExpanderPlugin;
use SprykerShop\Yves\CustomerPage\CustomerPageDependencyProvider as SprykerShopCustomerPageDependencyProvider;
use SprykerShop\Yves\CustomerPage\Plugin\CustomerPage\RedirectUriCustomerRedirectStrategyPlugin;
use SprykerShop\Yves\CustomerReorderWidget\Plugin\CustomerPage\CustomerReorderWidgetPlugin;
use SprykerShop\Yves\SessionAgentValidation\Plugin\CustomerPage\UpdateAgentSessionAfterCustomerAuthenticationSuccessPlugin;

class CustomerPageDependencyProvider extends SprykerShopCustomerPageDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_SESSION = 'CLIENT_SESSION';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addSessionClient($container);

        return $container;
    }

    /**
     * @return array<string>
     */
    protected function getCustomerOverviewWidgetPlugins(): array
    {
        return [
            CustomerReorderWidgetPlugin::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getCustomerOrderListWidgetPlugins(): array
    {
        return [
            CustomerReorderWidgetPlugin::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getCustomerOrderViewWidgetPlugins(): array
    {
        return [
            CustomerReorderWidgetPlugin::class,
        ];
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
    protected function addSessionClient(Container $container): Container
    {
        $container->set(static::CLIENT_SESSION, function (Container $container) {
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
}

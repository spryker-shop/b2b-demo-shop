<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Customer;

use Spryker\Client\Agent\Plugin\Customer\AgentAccessCustomerSecuredPatternRulePlugin;
use Spryker\Client\Cart\Plugin\CustomerChangeCartUpdatePlugin;
use Spryker\Client\Customer\CustomerDependencyProvider as SprykerCustomerDependencyProvider;
use Spryker\Client\Customer\Plugin\CustomerAddressSessionUpdatePlugin;
use Spryker\Client\Customer\Plugin\CustomerTransferSessionRefreshPlugin;
use Spryker\Client\CustomerAccessPermission\Plugin\Customer\CustomerAccessSecuredPatternRulePlugin;
use Spryker\Client\CustomerExtension\Dependency\Plugin\AccessTokenAuthenticationHandlerPluginInterface;
use Spryker\Client\MultiCart\Plugin\GuestCartSaveCustomerSessionSetPlugin;
use Spryker\Client\OauthCompanyUser\Plugin\Customer\CompanyUserAccessTokenAuthenticationHandlerPlugin;
use Spryker\Client\PersistentCart\Plugin\GuestCartUpdateCustomerSessionSetPlugin;

class CustomerDependencyProvider extends SprykerCustomerDependencyProvider
{
    /**
     * @return \Spryker\Client\Customer\Dependency\Plugin\CustomerSessionGetPluginInterface[]
     */
    protected function getCustomerSessionGetPlugins()
    {
        return [
            new CustomerTransferSessionRefreshPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\Customer\Dependency\Plugin\CustomerSessionSetPluginInterface[]
     */
    protected function getCustomerSessionSetPlugins()
    {
        return [
            new GuestCartSaveCustomerSessionSetPlugin(), #MultiCartFeature
            new GuestCartUpdateCustomerSessionSetPlugin(), #PersistentCartFeature
            new CustomerChangeCartUpdatePlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\Customer\Dependency\Plugin\DefaultAddressChangePluginInterface[]
     */
    protected function getDefaultAddressChangePlugins()
    {
        return [
            new CustomerAddressSessionUpdatePlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\CustomerExtension\Dependency\Plugin\CustomerSecuredPatternRulePluginInterface[]
     */
    protected function getCustomerSecuredPatternRulePlugins(): array
    {
        return [
            new CustomerAccessSecuredPatternRulePlugin(), #CustomerAccessPermissionFeature
            new AgentAccessCustomerSecuredPatternRulePlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\CustomerExtension\Dependency\Plugin\AccessTokenAuthenticationHandlerPluginInterface
     */
    protected function getAccessTokenAuthenticationHandlerPlugin(): CompanyUserAccessTokenAuthenticationHandlerPlugin
    {
        return new CompanyUserAccessTokenAuthenticationHandlerPlugin();
    }
}

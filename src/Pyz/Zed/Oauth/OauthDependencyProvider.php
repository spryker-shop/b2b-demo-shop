<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Oauth;

use Spryker\Zed\Oauth\OauthDependencyProvider as SprykerOauthDependencyProvider;
use Spryker\Zed\OauthAgentConnector\Communication\Plugin\Oauth\AgentCredentialsOauthGrantTypeConfigurationProviderPlugin;
use Spryker\Zed\OauthAgentConnector\Communication\Plugin\Oauth\AgentOauthScopeProviderPlugin;
use Spryker\Zed\OauthAgentConnector\Communication\Plugin\Oauth\AgentOauthUserProviderPlugin;
use Spryker\Zed\OauthCompanyUser\Communication\Plugin\Oauth\CompanyUserAccessTokenOauthGrantTypeConfigurationProviderPlugin;
use Spryker\Zed\OauthCompanyUser\Communication\Plugin\Oauth\CompanyUserAccessTokenOauthUserProviderPlugin;
use Spryker\Zed\OauthCompanyUser\Communication\Plugin\Oauth\CompanyUserOauthScopeProviderPlugin;
use Spryker\Zed\OauthCompanyUser\Communication\Plugin\Oauth\CompanyUserOauthUserProviderPlugin;
use Spryker\Zed\OauthCompanyUser\Communication\Plugin\Oauth\IdCompanyUserOauthGrantTypeConfigurationProviderPlugin;
use Spryker\Zed\OauthCustomerConnector\Communication\Plugin\Oauth\CustomerImpersonationOauthGrantTypeConfigurationProviderPlugin;
use Spryker\Zed\OauthCustomerConnector\Communication\Plugin\Oauth\CustomerImpersonationOauthScopeProviderPlugin;
use Spryker\Zed\OauthCustomerConnector\Communication\Plugin\Oauth\CustomerImpersonationOauthUserProviderPlugin;
use Spryker\Zed\OauthCustomerConnector\Communication\Plugin\Oauth\CustomerOauthScopeProviderPlugin;
use Spryker\Zed\OauthCustomerConnector\Communication\Plugin\Oauth\CustomerOauthUserProviderPlugin;
use Spryker\Zed\OauthPermission\Communication\Plugin\Filter\OauthUserIdentifierFilterPermissionPlugin;
use Spryker\Zed\OauthRevoke\Communication\Plugin\Oauth\OauthExpiredRefreshTokenRemoverPlugin;
use Spryker\Zed\OauthRevoke\Communication\Plugin\Oauth\OauthRefreshTokenCheckerPlugin;
use Spryker\Zed\OauthRevoke\Communication\Plugin\Oauth\OauthRefreshTokenPersistencePlugin;
use Spryker\Zed\OauthRevoke\Communication\Plugin\Oauth\OauthRefreshTokenReaderPlugin;
use Spryker\Zed\OauthRevoke\Communication\Plugin\Oauth\OauthRefreshTokenRevokerPlugin;
use Spryker\Zed\OauthRevoke\Communication\Plugin\Oauth\OauthRefreshTokensReaderPlugin;
use Spryker\Zed\OauthRevoke\Communication\Plugin\Oauth\OauthRefreshTokensRevokerPlugin;

class OauthDependencyProvider extends SprykerOauthDependencyProvider
{
    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthUserProviderPluginInterface[]
     */
    protected function getUserProviderPlugins(): array
    {
        return [
            new CustomerOauthUserProviderPlugin(),
            new CompanyUserOauthUserProviderPlugin(),
            new AgentOauthUserProviderPlugin(),
            new CustomerImpersonationOauthUserProviderPlugin(),
            new CompanyUserAccessTokenOauthUserProviderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthScopeProviderPluginInterface[]
     */
    protected function getScopeProviderPlugins(): array
    {
        return [
            new CustomerOauthScopeProviderPlugin(),
            new CompanyUserOauthScopeProviderPlugin(),
            new AgentOauthScopeProviderPlugin(),
            new CustomerImpersonationOauthScopeProviderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthGrantTypeConfigurationProviderPluginInterface[]
     */
    protected function getGrantTypeConfigurationProviderPlugins(): array
    {
        return array_merge(parent::getGrantTypeConfigurationProviderPlugins(), [
            new IdCompanyUserOauthGrantTypeConfigurationProviderPlugin(),
            new CompanyUserAccessTokenOauthGrantTypeConfigurationProviderPlugin(),
            new AgentCredentialsOauthGrantTypeConfigurationProviderPlugin(),
            new CustomerImpersonationOauthGrantTypeConfigurationProviderPlugin(),
        ]);
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthUserIdentifierFilterPluginInterface[]
     */
    protected function getOauthUserIdentifierFilterPlugins(): array
    {
        return [
            new OauthUserIdentifierFilterPermissionPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenRevokerPluginInterface[]
     */
    protected function getOauthRefreshTokenRevokerPlugins(): array
    {
        return [
            new OauthRefreshTokenRevokerPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokensRevokerPluginInterface[]
     */
    protected function getOauthRefreshTokensRevokerPlugins(): array
    {
        return [
            new OauthRefreshTokensRevokerPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenPersistencePluginInterface[]
     */
    protected function getOauthRefreshTokenPersistencePlugins(): array
    {
        return [
            new OauthRefreshTokenPersistencePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenCheckerPluginInterface[]
     */
    protected function getOauthRefreshTokenCheckerPlugins(): array
    {
        return [
            new OauthRefreshTokenCheckerPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthExpiredRefreshTokenRemoverPluginInterface[]
     */
    protected function getOauthExpiredRefreshTokenRemoverPlugins(): array
    {
        return [
            new OauthExpiredRefreshTokenRemoverPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokenReaderPluginInterface[]
     */
    protected function getOauthRefreshTokenReaderPlugins(): array
    {
        return [
            new OauthRefreshTokenReaderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\OauthRefreshTokensReaderPluginInterface[]
     */
    protected function getOauthRefreshTokensReaderPlugins(): array
    {
        return [
            new OauthRefreshTokensReaderPlugin(),
        ];
    }
}

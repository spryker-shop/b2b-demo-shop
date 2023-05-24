<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\GlueStorefrontApiApplication;

use Spryker\Glue\GlueStorefrontApiApplication\GlueStorefrontApiApplicationDependencyProvider as SprykerGlueStorefrontApiApplicationDependencyProvider;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\ApplicationIdentifierRequestBuilderPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\LocaleRequestBuilderPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\RequestCorsValidatorPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\ScopeRequestAfterRoutingValidatorPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\SecurityHeaderResponseFormatterPlugin;
use Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\Plugin\GlueStorefrontApiApplicationAuthorizationConnector\AuthorizationRequestAfterRoutingValidatorPlugin;
use Spryker\Glue\Http\Plugin\Application\HttpApplicationPlugin;
use Spryker\Glue\Locale\Plugin\Application\LocaleApplicationPlugin;
use Spryker\Glue\OauthApi\Plugin\AccessTokenValidatorPlugin;
use Spryker\Glue\OauthApi\Plugin\CustomerRequestBuilderPlugin;
use Spryker\Glue\OauthApi\Plugin\GlueApplication\CustomerRequestValidatorPlugin;
use Spryker\Glue\OauthApi\Plugin\GlueApplication\OauthApiTokenResource;
use Spryker\Glue\StoresRestApi\Plugin\Application\StoreHttpHeaderApplicationPlugin;

class GlueStorefrontApiApplicationDependencyProvider extends SprykerGlueStorefrontApiApplicationDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestBuilderPluginInterface>
     */
    protected function getRequestBuilderPlugins(): array
    {
        return [
            new ApplicationIdentifierRequestBuilderPlugin(),
            new LocaleRequestBuilderPlugin(),
            new CustomerRequestBuilderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestValidatorPluginInterface>
     */
    protected function getRequestValidatorPlugins(): array
    {
        return [
            new AccessTokenValidatorPlugin(),
            new CustomerRequestValidatorPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestAfterRoutingValidatorPluginInterface>
     */
    protected function getRequestAfterRoutingValidatorPlugins(): array
    {
        return [
            new RequestCorsValidatorPlugin(),
            new ScopeRequestAfterRoutingValidatorPlugin(),
            new AuthorizationRequestAfterRoutingValidatorPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResponseFormatterPluginInterface>
     */
    protected function getResponseFormatterPlugins(): array
    {
        return [
            new SecurityHeaderResponseFormatterPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceInterface>
     */
    protected function getResourcePlugins(): array
    {
        return [
            new OauthApiTokenResource(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RouteProviderPluginInterface>
     */
    protected function getRouteProviderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface>
     */
    protected function getApplicationPlugins(): array
    {
        return [
            new HttpApplicationPlugin(),
            new StoreHttpHeaderApplicationPlugin(),
            new LocaleApplicationPlugin(),
        ];
    }
}

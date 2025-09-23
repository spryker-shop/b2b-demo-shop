<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Glue\GlueBackendApiApplication;

use Spryker\Glue\DynamicEntityBackendApi\Plugin\GlueApplication\DynamicEntityRouteProviderPlugin;
use Spryker\Glue\EventDispatcher\Plugin\GlueBackendApiApplication\EventDispatcherApplicationPlugin;
use Spryker\Glue\GlueBackendApiApplication\GlueBackendApiApplicationDependencyProvider as SprykerGlueBackendApiApplicationDependencyProvider;
use Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\ApplicationIdentifierRequestBuilderPlugin;
use Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\LocaleRequestBuilderPlugin;
use Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\RequestCorsValidatorPlugin;
use Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\ScopeRequestAfterRoutingValidatorPlugin;
use Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\SecurityHeaderResponseFormatterPlugin;
use Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\StrictTransportSecurityHeaderResponseFormatterPlugin;
use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\Plugin\GlueBackendApiApplication\AuthorizationRequestAfterRoutingValidatorPlugin;
use Spryker\Glue\Http\Plugin\Application\HttpApplicationPlugin;
use Spryker\Glue\Locale\Plugin\Application\LocaleApplicationPlugin;
use Spryker\Glue\MultiFactorAuth\Plugin\GlueBackendApiApplication\MultiFactorAuthBackendApiRequestValidatorPlugin;
use Spryker\Glue\MultiFactorAuth\Plugin\GlueBackendApiApplication\MultiFactorAuthBackendResourcePlugin;
use Spryker\Glue\MultiFactorAuth\Plugin\GlueBackendApiApplication\MultiFactorAuthTriggerBackendResourcePlugin;
use Spryker\Glue\MultiFactorAuth\Plugin\GlueBackendApiApplication\MultiFactorAuthTypeActivateBackendResourcePlugin;
use Spryker\Glue\MultiFactorAuth\Plugin\GlueBackendApiApplication\MultiFactorAuthTypeDeactivateBackendResourcePlugin;
use Spryker\Glue\MultiFactorAuth\Plugin\GlueBackendApiApplication\MultiFactorAuthTypeVerifyBackendResourcePlugin;
use Spryker\Glue\OauthBackendApi\Plugin\GlueApplication\BackendApiAccessTokenValidatorPlugin;
use Spryker\Glue\OauthBackendApi\Plugin\GlueApplication\OauthBackendApiTokenResource;
use Spryker\Glue\OauthBackendApi\Plugin\GlueApplication\UserRequestValidatorPlugin;
use Spryker\Glue\OauthBackendApi\Plugin\UserRequestBuilderPlugin;
use Spryker\Glue\Router\Plugin\Application\RouterApplicationPlugin;
use Spryker\Glue\StoresApi\Plugin\GlueBackendApiApplication\StoreApplicationPlugin as ClientStoreApplicationPlugin;
use Spryker\Glue\StoresBackendApi\Plugin\GlueBackendApiApplication\StoreApplicationPlugin;
use Spryker\Glue\TestifyBackendApi\Plugin\GlueBackendApiApplication\DynamicFixturesBackendResourcePlugin;
use Spryker\Zed\Propel\Communication\Plugin\Application\PropelApplicationPlugin;
use Spryker\Zed\Twig\Communication\Plugin\Application\TwigApplicationPlugin;
use SprykerFeature\Glue\SelfServicePortal\Plugin\GlueBackendApiApplication\SspAssetsBackendResourcePlugin;

class GlueBackendApiApplicationDependencyProvider extends SprykerGlueBackendApiApplicationDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface>
     */
    protected function getApplicationPlugins(): array
    {
        return [
            new HttpApplicationPlugin(),
            new PropelApplicationPlugin(),
            new ClientStoreApplicationPlugin(),
            new StoreApplicationPlugin(),
            new RouterApplicationPlugin(),
            new EventDispatcherApplicationPlugin(),
            new LocaleApplicationPlugin(),
            new TwigApplicationPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestBuilderPluginInterface>
     */
    protected function getRequestBuilderPlugins(): array
    {
        return [
            new ApplicationIdentifierRequestBuilderPlugin(),
            new LocaleRequestBuilderPlugin(),
            new UserRequestBuilderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestValidatorPluginInterface>
     */
    protected function getRequestValidatorPlugins(): array
    {
        return [
            new BackendApiAccessTokenValidatorPlugin(),
            new UserRequestValidatorPlugin(),
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
            new MultiFactorAuthBackendApiRequestValidatorPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResponseFormatterPluginInterface>
     */
    protected function getResponseFormatterPlugins(): array
    {
        return [
            new SecurityHeaderResponseFormatterPlugin(),
            new StrictTransportSecurityHeaderResponseFormatterPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceInterface>
     */
    protected function getResourcePlugins(): array
    {
        $plugins = [
            new OauthBackendApiTokenResource(),
            new MultiFactorAuthBackendResourcePlugin(),
            new MultiFactorAuthTriggerBackendResourcePlugin(),
            new MultiFactorAuthTypeActivateBackendResourcePlugin(),
            new MultiFactorAuthTypeDeactivateBackendResourcePlugin(),
            new MultiFactorAuthTypeVerifyBackendResourcePlugin(),
            new SspAssetsBackendResourcePlugin(),
        ];

        if (class_exists(DynamicFixturesBackendResourcePlugin::class)) {
            $plugins[] = new DynamicFixturesBackendResourcePlugin();
        }

        return $plugins;
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RouteProviderPluginInterface>
     */
    protected function getRouteProviderPlugins(): array
    {
        return [
            new DynamicEntityRouteProviderPlugin(),
        ];
    }
}

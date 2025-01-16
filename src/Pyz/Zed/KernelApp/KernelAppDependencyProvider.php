<?php



declare(strict_types = 1);

namespace Pyz\Zed\KernelApp;

use Spryker\Zed\KernelApp\KernelAppDependencyProvider as SprykerKernelAppDependencyProvider;
use Spryker\Zed\OauthClient\Communication\Plugin\KernelApp\OAuthRequestExpanderPlugin;

class KernelAppDependencyProvider extends SprykerKernelAppDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\KernelAppExtension\RequestExpanderPluginInterface>
     */
    public function getRequestExpanderPlugins(): array
    {
        return [
            new OAuthRequestExpanderPlugin(),
        ];
    }
}

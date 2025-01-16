<?php



declare(strict_types = 1);

namespace Pyz\Zed\Http;

use Spryker\Zed\Http\Communication\Plugin\Http\HIncludeRendererFragmentHandlerPlugin;
use Spryker\Zed\Http\Communication\Plugin\Http\InlineRendererFragmentHandlerPlugin;
use Spryker\Zed\Http\HttpDependencyProvider as SprykerHttpDependencyProvider;

class HttpDependencyProvider extends SprykerHttpDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\HttpExtension\Dependency\Plugin\FragmentHandlerPluginInterface>
     */
    protected function getFragmentHandlerPlugins(): array
    {
        return [
            new InlineRendererFragmentHandlerPlugin(),
            new HIncludeRendererFragmentHandlerPlugin(),
        ];
    }
}

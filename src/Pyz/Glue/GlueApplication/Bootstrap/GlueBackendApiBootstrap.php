<?php



declare(strict_types = 1);

namespace Pyz\Glue\GlueApplication\Bootstrap;

use Spryker\Glue\GlueApplication\Bootstrap\GlueBootstrap;
use Spryker\Glue\GlueBackendApiApplication\Plugin\GlueApplication\BackendApiGlueApplicationBootstrapPlugin;
use Spryker\Shared\Application\ApplicationInterface;

class GlueBackendApiBootstrap extends GlueBootstrap
{
    /**
     * @param array<string> $glueApplicationBootstrapPluginClassNames
     *
     * @return \Spryker\Shared\Application\ApplicationInterface
     */
    public function boot(array $glueApplicationBootstrapPluginClassNames = []): ApplicationInterface // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return parent::boot([BackendApiGlueApplicationBootstrapPlugin::class]);
    }
}

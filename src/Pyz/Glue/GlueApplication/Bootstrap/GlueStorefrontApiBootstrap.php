<?php



declare(strict_types = 1);

namespace Pyz\Glue\GlueApplication\Bootstrap;

use Spryker\Glue\GlueApplication\Bootstrap\GlueBootstrap;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\StorefrontApiGlueApplicationBootstrapPlugin;
use Spryker\Shared\Application\ApplicationInterface;

class GlueStorefrontApiBootstrap extends GlueBootstrap
{
    /**
     * @param array<string> $glueApplicationBootstrapPluginClassNames
     *
     * @return \Spryker\Shared\Application\ApplicationInterface
     */
    public function boot(array $glueApplicationBootstrapPluginClassNames = []): ApplicationInterface // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return parent::boot([StorefrontApiGlueApplicationBootstrapPlugin::class]);
    }
}

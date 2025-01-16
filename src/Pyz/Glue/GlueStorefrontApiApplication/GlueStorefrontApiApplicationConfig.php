<?php



declare(strict_types = 1);

namespace Pyz\Glue\GlueStorefrontApiApplication;

use Spryker\Glue\GlueStorefrontApiApplication\GlueStorefrontApiApplicationConfig as SprykerGlueStorefrontApiApplicationConfig;

class GlueStorefrontApiApplicationConfig extends SprykerGlueStorefrontApiApplicationConfig
{
    /**
     * @var string
     */
    protected const HEADER_CACHE_CONTROL_VALUE = 'no-cache, private';

    /**
     * @return array<string, string>
     */
    public function getSecurityHeaders(): array
    {
        return array_merge(
            parent::getSecurityHeaders(),
            ['Cache-Control' => static::HEADER_CACHE_CONTROL_VALUE],
        );
    }
}

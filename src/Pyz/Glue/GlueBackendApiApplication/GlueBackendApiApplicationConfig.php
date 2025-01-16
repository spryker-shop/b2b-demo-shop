<?php



declare(strict_types = 1);

namespace Pyz\Glue\GlueBackendApiApplication;

use Spryker\Glue\GlueBackendApiApplication\GlueBackendApiApplicationConfig as SprykerGlueBackendApiApplicationConfig;

class GlueBackendApiApplicationConfig extends SprykerGlueBackendApiApplicationConfig
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

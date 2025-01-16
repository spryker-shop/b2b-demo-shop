<?php



declare(strict_types = 1);

namespace Pyz\Zed\SearchElasticsearch;

use Spryker\Zed\SearchElasticsearch\SearchElasticsearchConfig as SprykerSearchElasticsearchConfig;

/**
 * @method \Spryker\Shared\SearchElasticsearch\SearchElasticsearchConfig getSharedConfig()
 */
class SearchElasticsearchConfig extends SprykerSearchElasticsearchConfig
{
    /**
     * @return array<string>
     */
    public function getJsonSchemaDefinitionDirectories(): array
    {
        $directories = parent::getJsonSchemaDefinitionDirectories();
        $directories[] = sprintf('%s/src/Pyz/Shared/*/Schema/', APPLICATION_ROOT_DIR);

        return $directories;
    }
}

<?php



declare(strict_types = 1);

namespace Pyz\Glue\EntityTagsRestApi;

use Spryker\Glue\CartsRestApi\CartsRestApiConfig;
use Spryker\Glue\EntityTagsRestApi\EntityTagsRestApiConfig as SprykerEntityTagsRestApiConfig;

class EntityTagsRestApiConfig extends SprykerEntityTagsRestApiConfig
{
    /**
     * @return array<string>
     */
    public function getEntityTagRequiredResources(): array
    {
        return array_merge(
            parent::getEntityTagRequiredResources(),
            [CartsRestApiConfig::RESOURCE_CARTS],
        );
    }
}

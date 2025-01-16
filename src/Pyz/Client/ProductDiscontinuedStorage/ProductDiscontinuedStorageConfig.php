<?php



declare(strict_types = 1);

namespace Pyz\Client\ProductDiscontinuedStorage;

use Spryker\Client\ProductDiscontinuedStorage\ProductDiscontinuedStorageConfig as SprykerProductDiscontinuedStorageConfig;

class ProductDiscontinuedStorageConfig extends SprykerProductDiscontinuedStorageConfig
{
    /**
     * @return bool
     */
    public function isOnlyDiscontinuedVariantAttributesPostfixEnabled(): bool
    {
        return true;
    }
}

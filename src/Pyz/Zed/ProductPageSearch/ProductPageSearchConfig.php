<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductPageSearch;

use Spryker\Shared\ProductPageSearch\ProductPageSearchConfig as SprykerSharedProductPageSearchConfig;
use Spryker\Zed\ProductPageSearch\ProductPageSearchConfig as SprykerProductPageSearchConfig;

class ProductPageSearchConfig extends SprykerProductPageSearchConfig
{
    /**
     * @return string|null
     */
    public function getProductPageEventQueueName(): ?string
    {
        return SprykerSharedProductPageSearchConfig::PUBLISH_PRODUCT_ABSTRACT_PAGE;
    }

    /**
     * @return string|null
     */
    public function getProductConcretePageEventQueueName(): ?string
    {
        return SprykerSharedProductPageSearchConfig::PUBLISH_PRODUCT_CONCRETE_PAGE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return bool
     */
    public function isProductAbstractAddToCartEnabled(): bool
    {
        return true;
    }
}

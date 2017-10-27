<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DiscountPromotion;

use Spryker\Yves\DiscountPromotion\DiscountPromotionFactory as SprykerDiscountPromotionFactory;
use SprykerShop\Yves\ProductDetailPage\Plugin\StorageProductMapperPlugin;

class DiscountPromotionFactory extends SprykerDiscountPromotionFactory
{
    /**
     * @return \SprykerShop\Yves\ProductDetailPage\Plugin\StorageProductMapperPlugin
     */
    public function createStorageProductMapperPlugin()
    {
        return new StorageProductMapperPlugin();
    }
}

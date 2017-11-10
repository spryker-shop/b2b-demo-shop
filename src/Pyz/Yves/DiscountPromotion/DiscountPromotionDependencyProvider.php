<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DiscountPromotion;

use Spryker\Yves\DiscountPromotion\DiscountPromotionDependencyProvider as SprykerDiscountPromotionDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\StorageProductMapperPlugin;

class DiscountPromotionDependencyProvider extends SprykerDiscountPromotionDependencyProvider
{
    /**
     * {@inheritdoc}
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\DiscountPromotion\Dependency\StorageProductMapperPluginInterface
     */
    protected function getProductMapperPlugin(Container $container)
    {
        return new StorageProductMapperPlugin();
    }
}

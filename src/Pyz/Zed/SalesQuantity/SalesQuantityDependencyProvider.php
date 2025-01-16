<?php



declare(strict_types = 1);

namespace Pyz\Zed\SalesQuantity;

use Spryker\Zed\DiscountPromotion\Communication\Plugin\SalesQuantity\NonSplittablePromotionProductItemFilterPlugin;
use Spryker\Zed\SalesQuantity\SalesQuantityDependencyProvider as SprykerSalesQuantityDependencyProvider;

class SalesQuantityDependencyProvider extends SprykerSalesQuantityDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\SalesQuantityExtension\Dependency\Plugin\NonSplittableItemFilterPluginInterface>
     */
    protected function getNonSplittableItemFilterPlugins(): array
    {
        return [
            new NonSplittablePromotionProductItemFilterPlugin(),
        ];
    }
}

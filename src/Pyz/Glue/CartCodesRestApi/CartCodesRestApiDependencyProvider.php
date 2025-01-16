<?php



declare(strict_types = 1);

namespace Pyz\Glue\CartCodesRestApi;

use Spryker\Glue\CartCodesRestApi\CartCodesRestApiDependencyProvider as SprykerCartCodesRestApiDependencyProvider;
use Spryker\Glue\DiscountPromotionsRestApi\Plugin\CartCodesRestApi\DiscountPromotionDiscountMapperPlugin;

class CartCodesRestApiDependencyProvider extends SprykerCartCodesRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\CartCodesRestApiExtension\Dependency\Plugin\DiscountMapperPluginInterface>
     */
    protected function getDiscountMapperPlugins(): array
    {
        return [
            new DiscountPromotionDiscountMapperPlugin(),
        ];
    }
}

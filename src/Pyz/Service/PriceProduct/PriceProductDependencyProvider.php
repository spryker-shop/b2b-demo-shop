<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Service\PriceProduct;

use Spryker\Service\PriceProduct\PriceProductDependencyProvider as SprykerPriceProductDependencyProvider;
use Spryker\Service\PriceProductMerchantRelationship\Plugin\MerchantRelationshipPriceDecisionPlugin;

class PriceProductDependencyProvider extends SprykerPriceProductDependencyProvider
{
    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Service\PriceProduct\Dependency\Plugin\PriceProductDecisionPluginInterface[]
     */
    protected function getPriceProductDecisionPlugins(): array
    {
        return array_merge([
           new MerchantRelationshipPriceDecisionPlugin(),
        ], parent::getPriceProductDecisionPlugins());
    }
}

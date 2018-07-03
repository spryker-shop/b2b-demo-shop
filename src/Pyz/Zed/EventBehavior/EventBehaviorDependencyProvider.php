<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\EventBehavior;

use Spryker\Zed\AvailabilityStorage\Communication\Plugin\Event\AvailabilityEventResourcePlugin;
use Spryker\Zed\CategoryPageSearch\Communication\Plugin\Event\CategoryPageEventResourcePlugin;
use Spryker\Zed\CategoryStorage\Communication\Plugin\Event\CategoryNodeEventResourcePlugin;
use Spryker\Zed\CategoryStorage\Communication\Plugin\Event\CategoryTreeEventResourcePlugin;
use Spryker\Zed\CmsBlockCategoryStorage\Communication\Plugin\Event\CmsBlockCategoryEventResourcePlugin;
use Spryker\Zed\CmsBlockProductStorage\Communication\Plugin\Event\CmsBlockProductEventResourcePlugin;
use Spryker\Zed\CmsBlockStorage\Communication\Plugin\Event\CmsBlockEventResourcePlugin;
use Spryker\Zed\CmsPageSearch\Communication\Plugin\Event\CmsPageEventResourcePlugin;
use Spryker\Zed\CmsStorage\Communication\Plugin\Event\CmsEventResourcePlugin;
use Spryker\Zed\EventBehavior\EventBehaviorDependencyProvider as SprykerEventBehaviorDependencyProvider;
use Spryker\Zed\GlossaryStorage\Communication\Plugin\Event\GlossaryEventResourcePlugin;
use Spryker\Zed\NavigationStorage\Communication\Plugin\Event\NavigationEventResourcePlugin;
use Spryker\Zed\PriceProductStorage\Communication\Plugin\Event\PriceProductAbstractEventResourcePlugin;
use Spryker\Zed\PriceProductStorage\Communication\Plugin\Event\PriceProductConcreteEventResourcePlugin;
use Spryker\Zed\ProductCategoryFilterStorage\Communication\Plugin\Event\ProductCategoryFilterEventResourcePlugin;
use Spryker\Zed\ProductCategoryStorage\Communication\Plugin\Event\ProductCategoryEventResourcePlugin;
use Spryker\Zed\ProductGroupStorage\Communication\Plugin\Event\ProductGroupEventResourcePlugin;
use Spryker\Zed\ProductImageStorage\Communication\Plugin\Event\ProductAbstractImageEventResourcePlugin;
use Spryker\Zed\ProductImageStorage\Communication\Plugin\Event\ProductConcreteImageEventResourcePlugin;
use Spryker\Zed\ProductLabelStorage\Communication\Plugin\Event\ProductAbstractLabelEventResourcePlugin;
use Spryker\Zed\ProductLabelStorage\Communication\Plugin\Event\ProductLabelDictionaryEventResourcePlugin;
use Spryker\Zed\ProductMeasurementUnitStorage\Communication\Plugin\Event\ProductConcreteMeasurementUnitEventResourcePlugin;
use Spryker\Zed\ProductMeasurementUnitStorage\Communication\Plugin\Event\ProductMeasurementUnitEventResourcePlugin;
use Spryker\Zed\ProductOptionStorage\Communication\Plugin\Event\ProductOptionEventResourcePlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\Event\ProductPageEventResourcePlugin;
use Spryker\Zed\ProductQuantityStorage\Communication\Plugin\Event\ProductQuantityEventResourcePlugin;
use Spryker\Zed\ProductRelationStorage\Communication\Plugin\Event\ProductRelationEventResourcePlugin;
use Spryker\Zed\ProductReviewSearch\Communication\Plugin\Event\ProductReviewEventResourcePlugin as ProductReviewSearchEventResourcePlugin;
use Spryker\Zed\ProductReviewStorage\Communication\Plugin\Event\ProductReviewEventResourcePlugin;
use Spryker\Zed\ProductSearchConfigStorage\Communication\Plugin\Event\ProductSearchConfigEventResourcePlugin;
use Spryker\Zed\ProductSetPageSearch\Communication\Plugin\Event\ProductSetEventResourcePlugin as ProductSetPageSearchEventResourcePlugin;
use Spryker\Zed\ProductSetStorage\Communication\Plugin\Event\ProductSetEventResourcePlugin;
use Spryker\Zed\ProductStorage\Communication\Plugin\Event\ProductAbstractEventResourcePlugin;
use Spryker\Zed\ProductStorage\Communication\Plugin\Event\ProductConcreteEventResourcePlugin;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\RedirectEventResourcePlugin;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\UrlEventResourcePlugin;

class EventBehaviorDependencyProvider extends SprykerEventBehaviorDependencyProvider
{
    /**
     * @return \Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourcePluginInterface[]
     */
    protected function getEventTriggerResourcePlugins()
    {
        return [
            //Search
            new CmsPageEventResourcePlugin(),
            new CategoryPageEventResourcePlugin,
            new ProductPageEventResourcePlugin(),
            new ProductSetPageSearchEventResourcePlugin(),
            new ProductReviewSearchEventResourcePlugin(),
//            //Storage
            new AvailabilityEventResourcePlugin(),
            new CategoryTreeEventResourcePlugin(),
            new CategoryNodeEventResourcePlugin(),
            new CmsBlockCategoryEventResourcePlugin(),
            new CmsBlockProductEventResourcePlugin(),
            new CmsBlockEventResourcePlugin(),
            new CmsEventResourcePlugin(),
            new GlossaryEventResourcePlugin(),
            new NavigationEventResourcePlugin(),
            new PriceProductConcreteEventResourcePlugin(),
            new PriceProductAbstractEventResourcePlugin(),
            new ProductCategoryFilterEventResourcePlugin(),
            new ProductCategoryEventResourcePlugin(),
            new ProductGroupEventResourcePlugin(),
            new ProductAbstractImageEventResourcePlugin(),
            new ProductConcreteImageEventResourcePlugin(),
            new ProductLabelDictionaryEventResourcePlugin(),
            new ProductAbstractLabelEventResourcePlugin(),
            new ProductOptionEventResourcePlugin(),
            new ProductRelationEventResourcePlugin(),
            new ProductReviewEventResourcePlugin(),
            new ProductSearchConfigEventResourcePlugin(),
            new ProductSetEventResourcePlugin(),
            new ProductAbstractEventResourcePlugin(),
            new ProductConcreteEventResourcePlugin(),
            new UrlEventResourcePlugin(),
            new RedirectEventResourcePlugin(),
            new ProductMeasurementUnitEventResourcePlugin(),
            new ProductConcreteMeasurementUnitEventResourcePlugin(),
            new ProductQuantityEventResourcePlugin(),
        ];
    }
}

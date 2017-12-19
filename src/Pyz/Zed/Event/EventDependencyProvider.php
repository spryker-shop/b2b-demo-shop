<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Event;

use Spryker\Zed\AvailabilityStorage\Communication\Plugin\Event\Subscriber\AvailabilityStorageEventSubscriber;
use Spryker\Zed\CategoryPageSearch\Communication\Plugin\Event\Subscriber\CategoryPageSearchEventSubscriber;
use Spryker\Zed\CategoryStorage\Communication\Plugin\Event\Subscriber\CategoryStorageEventSubscriber;
use Spryker\Zed\CmsBlockCategoryStorage\Communication\Plugin\Event\Subscriber\CmsBlockCategoryStorageEventSubscriber;
use Spryker\Zed\CmsBlockStorage\Communication\Plugin\Event\Subscriber\CmsBlockStorageEventSubscriber;
use Spryker\Zed\CmsPageSearch\Communication\Plugin\Event\Subscriber\CmsPageSearchEventSubscriber;
use Spryker\Zed\CmsStorage\Communication\Plugin\Event\Subscriber\CmsStorageEventSubscriber;
use Spryker\Zed\Event\EventDependencyProvider as SprykerEventDependencyProvider;
use Spryker\Zed\GlossaryStorage\Communication\Plugin\Event\Subscriber\GlossaryStorageEventSubscriber;
use Spryker\Zed\NavigationStorage\Communication\Plugin\Event\Subscriber\NavigationStorageEventSubscriber;
use Spryker\Zed\PriceStorage\Communication\Plugin\Event\Subscriber\PriceStorageEventSubscriber;
use Spryker\Zed\ProductCategoryStorage\Communication\Plugin\Event\Subscriber\ProductCategoryStorageEventSubscriber;
use Spryker\Zed\ProductGroupStorage\Communication\Plugin\Event\Subscriber\ProductGroupStorageEventSubscriber;
use Spryker\Zed\ProductImageStorage\Communication\Plugin\Event\Subscriber\ProductImageStorageEventSubscriber;
use Spryker\Zed\ProductLabelPageSearch\Communication\Plugin\Event\Subscriber\ProductLabelPageSearchEventSubscriber;
use Spryker\Zed\ProductLabelStorage\Communication\Plugin\Event\Subscriber\ProductLabelStorageEventSubscriber;
use Spryker\Zed\ProductOptionStorage\Communication\Plugin\Event\Subscriber\ProductOptionStorageEventSubscriber;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\Event\Subscriber\ProductPageSearchEventSubscriber;
use Spryker\Zed\ProductRelationStorage\Communication\Plugin\Event\Subscriber\ProductRelationStorageEventSubscriber;
use Spryker\Zed\ProductSearchConfigStorage\Communication\Plugin\Event\Subscriber\ProductSearchConfigStorageEventSubscriber;
use Spryker\Zed\ProductSetPageSearch\Communication\Plugin\Event\Subscriber\ProductSetPageSearchEventSubscriber;
use Spryker\Zed\ProductSetStorage\Communication\Plugin\Event\Subscriber\ProductSetStorageEventSubscriber;
use Spryker\Zed\ProductStorage\Communication\Plugin\Event\Subscriber\ProductStorageEventSubscriber;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\Subscriber\UrlStorageEventSubscriber;

class EventDependencyProvider extends SprykerEventDependencyProvider
{
    /**
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getEventListenerCollection()
    {
        return parent::getEventListenerCollection();
    }

    /**
     * @return \Spryker\Zed\Event\Dependency\EventSubscriberCollectionInterface
     */
    public function getEventSubscriberCollection()
    {
        $eventSubscriberCollection = parent::getEventSubscriberCollection();

        /**
         * Storage Events
         */
        $eventSubscriberCollection->add(new GlossaryStorageEventSubscriber());
        $eventSubscriberCollection->add(new UrlStorageEventSubscriber());
        $eventSubscriberCollection->add(new AvailabilityStorageEventSubscriber());
        $eventSubscriberCollection->add(new CategoryStorageEventSubscriber());
        $eventSubscriberCollection->add(new CmsStorageEventSubscriber());
        $eventSubscriberCollection->add(new CmsBlockStorageEventSubscriber());
        $eventSubscriberCollection->add(new CmsBlockCategoryStorageEventSubscriber());
        $eventSubscriberCollection->add(new NavigationStorageEventSubscriber());
        $eventSubscriberCollection->add(new PriceStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductCategoryStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductImageStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductGroupStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductOptionStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductRelationStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductLabelStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductSetStorageEventSubscriber());
        $eventSubscriberCollection->add(new ProductSearchConfigStorageEventSubscriber());

        /**
         * Search Events
         */
        $eventSubscriberCollection->add(new CategoryPageSearchEventSubscriber());
        $eventSubscriberCollection->add(new CmsPageSearchEventSubscriber());
        $eventSubscriberCollection->add(new ProductSetPageSearchEventSubscriber());
        $eventSubscriberCollection->add(new ProductPageSearchEventSubscriber());
        $eventSubscriberCollection->add(new ProductLabelPageSearchEventSubscriber());

        return $eventSubscriberCollection;
    }
}

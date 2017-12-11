<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Event;

use Spryker\Zed\AvailabilityStorage\Communication\Plugin\Event\Subscriber\AvailabilityStorageEventSubscriber;
use Spryker\Zed\CategoryStorage\Communication\Plugin\Event\Subscriber\CategoryStorageEventSubscriber;
use Spryker\Zed\Event\EventDependencyProvider as SprykerEventDependencyProvider;
use Spryker\Zed\GlossaryStorage\Communication\Plugin\Event\Subscriber\GlossaryStorageEventSubscriber;
use Spryker\Zed\NavigationStorage\Communication\Plugin\Event\Subscriber\NavigationStorageEventSubscriber;
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

        $eventSubscriberCollection->add(new GlossaryStorageEventSubscriber());
        $eventSubscriberCollection->add(new UrlStorageEventSubscriber());
        $eventSubscriberCollection->add(new AvailabilityStorageEventSubscriber());
        $eventSubscriberCollection->add(new CategoryStorageEventSubscriber());
        $eventSubscriberCollection->add(new NavigationStorageEventSubscriber());

        return $eventSubscriberCollection;
    }
}

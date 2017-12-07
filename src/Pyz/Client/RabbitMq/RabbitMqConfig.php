<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\RabbitMq;

use ArrayObject;
use Generated\Shared\Transfer\RabbitMqOptionTransfer;
use Spryker\Client\RabbitMq\Model\Connection\Connection;
use Spryker\Client\RabbitMq\RabbitMqConfig as SprykerRabbitMqConfig;
use Spryker\Shared\AvailabilityStorage\AvailabilityStorageConstants;
use Spryker\Shared\CategoryStorage\CategoryStorageConstants;
use Spryker\Shared\Event\EventConstants;
use Spryker\Shared\GlossaryStorage\GlossaryStorageConstants;
use Spryker\Shared\UrlStorage\UrlStorageConstants;
use SprykerEco\Shared\Loggly\LogglyConstants;
use SprykerEco\Zed\Loggly\LogglyConfig;

class RabbitMqConfig extends SprykerRabbitMqConfig
{
    /**
     * @return \ArrayObject
     */
    protected function getQueueOptions()
    {
        $queueOptionCollection = new ArrayObject();
        $queueOptionCollection->append($this->createQueueOption(EventConstants::EVENT_QUEUE, EventConstants::EVENT_QUEUE_ERROR));
        $queueOptionCollection->append($this->createQueueOption(GlossaryStorageConstants::SYNC_STORAGE_QUEUE, GlossaryStorageConstants::SYNC_STORAGE_ERROR_QUEUE));
        $queueOptionCollection->append($this->createQueueOption(UrlStorageConstants::URL_SYNC_STORAGE_QUEUE, UrlStorageConstants::URL_SYNC_STORAGE_ERROR_QUEUE));
        $queueOptionCollection->append($this->createQueueOption(AvailabilityStorageConstants::AVAILABILITY_SYNC_STORAGE_QUEUE, AvailabilityStorageConstants::AVAILABILITY_SYNC_STORAGE_ERROR_QUEUE));
        $queueOptionCollection->append($this->createQueueOption(CategoryStorageConstants::CATEGORY_SYNC_STORAGE_QUEUE, CategoryStorageConstants::CATEGORY_SYNC_STORAGE_ERROR_QUEUE));
//        $queueOptionCollection->append($this->createQueueOption(CmsStorageConstants::CMS_SYNC_STORAGE_QUEUE, CmsStorageConstants::CMS_SYNC_STORAGE_ERROR_QUEUE));
//        $queueOptionCollection->append($this->createQueueOption(CmsPageSearchConstants::CMS_SYNC_SEARCH_QUEUE, CmsPageSearchConstants::CMS_SYNC_SEARCH_ERROR_QUEUE));
//        $queueOptionCollection->append($this->createQueueOption(ProductStorageConstants::PRODUCT_SYNC_STORAGE_QUEUE, ProductStorageConstants::PRODUCT_SYNC_STORAGE_ERROR_QUEUE));
//        $queueOptionCollection->append($this->createQueueOption(ProductPageSearchConstants::PRODUCT_SYNC_SEARCH_QUEUE, ProductPageSearchConstants::PRODUCT_SYNC_SEARCH_ERROR_QUEUE));
//        $queueOptionCollection->append($this->createQueueOption(PriceStorageConstants::PRICE_SYNC_STORAGE_QUEUE, PriceStorageConstants::PRICE_SYNC_STORAGE_ERROR_QUEUE));
//        $queueOptionCollection->append($this->createQueueOption(CategoryPageSearchConstants::CATEGORY_SYNC_SEARCH_QUEUE, CategoryPageSearchConstants::CATEGORY_SYNC_SEARCH_ERROR_QUEUE));
        $queueOptionCollection->append(
            $this->createQueueOption(
                $this->get(LogglyConstants::QUEUE_NAME, LogglyConfig::DEFAULT_QUEUE_NAME),
                $this->get(LogglyConstants::ERROR_QUEUE_NAME, LogglyConfig::DEFAULT_ERROR_QUEUE_NAME)
            )
        );

        return $queueOptionCollection;
    }

    /**
     * @param string $queueName
     * @param string $errorQueueName
     * @param string $routingKey
     *
     * @return \Generated\Shared\Transfer\RabbitMqOptionTransfer
     */
    protected function createQueueOption($queueName, $errorQueueName, $routingKey = 'error')
    {
        $queueOptionTransfer = new RabbitMqOptionTransfer();
        $queueOptionTransfer
            ->setQueueName($queueName)
            ->setDurable(true)
            ->setType('direct')
            ->setDeclarationType(Connection::RABBIT_MQ_EXCHANGE)
            ->addBindingQueueItem($this->createQueueBinding($queueName))
            ->addBindingQueueItem($this->createErrorQueueBinding($errorQueueName, $routingKey));

        return $queueOptionTransfer;
    }

    /**
     * @param string $queueName
     *
     * @return \Generated\Shared\Transfer\RabbitMqOptionTransfer
     */
    protected function createQueueBinding($queueName)
    {
        $queueOptionTransfer = new RabbitMqOptionTransfer();
        $queueOptionTransfer
            ->setQueueName($queueName)
            ->setDurable(true)
            ->addRoutingKey('');

        return $queueOptionTransfer;
    }

    /**
     * @param string $errorQueueName
     * @param string $routingKey
     *
     * @return \Generated\Shared\Transfer\RabbitMqOptionTransfer
     */
    protected function createErrorQueueBinding($errorQueueName, $routingKey)
    {
        $queueOptionTransfer = new RabbitMqOptionTransfer();
        $queueOptionTransfer
            ->setQueueName($errorQueueName)
            ->setDurable(true)
            ->addRoutingKey($routingKey);

        return $queueOptionTransfer;
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\MerchantProductOfferSearch;

use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\MerchantProductOfferSearch\MerchantProductOfferSearchConfig as SprykerMerchantProductOfferSearchConfig;

class MerchantProductOfferSearchConfig extends SprykerMerchantProductOfferSearchConfig
{
    /**
     * @return string|null
     */
    public function getMerchantEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }

    /**
     * @return string|null
     */
    public function getMerchantProductOfferEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }
}

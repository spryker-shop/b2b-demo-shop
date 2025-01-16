<?php



declare(strict_types = 1);

namespace Pyz\Zed\SalesReturnSearch;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\SalesReturnSearch\SalesReturnSearchConfig as SprykerSalesReturnSearchConfig;

class SalesReturnSearchConfig extends SprykerSalesReturnSearchConfig
{
    /**
     * @return string|null
     */
    public function getReturnReasonSearchSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}

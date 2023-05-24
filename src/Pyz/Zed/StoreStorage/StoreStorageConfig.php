<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\StoreStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\CompanyUserStorage\CompanyUserStorageConfig;
use Spryker\Shared\CustomerAccessStorage\CustomerAccessStorageConstants;
use Spryker\Shared\GlossaryStorage\GlossaryStorageConfig;
use Spryker\Shared\NavigationStorage\NavigationStorageConstants;
use Spryker\Shared\ProductMeasurementUnitStorage\ProductMeasurementUnitStorageConfig;
use Spryker\Shared\ProductPackagingUnitStorage\ProductPackagingUnitStorageConfig;
use Spryker\Shared\ProductReviewSearch\ProductReviewSearchConfig;
use Spryker\Shared\SalesReturnSearch\SalesReturnSearchConfig;
use Spryker\Zed\StoreStorage\StoreStorageConfig as SprykerStoreStorageConfig;

class StoreStorageConfig extends SprykerStoreStorageConfig
{
    /**
     * @return string|null
     */
    public function getStoreSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::PYZ_DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return array<string>
     */
    public function getStoreCreationResourcesToReSync(): array
    {
        return [
            GlossaryStorageConfig::TRANSLATION_RESOURCE_NAME,
            ProductReviewSearchConfig::PRODUCT_REVIEW_RESOURCE_NAME,
            NavigationStorageConstants::RESOURCE_NAME,
            ProductMeasurementUnitStorageConfig::PRODUCT_MEASUREMENT_UNIT_RESOURCE_NAME,
            ProductPackagingUnitStorageConfig::PRODUCT_PACKAGING_UNIT_RESOURCE_NAME,
            CustomerAccessStorageConstants::CUSTOMER_ACCESS_RESOURCE_NAME,
            CompanyUserStorageConfig::COMPANY_USER_RESOURCE_NAME,
            SalesReturnSearchConfig::RETURN_REASON_RESOURCE_NAME,
        ];
    }
}

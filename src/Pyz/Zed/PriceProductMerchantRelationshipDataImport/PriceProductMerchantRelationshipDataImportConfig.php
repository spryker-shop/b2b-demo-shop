<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PriceProductMerchantRelationshipDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\PriceProductMerchantRelationshipDataImport\PriceProductMerchantRelationshipDataImportConfig as SprykerPriceProductMerchantRelationshipDataImportConfig;

class PriceProductMerchantRelationshipDataImportConfig extends SprykerPriceProductMerchantRelationshipDataImportConfig
{
    public const IMPORT_TYPE_PRICE_PRODUCT_MERCHANT_RELATIONSHIP = 'product-price-merchant-relationship';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getPriceProductMerchantRelationshipDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration($moduleDataImportDirectory . 'price_product_merchant_relationship.csv', static::IMPORT_TYPE_PRICE_PRODUCT_MERCHANT_RELATIONSHIP);
    }
}

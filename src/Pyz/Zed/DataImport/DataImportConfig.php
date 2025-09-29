<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport;

use Spryker\Zed\DataImport\DataImportConfig as SprykerDataImportConfig;
use Spryker\Zed\StockAddressDataImport\StockAddressDataImportConfig;

/**
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class DataImportConfig extends SprykerDataImportConfig
{
    public const IMPORT_TYPE_CATEGORY_TEMPLATE = 'category-template';

    public const IMPORT_TYPE_CUSTOMER = 'customer';

    public const IMPORT_TYPE_GLOSSARY = 'glossary';

    public const IMPORT_TYPE_NAVIGATION = 'navigation';

    public const IMPORT_TYPE_NAVIGATION_NODE = 'navigation-node';

    public const IMPORT_TYPE_PRODUCT_PRICE = 'product-price';

    public const IMPORT_TYPE_PRODUCT_STOCK = 'product-stock';

    public const IMPORT_TYPE_PRODUCT_ABSTRACT = 'product-abstract';

    public const IMPORT_TYPE_PRODUCT_ABSTRACT_STORE = 'product-abstract-store';

    public const IMPORT_TYPE_PRODUCT_CONCRETE = 'product-concrete';

    public const IMPORT_TYPE_PRODUCT_ATTRIBUTE_KEY = 'product-attribute-key';

    public const IMPORT_TYPE_PRODUCT_MANAGEMENT_ATTRIBUTE = 'product-management-attribute';

    public const IMPORT_TYPE_PRODUCT_REVIEW = 'product-review';

    public const IMPORT_TYPE_PRODUCT_SET = 'product-set';

    public const IMPORT_TYPE_PRODUCT_GROUP = 'product-group';

    public const IMPORT_TYPE_PRODUCT_OPTION = 'product-option';

    public const IMPORT_TYPE_PRODUCT_OPTION_PRICE = 'product-option-price';

    public const IMPORT_TYPE_PRODUCT_IMAGE = 'product-image';

    public const IMPORT_TYPE_PRODUCT_SEARCH_ATTRIBUTE_MAP = 'product-search-attribute-map';

    public const IMPORT_TYPE_PRODUCT_SEARCH_ATTRIBUTE = 'product-search-attribute';

    public const IMPORT_TYPE_CMS_TEMPLATE = 'cms-template';

    public const IMPORT_TYPE_CMS_BLOCK = 'cms-block';

    public const IMPORT_TYPE_CMS_BLOCK_STORE = 'cms-block-store';

    public const IMPORT_TYPE_DISCOUNT = 'discount';

    public const IMPORT_TYPE_DISCOUNT_STORE = 'discount-store';

    public const IMPORT_TYPE_DISCOUNT_AMOUNT = 'discount-amount';

    public const IMPORT_TYPE_DISCOUNT_VOUCHER = 'discount-voucher';

    public const IMPORT_TYPE_SHIPMENT = 'shipment';

    public const IMPORT_TYPE_SHIPMENT_PRICE = 'shipment-price';

    public const IMPORT_TYPE_TAX = 'tax';

    public const IMPORT_TYPE_CURRENCY = 'currency';

    public const IMPORT_TYPE_STORE = 'store';

    public const IMPORT_TYPE_COMBINED_PRODUCT_ABSTRACT = 'combined-product-abstract';

    public const IMPORT_TYPE_COMBINED_PRODUCT_ABSTRACT_STORE = 'combined-product-abstract-store';

    public const IMPORT_TYPE_COMBINED_PRODUCT_CONCRETE = 'combined-product-concrete';

    public const IMPORT_TYPE_COMBINED_PRODUCT_IMAGE = 'combined-product-image';

    public const IMPORT_TYPE_COMBINED_PRODUCT_PRICE = 'combined-product-price';

    public const IMPORT_TYPE_COMBINED_PRODUCT_STOCK = 'combined-product-stock';

    public const IMPORT_TYPE_COMBINED_PRODUCT_GROUP = 'combined-product-group';

    protected const READ_COLLECTION_BATCH_SIZE = 500;

    public function getDefaultYamlConfigPath(): ?string
    {
        $regionDir = defined('APPLICATION_REGION') ? APPLICATION_REGION : 'EU';

        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . 'data/import/local/full_' . $regionDir . '.yml';
    }

    /**
     * @return array<string>
     */
    public function getFullImportTypes(): array
    {
        $customImportTypes = [
            StockAddressDataImportConfig::IMPORT_TYPE_STOCK_ADDRESS,
        ];

        return array_merge(parent::getFullImportTypes(), $customImportTypes);
    }

    public function getReadCollectionBatchSize(): int
    {
        return static::READ_COLLECTION_BATCH_SIZE;
    }
}

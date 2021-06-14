<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\ProductRelation\PageObject;

class ProductRelationCreatePage
{
    public const URL = '/product-relation-gui/create/index';

    public const PRODUCT_RELATION_PRODUCT_1_NAME = 'Our Conference Room Bundle';
    public const PRODUCT_RELATION_PRODUCT_1_SKU = 'B0002';

    public const PRODUCT_RULE_NAME = 'sku';
    public const PRODUCT_RULE_OPERATOR = 'equal';

    public const PRODUCT_RELATION_PRODUCT_2_SKU = 'B0001';

    public const MESSAGE_SUCCESS_PRODUCT_RELATION_CREATED = 'Product relation successfully created';
    public const MESSAGE_SUCCESS_PRODUCT_RELATION_ACTIVATED = 'Relation successfully activated.';
}

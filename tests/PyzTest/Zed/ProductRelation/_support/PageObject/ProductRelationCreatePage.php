<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\ProductRelation\PageObject;

class ProductRelationCreatePage
{
    public const URL = '/product-relation-gui/create/index';

    public const PRODUCT_RELATION_PRODUCT_1_NAME = 'Mauser sliding door';
    public const PRODUCT_RELATION_PRODUCT_1_SKU = 'M90802';

    public const PRODUCT_RULE_NAME = 'sku';
    public const PRODUCT_RULE_OPERATOR = 'equal';

    public const PRODUCT_RELATION_PRODUCT_2_SKU = 'M1000785';

    public const EDIT_PRODUCT_RELATION_TEXT = 'Edit Product Relation:';
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\ProductRelation\PageObject;

class ProductRelationCreatePage
{
    /**
     * @var string
     */
    public const URL = '/product-relation-gui/create/index';

    /**
     * @var string
     */
    public const PRODUCT_RELATION_PRODUCT_1_NAME = 'Mauser sliding door';

    /**
     * @var string
     */
    public const PRODUCT_RELATION_PRODUCT_1_SKU = 'M90802';

    /**
     * @var string
     */
    public const PRODUCT_RULE_NAME = 'product_sku';

    /**
     * @var string
     */
    public const PRODUCT_RULE_OPERATOR = 'equal';

    /**
     * @var string
     */
    public const PRODUCT_RELATION_PRODUCT_2_SKU = 'M1000785';

    /**
     * @var string
     */
    public const EDIT_PRODUCT_RELATION_TEXT = 'Edit Product Relation:';
}

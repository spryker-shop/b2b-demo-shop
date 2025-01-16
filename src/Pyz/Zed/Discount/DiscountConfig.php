<?php



declare(strict_types = 1);

namespace Pyz\Zed\Discount;

use Spryker\Zed\Discount\DiscountConfig as SprykerDiscountConfig;

class DiscountConfig extends SprykerDiscountConfig
{
    /**
     * @var bool
     */
    protected const IS_MONEY_COLLECTION_FORM_TYPE_PLUGIN_ENABLED = true;
}

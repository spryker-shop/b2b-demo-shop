<?php



declare(strict_types = 1);

namespace Pyz\Zed\PriceCartConnector;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Zed\PriceCartConnector\PriceCartConnectorConfig as SprykerPriceCartConnectorConfig;

class PriceCartConnectorConfig extends SprykerPriceCartConnectorConfig
{
    /**
     * @var bool
     */
    protected const IS_ZERO_PRICE_ENABLED_FOR_CART_ACTIONS = false;

    /**
     * @return list<string>
     */
    public function getItemFieldsForIdentifier(): array
    {
        return array_merge(parent::getItemFieldsForIdentifier(), [
            ItemTransfer::SKU,
            ItemTransfer::QUANTITY,
        ]);
    }
}

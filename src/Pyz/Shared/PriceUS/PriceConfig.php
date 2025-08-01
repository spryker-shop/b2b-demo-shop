<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Shared\PriceUS;

use Spryker\Shared\Price\PriceConfig as SprykerPriceConfig;

class PriceConfig extends SprykerPriceConfig
{
    /**
     * @return string
     */
    public function getDefaultPriceMode(): string
    {
        return static::PRICE_MODE_NET;
    }

    /**
     * @return array<string, string>
     */
    public function getPriceModes(): array
    {
        return [
            static::PRICE_MODE_NET => static::PRICE_MODE_NET,
        ];
    }
}

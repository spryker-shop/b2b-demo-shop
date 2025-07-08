<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Merchant;

use Spryker\Zed\Merchant\MerchantDependencyProvider as SprykerMerchantDependencyProvider;
use Spryker\Zed\MerchantStock\Communication\Plugin\Merchant\MerchantStockMerchantBulkExpanderPlugin;
use Spryker\Zed\MerchantStock\Communication\Plugin\Merchant\MerchantStockMerchantPostCreatePlugin;

class MerchantDependencyProvider extends SprykerMerchantDependencyProvider
{
 /**
  * @return array<\Spryker\Zed\MerchantExtension\Dependency\Plugin\MerchantPostCreatePluginInterface>
  */
    protected function getMerchantPostCreatePlugins(): array
    {
        return [
            new MerchantStockMerchantPostCreatePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\MerchantExtension\Dependency\Plugin\MerchantPostUpdatePluginInterface>
     */
    protected function getMerchantBulkExpanderPlugins(): array
    {
        return [
            new MerchantStockMerchantBulkExpanderPlugin(),
        ];
    }
}

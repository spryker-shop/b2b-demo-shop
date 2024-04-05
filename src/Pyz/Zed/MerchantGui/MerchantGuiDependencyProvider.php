<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\MerchantGui;

use Spryker\Zed\Kernel\Communication\Form\FormTypeInterface;
use Spryker\Zed\MerchantGui\MerchantGuiDependencyProvider as SprykerMerchantGuiDependencyProvider;
use Spryker\Zed\MerchantRelationRequestGui\Communication\Plugin\MerchantGui\IsOpenForRelationRequestMerchantFormExpanderPlugin;
use Spryker\Zed\Store\Communication\Plugin\Form\StoreRelationToggleFormTypePlugin;

class MerchantGuiDependencyProvider extends SprykerMerchantGuiDependencyProvider
{
    /**
     * @return \Spryker\Zed\Kernel\Communication\Form\FormTypeInterface
     */
    protected function getStoreRelationFormTypePlugin(): FormTypeInterface
    {
        return new StoreRelationToggleFormTypePlugin();
    }

    /**
     * @return array<\Spryker\Zed\MerchantGuiExtension\Dependency\Plugin\MerchantFormExpanderPluginInterface>
     */
    protected function getMerchantFormExpanderPlugins(): array
    {
        return [
            new IsOpenForRelationRequestMerchantFormExpanderPlugin(),
        ];
    }
}

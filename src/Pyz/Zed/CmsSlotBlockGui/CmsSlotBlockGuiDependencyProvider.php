<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\CmsSlotBlockGui;

use Spryker\Zed\CmsSlotBlockCategoryGui\Communication\Plugin\CategorySlotBlockConditionFormPlugin;
use Spryker\Zed\CmsSlotBlockCmsGui\Communication\Plugin\CmsPageSlotBlockConditionFormPlugin;
use Spryker\Zed\CmsSlotBlockGui\CmsSlotBlockGuiDependencyProvider as SprykerCmsSlotBlockGuiDependencyProvider;
use Spryker\Zed\CmsSlotBlockProductCategoryGui\Communication\Plugin\ProductCategorySlotBlockConditionFormPlugin;

class CmsSlotBlockGuiDependencyProvider extends SprykerCmsSlotBlockGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CmsSlotBlockGuiExtension\Communication\Plugin\CmsSlotBlockGuiConditionFormPluginInterface>
     */
    protected function getCmsSlotBlockFormPlugins(): array
    {
        return [
            new CategorySlotBlockConditionFormPlugin(),
            new CmsPageSlotBlockConditionFormPlugin(),
            new ProductCategorySlotBlockConditionFormPlugin(),
        ];
    }
}

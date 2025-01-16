<?php



declare(strict_types = 1);

namespace Pyz\Client\CmsSlotBlock;

use Spryker\Client\CmsSlotBlock\CmsSlotBlockDependencyProvider as SprykerCmsSlotBlockDependencyProvider;
use Spryker\Client\CmsSlotBlockCategoryConnector\Plugin\CmsSlotBlock\CategoryCmsSlotBlockConditionResolverPlugin;
use Spryker\Client\CmsSlotBlockCmsConnector\Plugin\CmsSlotBlock\CmsPageCmsSlotBlockConditionResolverPlugin;
use Spryker\Client\CmsSlotBlockProductCategoryConnector\Plugin\CmsSlotBlock\ProductCategoryCmsSlotBlockConditionResolverPlugin;

class CmsSlotBlockDependencyProvider extends SprykerCmsSlotBlockDependencyProvider
{
    /**
     * @return array<\Spryker\Client\CmsSlotBlockExtension\Dependency\Plugin\CmsSlotBlockVisibilityResolverPluginInterface>
     */
    protected function getCmsSlotBlockVisibilityResolverPlugins(): array
    {
        return [
            new CategoryCmsSlotBlockConditionResolverPlugin(),
            new CmsPageCmsSlotBlockConditionResolverPlugin(),
            new ProductCategoryCmsSlotBlockConditionResolverPlugin(),
        ];
    }
}

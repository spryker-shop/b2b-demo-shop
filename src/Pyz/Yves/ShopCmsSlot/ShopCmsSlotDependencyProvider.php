<?php



declare(strict_types = 1);

namespace Pyz\Yves\ShopCmsSlot;

use Spryker\Shared\CmsSlotBlock\CmsSlotBlockConfig;
use SprykerShop\Yves\CmsSlotBlockWidget\Plugin\ShopCmsSlot\CmsSlotBlockWidgetCmsSlotContentPlugin;
use SprykerShop\Yves\ShopCmsSlot\ShopCmsSlotDependencyProvider as SprykerShopShopCmsSlotDependencyProvider;

class ShopCmsSlotDependencyProvider extends SprykerShopShopCmsSlotDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\ShopCmsSlotExtension\Dependency\Plugin\CmsSlotContentPluginInterface>
     */
    protected function getCmsSlotContentPlugins(): array
    {
        return [
            CmsSlotBlockConfig::CMS_SLOT_CONTENT_PROVIDER_TYPE => new CmsSlotBlockWidgetCmsSlotContentPlugin(),
        ];
    }
}

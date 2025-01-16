<?php



declare(strict_types = 1);

namespace Pyz\Client\CmsSlot;

use Spryker\Client\CmsSlot\CmsSlotDependencyProvider as SprykerCmsSlotDependencyProvider;
use Spryker\Client\CmsSlotLocaleConnector\Plugin\CmsSlot\LocaleExternalDataProviderStrategyPlugin;
use Spryker\Client\CmsSlotStoreConnector\Plugin\CmsSlot\StoreExternalDataProviderStrategyPlugin;

class CmsSlotDependencyProvider extends SprykerCmsSlotDependencyProvider
{
    /**
     * @return array<\Spryker\Client\CmsSlotExtension\Dependency\Plugin\ExternalDataProviderStrategyPluginInterface>
     */
    public function getExternalDataProviderStrategyPlugins(): array
    {
        return [
            new LocaleExternalDataProviderStrategyPlugin(),
            new StoreExternalDataProviderStrategyPlugin(),
        ];
    }
}

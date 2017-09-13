<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CmsContentWidgetProductConnector;

use Spryker\Yves\CmsContentWidgetProductConnector\CmsContentWidgetProductConnectorFactory as SprykerCmsContentWidgetProductConnectorFactory;

class CmsContentWidgetProductConnectorFactory extends SprykerCmsContentWidgetProductConnectorFactory
{

    /**
     * @return \SprykerShop\Yves\ProductDetailPage\Dependency\Plugin\StorageProductMapperPluginInterface;
     */
    public function getStorageProductMapperPlugin()
    {
        return $this->getProvidedDependency(CmsContentWidgetProductConnectorDependencyProvider::STORAGE_PRODUCT_MAPPER_PLUGIN);
    }

}

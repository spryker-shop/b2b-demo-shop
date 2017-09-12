<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\PyzProduct;

use Spryker\Yves\Kernel\Container;
use Spryker\Yves\PyzAvailability\Plugin\StorageProductAvailabilityExpanderPlugin;
use Spryker\Yves\PyzProduct\PyzProductDependencyProvider as SprykerPyzProductDependencyProvider;
use Spryker\Yves\PyzProductCategory\Plugin\PyzProductCategoryControllerResponseExtenderPlugin;
use Spryker\Yves\PyzProductCategory\Plugin\StorageProductCategoryExpanderPlugin;
use Spryker\Yves\PyzProductImage\Plugin\StorageProductImageExpanderPlugin;
use Spryker\Yves\PyzProductOption\Plugin\PyzProductOptionControllerResponseExtenderPlugin;

class PyzProductDependencyProvider extends SprykerPyzProductDependencyProvider
{

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\ControllerResponseExpanderPluginInterface[]
     */
    protected function getControllerResponseExpanderPlugins(Container $container)
    {
        return [
            new PyzProductOptionControllerResponseExtenderPlugin(),
            new PyzProductCategoryControllerResponseExtenderPlugin(),
        ];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\PyzProduct\Dependency\Plugin\StorageProductExpanderPluginInterface[]
     */
    protected function getStorageProductExpanderPlugins(Container $container)
    {
        return [
            new StorageProductCategoryExpanderPlugin(),
            new StorageProductImageExpanderPlugin(),
            new StorageProductAvailabilityExpanderPlugin(),
        ];
    }

}

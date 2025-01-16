<?php



declare(strict_types = 1);

namespace Pyz\Yves\ProductSetWidget;

use Spryker\Client\ProductSetStorage\ProductSetStorageClientInterface;
use Spryker\Client\ProductStorage\ProductStorageClientInterface;
use SprykerShop\Yves\ProductSetWidget\ProductSetWidgetFactory as SprykerProductSetWidgetFactory;

class ProductSetWidgetFactory extends SprykerProductSetWidgetFactory
{
    /**
     * @return \Spryker\Client\ProductStorage\ProductStorageClientInterface
     */
    public function getProductStorageClient(): ProductStorageClientInterface
    {
        return $this->getProvidedDependency(ProductSetWidgetDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }

    /**
     * @return \Spryker\Client\ProductSetStorage\ProductSetStorageClientInterface
     */
    public function getProductSetStorageClient(): ProductSetStorageClientInterface
    {
        return $this->getProvidedDependency(ProductSetWidgetDependencyProvider::CLIENT_PRODUCT_SET_STORAGE);
    }
}

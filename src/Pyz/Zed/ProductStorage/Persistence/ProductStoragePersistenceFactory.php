<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductStorage\Persistence;

use Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery;
use Spryker\Zed\ProductStorage\Persistence\ProductStoragePersistenceFactory as SprykerProductStoragePersistenceFactory;

/**
 * @method \Pyz\Zed\ProductStorage\ProductStorageConfig getConfig()
 * @method \Spryker\Zed\ProductStorage\Persistence\ProductStorageQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\ProductStorage\Persistence\ProductStorageRepositoryInterface getRepository()
 */
class ProductStoragePersistenceFactory extends SprykerProductStoragePersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery
     */
    public function createProductBundleQuery(): SpyProductBundleQuery
    {
        return SpyProductBundleQuery::create();
    }
}

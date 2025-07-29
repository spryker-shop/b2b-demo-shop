<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\DiscountStore;

use Orm\Zed\Discount\Persistence\SpyDiscountQuery;
use Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class DiscountStoreWriterStep implements DataImportStepInterface
{
    /**
     * @var int
     */
    public const BULK_SIZE = 100;

    /**
     * @var string
     */
    public const KEY_DISCOUNT_KEY = 'discount_key';

    /**
     * @var string
     */
    public const KEY_STORE_NAME = 'store_name';

    /**
     * @var array<int> Keys are discount keys, values are discount IDs.
     */
    protected static $idDiscountBuffer = [];

    /**
     * @var array<int> Keys are store names, values are store ids.
     */
    protected static $idStoreBuffer = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        (new SpyDiscountStoreQuery())
            ->filterByFkDiscount($this->getIdDiscountByKey($dataSet[static::KEY_DISCOUNT_KEY]))
            ->filterByFkStore($this->getIdStoreByName($dataSet[static::KEY_STORE_NAME]))
            ->findOneOrCreate()
            ->save();
    }

    /**
     * @param string $discountKey
     *
     * @return int
     */
    protected function getIdDiscountByKey(string $discountKey): int
    {
        if (!isset(static::$idDiscountBuffer[$discountKey])) {
            static::$idDiscountBuffer[$discountKey] =
                SpyDiscountQuery::create()->findOneByDiscountKey($discountKey)->getIdDiscount();
        }

        return static::$idDiscountBuffer[$discountKey];
    }

    /**
     * @param string $storeName
     *
     * @return int
     */
    protected function getIdStoreByName(string $storeName): int
    {
        if (!isset(static::$idStoreBuffer[$storeName])) {
            static::$idStoreBuffer[$storeName] =
                SpyStoreQuery::create()->findOneByName($storeName)->getIdStore();
        }

        return static::$idStoreBuffer[$storeName];
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\ProductAbstract;

use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductAbstractSkuToIdProductAbstractStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const KEY_SOURCE = 'sku';

    /**
     * @var string
     */
    public const KEY_TARGET = 'idProductAbstract';

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $target;

    /**
     * @var array<string, int>
     */
    protected static $resolved = [];

    /**
     * @param string $source
     * @param string $target
     */
    public function __construct(string $source = self::KEY_SOURCE, string $target = self::KEY_TARGET)
    {
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        if (empty($dataSet[$this->source])) {
            return;
        }

        /** @var string $sku */
        $sku = $dataSet[$this->source];
        if (!isset(static::$resolved[$sku])) {
            static::$resolved[$sku] = $this->resolveIdProductAbstract($sku);
        }

        $dataSet[$this->target] = static::$resolved[$sku];
    }

    /**
     * @param string $sku
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function resolveIdProductAbstract(string $sku): int
    {
        $query = SpyProductAbstractQuery::create();
        $productAbstractEntity = $query->findOneBySku($sku);

        if (!$productAbstractEntity) {
            throw new EntityNotFoundException(sprintf('Abstract product with sku "%s" not found.', $sku));
        }

        return $productAbstractEntity->getIdProductAbstract();
    }
}

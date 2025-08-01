<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\ProductAttributeKey;

use Orm\Zed\Product\Persistence\SpyProductAttributeKeyQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductAttributeKeyWriter implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const ATTRIBUTE_KEY = 'attribute_key';

    /**
     * @var string
     */
    public const IS_SUPER = 'is_super';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $query = SpyProductAttributeKeyQuery::create();
        $productAttributeKeyEntity = $query
            ->filterByKey($dataSet[static::ATTRIBUTE_KEY])
            ->findOneOrCreate();

        $productAttributeKeyEntity->setIsSuper($dataSet[static::IS_SUPER]);
        $productAttributeKeyEntity->save();
    }
}

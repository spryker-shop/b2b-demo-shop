<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Currency;

use Orm\Zed\Currency\Persistence\SpyCurrencyQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class CurrencyWriterStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const KEY_ISO_CODE = 'iso_code';

    /**
     * @var string
     */
    public const KEY_CURRENCY_SYMBOL = 'currency_symbol';

    /**
     * @var string
     */
    public const KEY_NAME = 'name';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $currencyEntity = SpyCurrencyQuery::create()
            ->filterByCode($dataSet[static::KEY_ISO_CODE])
            ->filterByName($dataSet[static::KEY_NAME])
            ->filterBySymbol($dataSet[static::KEY_CURRENCY_SYMBOL])
            ->findOneOrCreate();

        $currencyEntity->save();
    }
}

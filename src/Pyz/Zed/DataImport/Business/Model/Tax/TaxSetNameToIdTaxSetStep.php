<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\Tax;

use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class TaxSetNameToIdTaxSetStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const KEY_SOURCE = 'taxSetName';

    /**
     * @var string
     */
    public const KEY_TARGET = 'idTaxSet';

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
    protected $resolved = [];

    /**
     * @param string $source
     * @param string $target
     */
    public function __construct($source = self::KEY_SOURCE, $target = self::KEY_TARGET)
    {
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        if (!isset($dataSet[$this->source])) {
            throw new DataKeyNotFoundInDataSetException(sprintf(
                'Expected a key "%s" in current data set. Available keys: "%s"',
                $this->source,
                implode(', ', array_keys($dataSet->getArrayCopy())),
            ));
        }

        /** @var string $taxSetName */
        $taxSetName = $dataSet[$this->source];
        if (!isset($this->resolved[$taxSetName])) {
            $this->resolved[$taxSetName] = $this->resolveIdStock($taxSetName);
        }

        $dataSet[$this->target] = $this->resolved[$taxSetName];
    }

    /**
     * @param string $taxSetName
     *
     * @return int
     */
    protected function resolveIdStock($taxSetName): int
    {
        $taxSetEntity = SpyTaxSetQuery::create()
            ->filterByName($taxSetName)
            ->findOneOrCreate();

        $taxSetEntity->save();

        return $taxSetEntity->getIdTaxSet();
    }
}

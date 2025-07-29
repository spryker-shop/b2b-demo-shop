<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\NavigationNode;

use Pyz\Zed\DataImport\Business\Exception\NavigationNodeValidityDateException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class NavigationNodeValidityDatesStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    protected $keyValidFrom;

    /**
     * @var string
     */
    protected $keyValidTo;

    /**
     * @param string $keyValidFrom
     * @param string $keyValidTo
     */
    public function __construct(string $keyValidFrom, string $keyValidTo)
    {
        $this->keyValidFrom = $keyValidFrom;
        $this->keyValidTo = $keyValidTo;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $this->filterDate($dataSet, $this->keyValidFrom);
        $this->filterDate($dataSet, $this->keyValidTo);
        $this->formatDate($dataSet, $this->keyValidFrom);
        $this->formatDate($dataSet, $this->keyValidTo);
        $this->assertDateRelation($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param string $key
     *
     * @return void
     */
    protected function filterDate(DataSetInterface $dataSet, string $key): void
    {
        if (isset($dataSet[$key])) {
            return;
        }

        $dataSet[$key] = '';
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param string $key
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\NavigationNodeValidityDateException
     *
     * @return void
     */
    protected function formatDate(DataSetInterface $dataSet, string $key): void
    {
        if ($dataSet[$key] === '') {
            return;
        }

        $timestamp = strtotime($dataSet[$key]);

        if ($timestamp === false || $timestamp <= 0) {
            throw new NavigationNodeValidityDateException(
                sprintf('%s date (%s) does not match expected format: YYYY-MM-DD.', $key, $dataSet[$key]),
            );
        }

        $dataSet[$key] = date('Y-m-d', $timestamp);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\NavigationNodeValidityDateException
     *
     * @return void
     */
    protected function assertDateRelation(DataSetInterface $dataSet): void
    {
        $validFromDate = $dataSet[$this->keyValidFrom];
        $validToDate = $dataSet[$this->keyValidTo];

        if ($validFromDate === '' || $validToDate === '') {
            return;
        }

        if (strtotime($validFromDate) > strtotime($validToDate)) {
            throw new NavigationNodeValidityDateException(
                sprintf(
                    '%s date (%s) has to be equal or earlier than %s date (%s).',
                    $this->keyValidFrom,
                    $validFromDate,
                    $this->keyValidTo,
                    $validToDate,
                ),
            );
        }
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Customer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\SequenceNumber\Persistence\SpySequenceNumberQuery;
use Pyz\Zed\DataImport\Business\Exception\InvalidDataException;
use Spryker\Shared\Customer\CustomerConstants;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class CustomerWriterStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const COL_CUSTOMER_REFERENCE = 'customer_reference';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $customerEntity = SpyCustomerQuery::create()
            ->filterByCustomerReference($dataSet[self::COL_CUSTOMER_REFERENCE])
            ->findOneOrCreate();

        $customerEntity->fromArray($dataSet->getArrayCopy());
        $customerEntity->save();

        $sequenceNumberEntity = SpySequenceNumberQuery::create()
            ->filterByName(CustomerConstants::NAME_CUSTOMER_REFERENCE)
            ->findOneOrCreate();

        $currentId = $this->getCurrentId($dataSet);
        if ($currentId <= $sequenceNumberEntity->getCurrentId()) {
            return;
        }

        $sequenceNumberEntity->setCurrentId($currentId);
        $sequenceNumberEntity->save();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\InvalidDataException
     *
     * @return int
     */
    protected function getCurrentId(DataSetInterface $dataSet): int
    {
        if (!preg_match('/(\d+)$/', preg_quote($dataSet[self::COL_CUSTOMER_REFERENCE], '/'), $matches)) {
            throw new InvalidDataException(sprintf(
                'Invalid customer reference: "%s". Value expected to end with a number.',
                preg_quote($dataSet[self::COL_CUSTOMER_REFERENCE], '/'),
            ));
        }

        return (int)$matches[1];
    }
}

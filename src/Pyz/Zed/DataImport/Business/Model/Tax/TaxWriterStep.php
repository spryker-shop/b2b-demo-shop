<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Tax;

use Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery;
use Orm\Zed\Tax\Persistence\SpyTaxRate;
use Orm\Zed\Tax\Persistence\SpyTaxRateQuery;
use Orm\Zed\Tax\Persistence\SpyTaxSet;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Orm\Zed\Tax\Persistence\SpyTaxSetTax;
use Orm\Zed\Tax\Persistence\SpyTaxSetTaxQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Pyz\Zed\DataImport\Business\Model\Country\Repository\CountryRepositoryInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\Tax\Dependency\TaxEvents;

class TaxWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @var int
     */
    public const BULK_SIZE = 100;

    /**
     * @var string
     */
    public const KEY_COUNTRY_NAME = 'country_name';

    /**
     * @var string
     */
    public const KEY_TAX_RATE_NAME = 'tax_rate_name';

    /**
     * @var string
     */
    public const KEY_TAX_RATE_PERCENT = 'tax_rate_percent';

    /**
     * @var string
     */
    public const KEY_TAX_SET_NAME = 'tax_set_name';

    /**
     * @var \Pyz\Zed\DataImport\Business\Model\Country\Repository\CountryRepositoryInterface
     */
    protected $countryRepository;

    /**
     * @var array<string, bool>
     */
    protected $shipmentSets = [
        'Shipment Taxes' => true,
        'Tax Exempt' => true,
    ];

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\Country\Repository\CountryRepositoryInterface $countryRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $taxRateEntity = $this->findOrCreateTaxRate($dataSet);

        if (empty($dataSet[static::KEY_TAX_SET_NAME])) {
            return;
        }

        $taxSetEntity = $this->findOrCreateTaxSet($dataSet);

        $this->findOrCreateTaxSetTax($taxRateEntity, $taxSetEntity);

        $this->addShipmentTax($taxSetEntity);

        $this->addPublishEvents(TaxEvents::TAX_SET_PUBLISH, $taxSetEntity->getIdTaxSet());
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxRate
     */
    protected function findOrCreateTaxRate(DataSetInterface $dataSet): SpyTaxRate
    {
        $idCountry = null;
        if ($this->countryRepository->hasCountryByName($dataSet[static::KEY_COUNTRY_NAME])) {
            $idCountry = $this->countryRepository->getIdCountryByName($dataSet[static::KEY_COUNTRY_NAME]);
        }
        $taxRateEntity = SpyTaxRateQuery::create()
            ->filterByFkCountry($idCountry)
            ->filterByName($dataSet[static::KEY_TAX_RATE_NAME])
            ->findOneOrCreate();

        $taxRateEntity
            ->setRate($dataSet[static::KEY_TAX_RATE_PERCENT])
            ->save();

        return $taxRateEntity;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSet
     */
    protected function findOrCreateTaxSet(DataSetInterface $dataSet): SpyTaxSet
    {
        $taxSetEntity = SpyTaxSetQuery::create()
            ->filterByName($dataSet[static::KEY_TAX_SET_NAME])
            ->findOneOrCreate();

        $taxSetEntity->save();

        return $taxSetEntity;
    }

    /**
     * @param \Orm\Zed\Tax\Persistence\SpyTaxRate $taxRateEntity
     * @param \Orm\Zed\Tax\Persistence\SpyTaxSet $taxSetEntity
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetTax
     */
    protected function findOrCreateTaxSetTax(SpyTaxRate $taxRateEntity, SpyTaxSet $taxSetEntity): SpyTaxSetTax
    {
        $taxSetTaxEntity = SpyTaxSetTaxQuery::create()
            ->filterByFkTaxRate($taxRateEntity->getIdTaxRate())
            ->filterByFkTaxSet($taxSetEntity->getIdTaxSet())
            ->findOneOrCreate();

        $taxSetTaxEntity->save();

        return $taxSetTaxEntity;
    }

    /**
     * @param \Orm\Zed\Tax\Persistence\SpyTaxSet $taxSetEntity
     *
     * @return void
     */
    protected function addShipmentTax(SpyTaxSet $taxSetEntity): void
    {
        if (!isset($this->shipmentSets[$taxSetEntity->getName()])) {
            return;
        }

        $shipmentMethodEntity = SpyShipmentMethodQuery::create()
            ->filterByIsActive(true)
            ->filterByFkTaxSet(null, Criteria::ISNULL)
            ->findOne();

        if (!$shipmentMethodEntity) {
            return;
        }

        $shipmentMethodEntity
            ->setFkTaxSet($taxSetEntity->getIdTaxSet())
            ->save();

        unset($this->shipmentSets[$taxSetEntity->getName()]);
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Discount;

use DateTime;
use Orm\Zed\Discount\Persistence\SpyDiscount;
use Orm\Zed\Discount\Persistence\SpyDiscountQuery;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery;
use Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion;
use Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery;
use Orm\Zed\Shipment\Persistence\SpyShipmentCarrierQuery;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethod;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodQuery;
use Spryker\Shared\Discount\DiscountConstants;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class DiscountWriterStep implements DataImportStepInterface
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
    public const KEY_DISPLAY_NAME = 'display_name';

    /**
     * @var string
     */
    public const KEY_DESCRIPTION = 'description';

    /**
     * @var string
     */
    public const KEY_AMOUNT = 'amount';

    /**
     * @var string
     */
    public const KEY_IS_ACTIVE = 'is_active';

    /**
     * @var string
     */
    public const KEY_IS_EXCLUSIVE = 'is_exclusive';

    /**
     * @var string
     */
    public const KEY_VALID_FROM = 'valid_from';

    /**
     * @var string
     */
    public const KEY_VALID_TO = 'valid_to';

    /**
     * @var string
     */
    public const KEY_CALCULATOR_PLUGIN = 'calculator_plugin';

    /**
     * @var string
     */
    public const KEY_DISCOUNT_TYPE = 'discount_type';

    /**
     * @var string
     */
    public const KEY_DECISION_RULE_QUERY_STRING = 'decision_rule_query_string';

    /**
     * @var string
     */
    public const KEY_COLLECTOR_QUERY_STRING = 'collector_query_string';

    /**
     * @var string
     */
    public const KEY_PROMOTION_SKU = 'promotion_sku';

    /**
     * @var string
     */
    public const KEY_PROMOTION_QUANTITY = 'promotion_quantity';

    /**
     * @var string
     */
    public const KEY_PRIORITY = 'priority';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $discountEntity = SpyDiscountQuery::create()
            ->filterByDiscountKey($dataSet[static::KEY_DISCOUNT_KEY])
            ->findOneOrCreate();

        $dataSet[static::KEY_DECISION_RULE_QUERY_STRING] = $this->processQueryString($dataSet[static::KEY_DECISION_RULE_QUERY_STRING]);
        $dataSet[static::KEY_COLLECTOR_QUERY_STRING] = $this->processQueryString($dataSet[static::KEY_COLLECTOR_QUERY_STRING]);

        if ($dataSet[static::KEY_DISCOUNT_TYPE] === DiscountConstants::TYPE_VOUCHER) {
            $discountVoucherPoolEntity = SpyDiscountVoucherPoolQuery::create()
                ->filterByName($dataSet[static::KEY_DISPLAY_NAME])
                ->findOneOrCreate();

            $discountVoucherPoolEntity->setIsActive($dataSet[static::KEY_IS_ACTIVE]);

            $discountEntity->setVoucherPool($discountVoucherPoolEntity);
        }

        if ($dataSet[static::KEY_PRIORITY] && property_exists(SpyDiscount::class, 'priority')) {
            $discountEntity->setPriority($dataSet[static::KEY_PRIORITY]);
        }

        $discountEntity
            ->setDisplayName($dataSet[static::KEY_DISPLAY_NAME])
            ->setDescription($dataSet[static::KEY_DESCRIPTION])
            ->setAmount((int)$dataSet[static::KEY_AMOUNT])
            ->setIsActive($dataSet[static::KEY_IS_ACTIVE])
            ->setIsExclusive($dataSet[static::KEY_IS_EXCLUSIVE])
            ->setValidFrom(new DateTime($dataSet[static::KEY_VALID_FROM]))
            ->setValidTo(new DateTime($dataSet[static::KEY_VALID_TO]))
            ->setCalculatorPlugin($dataSet[static::KEY_CALCULATOR_PLUGIN])
            ->setDiscountType($dataSet[static::KEY_DISCOUNT_TYPE])
            ->setDecisionRuleQueryString($dataSet[static::KEY_DECISION_RULE_QUERY_STRING])
            ->setCollectorQueryString($dataSet[static::KEY_COLLECTOR_QUERY_STRING])
            ->save();

        $this->saveDiscountPromotion($dataSet, $discountEntity);
    }

    /**
     * @param string $queryString
     *
     * @return string
     */
    protected function processQueryString(string $queryString): string
    {
        $queryString = $this->convertShipmentCarrierNameToId($queryString);
        $queryString = $this->convertShipmentMethodNameToId($queryString);

        return $queryString;
    }

    /**
     * @param string $queryString
     *
     * @return string
     */
    protected function convertShipmentMethodNameToId(string $queryString): string
    {
        $shipmentConditionValues = $this->extractConditionValuesWithShipmentCarrierMethodNames($queryString);

        foreach ($shipmentConditionValues as $shipmentConditionValue) {
            $shipmentMethodEntity = $this->findShipmentMethodByConditionValue($shipmentConditionValue);
            $queryString = str_replace($shipmentConditionValue, (string)$shipmentMethodEntity->getIdShipmentMethod(), $queryString);
        }

        return $queryString;
    }

    /**
     * @param string $queryString
     *
     * @return string
     */
    protected function convertShipmentCarrierNameToId(string $queryString): string
    {
        $shipmentCarrierNames = $this->extractConditionValueWithShipmentCarrierNames($queryString);

        foreach ($shipmentCarrierNames as $shipmentCarrierName) {
            $spyShipmentCarrier = SpyShipmentCarrierQuery::create()
                ->filterByName($shipmentCarrierName)
                ->findOne();

            $queryString = str_replace('"' . $shipmentCarrierName . '"', '"' . $spyShipmentCarrier->getIdShipmentCarrier() . '"', $queryString);
        }

        return $queryString;
    }

    /**
     * @param string $queryString
     *
     * @return array<string>
     */
    protected function extractConditionValuesWithShipmentCarrierMethodNames(string $queryString): array
    {
        $shipmentMethodNames = [];
        preg_match_all('/shipment-method = "([\w \(\)]*)"/', $queryString, $shipmentMethodNames);
        $shipmentMethodNames = $shipmentMethodNames[1];

        return $shipmentMethodNames;
    }

    /**
     * @param string $queryString
     *
     * @return array<string>
     */
    protected function extractConditionValueWithShipmentCarrierNames(string $queryString): array
    {
        $shipmentCarrierNames = [];
        preg_match_all('/shipment-carrier = "([\w \(\)]*)"/', $queryString, $shipmentCarrierNames);
        $shipmentCarrierNames = $shipmentCarrierNames[1];

        return $shipmentCarrierNames;
    }

    /**
     * @param string $conditionValue
     *
     * @return \Orm\Zed\Shipment\Persistence\SpyShipmentMethod
     */
    protected function findShipmentMethodByConditionValue(string $conditionValue): SpyShipmentMethod
    {
        $shipmentCarrierNameMatches = [];
        preg_match_all('/([\w ]+)\(([\w ]+)\)/', $conditionValue, $shipmentCarrierNameMatches);

        $shipmentMethodName = empty($shipmentCarrierNameMatches[1][0]) ? $conditionValue : trim($shipmentCarrierNameMatches[1][0]);
        $shipmentCarrierName = empty($shipmentCarrierNameMatches[2][0]) ? '' : trim($shipmentCarrierNameMatches[2][0]);

        return SpyShipmentMethodQuery::create()
            ->filterByName($shipmentMethodName)
            ->useShipmentCarrierQuery()
            ->filterByName($shipmentCarrierName)
            ->endUse()
            ->findOne();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Orm\Zed\Discount\Persistence\SpyDiscount $discountEntity
     *
     * @return void
     */
    protected function saveDiscountPromotion(DataSetInterface $dataSet, SpyDiscount $discountEntity): void
    {
        if (!isset($dataSet[static::KEY_PROMOTION_SKU]) || empty($dataSet[static::KEY_PROMOTION_SKU])) {
            return;
        }
        $discountPromotion = SpyDiscountPromotionQuery::create()
            ->filterByFkDiscount($discountEntity->getIdDiscount())
            ->findOneOrCreate();

        $discountPromotion->setAbstractSku($dataSet[static::KEY_PROMOTION_SKU]);
        if (property_exists(SpyDiscountPromotion::class, 'abstract_skus')) {
            $discountPromotion->setAbstractSkus($dataSet[static::KEY_PROMOTION_SKU]);
        }
        $discountPromotion->setQuantity($dataSet[static::KEY_PROMOTION_QUANTITY]);
        $discountPromotion->save();
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ExampleProductSalePage\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\Criterion\BasicModelCriterion;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Pyz\Zed\ExampleProductSalePage\Persistence\ExampleProductSalePagePersistenceFactory getFactory()
 */
class ExampleProductSalePageQueryContainer extends AbstractQueryContainer implements ExampleProductSalePageQueryContainerInterface
{
    /**
     * @var string
     */
    protected const PRICE_TYPE_ORIGINAL = 'ORIGINAL';

    /**
     * @var string
     */
    protected const PRICE_TYPE_DEFAULT = 'DEFAULT';

    /**
     * @api
     *
     * @param string $labelName
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelQuery
     */
    public function queryProductLabelByName(string $labelName): SpyProductLabelQuery
    {
        return $this->getFactory()
            ->getProductLabelQueryContainer()
            ->queryProductLabelByName($labelName);
    }

    /**
     * @api
     *
     * @param int $idProductLabel
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery
     */
    public function queryRelationsBecomingInactive(int $idProductLabel): SpyProductLabelProductAbstractQuery
    {
        /** @var \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery $productLabelProductAbstractQuery */
        $productLabelProductAbstractQuery = $this->getFactory()
            ->getProductLabelQueryContainer()
            ->queryProductAbstractRelationsByIdProductLabel($idProductLabel)
            ->distinct()
            ->useSpyProductAbstractQuery(null, Criteria::LEFT_JOIN)
                ->usePriceProductQuery('priceProductOrigin', Criteria::LEFT_JOIN)
                    ->joinPriceType('priceTypeOrigin', Criteria::INNER_JOIN)
                    ->addJoinCondition(
                        'priceTypeOrigin',
                        'priceTypeOrigin.name = ?',
                        static::PRICE_TYPE_ORIGINAL,
                    )
                    ->usePriceProductStoreQuery('priceProductStoreOrigin', Criteria::LEFT_JOIN)
                        ->usePriceProductDefaultQuery('priceProductDefaultOriginal', Criteria::LEFT_JOIN)
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->usePriceProductQuery('priceProductDefault', Criteria::LEFT_JOIN)
                    ->joinPriceType('priceTypeDefault', Criteria::INNER_JOIN)
                    ->addJoinCondition(
                        'priceTypeDefault',
                        'priceTypeDefault.name = ?',
                        static::PRICE_TYPE_DEFAULT,
                    )
                    ->usePriceProductStoreQuery('priceProductStoreDefault', Criteria::LEFT_JOIN)
                        ->usePriceProductDefaultQuery('priceProductDefaultDefault', Criteria::LEFT_JOIN)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->addAnd('priceProductDefaultOriginal.id_price_product_default', null, Criteria::ISNOTNULL)
            ->addAnd('priceProductDefaultDefault.id_price_product_default', null, Criteria::ISNOTNULL)
            ->addJoinCondition('priceProductStoreDefault', 'priceProductStoreOrigin.fk_store = priceProductStoreDefault.fk_store')
            ->addJoinCondition('priceProductStoreDefault', 'priceProductStoreOrigin.fk_currency = priceProductStoreDefault.fk_currency');

        $orCriterion = $this->getBasicModelCriterion(
            $productLabelProductAbstractQuery,
            'priceProductStoreOrigin.gross_price < priceProductStoreDefault.gross_price',
            'priceProductStoreOrigin.gross_price',
        );
        $orCriterion->addOr($productLabelProductAbstractQuery->getNewCriterion('priceProductStoreOrigin.gross_price', null, Criteria::ISNULL));
        $orCriterion->addOr($productLabelProductAbstractQuery->getNewCriterion('priceProductStoreOrigin.net_price', null, Criteria::ISNULL));
        $orCriterion->addOr(
            $this->getBasicModelCriterion(
                $productLabelProductAbstractQuery,
                'priceProductStoreOrigin.net_price < priceProductStoreDefault.net_price',
                'priceProductStoreOrigin.net_price',
            ),
        );
        $orCriterion->addOr($productLabelProductAbstractQuery->getNewCriterion('priceProductStoreDefault.gross_price', null, Criteria::ISNULL));
        $orCriterion->addOr($productLabelProductAbstractQuery->getNewCriterion('priceProductStoreDefault.net_price', null, Criteria::ISNULL));
        $productLabelProductAbstractQuery->addAnd($orCriterion);

        return $productLabelProductAbstractQuery;
    }

    /**
     * @api
     *
     * @param int $idProductLabel
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryRelationsBecomingActive(int $idProductLabel): SpyProductAbstractQuery
    {
        /** @var \Orm\Zed\Product\Persistence\SpyProductAbstractQuery $productAbstractQuery */
        $productAbstractQuery = $this->getFactory()
            ->getProductQueryContainer()
            ->queryProductAbstract()
            ->distinct()
            ->usePriceProductQuery('priceProductOrigin', Criteria::LEFT_JOIN)
                ->joinPriceType('priceTypeOrigin', Criteria::INNER_JOIN)
                ->addJoinCondition(
                    'priceTypeOrigin',
                    'priceTypeOrigin.name = ?',
                    static::PRICE_TYPE_ORIGINAL,
                )
                ->usePriceProductStoreQuery('priceProductStoreOrigin', Criteria::LEFT_JOIN)
                    ->usePriceProductDefaultQuery('priceProductDefaultOriginal', Criteria::LEFT_JOIN)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->usePriceProductQuery('priceProductDefault', Criteria::LEFT_JOIN)
                ->joinPriceType('priceTypeDefault', Criteria::INNER_JOIN)
                ->addJoinCondition(
                    'priceTypeDefault',
                    'priceTypeDefault.name = ?',
                    static::PRICE_TYPE_DEFAULT,
                )
                ->usePriceProductStoreQuery('priceProductStoreDefault', Criteria::LEFT_JOIN)
                    ->usePriceProductDefaultQuery('priceProductDefaultDefault', Criteria::LEFT_JOIN)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->useSpyProductLabelProductAbstractQuery('rel', Criteria::LEFT_JOIN)
                ->filterByFkProductLabel(null, Criteria::ISNULL)
            ->endUse()
            ->addJoinCondition('rel', sprintf('rel.fk_product_label = %d', $idProductLabel))
            ->addAnd('rel.fk_product_label', null, Criteria::ISNULL)
            ->addAnd('priceProductDefaultOriginal.id_price_product_default', null, Criteria::ISNOTNULL)
            ->addAnd('priceProductDefaultDefault.id_price_product_default', null, Criteria::ISNOTNULL)
            ->addAnd('priceProductStoreOrigin.gross_price', null, Criteria::ISNOTNULL)
            ->addAnd('priceProductStoreOrigin.net_price', null, Criteria::ISNOTNULL)
            ->addJoinCondition('priceProductStoreDefault', 'priceProductStoreOrigin.fk_store = priceProductStoreDefault.fk_store')
            ->addJoinCondition('priceProductStoreDefault', 'priceProductStoreOrigin.fk_currency = priceProductStoreDefault.fk_currency')
            ->addJoinCondition('priceProductStoreDefault', 'priceProductStoreOrigin.gross_price > priceProductStoreDefault.gross_price')
            ->addJoinCondition('priceProductStoreDefault', 'priceProductStoreOrigin.net_price > priceProductStoreDefault.net_price');

        return $productAbstractQuery;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria
     * @param string $clause
     * @param \Propel\Runtime\Map\ColumnMap|string $column
     *
     * @return \Propel\Runtime\ActiveQuery\Criterion\BasicModelCriterion
     */
    protected function getBasicModelCriterion(Criteria $criteria, string $clause, $column): BasicModelCriterion
    {
        return new BasicModelCriterion($criteria, $clause, $column);
    }
}

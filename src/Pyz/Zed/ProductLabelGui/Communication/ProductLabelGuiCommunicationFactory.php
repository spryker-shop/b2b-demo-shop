<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductLabelGui\Communication;

use Pyz\Zed\ProductLabelGui\Communication\Table\AssignedProductTable;
use Pyz\Zed\ProductLabelGui\Communication\Table\AvailableProductTable;
use Pyz\Zed\ProductLabelGui\Communication\Table\RelatedProductOverviewTable;
use Pyz\Zed\ProductLabelGui\Communication\Table\RelatedProductTableQueryBuilder;
use Spryker\Zed\ProductLabelGui\Communication\ProductLabelGuiCommunicationFactory as SprykerProductLabelGuiCommunicationFactory;

/**
 * @method \Spryker\Zed\ProductLabelGui\ProductLabelGuiConfig getConfig()
 * @method \Spryker\Zed\ProductLabelGui\Persistence\ProductLabelGuiQueryContainerInterface getQueryContainer()
 */
class ProductLabelGuiCommunicationFactory extends SprykerProductLabelGuiCommunicationFactory
{
    /**
     * @param int|null $idProductLabel
     *
     * @return \Pyz\Zed\ProductLabelGui\Communication\Table\AvailableProductTable
     */
    public function createAvailableProductTable($idProductLabel = null)
    {
        return new AvailableProductTable(
            $this->createRelatedProductTableQueryBuilder(),
            $this->getMoneyFacade(),
            $idProductLabel,
            $this->getPriceProductFacade()
        );
    }

    /**
     * @param int|null $idProductLabel
     *
     * @return \Pyz\Zed\ProductLabelGui\Communication\Table\AssignedProductTable
     */
    public function createAssignedProductTable($idProductLabel = null)
    {
        return new AssignedProductTable(
            $this->createRelatedProductTableQueryBuilder(),
            $this->getMoneyFacade(),
            $idProductLabel,
            $this->getPriceProductFacade()
        );
    }

    /**
     * @param int $idProductLabel
     *
     * @return \Spryker\Zed\ProductLabelGui\Communication\Table\RelatedProductOverviewTable
     */
    public function createRelatedProductOverviewTable($idProductLabel)
    {
        return new RelatedProductOverviewTable(
            $this->createRelatedProductTableQueryBuilder(),
            $this->getMoneyFacade(),
            $idProductLabel,
            $this->getPriceProductFacade()
        );
    }

    /**
     * @return \Spryker\Zed\ProductLabelGui\Communication\Table\RelatedProductTableQueryBuilderInterface
     */
    public function createRelatedProductTableQueryBuilder()
    {
        return new RelatedProductTableQueryBuilder(
            $this->getProductQueryContainer(),
            $this->getQueryContainer(),
            $this->getLocaleFacade(),
            $this->getConfig()
        );
    }
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Sales\Communication\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use \Spryker\Zed\Sales\Dependency\Plugin\OrderExpanderPreSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\Sales\Business\SalesFacadeInterface getFacade()
 * @method \Spryker\Zed\Sales\Communication\SalesCommunicationFactory getFactory()
 * @method \Pyz\Zed\Sales\SalesConfig getConfig()
 * @method \Spryker\Zed\Sales\Persistence\SalesQueryContainerInterface getQueryContainer()
 */
class PointOfContactOrderExpanderPreSavePlugin extends AbstractPlugin implements OrderExpanderPreSavePluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SpySalesOrderEntityTransfer $spySalesOrderEntityTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SpySalesOrderEntityTransfer
     */
    public function expand(
        SpySalesOrderEntityTransfer $spySalesOrderEntityTransfer,
        QuoteTransfer $quoteTransfer
    ): SpySalesOrderEntityTransfer {
        $pointOfContactTransfer = $quoteTransfer->getPointOfContact();
        $spySalesOrderEntityTransfer->setPocId($pointOfContactTransfer->getPointOfContactId());
        $spySalesOrderEntityTransfer->setPocDepartment($pointOfContactTransfer->getDepartment());
        $spySalesOrderEntityTransfer->setPocFirstName($pointOfContactTransfer->getFirstName());
        $spySalesOrderEntityTransfer->setPocLastName($pointOfContactTransfer->getLastName());
        $spySalesOrderEntityTransfer->setPocPhone($pointOfContactTransfer->getPhone());
        $spySalesOrderEntityTransfer->setPocDeliveryTime($pointOfContactTransfer->getDeliveryTime());
        $spySalesOrderEntityTransfer->setPocComment($pointOfContactTransfer->getComment());

        return $spySalesOrderEntityTransfer;
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Sales\Communication\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Sales\Dependency\Plugin\OrderExpanderPreSavePluginInterface;

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

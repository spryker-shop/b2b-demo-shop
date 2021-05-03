<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Oms\Communication\Plugin\Command;

use GuzzleHttp\Client;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

/**
 * @method \Spryker\Zed\Oms\Business\OmsFacadeInterface getFacade()
 * @method \Spryker\Zed\Oms\Communication\OmsCommunicationFactory getFactory()
 * @method \Spryker\Zed\Oms\OmsConfig getConfig()
 * @method \Spryker\Zed\Oms\Persistence\OmsQueryContainerInterface getQueryContainer()
 */
class CallExternalDeliveryPlugin extends AbstractPlugin implements CommandByOrderInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $address = $orderEntity->getShippingAddress()->getAddress1() . ' ';
        $address .= $orderEntity->getShippingAddress()->getZipCode() . ' ';
        $address .= $orderEntity->getShippingAddress()->getCity() . ' ';
        $address .= $orderEntity->getShippingAddress()->getCountry()->getName();

        $client = new Client(['base_uri' => 'http://localhost:8080/']);
        $request = '/create_order.php?order_id='.$orderEntity->getIdSalesOrder().'&order_name='.$orderEntity->getShippingAddress()->getFirstName().' '.$orderEntity->getShippingAddress()->getLastName().'&order_address='. $address;
        $client->request('GET', $request);

        return [];
    }
}

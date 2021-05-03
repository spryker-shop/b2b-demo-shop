<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Oms\Communication\Plugin\Condition;

use GuzzleHttp\Client;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;


class IsExDeliverySuccessfulPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        $client = new Client(['base_uri' => 'http://localhost:8080/']);
        $response = $client->request('GET', '/check_order_status.php?order_id=' . $orderItem->getFkSalesOrder());

        $stringBody = (string) $response->getBody();

//        file_put_contents(APPLICATION_ROOT_DIR.'/tmp.log',$stringBody.PHP_EOL, FILE_APPEND);

        return $stringBody === 'delivered';
    }
}

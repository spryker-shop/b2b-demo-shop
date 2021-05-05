<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Oms\Communication\Controller;

use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @method \Spryker\Zed\Oms\Business\OmsFacadeInterface getFacade()
 * @method \Spryker\Zed\Oms\Persistence\OmsQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Oms\Communication\OmsCommunicationFactory getFactory()
 * @method \Spryker\Zed\Oms\Persistence\OmsRepositoryInterface getRepository()
 */
class TriggerController extends \Spryker\Zed\Oms\Communication\Controller\TriggerController
{

    public function triggerEventAction(Request $request)
    {
        $idOrder = $this->castId($request->query->getInt(static::REQUEST_PARAMETER_ID_SALES_ORDER));
        $event = $request->query->get(static::REQUEST_PARAMETER_EVENT);

        /** @var array $itemsList */
        $itemsList = $request->query->get(static::REQUEST_PARAMETER_ITEMS);

        $orderItems = $this->getOrderItemsToTriggerAction($idOrder, $itemsList);

        $this->getFacade()->triggerEvent($event, $orderItems, []);

        return $this->jsonResponse(['all events triggered successfully.']);
    }
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Oms\Communication\Controller;

use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodTypeQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Spryker\Zed\Oms\Business\OmsFacadeInterface getFacade()
 * @method \Spryker\Zed\Oms\Persistence\OmsQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Oms\Communication\OmsCommunicationFactory getFactory()
 * @method \Spryker\Zed\Oms\Persistence\OmsRepositoryInterface getRepository()
 */
class IndexController extends \Spryker\Zed\Oms\Communication\Controller\IndexController
{

    public function processesAction(Request $request)
    {
        $defaultPaymentMethod = SpySalesPaymentMethodTypeQuery::create()->findByPaymentMethod("invoice")->get(0);
        $defaultProcessName =  $defaultPaymentMethod->getOmsProcessName();
        $allProcesses = [
            'SprykerDeliveryPayment' => 'Spryker delivery payment',
            'BranchDeliveryPayment'  => 'Branch delivery payment',
            'QuoteRequestPayment' => 'Quote request payment',
        ];

        $filterProcesses = [];
        $filterProcesses[$defaultProcessName] = $allProcesses[$defaultProcessName];

        foreach ($allProcesses as $key => $value) {
            $filterProcesses[$key] = $value;
        }


        return [
            'inprocesses' => $filterProcesses,
            'ccprocesses' => $allProcesses, // not implemented yet
        ];
    }

    public function submitProcessAction(Request $request)
    {
        $defaultPaymentMethod = SpySalesPaymentMethodTypeQuery::create()->findByPaymentMethod("invoice")->get(0);
        $defaultPaymentMethod->setOmsProcessName($request->get('inprocesses'));
        $defaultPaymentMethod->save();
        return $this->redirectResponse('/oms/index/processes');
    }
}

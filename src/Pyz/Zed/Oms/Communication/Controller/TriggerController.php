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
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "localhost");
//        curl_setopt($ch, CURLOPT_PORT, 8080);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $output = curl_exec($ch);
//        curl_close($ch);

        return $this->jsonResponse(['events are triggered']);
//        return $this->jsonResponse(['events are triggered', $output]);
    }
}

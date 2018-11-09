<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductReviewWidget\Controller;

use SprykerShop\Yves\ProductReviewWidget\Controller\SubmitController as SprykerSubmitController;
use Symfony\Component\HttpFoundation\Request;

class SubmitController extends SprykerSubmitController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function getParentRequest(): Request
    {
        return $this->getApplication()['request_stack']->getMasterRequest();
    }
}

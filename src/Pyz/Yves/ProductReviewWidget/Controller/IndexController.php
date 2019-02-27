<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductReviewWidget\Controller;

use Generated\Shared\Transfer\ProductReviewSearchRequestTransfer;
use SprykerShop\Yves\ProductReviewWidget\Controller\IndexController as SprykerIndexController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerShop\Yves\ProductReviewWidget\ProductReviewWidgetFactory getFactory()
 */
class IndexController extends SprykerIndexController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    protected function executeIndexAction(Request $request): array
    {
        $parentRequestParams = $this->getParentRequest()->query->all();
        $idProductAbstract = $request->attributes->get('idProductAbstract');

        $customer = $this->getFactory()->getCustomerClient()->getCustomer();
        $hasCustomer = $customer !== null;

        $productReviewSearchRequestTransfer = new ProductReviewSearchRequestTransfer();
        $productReviewSearchRequestTransfer->setIdProductAbstract($idProductAbstract);

        if ($parentRequestParams) {
            $productReviewSearchRequestTransfer->setRequestParams($parentRequestParams);
        }

        $productReviews = $this->getFactory()
            ->getProductReviewClient()
            ->findProductReviewsInSearch($productReviewSearchRequestTransfer);

        return [
            'hasCustomer' => $hasCustomer,
            'productReviews' => $productReviews['productReviews'],
            'pagination' => $productReviews['pagination'],
            'summary' => $this->getFactory()->createProductReviewSummaryCalculator()->execute($productReviews['ratingAggregation']),
            'maximumRating' => $this->getFactory()->getProductReviewClient()->getMaximumRating(),
            'idProductAbstract' => $idProductAbstract,
        ];
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function getParentRequest(): Request
    {
        return $this->getApplication()['request_stack']->getMasterRequest();
    }
}

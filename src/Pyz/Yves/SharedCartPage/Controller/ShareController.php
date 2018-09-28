<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\SharedCartPage\Controller;

use SprykerShop\Yves\SharedCartPage\Controller\ShareController as SprykerShareController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \SprykerShop\Yves\SharedCartPage\SharedCartPageFactory getFactory()
 */
class ShareController extends SprykerShareController
{
    /**
     * @param int $idQuote
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function executeIndexAction(int $idQuote, Request $request)
    {
        $quoteTransfer = $this->getFactory()
            ->getMultiCartClient()
            ->findQuoteById($idQuote);

        if (!$quoteTransfer->getCustomer()->getCompanyUserTransfer()) {
            throw new NotFoundHttpException();
        }


        if ($quoteTransfer === null || !$this->isQuoteAccessOwner($quoteTransfer)) {
            return $this->redirectResponseInternal(static::URL_REDIRECT_MULTI_CART_PAGE);
        }

        $sharedCartForm = $this->getFactory()
            ->getShareCartForm($idQuote)
            ->handleRequest($request);

        if ($sharedCartForm->isSubmitted() && $sharedCartForm->isValid()) {
            $shareCartRequestTransfer = $sharedCartForm->getData();
            $quoteResponseTransfer = $this->getFactory()->getSharedCartClient()
                ->updateQuotePermissions($shareCartRequestTransfer);
            if ($quoteResponseTransfer->getIsSuccessful()) {
                $this->addSuccessMessage(static::KEY_GLOSSARY_SHARED_CART_PAGE_SHARE_SUCCESS);

                return $this->redirectResponseInternal(static::URL_REDIRECT_MULTI_CART_PAGE);
            }
        }

        return [
            'idQuote' => $idQuote,
            'sharedCartForm' => $sharedCartForm->createView(),
            'cart' => $quoteTransfer,
        ];
    }
}

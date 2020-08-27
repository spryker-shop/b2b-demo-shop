<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CheckoutRestApi\Communication\Plugin;

use Generated\Shared\Transfer\PointOfContactTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Spryker\Zed\CheckoutRestApiExtension\Dependency\Plugin\QuoteMapperPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\CheckoutRestApi\Business\CheckoutRestApiFacadeInterface getFacade()
 * @method \Spryker\Zed\CheckoutRestApi\CheckoutRestApiConfig getConfig()
 */
class PointOfContactQuoteMapperPlugin extends AbstractPlugin implements QuoteMapperPluginInterface
{
    /**
     * {@inheritDoc}
     * - Maps rest request PointOfContact to quote.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function map(
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $restPointOfContactTransfer = $restCheckoutRequestAttributesTransfer->getPointOfContact();

        if (!$restPointOfContactTransfer) {
            return $quoteTransfer;
        }

        $pointOfContactTransfer = (new PointOfContactTransfer())
            ->fromArray($restPointOfContactTransfer->toArray(), true);
        $quoteTransfer->setPointOfContact($pointOfContactTransfer);

        return $quoteTransfer;
    }
}

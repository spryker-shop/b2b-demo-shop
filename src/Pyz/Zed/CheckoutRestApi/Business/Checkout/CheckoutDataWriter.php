<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CheckoutRestApi\Business\Checkout;

use ArrayObject;
use Generated\Shared\Transfer\ApproverDetailsTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\QuoteApprovalRequestTransfer;
use Generated\Shared\Transfer\QuoteApprovalTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCheckoutErrorTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Pyz\Zed\CompanyUser\Business\CompanyUserFacadeInterface;
use Spryker\Shared\CheckoutRestApi\CheckoutRestApiConfig;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\Quote\QuoteReaderInterface;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCalculationFacadeInterface;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;
use Spryker\Zed\QuoteApproval\Business\QuoteApprovalFacadeInterface;

class CheckoutDataWriter implements CheckoutDataWriterInterface
{
    /**
     * @var \Spryker\Zed\CheckoutRestApi\Business\Checkout\Quote\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @var \Spryker\Zed\CheckoutRestApiExtension\Dependency\Plugin\QuoteMapperPluginInterface[]
     */
    protected $quoteMapperPlugins;

    /**
     * @var \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCalculationFacadeInterface
     */
    protected $calculationFacade;

    /**
     * @var \Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @var \Spryker\Zed\QuoteApproval\Business\QuoteApprovalFacadeInterface
     */
    protected $quoteApprovalFacade;

    /**
     * @var \Pyz\Zed\CompanyUser\Business\CompanyUserFacadeInterface
     */
    protected $companyUserFacade;

    /**
     * @param \Spryker\Zed\CheckoutRestApi\Business\Checkout\Quote\QuoteReaderInterface $quoteReader
     * @param \Spryker\Zed\CheckoutRestApiExtension\Dependency\Plugin\QuoteMapperPluginInterface[] $quoteMapperPlugins
     * @param \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCalculationFacadeInterface $calculationFacade
     * @param \Spryker\Zed\Quote\Business\QuoteFacadeInterface $quoteFacade
     * @param \Spryker\Zed\QuoteApproval\Business\QuoteApprovalFacadeInterface $quoteApprovalFacade
     * @param \Pyz\Zed\CompanyUser\Business\CompanyUserFacadeInterface $companyUserFacade
     */
    public function __construct(
        QuoteReaderInterface $quoteReader,
        array $quoteMapperPlugins,
        CheckoutRestApiToCalculationFacadeInterface $calculationFacade,
        QuoteFacadeInterface $quoteFacade,
        QuoteApprovalFacadeInterface $quoteApprovalFacade,
        CompanyUserFacadeInterface $companyUserFacade
    ) {
        $this->quoteReader = $quoteReader;
        $this->quoteMapperPlugins = $quoteMapperPlugins;
        $this->calculationFacade = $calculationFacade;
        $this->quoteFacade = $quoteFacade;
        $this->quoteApprovalFacade = $quoteApprovalFacade;
        $this->companyUserFacade = $companyUserFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer
     */
    public function updateCheckoutData(RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer): RestCheckoutUpdateResponseTransfer
    {
        $quoteTransfer = $this->quoteReader->findCustomerQuoteByUuid($restCheckoutRequestAttributesTransfer);

        if (!$quoteTransfer) {
            return $this->createCartNotFoundErrorResponse();
        }

        $quoteTransfer = $this->manageQuoteApproval($restCheckoutRequestAttributesTransfer, $quoteTransfer);

        foreach ($this->quoteMapperPlugins as $quoteMappingPlugin) {
            $quoteTransfer = $quoteMappingPlugin->map($restCheckoutRequestAttributesTransfer, $quoteTransfer);
        }

        $quoteTransfer = $this->addItemLevelShipmentTransfer($quoteTransfer);
        $quoteTransfer = $this->calculationFacade->recalculateQuote($quoteTransfer);

        $this->quoteFacade->updateQuote($quoteTransfer);

        return (new RestCheckoutUpdateResponseTransfer())
            ->setIsSuccess(true)
            ->setQuote($quoteTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer
     */
    protected function createCartNotFoundErrorResponse(): RestCheckoutUpdateResponseTransfer
    {
        return (new RestCheckoutUpdateResponseTransfer())
            ->setIsSuccess(false)
            ->addError(
                (new RestCheckoutErrorTransfer())
                    ->setErrorIdentifier(CheckoutRestApiConfig::ERROR_IDENTIFIER_CART_NOT_FOUND)
            );
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function addItemLevelShipmentTransfer(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getShipment()) {
                continue;
            }

            $itemTransfer->setShipment($quoteTransfer->getShipment() ?? new ShipmentTransfer());
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function manageQuoteApproval(
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        if (!$restCheckoutRequestAttributesTransfer->getApproverDetails()
            || !$restCheckoutRequestAttributesTransfer->getApproverDetails()->getApproverId()
        ) {
            return $quoteTransfer;
        }
        $approverDetailsTransfer = (new ApproverDetailsTransfer())
            ->fromArray($restCheckoutRequestAttributesTransfer->getApproverDetails()->toArray(), true);

        $companyUserTransfer = $this->companyUserFacade->findActiveCompanyUserByUuid(
            (new CompanyUserTransfer())
                ->setUuid($restCheckoutRequestAttributesTransfer->getApproverDetails()->getApproverId())
        );
        if (!$companyUserTransfer) {
            return $quoteTransfer;
        }

        $currentQuoteApprovalTransfer = $this->getCurrentQuoteApprovalTransfer($quoteTransfer, $companyUserTransfer, $approverDetailsTransfer);
        if ($currentQuoteApprovalTransfer) {
            $quoteTransfer->setQuoteApprovals(new ArrayObject([
                $currentQuoteApprovalTransfer,
            ]));

            return $quoteTransfer;
        }

        $requesterCompanyUserTransfer = $this->companyUserFacade->findActiveCompanyUserByUuid(
            (new CompanyUserTransfer())
                ->setUuid($restCheckoutRequestAttributesTransfer->getCustomer()->getUuidCompanyUser())
        );
        if (!$requesterCompanyUserTransfer) {
            return $quoteTransfer;
        }

        $quoteApprovalRequestTransfer = (new QuoteApprovalRequestTransfer())
            ->setIdQuote($quoteTransfer->getIdQuote())
            ->setQuote($quoteTransfer)
            ->setApproverCompanyUserId($companyUserTransfer->getIdCompanyUser())
            ->setRequesterCompanyUserId($requesterCompanyUserTransfer->getIdCompanyUser());

        $quoteApprovalResponseTransfer = $this->quoteApprovalFacade->createQuoteApproval($quoteApprovalRequestTransfer);

        if (!$quoteApprovalResponseTransfer->getIsSuccessful()) {
            return $quoteTransfer;
        }

        $currentQuoteApprovalTransfer = $this->getCurrentQuoteApprovalTransfer($quoteTransfer, $companyUserTransfer, $approverDetailsTransfer);
        if ($currentQuoteApprovalTransfer) {
            $quoteTransfer->setQuoteApprovals(new ArrayObject([
                $currentQuoteApprovalTransfer,
            ]));
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\ApproverDetailsTransfer $approverDetailsTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalTransfer|null
     */
    protected function getCurrentQuoteApprovalTransfer(
        QuoteTransfer $quoteTransfer,
        CompanyUserTransfer $companyUserTransfer,
        ApproverDetailsTransfer $approverDetailsTransfer
    ): ?QuoteApprovalTransfer {
        $currentQuoteApprovalTransfer = null;
        foreach ($quoteTransfer->getQuoteApprovals() as $quoteApprovalTransfer) {
            if ($quoteApprovalTransfer->getApprover()->getUuid() === $companyUserTransfer->getUuid()
                && $quoteApprovalTransfer->getUuid() !== null
            ) {
                $currentQuoteApprovalTransfer = $quoteApprovalTransfer;
                $currentQuoteApprovalTransfer->setApproverDetails($approverDetailsTransfer);

                break;
            }
        }

        return $currentQuoteApprovalTransfer;
    }
}

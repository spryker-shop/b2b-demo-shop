<?php



declare(strict_types = 1);

namespace Pyz\Shared\QuoteApproval;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\QuoteApproval\QuoteApprovalConfig as SprykerQuoteApprovalConfig;

class QuoteApprovalConfig extends SprykerQuoteApprovalConfig
{
    /**
     * @return array<string>
     */
    public function getRequiredQuoteFieldsForApprovalProcess(): array
    {
        return [
            QuoteTransfer::BILLING_ADDRESS,
            QuoteTransfer::PAYMENT,
        ];
    }

    /**
     * @deprecated Will be removed without replacement. BC-reason only.
     *
     * @return bool
     */
    public function isShipmentPriceIncludedInQuoteApprovalPermissionCheck(): bool
    {
        return true;
    }
}

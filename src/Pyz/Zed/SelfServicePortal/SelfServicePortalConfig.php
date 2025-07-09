<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\SelfServicePortal;

use SprykerFeature\Zed\SelfServicePortal\SelfServicePortalConfig as SprykerSelfServicePortalConfig;

class SelfServicePortalConfig extends SprykerSelfServicePortalConfig
{
    /**
     * @return string
     */
    public function getDefaultMerchantReference(): string
    {
        return 'MER000001';
    }

    /**
     * @return array<string>
     */
    public function getInquiryStatusClassMap(): array
    {
        return [
            'approved' => 'label-success',
            'rejected' => 'label-danger',
            'pending' => 'label-warning',
            'canceled' => 'label-default',
            'in_review' => 'label-primary',
        ];
    }

    /**
     * @return string|null
     */
    public function getInquiryPendingStatus(): ?string
    {
        return 'pending';
    }

    /**
     * @return string|null
     */
    public function getAssetStorageName(): ?string
    {
        return 'ssp-asset-image';
    }
}

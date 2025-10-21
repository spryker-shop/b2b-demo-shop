<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\SelfServicePortal;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use SprykerFeature\Zed\SelfServicePortal\SelfServicePortalConfig as SprykerSelfServicePortalConfig;

class SelfServicePortalConfig extends SprykerSelfServicePortalConfig
{
    public function getDefaultMerchantReference(): string
    {
        return 'MERSPRYKER';
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

    public function getInquiryPendingStatus(): string
    {
        return 'pending';
    }

    /**
     * @return array<string>
     */
    public function getAssetStatusClassMap(): array
    {
        return [
        'pending' => 'label-warning',
        'in_review' => 'label-primary',
        'approved' => 'label-success',
        'deactivated' => 'label-danger',
        ];
    }

    public function getSspAssetSearchSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}

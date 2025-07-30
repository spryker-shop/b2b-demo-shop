<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\SelfServicePortal;

use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\SspAssetManagement\ServiceSspAssetManagementExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\SspAssetManagement\SspFileSspAssetManagementExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\SspAssetManagement\SspInquirySspAssetManagementExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\SspDashboardManagement\SspAssetDashboardDataExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\SspDashboardManagement\SspFileDashboardDataExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\SspDashboardManagement\SspInquiryDashboardDataExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\SspDashboardManagement\SspServiceDashboardDataExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\StateMachine\ApproveSspInquiryCommandPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\StateMachine\RejectSspInquiryCommandPlugin;
use SprykerFeature\Zed\SelfServicePortal\SelfServicePortalDependencyProvider as SprykerSelfServicePortalDependencyProvider;

class SelfServicePortalDependencyProvider extends SprykerSelfServicePortalDependencyProvider
{
    /**
     * @return array<int, \SprykerFeature\Zed\SelfServicePortal\Dependency\Plugin\DashboardDataExpanderPluginInterface>
     */
    protected function getDashboardDataExpanderPlugins(): array
    {
        return [
            new SspInquiryDashboardDataExpanderPlugin(),
            new SspFileDashboardDataExpanderPlugin(),
            new SspAssetDashboardDataExpanderPlugin(),
            new SspServiceDashboardDataExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\StateMachine\Dependency\Plugin\CommandPluginInterface>
     */
    protected function getStateMachineCommandPlugins(): array
    {
        return [
            'SspInquiry/Approve' => new ApproveSspInquiryCommandPlugin(),
            'SspInquiry/Reject' => new RejectSspInquiryCommandPlugin(),
        ];
    }

    /**
     * @return array<\SprykerFeature\Zed\SelfServicePortal\Dependency\Plugin\SspAssetManagementExpanderPluginInterface>
     */
    protected function getSspAssetManagementExpanderPlugins(): array
    {
        return [
            new SspInquirySspAssetManagementExpanderPlugin(),
            new SspFileSspAssetManagementExpanderPlugin(),
            new ServiceSspAssetManagementExpanderPlugin(),
        ];
    }
}

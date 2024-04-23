<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\MerchantRelationRequest;

use Spryker\Zed\CommentMerchantRelationRequestConnector\Communication\Plugin\MerchantRelationRequest\CommentThreadMerchantRelationRequestExpanderPlugin;
use Spryker\Zed\CompanyUnitAddress\Communication\Plugin\MerchantRelationRequest\AssigneeCompanyBusinessUnitAddressMerchantRelationRequestExpanderPlugin;
use Spryker\Zed\MerchantRelationRequest\MerchantRelationRequestDependencyProvider as SprykerMerchantRelationRequestDependencyProvider;

class MerchantRelationRequestDependencyProvider extends SprykerMerchantRelationRequestDependencyProvider
{
    /**
     * @return list<\Spryker\Zed\MerchantRelationRequestExtension\Dependency\Plugin\MerchantRelationRequestExpanderPluginInterface>
     */
    protected function getMerchantRelationRequestExpanderPlugins(): array
    {
        return [
            new CommentThreadMerchantRelationRequestExpanderPlugin(),
            new AssigneeCompanyBusinessUnitAddressMerchantRelationRequestExpanderPlugin(),
        ];
    }
}

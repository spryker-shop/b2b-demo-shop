<?php



declare(strict_types = 1);

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

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Installer;

use Spryker\Zed\Acl\Communication\Plugin\AclInstallerPlugin;
use Spryker\Zed\CompanyUserInvitation\Communication\Plugin\CompanyUserInvitationStatusInstallerPlugin;
use Spryker\Zed\Country\Communication\Plugin\CountryInstallerPlugin;
use Spryker\Zed\CustomerAccess\Communication\Plugin\CustomerAccessInstallerPlugin;
use Spryker\Zed\DynamicEntity\Communication\Plugin\Installer\DynamicEntityInstallerPlugin;
use Spryker\Zed\Glossary\Communication\Plugin\GlossaryInstallerPlugin;
use Spryker\Zed\Installer\InstallerDependencyProvider as SprykerInstallerDependencyProvider;
use Spryker\Zed\Locale\Communication\Plugin\LocaleInstallerPlugin;
use Spryker\Zed\Newsletter\Communication\Plugin\NewsletterInstallerPlugin;
use Spryker\Zed\Oauth\Communication\Plugin\Installer\OauthClientInstallerPlugin;
use Spryker\Zed\OauthAgentConnector\Communication\Plugin\Installer\AgentOauthScopeInstallerPlugin;
use Spryker\Zed\OauthCompanyUser\Communication\Plugin\Installer\OauthCompanyUserInstallerPlugin;
use Spryker\Zed\OauthCustomerConnector\Communication\Plugin\Installer\OauthCustomerScopeInstallerPlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\PriceInstallerPlugin;
use Spryker\Zed\ProductAlternativeProductLabelConnector\Communication\Plugin\Installer\ProductAlternativeProductLabelConnectorInstallerPlugin;
use Spryker\Zed\ProductDiscontinuedProductLabelConnector\Communication\Plugin\Installer\ProductDiscontinuedProductLabelConnectorInstallerPlugin;
use Spryker\Zed\ProductMeasurementUnit\Communication\Plugin\Installer\ProductMeasurementUnitInstallerPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Installer\ProductPackagingUnitTypeInstallerPlugin;
use Spryker\Zed\SalesOrderThreshold\Communication\Plugin\Installer\SalesOrderThresholdTypeInstallerPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\SharedCartPermissionInstallerPlugin;
use Spryker\Zed\ShoppingList\Communication\Plugin\ShoppingListPermissionsInstallerPlugin;
use Spryker\Zed\Translator\Communication\Plugin\TranslatorInstallerPlugin;
use Spryker\Zed\User\Communication\Plugin\UserInstallerPlugin;

class InstallerDependencyProvider extends SprykerInstallerDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\Installer\Dependency\Plugin\InstallerPluginInterface>
     */
    public function getInstallerPlugins(): array
    {
        return [
            new PriceInstallerPlugin(),
            new LocaleInstallerPlugin(),
            new CountryInstallerPlugin(),
            new UserInstallerPlugin(),
            new AclInstallerPlugin(),
            new NewsletterInstallerPlugin(),
            new GlossaryInstallerPlugin(),
            new CustomerAccessInstallerPlugin(),
            new TranslatorInstallerPlugin(),
            new ShoppingListPermissionsInstallerPlugin(),
            new SharedCartPermissionInstallerPlugin(), #SharedCartFeature
            new ProductMeasurementUnitInstallerPlugin(),
            new ProductAlternativeProductLabelConnectorInstallerPlugin(), #ProductAlternativeFeature
            new ProductDiscontinuedProductLabelConnectorInstallerPlugin(), #ProductDiscontinuedFeature
            new CompanyUserInvitationStatusInstallerPlugin(), #BulkImportCompanyUserInvitationsFeature
            new ProductPackagingUnitTypeInstallerPlugin(),
            new SalesOrderThresholdTypeInstallerPlugin(), #SalesOrderThresholdFeature
            new OauthClientInstallerPlugin(),
            new OauthCustomerScopeInstallerPlugin(),
            new OauthCompanyUserInstallerPlugin(),
            new AgentOauthScopeInstallerPlugin(),
            new DynamicEntityInstallerPlugin(),
        ];
    }
}

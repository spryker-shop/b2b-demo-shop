<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Installer;

use Spryker\Zed\Acl\Communication\Plugin\AclInstallerPlugin;
use Spryker\Zed\CompanyUserInvitation\Communication\Plugin\CompanyUserInvitationStatusInstallerPlugin;
use Spryker\Zed\Country\Communication\Plugin\CountryInstallerPlugin;
use Spryker\Zed\Glossary\Communication\Plugin\GlossaryInstallerPlugin;
use Spryker\Zed\Installer\InstallerDependencyProvider as SprykerInstallerDependencyProvider;
use Spryker\Zed\Locale\Communication\Plugin\LocaleInstallerPlugin;
use Spryker\Zed\Newsletter\Communication\Plugin\NewsletterInstallerPlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\PriceInstallerPlugin;
use Spryker\Zed\ProductMeasurementUnit\Communication\Plugin\Installer\ProductMeasurementUnitInstallerPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Installer\ProductPackagingUnitTypeInstallerPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\SharedCartPermissionInstallerPlugin;
use Spryker\Zed\ShoppingList\Communication\Plugin\ShoppingListPermissionsInstallerPlugin;
use Spryker\Zed\User\Communication\Plugin\UserInstallerPlugin;

class InstallerDependencyProvider extends SprykerInstallerDependencyProvider
{
    /**
     * @return \Spryker\Zed\Installer\Dependency\Plugin\InstallerPluginInterface[]
     */
    public function getInstallerPlugins()
    {
        return [
            new PriceInstallerPlugin(),
            new LocaleInstallerPlugin(),
            new CountryInstallerPlugin(),
            new UserInstallerPlugin(),
            new AclInstallerPlugin(),
            new NewsletterInstallerPlugin(),
            new GlossaryInstallerPlugin(),
            new ShoppingListPermissionsInstallerPlugin(),
            new SharedCartPermissionInstallerPlugin(), #SharedCartFeature
            new ProductMeasurementUnitInstallerPlugin(),
            new CompanyUserInvitationStatusInstallerPlugin(), #BulkImportCompanyUserInvitationsFeature
            new ProductPackagingUnitTypeInstallerPlugin(),
        ];
    }
}

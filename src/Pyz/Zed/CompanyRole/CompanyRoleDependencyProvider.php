<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\CompanyRole;

use Spryker\Zed\CompanyRole\CompanyRoleDependencyProvider as SprykerCompanyRoleDependencyProvider;
use Spryker\Zed\Customer\Communication\Plugin\CompanyRole\CustomerInvalidationCompanyRolePostSavePlugin;
use Spryker\Zed\OauthPermission\Communication\Plugin\CompanyRole\OauthPermissionUpdateCompanyRolePostSavePlugin;

class CompanyRoleDependencyProvider extends SprykerCompanyRoleDependencyProvider
{
    protected function getCompanyRolePostSavePlugins(): array
    {
        return [
            new CustomerInvalidationCompanyRolePostSavePlugin(),
            new OauthPermissionUpdateCompanyRolePostSavePlugin(),
        ];
    }
}

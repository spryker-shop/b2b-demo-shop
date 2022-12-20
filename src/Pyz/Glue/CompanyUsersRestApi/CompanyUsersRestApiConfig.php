<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\CompanyUsersRestApi;

use Spryker\Glue\CompanyUsersRestApi\CompanyUsersRestApiConfig as SprykerCompanyUsersRestApiConfig;
use Spryker\Glue\ShoppingListsRestApi\ShoppingListsRestApiConfig;

class CompanyUsersRestApiConfig extends SprykerCompanyUsersRestApiConfig
{
    /**
     * @var array<string>
     */
    protected const COMPANY_USER_RESOURCES = [
        ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
        ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
    ];
}

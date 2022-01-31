<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\CompanyUsersRestApi;

use Spryker\Glue\CompanyUsersRestApi\CompanyUsersRestApiConfig as SprykerCompanyUsersRestApiConfig;
use Spryker\Glue\QuoteRequestsRestApi\QuoteRequestsRestApiConfig;
use Spryker\Glue\ShoppingListsRestApi\ShoppingListsRestApiConfig;

class CompanyUsersRestApiConfig extends SprykerCompanyUsersRestApiConfig
{
    protected const COMPANY_USER_RESOURCES = [
        ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
        ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
        QuoteRequestsRestApiConfig::RESOURCE_QUOTE_REQUESTS,
        QuoteRequestsRestApiConfig::RESOURCE_QUOTE_REQUEST_CANCEL,
        QuoteRequestsRestApiConfig::RESOURCE_QUOTE_REQUEST_REVISE,
        QuoteRequestsRestApiConfig::RESOURCE_QUOTE_REQUEST_SEND_TO_CUSTOMER,
    ];
}

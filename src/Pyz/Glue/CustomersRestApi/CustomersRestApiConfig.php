<?php



declare(strict_types = 1);

namespace Pyz\Glue\CustomersRestApi;

use Generated\Shared\Transfer\RestAddressTransfer;
use Spryker\Glue\CustomersRestApi\CustomersRestApiConfig as SprykerCustomersRestApiConfig;

class CustomersRestApiConfig extends SprykerCustomersRestApiConfig
{
    /**
     * @return list<string>
     */
    public function getBillingAddressFieldsToSkipValidation(): array
    {
        return array_merge(parent::getBillingAddressFieldsToSkipValidation(), [
            RestAddressTransfer::ID_COMPANY_BUSINESS_UNIT_ADDRESS,
        ]);
    }
}

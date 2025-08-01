<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\TaxProductConnector;

use Spryker\Zed\CompanyUnitAddress\Communication\Plugin\TaxProductConnector\CompanyUnitAddressShippingAddressValidatorPlugin;
use Spryker\Zed\Customer\Communication\Plugin\TaxProductConnector\CustomerAddressShippingAddressValidatorPlugin;
use Spryker\Zed\TaxProductConnector\TaxProductConnectorDependencyProvider as SprykerTaxProductConnectorDependencyProvider;

class TaxProductConnectorDependencyProvider extends SprykerTaxProductConnectorDependencyProvider
{
    /**
     * @deprecated Exists for Backward Compatibility reasons only.
     *
     * @return array<\Spryker\Zed\TaxProductConnectorExtension\Communication\Dependency\Plugin\ShippingAddressValidatorPluginInterface>
     */
    protected function getShippingAddressValidatorPlugins(): array
    {
        return [
            new CustomerAddressShippingAddressValidatorPlugin(),
            new CompanyUnitAddressShippingAddressValidatorPlugin(),
        ];
    }
}

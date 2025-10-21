<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Glue\SharedCartsRestApi;

use Spryker\Glue\CompanyUserStorage\Communication\Plugin\SharedCartsRestApi\CompanyUserStorageProviderPlugin;
use Spryker\Glue\SharedCartsRestApi\SharedCartsRestApiDependencyProvider as SprykerSharedCartsRestApiDependencyProvider;
use Spryker\Glue\SharedCartsRestApiExtension\Dependency\Plugin\CompanyUserProviderPluginInterface;

class SharedCartsRestApiDependencyProvider extends SprykerSharedCartsRestApiDependencyProvider
{
    protected function getCompanyUserProviderPlugin(): CompanyUserProviderPluginInterface
    {
        return new CompanyUserStorageProviderPlugin();
    }
}

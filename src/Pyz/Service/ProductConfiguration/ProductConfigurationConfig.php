<?php



declare(strict_types = 1);

namespace Pyz\Service\ProductConfiguration;

use Generated\Shared\Transfer\ProductConfigurationInstanceTransfer;
use Spryker\Service\ProductConfiguration\ProductConfigurationConfig as SprykerProductConfigurationConfig;

class ProductConfigurationConfig extends SprykerProductConfigurationConfig
{
    /**
     * @return array<string>
     */
    public function getConfigurationFieldsNotAllowedForEncoding(): array
    {
        return [
            ProductConfigurationInstanceTransfer::QUANTITY,
        ];
    }
}

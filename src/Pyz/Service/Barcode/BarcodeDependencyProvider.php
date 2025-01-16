<?php



declare(strict_types = 1);

namespace Pyz\Service\Barcode;

use Spryker\Service\Barcode\BarcodeDependencyProvider as SprykerDependencyProvider;
use Spryker\Service\BarcodeLaminas\Plugin\Code128BarcodeGeneratorPlugin;

class BarcodeDependencyProvider extends SprykerDependencyProvider
{
    /**
     * @return array<\Spryker\Service\BarcodeExtension\Dependency\Plugin\BarcodeGeneratorPluginInterface>
     */
    protected function getBarcodeGeneratorPlugins(): array
    {
        return [
            new Code128BarcodeGeneratorPlugin()
        ];
    }
}

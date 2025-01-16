<?php



declare(strict_types = 1);

namespace Pyz\Client\ExampleProductSalePage;

use Pyz\Shared\ExampleProductSalePage\ExampleProductSalePageConfig as SharedExampleProductSaleConfig;
use Spryker\Client\Kernel\AbstractBundleConfig;

class ExampleProductSalePageConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getLabelSaleName(): string
    {
        return SharedExampleProductSaleConfig::DEFAULT_LABEL_NAME;
    }
}

<?php



declare(strict_types = 1);

namespace Pyz\Zed\ExampleProductSalePage;

use Pyz\Shared\ExampleProductSalePage\ExampleProductSalePageConfig as SharedExampleProductSalePageConfig;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ExampleProductSalePageConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getLabelSaleName(): string
    {
        return SharedExampleProductSalePageConfig::DEFAULT_LABEL_NAME;
    }
}

<?php



declare(strict_types = 1);

namespace Pyz\Zed\CartCode;

use Spryker\Zed\CartCode\CartCodeDependencyProvider as SprykerCartCodeDependencyProvider;
use Spryker\Zed\Discount\Communication\Plugin\CartCode\VoucherCartCodePlugin;
use Spryker\Zed\Nopayment\Communication\Plugin\CartCode\NopaymentCartCodePostAddPlugin;

class CartCodeDependencyProvider extends SprykerCartCodeDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CartCodeExtension\Dependency\Plugin\CartCodePluginInterface>
     */
    protected function getCartCodePlugins(): array
    {
        return [
            new VoucherCartCodePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartCodeExtension\Dependency\Plugin\CartCodePostAddPluginInterface>
     */
    protected function getCartCodePostAddPlugins(): array
    {
        return [
            new NopaymentCartCodePostAddPlugin(),
        ];
    }
}

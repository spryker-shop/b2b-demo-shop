<?php



declare(strict_types = 1);

namespace Pyz\Yves\CmsBlockWidget;

use SprykerShop\Yves\CmsBlockWidget\CmsBlockWidgetDependencyProvider as SprykerCmsBlockWidgetDependencyProvider;
use SprykerShop\Yves\CmsBlockWidget\Plugin\Twig\CmsBlockPlaceholderTwigPlugin;
use SprykerShop\Yves\CmsBlockWidget\Plugin\Twig\CmsBlockWidgetTwigPlugin;

class CmsBlockWidgetDependencyProvider extends SprykerCmsBlockWidgetDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\Twig\TwigExtensionInterface>
     */
    protected function getTwigExtensionPlugins(): array
    {
        return [
            new CmsBlockWidgetTwigPlugin(),
            new CmsBlockPlaceholderTwigPlugin(),
        ];
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentBannerWidget;

use Pyz\Yves\ContentBannerWidget\Twig\ContentBannerTwigFunction;
use SprykerShop\Yves\ContentBannerWidget\ContentBannerWidgetFactory as SprykerShopContentBannerWidgetFactory;
use SprykerShop\Yves\ContentBannerWidget\Twig\ContentBannerTwigFunction as SprykerShopContentBannerTwigFunction;
use Twig\Environment;

class ContentBannerWidgetFactory extends SprykerShopContentBannerWidgetFactory
{
    /**
     * @param \Twig\Environment $twig
     * @param string $localeName
     *
     * @return \SprykerShop\Yves\ContentBannerWidget\Twig\ContentBannerTwigFunction
     */
    public function createContentBannerTwigFunction(Environment $twig, string $localeName): SprykerShopContentBannerTwigFunction
    {
        return new ContentBannerTwigFunction(
            $twig,
            $localeName,
            $this->getContentBannerClient()
        );
    }
}

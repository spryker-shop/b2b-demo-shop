<?php



declare(strict_types = 1);

namespace Pyz\Yves\ContentProductSetWidget;

use Pyz\Yves\ContentProductSetWidget\Twig\ContentProductSetTwigFunctionProvider;
use Spryker\Shared\Twig\TwigFunctionProvider;
use SprykerShop\Yves\ContentProductSetWidget\ContentProductSetWidgetFactory as SprykerShopContentProductSetWidgetFactory;
use Twig\Environment;

class ContentProductSetWidgetFactory extends SprykerShopContentProductSetWidgetFactory
{
    /**
     * @param \Twig\Environment $twig
     * @param string $localeName
     *
     * @return \Spryker\Shared\Twig\TwigFunctionProvider
     */
    public function createContentProductSetTwigFunctionProvider(
        Environment $twig,
        string $localeName,
    ): TwigFunctionProvider {
        return new ContentProductSetTwigFunctionProvider(
            $twig,
            $localeName,
            $this->createContentProductSetReader(),
            $this->createContentProductAbstractReader(),
        );
    }
}

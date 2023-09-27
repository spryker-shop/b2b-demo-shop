<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentProductSetWidget;

use Pyz\Yves\ContentProductSetWidget\Reader\ContentProductAbstractReader;
use Pyz\Yves\ContentProductSetWidget\Reader\ContentProductAbstractReaderInterface;
use Pyz\Yves\ContentProductSetWidget\Reader\ContentProductSetReader;
use Pyz\Yves\ContentProductSetWidget\Reader\ContentProductSetReaderInterface;
use Pyz\Yves\ContentProductSetWidget\Twig\ContentProductSetTwigFunctionProvider;
use Spryker\Shared\Twig\TwigFunctionProvider;
use SprykerShop\Yves\ContentProductSetWidget\ContentProductSetWidgetFactory as SprykerShopContentProductSetWidgetFactory;
use Twig\Environment;
use Twig\TwigFunction;

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

    /**
     * @param \Twig\Environment $twig
     * @param string $localeName
     *
     * @return \Twig\TwigFunction
     */
    public function createContentProductSetTwigFunction(
        Environment $twig,
        string $localeName,
    ): TwigFunction {
        $functionProvider = $this->createContentProductSetTwigFunctionProvider($twig, $localeName);

        return new TwigFunction(
            $functionProvider->getFunctionName(),
            $functionProvider->getFunction(),
            $functionProvider->getOptions(),
        );
    }

    /**
     * @return \Pyz\Yves\ContentProductSetWidget\Reader\ContentProductSetReaderInterface
     */
    public function createContentProductSetReader(): ContentProductSetReaderInterface
    {
        return new ContentProductSetReader(
            $this->getContentProductSetClient(),
            $this->getProductSetStorageClient(),
        );
    }

    /**
     * @return \Pyz\Yves\ContentProductSetWidget\Reader\ContentProductAbstractReaderInterface
     */
    public function createContentProductAbstractReader(): ContentProductAbstractReaderInterface
    {
        return new ContentProductAbstractReader(
            $this->getProductStorageClient(),
        );
    }
}

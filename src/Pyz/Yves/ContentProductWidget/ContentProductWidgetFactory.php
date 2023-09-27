<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentProductWidget;

use Pyz\Yves\ContentProductWidget\Reader\ContentProductAbstractReader;
use Pyz\Yves\ContentProductWidget\Reader\ContentProductAbstractReaderInterface;
use Pyz\Yves\ContentProductWidget\Twig\ContentProductAbstractListTwigFunctionProvider;
use Spryker\Client\ContentProduct\ContentProductClientInterface;
use Spryker\Client\ProductStorage\ProductStorageClientInterface;
use Spryker\Shared\Twig\TwigFunctionProvider;
use SprykerShop\Yves\ContentProductWidget\ContentProductWidgetFactory as SprykerShopContentProductWidgetFactory;
use Twig\Environment;
use Twig\TwigFunction;

class ContentProductWidgetFactory extends SprykerShopContentProductWidgetFactory
{
    /**
     * @param \Twig\Environment $twig
     * @param string $localeName
     *
     * @return \Twig\TwigFunction
     */
    public function createContentProductAbstractListTwigFunction(Environment $twig, string $localeName): TwigFunction
    {
        $functionProvider = $this->createContentProductAbstractListTwigFunctionProvider($twig, $localeName);

        return new TwigFunction(
            $functionProvider->getFunctionName(),
            $functionProvider->getFunction(),
            $functionProvider->getOptions(),
        );
    }

    /**
     * @param \Twig\Environment $twig
     * @param string $localeName
     *
     * @return \Spryker\Shared\Twig\TwigFunctionProvider
     */
    public function createContentProductAbstractListTwigFunctionProvider(Environment $twig, string $localeName): TwigFunctionProvider
    {
        return new ContentProductAbstractListTwigFunctionProvider(
            $twig,
            $localeName,
            $this->createContentProductAbstractReader(),
        );
    }

    /**
     * @return \Pyz\Yves\ContentProductWidget\Reader\ContentProductAbstractReaderInterface
     */
    public function createContentProductAbstractReader(): ContentProductAbstractReaderInterface
    {
        return new ContentProductAbstractReader(
            $this->getContentProductClient(),
            $this->getProductStorageClient(),
        );
    }

    /**
     * @return \Spryker\Client\ContentProduct\ContentProductClientInterface
     */
    public function getContentProductClient(): ContentProductClientInterface
    {
        return $this->getProvidedDependency(ContentProductWidgetDependencyProvider::CLIENT_CONTENT_PRODUCT);
    }

    /**
     * @return \Spryker\Client\ProductStorage\ProductStorageClientInterface
     */
    public function getProductStorageClient(): ProductStorageClientInterface
    {
        return $this->getProvidedDependency(ContentProductWidgetDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }
}

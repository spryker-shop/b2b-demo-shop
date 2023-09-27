<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\PriceWidget\Plugin\Twig;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig\Environment;
use Twig\TwigFunction;

/**
 * @method \SprykerShop\Yves\PriceWidget\PriceWidgetFactory getFactory()
 */
class PriceModeTwigPlugin extends AbstractPlugin implements TwigPluginInterface
{
    /**
     * @var string
     */
    protected const FUNCTION_NAME_GET_PRICE_MODE = 'getPriceMode';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Twig\Environment $twig
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Twig\Environment
     */
    public function extend(Environment $twig, ContainerInterface $container): Environment
    {
        $twig = $this->addPriceModeFunction($twig);

        return $twig;
    }

    /**
     * @param \Twig\Environment $twig
     *
     * @return \Twig\Environment
     */
    protected function addPriceModeFunction(Environment $twig): Environment
    {
        $priceModeFunction = new TwigFunction(static::FUNCTION_NAME_GET_PRICE_MODE, function () {
            return $this->getFactory()->getPriceClient()->getCurrentPriceMode();
        });

        $twig->addFunction($priceModeFunction);

        return $twig;
    }
}

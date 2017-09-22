<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Twig\Plugin;

use Pyz\Yves\Twig\Dependency\Plugin\TwigFunctionPluginInterface;
use Silex\Application;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Config\Config;
use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\Kernel\Plugin\Pimple;
use Twig_Environment;
use Twig_SimpleFunction;

/**
 * @method \Pyz\Yves\Twig\TwigFactory getFactory()
 */
class TwigAsset extends AbstractPlugin implements TwigFunctionPluginInterface
{

    /**
     * @param \Silex\Application $application
     *
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions(Application $application)
    {
        $assetUrlBuilder = $this->getAssetUrlBuilder($application);
        $mediaUrlBuilder = $this->getMediaUrlBuilder($application);

        return [
            new Twig_SimpleFunction('asset', function ($value) use ($assetUrlBuilder) {
                return $assetUrlBuilder->buildUrl($value);
            }),
            new Twig_SimpleFunction('media', function ($value) use ($mediaUrlBuilder) {
                return $mediaUrlBuilder->buildUrl($value);
            }),
            // TODO: move this to its own service provider
            new Twig_SimpleFunction('widget', [$this, 'widget'], [
                'needs_context' => true,
                'is_safe' => ['html'],
                'needs_environment' => true,
            ]),
        ];
    }

    /**
     * @param \Silex\Application $application
     *
     * @return \Symfony\Component\HttpFoundation\RequestStack
     */
    private function getRequestStack(Application $application)
    {
        $requestStack = $application['request_stack'];

        return $requestStack;
    }

    /**
     * @param \Silex\Application $application
     *
     * @return bool
     */
    private function isDomainSecured(Application $application)
    {
        $requestStack = $this->getRequestStack($application);

        return $requestStack->getCurrentRequest()->isSecure();
    }

    /**
     * @param \Silex\Application $application
     *
     * @return \Pyz\Yves\Twig\Model\MediaUrlBuilderInterface
     */
    protected function getMediaUrlBuilder(Application $application)
    {
        $isDomainSecured = $this->isDomainSecured($application);
        $host = Config::get(ApplicationConstants::BASE_URL_STATIC_MEDIA);

        if ($isDomainSecured) {
            $host = Config::get(ApplicationConstants::BASE_URL_SSL_STATIC_MEDIA);
        }

        return $this->getFactory()->createMediaUrlBuilder($host);
    }

    /**
     * @param \Silex\Application $application
     *
     * @return \Pyz\Yves\Twig\Model\AssetUrlBuilderInterface
     */
    protected function getAssetUrlBuilder(Application $application)
    {
        $isDomainSecured = $this->isDomainSecured($application);
        $host = Config::get(ApplicationConstants::BASE_URL_STATIC_ASSETS);

        if ($isDomainSecured) {
            $host = Config::get(ApplicationConstants::BASE_URL_SSL_STATIC_ASSETS);
        }

        return $this->getFactory()->createAssetUrlBuilder($host);
    }

    /**
     * @param \Twig_Environment $twig
     * @param array $context
     * @param string $name
     * @param string|null $block
     *
     * @return string
     */
    public function widget(Twig_Environment $twig, array $context, $name, $block = null)
    {
        // TODO: widget in widget has different context (i.e. PDP -> similar products -> catalog product) where neither _widget or _view are available
        // TODO: find other solution to replace widgets with something else (maybe macro, or simple include...)
        $view = $this->getViewFromContext($context);

        if (!$view->hasWidget($name)) {
            return '';
        }

        $widget = $view->getWidget($name);

        // TODO: decide if we use the context like this or like below if needed at all
        $context['_widget'] = $widget;
//        $params = [
//            '_widget' => $widget,
//        ];

        $template = $twig->load($widget->getTemplate());

        if ($block !== null) {
            return $template->renderBlock($block, $context);
        }

        return $template->render($context);
    }

    /**
     * @param array $context
     *
     * @return \Spryker\Yves\Kernel\Controller\View
     */
    protected function getViewFromContext(array $context)
    {
        // TODO: cleanup; use constant instead of string
        return (new Pimple())->getApplication()['twig._view'];

        if (isset($context['_widget'])) {
            return $context['_widget']->getView();
        }

        return $context['_view'];
    }

}

<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Twig\Plugin;

use Exception;
use Pyz\Yves\Twig\Dependency\Plugin\TwigFunctionPluginInterface;
use Silex\Application;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Config\Config;
use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\Kernel\Widget\WidgetFactory;
use Spryker\Yves\Kernel\Widget\WidgetContainerInterface;
use Throwable;
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
                'needs_environment' => true,
                'needs_context' => true,
                'is_safe' => ['html'],
            ]),
            new Twig_SimpleFunction('widgetBlock', [$this, 'widgetBlock'], [
                'needs_environment' => true,
                'needs_context' => true,
                'is_safe' => ['html'],
            ]),
            new Twig_SimpleFunction('widgetExists', [$this, 'widgetExists'], [
                'needs_context' => true,
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
     * @param array $arguments
     *
     * @throws \Exception
     *
     * @return string
     */
    public function widget(Twig_Environment $twig, array $context, $name, ...$arguments)
    {
        // TODO: refactor
        try {
            $widgetContainer = $this->getWidgetContainer($context);

            if (!$widgetContainer->hasWidget($name)) {
                return '';
            }

            $widgetClass = $widgetContainer->getWidgetClassName($name);
            $widgetFactory = new WidgetFactory();
            $widget = $widgetFactory->build($widgetClass, $arguments);

            $twig->addGlobal('_widget', $widget);

            $template = $twig->load($widget::getTemplate());

            // TODO: red border / mouse hover on blocks to be able to easily identify them
            return $template->render();
        } catch (Throwable $e) {
            // TODO: use custom exception
            throw new Exception(sprintf(
                'Something went wrong in widget "%s": %s',
                $name,
                $e->getMessage()
            ), $e->getCode(), $e);
        }
    }

    /**
     * @param \Twig_Environment $twig
     * @param array $context
     * @param string $name
     * @param string $block
     * @param array $arguments
     *
     * @throws \Exception
     *
     * @return string
     */
    public function widgetBlock(Twig_Environment $twig, array $context, $name, $block, ...$arguments)
    {
        // TODO: refactor
        try {
            $view = $this->getWidgetContainer($context);

            if (!$view->hasWidget($name)) {
                return '';
            }

            $widgetClass = $view->getWidgetClassName($name);
            $widgetFactory = new WidgetFactory();
            $widget = $widgetFactory->build($widgetClass, $arguments);

            // TODO: check if there's any side effect of this global variable (nested widgets might be a problem). Check what happens when calling multiple sub-widgets from a widget.
            $twig->addGlobal('_widget', $widget);

            $template = $twig->load($widget::getTemplate());

            // TODO: red border / mouse hover on blocks to be able to easily identify them
            return $template->renderBlock($block);
        } catch (Throwable $e) {
            // TODO: use custom exception
            throw new Exception(sprintf(
                'Something went wrong in widget "%s": %s',
                $name,
                $e->getMessage()
            ), $e->getCode(), $e);
        }
    }

    /**
     * @param array $context
     * @param string $name
     *
     * @return bool
     */
    public function widgetExists(array $context, $name)
    {
        return $this->getWidgetContainer($context)->hasWidget($name);
    }

    /**
     * @param array $context
     *
     * @return \Spryker\Yves\Kernel\Widget\WidgetContainerInterface
     */
    protected function getWidgetContainer(array $context): WidgetContainerInterface
    {
        // TODO: consider merging these together to avoid cross referencing and confusion
        if (isset($context['_widget'])) {
            return $context['_widget'];
        }

        if (isset($context['_view'])) {
            return $context['_view'];
        }

        // TODO: use custom exception
        throw new \Exception('Missing widget container from the context of the rendered template. To fix this you need to provide the widget container in "_widget" variable.');
    }

}

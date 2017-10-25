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
use Spryker\Yves\Kernel\Widget\WidgetContainerInterface;
use Spryker\Yves\Kernel\Widget\WidgetContainerRegistry;
use Spryker\Yves\Kernel\Widget\WidgetFactory;
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
                'needs_context' => false,
                'is_safe' => ['html'],
            ]),
            new Twig_SimpleFunction('widgetBlock', [$this, 'widgetBlock'], [
                'needs_environment' => true,
                'needs_context' => false,
                'is_safe' => ['html'],
            ]),
            new Twig_SimpleFunction('widgetExists', [$this, 'widgetExists'], [
                'needs_context' => false,
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
     * @param string $name
     * @param array $arguments
     *
     * @throws \Exception
     *
     * @return string
     */
    public function widget(Twig_Environment $twig, $name, ...$arguments)
    {
        // TODO: refactor
        try {
            $widgetContainer = $this->getWidgetContainer();

            if (!$widgetContainer->hasWidget($name)) {
                return '';
            }

            $widgetClass = $widgetContainer->getWidgetClassName($name);
            $widgetFactory = new WidgetFactory();
            $widget = $widgetFactory->build($widgetClass, $arguments);

            $twig->addGlobal('_widget', $widget);

            $widgetContainerRegistry = new WidgetContainerRegistry($this->getApplication());
            $widgetContainerRegistry->add($widget);

            $template = $twig->load($widget::getTemplate());
            $result = $template->render();

            $widgetContainerRegistry->removeLastAdded();

            return $result;
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
     * @param string $name
     * @param string $block
     * @param array $arguments
     *
     * @throws \Exception
     *
     * @return string
     */
    public function widgetBlock(Twig_Environment $twig,  $name, $block, ...$arguments)
    {
        // TODO: refactor
        try {
            $view = $this->getWidgetContainer();

            if (!$view->hasWidget($name)) {
                return '';
            }

            $widgetClass = $view->getWidgetClassName($name);
            $widgetFactory = new WidgetFactory();
            $widget = $widgetFactory->build($widgetClass, $arguments);

            $twig->addGlobal('_widget', $widget);

            $widgetContainerRegistry = new WidgetContainerRegistry($this->getApplication());
            $widgetContainerRegistry->add($widget);

            $template = $twig->load($widget::getTemplate());
            $result = $template->renderBlock($block);

            $widgetContainerRegistry->removeLastAdded();

            return $result;
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
     * @param string $name
     *
     * @return bool
     */
    public function widgetExists($name)
    {
        return $this->getWidgetContainer()->hasWidget($name);
    }

    /**
     * @throws \Exception
     *
     * @return \Spryker\Yves\Kernel\Widget\WidgetContainerInterface
     */
    protected function getWidgetContainer(): WidgetContainerInterface
    {
        // TODO: move to factory
        $widgetRegistry = new WidgetContainerRegistry($this->getApplication());

        $widgetContainer = $widgetRegistry->getLastAdded();

        if (!$widgetContainer) {
            // TODO: use custom exception
            throw new Exception(sprintf(
                'You have tried to access a widget but %s is empty. To fix this you need to register your widget or view in the registry.',
                get_class($widgetRegistry)
            ));
        }

         return $widgetContainer;
    }
}

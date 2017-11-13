<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\Twig\Plugin\Provider\TwigServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Spryker\Shared\Application\ServiceProvider\FormFactoryServiceProvider;
use Spryker\Shared\Application\ServiceProvider\HeadersSecurityServiceProvider;
use Spryker\Shared\Application\ServiceProvider\RoutingServiceProvider;
use Spryker\Shared\Application\ServiceProvider\UrlGeneratorServiceProvider;
use Spryker\Yves\Application\ApplicationConfig;
use Spryker\Yves\Application\Plugin\Provider\CookieServiceProvider;
use Spryker\Yves\Application\Plugin\Provider\ExceptionServiceProvider;
use Spryker\Yves\Application\Plugin\Provider\YvesHstsServiceProvider;
use Spryker\Yves\Application\Plugin\ServiceProvider\KernelLogServiceProvider;
use Spryker\Yves\Application\Plugin\ServiceProvider\SslServiceProvider;
use Spryker\Yves\CmsContentWidget\Plugin\CmsContentWidgetServiceProvider;
use Spryker\Yves\Kernel\Application;
use Spryker\Yves\Messenger\Plugin\Provider\FlashMessengerServiceProvider;
use SprykerShop\Yves\MoneyWidget\Plugin\ServiceProvider\TwigMoneyServiceProvider;
use Spryker\Yves\Navigation\Plugin\Provider\NavigationTwigServiceProvider;
use Spryker\Yves\NewRelic\Plugin\ServiceProvider\NewRelicRequestTransactionServiceProvider;
use Spryker\Yves\ProductGroup\Plugin\Provider\ProductGroupTwigServiceProvider;
use Spryker\Yves\ProductLabel\Plugin\Provider\ProductLabelTwigServiceProvider;
use Spryker\Yves\ProductRelation\Plugin\ProductRelationTwigServiceProvider;
use Spryker\Yves\ProductReview\Plugin\Provider\ProductAbstractReviewTwigServiceProvider;
use Spryker\Yves\Session\Plugin\ServiceProvider\SessionServiceProvider as SprykerSessionServiceProvider;
use Spryker\Yves\Storage\Plugin\Provider\StorageCacheServiceProvider;
use Spryker\Yves\Twig\Plugin\ServiceProvider\TwigServiceProvider as SprykerTwigServiceProvider;
use Spryker\Yves\ZedRequest\Plugin\ServiceProvider\ZedRequestHeaderServiceProvider;
use Spryker\Yves\ZedRequest\Plugin\ServiceProvider\ZedRequestLogServiceProvider;
use SprykerShop\Yves\CalculationPage\Plugin\Provider\CalculationPageControllerProvider;
use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use SprykerShop\Yves\CartPage\Plugin\Provider\CartServiceProvider;
use SprykerShop\Yves\CatalogPage\Plugin\Provider\CatalogPageControllerProvider;
use SprykerShop\Yves\CatalogPage\Plugin\Provider\CatalogPageTwigServiceProvider;
use SprykerShop\Yves\CategoryWidget\Plugin\Provider\CategoryServiceProvider;
use SprykerShop\Yves\CheckoutPage\Plugin\Provider\CheckoutPageControllerProvider;
use SprykerShop\Yves\CmsPage\Plugin\Provider\PreviewControllerProvider;
use SprykerShop\Yves\CurrencyWidget\Plugin\CurrencySwitcherServiceProvider;
use SprykerShop\Yves\CurrencyWidget\Plugin\CurrencyWidgetControllerProvider;
use SprykerShop\Yves\CustomerPage\Plugin\Provider\CustomerPageControllerProvider;
use SprykerShop\Yves\CustomerPage\Plugin\Provider\CustomerSecurityServiceProvider;
use SprykerShop\Yves\DiscountWidget\Plugin\Provider\DiscountWidgetControllerProvider;
use SprykerShop\Yves\ErrorPage\Plugin\Provider\ErrorPageControllerProvider;
use SprykerShop\Yves\HeartbeatPage\Plugin\Provider\HeartbeatPageControllerProvider;
use SprykerShop\Yves\HomePage\Plugin\Provider\HomePageControllerProvider;
use SprykerShop\Yves\NewsletterWidget\Plugin\Provider\NewsletterWidgetControllerProvider;
use SprykerShop\Yves\ProductNewPage\Plugin\Provider\ProductNewPageControllerProvider;
use SprykerShop\Yves\ProductReviewWidget\Plugin\Provider\ProductReviewControllerProvider;
use SprykerShop\Yves\ProductSalePage\Plugin\Provider\ProductSaleControllerProvider;
use SprykerShop\Yves\ProductSetListPage\Plugin\Provider\ProductSetListPageControllerProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AutoloaderCacheServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\ShopApplicationServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\YvesSecurityServiceProvider;
use SprykerShop\Yves\ShopLayout\Plugin\Provider\LanguageServiceProvider;
use SprykerShop\Yves\ShopRouter\Plugin\Router\SilexRouter;
use SprykerShop\Yves\ShopRouter\Plugin\Router\StorageRouter;
use SprykerShop\Yves\ShopTranslator\Plugin\Provider\TranslationServiceProvider;
use SprykerShop\Yves\WebProfilerWidget\Plugin\ServiceProvider\WebProfilerWidgetServiceProvider;
use SprykerShop\Yves\WishlistPage\Plugin\Provider\WishlistPageControllerProvider;

class YvesBootstrap
{
    /**
     * @var \Spryker\Yves\Kernel\Application
     */
    protected $application;

    /**
     * @var \Spryker\Yves\Application\ApplicationConfig
     */
    protected $config;

    public function __construct()
    {
        $this->application = new Application();
        $this->config = new ApplicationConfig();
    }

    /**
     * @return \Spryker\Yves\Kernel\Application
     */
    public function boot()
    {
        $this->registerServiceProviders();
        $this->registerRouters();
        $this->registerControllerProviders();

        return $this->application;
    }

    /**
     * @return void
     */
    protected function registerServiceProviders()
    {
        $this->application->register(new SslServiceProvider());
        $this->application->register(new StorageCacheServiceProvider());
        $this->application->register(new SprykerTwigServiceProvider());
        $this->application->register(new KernelLogServiceProvider());
        $this->application->register(new ZedRequestHeaderServiceProvider());
        $this->application->register(new ZedRequestLogServiceProvider());

        $this->application->register(new TwigServiceProvider());
        $this->application->register(new ShopApplicationServiceProvider());
        $this->application->register(new SessionServiceProvider());
        $this->application->register(new SprykerSessionServiceProvider());
        $this->application->register(new SecurityServiceProvider());
        $this->application->register(new CustomerSecurityServiceProvider());
        $this->application->register(new YvesSecurityServiceProvider());
        $this->application->register(new ExceptionServiceProvider());
        $this->application->register(new NewRelicRequestTransactionServiceProvider());
        $this->application->register(new CookieServiceProvider());
        $this->application->register(new UrlGeneratorServiceProvider());
        $this->application->register(new ServiceControllerServiceProvider());
        $this->application->register(new RememberMeServiceProvider());
        $this->application->register(new RoutingServiceProvider());
        $this->application->register(new TranslationServiceProvider());
        $this->application->register(new ValidatorServiceProvider());
        $this->application->register(new FormServiceProvider());
        $this->application->register(new HttpFragmentServiceProvider());
        $this->application->register(new CategoryServiceProvider());
        $this->application->register(new FlashMessengerServiceProvider());
        $this->application->register(new HeadersSecurityServiceProvider());
        $this->application->register(new WebProfilerWidgetServiceProvider());
        $this->application->register(new AutoloaderCacheServiceProvider());
        $this->application->register(new YvesHstsServiceProvider());
        $this->application->register(new CartServiceProvider());
        $this->application->register(new FormFactoryServiceProvider());
        $this->application->register(new LanguageServiceProvider());
        $this->application->register(new TwigMoneyServiceProvider());
        $this->application->register(new ProductRelationTwigServiceProvider());
        $this->application->register(new NavigationTwigServiceProvider());
        $this->application->register(new ProductGroupTwigServiceProvider());
        $this->application->register(new ProductLabelTwigServiceProvider());
        $this->application->register(new CmsContentWidgetServiceProvider());
        $this->application->register(new CurrencySwitcherServiceProvider());
        $this->application->register(new ProductAbstractReviewTwigServiceProvider());
        $this->application->register(new CatalogPageTwigServiceProvider());
    }

    /**
     * @return void
     */
    protected function registerRouters()
    {
        $this->application->addRouter((new StorageRouter())->setSsl(false));
        $this->application->addRouter(new SilexRouter());
    }

    /**
     * @return void
     */
    protected function registerControllerProviders()
    {
        $isSsl = $this->config->isSslEnabled();

        $controllerProviders = $this->getControllerProviderStack($isSsl);

        foreach ($controllerProviders as $controllerProvider) {
            $this->application->mount($controllerProvider->getUrlPrefix(), $controllerProvider);
        }
    }

    /**
     * @param bool|null $isSsl
     *
     * @return \SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider[]
     */
    protected function getControllerProviderStack($isSsl)
    {
        return [
            new ErrorPageControllerProvider($isSsl),
            new HomePageControllerProvider($isSsl),
            new CheckoutPageControllerProvider($isSsl),
            new CustomerPageControllerProvider($isSsl),
            new CartControllerProvider($isSsl),
            new WishlistPageControllerProvider($isSsl),
            new HeartbeatPageControllerProvider($isSsl),
            new NewsletterWidgetControllerProvider($isSsl),
            new CatalogPageControllerProvider($isSsl),
            new CalculationPageControllerProvider($isSsl),
            new ProductSetListPageControllerProvider($isSsl),
            new ProductSaleControllerProvider($isSsl),
            new PreviewControllerProvider($isSsl),
            new CurrencyWidgetControllerProvider($isSsl),
            new ProductNewPageControllerProvider($isSsl),
            new ProductReviewControllerProvider($isSsl),
            new DiscountWidgetControllerProvider($isSsl),
        ];
    }
}

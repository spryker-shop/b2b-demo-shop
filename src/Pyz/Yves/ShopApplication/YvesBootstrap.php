<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\ExampleProductSalePage\Plugin\Provider\ExampleProductSaleControllerProvider;
use Pyz\Yves\MultiCartPage\Plugin\Provider\MultiCartPageControllerProvider;
use Pyz\Yves\PriceWidget\Plugin\Provider\TwigPriceModeFunctionServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Spryker\Shared\Application\ServiceProvider\FormFactoryServiceProvider;
use Spryker\Shared\Application\ServiceProvider\RoutingServiceProvider;
use Spryker\Shared\Application\ServiceProvider\UrlGeneratorServiceProvider;
use Spryker\Yves\Application\Plugin\Provider\CookieServiceProvider;
use Spryker\Yves\Application\Plugin\Provider\YvesHstsServiceProvider;
use Spryker\Yves\Application\Plugin\ServiceProvider\SslServiceProvider;
use Spryker\Yves\Messenger\Plugin\Provider\FlashMessengerServiceProvider;
use Spryker\Yves\Monitoring\Plugin\ServiceProvider\MonitoringRequestTransactionServiceProvider;
use Spryker\Yves\Session\Plugin\ServiceProvider\SessionServiceProvider as SprykerSessionServiceProvider;
use Spryker\Yves\Storage\Plugin\Provider\StorageCacheServiceProvider;
use Spryker\Yves\ZedRequest\Plugin\ServiceProvider\ZedRequestHeaderServiceProvider;
use SprykerShop\Yves\AgentPage\Plugin\Provider\AgentPageControllerProvider;
use SprykerShop\Yves\AgentPage\Plugin\Provider\AgentPageSecurityServiceProvider;
use SprykerShop\Yves\AgentWidget\Plugin\Provider\AgentWidgetControllerProvider;
use SprykerShop\Yves\AvailabilityNotificationPage\Plugin\Provider\AvailabilityNotificationPageControllerProvider;
use SprykerShop\Yves\AvailabilityNotificationWidget\Plugin\Provider\AvailabilityNotificationWidgetControllerProvider;
use SprykerShop\Yves\CalculationPage\Plugin\Provider\CalculationPageControllerProvider;
use SprykerShop\Yves\CartNoteWidget\Plugin\Provider\CartNoteWidgetControllerProvider;
use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use SprykerShop\Yves\CartToShoppingListWidget\Plugin\Provider\CartToShoppingListWidgetControllerProvider;
use SprykerShop\Yves\CatalogPage\Plugin\Provider\CatalogPageControllerProvider;
use SprykerShop\Yves\CheckoutPage\Plugin\Provider\CheckoutPageControllerProvider;
use SprykerShop\Yves\CmsPage\Plugin\Provider\PreviewControllerProvider;
use SprykerShop\Yves\CmsSearchPage\Plugin\Provider\CmsSearchPageControllerProvider;
use SprykerShop\Yves\CommentWidget\Plugin\Provider\CommentWidgetControllerProvider;
use SprykerShop\Yves\CompanyPage\Plugin\Provider\CompanyPageControllerProvider;
use SprykerShop\Yves\CompanyUserAgentWidget\Plugin\Provider\CompanyUserAgentWidgetControllerProvider;
use SprykerShop\Yves\CompanyUserInvitationPage\Plugin\Provider\CompanyUserInvitationPageControllerProvider;
use SprykerShop\Yves\ConfigurableBundleWidget\Plugin\Provider\ConfigurableBundleWidgetControllerProvider;
use SprykerShop\Yves\CurrencyWidget\Plugin\Provider\CurrencyWidgetControllerProvider;
use SprykerShop\Yves\CustomerPage\Plugin\Provider\CustomerPageControllerProvider;
use SprykerShop\Yves\CustomerPage\Plugin\Provider\CustomerSecurityServiceProvider;
use SprykerShop\Yves\CustomerReorderWidget\Plugin\Provider\CustomerReorderControllerProvider;
use SprykerShop\Yves\DiscountWidget\Plugin\Provider\DiscountWidgetControllerProvider;
use SprykerShop\Yves\ErrorPage\Plugin\Provider\ErrorPageControllerProvider;
use SprykerShop\Yves\ErrorPage\Plugin\Provider\ErrorPageServiceProvider;
use SprykerShop\Yves\FileManagerWidget\Plugin\Provider\FileManagerWidgetControllerProvider;
use SprykerShop\Yves\HeartbeatPage\Plugin\Provider\HeartbeatPageControllerProvider;
use SprykerShop\Yves\HomePage\Plugin\Provider\HomePageControllerProvider;
use SprykerShop\Yves\NewsletterPage\Plugin\Provider\NewsletterPageControllerProvider;
use SprykerShop\Yves\NewsletterWidget\Plugin\Provider\NewsletterWidgetControllerProvider;
use SprykerShop\Yves\PersistentCartSharePage\Plugin\Provider\PersistentCartSharePageControllerProvider;
use SprykerShop\Yves\PersistentCartShareWidget\Plugin\Provider\ShareCartByLinkWidgetControllerProvider;
use SprykerShop\Yves\PriceWidget\Plugin\Provider\PriceControllerProvider;
use SprykerShop\Yves\ProductNewPage\Plugin\Provider\ProductNewPageControllerProvider;
use SprykerShop\Yves\ProductReviewWidget\Plugin\Provider\ProductReviewControllerProvider;
use SprykerShop\Yves\ProductSearchWidget\Plugin\Provider\ProductSearchWidgetControllerProvider;
use SprykerShop\Yves\ProductSetListPage\Plugin\Provider\ProductSetListPageControllerProvider;
use SprykerShop\Yves\QuickOrderPage\Plugin\Provider\QuickOrderPageControllerProvider;
use SprykerShop\Yves\QuoteApprovalWidget\Plugin\Provider\QuoteApprovalControllerProvider;
use SprykerShop\Yves\QuoteRequestAgentPage\Plugin\Provider\QuoteRequestAgentPageControllerProvider;
use SprykerShop\Yves\QuoteRequestAgentWidget\Plugin\Provider\QuoteRequestAgentWidgetControllerProvider;
use SprykerShop\Yves\QuoteRequestPage\Plugin\Provider\QuoteRequestPageControllerProvider;
use SprykerShop\Yves\QuoteRequestWidget\Plugin\Provider\QuoteRequestWidgetControllerProvider;
use SprykerShop\Yves\ResourceSharePage\Plugin\Provider\ResourceSharePageControllerProvider;
use SprykerShop\Yves\SharedCartPage\Plugin\Provider\SharedCartPageControllerProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AutoloaderCacheServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\ShopControllerEventServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\YvesExceptionServiceProvider;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\YvesSecurityServiceProvider;
use SprykerShop\Yves\ShopApplication\YvesBootstrap as SprykerYvesBootstrap;
use SprykerShop\Yves\ShoppingListPage\Plugin\Provider\ShoppingListPageControllerProvider;
use SprykerShop\Yves\ShoppingListWidget\Plugin\Provider\ShoppingListWidgetControllerProvider;
use SprykerShop\Yves\ShopRouter\Plugin\Router\SilexRouter;
use SprykerShop\Yves\ShopRouter\Plugin\Router\StorageRouter;
use SprykerShop\Yves\ShopTranslator\Plugin\Provider\TranslationServiceProvider;
use SprykerShop\Yves\WebProfilerWidget\Plugin\ServiceProvider\WebProfilerWidgetServiceProvider;

class YvesBootstrap extends SprykerYvesBootstrap
{
    /**
     * @return void
     */
    protected function registerServiceProviders()
    {
        $this->application->register(new SslServiceProvider());
        $this->application->register(new StorageCacheServiceProvider());
        $this->application->register(new ZedRequestHeaderServiceProvider());
        $this->application->register(new ShopControllerEventServiceProvider());
        $this->application->register(new SessionServiceProvider());
        $this->application->register(new SprykerSessionServiceProvider());
        $this->application->register(new SecurityServiceProvider());
        $this->application->register(new CustomerSecurityServiceProvider());
        $this->application->register(new YvesSecurityServiceProvider());
        $this->application->register(new YvesExceptionServiceProvider());
        $this->application->register(new ErrorPageServiceProvider());
        $this->application->register(new MonitoringRequestTransactionServiceProvider());
        $this->application->register(new CookieServiceProvider());
        $this->application->register(new UrlGeneratorServiceProvider());
        $this->application->register(new RememberMeServiceProvider());
        $this->application->register(new RoutingServiceProvider());
        $this->application->register(new TranslationServiceProvider());
        $this->application->register(new ValidatorServiceProvider());
        $this->application->register(new FormServiceProvider());
        $this->application->register(new HttpFragmentServiceProvider());
        $this->application->register(new FlashMessengerServiceProvider());
        $this->application->register(new WebProfilerWidgetServiceProvider());
        $this->application->register(new AutoloaderCacheServiceProvider());
        $this->application->register(new YvesHstsServiceProvider());
        $this->application->register(new FormFactoryServiceProvider());
        $this->application->register(new TwigPriceModeFunctionServiceProvider());
        $this->application->register(new AgentPageSecurityServiceProvider()); # AgentFeature
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
            new CustomerReorderControllerProvider($isSsl),
            new NewsletterPageControllerProvider($isSsl),
            new CartControllerProvider($isSsl),
            new HeartbeatPageControllerProvider($isSsl),
            new NewsletterWidgetControllerProvider($isSsl),
            new CatalogPageControllerProvider($isSsl),
            new CalculationPageControllerProvider($isSsl),
            new ProductSetListPageControllerProvider($isSsl),
            new ExampleProductSaleControllerProvider($isSsl),
            new PreviewControllerProvider($isSsl),
            new CurrencyWidgetControllerProvider($isSsl),
            new ProductNewPageControllerProvider($isSsl),
            new ProductReviewControllerProvider($isSsl),
            new DiscountWidgetControllerProvider($isSsl),
            new PriceControllerProvider($isSsl),
            new CartNoteWidgetControllerProvider($isSsl), #CartNoteFeature
            new QuickOrderPageControllerProvider($isSsl),
            new CompanyPageControllerProvider($isSsl),
            new MultiCartPageControllerProvider($isSsl), #MultiCartFeature
            new SharedCartPageControllerProvider($isSsl), #SharedCartFeature
            new ShoppingListPageControllerProvider($isSsl), #ShoppingListFeature
            new CartToShoppingListWidgetControllerProvider($isSsl), #ShoppingListFeature
            new ShoppingListWidgetControllerProvider($isSsl), #ShoppingListFeature
            new CompanyUserInvitationPageControllerProvider($isSsl), #BulkImportCompanyUserInvitationsFeature
            new AgentPageControllerProvider($isSsl), #AgentFeature
            new AgentWidgetControllerProvider($isSsl), #AgentFeature
            new FileManagerWidgetControllerProvider($isSsl),
            new CmsSearchPageControllerProvider($isSsl),
            new ProductSearchWidgetControllerProvider($isSsl),
            new AvailabilityNotificationWidgetControllerProvider($isSsl),
            new AvailabilityNotificationPageControllerProvider($isSsl),
            new QuoteApprovalControllerProvider($isSsl), #QuoteApprovalFeature
            new QuoteRequestPageControllerProvider($isSsl),
            new QuoteRequestAgentPageControllerProvider($isSsl),
            new QuoteRequestAgentWidgetControllerProvider($isSsl),
            new QuoteRequestWidgetControllerProvider($isSsl),
            new CompanyUserAgentWidgetControllerProvider($isSsl),
            new PersistentCartSharePageControllerProvider($isSsl),
            new ResourceSharePageControllerProvider($isSsl),
            new ShareCartByLinkWidgetControllerProvider($isSsl),
            new CommentWidgetControllerProvider($isSsl),
            new ConfigurableBundleWidgetControllerProvider($isSsl),
        ];
    }
}

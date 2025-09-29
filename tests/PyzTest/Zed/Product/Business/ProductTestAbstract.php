<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\Product\Business;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\LocalizedAttributesTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\PriceTypeTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\ProductImageSetTransfer;
use Generated\Shared\Transfer\ProductImageTransfer;
use Generated\Shared\Transfer\StockProductTransfer;
use Generated\Shared\Transfer\StoreRelationTransfer;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Stock\Persistence\SpyStock;
use Orm\Zed\Tax\Persistence\SpyTaxRate;
use Orm\Zed\Tax\Persistence\SpyTaxSet;
use Orm\Zed\Tax\Persistence\SpyTaxSetTax;
use Spryker\Service\UtilText\UtilTextService;
use Spryker\Service\UtilText\UtilTextServiceInterface;
use Spryker\Zed\Currency\Business\CurrencyFacade;
use Spryker\Zed\Currency\Business\CurrencyFacadeInterface;
use Spryker\Zed\Locale\Business\LocaleFacade;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\PriceProduct\Business\PriceProductFacade;
use Spryker\Zed\PriceProduct\Business\PriceProductFacadeInterface;
use Spryker\Zed\PriceProduct\Persistence\PriceProductQueryContainer;
use Spryker\Zed\PriceProduct\Persistence\PriceProductQueryContainerInterface;
use Spryker\Zed\Product\Business\Product\ProductAbstractManagerInterface;
use Spryker\Zed\Product\Business\Product\ProductConcreteManagerInterface;
use Spryker\Zed\Product\Business\Product\ProductManager;
use Spryker\Zed\Product\Business\Product\ProductManagerInterface;
use Spryker\Zed\Product\Business\ProductBusinessFactory;
use Spryker\Zed\Product\Business\ProductFacade;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Spryker\Zed\Product\Dependency\Service\ProductToUtilEncodingInterface;
use Spryker\Zed\Product\Persistence\ProductQueryContainer;
use Spryker\Zed\Product\Persistence\ProductQueryContainerInterface;
use Spryker\Zed\ProductImage\Persistence\ProductImageQueryContainer;
use Spryker\Zed\ProductImage\Persistence\ProductImageQueryContainerInterface;
use Spryker\Zed\Store\Business\StoreFacade;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\Tax\Persistence\TaxQueryContainer;
use Spryker\Zed\Tax\Persistence\TaxQueryContainerInterface;
use Spryker\Zed\Touch\Business\TouchFacade;
use Spryker\Zed\Touch\Business\TouchFacadeInterface;
use Spryker\Zed\Touch\Persistence\TouchQueryContainer;
use Spryker\Zed\Touch\Persistence\TouchQueryContainerInterface;
use Spryker\Zed\Url\Business\UrlFacade;
use Spryker\Zed\Url\Business\UrlFacadeInterface;

abstract class ProductTestAbstract extends Unit
{
    public const PRODUCT_ABSTRACT_NAME = [
        'en_US' => 'Product name en_US',
        'de_DE' => 'Product name de_DE',
    ];

    public const PRODUCT_CONCRETE_NAME = [
        'en_US' => 'Product concrete name en_US',
        'de_DE' => 'Product concrete name de_DE',
    ];

    public const UPDATED_PRODUCT_ABSTRACT_NAME = [
        'en_US' => 'Updated Product name en_US',
        'de_DE' => 'Updated Product name de_DE',
    ];

    public const UPDATED_PRODUCT_CONCRETE_NAME = [
        'en_US' => 'Updated Product concrete name en_US',
        'de_DE' => 'Updated Product concrete name de_DE',
    ];

    public const ABSTRACT_SKU = 'foo';

    public const CONCRETE_SKU = 'foo-concrete';

    public const IMAGE_SET_NAME = 'Default';

    public const IMAGE_URL_LARGE = 'large';

    public const IMAGE_URL_SMALL = 'small';

    public const PRICE = 1234;

    public const STOCK_QUANTITY = 99;

    public const CURRENCY_ISO_CODE = 'EUR';

    /**
     * @var array<\Generated\Shared\Transfer\LocaleTransfer>
     */
    protected array $locales;

    protected ProductQueryContainerInterface $productQueryContainer;

    protected ProductImageQueryContainerInterface $productImageQueryContainer;

    protected PriceProductQueryContainerInterface $priceProductQueryContainer;

    protected TouchQueryContainerInterface $touchQueryContainer;

    protected TaxQueryContainerInterface $taxQueryContainer;

    protected ProductFacadeInterface $productFacade;

    protected PriceProductFacadeInterface $priceProductFacade;

    protected LocaleFacadeInterface $localeFacade;

    protected UrlFacadeInterface $urlFacade;

    protected UtilTextServiceInterface $utilTextService;

    protected TouchFacadeInterface $touchFacade;

    protected ProductManagerInterface $productManager;

    protected ProductAbstractManagerInterface $productAbstractManager;

    protected ProductConcreteManagerInterface $productConcreteManager;

    protected ProductAbstractTransfer $productAbstractTransfer;

    protected ProductConcreteTransfer $productConcreteTransfer;

    protected ProductToUtilEncodingInterface $utilEncodingService;

    protected CurrencyFacadeInterface $currencyFacade;

    protected StoreFacadeInterface $storeFacade;

    protected function setUp(): void
    {
        parent::setUp();

        $this->localeFacade = new LocaleFacade();
        $this->productFacade = new ProductFacade();
        $this->urlFacade = new UrlFacade();
        $this->priceProductFacade = new PriceProductFacade();
        $this->touchFacade = new TouchFacade();
        $this->utilTextService = new UtilTextService();
        $this->productQueryContainer = new ProductQueryContainer();
        $this->touchQueryContainer = new TouchQueryContainer();
        $this->priceProductQueryContainer = new PriceProductQueryContainer();
        $this->productImageQueryContainer = new ProductImageQueryContainer();
        $this->taxQueryContainer = new TaxQueryContainer();
        $this->utilEncodingService = $this->createMock(ProductToUtilEncodingInterface::class);
        $this->currencyFacade = new CurrencyFacade();
        $this->storeFacade = new StoreFacade();

        $this->setupLocales();
        $this->setupProductAbstract();
        $this->setupProductConcrete();
        $this->setupPluginImages();
        $this->setupPluginPrices();
        $this->setupAbstractPluginData();
        $this->setupConcretePluginData();

        $productBusinessFactory = new ProductBusinessFactory();

        $this->productConcreteManager = $productBusinessFactory->createProductConcreteManager();
        $this->productAbstractManager = $productBusinessFactory->createProductAbstractManager();

        $this->productManager = new ProductManager(
            $this->productAbstractManager,
            $this->productConcreteManager,
            $this->productQueryContainer,
        );
    }

    protected function setupLocales(): void
    {
        $this->locales['de_DE'] = new LocaleTransfer();
        $this->locales['de_DE']->setIdLocale(46)->setIsActive(true)->setLocaleName('de_DE');

        $this->locales['en_US'] = new LocaleTransfer();
        $this->locales['en_US']->setIdLocale(66)->setIsActive(true)->setLocaleName('en_US');
    }

    protected function setupProductAbstract(): void
    {
        $this->productAbstractTransfer = new ProductAbstractTransfer();
        $this->productAbstractTransfer->setSku(self::ABSTRACT_SKU);

        $localizedAttribute = new LocalizedAttributesTransfer();
        $localizedAttribute->setName(self::PRODUCT_ABSTRACT_NAME['de_DE'])->setLocale($this->locales['de_DE']);

        $this->productAbstractTransfer->addLocalizedAttributes($localizedAttribute);

        $localizedAttribute = new LocalizedAttributesTransfer();
        $localizedAttribute->setName(self::PRODUCT_ABSTRACT_NAME['en_US'])->setLocale($this->locales['en_US']);

        $this->productAbstractTransfer->addLocalizedAttributes($localizedAttribute);

        $this->productAbstractTransfer->setStoreRelation((new StoreRelationTransfer())->setIdStores([]));
    }

    protected function setupProductConcrete(): void
    {
        $this->productConcreteTransfer = new ProductConcreteTransfer();
        $this->productConcreteTransfer->setSku(self::CONCRETE_SKU);

        $localizedAttribute = new LocalizedAttributesTransfer();
        $localizedAttribute->setName(self::PRODUCT_CONCRETE_NAME['de_DE'])->setLocale($this->locales['de_DE']);

        $this->productConcreteTransfer->addLocalizedAttributes($localizedAttribute);

        $localizedAttribute = new LocalizedAttributesTransfer();
        $localizedAttribute->setName(self::PRODUCT_CONCRETE_NAME['en_US'])->setLocale($this->locales['en_US']);

        $this->productConcreteTransfer->addLocalizedAttributes($localizedAttribute);
    }

    protected function setupTaxes(): void
    {
        $taxSet = new SpyTaxSet();
        $taxSet->setName('DEFAULT');
        $taxSet->save();

        $taxSetRate = new SpyTaxRate();
        $taxSetRate->setFkCountry(60);
        $taxSetRate->setName('Test');

        $taxSetTaxTax = new SpyTaxSetTax();
        $taxSetTaxTax->setFkTaxRate($taxSetRate->getIdTaxRate());
        $taxSetTaxTax->setFkTaxSet($taxSet->getIdTaxSet());

        $this->productAbstractTransfer->setIdTaxSet($taxSet->getIdTaxSet());
    }

    protected function setupStocks(): void
    {
        $stockEntity = new SpyStock();
        $stockEntity->setName('TEST');
        $stockEntity->save();

        $stock = (new StockProductTransfer())
            ->setStockType($stockEntity->getName())
            ->setQuantity(self::STOCK_QUANTITY);

        $this->productConcreteTransfer->setStocks(new ArrayObject($stock));
    }

    protected function setupPluginImages(): void
    {
        $imageSetTransfer = (new ProductImageSetTransfer())
            ->setName(self::IMAGE_SET_NAME);

        $imageTransfer = (new ProductImageTransfer())
            ->setExternalUrlLarge(self::IMAGE_URL_LARGE)
            ->setExternalUrlSmall(self::IMAGE_URL_SMALL);

        $imageSetTransfer->setProductImages(
            new ArrayObject([$imageTransfer]),
        );

        $this->productAbstractTransfer->setImageSets(
            new ArrayObject([$imageSetTransfer]),
        );

        $this->productConcreteTransfer->setImageSets(
            new ArrayObject([$imageSetTransfer]),
        );
    }

    protected function setupPluginPrices(): void
    {
        $currencyTransfer = $this->currencyFacade->fromIsoCode(static::CURRENCY_ISO_CODE);
        $storeTransfer = $this->storeFacade->getCurrentStore();

        $moneyValueTransfer = (new MoneyValueTransfer())
            ->setGrossAmount(static::PRICE)
            ->setNetAmount(static::PRICE)
            ->setCurrency($currencyTransfer)
            ->setFkStore($storeTransfer->getIdStore())
            ->setFkCurrency($currencyTransfer->getIdCurrency());

        $priceTypeTransfer = new PriceTypeTransfer();
        $priceTypeTransfer->setName($this->priceProductFacade->getDefaultPriceTypeName());

        $priceProductTransfer = (new PriceProductTransfer())
            ->setSkuProductAbstract($this->productAbstractTransfer->getSku())
            ->setSkuProduct($this->productConcreteTransfer->getSku())
            ->setPriceType($priceTypeTransfer)
            ->setPriceTypeName($priceTypeTransfer->getName())
            ->setMoneyValue($moneyValueTransfer);

        $this->productAbstractTransfer->addPrice($priceProductTransfer);

        $priceProductTransfer2 = new PriceProductTransfer();
        $priceProductTransfer2->fromArray($priceProductTransfer->toArray(), true);

        $this->productConcreteTransfer->addPrice($priceProductTransfer2);
    }

    protected function setupAbstractPluginData(): void
    {
        $this->setupTaxes();
    }

    protected function setupConcretePluginData(): void
    {
        $this->setupStocks();
    }

    protected function setupDefaultProducts(): void
    {
        $this->productManager->addProduct($this->productAbstractTransfer, [$this->productConcreteTransfer]);
    }

    protected function getProductAbstractEntityById(int $idProductAbstract): SpyProductAbstract
    {
        return $this->productQueryContainer
            ->queryProductAbstract()
            ->filterByIdProductAbstract($idProductAbstract)
            ->findOne();
    }

    protected function getProductConcreteEntityByAbstractId(int $idProductAbstract): SpyProduct
    {
        return $this->productQueryContainer
            ->queryProduct()
            ->filterByFkProductAbstract($idProductAbstract)
            ->findOne();
    }
}

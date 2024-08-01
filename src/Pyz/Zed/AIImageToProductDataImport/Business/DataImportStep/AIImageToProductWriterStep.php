<?php

namespace Pyz\Zed\AIImageToProductDataImport\Business\DataImportStep;

use ArrayObject;
use Exception;
use Generated\Shared\Transfer\LocalizedAttributesTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\PriceTypeTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\StoreRelationTransfer;
use Pyz\Zed\AIImageToProductDataImport\Business\DataSet\AIImageToProductDataSetInterface;
use Spryker\Zed\Currency\Business\CurrencyFacade;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\Locale\Business\LocaleFacade;
use Spryker\Zed\Product\Business\ProductFacade;
use Spryker\Zed\Store\Business\StoreFacade;
use Spryker\Zed\Tax\Business\TaxFacade;

class AIImageToProductWriterStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        try {
            $productAbstractTransfer = new ProductAbstractTransfer();
            $productAbstractTransfer->setSku($dataSet[AIImageToProductDataSetInterface::COLUMN_SKU]);
            $productAbstractTransfer->setName("Import Test Product 2");
            $productAbstractTransfer->setIdTaxSet(
                $this->getTaxSetIdByName($dataSet[AIImageToProductDataSetInterface::COLUMN_TAX_SET])
            );
            $storeRelationTransfer = new StoreRelationTransfer();
            $storeFacade = new StoreFacade();
            $pricesTransfer = new ArrayObject();
            $priceTransfer = new PriceProductTransfer();
            $storeRelationTransfer->setIdStores([$storeFacade->getCurrentStore()->getIdStore()]);
            $productAbstractTransfer->setStoreRelation($storeRelationTransfer);
            $moneyValueTransfer = new MoneyValueTransfer();
            $moneyValueTransfer->setGrossAmount($dataSet[AIImageToProductDataSetInterface::COLUMN_PRICE]);
            $currencyFacade = new CurrencyFacade();
            $currencyCode = $currencyFacade->getCurrent()->getCode();
            $currencyTransfer = $currencyFacade->fromIsoCode($currencyCode);
            $moneyValueTransfer->setCurrency($currencyTransfer);
            $moneyValueTransfer->setFkCurrency($currencyTransfer->getIdCurrency());
            $moneyValueTransfer->setFkStore($storeFacade->getCurrentStore()->getIdStore());
            $priceTransfer->setMoneyValue($moneyValueTransfer);
            $priceTypeTransfer = new PriceTypeTransfer();
            $priceTransfer->setPriceType($priceTypeTransfer->setName('Default'));
            $pricesTransfer->append($priceTransfer);
            $productAbstractTransfer->setPrices($pricesTransfer);
            $localizedAttributes = new ArrayObject();
            $localizedAttributesTransfer = new LocalizedAttributesTransfer();
            $localeFacade = new LocaleFacade();
            $localizedAttributesTransfer->setLocale($localeFacade->getCurrentLocale());
            $localizedAttributesTransfer->setName("Import Test Product 2");
            $localizedAttributesTransfer->setDescription("Import Test Product 2");
            $localizedAttributes->append($localizedAttributesTransfer);
            $productAbstractTransfer->setLocalizedAttributes($localizedAttributes);
            $productFacade = new ProductFacade();
            $concreteProductCollection = $this->createProductConcreteCollection($productAbstractTransfer);
            $idAbstractProduct = $productFacade->addProduct(
                $productAbstractTransfer,
                $concreteProductCollection
            );
            $productConcreteTransferArray = $productFacade->getConcreteProductsByAbstractProductId($idAbstractProduct);
            $this->activateConcreteProduct($productConcreteTransferArray, $productFacade);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected function copyProductAbstractToProductConcrete(ProductAbstractTransfer $productAbstractTransfer): ProductConcreteTransfer
    {
        $productConcreteTransfer = (new ProductConcreteTransfer())
            ->setSku($productAbstractTransfer->getSku())
            ->setIsActive(false)
            ->setLocalizedAttributes($productAbstractTransfer->getLocalizedAttributes());
        foreach ($productAbstractTransfer->getPrices() as $price) {
            $productConcreteTransfer->addPrice(clone $price);
        }

        return $productConcreteTransfer;
    }

    /**
     * @return array<\Generated\Shared\Transfer\ProductConcreteTransfer>
     */
    protected function createProductConcreteCollection($productAbstractTransfer) 
    {
        $productFacade = new ProductFacade();
        $concreteProductCollection = $productFacade->generateVariants($productAbstractTransfer, []);
        if (!$concreteProductCollection) {
            $concreteProductCollection = $this->copyProductAbstractToProductConcrete($productAbstractTransfer);

            return [$concreteProductCollection];
        }

        return $concreteProductCollection;
    }

    /**
     * @return int
     */
    protected function getTaxSetIdByName(string $taxSetName)
    {
        $taxFacade = new TaxFacade();
        $taxSetCollection = $taxFacade->getTaxSets();
        $taxSetId = 0;
        foreach ($taxSetCollection->getTaxSets() as $taxSet) {
            if ($taxSet->getName() == $taxSetName) {
                $taxSetId = $taxSet->getIdTaxSet();
            }
        }

        return $taxSetId;
    }

    /**
     * @param array<\Generated\Shared\Transfer\ProductConcreteTransfer>
     * @param \Spryker\Zed\Product\Business\ProductFacade
     */
    protected function activateConcreteProduct($productConcreteTransferArray, ProductFacade $productFacade)
    {
        foreach ($productConcreteTransferArray as $productConcreteTransfer) {
            $productFacade->activateProductConcrete($productConcreteTransfer->getIdProductConcrete());
        }
    }
}

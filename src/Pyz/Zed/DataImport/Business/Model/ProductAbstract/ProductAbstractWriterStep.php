<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductAbstract;

use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Pyz\Zed\DataImport\Business\Model\Product\ProductLocalizedAttributesExtractorStep;
use Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepository;
use Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\Product\Dependency\ProductEvents;
use Spryker\Zed\ProductCategory\Dependency\ProductCategoryEvents;
use Spryker\Zed\Url\Dependency\UrlEvents;

class ProductAbstractWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public const BULK_SIZE = 100;

    public const KEY_ABSTRACT_SKU = 'abstract_sku';
    public const KEY_COLOR_CODE = 'color_code';
    public const KEY_ID_TAX_SET = 'idTaxSet';
    public const KEY_ATTRIBUTES = 'attributes';
    public const KEY_NAME = 'name';
    public const KEY_URL = 'url';
    public const KEY_DESCRIPTION = 'description';
    public const KEY_META_TITLE = 'meta_title';
    public const KEY_META_DESCRIPTION = 'meta_description';
    public const KEY_META_KEYWORDS = 'meta_keywords';
    public const KEY_TAX_SET_NAME = 'tax_set_name';
    public const KEY_CATEGORY_KEY = 'category_key';
    public const KEY_CATEGORY_KEYS = 'categoryKeys';
    public const KEY_CATEGORY_PRODUCT_ORDER = 'category_product_order';
    public const KEY_LOCALES = 'locales';
    public const KEY_NEW_FROM = 'new_from';
    public const KEY_NEW_TO = 'new_to';

    /**
     * @var \Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $productAbstractEntity = $this->importProductAbstract($dataSet);

        $this->productRepository->addProductAbstract($productAbstractEntity);

        $this->importProductAbstractLocalizedAttributes($dataSet, $productAbstractEntity);
        $this->importProductCategories($dataSet, $productAbstractEntity);
        $this->importProductUrls($dataSet, $productAbstractEntity);

        $this->addPublishEvents(ProductEvents::PRODUCT_ABSTRACT_PUBLISH, $productAbstractEntity->getIdProductAbstract());
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstract
     */
    protected function importProductAbstract(DataSetInterface $dataSet)
    {
        $productAbstractEntity = SpyProductAbstractQuery::create()
            ->filterBySku($dataSet[static::KEY_ABSTRACT_SKU])
            ->findOneOrCreate();

        $productAbstractEntity
            ->setPyzColorCode($dataSet[static::KEY_COLOR_CODE])
            ->setFkTaxSet($dataSet[static::KEY_ID_TAX_SET])
            ->setAttributes(json_encode($dataSet[static::KEY_ATTRIBUTES]))
            ->setNewFrom($dataSet[static::KEY_NEW_FROM])
            ->setNewTo($dataSet[static::KEY_NEW_TO]);

        if ($productAbstractEntity->isNew() || $productAbstractEntity->isModified()) {
            $productAbstractEntity->save();
        }

        return $productAbstractEntity;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return void
     */
    protected function importProductAbstractLocalizedAttributes(DataSetInterface $dataSet, SpyProductAbstract $productAbstractEntity)
    {
        foreach ($dataSet[ProductLocalizedAttributesExtractorStep::KEY_LOCALIZED_ATTRIBUTES] as $idLocale => $localizedAttributes) {
            $productAbstractLocalizedAttributesEntity = SpyProductAbstractLocalizedAttributesQuery::create()
                ->filterByFkProductAbstract($productAbstractEntity->getIdProductAbstract())
                ->filterByFkLocale($idLocale)
                ->findOneOrCreate();

            $productAbstractLocalizedAttributesEntity
                ->setName($localizedAttributes[static::KEY_NAME])
                ->setDescription($localizedAttributes[static::KEY_DESCRIPTION])
                ->setMetaTitle($localizedAttributes[static::KEY_META_TITLE])
                ->setMetaDescription($localizedAttributes[static::KEY_META_DESCRIPTION])
                ->setMetaKeywords($localizedAttributes[static::KEY_META_KEYWORDS])
                ->setAttributes(json_encode($localizedAttributes[static::KEY_ATTRIBUTES]));

            if ($productAbstractLocalizedAttributesEntity->isNew() || $productAbstractLocalizedAttributesEntity->isModified()) {
                $productAbstractLocalizedAttributesEntity->save();
            }
        }
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException
     *
     * @return void
     */
    protected function importProductCategories(DataSetInterface $dataSet, SpyProductAbstract $productAbstractEntity)
    {
        $categoryKeys = $this->getCategoryKeys($dataSet[static::KEY_CATEGORY_KEY]);
        $categoryProductOrder = $this->getCategoryProductOrder($dataSet[static::KEY_CATEGORY_PRODUCT_ORDER]);

        foreach ($categoryKeys as $index => $categoryKey) {
            if (!isset($dataSet[static::KEY_CATEGORY_KEYS][$categoryKey])) {
                throw new DataKeyNotFoundInDataSetException(sprintf(
                    'The category with key "%s" was not found in categoryKeys. Maybe there is a typo. Given Categories: "%s"',
                    $categoryKey,
                    implode('', array_values($dataSet[static::KEY_CATEGORY_KEYS]))
                ));
            }
            $productOrder = null;
            if (count($categoryProductOrder) > 0 && isset($categoryProductOrder[$index])) {
                $productOrder = $categoryProductOrder[$index];
            }

            $productCategoryEntity = SpyProductCategoryQuery::create()
                ->filterByFkProductAbstract($productAbstractEntity->getIdProductAbstract())
                ->filterByFkCategory($dataSet[static::KEY_CATEGORY_KEYS][$categoryKey])
                ->findOneOrCreate();

            $productCategoryEntity
                ->setProductOrder($productOrder);

            if ($productCategoryEntity->isNew() || $productCategoryEntity->isModified()) {
                $productCategoryEntity->save();

                $this->addPublishEvents(ProductCategoryEvents::PRODUCT_CATEGORY_PUBLISH, $productAbstractEntity->getIdProductAbstract());
                $this->addPublishEvents(ProductEvents::PRODUCT_ABSTRACT_PUBLISH, $productAbstractEntity->getIdProductAbstract());
            }
        }
    }

    /**
     * @param string $categoryKeys
     *
     * @return array
     */
    protected function getCategoryKeys($categoryKeys)
    {
        $categoryKeys = explode(',', $categoryKeys);

        return array_map('trim', $categoryKeys);
    }

    /**
     * @param string $categoryProductOrder
     *
     * @return array
     */
    protected function getCategoryProductOrder($categoryProductOrder)
    {
        $categoryProductOrder = explode(',', $categoryProductOrder);

        return array_map('trim', $categoryProductOrder);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return void
     */
    protected function importProductUrls(DataSetInterface $dataSet, SpyProductAbstract $productAbstractEntity)
    {
        foreach ($dataSet[ProductLocalizedAttributesExtractorStep::KEY_LOCALIZED_ATTRIBUTES] as $idLocale => $localizedAttributes) {
            $abstractProductUrl = $localizedAttributes[static::KEY_URL];

            $this->cleanupRedirectUrls($abstractProductUrl);

            $urlEntity = SpyUrlQuery::create()
                ->filterByFkLocale($idLocale)
                ->filterByFkResourceProductAbstract($productAbstractEntity->getIdProductAbstract())
                ->findOneOrCreate();

            $urlEntity->setUrl($abstractProductUrl);

            if ($urlEntity->isNew() || $urlEntity->isModified()) {
                $urlEntity->save();

                $this->addPublishEvents(UrlEvents::URL_PUBLISH, $urlEntity->getIdUrl());
            }
        }
    }

    /**
     * @param string $abstractProductUrl
     *
     * @return void
     */
    protected function cleanupRedirectUrls($abstractProductUrl)
    {
        SpyUrlQuery::create()
            ->filterByUrl($abstractProductUrl)
            ->filterByFkResourceRedirect(null, Criteria::ISNOTNULL)
            ->delete();
    }
}

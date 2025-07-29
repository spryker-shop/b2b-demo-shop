<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

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
    /**
     * @var int
     */
    public const BULK_SIZE = 100;

    /**
     * @var string
     */
    public const KEY_ABSTRACT_SKU = 'abstract_sku';

    /**
     * @var string
     */
    public const KEY_COLOR_CODE = 'color_code';

    /**
     * @var string
     */
    public const KEY_ID_TAX_SET = 'idTaxSet';

    /**
     * @var string
     */
    public const KEY_ATTRIBUTES = 'attributes';

    /**
     * @var string
     */
    public const KEY_NAME = 'name';

    /**
     * @var string
     */
    public const KEY_URL = 'url';

    /**
     * @var string
     */
    public const KEY_DESCRIPTION = 'description';

    /**
     * @var string
     */
    public const KEY_META_TITLE = 'meta_title';

    /**
     * @var string
     */
    public const KEY_META_DESCRIPTION = 'meta_description';

    /**
     * @var string
     */
    public const KEY_META_KEYWORDS = 'meta_keywords';

    /**
     * @var string
     */
    public const KEY_TAX_SET_NAME = 'tax_set_name';

    /**
     * @var string
     */
    public const KEY_CATEGORY_KEY = 'category_key';

    /**
     * @var string
     */
    public const KEY_CATEGORY_KEYS = 'categoryKeys';

    /**
     * @var string
     */
    public const KEY_CATEGORY_PRODUCT_ORDER = 'category_product_order';

    /**
     * @var string
     */
    public const KEY_LOCALES = 'locales';

    /**
     * @var string
     */
    public const KEY_NEW_FROM = 'new_from';

    /**
     * @var string
     */
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
    public function execute(DataSetInterface $dataSet): void
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
    protected function importProductAbstract(DataSetInterface $dataSet): SpyProductAbstract
    {
        $productAbstractEntity = SpyProductAbstractQuery::create()
            ->filterBySku($dataSet[static::KEY_ABSTRACT_SKU])
            ->findOneOrCreate();

        $productAbstractEntity
            ->setColorCode($dataSet[static::KEY_COLOR_CODE])
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
    protected function importProductAbstractLocalizedAttributes(DataSetInterface $dataSet, SpyProductAbstract $productAbstractEntity): void
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

            if (!$productAbstractLocalizedAttributesEntity->isNew() && !$productAbstractLocalizedAttributesEntity->isModified()) {
                continue;
            }

            $productAbstractLocalizedAttributesEntity->save();
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
    protected function importProductCategories(DataSetInterface $dataSet, SpyProductAbstract $productAbstractEntity): void
    {
        $categoryKeys = $this->getCategoryKeys($dataSet[static::KEY_CATEGORY_KEY]);
        $categoryProductOrder = $this->getCategoryProductOrder($dataSet[static::KEY_CATEGORY_PRODUCT_ORDER]);

        foreach ($categoryKeys as $index => $categoryKey) {
            if (!isset($dataSet[static::KEY_CATEGORY_KEYS][$categoryKey])) {
                throw new DataKeyNotFoundInDataSetException(sprintf(
                    'The category with key "%s" was not found in categoryKeys. Maybe there is a typo. Given Categories: "%s"',
                    $categoryKey,
                    implode('', array_values($dataSet[static::KEY_CATEGORY_KEYS])),
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

            if (!$productCategoryEntity->isNew() && !$productCategoryEntity->isModified()) {
                continue;
            }

            $productCategoryEntity->save();

            $this->addPublishEvents(ProductCategoryEvents::PRODUCT_CATEGORY_PUBLISH, $productAbstractEntity->getIdProductAbstract());
            $this->addPublishEvents(ProductEvents::PRODUCT_ABSTRACT_PUBLISH, $productAbstractEntity->getIdProductAbstract());
        }
    }

    /**
     * @param string $categoryKeys
     *
     * @return array<string>
     */
    protected function getCategoryKeys(string $categoryKeys): array
    {
        $categoryKeys = explode(',', $categoryKeys);

        return array_map('trim', $categoryKeys);
    }

    /**
     * @param string $categoryProductOrder
     *
     * @return array<int>
     */
    protected function getCategoryProductOrder(string $categoryProductOrder): array
    {
        $categoryProductOrder = explode(',', $categoryProductOrder);
        $categoryProductOrder = array_map('trim', $categoryProductOrder);

        return array_map('intval', $categoryProductOrder);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return void
     */
    protected function importProductUrls(DataSetInterface $dataSet, SpyProductAbstract $productAbstractEntity): void
    {
        foreach ($dataSet[ProductLocalizedAttributesExtractorStep::KEY_LOCALIZED_ATTRIBUTES] as $idLocale => $localizedAttributes) {
            $abstractProductUrl = $localizedAttributes[static::KEY_URL];

            $this->cleanupRedirectUrls($abstractProductUrl);

            $urlEntity = SpyUrlQuery::create()
                ->filterByFkLocale($idLocale)
                ->filterByFkResourceProductAbstract($productAbstractEntity->getIdProductAbstract())
                ->findOneOrCreate();

            $urlEntity->setUrl($abstractProductUrl);

            if (!$urlEntity->isNew() && !$urlEntity->isModified()) {
                continue;
            }

            $urlEntity->save();

            $this->addPublishEvents(UrlEvents::URL_PUBLISH, $urlEntity->getIdUrl());
        }
    }

    /**
     * @param string $abstractProductUrl
     *
     * @return void
     */
    protected function cleanupRedirectUrls(string $abstractProductUrl): void
    {
        SpyUrlQuery::create()
            ->filterByUrl($abstractProductUrl)
            ->filterByFkResourceRedirect(null, Criteria::ISNOTNULL)
            ->delete();
    }
}

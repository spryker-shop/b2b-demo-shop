<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\ProductSet;

use Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImage;
use Orm\Zed\ProductImage\Persistence\SpyProductImageQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery;
use Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery;
use Orm\Zed\ProductSet\Persistence\SpyProductSet;
use Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery;
use Orm\Zed\ProductSet\Persistence\SpyProductSetQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepositoryInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\LocalizedAttributesExtractorStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\Product\Dependency\ProductEvents;
use Spryker\Zed\ProductSet\Dependency\ProductSetEvents;
use Spryker\Zed\Url\Dependency\UrlEvents;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ProductSetWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public const BULK_SIZE = 100;

    public const KEY_PRODUCT_SET_KEY = 'product_set_key';

    public const KEY_NAME = 'name';

    public const KEY_DESCRIPTION = 'description';

    public const KEY_META_TITLE = 'meta_title';

    public const KEY_META_DESCRIPTION = 'meta_description';

    public const KEY_META_KEYWORDS = 'meta_keywords';

    public const KEY_URL = 'url';

    public const KEY_IS_ACTIVE = 'is_active';

    public const KEY_WEIGHT = 'weight';

    public const KEY_ABSTRACT_SKUS = 'abstract_skus';

    public const KEY_IMAGE_SET = 'image_set';

    public const KEY_IMAGES = 'images';

    public const KEY_IMAGE_LARGE = 'image_large';

    protected const KEY_ALT_TEXT_SMALL = 'alt_text_small';

    protected const KEY_ALT_TEXT_LARGE = 'alt_text_large';

    protected const GLOSSARY_KEY_PREFIX = 'product_image';

    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(DataSetInterface $dataSet): void
    {
        $productSetEntity = $this->findOrCreateProductSet($dataSet);

        $this->findOrCreateProductAbstractSet($dataSet, $productSetEntity);
        $this->findOrCreateProductSetData($dataSet, $productSetEntity);
        $this->findOrCreateProductImageSet($dataSet, $productSetEntity);
    }

    protected function findOrCreateProductSet(DataSetInterface $dataSet): SpyProductSet
    {
        $productSetEntity = SpyProductSetQuery::create()
            ->filterByProductSetKey($dataSet[static::KEY_PRODUCT_SET_KEY])
            ->findOneOrCreate();

        $productSetEntity
            ->setIsActive($dataSet[static::KEY_IS_ACTIVE])
            ->setWeight($dataSet[static::KEY_WEIGHT]);

        if ($productSetEntity->isNew() || $productSetEntity->isModified()) {
            $productSetEntity->save();
            $this->addPublishEvents(ProductSetEvents::PRODUCT_SET_PUBLISH, $productSetEntity->getIdProductSet());
        }

        return $productSetEntity;
    }

    protected function findOrCreateProductAbstractSet(DataSetInterface $dataSet, SpyProductSet $productSetEntity): void
    {
        $productAbstractSkus = explode(',', $dataSet[static::KEY_ABSTRACT_SKUS]);
        $productAbstractSkus = array_map('trim', $productAbstractSkus);

        $position = 0;

        foreach ($productAbstractSkus as $productAbstractSku) {
            $idProductAbstract = $this->productRepository->getIdProductAbstractByAbstractSku($productAbstractSku);

            $productAbstractSetEntity = SpyProductAbstractSetQuery::create()
                ->filterByFkProductSet($productSetEntity->getIdProductSet())
                ->filterByFkProductAbstract($idProductAbstract)
                ->findOneOrCreate();

            $position++;
            $productAbstractSetEntity->setPosition($position);

            if ($productAbstractSetEntity->isNew() || $productAbstractSetEntity->isModified()) {
                $productAbstractSetEntity->save();
            }

            $this->addPublishEvents(ProductEvents::PRODUCT_ABSTRACT_PUBLISH, $idProductAbstract);
        }
    }

    protected function findOrCreateProductSetData(DataSetInterface $dataSet, SpyProductSet $productSetEntity): void
    {
        foreach ($dataSet[LocalizedAttributesExtractorStep::KEY_LOCALIZED_ATTRIBUTES] as $idLocale => $localizedAttributes) {
            if ($localizedAttributes === []) {
                continue;
            }
            $productSetDataEntity = SpyProductSetDataQuery::create()
                ->filterByFkProductSet($productSetEntity->getIdProductSet())
                ->filterByFkLocale($idLocale)
                ->findOneOrCreate();

            $productSetDataEntity
                ->setName($localizedAttributes[static::KEY_NAME])
                ->setDescription($localizedAttributes[static::KEY_DESCRIPTION])
                ->setMetaTitle($localizedAttributes[static::KEY_META_TITLE])
                ->setMetaDescription($localizedAttributes[static::KEY_META_DESCRIPTION])
                ->setMetaKeywords($localizedAttributes[static::KEY_META_KEYWORDS]);

            if ($productSetDataEntity->isNew() || $productSetDataEntity->isModified()) {
                $productSetDataEntity->save();
            }

            $productSetUrlEntity = SpyUrlQuery::create()
                ->filterByFkResourceProductSet($productSetEntity->getIdProductSet())
                ->filterByFkLocale($idLocale)
                ->findOneOrCreate();

            $productSetUrlEntity->setUrl($localizedAttributes[static::KEY_URL]);

            if (!$productSetUrlEntity->isNew() && !$productSetUrlEntity->isModified()) {
                continue;
            }

            $productSetUrlEntity->save();
            $this->addPublishEvents(UrlEvents::URL_PUBLISH, $productSetUrlEntity->getIdUrl());
        }
    }

    protected function findOrCreateProductImageSet(DataSetInterface $dataSet, SpyProductSet $productSetEntity): void
    {
        foreach ($dataSet[ProductSetImageExtractorStep::KEY_TARGET] as $imageSetIndex => $imageSet) {
            $productImageSetEntity = SpyProductImageSetQuery::create()
                ->filterByFkResourceProductSet($productSetEntity->getIdProductSet())
                ->filterByName($imageSet[static::KEY_IMAGE_SET])
                ->findOneOrCreate();

            if ($productImageSetEntity->isNew() || $productImageSetEntity->isModified()) {
                $productImageSetEntity->save();
            }

            foreach ($imageSet[static::KEY_IMAGES] as $imageIndex => $image) {
                $productImageEntity = SpyProductImageQuery::create()
                    ->filterByExternalUrlLarge($image[static::KEY_IMAGE_LARGE])
                    ->findOneOrCreate();

                $productImageEntity->setExternalUrlSmall($image[static::KEY_IMAGE_LARGE]);

                if ($productImageEntity->isNew() || $productImageEntity->isModified()) {
                    $productImageEntity->save();
                }

                $productImageEntity = $this->saveProductImageAltTextGlossaryKeys($productImageEntity);
                $this->createOrUpdateProductImageAltTexts(
                    $dataSet,
                    $productImageEntity,
                    ProductSetImageExtractorStep::IMAGE_ALT_TEXT_KEY_PREFIX . ProductSetImageExtractorStep::IMAGE_SMALL_KEY_PREFIX . $imageSetIndex . '.' . $imageIndex,
                    ProductSetImageExtractorStep::IMAGE_ALT_TEXT_KEY_PREFIX . ProductSetImageExtractorStep::IMAGE_LARGE_KEY_PREFIX . $imageSetIndex . '.' . $imageIndex,
                );
                $productImageSetToProductImageEntity = SpyProductImageSetToProductImageQuery::create()
                    ->filterByFkProductImage($productImageEntity->getIdProductImage())
                    ->filterByFkProductImageSet($productImageSetEntity->getIdProductImageSet())
                    ->findOneOrCreate();

                $productImageSetToProductImageEntity->setSortOrder(0);

                if (!$productImageSetToProductImageEntity->isNew() && !$productImageSetToProductImageEntity->isModified()) {
                    continue;
                }

                $productImageSetToProductImageEntity->save();
            }
        }
    }

    protected function createOrUpdateProductImageAltTexts(
        DataSetInterface $dataSet,
        SpyProductImage $productImageEntity,
        string $keyAltTextSmall,
        string $keyAltTextLarge,
    ): void {
        if (!$productImageEntity->getAltTextLarge() || !$productImageEntity->getAltTextSmall()) {
            $productImageEntity = $this->saveProductImageAltTextGlossaryKeys($productImageEntity);
        }

        foreach ($dataSet[ProductSetImageLocalizedAttributesExtractorStep::KEY_IMAGE_ALT_TEXT_LOCALIZED_ATTRIBUTES] as $idLocale => $localizedAttributes) {
            $this->createOrUpdateGlossaryKey(
                $productImageEntity->getAltTextSmall(),
                $idLocale,
                $localizedAttributes[$keyAltTextSmall],
            );
            $this->createOrUpdateGlossaryKey(
                $productImageEntity->getAltTextLarge(),
                $idLocale,
                $localizedAttributes[$keyAltTextLarge],
            );
        }
    }

    protected function saveProductImageAltTextGlossaryKeys(SpyProductImage $productImageEntity): SpyProductImage
    {
        $altTextLargeGlossaryKey = sprintf(
            '%s.%s.%s',
            static::GLOSSARY_KEY_PREFIX,
            $productImageEntity->getIdProductImage(),
            static::KEY_ALT_TEXT_LARGE,
        );
        $altTextSmallGlossaryKey = sprintf(
            '%s.%s.%s',
            static::GLOSSARY_KEY_PREFIX,
            $productImageEntity->getIdProductImage(),
            static::KEY_ALT_TEXT_SMALL,
        );
        $productImageEntity->setAltTextLarge($altTextLargeGlossaryKey)
            ->setAltTextSmall($altTextSmallGlossaryKey)
            ->save();

        return $productImageEntity;
    }

    protected function createOrUpdateGlossaryKey(
        string $glossaryKey,
        int $idLocale,
        string $value,
    ): void {
        if (!$value) {
            return;
        }

        $glossaryKeyEntity = SpyGlossaryKeyQuery::create()
            ->filterByKey($glossaryKey)
            ->findOneOrCreate();
        $glossaryKeyEntity->save();
        $glossaryTranslationEntity = SpyGlossaryTranslationQuery::create()
            ->filterByGlossaryKey($glossaryKeyEntity)
            ->filterByFkLocale($idLocale)
            ->findOneOrCreate();
        $glossaryTranslationEntity->setValue($value);

        if (!$glossaryTranslationEntity->isNew() && !$glossaryTranslationEntity->isModified()) {
            return;
        }

        $glossaryTranslationEntity->save();
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductOption;

use Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\ProductOption\Persistence\Base\SpyProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValueQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Pyz\Zed\DataImport\Business\Model\Product\ProductLocalizedAttributesExtractorStep;
use Pyz\Zed\DataImport\Business\Model\Tax\TaxSetNameToIdTaxSetStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\Glossary\Dependency\GlossaryEvents;
use Spryker\Zed\ProductOption\Dependency\ProductOptionEvents;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ProductOptionWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @var int
     */
    public const BULK_SIZE = 100;

    /**
     * @var string
     */
    public const KEY_ABSTRACT_PRODUCT_SKUS = 'abstract_product_skus';

    /**
     * @var string
     */
    public const KEY_GROUP_NAME_TRANSLATION_KEY = 'group_name_translation_key';

    /**
     * @var string
     */
    public const KEY_IS_ACTIVE = 'is_active';

    /**
     * @var string
     */
    public const KEY_SKU = 'sku';

    /**
     * @var string
     */
    public const KEY_OPTION_NAME_TRANSLATION_KEY = 'option_name_translation_key';

    /**
     * @var string
     */
    public const KEY_OPTION_NAME = 'option_name';

    /**
     * @var string
     */
    public const KEY_GROUP_NAME = 'group_name';

    /**
     * @var string
     */
    public const KEY_TAX_SET_NAME = 'tax_set_name';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $productOptionGroupEntity = SpyProductOptionGroupQuery::create()
            ->filterByName($dataSet[self::KEY_GROUP_NAME_TRANSLATION_KEY])
            ->findOneOrCreate();

        $productOptionGroupEntity
            ->setActive($this->isActive($dataSet, $productOptionGroupEntity))
            ->setFkTaxSet($dataSet[TaxSetNameToIdTaxSetStep::KEY_TARGET])
            ->save();

        $productOptionValueEntity = SpyProductOptionValueQuery::create()
            ->filterBySku($dataSet[self::KEY_SKU])
            ->filterByFkProductOptionGroup($productOptionGroupEntity->getIdProductOptionGroup())
            ->findOneOrCreate();

        $productOptionValueEntity
            ->setValue($dataSet[self::KEY_OPTION_NAME_TRANSLATION_KEY])
            ->save();

        if (!empty($dataSet[static::KEY_ABSTRACT_PRODUCT_SKUS])) {
            $abstractProductSkuCollection = explode(',', $dataSet[static::KEY_ABSTRACT_PRODUCT_SKUS]);

            /** @var array<int> $abstractProductIdCollection */
            $abstractProductIdCollection = SpyProductAbstractQuery::create()
                ->select([SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT])
                ->filterBySku($abstractProductSkuCollection, Criteria::IN)
                ->find();

            foreach ($abstractProductIdCollection as $idProductAbstract) {
                SpyProductAbstractProductOptionGroupQuery::create()
                    ->filterByFkProductOptionGroup($productOptionGroupEntity->getIdProductOptionGroup())
                    ->filterByFkProductAbstract($idProductAbstract)
                    ->findOneOrCreate()
                    ->save();

                $this->addPublishEvents(ProductOptionEvents::PRODUCT_ABSTRACT_PRODUCT_OPTION_PUBLISH, $idProductAbstract);
            }
        }

        foreach ($dataSet[ProductLocalizedAttributesExtractorStep::KEY_LOCALIZED_ATTRIBUTES] as $idLocale => $attributes) {
            if (!isset($attributes[static::KEY_OPTION_NAME])) {
                continue;
            }
            $this->findOrCreateTranslation($dataSet[static::KEY_OPTION_NAME_TRANSLATION_KEY], $attributes[static::KEY_OPTION_NAME], $idLocale);
            $this->findOrCreateTranslation($dataSet[static::KEY_GROUP_NAME_TRANSLATION_KEY], $attributes[static::KEY_GROUP_NAME], $idLocale);
        }
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Orm\Zed\ProductOption\Persistence\Base\SpyProductOptionGroup $productOptionGroupEntity
     *
     * @return bool
     */
    protected function isActive(DataSetInterface $dataSet, SpyProductOptionGroup $productOptionGroupEntity): bool
    {
        if (isset($dataSet[self::KEY_IS_ACTIVE])) {
            return isset($dataSet[self::KEY_IS_ACTIVE]);
        }

        return ($productOptionGroupEntity->getActive() !== null) ? $productOptionGroupEntity->getActive() : true;
    }

    /**
     * @param string $key
     * @param string $translation
     * @param int $idLocale
     *
     * @return void
     */
    protected function findOrCreateTranslation($key, $translation, $idLocale): void
    {
        $glossaryKeyEntity = SpyGlossaryKeyQuery::create()
            ->filterByKey($key)
            ->findOneOrCreate();

        $glossaryKeyEntity->save();

        $glossaryTranslationEntity = SpyGlossaryTranslationQuery::create()
            ->filterByFkLocale($idLocale)
            ->filterByFkGlossaryKey($glossaryKeyEntity->getIdGlossaryKey())
            ->findOneOrCreate();

        $glossaryTranslationEntity
            ->setValue($translation)
            ->save();

        $this->addPublishEvents(GlossaryEvents::GLOSSARY_KEY_PUBLISH, $glossaryTranslationEntity->getFkGlossaryKey());
    }
}

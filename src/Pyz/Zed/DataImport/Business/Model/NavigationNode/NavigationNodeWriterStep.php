<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\NavigationNode;

use Orm\Zed\Navigation\Persistence\SpyNavigationNode;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Pyz\Zed\DataImport\Business\Exception\NavigationNodeByKeyNotFoundException;
use Pyz\Zed\DataImport\Business\Model\Navigation\NavigationKeyToIdNavigationStep;
use Pyz\Zed\DataImport\Business\Model\Product\ProductLocalizedAttributesExtractorStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\Navigation\Dependency\NavigationEvents;

class NavigationNodeWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @var int
     */
    public const BULK_SIZE = 100;

    /**
     * @var bool
     */
    public const DEFAULT_IS_ACTIVE = true;

    /**
     * @var string
     */
    public const KEY_NAVIGATION_KEY = 'navigation_key';

    /**
     * @var string
     */
    public const KEY_NODE_KEY = 'node_key';

    /**
     * @var string
     */
    public const KEY_PARENT_NODE_KEY = 'parent_node_key';

    /**
     * @var string
     */
    public const KEY_POSITION = 'position';

    /**
     * @var string
     */
    public const KEY_NODE_TYPE = 'node_type';

    /**
     * @var string
     */
    public const KEY_TITLE = 'title';

    /**
     * @var string
     */
    public const KEY_URL = 'url';

    /**
     * @var string
     */
    public const KEY_IS_ACTIVE = 'is_active';

    /**
     * @var string
     */
    public const KEY_CSS_CLASS = 'css_class';

    /**
     * @var string
     */
    public const KEY_VALID_FROM = 'valid_from';

    /**
     * @var string
     */
    public const KEY_VALID_TO = 'valid_to';

    /**
     * @var string
     */
    public const NODE_TYPE_LINK = 'link';

    /**
     * @var string
     */
    public const NODE_TYPE_EXTERNAL_URL = 'external_url';

    /**
     * @var string
     */
    public const NODE_TYPE_CATEGORY = 'category';

    /**
     * @var string
     */
    public const NODE_TYPE_CMS_PAGE = 'cms_page';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $navigationNodeEntity = SpyNavigationNodeQuery::create()
            ->filterByFkNavigation($dataSet[NavigationKeyToIdNavigationStep::KEY_TARGET])
            ->filterByNodeKey($dataSet[static::KEY_NODE_KEY])
            ->findOneOrCreate();

        $navigationNodeEntity
            ->setPosition($this->getPosition($navigationNodeEntity, $dataSet))
            ->setIsActive($this->isActive($navigationNodeEntity, $dataSet))
            ->setNodeType($this->getNodeType($navigationNodeEntity, $dataSet));

        if ($dataSet[static::KEY_VALID_FROM] !== '') {
            $navigationNodeEntity->setValidFrom($dataSet[static::KEY_VALID_FROM]);
        }

        if ($dataSet[static::KEY_VALID_TO] !== '') {
            $navigationNodeEntity->setValidTo($dataSet[static::KEY_VALID_TO]);
        }

        if (!empty($dataSet[static::KEY_PARENT_NODE_KEY])) {
            $navigationNodeEntity->setFkParentNavigationNode(
                $this->getFkParentNavigationNode($dataSet[static::KEY_PARENT_NODE_KEY]),
            );
        }

        foreach ($dataSet[ProductLocalizedAttributesExtractorStep::KEY_LOCALIZED_ATTRIBUTES] as $idLocale => $localizedAttributes) {
            if ($localizedAttributes === []) {
                continue;
            }
            $navigationNodeLocalizedAttributesEntity = SpyNavigationNodeLocalizedAttributesQuery::create()
                ->filterByFkNavigationNode($navigationNodeEntity->getIdNavigationNode())
                ->filterByFkLocale($idLocale)
                ->findOneOrCreate();

            $navigationNodeLocalizedAttributesEntity->setTitle($this->getTitle($navigationNodeLocalizedAttributesEntity, $localizedAttributes));

            if ($navigationNodeEntity->getNodeType() === static::NODE_TYPE_LINK) {
                $navigationNodeLocalizedAttributesEntity->setLink($this->getLink($navigationNodeLocalizedAttributesEntity, $localizedAttributes));
            }

            if ($navigationNodeEntity->getNodeType() === static::NODE_TYPE_EXTERNAL_URL) {
                $navigationNodeLocalizedAttributesEntity->setExternalUrl($this->getExternalUrl($navigationNodeLocalizedAttributesEntity, $localizedAttributes));
            }

            if ($navigationNodeEntity->getNodeType() === static::NODE_TYPE_CATEGORY || $navigationNodeEntity->getNodeType() === static::NODE_TYPE_CMS_PAGE) {
                $navigationNodeLocalizedAttributesEntity->setFkUrl($this->getFkUrl($navigationNodeLocalizedAttributesEntity, $localizedAttributes, $idLocale));
            }

            $navigationNodeLocalizedAttributesEntity->setCssClass($this->getCssClass($navigationNodeLocalizedAttributesEntity, $localizedAttributes));

            $navigationNodeEntity->addSpyNavigationNodeLocalizedAttributes($navigationNodeLocalizedAttributesEntity);
        }

        $navigationNodeEntity->save();

        $this->addPublishEvents(NavigationEvents::NAVIGATION_KEY_PUBLISH, $navigationNodeEntity->getFkNavigation());
    }

    /**
     * @param string $nodeKey
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\NavigationNodeByKeyNotFoundException
     *
     * @return int
     */
    protected function getFkParentNavigationNode($nodeKey): int
    {
        $parentNavigationNodeEntity = SpyNavigationNodeQuery::create()
            ->findOneByNodeKey($nodeKey);

        if (!$parentNavigationNodeEntity) {
            throw new NavigationNodeByKeyNotFoundException(sprintf(
                'NavigationNode with key "%s" not found',
                $nodeKey,
            ));
        }

        return $parentNavigationNodeEntity->getIdNavigationNode();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNode $navigationNodeEntity
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return int|null
     */
    protected function getPosition(SpyNavigationNode $navigationNodeEntity, DataSetInterface $dataSet): ?int
    {
        if (isset($dataSet[static::KEY_POSITION]) && !empty($dataSet[static::KEY_POSITION])) {
            return (int)$dataSet[static::KEY_POSITION];
        }

        return $navigationNodeEntity->getPosition();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNode $navigationNodeEntity
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return bool
     */
    protected function isActive(SpyNavigationNode $navigationNodeEntity, DataSetInterface $dataSet): bool
    {
        if (isset($dataSet[static::KEY_IS_ACTIVE]) && !empty($dataSet[static::KEY_IS_ACTIVE])) {
            return (bool)$dataSet[static::KEY_IS_ACTIVE];
        }

        return $navigationNodeEntity->getIsActive();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNode $navigationNodeEntity
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return string|null
     */
    protected function getNodeType(SpyNavigationNode $navigationNodeEntity, DataSetInterface $dataSet): ?string
    {
        if (isset($dataSet[static::KEY_NODE_TYPE]) && !empty($dataSet[static::KEY_NODE_TYPE])) {
            return $dataSet[static::KEY_NODE_TYPE];
        }

        return $navigationNodeEntity->getNodeType();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes
     * @param array $localizedAttributes
     *
     * @return string
     */
    protected function getTitle(SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes, array $localizedAttributes): string
    {
        if (isset($localizedAttributes[static::KEY_TITLE]) && !empty($localizedAttributes[static::KEY_TITLE])) {
            return $localizedAttributes[static::KEY_TITLE];
        }

        return $navigationNodeLocalizedAttributes->getTitle();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes
     * @param array $localizedAttributes
     *
     * @return string|null
     */
    protected function getLink(SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes, array $localizedAttributes): ?string
    {
        if (isset($localizedAttributes[static::KEY_URL]) && !empty($localizedAttributes[static::KEY_URL])) {
            return $localizedAttributes[static::KEY_URL];
        }

        return $navigationNodeLocalizedAttributes->getLink();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes
     * @param array $localizedAttributes
     *
     * @return string|null
     */
    protected function getExternalUrl(SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes, array $localizedAttributes): ?string
    {
        if (isset($localizedAttributes[static::KEY_URL]) && !empty($localizedAttributes[static::KEY_URL])) {
            return $localizedAttributes[static::KEY_URL];
        }

        return $navigationNodeLocalizedAttributes->getExternalUrl();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes
     * @param array $localizedAttributes
     * @param int $idLocale
     *
     * @return int|null
     */
    protected function getFkUrl(SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes, array $localizedAttributes, $idLocale): ?int
    {
        if (isset($localizedAttributes[static::KEY_URL]) && !empty($localizedAttributes[static::KEY_URL])) {
            $urlEntity = SpyUrlQuery::create()
                ->filterByFkLocale($idLocale)
                ->filterByUrl($localizedAttributes[static::KEY_URL])
                ->findOne();

            if ($urlEntity) {
                return $urlEntity->getIdUrl();
            }
        }

        return $navigationNodeLocalizedAttributes->getFkUrl();
    }

    /**
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes
     * @param array $localizedAttributes
     *
     * @return string|null
     */
    protected function getCssClass(SpyNavigationNodeLocalizedAttributes $navigationNodeLocalizedAttributes, array $localizedAttributes): ?string
    {
        if (isset($localizedAttributes[static::KEY_CSS_CLASS]) && !empty($localizedAttributes[static::KEY_CSS_CLASS])) {
            return $localizedAttributes[static::KEY_CSS_CLASS];
        }

        return $navigationNodeLocalizedAttributes->getCssClass();
    }
}

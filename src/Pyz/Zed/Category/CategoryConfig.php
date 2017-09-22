<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Category;

use Spryker\Zed\Category\CategoryConfig as CategoryCategoryConfig;
use Spryker\Zed\CmsBlockCategoryConnector\CmsBlockCategoryConnectorConfig;

class CategoryConfig extends CategoryCategoryConfig
{

    /**
     * @return array
     */
    public function getTemplateList()
    {
        // TODO: these template must be decoupled from CatalogPage module
        $templateList = [
            CmsBlockCategoryConnectorConfig::CATEGORY_TEMPLATE_ONLY_CMS_BLOCK => '@CatalogCmsBlockWidget/catalog/cms-block.twig',
            CmsBlockCategoryConnectorConfig::CATEGORY_TEMPLATE_WITH_CMS_BLOCK => '@CatalogCmsBlockWidget/catalog/catalog-cms-block.twig',
        ];
        $templateList += parent::getTemplateList();

        return $templateList;
    }

}

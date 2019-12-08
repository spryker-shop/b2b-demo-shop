<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SearchElasticsearch;

use Spryker\Shared\SearchElasticsearch\SearchElasticsearchConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;
use Spryker\Zed\SearchElasticsearch\SearchElasticsearchConfig as SprykerSearchElasticsearchConfig;

/**
 * @method \Spryker\Shared\SearchElasticsearch\SearchElasticsearchConfig getSharedConfig()
 */
class SearchElasticsearchConfig extends SprykerSearchElasticsearchConfig
{
    /**
     * @return array
     */
    public function getJsonSchemaDefinitionDirectories(): array
    {
        $directories = parent::getJsonSchemaDefinitionDirectories();
        $directories[] = sprintf('%s/src/Pyz/Shared/*/Schema/', APPLICATION_ROOT_DIR);

        return $directories;
    }
}

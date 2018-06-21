<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CmsPageSearch;

use Spryker\Zed\CmsPageSearch\CmsPageSearchConfig as AbstractCmsPageSearchConfig;

class CmsPageSearchConfig extends AbstractCmsPageSearchConfig
{
    /**
     * @return string|null
     */
    public function getCmsPageSynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}

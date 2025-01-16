<?php



declare(strict_types = 1);

namespace Pyz\Zed\ZedNavigation;

use Spryker\Zed\ZedNavigation\ZedNavigationConfig as SprykerZedNavigationConfig;

class ZedNavigationConfig extends SprykerZedNavigationConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getMergeStrategy(): string
    {
        return static::BREADCRUMB_MERGE_STRATEGY;
    }
}

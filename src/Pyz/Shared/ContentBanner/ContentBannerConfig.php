<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ContentBanner;

use Spryker\Shared\ContentBanner\ContentBannerConfig as SprykerContentBannerConfig;

class ContentBannerConfig extends SprykerContentBannerConfig
{
    /**
     * @var string
     *
     * Content item banner home page template identifier
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_HOME_PAGE = 'home-page';
}

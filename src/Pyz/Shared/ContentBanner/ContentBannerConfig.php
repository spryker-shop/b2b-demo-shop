<?php



declare(strict_types = 1);

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

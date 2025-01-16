<?php



declare(strict_types = 1);

namespace Pyz\Shared\ContentProductSet;

use Spryker\Shared\ContentProductSet\ContentProductSetConfig as SprykerContentProductSetConfig;

class ContentProductSetConfig extends SprykerContentProductSetConfig
{
    /**
     * @var string
     *
     * Content item product set landing page template identifier
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE = 'landing-page';
}

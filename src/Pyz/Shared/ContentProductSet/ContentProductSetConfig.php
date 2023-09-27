<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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

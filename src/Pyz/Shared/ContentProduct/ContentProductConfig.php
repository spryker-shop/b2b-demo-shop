<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ContentProduct;

use Spryker\Shared\ContentProduct\ContentProductConfig as SprykerContentProductConfig;

class ContentProductConfig extends SprykerContentProductConfig
{
    /**
     * @var string
     *
     * Content item abstract product list slider template identifier
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_SLIDER = 'slider';
}

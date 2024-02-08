<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Development;

use Spryker\Zed\Development\DevelopmentConfig as SprykerDevelopmentConfig;

class DevelopmentConfig extends SprykerDevelopmentConfig
{
    /**
     * @return string
     */
    public function getCodingStandard(): string
    {
        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . 'phpcs.xml';
    }
}

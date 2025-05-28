<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Propel;

use Spryker\Zed\Propel\PropelConfig as SprykerPropelConfig;

class PropelConfig extends SprykerPropelConfig
{
    /**
     * Specification:
     * - If true, adds additional shared logger that will send all Propel logs to the same destination as regular logs.
     *
     * @api
     *
     * @return bool
     */
    public function isSharedLoggerEnabled(): bool
    {
        return true;
    }
}

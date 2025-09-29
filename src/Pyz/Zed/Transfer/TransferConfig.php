<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Transfer;

use Spryker\Zed\Transfer\TransferConfig as SprykerTransferConfig;

class TransferConfig extends SprykerTransferConfig
{
    /**
     * @return array<string>
     */
    public function getEntitiesSourceDirectories(): array
    {
        return [
            APPLICATION_SOURCE_DIR . '/Orm/Propel/*/Schema/',
        ];
    }

    public function isTransferXmlValidationEnabled(): bool
    {
        return true;
    }

    public function isTransferSuffixCheckStrict(): bool
    {
        return true;
    }
}

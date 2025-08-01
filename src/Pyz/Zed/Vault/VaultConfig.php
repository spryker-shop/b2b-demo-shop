<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Vault;

use Spryker\Zed\Vault\VaultConfig as SprykerVaultConfig;

class VaultConfig extends SprykerVaultConfig
{
    /**
     * @var bool
     */
    protected const USE_BYTE_STRING_FOR_ENCRYPTION_INITIALIZATION_VECTOR = true;
}

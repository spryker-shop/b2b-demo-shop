<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CompanyUser\Communication\Plugin\Permission;

use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

class SeeCompanyMenuPermissionPlugin extends AbstractPlugin implements PermissionPluginInterface
{
    public const KEY = 'SeeCompanyMenuPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}

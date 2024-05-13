<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AuditLog\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\AuditLog\Persistence\AuditLogPersistenceFactory getFactory()
 */
class AuditLogEntityManager extends AbstractEntityManager implements AuditLogEntityManagerInterface
{
}

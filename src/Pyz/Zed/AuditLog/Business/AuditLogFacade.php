<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AuditLog\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AuditLog\Business\AuditLogBusinessFactory getFactory()
 * @method \Pyz\Zed\AuditLog\Persistence\AuditLogRepositoryInterface getRepository()
 * @method \Pyz\Zed\AuditLog\Persistence\AuditLogEntityManagerInterface getEntityManager()
 */
class AuditLogFacade extends AbstractFacade implements AuditLogFacadeInterface
{
}

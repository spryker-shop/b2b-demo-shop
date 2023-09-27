<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Spryker\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface as SprykerCustomerAccessFacadeInterface;

interface CustomerAccessFacadeInterface extends SprykerCustomerAccessFacadeInterface
{
    /**
     * Specification:
     * - Filters only manageable content types. Manageable content type can be set up in config `getManageableContentTypes` method.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer;

    /**
     * Specification:
     * - Filters only non manageable content types. Manageable content type can be set up in config `getManageableContentTypes` method.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterNonManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer;
}

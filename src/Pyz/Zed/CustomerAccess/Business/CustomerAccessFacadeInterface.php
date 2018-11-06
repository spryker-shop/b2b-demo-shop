<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Spryker\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface as SprykerCustomerAccessFacadeInterface;

interface CustomerAccessFacadeInterface extends SprykerCustomerAccessFacadeInterface
{
    /**
     * Specification:
     * - Filters customer access transfer. Returns only manageable content types.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer;
}

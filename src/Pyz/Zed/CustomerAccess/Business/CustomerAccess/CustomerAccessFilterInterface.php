<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business\CustomerAccess;

use Generated\Shared\Transfer\CustomerAccessTransfer;

interface CustomerAccessFilterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterNonManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer;
}

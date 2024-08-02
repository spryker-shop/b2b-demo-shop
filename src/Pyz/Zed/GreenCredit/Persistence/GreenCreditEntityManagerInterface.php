<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\GreenCredit\Persistence;

use Generated\Shared\Transfer\SpyGreenCreditEntityTransfer;

interface GreenCreditEntityManagerInterface
{
    /**
     * Specification:
     * - Creates a company
     * - Finds a company by CompanyTransfer::idCompany in the transfer
     * - Updates fields in a company entity
     *
     * @param \Generated\Shared\Transfer\SpyGreenCreditEntityTransfer $greencreditTransfer
     *
     * @return bool
     */
    public function saveCredit(SpyGreenCreditEntityTransfer $greencreditTransfer): bool;

}

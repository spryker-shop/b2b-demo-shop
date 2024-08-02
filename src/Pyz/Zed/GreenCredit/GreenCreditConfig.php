<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\GreenCredit;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class GreenCreditConfig extends AbstractBundleConfig
{
    /**
     * @var int
     */
    protected const GREENCREDIT_SUGGESTION_LIMIT = 20;

    /**
     * @api
     *
     * @return int
     */
    public function getGreenCreditLimit(): int
    {
        return static::COMPANY_SUGGESTION_LIMIT;
    }
}

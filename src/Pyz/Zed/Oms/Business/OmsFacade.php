<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Oms\Business;

use Generated\Shared\Transfer\TimeoutProcessorTimeoutRequestTransfer;
use Generated\Shared\Transfer\TimeoutProcessorTimeoutResponseTransfer;
use Spryker\Zed\Oms\Business\OmsFacade as SprykerOmsFacade;

/**
 * @method \Pyz\Zed\Oms\Business\OmsBusinessFactory getFactory()
 * @method \Spryker\Zed\Oms\Persistence\OmsEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Oms\Persistence\OmsRepositoryInterface getRepository()
 */
class OmsFacade extends SprykerOmsFacade implements OmsFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\TimeoutProcessorTimeoutRequestTransfer $timeoutProcessorTimeoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\TimeoutProcessorTimeoutResponseTransfer
     */
    public function calculateInitiationTimeout(
        TimeoutProcessorTimeoutRequestTransfer $timeoutProcessorTimeoutRequestTransfer,
    ): TimeoutProcessorTimeoutResponseTransfer {
        return $this->getFactory()->createInitiationTimeoutCalculator()->calculateTimeout($timeoutProcessorTimeoutRequestTransfer);
    }
}

<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Event;

use Spryker\Zed\Event\EventConfig as SprykerEventConfig;

class EventConfig extends SprykerEventConfig
{

    /**
     * @return int
     */
    public function getEventQueueMessageChunkSize()
    {
        return 5000;
    }
}

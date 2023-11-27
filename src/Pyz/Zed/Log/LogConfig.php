<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Log;

use Spryker\Zed\Log\LogConfig as SprykerLogConfig;
use Spryker\Shared\Log\LogConstants;

class LogConfig extends SprykerLogConfig
{
    /**
     * @return resource|string
     */
    public function getZedLogFilePath()
    {
        if ($this->getConfig()->hasKey(LogConstants::LOG_FILE_PATH_ZED)) {
            return $this->get(LogConstants::LOG_FILE_PATH_ZED);
        }

        return $this->get(LogConstants::LOG_FILE_PATH);
    }

    /**
     * @return resource|string
     */
    public function getZedExceptionLogFilePath()
    {
        if ($this->getConfig()->hasKey(LogConstants::LOG_FILE_PATH_ZED)) {
            return $this->get(LogConstants::LOG_FILE_PATH_ZED);
        }

        return $this->get(LogConstants::EXCEPTION_LOG_FILE_PATH);
    }
}

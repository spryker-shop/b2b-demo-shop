<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\Log;

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Spryker\Glue\Log\LogFactory as SprykerLogFactory;

/**
 * @method \Pyz\Glue\Log\LogConfig getConfig()
 */
class LogFactory extends SprykerLogFactory
{
    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    public function createStreamHandler(): HandlerInterface
    {
        $streamHandler = new StreamHandler(
            $this->getConfig()->getGlueLogFilePath(),
            $this->getConfig()->getLogLevel()
        );
        $streamHandler->setFormatter($this->createLogstashFormatter());

        return $streamHandler;
    }

    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    public function createExceptionStreamHandler(): HandlerInterface
    {
        $streamHandler = new StreamHandler(
            $this->getConfig()->getGlueExceptionLogFilePath(),
            Logger::ERROR
        );
        # $streamHandler->setFormatter($this->createExceptionFormatter());

        return $streamHandler;
    }
}

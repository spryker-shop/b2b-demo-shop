<?php



declare(strict_types = 1);

namespace Pyz\Zed\Event;

use Monolog\Logger;
use Spryker\Zed\Event\EventConfig as SprykerEventConfig;

class EventConfig extends SprykerEventConfig
{
    /**
     * @var string|int
     */
    protected const DEFAULT_EVENT_LOGGER_MIN_LEVEL = Logger::WARNING;
}

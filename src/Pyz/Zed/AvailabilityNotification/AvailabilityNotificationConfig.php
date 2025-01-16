<?php



declare(strict_types = 1);

namespace Pyz\Zed\AvailabilityNotification;

use Spryker\Zed\AvailabilityNotification\AvailabilityNotificationConfig as SprykerAvailabilityNotificationConfig;

class AvailabilityNotificationConfig extends SprykerAvailabilityNotificationConfig
{
    /**
     * @var bool
     */
    protected const AVAILABILITY_NOTIFICATION_CHECK_PRODUCT_EXISTS = true;
}

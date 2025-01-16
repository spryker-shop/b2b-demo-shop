<?php



declare(strict_types = 1);

namespace Pyz\Zed\Touch;

use Spryker\Zed\Touch\TouchConfig as SprykerTouchConfig;

class TouchConfig extends SprykerTouchConfig
{
    /**
     * @return bool
     */
    public function isTouchEnabled(): bool
    {
        return false;
    }
}

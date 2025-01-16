<?php



declare(strict_types = 1);

namespace Pyz\Zed\PropelOrm;

use Spryker\Zed\PropelOrm\PropelOrmConfig as SprykerPropelOrmConfig;

class PropelOrmConfig extends SprykerPropelOrmConfig
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function isBooleanCastingEnabled(): bool
    {
        return true;
    }
}

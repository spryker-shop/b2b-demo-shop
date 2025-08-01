<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\OauthWarehouse;

use Spryker\Zed\OauthWarehouse\OauthWarehouseConfig as SprykerOauthWarehouseConfig;

class OauthWarehouseConfig extends SprykerOauthWarehouseConfig
{
    /**
     * @uses \Spryker\Zed\OauthUserConnector\OauthUserConnectorConfig::SCOPE_BACK_OFFICE_USER
     *
     * @var string
     */
    protected const SCOPE_BACK_OFFICE_USER = 'back-office-user';

    /**
     * {@inheritDoc}
     *
     * @return list<string>
     */
    public function getAllowedUserScopes(): array
    {
        return [
            static::SCOPE_BACK_OFFICE_USER,
        ];
    }
}

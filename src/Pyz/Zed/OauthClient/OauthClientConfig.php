<?php



declare(strict_types = 1);

namespace Pyz\Zed\OauthClient;

use Spryker\Zed\OauthClient\OauthClientConfig as SprykerOauthClientConfig;

class OauthClientConfig extends SprykerOauthClientConfig
{
    /**
     * @api
     *
     * @return bool
     */
    public function isAccessTokenRequestExpandedByMessageAttributes(): bool
    {
        return true;
    }
}

<?php



declare(strict_types = 1);

namespace Pyz\Glue\OauthApi;

use Spryker\Glue\OauthApi\OauthApiConfig as SprykerOauthApiConfig;

class OauthApiConfig extends SprykerOauthApiConfig
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function isConventionalResponseCodeEnabled(): bool
    {
        return true;
    }
}

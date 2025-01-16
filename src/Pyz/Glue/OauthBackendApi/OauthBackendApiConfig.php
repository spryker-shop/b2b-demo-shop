<?php



declare(strict_types = 1);

namespace Pyz\Glue\OauthBackendApi;

use Spryker\Glue\OauthBackendApi\OauthBackendApiConfig as SprykerOauthBackendApiConfig;

class OauthBackendApiConfig extends SprykerOauthBackendApiConfig
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

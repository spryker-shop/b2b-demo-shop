<?php



declare(strict_types = 1);

namespace Pyz\Yves\AgentPage;

use SprykerShop\Yves\AgentPage\AgentPageConfig as SprykerAgentPageConfig;

class AgentPageConfig extends SprykerAgentPageConfig
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @deprecated Will be removed without replacement. If the future the locale-specific URL will be used.
     *
     * @return bool
     */
    public function isLocaleInLoginCheckPath(): bool
    {
        return true;
    }
}

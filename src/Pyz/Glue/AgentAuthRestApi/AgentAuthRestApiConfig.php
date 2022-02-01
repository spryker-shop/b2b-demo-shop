<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AgentAuthRestApi;

use Spryker\Glue\AgentAuthRestApi\AgentAuthRestApiConfig as SprykerAgentAuthRestApiConfig;
use Spryker\Glue\QuoteRequestAgentsRestApi\QuoteRequestAgentsRestApiConfig;

class AgentAuthRestApiConfig extends SprykerAgentAuthRestApiConfig
{
    /**
     * @return array<string>
     */
    public function getAgentResources(): array
    {
        return [
            QuoteRequestAgentsRestApiConfig::RESOURCE_AGENT_QUOTE_REQUESTS,
            QuoteRequestAgentsRestApiConfig::RESOURCE_AGENT_QUOTE_REQUEST_SEND_TO_CUSTOMER,
            QuoteRequestAgentsRestApiConfig::RESOURCE_AGENT_QUOTE_REQUEST_REVISE,
            QuoteRequestAgentsRestApiConfig::RESOURCE_AGENT_QUOTE_REQUEST_CANCEL,
        ];
    }
}

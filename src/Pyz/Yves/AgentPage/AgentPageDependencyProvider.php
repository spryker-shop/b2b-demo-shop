<?php



declare(strict_types = 1);

namespace Pyz\Yves\AgentPage;

use SprykerShop\Yves\AgentPage\AgentPageDependencyProvider as SprykerAgentPageDependencyProvider;
use SprykerShop\Yves\SessionCustomerValidationPage\Plugin\AgentPage\CustomerUpdateSessionPostImpersonationPlugin;

class AgentPageDependencyProvider extends SprykerAgentPageDependencyProvider
{
    /**
     * @return list<\SprykerShop\Yves\AgentPageExtension\Dependency\Plugin\SessionPostImpersonationPluginInterface>
     */
    protected function getSessionPostImpersonationPlugins(): array
    {
        return [
            new CustomerUpdateSessionPostImpersonationPlugin(),
        ];
    }
}

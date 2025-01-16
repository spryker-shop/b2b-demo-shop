<?php



declare(strict_types = 1);

namespace Pyz\Zed\SetupFrontend;

use Spryker\Zed\SetupFrontend\SetupFrontendConfig as SprykerSetupFrontendConfig;

class SetupFrontendConfig extends SprykerSetupFrontendConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getProjectInstallCommand(): string
    {
        return 'npm ci --prefer-offline --legacy-peer-deps';
    }
}

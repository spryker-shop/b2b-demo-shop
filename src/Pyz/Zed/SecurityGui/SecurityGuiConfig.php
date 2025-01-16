<?php



declare(strict_types = 1);

namespace Pyz\Zed\SecurityGui;

use Spryker\Zed\SecurityGui\SecurityGuiConfig as SprykerSecurityGuiConfig;

class SecurityGuiConfig extends SprykerSecurityGuiConfig
{
    /**
     * @var bool
     */
    protected const IS_BACKOFFICE_USER_SECURITY_BLOCKER_ENABLED = true;

    /**
     * @var string
     */
    protected const IGNORABLE_ROUTE_PATTERN = '^/(security-gui|health-check|_profiler/wdt|api/rest/.+)';
}

<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Application\Communication;

use RuntimeException;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Auth\AuthConstants;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Config\Environment;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Application\Communication\ZedBootstrap as SprykerZedBootstrap;

class ZedBootstrap extends SprykerZedBootstrap
{
    /**
     * @SuppressWarnings(PHPMD)
     *
     * @return void
     */
    protected function setUp()
    {
        $this->assertMatchingHostName();

        if (!empty($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], ApiConfig::ROUTE_PREFIX_API_REST) === 0) {
            $this->registerApiServiceProvider();
            return;
        }

        parent::setUp();
    }

    /**
     * @return bool
     */
    protected function isAuthenticationEnabled()
    {
        return Config::get(AuthConstants::AUTH_ZED_ENABLED, true);
    }

    /**
     * @return void
     */
    protected function assertMatchingHostName()
    {
        if (empty($_SERVER['HTTP_HOST']) || Environment::isProduction()) {
            return;
        }

        $configuredHostName = Config::get(ApplicationConstants::HOST_ZED);
        $actualHostName = $_SERVER['HTTP_HOST'];
        if ($actualHostName === $configuredHostName) {
            return;
        }

        throw new RuntimeException(sprintf(
            'Incorrect HOST_ZED config, expected `%s`, got `%s`. Set the URLs in your Shared/config_default_xx.php files.',
            $actualHostName,
            $configuredHostName
        ));
    }
}

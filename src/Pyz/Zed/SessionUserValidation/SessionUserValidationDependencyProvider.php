<?php



declare(strict_types = 1);

namespace Pyz\Zed\SessionUserValidation;

use Spryker\Zed\SessionRedis\Communication\Plugin\SessionUserValidation\SessionRedisSessionUserSaverPlugin;
use Spryker\Zed\SessionRedis\Communication\Plugin\SessionUserValidation\SessionRedisSessionUserValidatorPlugin;
use Spryker\Zed\SessionUserValidation\SessionUserValidationDependencyProvider as SprykerSessionUserValidationDependencyProvider;
use Spryker\Zed\SessionUserValidationExtension\Dependency\Plugin\SessionUserSaverPluginInterface;
use Spryker\Zed\SessionUserValidationExtension\Dependency\Plugin\SessionUserValidatorPluginInterface;

class SessionUserValidationDependencyProvider extends SprykerSessionUserValidationDependencyProvider
{
    /**
     * @return \Spryker\Zed\SessionUserValidationExtension\Dependency\Plugin\SessionUserSaverPluginInterface
     */
    protected function getSessionUserSaverPlugin(): SessionUserSaverPluginInterface
    {
        return new SessionRedisSessionUserSaverPlugin();
    }

    /**
     * @return \Spryker\Zed\SessionUserValidationExtension\Dependency\Plugin\SessionUserValidatorPluginInterface
     */
    protected function getSessionUserValidatorPlugin(): SessionUserValidatorPluginInterface
    {
        return new SessionRedisSessionUserValidatorPlugin();
    }
}

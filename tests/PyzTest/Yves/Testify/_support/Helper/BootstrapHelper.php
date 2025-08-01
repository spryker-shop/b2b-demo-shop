<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Testify\Helper;

use Codeception\Lib\Framework;
use Codeception\TestInterface;
use Pyz\Yves\ShopApplication\YvesBootstrap;
use Spryker\Shared\ErrorHandler\ErrorHandlerConstants;
use SprykerTest\Shared\Testify\Helper\ConfigHelperTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelBrowser;

class BootstrapHelper extends Framework
{
    use ConfigHelperTrait;

    /**
     * @param \Codeception\TestInterface $test
     *
     * @return void
     */
    public function _before(TestInterface $test): void // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        $this->disableWhoopsErrorHandler();

        $requestFactory = function (array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null) {
            $request = new Request($query, $request, $attributes, $cookies, $files, $server, $content);
            $request->server->set('SERVER_NAME', 'localhost');

            return $request;
        };

        Request::setFactory($requestFactory);

        $application = new YvesBootstrap();
        $this->client = new HttpKernelBrowser($application->boot());
    }

    /**
     * The WhoopsErrorHandler converts E_USER_DEPRECATED into exception, we need to disable it for controller tests.
     *
     * @return void
     */
    protected function disableWhoopsErrorHandler(): void
    {
        $this->getConfigHelper()->setConfig(ErrorHandlerConstants::IS_PRETTY_ERROR_HANDLER_ENABLED, false);
    }
}

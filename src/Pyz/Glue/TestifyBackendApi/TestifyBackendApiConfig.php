<?php



declare(strict_types = 1);

namespace Pyz\Glue\TestifyBackendApi;

use Spryker\Glue\TestifyBackendApi\TestifyBackendApiConfig as SprykerTestifyBackendApiConfig;

class TestifyBackendApiConfig extends SprykerTestifyBackendApiConfig
{
    /**
     * @return string
     */
    public function getCodeceptionConfiguration(): string
    {
        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . 'tests/PyzTest/Zed/TestifyBackendApi/codeception.dynamic.fixtures.yml';
    }

    /**
     * @return string
     */
    public function getCodeceptionSuiteName(): string
    {
        return 'DynamicFixture';
    }
}

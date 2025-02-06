<?php

namespace Pyz\Client\TestModule;

use Pyz\Client\TestModule\Zed\TestModuleStub;
use Spryker\Client\Kernel\AbstractFactory;

class TestModuleFactory extends AbstractFactory
{

    /**
     * @return \Pyz\Client\TestModule\Zed\TestModuleStubInterface
     */
    public function createZedStub()
    {
        return new TestModuleStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(TestModuleDependencyProvider::CLIENT_ZED_REQUEST);
    }

}

<?php

namespace Pyz\Client\TestModule;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\TestModule\TestModuleFactory getFactory()
 */
class TestModuleClient extends AbstractClient implements TestModuleClientInterface
{

    /**
     * @return \Pyz\Client\TestModule\Zed\TestModuleStubInterface
     */
    protected function getZedStub()
    {
        return $this->getFactory()->createZedStub();
    }

}

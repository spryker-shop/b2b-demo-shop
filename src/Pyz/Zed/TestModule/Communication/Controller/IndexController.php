<?php

namespace Pyz\Zed\TestModule\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\TestModule\Business\TestModuleFacade getFacade()
 * @method \Pyz\Zed\TestModule\Communication\TestModuleCommunicationFactory getFactory()
 * @method \Pyz\Zed\TestModule\Persistence\TestModuleQueryContainer getQueryContainer()
 */
class IndexController extends AbstractController
{

    /**
     * @return array
     */
    public function indexAction()
    {
        return $this->viewResponse([
            'test' => 'Greetings!',
        ]);
    }

}

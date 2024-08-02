<?php

namespace Spryker\Zed\Module\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @method \Spryker\Zed\Module\Business\ModuleFacadeInterface getFacade()
 * @method \Spryker\Zed\Module\Communication\ModuleCommunicationFactory getFactory()
 * @method \Spryker\Zed\Module\Persistence\ModuleQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Module\Persistence\ModuleRepositoryInterface getRepository()
 */
class DownloadController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function indexAction(): StreamedResponse
    {
        return $this->getFactory()->createModuleTable()->streamDownload();
    }
}
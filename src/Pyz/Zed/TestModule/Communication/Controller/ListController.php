<?php

namespace Pyz\Zed\TestModule\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\TestModule\Communication\TestModuleCommunicationFactory getFactory()
 */
class ListController extends AbstractController
{
    /**
     * Displays the cars list in the Backoffice.
     *
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $carsTable = $this->getFactory()->createPyzCarsTable();

        return $this->viewResponse([
            'carsTable' => $carsTable->render(),
        ]);
    }

    /**
     * AJAX response for the data table.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction(Request $request)
    {
        $carsTable = $this->getFactory()->createPyzCarsTable();

        return $this->jsonResponse($carsTable->fetchData());
    }
}

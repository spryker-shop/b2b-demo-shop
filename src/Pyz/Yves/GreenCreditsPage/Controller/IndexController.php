<?php

namespace Pyz\Yves\GreenCreditsPage\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $greenCreditsForm = $this
            ->getFactory()
            ->createGreenCreditsForm();

        $response = [
            'form' => $greenCreditsForm->createView(),
        ];

        return $this->view($response, [], '@GreenCreditsPage/views/greencredits/greencredits.twig');
    }
    
}

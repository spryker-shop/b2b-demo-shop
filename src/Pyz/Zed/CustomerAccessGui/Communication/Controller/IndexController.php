<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication\Controller;

use Spryker\Zed\CustomerAccessGui\Communication\Controller\IndexController as SprykerIndexController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\CustomerAccessGui\Communication\CustomerAccessGuiCommunicationFactory getFactory()
 */
class IndexController extends SprykerIndexController
{
    /**
     * @var string
     */
    protected const MESSAGE_UPDATE_SUCCESS = 'Not logged in customer accessible content has been successfully updated.';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string, mixed>
     */
    public function indexAction(Request $request): array
    {
        $customerAccessDataProvider = $this->getFactory()->createCustomerAccessDataProvider();

        $customerAccessForm = $this->getFactory()->getCustomerAccessForm($customerAccessDataProvider->getData(), $customerAccessDataProvider->getOptions());

        $customerAccessForm->handleRequest($request);

        if ($customerAccessForm->isSubmitted() && $customerAccessForm->isValid()) {
            $this->getFactory()
                ->getCustomerAccessFacade()
                ->updateUnauthenticatedCustomerAccess($customerAccessForm->getData());
            $this->addSuccessMessage(static::MESSAGE_UPDATE_SUCCESS);
        }

        return [
            'form' => $customerAccessForm->createView(),
        ];
    }
}

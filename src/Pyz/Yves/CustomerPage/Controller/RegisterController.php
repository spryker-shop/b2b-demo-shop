<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Controller;

use SprykerShop\Yves\CustomerPage\Controller\RegisterController as SprykerRegisterController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class RegisterController extends SprykerRegisterController
{
    /**
     * @var string
     *
     * @uses \SprykerShop\Yves\CompanyUserInvitationPage\CompanyUserInvitationPageConfig::INVITATION_SESSION_ID
     */
    protected const INVITATION_SESSION_ID = 'COMPANY_USER_INVITATION';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $response = $this->executeIndexAction($request);

        if (!is_array($response)) {
            return $response;
        }

        if ($this->getFactory()->getSessionClient()->get(static::INVITATION_SESSION_ID)) {
            return $this->view($response, [], '@CustomerPage/views/register/register.twig');
        }

        return $this->view($response, [], '@CustomerPage/views/login/login.twig');
    }
}

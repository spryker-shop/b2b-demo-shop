<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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

        $response['templateName'] = 'page-layout-login';

        if ($this->getFactory()->getSessionClient()->get(static::INVITATION_SESSION_ID)) {
            $response['templateName'] = 'page-layout-login-with-registration';
        }

        return $this->view($response, [], '@CustomerPage/views/register/register.twig');
    }
}
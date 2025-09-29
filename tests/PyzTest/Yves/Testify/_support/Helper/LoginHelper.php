<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Testify\Helper;

use Codeception\Module;

class LoginHelper extends Module
{
    public function amLoggedInCustomer(string $username = 'spencor.hopkins@spryker.com', string $password = 'change123'): void
    {
        $i = $this->getClient();

        $i->amOnPage('/login');

        $i->fillField('#loginForm_email', $username);
        $i->fillField('#loginForm_password', $password);
        $i->click('Login');
    }

    protected function getClient(): Module|\Codeception\Lib\Framework
    {
        return $this->getModule('\\' . BootstrapHelper::class);
    }
}

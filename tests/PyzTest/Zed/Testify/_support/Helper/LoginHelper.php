<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\Testify\Helper;

use Codeception\Lib\Framework;
use Codeception\Module;

class LoginHelper extends Module
{
    public function amLoggedInUser(string $username = 'admin@spryker.com', string $password = 'change123'): void
    {
        $i = $this->getClient();

        $i->amOnPage('/security-gui/login');

        $i->fillField('#auth_username', $username);
        $i->fillField('#auth_password', $password);
        $i->click('Login');
    }

    protected function getClient(): Module|Framework
    {
        return $this->getModule('\\' . BootstrapHelper::class);
    }
}

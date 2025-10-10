<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Customer\Presentation;

use Codeception\Scenario;
use PyzTest\Yves\Customer\CustomerPresentationTester;
use PyzTest\Yves\Customer\PageObject\CustomerAddressesPage;
use PyzTest\Yves\Customer\PageObject\CustomerAddressPage;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group Customer
 * @group Presentation
 * @group CustomerAddressesCest
 * Add your own group annotations below this line
 */
class CustomerAddressesCest
{
    public function _before(CustomerPresentationTester $i): void
    {
        $i->amYves();
    }

    public function testICanOpenAddAddressPage(CustomerPresentationTester $i, Scenario $scenario): void // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        $i->amLoggedInCustomer();
        $i->amOnPage(CustomerAddressesPage::URL);
        $i->click(CustomerAddressesPage::BUTTON_ADD_NEW_ADDRESS);
        $i->seeCurrentUrlEquals(CustomerAddressPage::URL);
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Customer\Presentation;

use Codeception\Scenario;
use Codeception\Stub;
use PyzTest\Yves\Customer\CustomerPresentationTester;
use PyzTest\Yves\Customer\PageObject\CustomerNewsletterPage;
use Spryker\Zed\Newsletter\Dependency\Facade\NewsletterToMailInterface;
use Spryker\Zed\Newsletter\NewsletterDependencyProvider;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group Customer
 * @group Presentation
 * @group CustomerNewsletterCest
 * Add your own group annotations below this line
 */
class CustomerNewsletterCest
{
    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     *
     * @return void
     */
    public function _before(CustomerPresentationTester $i): void
    {
        $i->amYves();
    }

    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     * @param \Codeception\Scenario $scenario
     *
     * @return void
     */
    public function testICanSubscribeNewsletter(CustomerPresentationTester $i, Scenario $scenario): void // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        $i->amLoggedInCustomer();
        $i->amOnPage(CustomerNewsletterPage::URL);

        $i->setDependency(NewsletterDependencyProvider::FACADE_MAIL, Stub::makeEmpty(NewsletterToMailInterface::class));

        $i->click(CustomerNewsletterPage::FORM_FIELD_SELECTOR_NEWSLETTER_SUBSCRIPTION);
        $i->click(CustomerNewsletterPage::BUTTON_SUBMIT);
        $i->seeInSource(CustomerNewsletterPage::SUCCESS_MESSAGE_SUBSCRIBED);
    }

    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     * @param \Codeception\Scenario $scenario
     *
     * @return void
     */
    public function testICanUnSubscribeNewsletter(CustomerPresentationTester $i, Scenario $scenario): void // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        $customerTransfer = $i->amLoggedInCustomer();

        $i->setDependency(NewsletterDependencyProvider::FACADE_MAIL, Stub::makeEmpty(NewsletterToMailInterface::class));

        $i->addNewsletterSubscription($customerTransfer->getEmail());
        $i->amOnPage(CustomerNewsletterPage::URL);
        $i->click(CustomerNewsletterPage::FORM_FIELD_SELECTOR_NEWSLETTER_SUBSCRIPTION);
        $i->click(CustomerNewsletterPage::BUTTON_SUBMIT);
        $i->seeInSource(CustomerNewsletterPage::SUCCESS_MESSAGE_UN_SUBSCRIBED);
    }
}

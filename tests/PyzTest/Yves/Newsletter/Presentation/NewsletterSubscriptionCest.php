<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Newsletter\Presentation;

use Codeception\Scenario;
use Generated\Shared\DataBuilder\CustomerBuilder;
use Generated\Shared\Transfer\CustomerTransfer;
use PyzTest\Yves\Application\PageObject\Homepage;
use PyzTest\Yves\Customer\PageObject\CustomerNewsletterPage;
use PyzTest\Yves\Customer\PageObject\CustomerOverviewPage;
use PyzTest\Yves\Newsletter\NewsletterPresentationTester;
use PyzTest\Yves\Newsletter\PageObject\NewsletterSubscriptionHomePage;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group Newsletter
 * @group Presentation
 * @group NewsletterSubscriptionCest
 * Add your own group annotations below this line
 */
class NewsletterSubscriptionCest
{
    /**
     * @param \PyzTest\Yves\Newsletter\NewsletterPresentationTester $i
     *
     * @return void
     */
    public function _before(NewsletterPresentationTester $i): void
    {
        $i->amYves();
    }

    /**
     * @param \PyzTest\Yves\Newsletter\NewsletterPresentationTester $i
     *
     * @return void
     */
    public function iCanSubscribeWithAnUnsubscribedEmail(NewsletterPresentationTester $i): void
    {
        $i->wantTo('Subscribe to the newsletter with an unsubscribed new email.');
        $i->expect('Success message is displayed.');

        $i->amOnPage(Homepage::URL_EN);

        $customerTransfer = (new CustomerBuilder())->build();

        $i->fillField(NewsletterSubscriptionHomePage::FORM_FIELD_EMAIL, $customerTransfer->getEmail());
        $i->click(NewsletterSubscriptionHomePage::FORM_BUTTON_SUBMIT);

        $i->seeInPageSource(NewsletterSubscriptionHomePage::SUCCESS_MESSAGE);
    }

    /**
     * @param \PyzTest\Yves\Newsletter\NewsletterPresentationTester $i
     *
     * @return void
     */
    public function iCanNotSubscribeWithAnAlreadySubscribedEmail(NewsletterPresentationTester $i): void
    {
        $i->wantTo('Subscribe to the newsletter with an already subscribed email.');
        $i->expect('Error message is displayed.');

        $i->amOnPage(Homepage::URL_EN);

        $customerTransfer = (new CustomerBuilder())->build();

        $i->haveAnAlreadySubscribedEmail($customerTransfer->getEmail());

        $i->fillField(NewsletterSubscriptionHomePage::FORM_FIELD_EMAIL, $customerTransfer->getEmail());
        $i->click(NewsletterSubscriptionHomePage::FORM_BUTTON_SUBMIT);

        $i->seeInPageSource(NewsletterSubscriptionHomePage::ERROR_MESSAGE);
    }

    /**
     * @param \PyzTest\Yves\Newsletter\NewsletterPresentationTester $i
     *
     * @return void
     */
    public function subscribedEmailIsLinkedWithCustomerAfterRegistration(NewsletterPresentationTester $i): void
    {
        $i->wantTo('Subscribe to the newsletter with an unsubscribed email and later on register with that address.');
        $i->expect('Subscriber email should be linked with registered customer.');

        $i->amOnPage(Homepage::URL_EN);

        $customerTransfer = (new CustomerBuilder())->build();

        $i->fillField(NewsletterSubscriptionHomePage::FORM_FIELD_EMAIL, $customerTransfer->getEmail());
        $i->click(NewsletterSubscriptionHomePage::FORM_BUTTON_SUBMIT);
        $i->see(CustomerOverviewPage::MESSAGE_SUCCESS_NEWSLETTER_SUBSCRIBED);

        $i->amLoggedInCustomer([
            CustomerTransfer::EMAIL => $customerTransfer->getEmail(),
        ]);
        $i->amOnPage(CustomerNewsletterPage::URL);
        $i->seeCheckboxIsChecked(CustomerNewsletterPage::FORM_FIELD_SELECTOR_NEWSLETTER_SUBSCRIPTION_INPUT);
    }

    /**
     * @param \PyzTest\Yves\Newsletter\NewsletterPresentationTester $i
     * @param \Codeception\Scenario $scenario
     *
     * @return void
     */
    public function subscribedEmailCanBeUnsubscribedByCustomerAfterRegistration(NewsletterPresentationTester $i, Scenario $scenario): void
    {
        $scenario->skip('Test is broken due to improper usage of checkbox check/uncheck functions.');

        $i->wantTo('Subscribe to the newsletter with an unsubscribed email should be able to unsubscribe after registration.');
        $i->expect('Subscribed email should be unsubscribed after customer unsubscribe.');

        $i->amOnPage(Homepage::URL);

        $customerTransfer = (new CustomerBuilder())->build();

        $i->fillField(NewsletterSubscriptionHomePage::FORM_FIELD_EMAIL, $customerTransfer->getEmail());
        $i->click(NewsletterSubscriptionHomePage::FORM_BUTTON_SUBMIT);
        $i->see(CustomerOverviewPage::MESSAGE_SUCCESS_NEWSLETTER_SUBSCRIBED);

        $i->amLoggedInCustomer([
            CustomerTransfer::EMAIL => $customerTransfer->getEmail(),
        ]);
        $i->amOnPage(CustomerNewsletterPage::URL);

        $i->uncheckOption(CustomerNewsletterPage::FORM_FIELD_SELECTOR_NEWSLETTER_SUBSCRIPTION_INPUT);
        $i->click(CustomerNewsletterPage::BUTTON_SUBMIT);
        $i->seeInSource(CustomerNewsletterPage::SUCCESS_MESSAGE_UN_SUBSCRIBED);
    }
}

<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\NavigationGui\Presentation;

use Codeception\Scenario;
use Faker\Factory;
use PyzTest\Zed\NavigationGui\NavigationGuiPresentationTester;
use PyzTest\Zed\NavigationGui\PageObject\NavigationCreatePage;
use PyzTest\Zed\NavigationGui\PageObject\NavigationDeletePage;
use PyzTest\Zed\NavigationGui\PageObject\NavigationPage;
use PyzTest\Zed\NavigationGui\PageObject\NavigationStatusTogglePage;
use PyzTest\Zed\NavigationGui\PageObject\NavigationUpdatePage;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group NavigationGui
 * @group Presentation
 * @group NavigationCRUDCest
 * Add your own group annotations below this line
 */
class NavigationCRUDCest
{
    /**
     * @param \PyzTest\Zed\NavigationGui\NavigationGuiPresentationTester $i
     * @param \Codeception\Scenario $scenario
     *
     * @return void
     */
    public function testICanCreateReadUpdateAndDeleteNavigation(NavigationGuiPresentationTester $i, Scenario $scenario): void
    {
        $scenario->skip('Once we have Chromium + ChromeDriver or Firefox, enable this test case.');

        $i->amLoggedInUser();
        $i->amOnPage(NavigationCreatePage::URL);

        $idNavigation = $this->create($i);

        $this->read($i);

        $this->update($i, $idNavigation);

        $this->activate($i);

        $this->delete($i);
    }

    /**
     * @param \PyzTest\Zed\NavigationGui\NavigationGuiPresentationTester $i
     *
     * @return int
     */
    protected function create(NavigationGuiPresentationTester $i): int
    {
        $i->wantTo('Create navigation.');
        $i->expect('Navigation is persisted in Zed.');

        $i->setNameField('Acceptance navigation (1)');
        $i->setKeyField(Factory::create()->slug);
        $i->checkIsActiveField(true);
        $i->submitNavigationForm();
        $i->seeCurrentUrlEquals(NavigationPage::URL);
        $idNavigation = $i->seeSuccessMessage(NavigationCreatePage::MESSAGE_SUCCESS);

        return $idNavigation;
    }

    /**
     * @param \PyzTest\Zed\NavigationGui\NavigationGuiPresentationTester $i
     *
     * @return void
     */
    protected function read(NavigationGuiPresentationTester $i): void
    {
        $i->wantTo('See navigation list.');
        $i->expect('Navigation table is shown and not empty');

        $i->waitForElementVisible(NavigationPage::PAGE_LIST_TABLE_XPATH, 5);
    }

    /**
     * @param \PyzTest\Zed\NavigationGui\NavigationGuiPresentationTester $i
     * @param int $idNavigation
     *
     * @return void
     */
    protected function update(NavigationGuiPresentationTester $i, $idNavigation): void
    {
        $i->wantTo('Update existing navigation.');
        $i->expect('Navigation is persisted in Zed');

        $i->amOnPage(sprintf(NavigationUpdatePage::URL, $idNavigation));
        $i->setNameField('Acceptance navigation (1) - edited');
        $i->checkIsActiveField(false);
        $i->submitNavigationForm();
        $i->seeCurrentUrlEquals(NavigationPage::URL);
        $i->seeSuccessMessage(NavigationUpdatePage::MESSAGE_SUCCESS);
    }

    /**
     * @param \PyzTest\Zed\NavigationGui\NavigationGuiPresentationTester $i
     *
     * @return void
     */
    protected function activate(NavigationGuiPresentationTester $i): void
    {
        $i->wantTo('Activate navigation.');
        $i->expect('New navigation status persisted in Zed.');

        $i->amOnPage(NavigationPage::URL);
        $i->waitForElementVisible(NavigationPage::PAGE_LIST_TABLE_XPATH, 5);
        $i->activateFirstNavigationRow();
        $i->seeSuccessMessage(NavigationStatusTogglePage::MESSAGE_ACTIVE_SUCCESS);
        $i->seeCurrentUrlEquals(NavigationPage::URL);
    }

    /**
     * @param \PyzTest\Zed\NavigationGui\NavigationGuiPresentationTester $i
     *
     * @return void
     */
    protected function delete(NavigationGuiPresentationTester $i): void
    {
        $i->wantTo('Delete navigation.');
        $i->expect('Navigation is removed from Zed.');

        $i->amOnPage(NavigationPage::URL);
        $i->waitForElementVisible(NavigationPage::PAGE_LIST_TABLE_XPATH, 5);
        $i->wait(1); // TODO: remove "wait" once flash messages show up consistently.
        $i->deleteFirstNavigationRow();
        $i->seeSuccessMessage(NavigationDeletePage::MESSAGE_SUCCESS);
        $i->seeCurrentUrlEquals(NavigationPage::URL);
    }
}

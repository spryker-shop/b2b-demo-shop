<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Availability\Presentation;

use PyzTest\Yves\Availability\AvailabilityPresentationTester;

/**
 * Auto-generated group annotations
 * @group PyzTest
 * @group Yves
 * @group Availability
 * @group Presentation
 * @group AvailabilityAddToCartCest
 * Add your own group annotations below this line
 */
class AvailabilityAddToCartCest
{
    /**
     * @param \PyzTest\Yves\Availability\AvailabilityPresentationTester $i
     *
     * @return void
     */
    public function testAddToCartAddsProductToCartIfProductIsAvailable(AvailabilityPresentationTester $i): void
    {
        $i->amLoggedInCustomer();

        $i->amOnPage(AvailabilityPresentationTester::URL_ADD_AVAILABLE_PRODUCT_TO_CART);
        $i->waitForElement(AvailabilityPresentationTester::CART_AVAILABLE_ITEM_BLOCK, 10);
        $i->seeElementInDOM(AvailabilityPresentationTester::CART_AVAILABLE_ITEM_BLOCK);
    }

    /**
     * @param \PyzTest\Yves\Availability\AvailabilityPresentationTester $i
     *
     * @return void
     */
    public function testAddToCartDoesNotAddProductToCartIfProductIsUnavailable(AvailabilityPresentationTester $i): void
    {
        $i->amLoggedInCustomer();

        $i->amOnPage(AvailabilityPresentationTester::URL_ADD_UNAVAILABLE_PRODUCT_TO_CART);
        $i->waitForElement(AvailabilityPresentationTester::CART_UNAVAILABLE_ITEM_BLOCK, 10);
        $i->cantSeeElementInDOM(AvailabilityPresentationTester::CART_UNAVAILABLE_ITEM_BLOCK);
    }
}

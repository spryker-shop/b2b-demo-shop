<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Availability;

use Codeception\Actor;
use Codeception\Scenario;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class AvailabilityPresentationTester extends Actor
{
    use _generated\AvailabilityPresentationTesterActions;

    public const URL_EN_PRODUCT_PAGE = '/en/bic-mehrfarbkugelschreiber-4-colours-831253-0-4mm-bl-sw-r-gn-M21646';

    public const URL_ADD_AVAILABLE_PRODUCT_TO_CART = '/cart/add/421261';
    public const URL_ADD_UNAVAILABLE_PRODUCT_TO_CART = '/cart/add/421540';

    public const CART_AVAILABLE_ITEM_BLOCK = '//article[@class = \'product-item\']//small[@class = \'text-secondary\' and contains(text(), \'421261\')]';
    public const CART_UNAVAILABLE_ITEM_BLOCK = '//article[@class = \'product-item\']//small[@class = \'text-secondary\' and contains(text(), \'421540\')]';

    /**
     * @param \Codeception\Scenario $scenario
     */
    public function __construct(Scenario $scenario)
    {
        parent::__construct($scenario);

        $this->amYves();
    }

    /**
     * @return void
     */
    public function processCheckout()
    {
        $this->processAllCheckoutSteps();
    }
}

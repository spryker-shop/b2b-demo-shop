<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Availability;

use Codeception\Actor;

/**
 * Inherited Methods
 *
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
 * @SuppressWarnings(\PyzTest\Yves\Availability\PHPMD)
 */
class AvailabilityPresentationTester extends Actor
{
    use _generated\AvailabilityPresentationTesterActions;

    /**
     * @var int
     */
    public const FUJITSU_PRODUCT_ID = 118;

    /**
     * @var string
     */
    public const URL_EN_PRODUCT_PAGE = '/en/bic-mehrfarbkugelschreiber-4-colours-831253-0-4mm-bl-sw-r-gn-M21646';

    /**
     * @var string
     */
    public const PRODUCT_WITH_LIMITED_AVAILABILITY_ADD_TO_CART_URL = '/cart/add/490001';

    /**
     * @var string
     */
    public const CART_PRE_CHECK_AVAILABILITY_ERROR_MESSAGE = 'Item 490001 only has availability of 20.';

    /**
     * @return void
     */
    public function processCheckout(): void
    {
        $this->processAllCheckoutSteps();
    }
}

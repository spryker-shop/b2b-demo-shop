<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\Carts\RestApi\Fixtures;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use PyzTest\Glue\Carts\CartsApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group Carts
 * @group RestApi
 * @group CartsRestApiFixtures
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CartsRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    use CartsRestApiFixturesTrait;

    protected const TEST_USERNAME = 'UserCartsRestApiFixtures';

    protected const TEST_PASSWORD = 'change123';

    public const QUANTITY_FOR_ITEM_UPDATE = 33;

    public const STORE_DE = 'DE';

    public const TEST_CART_NAME = 'Test cart name';

    public const CURRENCY_EUR = 'EUR';

    protected CustomerTransfer $customerTransfer;

    protected ProductConcreteTransfer $productConcreteTransfer;

    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    public function buildFixtures(CartsApiTester $I): FixturesContainerInterface
    {
        $I->truncateSalesOrderThresholds();

        $this->customerTransfer = $this->createCustomer($I);
        $this->customerTransfer = $I->confirmCustomer($this->customerTransfer);
        $this->productConcreteTransfer = $this->createProduct($I);

        return $this;
    }

    protected function createCustomer(CartsApiTester $I): CustomerTransfer
    {
        return $I->haveCustomer([
            CustomerTransfer::USERNAME => static::TEST_USERNAME,
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);
    }
}

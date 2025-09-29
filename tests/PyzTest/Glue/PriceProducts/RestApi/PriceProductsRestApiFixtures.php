<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\PriceProducts\RestApi;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use PyzTest\Glue\PriceProducts\PriceProductsApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group PriceProducts
 * @group RestApi
 * @group PriceProductsRestApiFixtures
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class PriceProductsRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    /**
     * @var string
     */
    protected const TEST_PASSWORD = 'change123';

    protected ProductConcreteTransfer $productConcreteTransfer;

    protected PriceProductTransfer $priceProductTransfer;

    protected CustomerTransfer $customerTransfer;

    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    public function buildFixtures(PriceProductsApiTester $I): FixturesContainerInterface
    {
        $this->createProductConcrete($I);
        $this->createCustomer($I);

        return $this;
    }

    protected function createProductConcrete(PriceProductsApiTester $I): void
    {
        $this->productConcreteTransfer = $I->haveFullProduct();
    }

    protected function createCustomer(PriceProductsApiTester $I): void
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->customerTransfer = $I->confirmCustomer($customerTransfer);
    }
}

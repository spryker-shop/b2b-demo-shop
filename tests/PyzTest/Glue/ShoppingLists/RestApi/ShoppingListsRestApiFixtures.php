<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\ShoppingLists\RestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\ShoppingListItemTransfer;
use Generated\Shared\Transfer\ShoppingListTransfer;
use PyzTest\Glue\ShoppingLists\ShoppingListsApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group ShoppingLists
 * @group RestApi
 * @group ShoppingListsRestApiFixtures
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class ShoppingListsRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    /**
     * @var string
     */
    protected const TEST_PASSWORD = 'change123';

    protected ShoppingListTransfer $shoppingListTransfer;

    protected ShoppingListItemTransfer $shoppingListItemTransfer;

    protected ProductConcreteTransfer $productConcreteTransfer;

    protected CustomerTransfer $customerTransfer;

    protected CompanyUserTransfer $companyUserTransfer;

    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    public function getShoppingListTransfer(): ShoppingListTransfer
    {
        return $this->shoppingListTransfer;
    }

    public function getShoppingListItemTransfer(): ShoppingListItemTransfer
    {
        return $this->shoppingListItemTransfer;
    }

    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    public function buildFixtures(ShoppingListsApiTester $I): FixturesContainerInterface
    {
        $I->haveCompanyMailConnectorToMailDependency();

        $this->createCustomer($I);
        $this->createShoppingList($I);

        return $this;
    }

    protected function createCustomer(ShoppingListsApiTester $I): void
    {
        $this->createCustomerWithCompanyUser($I);
        $I->confirmCustomer($this->customerTransfer);
    }

    protected function createCustomerWithCompanyUser(ShoppingListsApiTester $I): void
    {
        $this->customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->companyUserTransfer = $this->createCompanyUser($I, $this->customerTransfer);
    }

    protected function createCompanyUser(
        ShoppingListsApiTester $I,
        CustomerTransfer $customerTransfer,
        array $seed = [],
    ): CompanyUserTransfer {
        $companyTransfer = $I->haveActiveCompany([
            CompanyTransfer::STATUS => 'approved',
        ]);

        $companyBusinessUnitTransfer = $I->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
        ]);

        return $I->haveCompanyUser($seed + [
            CompanyUserTransfer::CUSTOMER => $customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);
    }

    protected function createShoppingList(ShoppingListsApiTester $I): void
    {
        $this->productConcreteTransfer = $I->haveFullProduct();

        $this->shoppingListTransfer = $I->haveShoppingList([
            ShoppingListTransfer::CUSTOMER_REFERENCE => $this->customerTransfer->getCustomerReference(),
            ShoppingListTransfer::ID_COMPANY_USER => $this->companyUserTransfer->getIdCompanyUser(),
        ]);

        $this->shoppingListItemTransfer = $I->haveShoppingListItem([
            ShoppingListItemTransfer::ID_COMPANY_USER => $this->companyUserTransfer->getIdCompanyUser(),
            ShoppingListItemTransfer::FK_SHOPPING_LIST => $this->shoppingListTransfer->getIdShoppingList(),
            ShoppingListItemTransfer::QUANTITY => 1,
            ShoppingListItemTransfer::SKU => $this->productConcreteTransfer->getSku(),
        ]);
    }
}

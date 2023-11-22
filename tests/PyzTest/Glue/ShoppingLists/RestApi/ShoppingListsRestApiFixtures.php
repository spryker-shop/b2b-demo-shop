<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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

    /**
     * @var \Generated\Shared\Transfer\ShoppingListTransfer
     */
    protected ShoppingListTransfer $shoppingListTransfer;

    /**
     * @var \Generated\Shared\Transfer\ShoppingListItemTransfer
     */
    protected ShoppingListItemTransfer $shoppingListItemTransfer;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected ProductConcreteTransfer $productConcreteTransfer;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransfer;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected CompanyUserTransfer $companyUserTransfer;

    /**
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ShoppingListTransfer
     */
    public function getShoppingListTransfer(): ShoppingListTransfer
    {
        return $this->shoppingListTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ShoppingListItemTransfer
     */
    public function getShoppingListItemTransfer(): ShoppingListItemTransfer
    {
        return $this->shoppingListItemTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    /**
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return \SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface
     */
    public function buildFixtures(ShoppingListsApiTester $I): FixturesContainerInterface
    {
        $I->haveCompanyMailConnectorToMailDependency();

        $this->createCustomer($I);
        $this->createShoppingList($I);

        return $this;
    }

    /**
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    protected function createCustomer(ShoppingListsApiTester $I): void
    {
        $this->createCustomerWithCompanyUser($I);
        $I->confirmCustomer($this->customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    protected function createCustomerWithCompanyUser(ShoppingListsApiTester $I): void
    {
        $this->customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->companyUserTransfer = $this->createCompanyUser($I, $this->customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
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

    /**
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
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

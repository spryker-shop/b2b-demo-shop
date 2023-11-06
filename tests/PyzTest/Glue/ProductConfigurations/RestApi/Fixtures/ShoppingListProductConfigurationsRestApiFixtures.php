<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\ProductConfigurations\RestApi\Fixtures;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\ProductConfigurationTransfer;
use Generated\Shared\Transfer\ShoppingListItemTransfer;
use Generated\Shared\Transfer\ShoppingListTransfer;
use PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class ShoppingListProductConfigurationsRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    /**
     * @var array<string, mixed>
     */
    public const PRODUCT_CONFIGURATION_SHOPPING_LIST_ITEM_DATA = [
        'displayData' => '{"Preferred time of the day": "Afternoon", "Date": "9.09.2020"}',
        'configuration' => '{"time_of_day": "2"}',
        'configuratorKey' => 'installation_appointment',
        'isComplete' => false,
        'quantity' => 5,
        'availableQuantity' => 100,
        'prices' => [
            [
                'priceTypeName' => 'DEFAULT',
                'netAmount' => 23434,
                'grossAmount' => 42502,
                'currency' => [
                    'code' => 'EUR',
                    'name' => 'Euro',
                    'symbol' => '€',
                ],
                'volumePrices' => [
                    [
                        'netAmount' => 150,
                        'grossAmount' => 165,
                        'quantity' => 5,
                    ],
                    [
                        'netAmount' => 145,
                        'grossAmount' => 158,
                        'quantity' => 10,
                    ],
                    [
                        'netAmount' => 140,
                        'grossAmount' => 152,
                        'quantity' => 20,
                    ],
                ],
            ],
        ],
    ];

    /**
     * @var string
     */
    protected const TEST_PASSWORD = 'change123';

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected ProductConcreteTransfer $productConcreteTransfer;

    /**
     * @var \Generated\Shared\Transfer\ProductConfigurationTransfer
     */
    protected ProductConfigurationTransfer $productConfigurationTransfer;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransfer;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected CompanyUserTransfer $companyUserTransfer;

    /**
     * @var \Generated\Shared\Transfer\ShoppingListTransfer
     */
    protected ShoppingListTransfer $shoppingListTransfer;

    /**
     * @var \Generated\Shared\Transfer\ShoppingListItemTransfer
     */
    protected ShoppingListItemTransfer $shoppingListItemTransfer;

    /**
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ShoppingListTransfer
     */
    public function getShoppingList(): ShoppingListTransfer
    {
        return $this->shoppingListTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ShoppingListItemTransfer
     */
    public function getShoppingListItem(): ShoppingListItemTransfer
    {
        return $this->shoppingListItemTransfer;
    }

    /**
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return \SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface
     */
    public function buildFixtures(ProductConfigurationsApiTester $I): FixturesContainerInterface
    {
        $I->haveCompanyMailConnectorToMailDependency();

        $this->createProductConcrete($I);
        $this->createProductConfiguration($I);
        $this->createCustomer($I);
        $this->createShoppingList($I);

        return $this;
    }

    /**
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    protected function createProductConcrete(ProductConfigurationsApiTester $I): void
    {
        $this->productConcreteTransfer = $I->haveFullProduct();
    }

    /**
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    protected function createProductConfiguration(ProductConfigurationsApiTester $I): void
    {
        $this->productConfigurationTransfer = $I->haveProductConfigurationTransferPersisted([
            ProductConfigurationTransfer::FK_PRODUCT => $this->productConcreteTransfer->getIdProductConcrete(),
        ]);
    }

    /**
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    protected function createCustomer(ProductConfigurationsApiTester $I): void
    {
        $this->createCustomerWithCompanyUser($I);
        $I->confirmCustomer($this->customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    protected function createCustomerWithCompanyUser(ProductConfigurationsApiTester $I): void
    {
        $this->customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->companyUserTransfer = $this->createCompanyUser($I, $this->customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param array<string, mixed> $seed
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function createCompanyUser(
        ProductConfigurationsApiTester $I,
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
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    protected function createShoppingList(ProductConfigurationsApiTester $I): void
    {
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

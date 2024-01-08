<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\Checkout\RestApi\Fixtures;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use PyzTest\Glue\Checkout\CheckoutApiTester;
use Spryker\Zed\Company\CompanyDependencyProvider;
use SprykerTest\Shared\Shipment\Helper\ShipmentMethodDataHelper;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class CompanyBusinessUnitAddressCheckoutDataRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    /**
     * @var string
     */
    protected const TEST_USERNAME = 'CompanyBUAddressCheckoutDataRestApiFixtures';

    /**
     * @var string
     */
    protected const TEST_PASSWORD = 'change123';

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransfer;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer
     */
    protected QuoteTransfer $quoteTransfer;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected CompanyUserTransfer $companyUserTransfer;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected CompanyUnitAddressTransfer $companyUnitAddressTransfer;

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getQuoteTransfer(): QuoteTransfer
    {
        return $this->quoteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function getCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->companyUserTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function getCompanyUnitAddressTransfer(): CompanyUnitAddressTransfer
    {
        return $this->companyUnitAddressTransfer;
    }

    /**
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return \SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface
     */
    public function buildFixtures(CheckoutApiTester $I): FixturesContainerInterface
    {
        $I->truncateSalesOrderThresholds();

        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::USERNAME => static::TEST_USERNAME,
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->customerTransfer = $I->confirmCustomer($customerTransfer);
        $this->buildCompanyUserAccount($I, $this->customerTransfer);

        $this->quoteTransfer = $this->createPersistentQuoteWithItemsAndItemLevelShipment($I);

        return $this;
    }

    /**
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    protected function buildCompanyUserAccount(
        CheckoutApiTester $I,
        CustomerTransfer $customerTransfer,
    ): void {
        $this->mockCompanyPostSavePlugins($I);

        $companyTransfer = $I->haveActiveCompany([
            CompanyTransfer::STATUS => 'approved',
        ]);

        $this->companyUnitAddressTransfer = $I->haveCompanyUnitAddress([
            CompanyUnitAddressTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
        ]);

        $companyBusinessUnitTransfer = $I->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyBusinessUnitTransfer::ADDRESS_COLLECTION => (new CompanyUnitAddressCollectionTransfer())
                ->addCompanyUnitAddress($this->companyUnitAddressTransfer),
        ]);

        $I->haveCompanyUnitAddressToCompanyBusinessUnitRelation($companyBusinessUnitTransfer);

        $this->companyUserTransfer = $I->haveCompanyUser([
            CompanyUserTransfer::CUSTOMER => $customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);
    }

    /**
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function createPersistentQuoteWithItemsAndItemLevelShipment(CheckoutApiTester $I): QuoteTransfer
    {
        $shipmentMethodTransfer = $I->haveShipmentMethod(
            [
                ShipmentMethodTransfer::CARRIER_NAME => 'Spryker Dummy Shipment',
                ShipmentMethodTransfer::NAME => 'Standard',
            ],
            [],
            ShipmentMethodDataHelper::DEFAULT_PRICE_LIST,
            [
                $I->getStoreFacade()->getCurrentStore()->getIdStore(),
            ],
        );

        return $I->havePersistentQuoteWithItemsAndItemLevelShipment(
            $this->customerTransfer,
            [$I->getQuoteItemOverrideData($I->haveProductWithStock(), $shipmentMethodTransfer, 5)],
        );
    }

    /**
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    protected function mockCompanyPostSavePlugins(CheckoutApiTester $I): void
    {
        $I->setDependency(CompanyDependencyProvider::COMPANY_POST_SAVE_PLUGINS, []);
    }
}

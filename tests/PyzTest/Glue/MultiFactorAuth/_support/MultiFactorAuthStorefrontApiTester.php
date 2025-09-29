<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\MultiFactorAuth;

use Generated\Shared\Transfer\CustomerTransfer;
use Orm\Zed\MultiFactorAuth\Persistence\Map\SpyCustomerMultiFactorAuthCodesTableMap;
use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery;
use SprykerTest\Glue\Testify\Tester\StorefrontApiEndToEndTester;

/**
 * Inherited Methods
 *
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
 */
class MultiFactorAuthStorefrontApiTester extends StorefrontApiEndToEndTester
{
    use _generated\MultiFactorAuthStorefrontApiTesterActions;

    protected const TEST_PASSWORD = 'Change!23456';

    public function authorizeCustomerToStorefrontApi(CustomerTransfer $customerTransfer): void
    {
        $oauthResponseTransfer = $this->havePasswordAuthorizationToStorefrontApi($customerTransfer);
        $this->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
    }

    public function createCustomer(string $customerName): CustomerTransfer
    {
        $customerTransfer = $this->haveCustomer([
            CustomerTransfer::USERNAME => $customerName,
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::EMAIL => $customerName,
        ]);

        $this->confirmCustomer($customerTransfer);

        return $customerTransfer->setPassword(static::TEST_PASSWORD);
    }

    public function getCustomerMultiFactorAuthCodeFromDatabase(CustomerTransfer $customerTransfer, string $mfaType): ?string
    {
        $customerMultiFactorAuthCodeEntity = (new SpyCustomerMultiFactorAuthCodesQuery())
            ->innerJoinSpyCustomerMultiFactorAuth()
            ->useSpyCustomerMultiFactorAuthQuery()
            ->filterByType($mfaType);

        /** @var \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodes|null $customerMultiFactorAuthCodeEntity */
        $customerMultiFactorAuthCodeEntity = $customerMultiFactorAuthCodeEntity->filterByFkCustomer($customerTransfer->getIdCustomer())
            ->addDescendingOrderByColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE)
            ->endUse()
            ->findOne();

        return $customerMultiFactorAuthCodeEntity?->getCode();
    }
}

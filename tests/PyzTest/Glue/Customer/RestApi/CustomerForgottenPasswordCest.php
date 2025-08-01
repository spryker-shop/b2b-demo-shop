<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\Customer\RestApi;

use Codeception\Example;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCustomerForgottenPasswordAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use PyzTest\Glue\Customer\CustomerApiTester;
use Spryker\Glue\CustomersRestApi\CustomersRestApiConfig;
use Spryker\Glue\RestRequestValidator\RestRequestValidatorConfig;
use Symfony\Component\HttpFoundation\Response;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group Customer
 * @group RestApi
 * @group CustomerForgottenPasswordCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CustomerForgottenPasswordCest
{
    /**
     * @var \PyzTest\Glue\Customer\RestApi\CustomerRestApiFixtures
     */
    protected CustomerRestApiFixtures $fixtures;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransfer;

    /**
     * @param \PyzTest\Glue\Customer\CustomerApiTester $I
     *
     * @return void
     */
    public function _before(CustomerApiTester $I): void
    {
        /** @var \PyzTest\Glue\Customer\RestApi\CustomerRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(CustomerRestApiFixtures::class);

        $this->fixtures = $fixtures;

        $this->customerTransfer = $I->haveCustomer(
            [
                CustomerTransfer::NEW_PASSWORD => 'change123',
                CustomerTransfer::PASSWORD => 'change123',
                CustomerTransfer::RESTORE_PASSWORD_KEY => uniqid(),
            ],
        );
        $I->confirmCustomer($this->customerTransfer);
    }

    /**
     * @dataProvider requestPostCustomerForgottenPasswordFailsValidationDataProvider
     *
     * @param \PyzTest\Glue\Customer\CustomerApiTester $I
     * @param \Codeception\Example $example
     *
     * @return void
     */
    public function requestPostCustomerForgottenPasswordFailsValidation(CustomerApiTester $I, Example $example): void
    {
        // Act
        $I->sendPost(
            $I->formatUrl(CustomersRestApiConfig::RESOURCE_FORGOTTEN_PASSWORD),
            [
                'data' => [
                    'type' => CustomersRestApiConfig::RESOURCE_FORGOTTEN_PASSWORD,
                    'attributes' => $example['attributes'],
                ],
            ],
        );

        // Assert
        $I->seeResponseCodeIs($example[RestErrorMessageTransfer::STATUS]);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        foreach ($example['errors'] as $index => $error) {
            $I->seeResponseErrorsHaveCode($error[RestErrorMessageTransfer::CODE], (string)$index);
            $I->seeResponseErrorsHaveStatus($error[RestErrorMessageTransfer::STATUS], (string)$index);
            $I->seeResponseErrorsHaveDetail($error[RestErrorMessageTransfer::DETAIL], (string)$index);
        }
    }

    /**
     * @return array
     */
    protected function requestPostCustomerForgottenPasswordFailsValidationDataProvider(): array
    {
        return [
            [
                'attributes' => [
                    RestCustomerForgottenPasswordAttributesTransfer::EMAIL => '',
                ],
                RestErrorMessageTransfer::STATUS => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => [
                    [
                        RestErrorMessageTransfer::CODE => RestRequestValidatorConfig::RESPONSE_CODE_REQUEST_INVALID,
                        RestErrorMessageTransfer::STATUS => Response::HTTP_UNPROCESSABLE_ENTITY,
                        RestErrorMessageTransfer::DETAIL => 'email => This value should not be blank.',
                    ],
                ],
            ],
        ];
    }
}

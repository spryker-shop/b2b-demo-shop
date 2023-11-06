<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\ProductConfigurations\RestApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester;
use PyzTest\Glue\ProductConfigurations\RestApi\Fixtures\ShoppingListProductConfigurationsRestApiFixtures;
use Spryker\Glue\ShoppingListsRestApi\ShoppingListsRestApiConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group ProductConfigurations
 * @group RestApi
 * @group ShoppingListProductConfigurationRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class ShoppingListProductConfigurationRestApiCest
{
    /**
     * @var \PyzTest\Glue\ProductConfigurations\RestApi\Fixtures\ShoppingListProductConfigurationsRestApiFixtures
     */
    protected ShoppingListProductConfigurationsRestApiFixtures $fixtures;

    /**
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    public function loadFixtures(ProductConfigurationsApiTester $I): void
    {
        /** @var \PyzTest\Glue\ProductConfigurations\RestApi\Fixtures\ShoppingListProductConfigurationsRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(ShoppingListProductConfigurationsRestApiFixtures::class);

        $this->fixtures = $fixtures;
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    public function requestUpdateConfigurableShoppingListItemsInShoppingList(ProductConfigurationsApiTester $I): void
    {
        // Arrange
        $I->amAuthorizedCustomer($this->fixtures->getCustomerTransfer());

        // Act
        $I->sendPatch(
            $I->formatUrl(
                '{resourceShoppingLists}/{shoppingListUuid}/{resourceShoppingListItems}/{shoppingListItemUuid}',
                [
                    'resourceShoppingLists' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
                    'shoppingListUuid' => $this->fixtures->getShoppingList()->getUuid(),
                    'resourceShoppingListItems' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                    'shoppingListItemUuid' => $this->fixtures->getShoppingListItem()->getUuid(),
                ],
            ),
            [
                'data' => [
                    'type' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                    'attributes' => [
                        'sku' => $this->fixtures->getProductConcreteTransfer()->getSku(),
                        'quantity' => 1,
                        'productConfigurationInstance' => $this->fixtures::PRODUCT_CONFIGURATION_SHOPPING_LIST_ITEM_DATA,
                    ],
                ],
            ],
        );

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('Returned resource contains `productConfiguration` attribute')
            ->whenI()
            ->seeSingleResourceHasAttribute('productConfigurationInstance');
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    public function requestCleanUpConfigurableShoppingListItemsInShoppingList(ProductConfigurationsApiTester $I): void
    {
        // Arrange
        $I->amAuthorizedCustomer($this->fixtures->getCustomerTransfer());

        // Act
        $I->sendPatch(
            $I->formatUrl(
                '{resourceShoppingLists}/{shoppingListUuid}/{resourceShoppingListItems}/{shoppingListItemUuid}',
                [
                    'resourceShoppingLists' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
                    'shoppingListUuid' => $this->fixtures->getShoppingList()->getUuid(),
                    'resourceShoppingListItems' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                    'shoppingListItemUuid' => $this->fixtures->getShoppingListItem()->getUuid(),
                ],
            ),
            [
                'data' => [
                    'type' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                    'attributes' => [
                        'sku' => $this->fixtures->getProductConcreteTransfer()->getSku(),
                        'quantity' => 1,
                        'productConfigurationInstance' => null,
                    ],
                ],
            ],
        );

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseMatchesOpenApiSchema();

        $I->assertNull($I->grabDataFromResponseByJsonPath('$.data.attributes.productConfigurationInstance')[0]);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ProductConfigurations\ProductConfigurationsApiTester $I
     *
     * @return void
     */
    public function requestAddConfigurableShoppingListItemsToShoppingList(ProductConfigurationsApiTester $I): void
    {
        // Arrange
        $I->amAuthorizedCustomer($this->fixtures->getCustomerTransfer());

        // Act
        $I->sendPOST(
            $I->formatUrl(
                '{resourceShoppingLists}/{shoppingListUuid}/{resourceShoppingListItems}?include={resourceShoppingListItems}',
                [
                    'resourceShoppingLists' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
                    'shoppingListUuid' => $this->fixtures->getShoppingList()->getUuid(),
                    'resourceShoppingListItems' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                ],
            ),
            [
                'data' => [
                    'type' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                    'attributes' => [
                        'sku' => $this->fixtures->getProductConcreteTransfer()->getSku(),
                        'quantity' => 1,
                        'productConfigurationInstance' => $this->fixtures::PRODUCT_CONFIGURATION_SHOPPING_LIST_ITEM_DATA,
                    ],
                ],
            ],
        );

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('Returned resource contains `productConfiguration` attribute')
            ->whenI()
            ->seeSingleResourceHasAttribute('productConfigurationInstance');
    }
}

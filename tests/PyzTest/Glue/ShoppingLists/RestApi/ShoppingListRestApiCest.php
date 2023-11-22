<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\ShoppingLists\RestApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\ShoppingLists\ShoppingListsApiTester;
use Spryker\Glue\ProductsRestApi\ProductsRestApiConfig;
use Spryker\Glue\ShoppingListsRestApi\ShoppingListsRestApiConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group ShoppingLists
 * @group RestApi
 * @group ShoppingListRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class ShoppingListRestApiCest
{
    /**
     * @var \PyzTest\Glue\ShoppingLists\RestApi\ShoppingListsRestApiFixtures
     */
    protected ShoppingListsRestApiFixtures $fixtures;

    /**
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    public function loadFixtures(ShoppingListsApiTester $I): void
    {
        /** @var \PyzTest\Glue\ShoppingLists\RestApi\ShoppingListsRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(ShoppingListsRestApiFixtures::class);

        $this->fixtures = $fixtures;
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    public function requestShoppingListByUuid(ShoppingListsApiTester $I): void
    {
        // Arrange
        $oauthResponseTransfer = $I->haveAuthorizationToGlue($this->fixtures->getCustomerTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());

        $url = $I->buildShoppingListUrl($this->fixtures->getShoppingListTransfer()->getUuid());

        // Act
        $I->sendGET($url);

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsSingleResourceOfType(ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS);

        $I->amSure('returned resource has correct id')
            ->whenI()
            ->seeSingleResourceIdEqualTo($this->fixtures->getShoppingListTransfer()->getUuid());

        $I->amSure('returned resource has correct self-link')
            ->whenI()
            ->seeSingleResourceHasSelfLink($url);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    public function requestShoppingLists(ShoppingListsApiTester $I): void
    {
        $oauthResponseTransfer = $I->haveAuthorizationToGlue($this->fixtures->getCustomerTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
        $shoppingListUuid = $this->fixtures->getShoppingListTransfer()->getUuid();

        // Act
        $I->sendGET($I->buildShoppingListsUrl());

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('Response data contains resource collection')
            ->whenI()
            ->seeResponseDataContainsResourceCollectionOfType(ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS);

        $I->amSure('Resource collection has resource')
            ->whenI()
            ->seeResourceCollectionHasResourceWithId($shoppingListUuid);

        $I->amSure('Resource has correct self-link')
            ->whenI()
            ->seeResourceByIdHasSelfLink($shoppingListUuid, $I->buildShoppingListUrl($shoppingListUuid));
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    public function requestShoppingListByUuidWithShoppingListItemsRelationship(ShoppingListsApiTester $I): void
    {
        // Arrange
        $shoppingListUuid = $this->fixtures->getShoppingListTransfer()->getUuid();
        $shoppingListItemUuid = $this->fixtures->getShoppingListItemTransfer()->getUuid();
        $oauthResponseTransfer = $I->haveAuthorizationToGlue($this->fixtures->getCustomerTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
        $url = $I->buildShoppingListUrl(
            $shoppingListUuid,
            [
                ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
            ],
        );

        // Act
        $I->sendGET($url);

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('returned resource has relationship')
            ->whenI()
            ->seeSingleResourceHasRelationshipByTypeAndId(
                ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                $shoppingListItemUuid,
            );

        $I->amSure('returned resource has include')
            ->whenI()
            ->seeIncludesContainsResourceByTypeAndId(
                ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                $shoppingListItemUuid,
            );

        $I->amSure('include has correct self-link')
            ->whenI()
            ->seeIncludedResourceByTypeAndIdHasSelfLink(
                ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                $shoppingListItemUuid,
                $I->buildShoppingListItemUrl($shoppingListUuid, $shoppingListItemUuid),
            );
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    public function requestShoppingListByUuidWithProductConcreteRelationship(ShoppingListsApiTester $I): void
    {
        // Arrange
        $productConcreteSku = $this->fixtures->getProductConcreteTransfer()->getSku();
        $shoppingListItemUuid = $this->fixtures->getShoppingListItemTransfer()->getUuid();
        $oauthResponseTransfer = $I->haveAuthorizationToGlue($this->fixtures->getCustomerTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
        $url = $I->buildShoppingListUrl(
            $this->fixtures->getShoppingListTransfer()->getUuid(),
            [
                ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                ProductsRestApiConfig::RESOURCE_CONCRETE_PRODUCTS,
            ],
        );

        // Act
        $I->sendGET($url);

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('included resource has a relationship')
            ->whenI()
            ->seeIncludedResourceByTypeAndIdHasRelationshipByTypeAndId(
                ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                $shoppingListItemUuid,
                ProductsRestApiConfig::RESOURCE_CONCRETE_PRODUCTS,
                $productConcreteSku,
            );

        $I->amSure('returned resource has include')
            ->whenI()
            ->seeIncludesContainsResourceByTypeAndId(
                ProductsRestApiConfig::RESOURCE_CONCRETE_PRODUCTS,
                $productConcreteSku,
            );

        $I->amSure('include has correct self-link')
            ->whenI()
            ->seeIncludedResourceByTypeAndIdHasSelfLink(
                ProductsRestApiConfig::RESOURCE_CONCRETE_PRODUCTS,
                $productConcreteSku,
                $I->buildProductConcreteUrl($productConcreteSku),
            );
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\ShoppingLists\ShoppingListsApiTester $I
     *
     * @return void
     */
    public function requestShoppingListByNotExistingShoppingListUuid(ShoppingListsApiTester $I): void
    {
        // Arrange
        $oauthResponseTransfer = $I->haveAuthorizationToGlue($this->fixtures->getCustomerTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());

        // Act
        $I->sendGET($I->buildShoppingListUrl('NotExistingUuid'));

        // Assert
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();
    }
}

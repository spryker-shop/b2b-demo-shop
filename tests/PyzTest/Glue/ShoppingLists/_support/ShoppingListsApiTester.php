<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\ShoppingLists;

use Spryker\Glue\GlueApplication\Rest\RequestConstantsInterface;
use Spryker\Glue\ProductsRestApi\ProductsRestApiConfig;
use Spryker\Glue\ShoppingListsRestApi\ShoppingListsRestApiConfig;
use SprykerTest\Glue\Testify\Tester\ApiEndToEndTester;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(\PyzTest\Glue\ShoppingLists\PHPMD)
 */
class ShoppingListsApiTester extends ApiEndToEndTester
{
    use _generated\ShoppingListsApiTesterActions;

    /**
     * @param array<string> $includes
     *
     * @return string
     */
    public function formatQueryInclude(array $includes = []): string
    {
        if (!$includes) {
            return '';
        }

        return sprintf('?%s=%s', RequestConstantsInterface::QUERY_INCLUDE, implode(',', $includes));
    }

    /**
     * @param array<string> $includes
     *
     * @return string
     */
    public function buildShoppingListsUrl(array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceShoppingLists}' . $this->formatQueryInclude($includes),
            [
                'resourceShoppingLists' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
            ],
        );
    }

    /**
     * @param string $shoppingListUuid
     * @param array<string> $includes
     *
     * @return string
     */
    public function buildShoppingListUrl(string $shoppingListUuid, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceShoppingLists}/{shoppingListUuid}' . $this->formatQueryInclude($includes),
            [
                'resourceShoppingLists' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
                'shoppingListUuid' => $shoppingListUuid,
            ],
        );
    }

    /**
     * @param string $shoppingListUuid
     * @param string $shoppingListItemUuid
     * @param array<string> $includes
     *
     * @return string
     */
    public function buildShoppingListItemUrl(string $shoppingListUuid, string $shoppingListItemUuid, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceShoppingLists}/{shoppingListUuid}/{resourceShoppingListItems}/{shoppingListItemUuid}' . $this->formatQueryInclude($includes),
            [
                'resourceShoppingLists' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LISTS,
                'shoppingListUuid' => $shoppingListUuid,
                'resourceShoppingListItems' => ShoppingListsRestApiConfig::RESOURCE_SHOPPING_LIST_ITEMS,
                'shoppingListItemUuid' => $shoppingListItemUuid,
            ],
        );
    }

    /**
     * @param string $productConcreteSku
     * @param array<string> $includes
     *
     * @return string
     */
    public function buildProductConcreteUrl(string $productConcreteSku, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceConcreteProducts}/{productConcreteSku}' . $this->formatQueryInclude($includes),
            [
                'resourceConcreteProducts' => ProductsRestApiConfig::RESOURCE_CONCRETE_PRODUCTS,
                'productConcreteSku' => $productConcreteSku,
            ],
        );
    }
}

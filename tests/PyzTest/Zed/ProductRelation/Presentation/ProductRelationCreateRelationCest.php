<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\ProductRelation\Presentation;

use PyzTest\Zed\ProductRelation\PageObject\ProductRelationCreatePage;
use PyzTest\Zed\ProductRelation\ProductRelationPresentationTester;
use Spryker\Shared\ProductRelation\ProductRelationTypes;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group ProductRelation
 * @group Presentation
 * @group ProductRelationCreateRelationCest
 * Add your own group annotations below this line
 */
class ProductRelationCreateRelationCest
{
    /**
     * @param \PyzTest\Zed\ProductRelation\ProductRelationPresentationTester $i
     *
     * @return void
     */
    public function testICanCreateProductRelationAndSeeInYves(ProductRelationPresentationTester $i): void
    {
        $i->wantTo('I want to create up selling relation');
        $i->expect('relation is persisted, exported to yves and carousel component is visible');

        $i->amLoggedInUser();

        $i->amOnPage(ProductRelationCreatePage::URL);

        $i->fillField('//*[@id="product_relation_productRelationKey"]', uniqid('key-', false));
        $i->filterProductsByName(ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_1_NAME);
        $i->wait(5);
        $i->selectProduct(ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_1_SKU);

        $i->selectRelationType(ProductRelationTypes::TYPE_RELATED_PRODUCTS);
        $i->switchToAssignProductsTab();

        $i->selectProductRule(
            ProductRelationCreatePage::PRODUCT_RULE_NAME,
            ProductRelationCreatePage::PRODUCT_RULE_OPERATOR,
            ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_2_SKU
        );

        $i->clickSaveButton();
        $i->see(ProductRelationCreatePage::MESSAGE_SUCCESS_PRODUCT_RELATION_CREATED);

        // TODO re-enable
        //$i->runCollectors();
        //$i->wait(5);

        //$i->amYves();
        //$i->amOnPage('/en/samsung-bundle-214');
        //$i->canSee('Similar products');
        //$i->canSee('HP EliteDesk 800 G2');
    }
}

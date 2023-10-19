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

        $i->waitForElement(ProductRelationPresentationTester::PRODUCT_RELATION_KEY_FIELD_SELECTOR);
        $key = uniqid('key-', false);
        $i->fillField(ProductRelationPresentationTester::PRODUCT_RELATION_KEY_FIELD_SELECTOR, $key);

        $i->selectRelationType(ProductRelationTypes::TYPE_RELATED_PRODUCTS);
        $i->filterProductsByName(ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_1_NAME);
        $i->selectProduct(ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_1_SKU);

        $i->switchToAssignProductsTab();

        $i->selectProductRule(
            ProductRelationCreatePage::PRODUCT_RULE_NAME,
            ProductRelationCreatePage::PRODUCT_RULE_OPERATOR,
            ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_2_SKU,
        );

        $i->clickSaveButton();

        $i->waitForText(sprintf('%s %s', ProductRelationCreatePage::EDIT_PRODUCT_RELATION_TEXT, $key), 20);
        $i->seeInPageSource(sprintf('%s %s', ProductRelationCreatePage::EDIT_PRODUCT_RELATION_TEXT, $key));

        $i->cleanUpProductRelation($key);
    }
}

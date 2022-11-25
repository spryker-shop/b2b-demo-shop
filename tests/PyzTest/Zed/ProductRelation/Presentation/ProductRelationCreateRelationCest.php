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
     * @skip
     *
     * @TODO Fix failing test for MariaDB/PostgreSQL Acceptance jobs (#18,19)
     *
     * @param \PyzTest\Zed\ProductRelation\ProductRelationPresentationTester $i
     *
     * @return void
     */
    public function testICanCreateProductRelationAndSeeInYves(ProductRelationPresentationTester $i): void
    {
        $i->wantTo('I want to create up selling relation');
        $i->expect('relation is persisted, exported to yves and carousel component is visible');

        $i->amOnPage(ProductRelationCreatePage::URL);

        $i->waitForElement('//*[@id="product_relation_productRelationKey"]');
        $key = uniqid('key-', false);
        $i->fillField('//*[@id="product_relation_productRelationKey"]', $key);
        $i->filterProductsByName(ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_1_NAME);

        $i->waitForProcessingIsDone();

        $i->selectProduct(ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_1_SKU);

        $i->selectRelationType(ProductRelationTypes::TYPE_RELATED_PRODUCTS);
        $i->switchToAssignProductsTab();

        $i->selectProductRule(
            ProductRelationCreatePage::PRODUCT_RULE_NAME,
            ProductRelationCreatePage::PRODUCT_RULE_OPERATOR,
            ProductRelationCreatePage::PRODUCT_RELATION_PRODUCT_2_SKU
        );

        $i->clickSaveButton();
        $i->waitForProcessingIsDone();
        $i->seeInPageSource(sprintf('%s %s', ProductRelationCreatePage::EDIT_PRODUCT_RELATION_TEXT, $key));
    }
}

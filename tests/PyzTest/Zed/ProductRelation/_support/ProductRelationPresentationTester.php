<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\ProductRelation;

use Codeception\Actor;
use Codeception\Scenario;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelation;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery;

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
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(\PyzTest\Zed\ProductRelation\PHPMD)
 */
class ProductRelationPresentationTester extends Actor
{
    use _generated\ProductRelationPresentationTesterActions;

    /**
     * @var int
     */
    public const ELEMENT_TIMEOUT = 45;

    /**
     * @var string
     */
    public const PRODUCT_RELATION_TYPE_SELECTOR = '//*[@id="product_relation_productRelationType"]';

    /**
     * @var string
     */
    public const PRODUCT_TABLE_FILTER_LABEL_INPUT_SELECTOR = '//*[@id="product-table_filter"]/label/input';

    /**
     * @var string
     */
    public const PRODUCT_TAB_SELECTOR = '//*[@id="form-product-relation"]/div/ul/li[2]/a';

    /**
     * @var string
     */
    public const SUBMIT_RELATION_BUTTON_SELECTOR = '//*[@id="submit-relation"]';

    /**
     * @var string
     */
    public const ACTIVATE_RELATION_BUTTON_SELECTOR = '//*[@id="activate-relation"]';

    /**
     * @var string
     */
    public const PRODUCT_RELATION_KEY_FIELD_SELECTOR = '//*[@id="product_relation_productRelationKey"]';

    /**
     * @var string
     */
    public const PRODUCT_TABLE_BODY_XPATH = '//*[@class="dataTables_scrollBody"]/table/tbody/tr[1]/td[1]';

    /**
     * @var int
     */
    protected $numberOfRulesSelected = 0;

    /**
     * @param \Codeception\Scenario $scenario
     */
    public function __construct(Scenario $scenario)
    {
        parent::__construct($scenario);

        $this->amZed();
        $this->amLoggedInUser();
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function selectRelationType($type)
    {
        $this->waitForElement(static::PRODUCT_RELATION_TYPE_SELECTOR, static::ELEMENT_TIMEOUT);
        $this->selectOption(static::PRODUCT_RELATION_TYPE_SELECTOR, $type);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function filterProductsByName($name)
    {
        $this->waitForElement(static::PRODUCT_TABLE_BODY_XPATH, static::ELEMENT_TIMEOUT);
        $this->fillField(static::PRODUCT_TABLE_FILTER_LABEL_INPUT_SELECTOR, $name);

        return $this;
    }

    /**
     * @param string $sku
     *
     * @return $this
     */
    public function selectProduct($sku)
    {
        $this->waitForElement(static::PRODUCT_TABLE_BODY_XPATH, static::ELEMENT_TIMEOUT);
        $buttonElementId = sprintf('//*[@id="select-product-%s"]', $sku);

        $this->waitForElementNotVisible('//*[@id="product-table_processing"]', static::ELEMENT_TIMEOUT);
        $this->waitForElement($buttonElementId, static::ELEMENT_TIMEOUT);

        $this->click($buttonElementId);

        return $this;
    }

    /**
     * @return $this
     */
    public function switchToAssignProductsTab()
    {
        $this->waitForElement(static::PRODUCT_TAB_SELECTOR, static::ELEMENT_TIMEOUT);
        $this->click(static::PRODUCT_TAB_SELECTOR);

        return $this;
    }

    /**
     * @param string $ruleName
     * @param string $operator
     * @param string $value
     *
     * @return $this
     */
    public function selectProductRule($ruleName, $operator, $value)
    {
        $ruleSelectorBaseId = sprintf('[@id="builder_rule_%d"]', $this->numberOfRulesSelected);

        $this->selectOption(sprintf('//*%s/div[3]/select', $ruleSelectorBaseId), $ruleName);
        $this->selectOption(sprintf('//*%s/div[4]/select', $ruleSelectorBaseId), $operator);
        $this->fillField(sprintf('//*%s/div[5]/input', $ruleSelectorBaseId), $value);

        $this->numberOfRulesSelected++;

        return $this;
    }

    /**
     * @return $this
     */
    public function clickSaveButton()
    {
        $this->waitForElement(static::SUBMIT_RELATION_BUTTON_SELECTOR, static::ELEMENT_TIMEOUT);
        $this->click(static::SUBMIT_RELATION_BUTTON_SELECTOR);

        return $this;
    }

    /**
     * @return $this
     */
    public function activateRelation()
    {
        $this->waitForElement(static::ACTIVATE_RELATION_BUTTON_SELECTOR, static::ELEMENT_TIMEOUT);
        $this->click(static::ACTIVATE_RELATION_BUTTON_SELECTOR);

        return $this;
    }

    /**
     * @param string $productRelationKey
     *
     * @return void
     */
    public function cleanUpProductRelation(string $productRelationKey): void
    {
        $productRelationEntity = $this->findProductRelationByProductRelationKey($productRelationKey);
        if (!$productRelationEntity) {
            return;
        }

        $productRelationEntity->getSpyProductRelationProductAbstracts()->delete();
        $productRelationEntity->delete();
    }

    /**
     * @param string $productRelationKey
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelation|null
     */
    protected function findProductRelationByProductRelationKey(string $productRelationKey): ?SpyProductRelation
    {
        return SpyProductRelationQuery::create()->findOneByProductRelationKey($productRelationKey);
    }
}

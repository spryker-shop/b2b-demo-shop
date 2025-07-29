<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\PropelOrm\Business;

use Codeception\Test\Unit;
use Exception;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes;
use PyzTest\Zed\PropelOrm\Stub\ProductManagerStub;
use Spryker\Zed\Product\Business\ProductFacade;
use Spryker\Zed\Product\Persistence\ProductQueryContainer;
use Throwable;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group PropelOrm
 * @group Business
 * @group PropelOrmTransactionHandlerTest
 * Add your own group annotations below this line
 */
class PropelOrmTransactionHandlerTest extends Unit
{
    /**
     * @var string
     */
    public const TEST_SKU = 'foo';

    /**
     * @var string
     */
    public const TEST_NAME = 'Foo Bar';

    /**
     * @var \Spryker\Zed\Product\Persistence\ProductQueryContainerInterface
     */
    protected $productQueryContainer;

    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @var \Propel\Runtime\Connection\ConnectionInterface
     */
    protected $outsideConnection;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->productQueryContainer = new ProductQueryContainer();

        $this->productFacade = new ProductFacade();

        $this->outsideConnection = clone $this->productQueryContainer->getConnection();
    }

    /**
     * @return void
     */
    public function testAddProductWithoutTransactionHandling(): void
    {
        self::markTestSkipped();
        $productManager = new ProductManagerStub(
            $this->productQueryContainer,
        );

        $idProductAbstract = $productManager->addProductWithoutTransactionHandling(static::TEST_SKU, static::TEST_NAME);

        $expectedProductAbstract = $this->getProductAbstractToAssert($idProductAbstract);
        $expectedLocalizedAttribute = $this->getLocalizedAttributesToAssert($idProductAbstract);

        $this->assertGreaterThan(0, $idProductAbstract);
        $this->assertNotNull($expectedProductAbstract);
        $this->assertSame($expectedProductAbstract->getSku(), static::TEST_SKU);
        $this->assertSame($expectedLocalizedAttribute->getName(), static::TEST_NAME);
    }

    /**
     * @depends testAddProductWithoutTransactionHandling
     *
     * @return void
     */
    public function testAddProductWithoutTransactionHandlingShouldThrowException(): void
    {
        $productManager = new ProductManagerStub(
            $this->productQueryContainer,
        );

        try {
            $productManager->addProductWithoutTransactionHandlingShouldThrowException(static::TEST_SKU, static::TEST_NAME);
        } catch (Exception $e) {
        } catch (Throwable $e) {
        }

        $this->assertEntityCreatedWithinTransaction();
        $this->assertEntityNotCreatedOutsideTransaction();
    }

    /**
     * @depends testAddProductWithoutTransactionHandling
     *
     * @return void
     */
    public function testAddProductWithTransactionHandlingShouldRollbackAndThrowException(): void
    {
        $productManager = new ProductManagerStub(
            $this->productQueryContainer,
        );

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('DB error occured');

        $productManager->addProductWithTransactionHandlingShouldRollbackAndThrowException(static::TEST_SKU, static::TEST_NAME);
    }

    /**
     * @depends testAddProductWithoutTransactionHandling
     *
     * @return void
     */
    public function testAddProductWithTransactionHandlingShouldCommitAndReturnValue(): void
    {
        $productManager = new ProductManagerStub(
            $this->productQueryContainer,
        );

        $localizedAttributeEntity = $productManager->addProductWithTransactionHandlingShouldCommitAndReturnValue(static::TEST_SKU, static::TEST_NAME);

        $this->assertEntityCreatedWithinTransaction();
        $this->assertSame($localizedAttributeEntity->getName(), static::TEST_NAME);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstract
     */
    protected function getProductAbstractToAssert(int $idProductAbstract): SpyProductAbstract
    {
        return $this->productQueryContainer
            ->queryProductAbstract()
            ->filterByIdProductAbstract($idProductAbstract)
            ->findOne();
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes
     */
    protected function getLocalizedAttributesToAssert(int $idProductAbstract): SpyProductAbstractLocalizedAttributes
    {
        return $this->productQueryContainer
            ->queryProductAbstractLocalizedAttributes($idProductAbstract)
            ->filterByFkLocale(66)
            ->findOne();
    }

    /**
     * @return void
     */
    protected function assertEntityNotCreatedOutsideTransaction(): void
    {
        $this->outsideConnection->forceRollBack();

        $entityToAssert = $this->productQueryContainer
            ->queryProductAbstract()
            ->filterBySku(static::TEST_SKU)
            ->findOne($this->outsideConnection);

        $this->assertNull($entityToAssert);
    }

    /**
     * @return void
     */
    protected function assertEntityNotCreatedWithinTransaction(): void
    {
        $entityToAssert = $this->productQueryContainer
            ->queryProductAbstract()
            ->filterBySku(static::TEST_SKU)
            ->findOne();

        $this->assertNull($entityToAssert);
    }

    /**
     * @return void
     */
    protected function assertEntityCreatedWithinTransaction(): void
    {
        $entityToAssert = $this->productQueryContainer
            ->queryProductAbstract()
            ->filterBySku(static::TEST_SKU)
            ->findOne();

        $this->assertNotNull($entityToAssert);
    }
}

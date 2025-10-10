<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\Urls\RestApi;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\ProductUrlTransfer;
use PyzTest\Glue\Urls\UrlsRestApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group Urls
 * @group RestApi
 * @group UrlsRestApiFixtures
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class UrlsRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected ProductConcreteTransfer $productConcreteTransfer;

    protected ProductUrlTransfer $productUrlTransfer;

    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    public function getProductUrlTransfer(): ProductUrlTransfer
    {
        return $this->productUrlTransfer;
    }

    public function buildFixtures(UrlsRestApiTester $I): FixturesContainerInterface
    {
        $this->createProductConcrete($I);
        $this->createProductUrl($I);

        return $this;
    }

    protected function createProductConcrete(UrlsRestApiTester $I): void
    {
        $this->productConcreteTransfer = $I->haveFullProduct();
    }

    protected function createProductUrl(UrlsRestApiTester $I): void
    {
        $productAbstractTransfer = (new ProductAbstractTransfer())
            ->setIdProductAbstract($this->productConcreteTransfer->getFkProductAbstract());

        $this->productUrlTransfer = $I->getProductFacade()->getProductUrl($productAbstractTransfer);
    }
}

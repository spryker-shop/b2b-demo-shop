<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ExampleProductSalePage\Controller;

use Pyz\Yves\ExampleProductSalePage\Plugin\Provider\ExampleProductSaleControllerProvider;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \Pyz\Yves\ExampleProductSalePage\ExampleProductSalePageFactory getFactory()
 * @method \Pyz\Client\ExampleProductSalePage\ExampleProductSalePageClientInterface getClient()
 */
class SaleController extends AbstractController
{
    /**
     * @param string $categoryPath
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction($categoryPath, Request $request)
    {
        $parameters = $request->query->all();

        $categoryNode = [];
        if ($categoryPath) {
            $categoryNode = $this->findCategoryNode($categoryPath);

            if (!$categoryNode) {
                throw new NotFoundHttpException(sprintf(
                    'Category not found by path %s',
                    $categoryPath
                ));
            }

            $parameters['category'] = $categoryNode['node_id'];
        }

        $searchResults = $this
            ->getClient()
            ->saleSearch($parameters);

        $searchResults['category'] = $categoryNode;
        $searchResults['filterPath'] = ExampleProductSaleControllerProvider::ROUTE_SALE;

        return $this->view($searchResults, $this->getFactory()->getExampleProductSalePageWidgetPlugins());
    }

    /**
     * @param string $categoryPath
     *
     * @return array
     */
    protected function findCategoryNode($categoryPath): ?array
    {
        $categoryPathPrefix = '/' . $this->getFactory()->getStore()->getCurrentLanguage();
        $categoryPath = $categoryPathPrefix . '/' . ltrim($categoryPath, '/');

        $categoryNode = $this->getFactory()
            ->getUrlStorageClient()
            ->matchUrl($categoryPath, $this->getLocale());

        return $categoryNode ? $categoryNode['data'] : [];
    }
}

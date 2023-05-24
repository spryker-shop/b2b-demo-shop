<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ExampleProductSalePage\Controller;

use InvalidArgumentException;
use Pyz\Yves\ExampleProductSalePage\Plugin\Router\ExampleProductSaleRouteProviderPlugin;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Yves\Kernel\View\View;
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
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function indexPyzAction($categoryPath, Request $request): View
    {
        $parameters = $request->query->all();

        $categoryNode = [];
        if ($categoryPath) {
            $categoryNode = $this->getPyzCategoryNode($categoryPath);

            $parameters['category'] = $categoryNode['node_id'];
        }

        $searchResults = $this
            ->getClient()
            ->salePyzSearch($parameters);

        $searchResults['category'] = $categoryNode;
        $searchResults['filterPath'] = ExampleProductSaleRouteProviderPlugin::PYZ_ROUTE_NAME_SALE;
        $searchResults['viewMode'] = $this->getFactory()
            ->getPyzCatalogClient()
            ->getCatalogViewMode($request);

        $numberFormatConfigTransfer = $this->getFactory()
            ->getUtilNumberService()
            ->getNumberFormatConfig(
                $this->getFactory()->getPyzLocaleClient()->getCurrentLocale(),
            );

        return $this->view(
            array_merge($searchResults, [
                'numberFormatConfig' => $numberFormatConfigTransfer->toArray(),
            ]),
            $this->getFactory()->getExampleProductSalePageWidgetPlugins(),
            '@ExampleProductSalePage/views/sale-example/sale-example.twig',
        );
    }

    /**
     * @param string $categoryPath
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return array
     */
    protected function getPyzCategoryNode($categoryPath): array
    {
        $defaultLocale = current($this->getFactory()->getPyzStore()->getAvailableLocaleIsoCodes());
        $categoryPathPrefix = '/' . $this->getLanguageFromLocale($defaultLocale);
        $fullCategoryPath = $categoryPathPrefix . '/' . ltrim($categoryPath, '/');

        $categoryNode = $this->getFactory()
            ->getPyzUrlStorageClient()
            ->matchUrl($fullCategoryPath, $this->getLocale());

        if (!$categoryNode || empty($categoryNode['data'])) {
            throw new NotFoundHttpException(sprintf(
                'Category not found by path %s (full path %s)',
                $categoryPath,
                $fullCategoryPath,
            ));
        }

        return $categoryNode['data'];
    }

    /**
     * @param string $locale
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    protected function getLanguageFromLocale(string $locale): string
    {
        $position = strpos($locale, '_');
        if ($position === false) {
            throw new InvalidArgumentException(sprintf('Invalid format for locale `%s`, expected `xx_YY`.', $locale));
        }

        return substr($locale, 0, $position);
    }
}

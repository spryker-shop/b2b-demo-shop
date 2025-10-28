<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DocumentationGeneratorRestApi\Business;

use Pyz\Zed\DocumentationGeneratorRestApi\Business\Finder\GlueControllerFinder;
use Spryker\Zed\DocumentationGeneratorRestApi\Business\DocumentationGeneratorRestApiBusinessFactory as SprykerDocumentationGeneratorRestApiBusinessFactory;
use Spryker\Zed\DocumentationGeneratorRestApi\Business\Finder\GlueControllerFinderInterface;

/**
 * @method \Pyz\Zed\DocumentationGeneratorRestApi\DocumentationGeneratorRestApiConfig getConfig()
 */
class DocumentationGeneratorRestApiBusinessFactory extends SprykerDocumentationGeneratorRestApiBusinessFactory
{
    public function createGlueControllerFinder(): GlueControllerFinderInterface
    {
        return new GlueControllerFinder(
            $this->getFinder(),
            $this->getTextInflector(),
            $this->getConfig()->getAnnotationSourceDirectories(),
        );
    }
}

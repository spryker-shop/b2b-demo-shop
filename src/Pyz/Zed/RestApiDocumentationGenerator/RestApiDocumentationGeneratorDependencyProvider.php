<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\RestApiDocumentationGenerator;

use Spryker\Glue\GlueApplication\Plugin\Rest\ResourceRelationshipCollectionProviderPlugin;
use Spryker\Glue\GlueApplication\Plugin\Rest\ResourceRoutePluginsProviderPlugin;
use Spryker\Zed\RestApiDocumentationGenerator\RestApiDocumentationGeneratorDependencyProvider as SprykerRestApiDocumentationGeneratorDependencyProvider;

class RestApiDocumentationGeneratorDependencyProvider extends SprykerRestApiDocumentationGeneratorDependencyProvider
{
    /**
     * @return array
     */
    protected function getResourceRoutePluginsProviderPlugins(): array
    {
        return [
            new ResourceRoutePluginsProviderPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getResourceRelationshipsCollectionProviderPlugins(): array
    {
        return [
            new ResourceRelationshipCollectionProviderPlugin(),
        ];
    }
}

<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\GlueApplication;

use Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRelationshipCollectionInterface;
use Spryker\Glue\GlueApplication\GlueApplicationDependencyProvider as SprykerGlueApplicationDependencyProvider;
use Spryker\Glue\GlueApplication\Plugin\Rest\SetStoreCurrentLocaleBeforeActionPlugin;

class GlueApplicationDependencyProvider extends SprykerGlueApplicationDependencyProvider
{
    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRoutePluginInterface[]
     */
    protected function getResourceRoutePlugins(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     *
     * @param \Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRelationshipCollectionInterface $resourceRelationshipCollection
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRelationshipCollectionInterface
     */
    protected function getResourceRelationshipPlugins(
        ResourceRelationshipCollectionInterface $resourceRelationshipCollection
    ): ResourceRelationshipCollectionInterface {

        return $resourceRelationshipCollection;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ValidateRestRequestPluginInterface[]
     */
    protected function getValidateRestRequestPlugins(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\FormatResponseHeadersPluginInterface[]
     */
    protected function getFormatResponseHeadersPlugins(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ControllerBeforeActionPluginInterface[]
     */
    protected function getControllerBeforeActionPlugins(): array
    {
        return [
           new SetStoreCurrentLocaleBeforeActionPlugin(),
        ];
    }
}

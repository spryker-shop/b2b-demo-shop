<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\DocumentationGeneratorOpenApi;

use Spryker\Glue\DocumentationGeneratorOpenApi\DocumentationGeneratorOpenApiConfig as SprykerDocumentationGeneratorOpenApiConfig;

class DocumentationGeneratorOpenApiConfig extends SprykerDocumentationGeneratorOpenApiConfig
{
    /**
     * @project Only needed in Project, not in demoshop
     *
     * @var string
     */
    protected const NON_SPLIT_APPLICATION_CORE_ANNOTATION_SOURCE_DIRECTORY_CONTROLLER_PATTERN = '/*/*/*/*/src/*/Glue/%1$s/Controller/';

    /**
     * @project Only needed in Project, not in demoshop
     *
     * @var string
     */
    protected const NON_SPLIT_APPLICATION_CORE_ANNOTATION_SOURCE_DIRECTORY_PLUGIN_PATTERN = '/*/*/*/*/src/*/Glue/%1$s/Plugin/';

    /**
     * @project Only needed in Project, not in demoshop
     *
     * @api
     *
     * @return array<string>
     */
    public function getAnnotationSourceDirectories(): array
    {
        return array_merge(
            parent::getAnnotationSourceDirectories(),
            $this->getNonSplitCoreAnnotationSourceDirectoryPatterns(),
        );
    }

    /**
     * @project Only needed in Project, not in demoshop
     *
     * @return array<string>
     */
    protected function getNonSplitCoreAnnotationSourceDirectoryPatterns(): array
    {
        return [
            APPLICATION_VENDOR_DIR . static::NON_SPLIT_APPLICATION_CORE_ANNOTATION_SOURCE_DIRECTORY_CONTROLLER_PATTERN,
            APPLICATION_VENDOR_DIR . static::NON_SPLIT_APPLICATION_CORE_ANNOTATION_SOURCE_DIRECTORY_PLUGIN_PATTERN,
        ];
    }
}

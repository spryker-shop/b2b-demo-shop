<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\RestApiDocumentationGenerator;

use Spryker\Zed\RestApiDocumentationGenerator\RestApiDocumentationGeneratorConfig as SprykerRestApiDocumentationGeneratorConfig;

class RestApiDocumentationGeneratorConfig extends SprykerRestApiDocumentationGeneratorConfig
{
    /**
     * @project Only needed internal non-split project, not in public split project.
     *
     * @return array
     */
    protected function getCoreAnnotationsSourceDirectoryPatterns(): array
    {
        $directoryPatterns = parent::getCoreAnnotationsSourceDirectoryPatterns();
        $directoryPatterns[] = APPLICATION_VENDOR_DIR . '/spryker/spryker/Bundles/%1$s/src/Spryker/Glue/%1$s/Controller/';

        return $directoryPatterns;
    }
}

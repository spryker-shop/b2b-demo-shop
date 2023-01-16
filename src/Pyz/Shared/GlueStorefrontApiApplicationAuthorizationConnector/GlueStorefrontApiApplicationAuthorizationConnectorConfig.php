<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\GlueStorefrontApiApplicationAuthorizationConnector;

use Spryker\Shared\GlueStorefrontApiApplicationAuthorizationConnector\GlueStorefrontApiApplicationAuthorizationConnectorConfig as SprykerGlueStorefrontApiApplicationAuthorizationConnectorConfig;

class GlueStorefrontApiApplicationAuthorizationConnectorConfig extends SprykerGlueStorefrontApiApplicationAuthorizationConnectorConfig
{
    /**
     * Specification:
     * - Returns a list of protected endpoints.
     * - Structure example:
     * [
     *      '/example' => [
     *          'isRegularExpression' => false,
     *      ],
     *      '/\/example\/.+/' => [
     *          'isRegularExpression' => true,
     *          'methods' => [
     *              'patch',
     *              'delete',
     *          ],
     *      ],
     * ]
     *
     * @api
     *
     * @return array<string, mixed>
     */
    public function getProtectedPaths(): array
    {
        return [];
    }
}

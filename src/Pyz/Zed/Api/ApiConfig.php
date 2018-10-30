<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Api;

use Spryker\Zed\Api\ApiConfig as SprykerApiConfig;

class ApiConfig extends SprykerApiConfig
{
    /**
     * @return array
     */
    public function getSafeHeaderDataKeys(): array
    {
        return [
            'accept-language',
            'accept-encoding',
            'accept',
            'range',
            'origin',
            'user-agent',
            'upgrade-insecure-requests',
            'cache-control',
            'connection',
            'host',
            'x-request-start',
            'content-length',
            'content-type',
            'x-php-ob-level',
        ];
    }

    /**
     * @return array
     */
    public function getSafeServerDataKeys(): array
    {
        return [
            'VM_DOMAIN',
            'VM_PROJECT',
            'USER',
            'HOME',
            'HTTP_ACCEPT_LANGUAGE',
            'HTTP_ACCEPT_ENCODING',
            'HTTP_ACCEPT',
            'HTTP_USER_AGENT',
            'HTTP_UPGRADE_INSECURE_REQUESTS',
            'HTTP_CACHE_CONTROL',
            'HTTP_CONNECTION',
            'HTTP_HOST',
            'APPLICATION_STORE',
            'APPLICATION_ENV',
            'HTTP_X_REQUEST_START',
            'HTTPS',
            'REDIRECT_STATUS',
            'SERVER_NAME',
            'SERVER_PORT',
            'SERVER_ADDR',
            'REMOTE_PORT',
            'REMOTE_ADDR',
            'SERVER_SOFTWARE',
            'GATEWAY_INTERFACE',
            'SERVER_PROTOCOL',
            'DOCUMENT_ROOT',
            'DOCUMENT_URI',
            'REQUEST_URI',
            'SCRIPT_NAME',
            'SCRIPT_FILENAME',
            'CONTENT_LENGTH',
            'CONTENT_TYPE',
            'REQUEST_METHOD',
            'QUERY_STRING',
            'FCGI_ROLE',
            'PHP_SELF',
            'REQUEST_TIME_FLOAT',
            'REQUEST_TIME',
        ];
    }
}

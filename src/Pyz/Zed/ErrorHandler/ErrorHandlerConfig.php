<?php



declare(strict_types = 1);

namespace Pyz\Zed\ErrorHandler;

use Spryker\Zed\ErrorHandler\ErrorHandlerConfig as SprykerErrorHandlerConfigAlias;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Spryker\Shared\ErrorHandler\ErrorHandlerConfig getSharedConfig()
 */
class ErrorHandlerConfig extends SprykerErrorHandlerConfigAlias
{
    /**
     * @api
     *
     * @return array<int>
     */
    public function getValidSubRequestExceptionStatusCodes(): array
    {
        return array_merge(
            parent::getValidSubRequestExceptionStatusCodes(),
            [
                Response::HTTP_TOO_MANY_REQUESTS,
            ],
        );
    }
}

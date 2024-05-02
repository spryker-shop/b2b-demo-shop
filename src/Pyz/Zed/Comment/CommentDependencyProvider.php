<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Comment;

use Spryker\Zed\Comment\CommentDependencyProvider as SprykerCommentDependencyProvider;
use Spryker\Zed\Comment\Communication\Plugin\Comment\CustomerCommentAuthorValidationStrategyPlugin;
use Spryker\Zed\CommentUserConnector\Communication\Plugin\Comment\UserCommentAuthorValidationStrategyPlugin;
use Spryker\Zed\CommentUserConnector\Communication\Plugin\Comment\UserCommentExpanderPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\Comment\SharedCartAccessCommentValidatorPlugin;

class CommentDependencyProvider extends SprykerCommentDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CommentExtension\Dependency\Plugin\CommentValidatorPluginInterface>
     */
    protected function getCommentValidatorPlugins(): array
    {
        return [
            new SharedCartAccessCommentValidatorPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CommentExtension\Dependency\Plugin\CommentAuthorValidatorStrategyPluginInterface>
     */
    protected function getCommentAuthorValidatorStrategyPlugins(): array
    {
        return [
            new CustomerCommentAuthorValidationStrategyPlugin(),
            new UserCommentAuthorValidationStrategyPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CommentExtension\Dependency\Plugin\CommentExpanderPluginInterface>
     */
    protected function getCommentExpanderPlugins(): array
    {
        return [
            new UserCommentExpanderPlugin(),
        ];
    }
}

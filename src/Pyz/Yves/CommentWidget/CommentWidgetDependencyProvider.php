<?php



declare(strict_types = 1);

namespace Pyz\Yves\CommentWidget;

use SprykerShop\Yves\CartPage\Plugin\CommentWidget\CartCommentThreadAfterOperationStrategyPlugin;
use SprykerShop\Yves\CommentWidget\CommentWidgetDependencyProvider as SprykerShopCommentDependencyProvider;

class CommentWidgetDependencyProvider extends SprykerShopCommentDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\CommentWidgetExtension\Dependency\Plugin\CommentThreadAfterOperationStrategyPluginInterface>
     */
    protected function getCommentThreadAfterOperationStrategyPlugins(): array
    {
        return [
            new CartCommentThreadAfterOperationStrategyPlugin(),
        ];
    }
}

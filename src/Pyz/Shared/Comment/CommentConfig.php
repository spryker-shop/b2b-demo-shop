<?php



declare(strict_types = 1);

namespace Pyz\Shared\Comment;

use Spryker\Shared\Comment\CommentConfig as SprykerCommentConfig;

class CommentConfig extends SprykerCommentConfig
{
    /**
     * @return array<string>
     */
    public function getAvailableCommentTags(): array
    {
        return [
            'delivery',
            'important',
        ];
    }
}

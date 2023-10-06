<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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

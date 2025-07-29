<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ProductReview;

use Spryker\Client\ProductReview\ProductReviewConfig as ProductReviewProductReviewConfig;

class ProductReviewConfig extends ProductReviewProductReviewConfig
{
    /**
     * @var int
     */
    public const PAGINATION_DEFAULT_ITEMS_PER_PAGE = 3;

    /**
     * @var array<int>
     */
    public const PAGINATION_VALID_ITEMS_PER_PAGE = [
        3,
    ];
}

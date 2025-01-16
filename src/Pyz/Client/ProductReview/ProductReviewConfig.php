<?php



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

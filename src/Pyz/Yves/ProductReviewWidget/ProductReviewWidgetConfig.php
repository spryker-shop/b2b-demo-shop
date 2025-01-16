<?php



declare(strict_types = 1);

namespace Pyz\Yves\ProductReviewWidget;

use SprykerShop\Yves\ProductReviewWidget\ProductReviewWidgetConfig as SprykerProductReviewWidgetConfig;

class ProductReviewWidgetConfig extends SprykerProductReviewWidgetConfig
{
    /**
     * @var string
     */
    public const GLOSSARY_KEY_INVALID_RATING_VALIDATION_MESSAGE = 'product_review.error.invalid_rating';
}

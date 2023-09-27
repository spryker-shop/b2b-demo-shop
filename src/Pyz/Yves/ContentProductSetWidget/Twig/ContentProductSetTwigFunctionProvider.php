<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentProductSetWidget\Twig;

use Pyz\Yves\ContentProductSetWidget\Reader\ContentProductAbstractReaderInterface;
use Pyz\Yves\ContentProductSetWidget\Reader\ContentProductSetReaderInterface;
use Spryker\Client\ContentProductSet\Exception\InvalidProductSetTermException;
use Spryker\Shared\Twig\TwigFunctionProvider;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

/**
 * @method \Pyz\Yves\ContentProductSetWidget\ContentProductSetWidgetFactory getFactory()
 */
class ContentProductSetTwigFunctionProvider extends TwigFunctionProvider
{
    /**
     * @var string
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE = 'landing-page';

    /**
     * @var string
     */
    protected const FUNCTION_CONTENT_PRODUCT_SET = 'content_product_set';

    /**
     * @var string
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_CART_BUTTON_TOP = 'cart-button-top';

    /**
     * @var string
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_CART_BUTTON_BOTTOM = 'cart-button-btm';

    /**
     * @var string
     */
    protected const PARAM_ATTRIBUTE = 'attributes';

    /**
     * @var string
     *
     * @deprecated Use {@link \SprykerShop\Yves\ContentProductSetWidget\Twig\ContentProductSetTwigFunctionProvider::WIDGET_TEMPLATE_IDENTIFIER_CART_BUTTON_TOP} instead.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_DEFAULT = 'default';

    /**
     * @var \Twig\Environment
     */
    protected $twig;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $localeName;

    /**
     * @var \Pyz\Yves\ContentProductSetWidget\Reader\ContentProductSetReaderInterface
     */
    protected $contentProductSetReader;

    /**
     * @var \Pyz\Yves\ContentProductSetWidget\Reader\ContentProductAbstractReaderInterface
     */
    protected $contentProductAbstractReader;

    /**
     * @param \Twig\Environment $twig
     * @param string $localeName
     * @param \Pyz\Yves\ContentProductSetWidget\Reader\ContentProductSetReaderInterface $contentProductSetReader
     * @param \Pyz\Yves\ContentProductSetWidget\Reader\ContentProductAbstractReaderInterface $contentProductAbstractReader
     */
    public function __construct(
        Environment $twig,
        string $localeName,
        ContentProductSetReaderInterface $contentProductSetReader,
        ContentProductAbstractReaderInterface $contentProductAbstractReader,
    ) {
        $this->twig = $twig;
        $this->localeName = $localeName;
        $this->contentProductSetReader = $contentProductSetReader;
        $this->contentProductAbstractReader = $contentProductAbstractReader;
    }

    /**
     * @return string
     */
    public function getFunctionName(): string
    {
        return static::FUNCTION_CONTENT_PRODUCT_SET;
    }

    /**
     * @return callable
     */
    public function getFunction(): callable
    {
        return function (array $context, string $contentKey, string $templateIdentifier): string {
            if (!isset($this->getAvailableTemplates()[$templateIdentifier])) {
                return $this->getMessageProductSetWrongTemplate($templateIdentifier);
            }

            try {
                $productSetDataStorageTransfer = $this->contentProductSetReader
                    ->findProductSetDataStorage($contentKey, $this->localeName);
            } catch (InvalidProductSetTermException $exception) {
                return $this->getMessageProductSetWrongType($contentKey);
            }

            if (!$productSetDataStorageTransfer) {
                return $this->getMessageProductSetNotFound($contentKey);
            }

            /** @var array<mixed> $selectedAttributes */
            $selectedAttributes = $this->getRequest($context)->query->get(static::PARAM_ATTRIBUTE) ?: [];
            $productAbstractViewCollection = $this->contentProductAbstractReader
                ->getProductAbstractCollection($productSetDataStorageTransfer, $selectedAttributes, $this->localeName);

            return (string)$this->twig->render(
                $this->getAvailableTemplates()[$templateIdentifier],
                [
                    'productSet' => $productSetDataStorageTransfer,
                    'productViews' => $productAbstractViewCollection,
                ],
            );
        };
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return [
            'needs_context' => true,
            'is_safe' => ['html'],
        ];
    }

    /**
     * @return array<string>
     */
    protected function getAvailableTemplates(): array
    {
        return [
            static::WIDGET_TEMPLATE_IDENTIFIER_DEFAULT => '@ContentProductSetWidget/views/content-product-set/content-product-set.twig',
            static::WIDGET_TEMPLATE_IDENTIFIER_CART_BUTTON_TOP => '@ContentProductSetWidget/views/content-product-set/content-product-set.twig',
            static::WIDGET_TEMPLATE_IDENTIFIER_CART_BUTTON_BOTTOM => '@ContentProductSetWidget/views/content-product-set-alternative/content-product-set-alternative.twig',
            static::WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE => '@ContentProductSetWidget/views/content-product-set-landing-page/content-product-set-landing-page.twig',
        ];
    }

    /**
     * @param string $contentKey
     *
     * @return string
     */
    protected function getMessageProductSetNotFound(string $contentKey): string
    {
        return sprintf('<strong>Content product set with content key "%s" not found.</strong>', $contentKey);
    }

    /**
     * @param string $templateIdentifier
     *
     * @return string
     */
    protected function getMessageProductSetWrongTemplate(string $templateIdentifier): string
    {
        return sprintf('<strong>"%s" is not supported name of template.</strong>', $templateIdentifier);
    }

    /**
     * @param string $contentKey
     *
     * @return string
     */
    protected function getMessageProductSetWrongType(string $contentKey): string
    {
        return sprintf(
            '<strong>Content product set widget could not be rendered because the content item with key "%s" is not a product set.</strong>',
            $contentKey,
        );
    }

    /**
     * @param array<mixed> $context
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function getRequest(array $context): Request
    {
        return $context['app']['request'];
    }
}

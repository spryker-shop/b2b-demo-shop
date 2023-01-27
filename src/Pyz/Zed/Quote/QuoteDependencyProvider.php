<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Quote;

use Spryker\Zed\Comment\Communication\Plugin\Quote\CommentThreadQuoteExpanderPlugin;
use Spryker\Zed\Currency\Communication\Plugin\Quote\DefaultCurrencyQuoteExpandBeforeCreatePlugin;
use Spryker\Zed\Currency\Communication\Plugin\Quote\QuoteCurrencyValidatorPlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\AddDefaultNameBeforeQuoteSavePlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\AddSuccessMessageAfterQuoteCreatedPlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\DeactivateQuotesBeforeQuoteSavePlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\InitDefaultQuoteCustomerQuoteDeleteAfterPlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\Quote\AddDefaultQuoteChangedMessageQuoteUpdateBeforePlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\ResolveQuoteNameBeforeQuoteCreatePlugin;
use Spryker\Zed\OrderCustomReference\Communication\Plugin\Quote\OrderCustomReferenceQuoteFieldsAllowedForSavingProviderPlugin;
use Spryker\Zed\Price\Communication\Plugin\Quote\QuotePriceModeValidatorPlugin;
use Spryker\Zed\Quote\QuoteDependencyProvider as SprykerQuoteDependencyProvider;
use Spryker\Zed\QuoteApproval\Communication\Plugin\Quote\QuoteApprovalExpanderPlugin;
use Spryker\Zed\QuoteApproval\Communication\Plugin\Quote\QuoteApprovalQuoteFieldsAllowedForSavingProviderPlugin;
use Spryker\Zed\QuoteApproval\Communication\Plugin\Quote\RemoveQuoteApprovalsBeforeQuoteDeletePlugin;
use Spryker\Zed\QuoteApprovalShipmentConnector\Communication\Plugin\Quote\QuoteApprovalShipmentQuoteFieldsAllowedForSavingProviderPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\CleanQuoteShareBeforeQuoteCreatePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\DeactivateSharedQuotesBeforeQuoteSavePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\MarkAsDefaultQuoteAfterSavePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\Quote\AddDefaultSharedQuoteChangedMessageQuoteUpdateBeforePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\Quote\ShareDetailsQuoteExpanderPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\RemoveSharedQuoteBeforeQuoteDeletePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\SharedQuoteSetDefaultBeforeQuoteSavePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\UpdateShareDetailsQuoteAfterSavePlugin;
use Spryker\Zed\Store\Communication\Plugin\Quote\QuoteStoreValidatorPlugin;

class QuoteDependencyProvider extends SprykerQuoteDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface>
     */
    protected function getQuoteCreateAfterPlugins(): array
    {
        return [
            new AddSuccessMessageAfterQuoteCreatedPlugin(), #MultiCartFeature
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface>
     */
    protected function getQuoteCreateBeforePlugins(): array
    {
        return [
            new AddDefaultNameBeforeQuoteSavePlugin(), #MultiCartFeature
            new ResolveQuoteNameBeforeQuoteCreatePlugin(), #MultiCartFeature
            new DeactivateQuotesBeforeQuoteSavePlugin(), #MultiCartFeature
            new CleanQuoteShareBeforeQuoteCreatePlugin(), #SharedCartFeature
            new DeactivateSharedQuotesBeforeQuoteSavePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface>
     */
    protected function getQuoteUpdateAfterPlugins(): array
    {
        return [
            new UpdateShareDetailsQuoteAfterSavePlugin(), #SharedCartFeature
            new MarkAsDefaultQuoteAfterSavePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteExpanderPluginInterface>
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return [
            new QuoteApprovalExpanderPlugin(), #QuoteApprovalFeature
            new CommentThreadQuoteExpanderPlugin(),
            new ShareDetailsQuoteExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface>
     */
    protected function getQuoteUpdateBeforePlugins(): array
    {
        return [
            new AddDefaultNameBeforeQuoteSavePlugin(), #MultiCartFeature
            new ResolveQuoteNameBeforeQuoteCreatePlugin(), #MultiCartFeature
            new AddDefaultQuoteChangedMessageQuoteUpdateBeforePlugin(), #MultiCartFeature
            new DeactivateQuotesBeforeQuoteSavePlugin(), #MultiCartFeature
            new AddDefaultSharedQuoteChangedMessageQuoteUpdateBeforePlugin(), #SharedCartFeature
            new DeactivateSharedQuotesBeforeQuoteSavePlugin(), #SharedCartFeature
            new SharedQuoteSetDefaultBeforeQuoteSavePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface>
     */
    protected function getQuoteDeleteBeforePlugins(): array
    {
        return [
            new RemoveSharedQuoteBeforeQuoteDeletePlugin(), #SharedCartFeature
            new RemoveQuoteApprovalsBeforeQuoteDeletePlugin(), #QuoteApproval
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteDeleteAfterPluginInterface>
     */
    protected function getQuoteDeleteAfterPlugins(): array
    {
        return [
            new InitDefaultQuoteCustomerQuoteDeleteAfterPlugin(), #MultiCartFeature
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteValidatorPluginInterface>
     */
    protected function getQuoteValidatorPlugins(): array
    {
        return [
            new QuoteCurrencyValidatorPlugin(),
            new QuotePriceModeValidatorPlugin(),
            new QuoteStoreValidatorPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteExpandBeforeCreatePluginInterface>
     */
    protected function getQuoteExpandBeforeCreatePlugins(): array
    {
        return [
            new DefaultCurrencyQuoteExpandBeforeCreatePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteFieldsAllowedForSavingProviderPluginInterface>
     */
    protected function getQuoteFieldsAllowedForSavingProviderPlugins(): array
    {
        return [
            new QuoteApprovalQuoteFieldsAllowedForSavingProviderPlugin(),
            new QuoteApprovalShipmentQuoteFieldsAllowedForSavingProviderPlugin(),
            new OrderCustomReferenceQuoteFieldsAllowedForSavingProviderPlugin(),
        ];
    }
}

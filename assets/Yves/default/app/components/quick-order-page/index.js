/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

'use strict';

var $ = require('jquery');
require('devbridge-autocomplete');

var AUTOCOMPLETE_INPUT = '.js-autocomplete-input-field',
    QTY_INPUT = '.js-qty-input-field',
    SKU_INPUT = '.js-sku-input-field',
    ITEMS_CONTAINER = '.items-container',
    PRODUCT_ITEM_ROW = '.product-item-row',
    ADD_MORE_ROWS_BUTTON = '.js-add-more-rows-button',
    DELETE_ROW_BUTTON = '.js-delete-row-button',
    ROW_ERROR_CONTAINER = '.js-product-error',
    TRANSLATIONS_JSON_ID = 'quick-order-form-translations';

module.exports = {
    name: 'quick-order-form',
    view: {
        init: function($root) {
            this.$root = $root;
            this.rowsNumber = $root.data('rows-number');
            this.suggestionsUrl = $root.data('suggestions-url');
            this.translations = document.getElementById(TRANSLATIONS_JSON_ID) && JSON.parse(document.getElementById(TRANSLATIONS_JSON_ID).innerHTML);

            $root
                .on('change', QTY_INPUT, this.qtyInputHandler)
                .on('keyup',  QTY_INPUT, this.qtyInputHandler)
                .on('click', DELETE_ROW_BUTTON, this.removeItem)
                .on('submit', this.checkItemsCount);

            $(QTY_INPUT + '[value!=""]', $root).trigger('change');

            $(ADD_MORE_ROWS_BUTTON, $root).on('click', this.onClickAddMoreRows.bind(this));

            this.initAutocomplete();
        },

        onClickAddMoreRows: function () {
            this.addMoreRows();
            this.initAutocomplete();

            return false;
        },

        checkItemsCount: function () {
            var products = $(PRODUCT_ITEM_ROW, this)
                .filter(function() {
                    return $(SKU_INPUT, this).val() && $(QTY_INPUT, this).val();
                });

            return products.length > 0;
        },

        removeItem: function (e) {
            $(e.target).parents(PRODUCT_ITEM_ROW).remove();

            return false;
        },

        initAutocomplete: function () {
            var suggestionsUrl = this.suggestionsUrl,
                translations = this.translations;

            $(AUTOCOMPLETE_INPUT, this.$root).each(function (n, input) {
                var idSearchInput = $(input).attr('id'),
                    $skuInput = $('#' + idSearchInput.replace('_searchQuery', '_sku')),
                    $priceInput = $('#' + idSearchInput.replace('_searchQuery', '_price')),
                    $qtyInput = $('#' + idSearchInput.replace('_searchQuery', '_qty')),
                    $searchField = $('#' + idSearchInput.replace('_searchQuery', '_searchField')),
                    $errorPanel = $(ROW_ERROR_CONTAINER, $(input).parent());

                $(input).autocomplete({
                    minChars: 2,
                    serviceUrl: suggestionsUrl,
                    paramName: 'q',
                    params: {
                        field: $('option:selected', $searchField).val()
                    },
                    groupBy: null,
                    onSearchStart: function () {
                        var sku = $skuInput.val();
                        // prevent repeated query on input focus
                        if (sku && this.value.indexOf(sku) !== -1) {
                            return false;
                        }
                    },
                    onSearchComplete: function (query, suggestions) {
                        $errorPanel.hide();
                        if (suggestions.length === 0) {
                            $errorPanel.text(translations["error-item-not-found"]);
                            $errorPanel.show();
                        }
                    },
                    onSelect: function (suggestion) {
                        $skuInput.val(suggestion.data.sku);
                        if (suggestion.data.available) {
                            $qtyInput.val(1);
                            $priceInput.val(suggestion.data.price);
                            $qtyInput.trigger('change');
                            $qtyInput.focus();
                        } else {
                            $errorPanel.text(translations["error-item-not-available"]);
                            $errorPanel.show();
                        }
                    }
                });

                $(input).on('change', function () {
                    if (this.value === '') {
                        $skuInput.val('');
                        $qtyInput.val('');
                        $priceInput.val('');
                        $qtyInput.trigger('change');
                    }
                });
            });
        },

         qtyInputHandler: function (e) {
            var $qtyInput = $(e.target),
                idQtyInput = $qtyInput.attr('id'),
                qtyIntValue = $qtyInput.val().replace(/[^0-9]/g, ''),
                qty = qtyIntValue,
                price = $('#' + idQtyInput.replace('_qty', '_price')).val(),
                $pricePanelInput = $('#' + idQtyInput.replace('_qty', '_pricePanel'));

            $pricePanelInput.val('');
            $qtyInput.val(qtyIntValue);

            if (qty && price) {
                var newPrice = (qty * price / 100).toFixed(2);
                $pricePanelInput.val(newPrice)
            }
        },

        addMoreRows: function () {
            var $rows = $(ITEMS_CONTAINER, this.$root).find(PRODUCT_ITEM_ROW),
                $lastRow = $rows.last(),
                index = $lastRow.data('index'),
                newRowsHtml = '';

            for (var i = index + 1; i < $rows.length + this.rowsNumber; i++) {
                var newRowHtml = $lastRow[0].outerHTML;
                newRowsHtml += newRowHtml
                    .replace('data-index="' + index + '"', 'data-index="' + i + '"')
                    .replace(new RegExp('_' + index + '_', 'g'), '_' + i + '_')
                    .replace(new RegExp('\\[' + index + '\\]', 'g'), '[' + i + ']')
                    .replace(/value=".*"/g, '')
            }

            $(ITEMS_CONTAINER, this.$root).append(newRowsHtml)
        }
    }
};

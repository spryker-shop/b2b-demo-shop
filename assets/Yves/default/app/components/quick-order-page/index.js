/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

'use strict';

var $ = require('jquery');

var QTY_INPUT = '.js-qty-input-field',
    SKU_INPUT = '.js-sku-input-field',
    ITEMS_CONTAINER = '.items-container',
    PRODUCT_ITEM_ROW = '.product-item-row',
    ADD_MORE_ROWS_BUTTON = '.js-add-more-rows-button',
    DELETE_ROW_BUTTON = '.js-delete-row-button';

module.exports = {
    name: 'quick-order-form',
    view: {
        init: function($root) {
            this.$root = $root;
            this.rowsNumber = $root.data('rows-number');

            $root
                .on('keyup',  QTY_INPUT, this.qtyInputHandler)
                .on('click', DELETE_ROW_BUTTON, this.removeItem)
                .on('submit', this.checkItemsCount)
                .on('change', SKU_INPUT, this.setDefaultQty)
                .on('keyup', SKU_INPUT, this.setDefaultQty);

            $(ADD_MORE_ROWS_BUTTON, $root).on('click', this.onClickAddMoreRows.bind(this));
        },

        onClickAddMoreRows: function () {
            this.addMoreRows();

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

         qtyInputHandler: function (e) {
            var $qtyInput = $(e.target),
                qtyIntValue = $qtyInput.val().replace(/[^0-9]/g, '');

            $qtyInput.val(qtyIntValue);
        },

        setDefaultQty: function (e) {
            var $skuInput = $(e.target),
                idSkuInput = $skuInput.attr('id'),
                $qtyInput = $('#' + idSkuInput.replace('_sku', '_qty'));

            $qtyInput.val($skuInput.val() ? 1 : '');
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

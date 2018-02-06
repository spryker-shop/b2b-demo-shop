/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

'use strict';

module.exports = {
    name: 'customer-reorder-widget',
    view: {
        init: function($root) {
            this.$root = $root;
            $('input.reorder.order-item').on('click', this.onClick.bind(this));
            console.log({
                checkboxes: $('input.reorder.order-item'),
                ch_checked: $('input.reorder.order-item:checkbox:checked'),
                count_checked: $('input.reorder.order-item:checkbox:checked').length,
                is_any_chect: $('input.reorder.order-item:checkbox:checked').length === 0,
                button: $('input.reorder.partial')
            });
        },

        onClick: function() {
            var isNoneChecked = $('input.reorder.order-item:checkbox:checked').length === 0;
            console.log({
                checkboxes: $('input.reorder.order-item'),
                ch_checked: $('input.reorder.order-item:checkbox:checked'),
                count_checked: $('input.reorder.order-item:checkbox:checked').length,
                is_any_chect: $('input.reorder.order-item:checkbox:checked').length === 0,
                button: $('input.reorder.partial'),
                is_check_var: isNoneChecked
            });

            $('input.reorder.partial').toggleClass('disabled', isNoneChecked);
        }
    }
};

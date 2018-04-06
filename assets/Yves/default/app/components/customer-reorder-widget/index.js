/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

'use strict';

module.exports = {
    name: 'customer-reorder-widget',
    view: {
        init: function($root) {
            this.$root = $root;
            this.$button = $('input.reorder.partial');
            this.$checkboxes = $('input.reorder.order-item');

            this.onClick();
            this.$checkboxes.on('click', this.onClick.bind(this));
        },

        onClick: function() {
            var isNoneChecked = !this.$checkboxes.filter(':checkbox:checked').length;

            this.$button.prop('disabled', isNoneChecked);
        }
    }
};

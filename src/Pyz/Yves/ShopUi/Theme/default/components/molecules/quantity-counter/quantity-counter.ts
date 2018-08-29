import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';

export default class QuantityCounter extends Component {

    readyCallback(): void {

        const input = $(this).find(`.${this.name}__input`);
        let maxQuantity = input.data('max-quantity');
        const decrButton = $(this).find('.js-quantity-decrement');
        const incrButton = $(this).find('.js-quantity-increment');
        const autoUpdate = input.data('auto-update');
        const form = $(this).parent('form');
        let timeout = 0;

        if(!maxQuantity){
            maxQuantity = Infinity;
        }
        decrButton.click(function () {
            let value = +input.val();
            if(value > 1){
                input.val(value - 1);

                if(autoUpdate) {
                    timer();
                }
            }
        });
        incrButton.click(function () {
            let value = +input.val();
            if(value < maxQuantity) {
                input.val(value + 1);

                if(autoUpdate) {
                    timer();
                }
            }
        });

        if(autoUpdate) {
            input.change(timer);
        }

        function timer() {
            clearTimeout(timeout);
            timeout = setTimeout(() => form.submit(), 1000);
        }
    }
}
